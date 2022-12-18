<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
       // Save Comment
       function save_comment(Request $request,$id){
        $request->validate([
            'comment'=>'required'
        ]);
        $data=new Comment;
        $data->user_id=$request->user()->id;
        $data->post_id=$id;
        $data->comment=$request->comment;
        $data->save();
        return redirect('posts/'.$id)->with('success','Comment has been submitted.');
    }
    public function destroy($id)
    {
        $comment = Comment::where('id', $id);
        $comment->delete();
        return back()->with('message', 'Your comment has been deleted!');
    }
}
