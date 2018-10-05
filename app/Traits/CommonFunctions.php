<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Mail;
use Image;

trait CommonFunctions
{
	/*
	* Descrición: Función para enviar correo electrónico;
	* Parametros: arreglo params (view: vista del email, email: correo destino, subjet: asunto del correo, title: titulo dentro del correo, content: cuerpo del correo, etc)
	* return boolean, true exito al enviar correo, false error al enviar correo
	*/
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

	/*
	* Descrición: Función para subir archivos y crear carpetas;
	* Parametros: ruta destino, archivo, dimensiones (width, height)
	* return boolean
	*/
	public function uploadFile($path, $file, $filename, $fit = null){
		$path = public_path().$path;

		if ( !File::exists($path) ) {
			File::makeDirectory($path, 0777, true, true);
		}

		if ( $fit ) {
			$img = Image::make($file)->fit($fit[0], $fit[1])->save($path."/".$filename);
		} else {
			$img = Image::make($file)->save($path."/".$filename);
		}
	}

	/*
	* Descrición: Función eliminar archivos;
	* Parametros: Ruta relativa del archivo
	* return void
	*/
	public function deleteFiles($path){
		$fullPath = public_path() . $path;
		if ( File::exists($fullPath) ){
			File::delete($fullPath);
		}
	}

	/*
	* Descrición: Función limpiar o eliminar carpetas;
	* Parametros: Ruta relativa del directoria, acción (1 limpiar, 2 eliminar)
	* return void
	*/
	public function deleteDirectories($path, $action){
		$fullpath = public_path() . $path;
		if ( File::exists($path) ){
			if ( $action == 1 ){
				File::cleanDirectory($fullPath."/");
			} elseif( $action == 2 ){
				File::deleteDirectory($fullPath."/");
			}
		}
	}
}