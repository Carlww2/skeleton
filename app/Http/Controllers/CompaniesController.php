<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Company;
use Image;

class CompaniesController extends Controller
{
	public function index(){
		$company = Company::first();
		return view('company.index', compact('company'));
	}

	public function update($id, Request $req){
		$company = Company::findOrFail($id);
		$company->fill( $req->except('logo') );

		if ( $req->hasFile('logo') ){
			$path = public_path()."/img/company";
			if( !File::exists($path) ) {
				File::makeDirectory(public_path()."/img/company/", 0777, true, true);
			} else {
				File::cleanDirectory(public_path()."/img/company/");
			}
			$company->logo = time().'.'.$req->file('logo')->getClientOriginalExtension();
			Image::make($req->file('logo'))->save($path.'/'.$company->logo);
		}

		if ( $company->save() ){
			return Redirect()->route('Company')->with('msg', 'Información actualizada');
		} else {
			return Redirect()->back()->with('Company', 'Error al actualizar la información');
		}
	}
}
