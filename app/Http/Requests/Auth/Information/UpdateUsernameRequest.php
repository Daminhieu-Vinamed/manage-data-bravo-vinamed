<?php

namespace App\Http\Requests\Auth\Information;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsernameRequest extends FormRequest
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
            'username' => 'required|string|min:4|max:255|unique:users,username,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Chưa điền tên đăng nhập',
            'username.string' => 'Tên đăng nhập phải là chuỗi ký tự',
            'username.min' => 'Tên đăng nhập tối thiểu 4 ký tự',
            'username.max' => 'Tên đăng nhập tối đa 255 ký tự',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
        ];
    }
}