@extends('layouts.app')

@section('title', ' - ' . $thread->title)

@section('style')
    <style type="text/css">
        .reply {
            border-left: inset;
            background-color: rgb(230, 235, 255);
            padding-bottom: 5px;
        }

        .reply:last-child {
            border-radius: 0px 0px 5px 5px;
        }

        .well {
            border-radius: 0px;
            background: none;
        }

        .jumbotron + .well {
            border-radius: 8px 8px 0px 0px;
        }

        .well:last-child {
            border-radius: 0 0 8px 8px;
        }
        button:first-child:hover {
            cursor: default;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 3em; background: #0085A1">

    </div>
    <div class="container" id="vm" v-cloak>
        <div class="row">
            <div class="col-md-8">

                <!--Thread Starts-->
                <div class="jumbotron">
                    <h2 class="post-heading">{{$thread->title}}</h2>
                    <div class="post-preview">
                        <p class="post-meta">
                            Published by <a href="{{url('user/' . $thread->user->id)}}">{{$thread->user->name}}</a>
                            in
                            <a href="{{url('home?channel=' . $thread->channel->id)}}">{{ucfirst($thread->channel->channel)}}</a>
                            Channel
                            {{$thread->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <hr>
                    {{$thread->description}}
                </div>
                <!--Thread Ends-->

                <!--Statistics Starts-->
                <div id="stat">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-info">{{$thread->viewed_by_count}} views</button>
                        <button type="button" class="btn btn-default">
                            Follow ({{ $thread->followed_by_count }})
                        </button>
                        <button type="button" class="btn btn-default">
                            Favorite ({{$thread->favorite_by_count}})
                        </button>
                    </div>
                </div>
                <!--Statistics Ends-->

                <!--Leave Answer Starts-->
                <form name="answer" class="interact well well-lg" novalidate>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Leave Answer</label>
                            <input type="text" class="form-control" placeholder="Leave Answer" id="answer" required
                                   data-validation-required-message="Please enter an answer.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default">Answer</button>
                        </div>
                    </div>
                </form>
                <!--Leave Answer Ends-->

                <!--Answer Starts-->
                <div v-for="answer in thread.answers" class="well well-sm">
                    <div class="row">
                        <div class="col-xs-2">
                            <img class="img-thumbnail img-responsive" :src="answer.user.image"
                                 :alt="answer.user.name">
                        </div>
                        <div class="col-xs-10 answer">
                            <i>
                                <b>
                                    <a :href="'user/' + answer.user.id">@{{answer.user.name}}</a> answered
                                </b>
                            </i>
                            @{{answer.answer}}
                        </div>

                        <!--Reply Starts-->
                        <small v-for="reply in answer.replies" class="col-xs-10 col-xs-offset-2 reply">
                            <div class="col-xs-2" style="padding-left: 0; padding-right: 0;">
                                <img :src="reply.user.image" :alt="reply.user.name" class="img-responsive img-rounded"
                                     style="padding: 5px 15px 15px 15px;">
                            </div>
                            <div class="col-xs-10" style="padding-left: 0;">
                                <i>
                                    <b>
                                        <a :href="'user/' + reply.user.id">@{{reply.user.name}}</a>
                                        replied
                                    </b>
                                </i>
                                @{{reply.reply}}
                            </div>
                        </small>
                        <!--Reply Ends-->

                        <!--Leave Reply Starts-->
                        <form name="reply" :id="answer.id" class="col-xs-12 interact" novalidate>
                            <div class="row control-group">
                                <div class="form-group col-xs-10 floating-label-form-group controls">
                                    <label>Leave Reply</label>
                                    <input type="text" class="form-control" placeholder="Leave Reply" id="reply"
                                           required
                                           data-validation-required-message="Please enter a reply.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-xs-2" style="padding: 22px 0;">
                                    <button type="submit" class="btn btn-default">Reply</button>
                                </div>
                            </div>
                        </form>
                        <!--Leave Reply Ends-->
                    </div>
                </div>
                <!--Answer Ends-->

            </div>
            <div class="col-md-4 well">
                <h3 class="post-heading" style="text-align: center">
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

@section('script')
    <!-- Contact Form JavaScript -->
    <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>

    {{--Vue Object--}}
    <script type="application/javascript">
        const app = new Vue({
            el: '#vm',
            data: {
                thread: {!! $thread !!}
            },
            methods: {
                answer: function (ans) {
                    axios.post('../ajax/answer?answer=' + ans + '&thread=' + '{{$thread->id}}')
                        .then(function (reps) {
                            app.thread.answers.splice(0, 0, reps.data.answer);
                        });
                },
                reply: function (rep, ans) {
                    axios.post('../ajax/reply?reply=' + rep + '&answer=' + ans)
                        .then(function (resp) {
                            let answer = _.find(app.thread.answers, function (o) {
                                return o.id == ans;
                            });

                            answer.replies.splice(0, 0, resp.data.reply)
                        })
                }
            }
        });
    </script>

    <script type="application/javascript">
        $(function () {

            $(".interact input,.interact textarea").jqBootstrapValidation({
                preventSubmit: true,
                submitError: function ($form, event, errors) {
                    // additional error messages or events
                },
                submitSuccess: function ($form, event) {
                    event.preventDefault(); // prevent default submit behaviour
                    if ($form[0].name === 'answer') {
                        app.answer($form[0].elements[0].value);
                    } else if ($form[0].name === 'reply') {
                        app.reply($form[0].elements[0].value, $form[0].id);
                    }
                },
                filter: function () {
                    return $(this).is(":visible");
                }
            });

        });
    </script>
@endsection