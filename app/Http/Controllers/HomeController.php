<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Modules\News\Entities\Agent;
use Modules\News\Entities\Category;
use Modules\News\Entities\CrawlTask;
use Modules\News\Entities\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //خبر فارسی لینک اخبار
        //http://khabarfarsi.com/u/50005554
        //1397
        //https://khabarfarsi.com/u/5257757

        $agentNumber = Agent::count();
        $taskNumber = CrawlTask::count();
        $newsNumber = News::count();
        $categoryNumber = Category::count();

        $news = News::where('agent_id','<','10')->orderBy('id', 'desc')->take(1)->first();
        $id = $news->id - 600;
        $news = News::where('id','>',$id)->orderBy('id', 'desc')->paginate(30);
        return view('home',compact(['news','taskNumber','newsNumber','categoryNumber','agentNumber']));
    }
    public function welcome(Request $request)
    {
        //خبر فارسی لینک اخبار
        //http://khabarfarsi.com/u/50005554
        //1397
        //https://khabarfarsi.com/u/52577571
        $news = News::where('agent_id','<','10')->orderBy('id', 'desc')->take(1)->first();
        $id = $news->id - 120;
        $news = News::where('id','>',$id)->orderBy('id', 'desc')->paginate(9);
        return view('welcome',compact('news'));
    }

}
