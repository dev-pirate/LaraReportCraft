<?php

namespace DevPirate\LaraReportCraft\Controllers;

use DevPirate\LaraReportCraft\Services\ReportGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportGeneratorController
{
    public function __invoke(Request $request, ReportGenerator $generator) {
        $data = $this->validator($request->all())->validate();
        $infos = $generator->generate($data['title'], $data['filter']);

        if ($infos !== null) {
            return response()->json(['data' => $infos['data'], 'columns' => $infos['columns'], 'success' => true]);
        }

        return response()->json(['data' => null, 'columns' => null, 'success' => false]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string'],
            'filter' => ['required', 'array']
        ]);
    }
}
