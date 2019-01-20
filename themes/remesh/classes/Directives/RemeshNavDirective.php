<?php

namespace Remesh\Directives;

use Stem\Core\Context;
use Stem\Core\ViewDirective;

/**
 * Class RemeshNavDirective
 *
 * Renders a menu
 *
 * @package Remesh\Directives
 */
class RemeshNavDirective extends ViewDirective  {

	public static function renderMenuItem($menuItem) {
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

	public static function renderSubMenuItem($menuItem) {
		$target = (!empty($menuItem['target'])) ? "target='{$menuItem['target']}'" : '';
		$attrs = implode(" ", $menuItem['attrs']);
		$classes = implode(" ", $menuItem['classes']);

		$submenu = '';
		if (isset($menuItem['sub-menu-css'])) {
			$submenu = "data-submenu-css='{$menuItem['sub-menu-css']}'";
		}

		$image = null;
		$imageID = get_field('icon', $menuItem['id'], null);
		if (!empty($imageID)) {
			$image = Context::current()->modelForPostID($imageID);
		}

		$description = get_field('menu-description', $menuItem['id'], null);

		$output = "\t\t\t\t\t<a href='{$menuItem['url']}' $target $attrs $submenu rel='{$menuItem['rel']}' class='$classes'>\n";
		if (!empty($image)) {
			$output .= "\t\t\t\t\t\t<div class='icon'><div class='icon-image' style='background-image: url(".$image->src().")'></div></div>\n";
		}
		$output .= "\t\t\t\t\t\t<div>\n";
		$output .= "\t\t\t\t\t\t\t<span>{$menuItem['title']}</span>\n";
		if (!empty($description)) {
			$output .= "\t\t\t\t\t\t\t<p>{$description}</p>\n";
		}
		$output .= "\t\t\t\t\t\t</div>\n";
		$output .= "\t\t\t\t\t</a>\n";

		return $output;
	}

	public static function OutputFlatMenu($slug) {
		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		$current_url = trim($current_url, "/");
		$menuArray = wp_get_nav_menu_items($slug);

		if (empty($menuArray)) {
			return "";
		}

		$menuItems = [];
		foreach($menuArray as $menu) {
			if ($menu instanceof \WP_Post) {
				$anchor = get_field('anchor', $menu) ?: '';
				$menuItem = [
					'id' => $menu->ID,
					'title' => $menu->title,
					'url' => ($menu->url ?: get_permalink($menu->object_id)).$anchor,
					'target' => $menu->target,
					'attrs' => [
						"data-menu-id='{$menu->ID}'"
					],
					'classes' => [],
					'children' => []
				];

				if (trim($menuItem['url'],"/") == $current_url) {
					$menuItem["classes"][] = "current";
				}

				if (strpos($menuItem['url'],'#') === false) {
					$menuItem['rel'] = "nofollow noopener";
				} else {
					$menuItem['rel'] = "";
				}

				foreach($menu->classes as $class)
					if (!empty($class)) {
						$menuItem['classes'][] = $class;
					}

				if (empty($menu->menu_item_parent)) {
					$subMenuCSS = get_field('sub_menu_css_classes', $menu->ID);

					if (!empty($subMenuCSS)) {
						$menuItem['sub-menu-css']=$subMenuCSS;
					}

					$menuItems[$menu->ID] = $menuItem;
				} else {
					if (!in_array('has-children', $menuItems[$menu->menu_item_parent]['classes'])) {
						$menuItems[$menu->menu_item_parent]['classes'][] = 'has-children';
					}

					$menuItem['attrs'][] = "data-parent-menu-id='{$menu->menu_item_parent}'";
					$menuItem['classes'][''] = 'sub-item';

					$children = $menuItems[$menu->menu_item_parent]['children'];
					$children[] = $menuItem;
					$menuItems[$menu->menu_item_parent]['children'] = $children;
				}
			}
		}

		$output = "<ul>\n";
		foreach($menuItems as $menuItem) {
			$classes = empty($menuItem['children']) ? '' : ' class="has-sub-menu"';
			$output .= "\t<li{$classes}>";
			$output .= static::renderMenuItem($menuItem);

			if (empty($menuItem['children'])) {
				$output .= "</li>\n";
			} else {
				$output .= "\n";
				$output .= "\t\t<div class=\"sub-menu\">\n";
				$output .= "\t\t\t<ul>\n";

				foreach($menuItem['children'] as $child) {
					$output .= "\t\t\t\t<li>\n";
					$output .= static::renderSubMenuItem($child);
					$output .= "\t\t\t\t</li>\n";
				}

				$output .= "\t\t\t</ul>\n";
				$output .= "\t\t</div>\n";
				$output .= "</li>\n";
			}

		}
		$output .= "</ul>\n";


		return $output;
	}

	public function execute($args) {
		if (count($args) == 0) {
			throw new \Exception('Missing menu slug argument for @menu directive.');
		}

		return "<?php echo Remesh\\Directives\\RemeshNavDirective::OutputFlatMenu('{$args[0]}'); ?>";
	}
}