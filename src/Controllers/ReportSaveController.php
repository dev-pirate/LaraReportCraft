<?php

namespace DevPirate\LaraReportCraft\Controllers;

use DevPirate\LaraReportCraft\Services\ReportsFinder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportSaveController
{
    public function __invoke(Request $request, ReportsFinder $finder)
    {
        $data = $this->validator($request->all())->validate();
        $reportName = $data['reportName'];
        $finder->toggleSaveReport($reportName);
        $reportNames = $finder->findReports($data['onlySaved']);

        return response()->json(['reports' => $reportNames, 'success' => true]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'reportName' => ['required', 'string'],
            'onlySaved' => ['required']
        ]);
    }
}
