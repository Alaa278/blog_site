<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
       function update_comment(Request $request,$id){
        $request->validate([
            'comment'=>'required'
        ]);
       
        $Comment=  Comment::where('id', $id)
        ->update([
           'comment'=>$request->comment,
        ]);
        return back()->with('success','Comment has been submitted.');
    }
    public function destroy($id)
    {
        $comment = Comment::find($id);
        // dd($comment->created_by);
        if ($comment->created_by != Auth::user()->id) {
            abort(code:403);
        }
        $comment->delete();
        return back()->with('message', 'Your comment has been deleted!');
    }
}
