<?php

namespace Crm\Customers\Services;

use Crm\Customers\Exception\InvalidExportFormat;
use Crm\Customers\Repositories\CustomerRepository;
use Crm\Customers\Services\Export\ExportInterface;
class CustomerExportService
{
    private CustomerRepository $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function export(ExportInterface $exporter)
    {
        $customers = $this->customerRepository->all();
        $exporter->export($customers->toArray());
        // $handler = config('export.exporter')[$format] ?? null;
        // if (! $handler) {
        //     throw new InvalidExportFormat(sprintf("format %s is not support", $format));
        // }
        // $exporter = new $handler;
        // if ($handler instanceof ExportInterface) {
        //     $exporter->export($customers);
        // }
        //  عوضلي عن الكود ال فوق دا بحاجة بسيطة

        //     switch ($format) {
        //         case 'json':
        //             $exporter = new JsonExport();
        //             break;
        //         case 'html':
        //             $exporter = new HtmlExport();
        //             break;
        //         case 'pdf':
        //             $exporter = new PdfExport();
        //             break;
        //         default:
        //     }

        //     $exporter->export($customers);
        //  عوضنا عنها ف ملف config
        // وكمان عملنا لكل واحدة ملف خاص بيها عشان ميحلصش تضارب بينهم
    }
}
