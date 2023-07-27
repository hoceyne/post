<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){

        $posts = Post::with(["author"])->get();

        return $posts;
    }

    public function show($id){

        $post = Post::with(["author"])->find($id);
        if(!$post){
            abort(404);
        }
        return $post;
        
    }

    public function create(Request $request){
        $post = Post::create([
            'title'=>$request->title,
            'details'=>$request->details,
        ]);

        $user = User::find($request->user_id);

        $user->posts()->save($post);

    }

    public function update(Request $request,$id){

        $post = Post::find($id);
        if(!$post){
            abort(404);
        }
        $post->update([
            'title'=>$request->title,
            'details'=>$request->details,
        ]);

    } 


    public function delete($id){
        $post= Post::find($id);
        if(!$post){
            abort(404);
        }
        $post->delete();
    }
}
