<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewRequest;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Image;

class NewsController extends Controller
{
	public function index(Request $req){
		$news = News::all();
		if ( $req->ajax() ) {
			return view('news.table', compact('news'));
		}
		return view('news.index', compact('news'));
	}

	public function form($id = null){
		$new = new News();
		if ( $id ) {
			$new = News::findOrFail($id);
		}
		return view('news.form', compact('new'));
	}

	public function store(NewRequest $req){
		$new = new News();
		$new->title = $req->title;
		$new->content = $req->content;
		$new->photo = $photo = time().'.'.$req->file('photo')->getClientOriginalExtension();

		if ( $new->save() ){
			$this->uploadFile('/img/news/', $req->file('photo'), $photo);
			return Redirect()->route('News')->with('msg', __('panel.s-create-item', ['item' => __('panel.new')]));
		} else {
			return Redirect()->back()->with('msg', __('panel.e-create-item', ['item' => __('panel.new')]));
		}
	}

	public function update(NewRequest $req, $id){
		$new = News::find($id);
		$new->title = $req->title;
		$new->content = $req->content;

		if ( $req->file('photo') ){
			$this->deleteFiles($new->photo);
			$new->photo = $photo = time().'.'.$req->file('photo')->getClientOriginalExtension();
			$this->uploadFile('/img/news/', $req->file('photo'), $photo);
		}

		if ( $new->save() ){
			return Redirect()->route('News')->with('msg', __('panel.s-update-item', ['item' => __('panel.new')]));
		} else {
			return Redirect()->back()->with('msg', __('panel.e-update-item', ['item' => __('panel.new')]));
		}
	}

	public function destroy($id){
		$new = News::find($id);
		if ( $new ) {
			$this->deleteFiles($new->photo);
			News::destroy($id);
			return ['delete' => 'true'];
		} else {
			return ['delete' => 'false'];
		}
	}

	public function multipleDestroys(NewRequest $req){
		$news = News::whereIn('id', $req->ids)->get();
		if ( $news ){
			$news->each(function($new, $key){
				$this->deleteFiles($new->photo);
				News::destroy($new->id);
			});
			return ["delete" => "true"];
		}
		return ['delete' => 'false'];
	}

	public function status(Request $req){
		$new = News::find($req->id);
		$new->status = $new->status?0:1;
		if ( $new->save() ) {
			return ['status' => true];
		} else {
			return ['status' => false];
		}
	}
}
