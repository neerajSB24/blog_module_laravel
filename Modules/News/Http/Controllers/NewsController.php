<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Http\Controllers\BlogController;
use Modules\News\Entities\News;
use Modules\News\Http\Requests\NewsPostRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    protected $news;

    public function __construct(News $news, Blog $blog)
    {
        $this->news = $news;
        $this->blog = $blog;
    }

    public function index()
    {
        $news = $this->news->paginate(4);

        $blogsModule = new BlogController();
        $blog = $blogsModule->show(1);

        if($news)
        {
            return response()->json(['status'=>1,'message' => 'success', 'blog_res'=>$blog, 'data'=>$news], 200);
        }
        return response()->json(['status'=>0,'message' => 'No record found.','blog_res'=>'', 'data'=>array()], 204);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('news::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(NewsPostRequest $request)
    {
        $input = $request->all();
        $news = News::create($input);

        return response()->json(['status'=>1,'message'=>'News added successfully.'], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $news = $this->blogs->find($id);
        if($news)
        {
            return response()->json(['status'=>1,'message'=>'Success', 'data'=>$news], 200);
        }
        return response()->json(['status'=>0,'message'=>'News details not found.', 'data'=>array()], 200);
        //return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('news::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(NewsPostRequest $request, $id)
    {
        $input = $request->all();

        $title = $request->json('title');
        $description = $request->json('description');
        $is_published = $request->json('is_published');

        $news = $this->blogs->find($id);
        $news->title  = $title;
        $news->description = $description;
        $news->is_published = $is_published;
        $news->update();
        return response()->json(['status'=>1, 'message'=>'News updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $news = $this->news->find($id);
        if($news)
        {
            $news->delete();
            return response()->json(['status'=>1,'message'=>'News deleted successfully.'], 200);
        }
        return response()->json(['status'=>0, 'message'=>'News failed to delete.'], 204);
    }


    public function blog()
    {
        $blogsModule = new BlogController($this->blog);
        $blog = $blogsModule->show(1);

        if($blog)
        {
            //return view('blog::create');
            return view('news::create');
        }
        else
        {
            return response()->json(['status'=>0, 'message'=>'something went wrong.'], 204);
        }
    }

    public function blogList()
    {
        $blogsModule = new BlogController($this->blog);
        //$blog = $blogsModule->show(1);
        $blog = $blogsModule->index();

        if($blog)
        {
            return response()->json(['status'=>1,'message'=>'Success', 'data'=>$blog], 200);
        }
        else
        {
            return response()->json(['status'=>0, 'message'=>'something went wrong.'], 204);
        }
    }

}
