<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use App\Enums\ShippingMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateOrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerName' => 'bail|required',
            'customerEmail' => 'bail|required|email',
            'shippingMethod' => ['bail', 'required', new Enum(ShippingMethod::class)],

            'billingAddress.name' =>'bail|required',
            'billingAddress.postcode' =>'bail|required',
            'billingAddress.city' =>'bail|required',
            'billingAddress.street' =>'bail|required',

            'shippingAddress.name' =>'bail|required',
            'shippingAddress.postcode' =>'bail|required',
            'shippingAddress.city' =>'bail|required',
            'shippingAddress.street' =>'bail|required',

            'products.*.name' => 'bail|required',
            'products.*.quantity' => 'bail|required|numeric|min:1',
            'products.*.unitPrice' => 'bail|required|numeric|min:1'
        ];
    }
}
