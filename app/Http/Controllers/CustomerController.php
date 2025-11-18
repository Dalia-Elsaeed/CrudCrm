<?php

namespace App\Http\Controllers;

use Crm\Customers\Services\CustomerExportService;
use Crm\Customers\Services\CustomerService;
use Crm\Customers\Services\Export\ExportFactory;
use Crm\Customers\Services\Export\ExportInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;


class CustomerController extends Controller
{
    private CustomerService $customerService;
    private CustomerExportService $customerExportService;

    public function __construct(CustomerService $customerService, CustomerExportService $customerExportService)
    {
        $this->customerService = $customerService;
        $this->customerExportService = $customerExportService;
    }

    public function index(Request $request): JsonResponse
    {
        $customers = $this->customerService->index();
        return response()->json($customers);
    }

    public function show(int $id): JsonResponse
    {
        $customer = $this->customerService->show($id);
        return response()->json($customer);
    }

    public function create(Request $request): JsonResponse
    {
        // التحقق من البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:customers,email',
            // 'phone' => 'nullable|string|max:20',
        ]);

        // إنشاء العميل مباشرة من Service
        $customer = $this->customerService->create($request);

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ], Response::HTTP_CREATED);
    }


    public function update(Request $request, int $id): JsonResponse
    {
        $customer = $this->customerService->update($request, $id);
        return response()->json(['message' => 'Customer updated successfully', 'data' => $customer]);
    }

    public function delete(int $id): JsonResponse
    {
        $result = $this->customerService->delete($id);
        return response()->json(['message' => 'Customer deleted successfully'], Response::HTTP_OK);
    }
    public function export(Request $request)
    {
        $format = $request->input('format', 'json');
        $exporter = ExportFactory::instance($format);
        return $this->customerExportService->export($exporter);
    }
}
