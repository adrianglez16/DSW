<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css') }}">

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <a href="/community">
                <h1>Community</h1>
            </a>
           <!-- <h5> {{$links[0]->channel->title}}</h5> -->


            @include('partials.list-link')

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Contribute a link</h3>
                </div>
                <div class="card-body">
                    @include('partials.add-link')
                </div>
            </div>

        </div>
    </div>
    {{$links->links()}}


</div>

@stop


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>