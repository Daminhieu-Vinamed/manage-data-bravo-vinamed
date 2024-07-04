<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            "old_password" => [
                "required",
                function ($attribute, $value, $fail) {
                    $id = Auth::user()->id;
                    $user = User::find($id);
                    if (!Hash::check($value, $user->password)) {
                        $fail('Mật khẩu cũ không đúng');
                    }
                },
            ],
            "new_password" => "required|min:6|max:255|different:old_password",
            "re_new_password" => "required|same:new_password",
        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => 'Chưa nhập mật khẩu cũ',
            'new_password.required' => 'Chưa nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'new_password.max' => 'Mật khẩu tối đa 255 ký tự',
            're_new_password.required' => 'Chưa nhập lại mật khẩu mới',
            're_new_password.same' => 'Xác nhận mật khẩu mới chưa đúng',
        ];
    }
}