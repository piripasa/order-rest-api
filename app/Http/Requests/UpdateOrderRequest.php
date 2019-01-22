<?php

namespace App\Http\Requests;

class UpdateOrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required|in:TAKEN'
        ];
    }
}
