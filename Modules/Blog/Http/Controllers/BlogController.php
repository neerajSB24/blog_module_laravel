<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Http\Requests\BlogPostRequest;
use Modules\News\Http\Controllers\NewsController;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */


    public function index()
    {
        $blogs = Blog::paginate(4);
        if ($blogs) {
            return response()->json(['status' => 1, 'message' => 'success', 'data' => $blogs], 200);
        }
        return response()->json(['status' => 0, 'message' => 'No record found.', 'data' => array()], 204);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */


    public function store(BlogPostRequest $request)
    {
        $input = $request->all();
        $blog = Blog::create($input);
        return response()->json(['status'=>1,'message'=>'Blog added successfully.'], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $blogs = Blog::find($id);
        if ($blogs) {
            return response()->json(['status' => 1, 'message' => 'Success', 'data' => $blogs], 200);
        }
        return response()->json(['status' => 0, 'message' => 'Blog details not found.', 'data' => array()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $blogs = Blog::find($id);
        if ($blogs) {
            return response()->json(['status' => 1, 'message' => 'Success', 'data' => $blogs], 200);
        }
        return response()->json(['status' => 0, 'message' => 'Blog not found.', 'data' => array()], 204);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description'=> 'required'
        ]);

        $title = $request->json('title');
        $description = $request->json('description');


        if ($validation->passes())
        {
            $blog = Blog::find($id);
            $blog->title = $title;
            $blog->description = $description;
            $blog->update();
            return response()->json(['status' => 1, 'message' => 'Blog updated successfully.'], 200);
        } else {
            return response()->json(['status' => 0, 'message' => $validation->errors()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
            return response()->json(['status' => 1, 'message' => 'Blog deleted successfully.'], 200);
        }
        return response()->json(['status' => 0, 'message' => 'Blog failed to delete.'], 204);

    }


    public function newsBlog()
    {
        $newsModule = new NewsController();
        //$blog = $blogsModule->show(1);
        $news = $newsModule->index();

        if ($news) {
            return response()->json(['status' => 1, 'message' => 'Success', 'data' => $news], 200);
        } else {
            return response()->json(['status' => 0, 'message' => 'something went wrong.'], 204);
        }
    }

}
