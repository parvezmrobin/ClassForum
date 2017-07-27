<div class="post-preview">
    <a href="{{url('thread/' . $thread->id)}}">
        <h2>{{$thread->title}}</h2>
        <h3 class="post-subtitle">
            {{$thread->description}}
        </h3>
    </a>
    <p class="post-meta">
        Posted by <a href="{{url('/user/' . $thread->user->id)}}">{{$thread->user->name}}</a>
        in <a href="{{'./home?channel=' . $thread->channel->id}}">
            {{ucfirst($thread->channel->channel)}}</a> Channel
        {{(new Carbon\Carbon($thread->created_at))->diffForHumans()}}
    </p>
</div>
<hr>