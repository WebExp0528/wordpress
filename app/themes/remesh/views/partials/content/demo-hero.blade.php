<?php /** @var Remesh\Content\Hero $content */ ?>
<section class="{{$content->style()}}">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="info">
                <h1>{!! $content->title() !!}</h1>
                <p>{!! $content->text() !!}</p>
            </div>
            <div class="other">
                <div class="bg-other-ornament-1"></div>
                {!! $content->image()->img('hero') !!}
            </div>
            @if(!empty($content->formEmbed()))
            {!! $content->formEmbed() !!}
            @else
            @include('partials.content.demo-form')
            @endif
        </div>
    </div>
</section>