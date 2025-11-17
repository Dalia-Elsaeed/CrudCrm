<?php

namespace App\Http\Middleware;

use Closure;
use Ramsey\Uuid\Uuid;

/**
 * RequestId Middleware
 * 
 * الـ Middleware ده بيشتغل على كل Request قبل ما يوصل للـ Controller
 * وظيفته: يضيف رقم تعريف فريد (UUID) لكل طلب
 */
class RequestId
{
    /**
     * handle() - الدالة اللي بتشتغل على كل Request
     * 
     * @param \Illuminate\Http\Request $request - الطلب اللي جاي من المستخدم
     * @param Closure $next - الخطوة اللي بعد كده
     * @return mixed - الاستجابة (Response)
     */
    public function handle($request, Closure $next)
    {
        // 1. شوف لو المستخدم بعت Request ID في الـ Header
        $uuid = $request->headers->get('X-Request-ID');
        
        // 2. لو مفيش Request ID، اعمل واحد جديد
        if (is_null($uuid)) {
            // إنشاء UUID فريد (مثال: 550e8400-e29b-41d4-a716-446655440000)
            $uuid = Uuid::uuid4()->toString();
            
            // إضافة الـ UUID للـ Request Headers
            $request->headers->set('X-Request-ID', $uuid);
        }
        
        // 3. كمل معالجة الطلب (روح للـ Controller مثلاً)
        $response = $next($request);
        
        // 4. أضف نفس الـ UUID للـ Response Headers عشان المستخدم يشوفه
        $response->headers->set('X-Request-ID', $uuid);
        
        // 5. ارجع الاستجابة
        return $response;
    }
}

/**
 * ملخص:
 * ------
 * - الـ Middleware ده بيشتغل على كل Request
 * - بيضيف رقم تعريف فريد (UUID) لكل طلب
 * - لو المستخدم بعت UUID، بيستخدمه
 * - لو مبعتش، بينشئ واحد جديد
 * - الـ UUID ده بيساعد في تتبع الطلبات في اللوجات
 * 
 * مثال على UUID:
 * 550e8400-e29b-41d4-a716-446655440000
 * 
 * فايدته:
 * - لو حصل خطأ، تقدر تدور على الـ Request ID ده في اللوجات
 * - بيساعد في تتبع الأخطاء وحل المشاكل
 */