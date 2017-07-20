@extends('layouts.app')

@section('title', ' - ' . $thread->title)

@section('style')
    <style type="text/css">
        .answer + .reply {
            border-top: inset;
        }

        .reply {
            border-bottom: ridge;
            background-color: rgb(230, 235, 255);
        }

        .reply:last-child {
            border-bottom: none;
            border-radius: 0px 0px 5px 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 3em; background: #0085A1">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h2 class="post-heading">{{$thread->title}}</h2>
                    <div class="post-preview">
                        <p class="post-meta">
                            Published by <a href="{{url('user/' . $thread->user->id)}}">{{$thread->user->name}}</a>
                            in
                            <a href="{{url('channel/' . $thread->channel->id)}}">{{ucfirst($thread->channel->channel)}}</a>
                            Channel
                            {{$thread->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <hr>
                    {{$thread->description}}
                </div>
                @foreach($thread->answers as $answer)
                    <div class="well well-lg">
                        <div class="row">
                            <div class="col-sm-2">
                                <img class="img-rounded img-responsive" src="{{$answer->user->image}}"
                                     alt="{{$answer->user->name}}">
                            </div>
                            <div class="col-sm-10 answer">
                                <i>
                                    <b>
                                        <a href="{{url('user/' . $answer->user->id)}}">{{$answer->user->name}}</a> answered
                                    </b>
                                </i>
                                {{$answer->answer}}
                            </div>
                            @foreach($answer->replies as $reply)
                                <small class="col-sm-10 col-sm-offset-2 reply">
                                    <i>
                                        <b>
                                            <a href="{{url('user/' . $reply->user->id)}}">{{$reply->user->name}}</a>
                                            replied
                                        </b>
                                    </i>
                                    {{$reply->reply}}
                                </small>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-md-4 well">
                <h3 class="post-heading">
                    <small><b>Latest in</b></small>
                    {{ucfirst($thread->channel->channel)}}
                    <small><b>Channel</b></small>
                </h3>
                <hr class="small">
                <ul class="list-group">
                    @foreach($otherThreads as $otherThread)
                    <li class="list-group-item">
                        <a href="{{$otherThread->id}}">{{ $otherThread->title }}</a>
                        <small>by <i>{{$otherThread->user->name}}</i></small>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection