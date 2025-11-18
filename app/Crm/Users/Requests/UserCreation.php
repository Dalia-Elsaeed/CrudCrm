<?php
namespace Crm\Users\Requests;

use Crm\Base\Requestes\ApiRequest;


class UserCreation extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules()
   {
     return [
         'name' => 'required|string|min:2|max:255',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|string|min:6'
     ];
   }
}
