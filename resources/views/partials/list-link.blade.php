@if (count($links) == 0)
<h5> No contributions yet </h5>
@endif

@foreach ($links as $link)
<li>
    <button type="button" class="btn btn-outline-success btn-sm">
        {{$link->users()->count()}}
    </button>
    <span class="label label-default" style="background: {{ $link->channel->color }}">
        {{ $link->channel->title }}
    </span>

    <a href="{{$link->link}}" target="_blank">
        {{$link->title}}
    </a>

    <a href="/community/{{ $link->channel->slug }}">
        Slug
    </a>
    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
</li>
@endforeach