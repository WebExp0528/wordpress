<?php

namespace Remesh\Content;

use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;

class Link {
	use HasLink;

	public function __construct(Context $context, $data, $prefix = '', $cssClasses = []) {
		$this->parseLinkFromData($data, $context, $prefix);

		if (!empty($cssClasses)) {
			$this->linkCSSClasses .= ' '.implode(' ', $cssClasses);
		}
	}

	public function valid() {
		return (!empty($this->linkURL) && ($this->linkType != 'none'));
	}

	public function a($cssClasses = []) {

		$linkContent = [];
		if ($this->linkTitle) {
			$linkContent[] = $this->linkTitle;
		}

		$linkContents = implode('', $linkContent);

		$open = $this->openA($cssClasses);
		if (empty($open)) {
			return '';
		}

		return $open.$linkContents."</a>";
	}

	public function openA($cssClasses = [], $miscAttributes = []) {

		if (empty($this->linkURL) || ($this->linkType == 'none'))
			return '';

		$attributes = [
			'href' => $this->linkURL
		];

		if ($this->linkId) {
			$attributes['id'] = $this->linkId;
		}

		if ($this->linkCSSClasses || !empty($cssClasses)) {
			$classes = $this->linkCSSClasses;
			if (!empty($cssClasses)) {
				$classes .= ' '.implode(' ', $cssClasses);
			}

			$attributes['class'] = $classes;
		}

		if ($this->linkRelationships) {
			$attributes['rel'] = $this->linkRelationships;
		}

		if ($this->linkOpenInNewWindow) {
			$attributes['target'] = '_blank';
		}

		if ($this->linkDownloadFileName) {
			$attributes['download'] = $this->linkDownloadFileName;
		}

		if (!empty($miscAttributes)) {
			$attributes = array_merge($attributes, $miscAttributes);
		}

		$attrs = '';
		foreach($attributes as $key => $value) {
			$attrs.="$key='$value' ";
		}

		$attrs = trim($attrs);

		$openingTag = "<a {$attrs}>";

		if (($this->linkType == 'video') && !empty($this->linkVideoEmbed)) {
			$openingTag .= "\n<script type='text/template'>".$this->linkVideoEmbed."</script>\n";
		}

		return $openingTag;
	}

	public function closeA() {
		return "</a>";
	}
}