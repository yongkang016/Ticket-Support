<?php

namespace App\Helpers;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

/**
 * @class SortableLink
 * @package App\Helpers
 */
class SortableLink
{

    /**
     * @param array $parameters
     *
     * @return string
     */
    public static function render(array $parameters)
    {
        list($sortColumn, $sortParameter, $title, $queryParameters, $anchorAttributes) = self::parseParameters($parameters);

        $title = self::applyFormatting($title, $sortColumn);

        list($icon, $direction) = self::determineDirection($sortColumn, $sortParameter);

        $trailingTag = self::formTrailingTag($icon);

        $anchorClass = self::getAnchorClass($sortParameter, $anchorAttributes);

        $anchorAttributesString = self::buildAnchorAttributesString($anchorAttributes);

        $queryString = self::buildQueryString($queryParameters, $sortParameter, $direction);

        $url = self::buildUrl($queryString, $anchorAttributes);

        return '<a'.$anchorClass.' href="'.$url.'"'.$anchorAttributesString.'>'.e($title).$trailingTag;
    }


    /**
     * @param array $parameters
     *
     * @return array
     */
    public static function parseParameters(array $parameters)
    {
        //TODO: let 2nd parameter be both title, or default query parameters
        //TODO: needs some checks before determining $title
        $explodeResult    = self::explodeSortParameter($parameters[0]);
        $sortColumn       = (empty($explodeResult)) ? $parameters[0] : $explodeResult[1];
        $title            = (count($parameters) === 1) ? null : $parameters[1];
        $queryParameters  = (isset($parameters[2]) && is_array($parameters[2])) ? $parameters[2] : [];
        $anchorAttributes = (isset($parameters[3]) && is_array($parameters[3])) ? $parameters[3] : [];

        return [$sortColumn, $parameters[0], $title, $queryParameters, $anchorAttributes];
    }


    /**
     * Explodes parameter if possible and returns array [column, relation]
     * Empty array is returned if explode could not run eg: separator was not found.
     *
     * @param $parameter
     *
     * @return array
     *
     */
    public static function explodeSortParameter($parameter)
    {
        $separator = config('columnsortable.uri_relation_column_separator', '.');

        if (Str::contains($parameter, $separator)) {
            $oneToOneSort = explode($separator, $parameter);
            if (count($oneToOneSort) !== 2) {
                throw new ColumnSortableException();
            }

            return $oneToOneSort;
        }

        return [];
    }


    /**
     * @param string|\Illuminate\Contracts\Support\Htmlable|null $title
     * @param string $sortColumn
     *
     * @return string
     */
    private static function applyFormatting($title, $sortColumn)
    {
        if ($title instanceof Htmlable) {
            return $title;
        }

        if ($title === null) {
            $title = $sortColumn;
        } elseif ( ! config('columnsortable.format_custom_titles', true)){
            return $title;
        }

        $formatting_function = config('columnsortable.formatting_function', null);
        if (!is_null($formatting_function) && function_exists($formatting_function)) {
            $title = call_user_func($formatting_function, $title);
        }

        return $title;
    }


    /**
     * @param $sortColumn
     * @param $sortParameter
     *
     * @return array
     */
    private static function determineDirection($sortColumn, $sortParameter)
    {
        $icon = self::selectIcon($sortColumn);

        if (request()->get('sort') == $sortParameter && in_array(request()->get('direction'), ['asc', 'desc'])) {
            $icon      .= (request()->get('direction') === 'asc') ? '-up' : '-down';
            $direction = request()->get('direction') === 'desc' ? 'asc' : 'desc';

            return [$icon, $direction];
        } else {
            $icon      = 'fa-solid fa-sort';
            $direction = 'desc';

            return [$icon, $direction];
        }
    }


    /**
     * @param $sortColumn
     *
     * @return string
     */
    private static function selectIcon($sortColumn)
    {
        $icon = 'fa-solid fa-sort';

        // TODO: not working
        $columns = [
            'alpha'   => [
                'rows'  => ['description', 'email', 'name', 'slug'],
                'class' => 'fa-solid fa-sort-alpha',
            ],
            'amount'  => [
                'rows'  => ['amount', 'price'],
                'class' => 'fa-solid fa-sort-amount',
            ],
            'numeric' => [
                'rows'  => ['created_at', 'updated_at', 'level', 'id', 'phone_number'],
                'class' => 'fa-solid fa-sort-numeric',
            ],
        ];

        foreach ($columns as $value) {
            if (in_array($sortColumn, $value['rows'])) {
                $icon = $value['class'];
            }
        }

        return $icon;
    }


    /**
     * @param $icon
     *
     * @return string
     */
    private static function formTrailingTag($icon)
    {
        $iconAndTextSeparator = ' ';

        $clickableIcon = false;
        $trailingTag   = $iconAndTextSeparator.'<i class="'.$icon.'"></i>'.'</a>';

        if ($clickableIcon === false) {
            $trailingTag = '</a>'.$iconAndTextSeparator.'<i class="'.$icon.'"></i>';

            return $trailingTag;
        }

        return $trailingTag;
    }


    /**
     * Take care of special case, when `class` is passed to the sortablelink.
     *
     * @param       $sortColumn
     *
     * @param array $anchorAttributes
     *
     * @return string
     */
    private static function getAnchorClass($sortColumn, &$anchorAttributes = [])
    {
        $class = [];

        $anchorClass = config('columnsortable.anchor_class', null);
        if ($anchorClass !== null) {
            $class[] = $anchorClass;
        }

        $activeClass = config('columnsortable.active_anchor_class', null);
        if ($activeClass !== null && self::shouldShowActive($sortColumn)) {
            $class[] = $activeClass;
        }

        $directionClassPrefix = config('columnsortable.direction_anchor_class_prefix', null);
        if ($directionClassPrefix !== null && self::shouldShowActive($sortColumn)) {
            $class[] = $directionClassPrefix.(request()->get('direction') === 'asc' ? config('columnsortable.asc_suffix', '-asc') :
                    config('columnsortable.desc_suffix', '-desc'));
        }

        if (isset($anchorAttributes['class'])) {
            $class = array_merge($class, explode(' ', $anchorAttributes['class']));
            unset($anchorAttributes['class']);
        }

        return (empty($class)) ? '' : ' class="'.implode(' ', $class).'"';
    }


    /**
     * @param $sortColumn
     *
     * @return boolean
     */
    private static function shouldShowActive($sortColumn)
    {
        return request()->has('sort') && request()->get('sort') == $sortColumn;
    }


    /**
     * @param $queryParameters
     * @param $sortParameter
     * @param $direction
     *
     * @return string
     */
    private static function buildQueryString($queryParameters, $sortParameter, $direction)
    {
        $checkStrlenOrArray = function ($element) {
            if (!$element) {
                return '';
            }

            return is_array($element) ? $element : strlen($element);
        };

        $persistParameters = array_filter(request()->except('sort', 'direction', 'page'), $checkStrlenOrArray);
        $queryString       = http_build_query(array_merge($queryParameters, $persistParameters, [
            'sort'      => $sortParameter,
            'direction' => $direction,
        ]));

        return $queryString;
    }

    /**
     * @param $anchorAttributes
     * @return string
     */
    private static function buildAnchorAttributesString($anchorAttributes)
    {
        if (empty($anchorAttributes)) {
            return '';
        }

        unset($anchorAttributes['href']);

        $attributes = [];
        foreach ($anchorAttributes as $k => $v) {
            $attributes[] = $k.('' != $v ? '="'.$v.'"' : '');
        }

        return ' '.implode(' ', $attributes);
    }

    /**
     * @param $queryString
     * @param $anchorAttributes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    private static function buildUrl($queryString, $anchorAttributes)
    {
        if (!isset($anchorAttributes['href'])) {
            return url(request()->path() . "?" . $queryString);
        } else {
            return url($anchorAttributes['href'] . "?" . $queryString);
        }
    }

}
