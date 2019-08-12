@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Reply</div>
                    <div class="card-body">
                        @if($edit === FALSE)
                            {!! Form::model($reply, ['route' => ['replies.store', $answer_id, $question_id], 'method' => 'post']) !!}

                        @else()
                            {!! Form::model($reply, ['route' => ['replies.update', $answer_id, $question_id, $reply], 'method' => 'patch']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('body', 'Body') !!}
                            {!! Form::text('body', $reply->body, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <button class="btn btn-success float-right" value="submit" type="submit" id="submit">Save
                        </button>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
