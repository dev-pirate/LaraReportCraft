<?php

namespace DevPirate\LaraReportCraft\View\Components;

use Illuminate\View\Component;

class LaraReportGenerator extends Component
{
    public bool $onlySaved = false;

    public function __construct(
        $onlySaved = false
    ) {
        $this->onlySaved = $onlySaved;
    }

    public function render()
    {
        return view('lara_report_craft::components.reporting_form');
    }
}
