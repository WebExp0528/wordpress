<?php /** @var Remesh\Content\StepsPanel $content */ ?>
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
            <ul class="steps">
                @foreach($content->steps() as $step)
                    <li class="step-container" data-transition='fade' data-transition-index='{{$loop->iteration}}'>
                        <div class="header">
                            <span class="step">{{$loop->index + 1}}</span>
                            <hr>
                        </div>
                        <h3>{{$step->title()}}</h3>
                        <div class="responsive">
                            <span class="step">{{$loop->index + 1}}</span>
                            <h3>{{$step->title()}}</h3>
                        </div>
                        <p>{{$step->text()}}</p>
                    </li>
                @endforeach
            </ul>
            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>