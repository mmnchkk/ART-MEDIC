<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\ServiceCategorySectionAll;

class Main extends Component
{
    public $headerServices;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->headerServices = ServiceCategorySectionAll::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.main');
    }
}
