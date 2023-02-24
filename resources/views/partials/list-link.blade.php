@if (count($links) == 0)
<h5> No contributions yet </h5>
@endif

@foreach ($links as $link)
<li>



    <span class="label label-default" style="background: {{ $link->channel->color }}">

        <a href="/community/{{ $link->channel->slug }}">

            {{ $link->channel->title }}
        </a>
    </span>

    <a href="{{$link->link}}" target="_blank">
        {{$link->title}}
    </a>


    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>

    <form method="POST" action="/community/votes/{{ $link->id }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-secondary 
{{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}" " {{ Auth::guest() ? 'disabled' : '' }}>
                {{$link->users()->count()}}
            </button>
        </form>
</li>




@endforeach