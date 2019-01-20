<?php /** @var Remesh\Content\InformationPanel $content */ ?>
@if(!empty($content->identifier()))
<a name="{{$content->identifier()}}"></a>
@endif
<section class="{{ $content->containerCSS() }}">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="bg-int-ornament-2"></div>
            <div class="info">
                @if(!empty($content->title()))
                    <span class="sub-header">{{ $content->title() }}</span>
                @endif
                @if(!empty($content->header()))
                    <h2>{!! $content->header() !!}</h2>
                @endif
                @if(!empty($content->text()))
                    <p>{!! $content->text() !!}</p>
                @endif
                @if($content->link()->valid())
                    <div class="buttons">
                        {!! $content->link()->a(['button']) !!}
                        {!! $content->arrow()->render('button') !!}
                    </div>
                @else
                        {!! $content->arrow()->render('button') !!}
                @endif
                @yield('info')
            </div>
            <div class="other" @if(!empty($other_attributes)) {!! $other_attributes !!} @endif>
                <div class="bg-other-ornament-1"></div>
                <div class="bg-other-ornament-2"></div>
                @yield('other')
                {!! $content->arrow()->render('other') !!}
            </div>
            @if($content->link()->valid())
                <div class="buttons-m">
                    {!! $content->link()->a(['button']) !!}
                    {!! $content->arrow()->render('button') !!}
                </div>
            @else
                {!! $content->arrow()->render('button') !!}
            @endif
            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>