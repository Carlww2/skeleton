<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\File;
use App\Models\Banner;
use Image;

class BannersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req)
	{
		$banners = Banner::all();
		if ( $req->ajax() ) {
			return view('banners.table', compact('banners'));
		}
		return view('banners.index', compact('banners'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function form($id = null)
	{
		$banner = new Banner();
		if ( $id ){
			$banner = Banner::find($id);
		}
		return view('banners.form', compact('banner'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $req
	 * @return \Illuminate\Http\Response
	 */
	public function store(BannerRequest $req)
	{
		$banner = new Banner();
		$banner->image = $image = time().'.'.$req->file('image')->getClientOriginalExtension();

		if ( $banner->save() ){
			$this->uploadFile('/img/banners/', $req->file('image'), $image);
			return Redirect()->route('Banner')->with('msg',  __('panel.s-create-item', ['item' => __('panel.banner')]));
		} else {
			return Redirect()->back()->with('msg', __('panel.e-create-item', ['item' => __('panel.banner')]));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $req
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BannerRequest $req, $id)
	{
		$banner = Banner::find($id);
		if ( $req->file('image') ){
			$this->deleteFiles($banner->image);
			$banner->image = $image = time().'.'.$req->file('image')->getClientOriginalExtension();
			$this->uploadFile('/img/banners/', $req->file('image'), $image);
		}

		if ( $banner->save() ){
			return Redirect()->route('Banner')->with('msg', __('panel.s-update-item', ['item' => __('panel.banner')]));
		} else {
			return Redirect()->back()->with('msg', __('panel.e-update-item', ['item' => __('panel.banner')]));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$banner = Banner::find($id);
		if ( $banner ) {
			$this->deleteFiles($banner->image);
			Banner::destroy($id);
			return ['delete' => 'true'];
		} else {
			return ['delete' => 'false'];
		}
	}

	public function multipleDestroys(BannerRequest $req){
		$banners = Banner::whereIn('id', $req->ids)->get();
		if ( $banners ){
			$banners->each(function($banner, $key){
				$this->deleteFiles($banner->image);
				Banner::destroy($banner->id);
			});
			return ["delete" => "true"];
		}
		return ['delete' => 'false'];
	}

	public function status(Request $req){
		$banner = Banner::find($req->id);
		$banner->status = $banner->status?0:1;
		if ( $banner->save() ) {
			return ['status' => true];
		} else {
			return ['status' => false];
		}
	}
}
