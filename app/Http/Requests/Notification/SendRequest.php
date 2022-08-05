<?php

namespace App\Http\Requests\Notification;

use App\Helpers\Functions;
use App\Http\Requests\ApiRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class SendRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'title'=>'required|string|max:255',
            'body'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'title'=>__('models.Notification.title'),
            'body'=>__('models.Notification.body'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customers = (new Customer())->whereNotNull('device_token')->pluck('device_token')->toArray();
        $CustomersChunks = array_chunk($Customers,1000);
        foreach ($CustomersChunks as $CustomersChunk)
            Functions::SendNotifications($CustomersChunk,$this->title,$this->body,Notification::TargetTypes['Customer'],Notification::RefTypes['General']);
        $Vendors = (new Vendor())->whereNotNull('device_token')->pluck('device_token')->toArray();
        $VendorsChunks = array_chunk($Vendors,1000);
        foreach ($VendorsChunks as $VendorsChunk)
            Functions::SendNotifications($VendorsChunk,$this->title,$this->body,Notification::TargetTypes['Vendor'],Notification::RefTypes['General']);
        $Employees = (new Employee())->whereNotNull('device_token')->pluck('device_token')->toArray();
        $EmployeesChunks = array_chunk($Employees,1000);
        foreach ($EmployeesChunks as $EmployeesChunk)
            Functions::SendNotifications($EmployeesChunk,$this->title,$this->body,Notification::TargetTypes['Vendor'],Notification::RefTypes['General']);
        return $this->success_response([__('messages.created_successful')]);
    }
}
