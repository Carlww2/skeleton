<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mail;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	 public function mail($params){
		$params['view'] = @$params['view']?$params['view']:'mails.general';
		Mail::send($params['view'], ['title' => $params['title'], 'content' => $params['content']], function ($message) use($params)
		{
			$message->to($params['email']);
			$message->from(env('MAIL_USERNAME'), env('APP_NAME'));
			$message->subject(env('APP_NAME').' | '.$params['subject']);
		});
		if ( !Mail::failures() ){
			return true;
		}
		return false;
	}
}