@extends('layouts.app')

@section('style')
    <style>
        .post-preview > a:hover {
            color: #333;
        }
        .post-preview > a:last-child {
            cursor: default;
        }
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
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 2.8em; background: #0085A1">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <!--User Detail Starts-->
                    <div class="">
                        <a href="{{url('thread/' . $thread->id)}}" class="btn btn-default pull-right">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                            Back to Thread
                        </a>
                        <a href="../../user/{{$thread->user->id}}">
                            <h1 class="post-title">{{$thread->user->name}}</h1>
                        </a>
                    </div>
                    <a href="mailto:{{$thread->user->email}}"><h4>{{$thread->user->email}}</h4></a>
                    <!--User Detail Ends-->
                </div>
                <hr>

                <!--Thread Listing Starts-->
                @each('partials.full-view', $threads = $thread->histories()->latest()->paginate(5), 'thread')
                {{$threads->links()}}
                <!--Thread Listing Ends-->
            </div>
        </div>
    </div>
@endsection