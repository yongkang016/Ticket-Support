<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends \Spatie\Permission\Models\Role implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    /**
     * @param Builder $query
     * @param $filters
     * @return Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters): Builder|\Illuminate\Database\Eloquent\Builder
    {
        if (isset($filters['name'])) {
            $query->whereLike('name', '%' . $filters['name'] . '%');
        }

        if (isset($filters['name_is_not'])) {
            if (is_array($filters['name_is_not'])) {
                $query->whereNotIn('name', $filters['name_is_not']);
            } else {
                $query->whereNot('name', $filters['name_is_not']);
            }
        }

        return $query;
    }

    /**
     * @param $value
     * @return array
     */
    public static function asOptions($value = null): array
    {
        $filters = [\App\Constants\Role::SUPER_ADMIN];
        $query = self::query();
        $roles = $query
            ->whereNotIn('name', $filters)
            ->get();

        $options = collect($roles)->map(function (self $role) {
            return [
                'value' => $role->id,
                'name' => \App\Constants\Role::getLabel($role->name),
                'selected' => false,
            ];
        })->toArray();

        $options[] = [
            'value' => null,
            'name' => null,
            'selected' => true
        ];

        foreach ($options as $key => $option) {
            if (is_array($value)) {
                foreach ($value as $role) {
                    $options[$key]['selected'] = $option['value'] == $role;
                    if ($options[$key]['selected']) {
                        break;
                    }
                }
            } else {
                $options[$key]['selected'] = $option['value'] == $value;
            }
        }

        return $options;
    }
}
