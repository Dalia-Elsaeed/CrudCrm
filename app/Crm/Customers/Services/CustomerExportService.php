<?php

namespace Crm\Customers\Services;

use Crm\Customers\Exception\InvalidExportFormat;
use Crm\Customers\Repositories\CustomerRepository;

class CustomerExportService
{
    private CustomerRepository $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function export(string $format)
    {
        $customers = $this->customerRepository->all();
        switch ($format) {
            case 'json':
                $this->exportJson($customers);
                break;
            case 'html':
                $this->exportHtml($customers);
                break;
            case 'pdf':
                $this->exportPdf($customers);
                break;
                default:
                throw new InvalidExportFormat(sprintf("format %s is not support",$format));
        }
    }
    private function exportJson($data)
    {
        // code
    }
    private function exportHtml($data)
    {
        // code
    }
    private function exportPdf($data)
    {
        // code
    }
}
