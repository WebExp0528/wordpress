@php
    function renderMenuItem($menuItem) {
        $target = (!empty($menuItem['target'])) ? "target='{$menuItem['target']}'" : '';
        $attrs = implode(" ", $menuItem['attrs']);
        $classes = implode(" ", $menuItem['classes']);

        $submenu = '';
        if (isset($menuItem['sub-menu-css'])) {
            $submenu = "data-submenu-css='{$menuItem['sub-menu-css']}'";
        }

        $output = "<a href='{$menuItem['url']}' $target $attrs $submenu rel='{$menuItem['rel']}' class='$classes'>{$menuItem['title']}</a>";

        return $output;
    }

@endphp
<table>
    @foreach($menus as $menu)
    <tr>
        <td class="parent {{(empty($menu['children'])) ? '' : 'has-children'}} {{(in_array('demo', $menu['classes'])) ? 'demo-link' : ''}}">{!! renderMenuItem($menu) !!}</td>
        @if(empty($menu['children']))
        <td></td>
        @else
        <td class="child">{!! renderMenuItem($menu['children'][0]) !!}</td>
        @if(count($menu['children']) > 1)
        @for($i = 1; $i< count($menu['children']); $i++)
    </tr>
    <tr>
        <td></td>
        <td class="child">{!! renderMenuItem($menu['children'][$i]) !!}</td>
        @endfor
        @endif
        @endif
    </tr>
    @endforeach
</table>