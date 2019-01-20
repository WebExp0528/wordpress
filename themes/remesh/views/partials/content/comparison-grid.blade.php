<?php /** @var Remesh\Content\ComparisonGrid $content */ ?>
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
                <h2>{!! $content->header() !!}</h2>
            </div>
            <table>
                <tr>
                    <th scope="col" class="col-0"></th>
                    @foreach($content->columnNames() as $name)
                    <th scope="col" class="col-{{$loop->iteration}}">{{$name}}</th>
                    @endforeach
                </tr>
                @foreach($content->rows() as $row)
                <tr>
                    <th scope="row" class="col-0">{{$row->title()}}</th>
                    @foreach($row->options() as $option)
                    <td class="col-{{$loop->iteration}}">
                        @if(empty($option))
                            @svg('ui-check-off.svg')
                        @else
                            @svg('ui-check-on.svg')
                        @endif
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </table>
            {!! $content->arrow()->render('arrow') !!}
        </div>
    </div>
</section>