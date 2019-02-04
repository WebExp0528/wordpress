// Arrow Presets
@foreach($classes as $key => $class)
%{{$key}} {
    z-index: $z-arrow;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    width: px2vw({{$class['width']}}px);
    height: px2vw({{$class['height']}}px);
    svg {
        position: absolute;
        width: px2vw({{$class['arrow-width']}}px);
        height: px2vw({{$class['arrow-height']}}px);
        @if(!empty($class['svg-transform']))
        transform: {!! $class['svg-transform'] !!};
        @endif
        @if(!empty($class['color']))
        #arrow-{{$class['size']}} {
            fill: {{$class['color']}};
        }
        @endif
    }

    {{'@'}}include mq($from: design) {
        width: {{$class['width']}}px;
        height: {{$class['height']}}px;
        svg {
            width: {{$class['arrow-width']}}px;
            height: {{$class['arrow-height']}}px;
        }
    }
}

@endforeach

// Arrow Colors
@foreach($colors as $key => $color)
.arrow-color-{{$key}} {
    svg {
        path {
            fill: {{$color}} !important;
        }
    }
}

@endforeach