<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|min:3', // min:3 không được để trống 3 kí tự
            'phone' => 'required|min:3',
            'email' => 'required|email|unique:user_form,email,' . $request->get('id'), // báo lỗi khi trùng email 
            // $request->get('id') tránh báo lỗi lại gmail khi ko sửa gmail
            'status' => 'required',
        ];

    }
    public function messages()
    {
        return[
            'name.required' => 'khong duoc de trong',
            'name.min' => 'nhap tren 3 ky tu',
            'email.unique' => 'Trung roi!!!',
            'status.required' => 'khong duoc de trong',
        ];
    }
}
