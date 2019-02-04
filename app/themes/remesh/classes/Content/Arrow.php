<?php

namespace Remesh\Content;

use Stem\Core\Context;

class Arrow {
	private $presetName = null;
	private $preset = null;
	private $color = null;

	private static $arrowConfig = null;

	protected static function arrowConfig() {
		if (static::$arrowConfig == null) {
			$arrowConfigFile = get_template_directory().'/config/arrows.php';
			static::$arrowConfig = include $arrowConfigFile;
		}

		return static::$arrowConfig;
	}

	public function __construct($presetName = null, $color = null) {
		$arrowConfig = static::arrowConfig();
		if (empty($arrowConfig) || empty($arrowConfig['presets'])) {
			throw new \Exception("Arrow configuration is missing or incorrect.");
		}

		if (!empty($presetName) && empty($arrowConfig['presets'][$presetName])) {
			throw new \Exception("Arrow configuration is missing preset named '$presetName'");
		}

		if (!empty($presetName)) {
			$this->presetName = $presetName;
			$this->preset = $arrowConfig['presets'][$presetName];
			$this->color = $color;
		}
	}

	public function render($location) {
		if (empty($this->preset)) {
			return '';
		}

		if ($location != $this->preset['target']) {
			return '';
		}

		$svgFile = get_template_directory()."/public/img/arrows/arrow-{$this->preset['size']}.svg";
		if (!file_exists($svgFile)) {
			return '';
		}

		$svg = file_get_contents($svgFile);
		$svg = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $svg);
		$svg = str_replace("<?xml version='1.0' encoding='UTF-8'?>", '', $svg);

		$cssClasses = ["arrow", "arrow-{$this->presetName}"];
		if (!empty($this->color)) {
			$cssClasses[] = "arrow-color-{$this->color}";
		}

		$cssClassesText = implode(' ', $cssClasses);

		return "<div class='{$cssClassesText}'>{$svg}</div>";
	}
}