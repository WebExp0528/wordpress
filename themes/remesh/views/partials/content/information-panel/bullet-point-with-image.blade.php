<?php /** @var Remesh\Content\InformationPanel $content */ ?>

@extends('partials.content.information-panel.base-information-panel', ['content' => $content, 'other_attributes' => "data-transition='fade' data-transition-index='1'"])

@section('info')
    <ul>
        @foreach($content->bulletPoints() as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
@endsection

@section('other')
    @if($content->image())
    {!! $content->image()->img('hero-fit') !!}
    @endif
@endsection