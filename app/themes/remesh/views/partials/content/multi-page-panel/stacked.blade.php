<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>

@extends('partials.content.multi-page-panel.base-multi-page-panel', ['content' => $content])

@section('header')
    <div class="header">
        @if(!empty($content->title()))
            <span class="sub-header">{{ $content->title() }}</span>
        @endif
    </div>
@endsection

@section('tabs')
    @if(count($content->pages()) > 1)
        <div class="tabs">
            @foreach($content->pages() as $page)
                @if($loop->first)
                    <a href="#" class="multi-page-tab active">
                        @if($page->tabIcon())
                            {!! $page->tabIcon()->img() !!}
                        @endif
                        <p>{!! $page->tabTitle() !!}</p>
                    </a>
                @else
                    <a href="#" class="multi-page-tab">
                        @if($page->tabIcon())
                            {!! $page->tabIcon()->img() !!}
                        @endif
                        <p>{!! $page->tabTitle() !!}</p>
                    </a>
                @endif
            @endforeach
        </div>
    @endif
@endsection