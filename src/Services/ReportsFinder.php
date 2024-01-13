<?php

namespace DevPirate\LaraReportCraft\Services;

use DevPirate\LaraReportCraft\Interfaces\ReportInterface;
use Illuminate\Filesystem\Filesystem;

class ReportsFinder
{
    public function findReports() {
        $modelPath = config('lara-report-craft.reports_path');
        $files = (new Filesystem)->files($modelPath);

        $reportsInfo = [];

        foreach ($files as $file) {
            $content = file_get_contents($file->getPathname());

            // Use regular expression to extract namespace and class name
            preg_match('/namespace (.+?);.*?class (.+?) /s', $content, $matches);

            if (count($matches) === 3) {
                $namespace = $matches[1];
                $className = $matches[2];

                $classNamespace = $namespace . '\\' . $className;
                if (class_exists($classNamespace) && in_array(ReportInterface::class, class_implements($classNamespace))) {
                    $reportClass = new $classNamespace;
                    $reportsInfo[] = $reportClass->getReportTitle();
                }
            }
        }

        // Output the result
        return $reportsInfo;
    }
}
