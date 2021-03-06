<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserRequest extends FormRequest
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
		switch($this->method()) {
			case 'GET':
			case 'DELETE':
				return [];
			case 'POST':
				if ( !$this->ajax() ){
					return [
						'fullname'  => 'required|regex:/^[\pL\s]+$/u|min:3',
						'email' => 'required|email|min:8|unique:users',
						'password' => 'required|min:8',
					];
				} else {
					if ( $this->social ){
						return [
							'email' => 'required|email|unique:users,email,1,social',
						];
					}
					return [
						'fullname'  => 'required|regex:/^[\pL\s]+$/u|min:3',
						'phone' => 'required|numeric|unique:users',
						'email' => 'required|email|unique:users',
						'password' => 'nullable|min:8',
					];
				}
			case 'PUT':
				if ( !$this->ajax() ){
					return [
						'fullname' => 'required|regex:/^[\pL\s]+$/u|min:3',
						'email' => 'required|email|unique:users,email, '.$this->route('id'),
						'password' => 'nullable|min:8',
					];
				} else {
					return [
						'fullname' => 'required|regex:/^[\pL\s]+$/u|min:3',
						'phone' => 'required|numeric|unique:users,phone, '.$this->route('id'),
						'email' => 'required|email|unique:users,email, '.$this->route('id'),
						'password' => 'nullable|min:8',
					];
				}
			default:break;
		}
	}

	public function response(array $errors)
	{
		if ($this->expectsJson() || $this->ajax()) {
			return new JsonResponse($errors, 422);
		}

		return $this->redirector->to($this->getRedirectUrl())
				->withInput()
				->withErrors($errors, 'user');
	}
}
