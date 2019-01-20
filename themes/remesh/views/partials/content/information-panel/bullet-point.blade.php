<?php /** @var Remesh\Content\InformationPanel $content */ ?>

@extends('partials.content.information-panel.base-information-panel', ['content' => $content])


@section('other')
    <ul>
        @foreach($content->bulletPoints() as $item)
            <li data-transition='fade' data-transition-index='{{$loop->iteration}}'>
                <div>{{ $loop->iteration }}</div>
                <div>{{ $item }}</div>
            </li>
        @endforeach
    </ul>
@endsection


