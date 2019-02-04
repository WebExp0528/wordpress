<?php

namespace Remesh\CLI;

use Stem\Core\Command;
use Stem\Core\Context;
use Stem\Core\View;
use Stem\External\Blade\BladeView;

/**
 * Various commands for dealing with arrows CSS
 * @package Remesh\CLI
 */
class ArrowsCommand extends Command {
	private function rotatePoint($x, $y, $cx, $cy, $amount) {
		return [
			'x' => $cx + ($x - $cx) * cos($amount) + ($y - $cy) * sin($amount),
			'y' => $cy - ($x - $cx) * sin($amount) + ($y - $cy) * cos($amount),
		];
	}

	private function rotatedSize($width, $height, $rotation) {
		$p1 = $this->rotatePoint(0, 0, $width / 2.0, $height / 2.0, deg2rad($rotation));
		$p2 = $this->rotatePoint($width, 0, $width / 2.0, $height / 2.0, deg2rad($rotation));
		$p3 = $this->rotatePoint($width, $height, $width / 2.0, $height / 2.0, deg2rad($rotation));
		$p4 = $this->rotatePoint(0, $height, $width / 2.0, $height / 2.0, deg2rad($rotation));

		$minX = min($p1['x'], $p2['x'], $p3['x'], $p4['x']);
		$maxX = max($p1['x'], $p2['x'], $p3['x'], $p4['x']);
		$minY = min($p1['y'], $p2['y'], $p3['y'], $p4['y']);
		$maxY = max($p1['y'], $p2['y'], $p3['y'], $p4['y']);

		return [
			'width' => round($maxX - $minX),
			'height' => round($maxY - $minY)
		];
	}

	public function dumpPresets($args, $assoc_args) {
		$ctx = Context::current();
		if (empty($ctx)) {
			static::Error("Context is invalid or missing.");
			die;
		}

		$arrowsConfig = $ctx->rootPath.'/config/arrows.php';
		if (!file_exists($arrowsConfig)) {
			static::Error("Missing arrows configuration file.");
			die;
		}

		$config = include $arrowsConfig;

		foreach($config['presets'] as $key => $preset) {
			static::Info("$key : {$preset['title']}", true);
		}
	}


	/**
	 * Generates placeholder SCSS from the arrows configuration.
	 *
	 * @when after_wp_load
	 *
	 * @param $args
	 * @param $assoc_args
	 */
	public function generatePlaceholders($args, $assoc_args) {
		$ctx = Context::current();
		if (empty($ctx)) {
			static::Error("Context is invalid or missing.");
			die;
		}

		$arrowsConfig = $ctx->rootPath.'/config/arrows.php';
		if (!file_exists($arrowsConfig)) {
			static::Error("Missing arrows configuration file.");
			die;
		}

		$config = include $arrowsConfig;

		$generatedCSS = [];

		foreach($config['presets'] as $key => $preset) {
			$size = $config['sizes'][$preset['size']];

			$newSize = $this->rotatedSize($size['width'], $size['height'], $preset['rotate']);

			$transforms = [];
			$transformsPX = [];

			if ($preset['flipH'] && $preset['flipV']) {
				$transforms[] = 'scale(-1, -1)';
			} else if ($preset['flipH']) {
				$transforms[] = 'scaleX(-1)';
			} else if ($preset['flipV']) {
				$transforms[] = 'scaleY(-1)';
			}

			if (!empty($preset['rotate'])) {
				$transforms[] = 'rotateZ('.$preset['rotate'].'deg)';
			}

			$generatedCSS['arrow-'.$key] = [
				'size' => $preset['size'],
				'width' => $newSize['width'],
				'height' => $newSize['height'],
				'arrow-width' => $size['width'],
				'arrow-height' => $size['height'],
				'color' => $config['colors'][$preset['color']],
				'svg-transform' => implode(' ', $transforms),
				'svg-transformPX' => implode(' ', $transformsPX),
			];
		}

		$result = BladeView::renderView($ctx, $ctx->ui, 'commands.arrows-scss', [
			'classes' => $generatedCSS,
			'colors' => $config['colors']
		]);

		$scssFile = $ctx->rootPath.'/assets/css/structure/_arrow-presets.scss';
		file_put_contents($scssFile, $result);
	}


	/**
	 * Generates SCSS from the arrows configuration, must run the `generatePlaceholders` command first
	 *
	 * @when after_wp_load
	 *
	 * @param $args
	 * @param $assoc_args
	 */
	public function generateSass($args, $assoc_args) {
		$ctx = Context::current();
		if (empty($ctx)) {
			static::Error("Context is invalid or missing.");
			die;
		}

		$arrowsConfig = $ctx->rootPath.'/config/arrows.php';
		if (!file_exists($arrowsConfig)) {
			static::Error("Missing arrows configuration file.");
			die;
		}

		$config = include $arrowsConfig;

		$generated = "@import \"arrow-presets\";\n\n";

		foreach($config['presets'] as $key => $preset) {
			$generated .= <<<SASS
.arrow-{$key} {
	@extend %arrow-{$key};
	
	@include mq(\$from: design) {
	}
}


SASS;


		}

		$scssFile = $ctx->rootPath.'/assets/css/structure/_arrows.scss';
		file_put_contents($scssFile, $generated);
	}

	public static function Register() {
		\WP_CLI::add_command('arrows', __CLASS__);
	}
}