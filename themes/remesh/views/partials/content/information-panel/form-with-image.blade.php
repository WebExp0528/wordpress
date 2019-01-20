
<?php /** @var Remesh\Content\InformationPanel $content */ ?>
@extends('partials.content.information-panel.base-information-panel', ['content' => $content])

@section('info')
    @if(!empty($content->form()->formEmbed()))
        {!! $content->form()->formEmbed() !!}
    @else
    <form action="{!! $content->form()->action() !!}" method="{{ $content->form()->method() }}">
        @foreach($content->form()->hiddenFields() as $key => $value)
        <input type="hidden" name="{{$key}}" value="{{$value}}">
        @endforeach
        <input type="{{ $content->form()->type() }}" placeholder="{{ $content->form()->placeholder() }}">
        <input class="button" type="submit" value="{{ $content->form()->buttonLabel() }}">
    </form>
    @endif
@endsection

@section('other')
    {!! $content->image()->img('hero') !!}
@endsection