<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\News\Entities\Agent;
use Symfony\Component\DomCrawler\Crawler;
use Modules\News\Entities\CrawlTask;
use GuzzleHttp\Client;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $agents = Agent::all();
//        $agents = Agent::where('id',2)->get();

        foreach ($agents as $agent){
            $client = new Client();
            # Request / or root
            $response = $client->request('GET', $agent->task_url);
            $html = $response->getBody()->getContents();

            $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
            $crawler = new Crawler($html);
            $urls = $crawler->filter($agent->task_filter)->each(function ($node) use($agent) {
                $link = $node->attr('href');
                if (substr($link, 0,1) == "/") {
                    $task_link = $agent->base_url.substr($link,1);
                }
                else{
                    $task_link = $link;
                }
                $value = $this->createCrawlTask($task_link,$agent->id);
                if(!$value){
                    return;
                }
            });
        }

//        $content = $crawler->filter($agent->content_filter);

        return;
        return view('news::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('news::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('news::edit');
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
    public function createCrawlTask($task_link,$agent_id)
    {
        $task = CrawlTask::where('task_url',$task_link)->first();
        if(empty($task)){
            $task = new CrawlTask();
            $task->task_url = $task_link;
            $task->rand_number = rand(1,200);
            $task->save();
            return true;
        }
        else{
            return false;
        }

    }

    public function testTask()
    {
        $agent = Agent::find(2);
        $client = new Client();
        # Request / or root
        $response = $client->request('GET', $agent->task_url);
        $html = $response->getBody()->getContents();

        $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
        $crawler = new Crawler($html);
        $i = 0;
        $urls = $crawler->filter($agent->task_filter)->each(function ($node) use($agent,$i) {
            $t = $i;
            $link = $node->attr('href');
            if (substr($link, 0,1) == "/") {
                $task_link = $agent->base_url.substr($link,1);
                dump($task_link);
            }
            else{
                $task_link = $link;
                dump($task_link);
            }
        });
        return;
    }
}
