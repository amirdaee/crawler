<?php

namespace Modules\News\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\News\Entities\Agent;
use Modules\News\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\News\Entities\CrawlTask;
use Modules\News\Entities\News;
use Symfony\Component\DomCrawler\Crawler;

class CategoriesController extends Controller
{
    use ValidatesRequests;
    public $name;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        $i = 0;
        return view('news::categories.index',compact(['categories','i']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return \redirect()->route('news::categories.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:categories',
        ]);
        if(!empty($request->parent_id)){
            $parentCategories = Category::find($request->parent_id);
            if(empty($parentCategories)){
                return redirect()->back()->withErrors('دسته مادر پیدا نشد!');
            }
            $parentCategories->children()->create(['name' => $request->name]);
        }
        else{
            Category::create(['name' => $request->name]);
        }
        return redirect()->back()->with('success','دسته با موفقیت ذخیره شد.');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('news::categories.edit',compact(['category','categories']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $category = Category::find($id);

        if(empty($category)){
            return redirect()->back()->withErrors('دسته پیدا نشد!');
        }
        $parent = Category::find($request->parent_id);

        if(!empty($parent)){
            if($category->id == $parent->id){
                return redirect()->back()->withErrors('دسته و مادر نمی توانند یکی باشد!');
            }
            $category->makeChildOf($parent);
        }

        $category->update(['name' => $request->name]);
        return redirect()->route('categories.index')->with('success','دسته با موفقیت به روز شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(empty($category)){
            return redirect()->back()->withErrors('دسته پیدا نشد!');
        }
        $category->delete();
        return redirect()->back()->with('success','دسته با موفقیت حذف شد.');
    }

    public function crawlCategories(Request $request)
    {

        $categories = Category::all();
        return view('news::categories.crawl',compact(['categories']));

    }

    public function crawlCategoriesCreate(Request $request)
    {
        $this->validate($request, [
            'task_url' => 'required',
            'task_filter' => 'required'
        ]);

        if(!empty($request->parent_id)){
            $parentCategories = Category::find($request->parent_id);
            if(empty($parentCategories)){
                return redirect()->back()->withErrors('دسته مادر پیدا نشد!');
            }
        }
        else{
            $parentCategories = null;
        }
        $client = new Client();
        # Request / or root
        $response = $client->request('GET', $request->task_url);
        $html = $response->getBody()->getContents();

        $html = preg_replace('#<script(.*?)>(.*?)</script>#', '', $html);
        $crawler = new Crawler($html);
        $this->name = collect();
        $befor_text = $request->befor_text;
        $urls = $crawler->filter($request->task_filter)->each(function ($node) use($parentCategories,$befor_text){
            $name = $befor_text.trim($node->text());
            $category = Category::where('name',$name)->first();
            if(empty($category)){
                if (empty($parentCategories)) {
                    Category::create(['name' => $name]);
                }
                else{
                    $parentCategories->children()->create(['name' => $name]);
                    $category = Category::where('name',$name)->first();
                }
                $this->name = $this->name->concat([$name]);
            }
            else{
                return true;
            }

        });
        return redirect()->route('categories.crawl')
            ->with('success','دسته با موفقیت ذخیره شدند.')
            ->with('names', $this->name);
    }

    public function addNewsCategory()
    {
        $tasks = CrawlTask::where('complete',0)
            ->where('task_url','like','%www.isna.ir%')
            ->orderBy('rand_number', 'desc')
            ->take(2);
        $crawlTask = $tasks->get();
//        $tasks->update(['complete' => 1]);
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
            CrawlController::crawl($task);
            sleep(rand(2,5));
        }
        return 'true';
    }
}
