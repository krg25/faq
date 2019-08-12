<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Reply;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($question, $answer)
    {
        $reply = new Reply;
        $edit = FALSE;
        return view('replyForm', ['reply' => $reply,'edit' => $edit, 'answer_id' =>$answer, 'question_id'=>$question  ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $answer, $question)
    {

        $input = $request->validate([
            'body' => 'required|min:5',
        ], [

            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',

        ]);
        $input = request()->all();
        $Answer = Answer::find($answer);
        $reply = new Reply($input);
        $reply->user()->associate(Auth::user());
        $reply->answer()->associate($Answer);
        $reply->save();

        return redirect()->route('answers.show',[ 'question_id'=>$question,  'answer_id' => $Answer->id])->with('message', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($answer,  $reply, $question)
    {
        $reply = Reply::find($reply);

        return view('reply')->with(['reply' => $reply, 'answer' => $answer, 'question'=>$question  ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($answer,  $reply, $question)
    {
        $reply = Reply::find($reply);
        $edit = TRUE;
        return view('replyForm', ['reply' => $reply, 'edit' => $edit, 'answer'=>$answer, 'question'=>$question   ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $answer, $reply, $question)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [

            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',

        ]);

        $reply = Reply::find($reply);
        $reply->body = $request->body;
        $reply->save();

        return redirect()->route('replies.show',['answer_id' => $answer, 'reply_id' => $reply, 'question_id'=>$question  ])->with('message', 'Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($answer, $reply, $question)
    {
        $reply = Reply::find($reply);

        $reply->delete();
        return redirect()->route('answers.show',['answer_id' => $answer, 'question_id'=>$question  ])->with('message', 'Delete');

    }
}
