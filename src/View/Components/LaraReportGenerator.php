<?php

namespace DevPirate\LaraExcelCraft\View\Components;

use Illuminate\View\Component;

class LaraReportGenerator extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('lara_report_craft::components.reporting_form');
    }
}
