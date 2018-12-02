<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\News\Entities\Agent;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class AgentController extends Controller
{

    public $urls;
    public $texts;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $agents = Agent::all();
        return view('news::agent.index',compact('agents'))->with('i',0);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return \redirect()->route('categories.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:agents',
            'base_url' => 'required|url',
            'task_url' => 'required|url',
            'task_filter' => 'required',
            'title_filter' => 'required',
            'content_filter' => 'required',
        ]);
        $agent = new Agent();
        $agent->name = $request->name;
        $agent->base_url = $request->base_url;
        $agent->title_filter = $request->title_filter;
        $agent->content_filter = $request->content_filter;
        $agent->task_url = $request->task_url;
        $agent->task_filter = $request->task_filter;
        $agent->category_filter = $request->category_filter;
        $agent->save();
        $agents = Agent::all();
        return view('news::agent.index',compact('agents'))->with('i',0);

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $agent = Agent::find($id);
        return view('news::agent.show',compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $agent = Agent::find($id);
        if (empty($agent)){
            return Redirect::route('agent.index')->withErrors('خبرگزاری مورد نظر در دسترس نیست.');
        }
        return view('news::agent.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'base_url' => 'required|url',
            'task_url' => 'required|url',
            'task_filter' => 'required',
            'title_filter' => 'required',
            'content_filter' => 'required',
        ]);

        $agent = Agent::find($id);
        $agent->update($request->all());
        return redirect()->route('agent.index')
            ->with('success','خبرگزاری با موفقیت اصلاح شد');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $agent = Agent::find($id);
        if (empty($agent)){
            return Redirect::route('agent.index')->withErrors('خبرگزاری مورد نظر در دسترس نیست.');
            }
        $agent->delete();
        return redirect()->route('agent.index')
            ->with('success','خبرگزاری با موفقیت حذف شد');

    }

    public function task(Request $request)
    {
        $agent = $request->all();
        if($request->has('task')){
            $this->validate($request, [
                'task_url' => 'required',
                'task_filter' => 'required'
            ]);
            $client = new Client();
            # Request / or root
            $response = $client->request('GET', $request->task_url);
            $html = $response->getBody()->getContents();

            $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
            $crawler = new Crawler($html);

            $this->urls = collect([]);
            $urls = $crawler->filter($request->task_filter)->each(function ($node) use($request) {
                $link = $node->attr('href');
                if (substr($link, 0,1) == "/") {
                    $task_link = $request->base_url.substr($link,1);
                }
                else{
                    $task_link = $link;
                }
                $this->urls = $this->urls->concat([$task_link]);
            });

            $this->texts = collect([]);
            $texts = $crawler->filter($request->task_filter)->each(function ($node) use($request) {
                $text = trim($node->text());
                $this->texts = $this->texts->concat([$text]);
            });

            $urls = $this->urls;
            $texts = $this->texts;
            return view('news::agent.task',compact(['agent','urls','texts']));

        }
        else{
            return view('news::agent.task');
        }
    }

    public function news(Request $request)
    {
        $agent = $request->all();
        if($request->has('news')){
            $this->validate($request, [
                'url' => 'required',
                'title_filter' => 'required',
                'content_filter' => 'required'
            ]);

            $client = new Client();
            # Request / or root
            $response = $client->request('GET', $request->url);
            $html = $response->getBody()->getContents();


            $html = preg_replace('#<script type="text/javascript"(.*?)>(.*?)</script>#', '', $html);
            $crawler = new Crawler($html);
            $title = $crawler->filter($request->title_filter)->text();
            $content = $crawler->filter($request->content_filter)->text();
            $category = "";
            if(!empty($request->category_filter)){
                $category = $crawler->filter($request->category_filter)->text();
            }

            return view('news::agent.news',compact(['agent','title','content','category']));

        }
        else{
            return view('news::agent.news');
        }
    }
}
