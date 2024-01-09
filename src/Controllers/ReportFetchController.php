<?php

namespace DevPirate\LaraReportCraft\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReportFetchController
{
    public function __invoke(Request $request) {

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'file' => ['required', 'string'],
            'tbN' => ['required', 'string'],
            'columns' => ['required'],
        ]);
    }
}
