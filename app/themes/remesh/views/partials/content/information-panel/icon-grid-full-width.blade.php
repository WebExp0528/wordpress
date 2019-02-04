
<?php /** @var Remesh\Content\InformationPanel $content */ ?>
@extends('partials.content.information-panel.base-information-panel', ['content' => $content])

@section('other')
    <div class="grid">
        <div class="grid-row">
            @foreach($content->gridItems() as $item)
                @if($item->link()->valid())
                {!! $item->link()->openA([],['data-transition'=>'fade', 'data-transition-index' => $loop->iteration]) !!}
                @else
                <a data-transition='fade' data-transition-index='{{$loop->iteration}}'>
                @endif
                    <div class="icon">
                        <div class="icon-image" style="background-image:url({{ $item->icon()->src() }}"></div>
                    </div>
                    <div>
                        {!! $item->title() !!}  @if($item->link()->valid())<span class="arrow"></span>@endif
                    </div>
                </a>
                @if(($loop->iteration % 3 == 0) && ($loop->iteration < count($content->gridItems())))
        </div>
        <div class="grid-row">
                @endif
            @endforeach
        </div>
    </div>
@endsection