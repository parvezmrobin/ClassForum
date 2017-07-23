@extends('layouts.app')

@section('title', ' - ' . $user->name)

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

        .btn-xs {
            padding: 5px;
        }

        .btn-xs {
            background: none;
            color: #333;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 2.8em; background: #0085A1">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <!--User Detail Starts-->
                <div class="post-preview">
                    <a href="./{{$user->id}}">
                        <h2 class="post-title">{{$user->name}}</h2>
                    </a>
                </div>
                <a href="mailto:{{$user->email}}"><h4>{{$user->email}}</h4></a>
                <h4>{{$user->threads()->count()}} Threads, {{$user->answers()->count()}} Answers</h4>
                <!--User Detail Ends-->
                <hr>

                <!--Thread Listing Starts-->
                @each('partials.preview', $threads = $user->threads()->paginate(10), 'thread')
                {{$threads->links()}}
                <!--Thread Listing Ends-->
            </div>

            <!--Favorite Threads Starts-->
            <div class="col-sm-4 well" id="vm" style="background: none; border: none; box-shadow: none">
                <h1 class="post-heading" style="margin-top: 10px;">Favorite Threads</h1>
                <hr class="small">
                <ul class="list-group">

                    @foreach($user->favorites as $thread)
                    <li class="list-group-item">
                        <a href="../thread/{{$thread->id}}">{{ $thread->title }}</a>
                        <small>by <i>{{$thread->user->name}}</i></small>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!--Favorite Threads Ends-->
        </div>
    </div>
@endsection