# LaraReportCraft

LaraReportCraft is a Laravel library for managing and creating the reports easily
with nice single page table view and printing ability, also the package give you the ability
to customize the header, the footer, the title, the column and data rows of the report and .

## Install via composer

Run the following command to pull in the latest version:

```bash
composer require dev-pirate/lara-report-craft
```

## Publish the config

Run the following command to publish the package config file:

```bash
php artisan vendor:publish --provider="DevPirate\LaraReportCraft\Providers\LaraReportCraftProvider"
```

You should now have a config/lara-report-craft.php file that allows you to configure the basics of this package.

## Add Routes

Add this code inside your route file:

```bash
Route::middleware([
    'api',
    \Fruitcake\Cors\HandleCors::class,
])->group(function() {
    LaraReportCraft::routes();
});

// \Fruitcake\Cors\HandleCors middleware are required here to manage cors
```

## Create Custom Report Class
Before continuing, make sure you have installed the package as per the installation instructions for Laravel.

### Create your Class
Firstly you need to extend the DevPirate\LaraReportCraft\Facades\GeneralReport class on your report class, 
which require a custom data and functions logic

The example below should give you an idea of how this could look. Obviously you should make any changes, as necessary, to suit your own needs.

```php
<?php

namespace App\Reports;

use App\Models\Example;
use Carbon\Carbon;
use DevPirate\LaraReportCraft\Facades\GeneralReport;

class ExampleReport extends GeneralReport
{
    protected string $reportTitle = 'Example report testing';

    protected array $columns = [
        ['field' => 'order_date', 'title' => 'Order Date'],
        ['field' => 'region', 'title' => 'Région'],
        ['field' => 'rep', 'title' => 'Rep order'],
        ['field' => 'item', 'title' => 'Item N°'],
        ['field' => 'unit', 'title' => 'Unit code'],
    ];

    public function generate_report(): array
    {
        return array_map(function ($example) {
            return [
                'order_date' => Carbon::parse($example['orderDate'])->format('d/m/Y') ?? '',
                'region' => $example['region'],
                'rep' => $example['rep'],
                'item' => $example['item'],
                'unit' => $example['unit']
            ];
        }, Example::all()->toArray());
    }
}

```

## Config File

Let's review some of the options in the config/lara-report-craft.php file that we published earlier.

First up is:
```php
<?php

return [
    'reports_path' => app_path('Reports')
    // other configuration parameters
];
```
.

## License

[MIT](https://choosealicense.com/licenses/mit/)
