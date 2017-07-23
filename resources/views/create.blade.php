@extends('layouts.app')

@section('style')
    <style type="text/css">
        .custom-select {
            z-index: 1;
            position: relative;
            padding-right: 0;
            padding-left: 0;
            border: none;
            border-radius: 0;
            font-size: 1.15em;
            background: none;
            box-shadow: none !important;
            resize: none;
        }

        .custom-select-label {
            top: 0;
            opacity: 1;
            display: block;
            z-index: 0;
            position: relative;
            margin: 0;
            font-size: 0.65em;
            line-height: 1.764705882em;
            vertical-align: baseline;
        }
        .form-group:hover > .custom-select-label {
            color: #0085A1;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 2.8em; background: #0085A1">

    </div>
    <div class="container">
        <div class="row">
            <h2>{{isset($thread)? 'Update': 'Create new'}} thread</h2>
            <hr>
            <form action="{{url('thread')}}" class="interact well well-lg" novalidate method="post">
                {{csrf_field()}}
                @if(isset($thread))
                    <input type="hidden" name="id" value="{{$thread->id}}">
                @endif
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="title">Thread Title</label>
                        <input type="text" class="form-control"
                               placeholder="Thread Title" name="title" id="title" required
                               data-validation-required-message="Please enter a title."
                               value="{{isset($thread)? $thread->title: ''}}" >
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 controls" style="border-bottom: 1px solid #eeeeee;">
                        <label class="custom-select-label" for="channel">Choose Channel</label>
                        <select class="form-control custom-select " style="height: auto"
                                id="channel" name="channel" required
                                data-validation-required-message="Please choose a channel.">
                            @foreach($channels as $channel)
                                <option {{(isset($thread) && $thread->channel_id == $channel->id)? 'selected': ''}} value="{{$channel->id}}">{{$channel->channel}}</option>
                            @endforeach
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Thread Description</label>
                        <textarea class="form-control"
                                  placeholder="Thread Description"
                                  id="description" name="description" required
                                  data-validation-required-message="Please enter a description."
                        >{{isset($thread)? $thread->description: ''}}</textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-default">{{isset($thread)? 'Update': 'Create'}}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>

    <script type="application/javascript">
        $(function () {

            $(".interact input,.interact textarea").jqBootstrapValidation({
                //preventSubmit: true,
                submitError: function ($form, event, errors) {
                    // additional error messages or events
                },
                submitSuccess: function ($form, event) {
                    //event.preventDefault(); // prevent default submit behaviour
                },
                filter: function () {
                    return $(this).is(":visible");
                }
            });

        });
    </script>
@endsection