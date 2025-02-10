<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BuyerQuestion;
use Auth;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function add_question(Request $request)
    {
        $comment = new BuyerQuestion();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->question = $request->question;
        $comment->seller_id = $request->seller_id;
        $comment->save();
        return response()->json(['success' => 'Question Added Sucessfully ....!']);
    }

    public function questions()
    {
        $questions = BuyerQuestion::with('user')->where('seller_id', Auth::user()->id)->get();
        return view('admin.seller.questions.index', compact('questions'));
    }

    public function edit_question($id)
    {
        $question = BuyerQuestion::find($id);
        return view('admin.seller.questions.edit', compact('question'));
    }

    public function update_question(Request $request, $id)
    {
        $question = BuyerQuestion::find($id);
        $question->answer = $request->answer;
        $question->save();
        return redirect('/seller/questions');
    }
}
