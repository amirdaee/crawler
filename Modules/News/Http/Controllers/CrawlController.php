<?php

namespace Modules\News\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\News\Entities\Agent;
use Modules\News\Entities\Category;
use Modules\News\Entities\CategorySuggestion;
use Modules\News\Entities\CrawlTask;
use Symfony\Component\DomCrawler\Crawler;
use Modules\News\Entities\News;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class CrawlController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tasks = CrawlTask::where('complete',0)
            ->orderBy('rand_number', 'desc')
            ->take(8);
        $crawlTask = $tasks->get();
        $tasks->update(['complete' => 1]);
        if(count($crawlTask) == 0){
            $now = Carbon::now();
            $last = $now->subDay(2);
            $crawlTask =  CrawlTask::where('complete',1)
                ->where('created_at','>',$last)
                ->orderBy('rand_number', 'desc')
                ->orderBy('id','desc')
                ->take(3)
                ->get();
        }
        foreach ($crawlTask as $task){
            $this->crawl($task);
            sleep(rand(2,5));
        }
        return 'true';
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
    public static function crawl($task)
    {
        try{
            $e_url = explode("/",$task->task_url);
            $agent = Agent::where('base_url','like','%'.$e_url[2].'%')->first();
            $client = new Client();
            # Request / or root
            $response = $client->request('GET', $task->task_url);
            $html = $response->getBody()->getContents();


            $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
            $crawler = new Crawler($html);

            $title = $crawler->filter($agent->title_filter);
            $content = $crawler->filter($agent->content_filter);

            $news = new News();
            $news->title = trim(trim(preg_replace('/\s+/', ' ', $title->text())));
            $news->content = trim(trim(preg_replace('/\s+/', ' ', $content->text())));
            $news->user_id = 1;
            $news->agent_id = $agent->id;
            $news->crawl_task_id = $task->id;
            $news->save();

            if(!empty($agent->category_filter)){
                try{
                    $category_name = trim($crawler->filter($agent->category_filter)->text());
                    if(!empty($category_name)){
                        $category = Category::where('name',$category_name)->first();
                        dump($category);
                        if(!empty($category)){
                            $news->categories()->attach($category->id);
                        }
                        else{
                            $suggestion = CategorySuggestion::where('name',$category_name)->first();
                            if(empty($suggestion)){
                                $suggestion = CategorySuggestion::create([
                                    'name' => $category_name,
                                    'url' => $task->task_url
                                ]);
                            }
                        }
                    }
                }
                catch (\Exception $e){
                    dump($e);
                    echo 'تگ مورد نظر یافت نشد.';
                }
            }

            $task->complete = 2;
            $task->save();
            return 'true';
        }
        catch (\Exception $e){
            $task->error = $e->getMessage();
            $task->complete = 2;
            $task->save();
            return 'false';
        }

    }

    public function testCrawler()
    {
        $task_url ="http://www.tsetmc.com/Loader.aspx?ParTree=151311&i=6110133418282108";
        $task_url ="http://www.tsetmc.com/Loader.aspx?ParTree=151311&i=778253364357513";
        $task_url ="http://www.tsetmc.com/tsev2/excel/MarketWatchPlus.aspx?deven=0";
        $task_url ="http://www.asriran.com/fa/news/638674/نتانیاهو-از-ترامپ-بخاطر-اقدام-تاریخی-علیه-ایران-تشکر-می-کنم";
//        http://www.tsetmc.com/tsev2/chart/data/IntraDayPrice.aspx?i=28320293733348826    //csv file
//        http://www.tsetmc.com/tsev2/data/instinfofast.aspx?i=28320293733348826&c=57+
//        $html = file_get_contents($task_url);
//        $content = gzinflate( substr($html,10,-8) );

        try{
            $e_url = explode("/",$task_url);
            $agent = Agent::where('base_url','like','%'.$e_url[2].'%')->first();
            $client = new Client();
            # Request / or root
            $response = $client->request('GET', $task_url);
            $html = $response->getBody()->getContents();


            $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
            $crawler = new Crawler($html);

            $title = $crawler->filter($agent->title_filter);
            $content = $crawler->filter($agent->content_filter);
            dump(trim($title->text()));
            dump(trim($content->text()));

            return;
        }
        catch (\Exception $e){
            dump($e->getMessage());
            return;
        }
    }

    public function addCrawlTaskId()
    {
        $tasks = DB::table('crawl_tasks')
            ->leftJoin('news','crawl_tasks.id','=','news.crawl_task_id')
            ->whereNull('news.crawl_task_id')
            ->whereNull('crawl_tasks.error')
            ->where('crawl_tasks.complete','=',1)
            ->orderBy('crawl_tasks.rand_number', 'asc')
            ->orderBy('crawl_tasks.id', 'asc')
            ->select('crawl_tasks.id')
            ->get();

        foreach ($tasks as $task){
            $task = CrawlTask::find($task->id);
            $this->crawlId($task);
            sleep(rand(1,4));
        }
        return;
    }

    public function crawlId($task)
    {
        try{
            $e_url = explode("/",$task->task_url);
            $agent = Agent::where('base_url','like','%'.$e_url[2].'%')->first();
            $client = new Client();
            # Request / or root
            $response = $client->request('GET', $task->task_url);
            $html = $response->getBody()->getContents();


            $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
            $crawler = new Crawler($html);

            $title = $crawler->filter($agent->title_filter);

            $news = News::where('title',trim($title->text()))->first();
            if(!empty($news)){
                $news->crawl_task_id = $task->id;
                $news->save();
            }
            else{
                $this->crawl($task);
            }
            return;
        }
        catch (\Exception $e){
            $task->error = $e->getMessage();
            $task->complete = 2;
            $task->save();
            return;
        }

    }
}
