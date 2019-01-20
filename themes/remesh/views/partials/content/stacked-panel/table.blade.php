<?php /** @var Remesh\Content\InformationTable $content */ ?>

@extends('partials.content.stacked-panel.base-stacked-panel', ['content' => $content])

@section('content')
    <div class="table">
        <div class="bg-other-ornament-1"></div>
        <ul>
            @foreach($content->items() as $item)
                <li data-transition='fade' data-transition-index='{{$loop->iteration}}'>
                    @if($content->type() == 'vertical-cell')
                        {!! $item->image()->img('table-landscape') !!}
                    @else
                        <div class="image" style="background-image: url({!! $item->image()->src('table-portrait') !!})"></div>
                    @endif
                    <div>
                        <h4>{{ $item->title() }}</h4>
                        <p>{{ $item->text() }}</p>
                        {!! $item->link()->a() !!}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
