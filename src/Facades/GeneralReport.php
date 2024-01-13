<?php

namespace DevPirate\LaraReportCraft\Facades;

use DevPirate\LaraReportCraft\Interfaces\ReportInterface;

class GeneralReport implements ReportInterface
{
    /**
     * @var array with keys :
     * ['field', 'title']
     */
    protected array $columns = [];

    /**
     * @var string specify the title of the report
     */
    protected string $reportTitle = '';

    /**
     * @return string
     * return title of the report
     */
    public function getReportTitle(): string {
        return $this->reportTitle;
    }

    /**
     * @return array
     * return an array of data used in the report table
     */
    public function generate_report(): array {
        return [];
    }

    public function getColumns(): array {
        return $this->columns;
    }
}
