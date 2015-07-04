<?php namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;


class RegisterRequest extends Request {

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
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'dept_name' => 'required',
            'user_type' => 'required',
		];
	}



}
