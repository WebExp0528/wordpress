<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>

@extends('partials.content.multi-page-panel.base-multi-page-panel', ['content' => $content])

@section('header')
    <div class="header">
        @if(!empty($content->title()))
            <span class="sub-header">{{ $content->title() }}</span>
        @endif
        @if(!empty($content->header()))
            <h2>{!! $content->header() !!}</h2>
        @endif
    </div>
@endsection

@section('tabs')
    @if(count($content->pages()) > 1)
        <div class="tabs">
            @foreach($content->pages() as $page)
                <a href="#" class="multi-page-tab @if($loop->first) active @endif">{!! $page->tabTitle() !!}</a>
            @endforeach
        </div>
    @endif
@endsection