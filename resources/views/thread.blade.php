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
        .btn {
            padding: 15px 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 2.8em; background: #0085A1">

    </div>
    <div class="container" id="vm" v-cloak xmlns:v-on="http://www.w3.org/1999/xhtml">
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
                    <div class="col-md-6" style="padding-right: 0; padding-left: 0;">
                        <div class="btn-group btn-group-justified " role="group" aria-label="...">
                            <a href="#" type="button" class="btn btn-info">{{$thread->viewed_by_count}} views</a>
                            <a href="#" type="button" class="btn"
                               :class="{'btn-default': !isFollowed, 'btn-danger': isFollowed}"
                               v-on:click="toggleFollow">
                                <small>
                                    @{{ isFollowed? 'Unfollow' : 'Follow' }}
                                    ({{ $thread->followed_by_count }})
                                </small>
                            </a>
                            <a href="#" type="button" class="btn"
                               :class="{'btn-default': !isFavorite, 'btn-danger': isFavorite}"
                               v-on:click="toggleFavorite">
                                <small>
                                    @{{ isFavorite? 'Unfavorite' : 'Favorite' }}
                                    ({{$thread->favorite_by_count}})
                                </small>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-right: 0; padding-left: 0;">
                        <div class="btn-group btn-group-justified" role="group">
                            <a href="#" type="button"
                               class="btn btn-success"
                               title="{{$thread->is_solved? 'Mark Unsolved' : 'Mark Solved'}}"
                               v-on:click="toggleSolved">
                                @{{ thread.is_solved? 'Solved' : 'Unsolved' }}
                            </a>
                            <a href="./edit/{{$thread->id}}" class="btn btn-warning">Edit</a>
                        </div>
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
                                <div class="form-group col-xs-9 col-sm-10 floating-label-form-group controls">
                                    <label>Leave Reply</label>
                                    <input type="text" class="form-control" placeholder="Leave Reply" id="reply"
                                           required
                                           data-validation-required-message="Please enter a reply.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-xs-3 col-sm-2" style="padding: 22px 0;">
                                    <button type="submit" class="btn btn-default">Reply</button>
                                </div>
                            </div>
                        </form>
                        <!--Leave Reply Ends-->
                    </div>
                </div>
                <!--Answer Ends-->

            </div>
            <!--Sidebar Starts-->
            <div class="col-md-4 well" style="border: none; box-shadow: none">
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
            <!--Sidebar Ends-->
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
                thread: {!! $thread !!},
                isFollowed: {!! $isFollowed ? 1 : 0 !!},
                isFavorite: {!! $isFavorite ? 1 : 0 !!}
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
                },
                toggleFollow: function () {
                    if (this.isFollowed) {
                        const url = '../ajax/unfollow/thread/' + this.thread.id;
                        axios.delete(url)
                            .then(() => {
                                this.isFollowed = 0;
                            });
                    } else {
                        const url = '../ajax/follow/thread/' + this.thread.id;
                        axios.post(url)
                            .then(() => {
                                this.isFollowed = 1;
                            });
                    }
                },
                toggleFavorite: function () {
                    if (this.isFavorite) {
                        const url = '../ajax/unfavorite/thread/' + this.thread.id;
                        axios.delete(url)
                            .then(() => {
                                this.isFavorite = 0;
                            });
                    } else {
                        const url = '../ajax/favorite/thread/' + this.thread.id;
                        axios.post(url)
                            .then(() => {
                                this.isFavorite = 1;
                            });
                    }
                },
                toggleSolved: function () {
                    console.log('Implement toggleSolved()')
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