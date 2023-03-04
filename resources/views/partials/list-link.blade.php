@if (count($links) == 0)
<h5> No contributions yet </h5>
@endif


{{ $links->appends($_GET)->links() }}

<ul class="nav">
    <li class="nav-item">
        {{--Si existe el parametro popular el link permanecerá y sino estará disabled--}}
        <a class="nav-link {{request()->exists('popular') ? '' : 'disabled' }}" href="{{request()->url()}}">Most recent</a>
    </li>
    <li class="nav-item">
    {{--Si existe el parametro popular el link no permenecerá y sino estará activado. Además en el href se añadirá el parametro ?popular.--}}

        <a class="nav-link {{request()->exists('popular') ? 'disabled' : '' }}" href="?popular">Most popular</a>
    </li>
</ul>


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