<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DefaultLayout extends Component
{
    /**
     * Create a new components instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Init layout file
        app(config('theme-settings.KT_THEME_BOOTSTRAP.default'))->init();
    }

    /**
     * Get the view / contents that represent the components.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // See also starterkit/app/Core/Bootstrap/BootstrapDefault.php
        return view(config('theme-settings.KT_THEME_LAYOUT_DIR').'._default');
    }
}
