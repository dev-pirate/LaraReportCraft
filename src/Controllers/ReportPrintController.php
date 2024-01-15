<?php

namespace DevPirate\LaraReportCraft\Controllers;

use DevPirate\LaraReportCraft\Services\ReportGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ReportPrintController
{
    public function __invoke(Request $request, ReportGenerator $generator) {
        $data = $this->validator($request->all())->validate();
        $title = str_replace('_', ' ', $data['title']);
        $infos = $generator->generate($title, $data['filter']);
        $html = "";

        if ($infos !== null) {
            $html = View::make('lara_report_craft::printing.report_print', [
                'title' => $title,
                'data' => $infos['data'],
                'columns' => $infos['columns']
            ])->render();

            return response()->json(['content' => $html, 'success' => true, 'data' => $infos['data'], 'columns' => $infos['columns']]);
        }

        return response('report not found');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string'],
            'filter' => ['required', 'array']
        ]);
    }
}
