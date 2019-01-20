<?php /** @var Remesh\Content\InformationPanel $content */ ?>

@extends('partials.content.information-panel.base-information-panel', ['content' => $content])

@section('other')
    {!! $content->image()->img('hero-fit') !!}
@endsection