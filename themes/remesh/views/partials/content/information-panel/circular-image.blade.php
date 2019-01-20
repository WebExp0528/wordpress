<?php /** @var Remesh\Content\InformationPanel $content */ ?>

@extends('partials.content.information-panel.base-information-panel', ['content' => $content, 'other_attributes' => "data-transition='fade' data-transition-index='1'"])

@section('other')
    {!! $content->image()->img('hero') !!}
@endsection