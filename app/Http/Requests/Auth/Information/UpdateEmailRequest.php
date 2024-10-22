<?php

namespace App\Http\Requests\Auth\Information;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Chưa điền E-mail',
            'email.email' => 'E-mail không đúng định dạng',
            'email.max' => 'E-mail tối đa 255 ký tự',
            'email.unique' => 'E-mail đã tồn tại',
        ];
    }
}