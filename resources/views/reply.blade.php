@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reply</div>
                    <div class="card-body">
                        {{$reply->body}}
                    </div>
                    <div class="card-footer">
                        {{ Form::open(['method'  => 'DELETE', 'route' => ['replies.destroy', $answer, $reply->id, $question]])}}
                        <button class="btn btn-danger float-right mr-2" value="submit" type="submit" id="submit">Delete
                        </button>
                        {!! Form::close() !!}
                        <a class="btn btn-primary float-right" href="{{ route('replies.edit',['question_id'=>$question, 'answer_id'=> $answer, 'reply_id'=> $reply->id, ])}}">
                            Edit Reply
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
