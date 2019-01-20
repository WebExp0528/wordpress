<?php /** @var Remesh\Content\InformationTable $content */ ?>

@extends('partials.content.stacked-panel.base-stacked-panel', ['content' => $content])

@section('content')
    <div class="video">
        <div class="bg-other-ornament-1"></div>
        <div class="video-container">
            {!! $content->video() !!}
        </div>
    </div>
@endsection
