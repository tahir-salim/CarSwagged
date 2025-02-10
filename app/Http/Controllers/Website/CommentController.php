<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment(Request $request)
    {
        $comment = new PostComment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->seller_id = $request->seller_id;
        $comment->comment = $request->comment;
        $comment->status = 'Active';
        if (Auth::User()->user_role_id == '3') {
            $comment->is_seller = true;
        } elseif (Auth::User()->user_role_id == '1' || Auth::User()->user_role_id == '2') {
            $comment->is_admin = true;
        }

        if (request()->has('comment_name') && request()->has('comment_id')) {
            $comment->reply_to_id = $request->comment_id;
            $comment->reply_to_name = $request->comment_name;
        }

        $comment->save();
        return response()->json(['success' => 'Comment Added Sucessfully ....!']);
    }

    public function comments()
    {
        $comments = Auth::user()->user_role_id == 2 ? PostComment::with('user')->get() : PostComment::with('user')->where('seller_id', Auth::user()->id)->get();
        return view('admin.seller.comments.index', compact('comments'));
    }

    public function change_status($id)
    {
        $comment = PostComment::find($id);
        $status = $comment->status == 'Inactive' ? 'Active' : 'Inactive';
        $comment->status = $status;
        $comment->save();
        return back();
    }

}
