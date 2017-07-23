<div class="post-preview">

    <a href="#">
        <h2>{{$thread->title}}</h2>
        <h3 class="post-subtitle">
            {{$thread->description}}
        </h3>
    </a>

    <p class="post-meta">
        in <a href="{{'./home?channel=' . $thread->channel->id}}">
            {{ucfirst($thread->channel->channel)}}</a> Channel,
        Created {{(new Carbon\Carbon($thread->created_at))->diffForHumans()}},
        Updated {{(new Carbon\Carbon($thread->updated_at))->diffForHumans()}}
    </p>
</div>
<hr>