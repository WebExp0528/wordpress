<?php 
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

 ?>
<table>
    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td class="parent <?php echo e((empty($menu['children'])) ? '' : 'has-children'); ?> <?php echo e((in_array('demo', $menu['classes'])) ? 'demo-link' : ''); ?>"><?php echo renderMenuItem($menu); ?></td>
        <?php if(empty($menu['children'])): ?>
        <td></td>
        <?php else: ?>
        <td class="child"><?php echo renderMenuItem($menu['children'][0]); ?></td>
        <?php if(count($menu['children']) > 1): ?>
        <?php for($i = 1; $i< count($menu['children']); $i++): ?>
    </tr>
    <tr>
        <td></td>
        <td class="child"><?php echo renderMenuItem($menu['children'][$i]); ?></td>
        <?php endfor; ?>
        <?php endif; ?>
        <?php endif; ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>