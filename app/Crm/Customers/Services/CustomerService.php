<?php

namespace Crm\Customers\Services;

use Crm\Customers\Repositories\CustomerRepository;
use Crm\Customers\Events\CustomerCreation;
use Crm\Customers\Models\Customer;
use Illuminate\Http\Request;


class CustomerService
{
    private CustomerRepository $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function index()
    {
        // جيب كل العملاء من قاعدة البيانات
        return  $this->customerRepository->all();
    }


    public function show($id)
    {
        // دور على العميل، لو مش موجود ارجع رسالة 404
        // return Customer::find($id) ?? response()->json(['status' => 'Not found'], 404);
        return $this->customerRepository->find($id);
    }


    public function create(Request $request): Customer
    {
        // 1. إنشاء عميل جديد
        $customer = new Customer();
        $customer->name = $request->get('name');
        // $customer->email = $request->get('email');  // لو عايز تضيف إيميل
        // $customer->phone = $request->get('phone');  // لو عايز تضيف تليفون

        // 2. حفظ العميل في قاعدة البيانات
        $customer->save();

        // 3. إرسال حدث "تم إنشاء عميل جديد"
        // ده هينادي على NotifySalesOnCustomerCreation تلقائياً
        // dd(\Event::getListeners(\Crm\Customers\Events\CustomerCreation::class));

        // event(new CustomerCreation($customer));

        // 4. إرجاع العميل الجديد
        return $customer;
    }

    public function update(Request $request, $id)
    {
        // 1. جيب العميل من قاعدة البيانات
        $customer = Customer::find($id);

        // 2. لو مش موجود، ارجع رسالة 404
        if (!$customer) {
            return response()->json(['status' => 'Not found'], 404);
        }

        // 3. عدل البيانات
        $customer->name = $request->get('name');
        // $customer->email = $request->get('email');
        // $customer->phone = $request->get('phone');

        // 4. احفظ التعديلات
        $customer->save();

        // 5. ارجع العميل المعدل
        return $customer;
    }


    public function delete($id)
    {
        // 1. جيب العميل
        $customer = Customer::find($id);

        // 2. لو مش موجود، ارجع رسالة 404
        if (!$customer) {
            return response()->json(['status' => 'Not found'], 404);
        }

        // 3. احذف العميل
        $customer->delete();

        // 4. ارجع رسالة نجاح
        return response()->json(['status' => 'Deleted successfully']);
    }
}

