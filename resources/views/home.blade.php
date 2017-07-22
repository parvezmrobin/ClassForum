@extends('layouts.app')

@section('style')
    <style>
        .pagination {
            font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-weight: bold;
        }

        .pagination > li > a,
        .pagination > li > span {
            color: inherit;
        }

        .pagination > .active > a,
        .pagination > .active > a:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span,
        .pagination > .active > span:hover,
        .pagination > .active > span:focus {
            color: inherit;
            background-color: inherit;
        }

        .pagination > .active > span:hover,
        .pagination > .active > a:hover {
            font-weight: bolder;
        }

        .list-group-item {
            border-bottom-color: lightgray;
            border-right-color: darkgray;
            border-left-color: darkgray;
        }

        .list-group-item:first-child {
            border-top-right-radius: 1px;
            border-top-left-radius: 1px;
            border-top-color: darkgray;
        }

        .list-group-item:last-child {
            border-bottom-right-radius: 1px;
            border-bottom-left-radius: 1px;
            border-bottom-color: darkgray;
        }

    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Class Forum</h1>
                        <hr class="small">
                        <span class="subheading">A Place to Resolve the unresolved</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row" xmlns:v-on="http://www.w3.org/1999/xhtml">
            <div class="col-md-8">
                @foreach($threads as $thread)
                    <div class="post-preview">
                        <a href="{{url('thread/' . $thread->id)}}">
                            <h2 class="post-title">
                                {{$thread->title}}
                            </h2>
                            <h3 class="post-subtitle">
                                {{$thread->description}}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by <a href="#">{{$thread->user->name}}</a>
                            {{(new Carbon\Carbon($thread->created_at))->diffForHumans()}}
                        </p>
                    </div>
                    <hr>
                @endforeach

                {{$threads->links()}}
            </div>
            <div class="col-md-4 well" id="vm" style="background: none; border: none; box-shadow: none">
                <h1 class="post-heading" style="margin-top: 30px;">Channels</h1>
                <hr class="small">
                <ul class="list-group">

                    <li v-for="channel in channels" class="list-group-item">
                        <a :href="'./home?channel=' + channel.id">@{{ channel.channel }}</a>
                        (<a v-if="channel.isFollowed" href="#" v-on:click="follow(channel.id)">Follow</a>)
                        (<a v-else href="#" v-on:click="unfollow(channel.id)">Unfollow</a>)
                    </li>

                </ul>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        new Vue({
            el: '#vm',
            data: {
                channels: {!! json_encode($channels) !!}
            },
            methods: {
                follow: function (id) {
                    const url = './api/follow/channel?channel=' + id;
                    axios.put(url)
                        .then(function (resp) {
                            const index = _.find(this.channels, {id: id});
                            this.channels[index].isFollowed = true;
                        })
                },
                unfollow: function (id) {
                    const url = './api/unfollow/channel?channel=' + id;
                    axios.put(url)
                        .then(function (resp) {
                            const index = _.find(this.channels, {id: id});
                            this.channels[index].isFollowed = false;
                        })
                }
            }
        })
    </script>
@endsection
