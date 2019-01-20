<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>
@if(!empty($content->identifier()))
    <a name="{{$content->identifier()}}"></a>
@endif
<section class="{{$content->containerCSS()}}">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="bg-int-ornament-2"></div>
            @yield('header')
            @yield('tabs')
            <div class="pages-container">
                @foreach($content->pages() as $page)
                <div class="page  @if($loop->first) active @endif">
                    <div class="text">
                        @if(!empty($page->header()))
                        <h2>{!! $page->header() !!}</h2>
                        @endif
                        <p>{!! $page->text() !!}</p>
                        @if($page->link()->valid())
                            {!! $page->link()->a() !!}
                        @endif
                    </div>
                    <div class="image">
                        @if($page->image())
                            {!! $page->image()->img('multi-page') !!}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="nav">
                <a href="#" class="previous">Previous</a>
                <a href="#" class="next">Next</a>
            </div>
            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>
