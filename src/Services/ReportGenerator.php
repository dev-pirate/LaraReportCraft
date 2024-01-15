<?php

namespace DevPirate\LaraReportCraft\Services;

use DevPirate\LaraReportCraft\Interfaces\ReportInterface;
use Illuminate\Filesystem\Filesystem;

class ReportGenerator
{
    public function generate($title, $filterData) {
        $modelPath = config('lara-report-craft.reports_path');
        $files = (new Filesystem)->files($modelPath);

        $class = null;

        foreach ($files as $file) {
            $content = file_get_contents($file->getPathname());

            // Use regular expression to extract namespace and class name
            preg_match('/namespace (.+?);.*?class (.+?) /s', $content, $matches);

            if (count($matches) === 3) {
                $classNamespace = $matches[1] . '\\' . $matches[2];

                if (class_exists($classNamespace) && in_array(ReportInterface::class, class_implements($classNamespace))) {
                    $reportClass = new $classNamespace;
                    if ($reportClass->getReportTitle() == $title) {
                        $class = $reportClass;
                        break;
                    }
                }
            }
        }

        if ($class) {
            return [
                'columns' => $class->getColumns(),
                'data' => $class->generate_report($filterData)
            ];
        }

        // Output the result
        return null;
    }
}
