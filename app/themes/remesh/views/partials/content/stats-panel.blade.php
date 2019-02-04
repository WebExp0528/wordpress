<?php /** @var Remesh\Content\StatsPanel $content */ ?>
@if(!empty($content->identifier()))
    <a name="{{$content->identifier()}}"></a>
@endif
<section class="{{$content->containerCSS()}}">
    <div class="container">
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="bg-int-ornament-2"></div>
            <div class="header">
                <span class="sub-header">{{ $content->title() }}</span>
            </div>
            <div class="contents">
                <ul class="stats">
                    @foreach($content->stats() as $stat)
                    <li>
                        <span class="stat">{{$stat->value()}}</span>
                        <span class="label">{{$stat->title()}}</span>
                    </li>
                    @endforeach
                    @if($content->link()->valid())
                    <li>
                        {!! $content->link()->a(['button']) !!}
                    </li>
                    @endif
                </ul>
                <div class="photos">
                    @if($content->validPhotos())
                    <div class="photo large" style="background-image:url({!! $content->photos()[0]->image()->src('stats-large') !!}">
                        <span class="caption">
                        {!! $content->photos()[0]->caption() !!}
                        </span>
                    </div>
                    <div class="second-row">
                        <div class="photo medium" style="background-image:url({!! $content->photos()[1]->image()->src('stats-medium') !!}"></div>
                        <div class="right-col">
                            <div class="photo small" style="background-image:url({!! $content->photos()[2]->image()->src('stats-small') !!}"></div>
                            <div class="photo small" style="background-image:url({!! $content->photos()[3]->image()->src('stats-small') !!}"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>