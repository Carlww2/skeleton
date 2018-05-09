<?php

namespace App\Http\Middleware;

use Closure;

class SetLanguage
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( $request->user()->lang == 'es' ) {
			app()->setLocale('es');
		} elseif( $request->user()->lang == 'en' ) {
			app()->setLocale('en');
		} else {
			app()->setLocale('es');
		}

		return $next($request);
	}
}
