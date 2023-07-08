<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){

        $posts = Post::all();

        return $posts;
    }

    public function show($id){

        $post = Post::find($id);

        return $post;
        
    }

    public function create(Request $request){
        Post::create([
            'title'=>$request->title,
            'details'=>$request->details,
        ]);
    }

    public function update(Request $request,$id){

        $post = Post::find($id);
        $post->update([
            'title'=>$request->title,
            'details'=>$request->details,
        ]);

    } 


    public function delete($id){
        $post= Post::find($id);
        $post->delete();
    }
}
