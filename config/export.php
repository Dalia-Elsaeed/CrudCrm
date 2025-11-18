<?php

use Crm\Customers\Services\Export\ExcelExport;
use Crm\Customers\Services\Export\HtmlExport;
use Crm\Customers\Services\Export\JsonExport;
use Crm\Customers\Services\Export\PdfExport;

return [
    'exporter' => [
'json' => JsonExport::class,
'html' => HtmlExport::class,
'pdf' => PdfExport::class,
'excel' => ExcelExport::class,

    ]
    ];
