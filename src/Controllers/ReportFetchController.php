<?php

namespace DevPirate\LaraReportCraft\Controllers;

use DevPirate\LaraReportCraft\Services\ReportsFinder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportFetchController
{
    public function __invoke(Request $request, ReportsFinder $finder) {
        $data = $this->validator($request->all())->validate();
        $onlySaved = $data['onlySaved'];

        $reportNames = $finder->findReports($onlySaved);

        return response()->json(['reports' => $reportNames, 'success' => true]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'onlySaved' => ['required']
        ]);
    }
}
