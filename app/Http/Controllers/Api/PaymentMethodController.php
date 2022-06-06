<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentMethod\PaymentMethodRequest;
use App\Http\Resources\Api\PaymentMethod\PaymentMethodResource;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        return PaymentMethodResource::collection($request->user()->paymentMethods->load('user'));
    }

    public function store(PaymentMethodRequest $request)
    {
        $payment = PaymentMethod::make($request->validated());

        $request->user()->paymentMethods()->save($payment);

        return new PaymentMethodResource($payment);
    }

    public function show(PaymentMethod $paymentMethod)
    {
        return new PaymentMethodResource($paymentMethod);
    }

    public function update(PaymentMethod $paymentMethod, PaymentMethodRequest $paymentMethodRequest)
    {
        $paymentMethod->update($paymentMethodRequest->validated());

        return new PaymentMethodResource($paymentMethod);
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return response()->json(['message' => 'payment Deleted successfully']);
    }
}
