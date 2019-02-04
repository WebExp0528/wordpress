<?php /** @var Remesh\Content\BiosList $content */ ?>
@if(!empty($content->identifier()))
    <a name="{{$content->identifier()}}"></a>
@endif
<script>
    var animatedSquiggles = {!! get_field('animated_squiggles', 'options') ? 'true' : 'false'  !!};
    var animatedSquiggleDelay = {{ get_field('animation_delay', 'options') ? get_field('animation_delay', 'options') : 100 }};
    var squiggleColors = {!! json_encode(explode("\n", str_replace("\r", "", get_field('squiggle_colors', 'options')))) !!};
</script>
<section class="{{$content->containerCSS()}}">
    <div class="container">
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="info">
                <div class="header">
                    <span class="sub-header">{{$content->title()}}</span>
                    <h2>{!! $content->header() !!}</h2>
                </div>
            </div>
            <div class="bios">
                <div class="squiggle">
                    @svg('ui-squiggles.svg')
                </div>
                @if(count($content->founders()) > 0)
                <div class="founders">
                    <ul>
                        @foreach($content->founders() as $founder)
                            <li>
                                <div class="bio-list-image">
                                    @if(!empty($founder->thumbnail()))
                                    {!! $founder->thumbnail()->img('bio') !!}
                                    @endif
                                </div>
                                <span class="name">{{ $founder->title() }}</span>
                                <span class="title">{{ $founder->jobTitle() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="employees">
                    <ul>
                        @foreach($content->employees() as $employee)
                            <li>
                                <div class="bio-list-image">
                                    @if(!empty($employee->thumbnail()))
                                        {!! $employee->thumbnail()->img('bio') !!}
                                    @endif
                                </div>
                                <span class="name">{{ $employee->title() }}</span>
                                <span class="title">{{ $employee->jobTitle() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>