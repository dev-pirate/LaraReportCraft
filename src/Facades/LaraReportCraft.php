<?php

namespace DevPirate\LaraReportCraft\Facades;

use Illuminate\Support\Facades\Facade;

final class LaraReportCraft extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaraReportCraft::class;
    }
}
