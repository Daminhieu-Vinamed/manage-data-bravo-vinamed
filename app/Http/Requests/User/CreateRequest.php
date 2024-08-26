<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'EmployeeCode' => 'required|max:255|unique:users,EmployeeCode',
            'username' => 'required|string|min:6|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:255',
            're_password' => 'required_with:password|same:password',
            'department_code' => 'required|string',
            'company' => 'required|string',
            'parent_user_id' => 'nullable|integer',
            'role_id' => 'required|integer',
            'gender_id' => 'required|integer',
            'status_id' => 'required|integer',
            'avatar' => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
            'EmployeeCode.required' => 'Chưa điền mã nhân viên Bravo',
            'EmployeeCode.max' => 'Mã nhân viên Bravo tối đa 255 ký tự',
            'EmployeeCode.unique' => 'Mã nhân viên Bravo đã tồn tại',

            'username.required' => 'Chưa điền tên đăng nhập',
            'username.string' => 'Tên đăng nhập phải là chuỗi ký tự',
            'username.min' => 'Tên đăng nhập tối thiểu 6 ký tự',
            'username.max' => 'Tên đăng nhập tối đa 255 ký tự',
            'username.unique' => 'Tên đăng nhập đã tồn tại',

            'name.required' => 'Chưa điền họ và tên',
            'name.string' => 'Họ và tên phải là chuỗi ký tự',
            'name.max' => 'Họ và tên tối đa 255 ký tự',

            'email.required' => 'Chưa điền E-mail',
            'email.email' => 'E-mail không đúng định dạng',
            'email.max' => 'E-mail tối đa 255 ký tự',
            'email.unique' => 'E-mail đã tồn tại',

            'password.required' => 'Chưa điền mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 255 ký tự',

            're_password.required_with' => 'Chưa xác nhận mật khẩu',
            're_password.same' => 'Xác nhận mật khẩu không đúng',

            'department_code.required' => 'Chưa chọn phòng ban',
            'company.required' => 'Chưa chọn công ty',
            'role_id.required' => 'Chưa chọn vai trò',
            'gender_id.required' => 'Chưa chọn giới tính',
            'status_id.required' => 'Chưa chọn trạng thái',
            
            'avatar.image' => 'Ảnh đại diện không đúng định dạng',
        ];
    }
}