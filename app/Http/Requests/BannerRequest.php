<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
				return [
					'image' => 'required|mimes:jpeg,png,jpg,gif',
				];
			case 'PUT':
				return [
					'image' => 'present|mimes:jpeg,png,jpg,gif',
				];
			default:break;
		}
	}

	public function response(array $errors)
	{
		if ($this->expectsJson()) {
			return new JsonResponse($errors, 422);
		}

		return $this->redirector->to($this->getRedirectUrl())
				->withInput()
				->withErrors($errors, 'banner');
	}
}
