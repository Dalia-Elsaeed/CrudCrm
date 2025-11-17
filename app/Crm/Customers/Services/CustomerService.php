<?php

namespace Crm\Customers\Services;

use Crm\Customers\Events\CustomerCreation;
use Crm\Customers\Models\Customer;
use Illuminate\Http\Request;

/**
 * CustomerService - خدمة إدارة العملاء
 * الملف ده فيه كل العمليات الخاصة بالعملاء (إضافة، عرض، تعديل، حذف)
 */
class CustomerService
{

    public function index()
    {
        // جيب كل العملاء من قاعدة البيانات
        return Customer::all();
    }

    /**
     * عرض عميل واحد بالـ ID
     * @param int $id - رقم العميل
     * @return Customer|JsonResponse
     */
    public function show($id)
    {
        // دور على العميل، لو مش موجود ارجع رسالة 404
        return Customer::find($id) ?? response()->json(['status' => 'Not found'], 404);
    }

    /**
     * إنشاء عميل جديد
     * @param Request $request - البيانات اللي جاية من الـ Form
     * @return Customer - العميل الجديد
     */
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

    /**
     * تعديل بيانات عميل
     * @param Request $request - البيانات الجديدة
     * @param int $id - رقم العميل
     * @return Customer|JsonResponse
     */
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

    /**
     * حذف عميل
     * @param int $id - رقم العميل
     * @return JsonResponse
     */
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

/**
 * ملخص الوظائف:
 * ---------------
 * index()  → عرض كل العملاء
 * show()   → عرض عميل واحد
 * create() → إضافة عميل جديد + إرسال إشعار
 * update() → تعديل بيانات عميل
 * delete() → حذف عميل
 */
