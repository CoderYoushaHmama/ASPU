<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentTypeRequest;
use App\Models\PayType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentTypeController extends Controller
{
    //Add Payment Type Function
    public function addPaymentType(PaymentTypeRequest $paymentTypeRequest)
    {
        PayType::create([
            'created_by' => Auth::guard('user')->user()->id,
            'name' => $paymentTypeRequest->name,
            'description' => $paymentTypeRequest->description,
        ]);

        return success(null, 'this payment method added successfully', 201);
    }

    //Edit Payment Type Function
    public function editPaymentType(PayType $payType, PaymentTypeRequest $paymentTypeRequest)
    {
        $payType->update([
            'name' => $paymentTypeRequest->name,
            'description' => $paymentTypeRequest->description,
        ]);

        return success(null, 'this payment method updated successfully');
    }

    //Delete Payment Type Function
    public function deletePaymentType(PayType $payType)
    {
        $payType->delete();

        return success(null, 'this payment method deleted successfully');
    }

    //Get Payment Types Function
    public function getPaymentTypes()
    {
        $payTypes = PayType::get();

        return success($payTypes, null);
    }

    //Get Payment Type Function
    public function getPaymentTypeInformation(PayType $payType)
    {
        return success($payType, null);
    }
}