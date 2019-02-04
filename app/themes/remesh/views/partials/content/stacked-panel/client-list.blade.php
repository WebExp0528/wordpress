<?php /** @var Remesh\Content\InformationTable $content */ ?>

@extends('partials.content.stacked-panel.base-stacked-panel', ['content' => $content])

@section('content')
    <div class="client-list">
        <ul>
            @foreach($content->clients() as $client)
                <li>
                    {!! $client->image()->img() !!}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
