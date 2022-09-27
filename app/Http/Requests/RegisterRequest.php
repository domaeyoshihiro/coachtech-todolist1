<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'min:8', 'max:191', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:191', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '文字列で入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.min' => 'メールアドレスは8文字以上で入力してください',
            'email.max' => '191文字以下で入力してください',
            'email.unique' => 'このメールアドレスはすでに登録されています',

            'password.required' => 'パスワードを入力してください',
            'password.string' => '文字列で入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.max' => 'パスワードは191文字以下で入力してください',
            'password.confirmed' => 'パスワードが一致していません',

            'password_confirmation.required' => '確認用パスワードが入力されていません',
        ];
    }
}
