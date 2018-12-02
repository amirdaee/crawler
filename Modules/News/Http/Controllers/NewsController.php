<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\News\Entities\News;
use Symfony\Component\DomCrawler\Crawler;
use Modules\News\Entities\Agent;

class NewsController extends Controller
{
    public $user_model;
    public $user_key;
    public $users;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->user_model = config('news.user_model');
        $this->user_key = config('news.user_id');
        $this->users = new $this->user_model;
    }
    public function index()
    {
        return Redirect::route('home');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return Redirect::route('home');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return Redirect::route('home');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $news = News::find($id);
        if(empty($news)){
            return abort(404);
        }
        return view('news::news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request,$id)
    {
        $news = News::find($id);
        if(empty($news)){
            return abort(404);
        }
        $categories = $news->categories()->get();
        return view('news::news.edit',compact(['news','categories']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

}
