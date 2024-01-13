<?php

namespace DevPirate\LaraReportCraft\Controllers;

use DevPirate\LaraReportCraft\Services\ReportGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportPrintController
{
    public function __invoke(Request $request, string $reportTitle, ReportGenerator $generator) {
        $title = str_replace('_', ' ', $reportTitle);
        $infos = $generator->generate($title);

        if ($infos !== null) {
            return view('lara_report_craft::printing.report_print', [
                'title' => $title,
                'data' => $infos['data'],
                'columns' => $infos['columns']
            ]);
        }

        return response('report not found');
    }
}
