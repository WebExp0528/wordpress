<?php /** @var Remesh\Content\DemoFormPanel $content */ ?>
@if(!empty($content->identifier()))
    <a name="{{$content->identifier()}}"></a>
@endif
<section class="{{$content->containerCSS()}}">
    <div class="container">
        <div class="interior">
            <div class="left">
                @if(!empty($content->header()))
                    <h2>{!! $content->header() !!}</h2>
                @endif
                @if(!empty($content->text()))
                    <p>{!! $content->text() !!}</p>
                @endif
                <ul>
                    @foreach($content->bulletPoints() as $bulletPoint)
                        <li>
                            <span class="number">{{$loop->index + 1}}</span>
                            <p>{{$bulletPoint}}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="right">
                @if(!empty($content->formEmbed()))
                    {!! $content->formEmbed() !!}
                @else
                    @include('partials.content.demo-form')
                @endif
            </div>
        </div>
    </div>
</section>