<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRequest extends FormRequest
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
					'title'  => 'required|unique:news',
					'content' => 'required',
					'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:3070',
				];
			case 'PUT':
				return [
					'title' => 'required|unique:news,title,'.$this->route('id'),
					'content' => 'required',
					'photo' => 'present|file|image|mimes:jpeg,png,jpg,gif|max:3070',
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
				->withErrors($errors, 'new');
	}
}
