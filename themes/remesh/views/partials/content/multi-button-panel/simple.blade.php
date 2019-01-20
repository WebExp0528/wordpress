<?php /** @var Remesh\Content\MultiButtonPanel $content */ ?>
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
                    <span class="sub-header">{{ $content->title() }}</span>
                @endif
                @if(!empty($content->header()))
                    <h2>{!! $content->header() !!}</h2>
                @endif
                @if(!empty($content->text()))
                    <p>{!! $content->text() !!}</p>
                @endif
            </div>
            <div class="buttons-container">
                @foreach($content->buttons() as $button)
                    @if($button->link()->valid())
                        <div class="button" data-transition='fade' data-transition-index='{{$loop->iteration}}'>
                    {!! $button->link()->openA() !!}
                        @if($button->icon())
                            {!! $button->icon()->img() !!}
                        @endif
                        <h3>{!! $button->title() !!}</h3>
                        <p>{!! $button->description() !!}</p>
                    {!! $button->link()->closeA() !!}
                        </div>
                    @endif
                @endforeach
            </div>
            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>
