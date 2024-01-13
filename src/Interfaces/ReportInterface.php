<?php

namespace DevPirate\LaraReportCraft\Interfaces;

interface ReportInterface
{
    public function getReportTitle(): string;
    public function generate_report(): array;

}
