<?php

namespace Crm\Customers\Services\Export;

use Crm\Customers\Exception\InvalidExportFormat;
use Crm\Customers\Services\Export\ExportInterface;

class ExportFactory
{
    public static function instance(string $format): ExportInterface
    {
        $handler = config('export.exporter')[$format] ?? null;
        if (! $handler) {
            throw new InvalidExportFormat(sprintf("format %s is not support", $format));
        }
        return new $handler;
    }
}
