<?php /** @var Remesh\Content\Testimonials $content */ ?>
@if(!empty($content->identifier()))
    <a name="{{$content->identifier()}}"></a>
@endif
<section class="{{$content->containerCSS()}}">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="testimonials">
                <span class="sub-header">{{$content->title()}}</span>
                <div class="testimonials-container">
                    @foreach($content->testimonials() as $testimonial)
                    <div class="testimony">
                        <h2>“{{$testimonial->testimonial()}}”</h2>
                        <span class="credit">{{$testimonial->reviewer()}}</span>
                    </div>
                    @endforeach
                </div>
                <div class="nav">
                    <a href="#" class="previous">Previous</a>
                    <a href="#" class="next">Next</a>
                </div>
            </div>
            <div class="logos">
                <div class="logos-container">
                    @foreach($content->testimonials() as $testimonial)
                    <div class="logo">{!! $testimonial->logo()->img() !!}</div>
                    @endforeach
                </div>
            </div>
            <div class="arrow"></div>
        </div>
    </div>
</section>