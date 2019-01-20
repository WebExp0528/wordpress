<?php /** @var Remesh\Content\InformationTable $content */ ?>
@if(!empty($content->identifier()))
    <a name="{{$content->identifier()}}"></a>
@endif
<section class="{{$content->containerCSS()}}">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="header">
                @if(!empty($content->title()))
                <span class="sub-header">{{$content->title()}}</span>
                @endif
                @if(!empty($content->header()))
                <h2>{!! $content->header() !!}</h2>
                @endif
                @if(!empty($content->link()))
                    {!! $content->link()->a() !!}
                @endif
                @if(!empty($content->text()))
                    <p>{!! $content->text() !!}</p>
                @endif
            </div>
            @yield('content')
            {!! $content->arrow()->render('table') !!}
        </div>
    </div>
</section>