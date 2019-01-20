{{-- If we are on the front page, we don't want to the top nav, but every other page we do. --}}
@extends('layouts/page', ['body_class' => (empty($body_class) ? '' : $body_class)])


@section('main')
    {{-- Render all of the page's content blocks here --}}
    @foreach($content->content as $contentItem)
        {!! $contentItem->render(['errors'=>$errors, 'params'=>$params, 'first' => $loop->first, 'last' => $loop->last]) !!}
    @endforeach

    @yield('additional')
@endsection
