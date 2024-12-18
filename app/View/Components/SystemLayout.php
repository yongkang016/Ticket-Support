<?php

namespace App\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class SystemLayout extends Component
{
    /**
     * Create a new components instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Init layout file
        app(config('theme-settings.KT_THEME_BOOTSTRAP.system'))->init();
    }

    /**
     * Get the view / contents that represents the components.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view(config('theme-settings.KT_THEME_LAYOUT_DIR').'._system');
    }
}
