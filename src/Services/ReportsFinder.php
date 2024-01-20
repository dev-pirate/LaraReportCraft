<?php

namespace DevPirate\LaraReportCraft\Services;

use DevPirate\LaraReportCraft\Interfaces\ReportInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class ReportsFinder
{
    public function findReports($onlySaved = false) {
        $modelPath = config('lara-report-craft.reports_path');
        $files = (new Filesystem)->files($modelPath);
        $fileLocationDisk = config('lara-report-craft.fileTempDisk');
        // Build the file path in the storage directory
        $filePath = Storage::disk($fileLocationDisk)->path('laraReportCraft/lara_craft_saved_reports.json');
        $savedReports = [];

        // Check if the file exists
        if (file_exists($filePath)) {
            $savedReports = json_decode(Storage::disk($fileLocationDisk)->get('laraReportCraft/lara_craft_saved_reports.json'), true);
        }

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
                    if ($onlySaved) {
                        if (in_array($className, $savedReports)) {
                            $reportClass = new $classNamespace;
                            $reportsInfo[] = [
                                'title' => $reportClass->getReportTitle(),
                                'filter' => $reportClass->getReportFilter(),
                                'saved' => in_array($className, $savedReports)
                            ];
                        }
                    } else {
                        $reportClass = new $classNamespace;
                        $reportsInfo[] = [
                            'title' => $reportClass->getReportTitle(),
                            'filter' => $reportClass->getReportFilter(),
                            'saved' => in_array($className, $savedReports)
                        ];
                    }
                }
            }
        }

        // Output the result
        return $reportsInfo;
    }

    public function toggleSaveReport($reportName) {
        $modelPath = config('lara-report-craft.reports_path');
        $files = (new Filesystem)->files($modelPath);

        $reportInfo = null;

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
                    if ($reportClass->getReportTitle() === $reportName) {
                        $reportInfo = [
                            'title' => $reportClass->getReportTitle(),
                            'className' => $className,
                        ];
                        break;
                    }
                }
            }
        }

        if ($reportInfo) {
            $fileLocationDisk = config('lara-report-craft.fileTempDisk');
            $fileName = 'laraReportCraft/lara_craft_saved_reports.json';
            // Build the file path in the storage directory
            $filePath = Storage::disk($fileLocationDisk)->path($fileName);

            // Check if the file exists
            if (!file_exists($filePath)) {
                Storage::disk($fileLocationDisk)->put($fileName, json_encode([]));
            }

            $savedReports = json_decode(Storage::disk($fileLocationDisk)->get($fileName), true);

            if (($key = array_search($reportInfo['className'], $savedReports)) !== false) {
                unset($savedReports[$key]);
            } else {
                $savedReports[] = $reportInfo['className'];
            }

            Storage::disk($fileLocationDisk)->put($fileName, json_encode($savedReports));
        }
    }
}
