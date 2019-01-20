<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>

@extends('partials.content.multi-page-panel.base-multi-page-panel', ['content' => $content])

@section('header')
    <div class="header">
        @if(!empty($content->title()))
            <span class="sub-header">{{ $content->title() }}</span>
        @endif
    </div>
@endsection