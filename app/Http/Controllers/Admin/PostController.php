<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{


     public function store(Request $request){
            $request->validate([
                'title'=>'required',
                'description'=>'required'
            ]);

            $post = new Post();
            $post->title=$request->title;
            $post->description =$request->description;
            $post->save();
            return response()->json($post);
     }


     public function edit($id){
          $post = Post::find($id);

          if($post){
            return response()->json([
                'status'=>200,
                'post'=>$post
            ]);
          }else{
            return response()->json([
                'status'=>404,
                'message'=>'post not found'
            ]);
          }
     }


     public function update(Request $request,$id){
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        $post = Post::find($id);
        $post->title=$request->title;
        $post->description =$request->description;
        $post->save();
        return response()->json($post);
     }

     public function destroy($id){
        $post = Post::find($id);

        if($post){
           $post->delete();
           return response()->json($post);
        }else{
          return response()->json([
              'status'=>405,
              'message'=>'post not found'
          ]);
        }
     }
}
