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
                <div class="buttons">
                    @if ($content->formEmbed())
                        {!! $content->formEmbed() !!}
                    @elseif($content->demoLink())
                        {!! $content->demoLink()->a(['button', 'button-white']) !!}
                    @endif
                    @if($content->videoLink())
                        {!! $content->videoLink()->a(['button', 'button-secondary']) !!}
                    @endif
                    <div class="button-arrow"></div>
                </div>
            </div>
            <div class="other">
                <div class="bg-other-ornament-1"></div>
                {!! $content->image()->img('hero') !!}
            </div>
            <div class="arrow"></div>
        </div>
    </div>
</section>