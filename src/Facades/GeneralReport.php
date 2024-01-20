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
     * @var array with keys :
     * ['field', 'label', 'options', 'min', 'max', 'required', 'type' => (number, text, email, tel, select, time, date, range)]
     */
    protected array $filterForm = [
        ['field' => 'created_at', 'label' => 'Date range', 'type' => 'range', 'required' => true]
    ];

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

    public function getReportFilter(): array {
        return $this->filterForm;
    }

    protected function shortenString($inputString) {
        if (strlen($inputString) > 15) {
            return substr($inputString, 0, 15) . '...';
        } else {
            return $inputString;
        }
    }

    /**
     * @param array $filterData ['has ['field' => 'value']]
     * @return array
     * return an array of data used in the report table
     */
    public function generate_report(array $filterData): array {
        return [];
    }

    public function getColumns(): array {
        return $this->columns;
    }
}
