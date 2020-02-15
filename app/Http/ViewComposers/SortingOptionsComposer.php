<?php

namespace App\Http\ViewComposers;

use App\Constants\SortOptions;
use Illuminate\View\View;

class SortingOptionsComposer
{
    public function compose(View $view)
    {
        return $view->with('sortOptions', SortOptions::supported());
    }
}
