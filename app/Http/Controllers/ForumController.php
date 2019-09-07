<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Comment;
use App\PostCategory;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        //
    }

    public function savePost(Request $request)
    {
        $PostInfo = new Post();
        $PostInfo->title = $request->title;
        $PostInfo->details = $request->details;
        $PostInfo->category = $request->category;
        $PostInfo->status = "PUBLISHED";
        $PostInfo->post_date = date("Y-m-d H:i:s");
        $PostInfo->posted_by = Auth::id();
        $PostInfo->save();

        return response()->json(array(
            'data' => $request->title,
            'status' => 'Successful',
            'message' => 'The Post has been saved successfully!'
        ));
    }

    public function show(Post $post)
    {
        $category = PostCategory::all();
        $posts = [];
        $post_list = Post::select('posts.id', 'posts.title', 'posts.details', 'posts.post_date', 'users.name', 'post_categories.title as category')
        ->leftjoin('users', 'users.id', '=', 'posts.posted_by')
        ->leftjoin('post_categories', 'post_categories.id', '=', 'posts.category')
        ->orderBy('posts.id', 'DESC')->get();

        foreach($post_list as $post):
            $comments = Comment::where('comments.post_id', $post->id)->get()->count();
            $posts[] = array('posts' => $post, 'comments' => $comments);
        endforeach;

        return view('forum', compact('category', 'posts'));
    }

    public function postDetails(Request $request)
    {
        $posts = Post::select('posts.id', 'posts.title', 'posts.details', 'posts.post_date', 'users.name', 'post_categories.title as category')
        ->leftjoin('users', 'users.id', '=', 'posts.posted_by')
        ->leftjoin('post_categories', 'post_categories.id', '=', 'posts.category')
        ->where('posts.id', $request->post_id)
        ->orderBy('posts.id', 'DESC')->get();

        $comments = Comment::select('comments.id', 'comments.details', 'comments.comment_date', 'users.name')
        ->where('comments.post_id', $request->post_id)
        ->leftjoin('users', 'users.id', '=', 'comments.commented_by')
        ->get();

        return view('postDetails', compact('posts', 'comments'));
    }

    public function saveComment(Request $request)
    {
        $CommentInfo = new Comment();
        $CommentInfo->details = $request->details;
        $CommentInfo->post_id = $request->post_id;
        $CommentInfo->comment_date = date("Y-m-d H:i:s");
        $CommentInfo->commented_by = Auth::id();
        $CommentInfo->save();

        return response()->json(array(
            'data' => $request->post_id,
            'status' => 'Successful',
            'message' => 'The Comment has been saved successfully!'
        ));
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
