<?php

namespace Remesh\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class StepsPanel extends BaseContentBlock {
	protected $arrow = null;
	protected $title = null;
	protected $steps = null;

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.steps-panel";

		$this->title = arrayPath($data, 'title', null);

		$arrowTemplate = arrayPath($data, 'arrow_template', null);
		if (!empty($arrowTemplate) && ($arrowTemplate != 'none')) {
			$arrowColor = arrayPath($data, 'arrow_color', null);
			$this->arrow = new Arrow($arrowTemplate, $arrowColor);
		} else {
			$this->arrow = new Arrow();
		}

		$background_color = arrayPath($data, 'background_color', null);
		if (!empty($background_color) && ($background_color != 'none')) {
			$this->additionalCSSClasses[] = 'background-'.$background_color;
		}

		$steps = arrayPath($data, 'steps', []);
		if (!empty($steps)) {
			foreach($steps as $step) {
				$this->steps[] = new Step($context, $step);
			}
		}
	}

	/**
	 * Returns the CSS prefix for this block
	 * @return string
	 */
	public function cssPrefix() {
		return "";
	}

	/**
	 * The type of block
	 * @return string
	 */
	public function type() {
		return "steps-panel";
	}

	public function arrow() {
		return $this->arrow;
	}

	public function title() {
		return $this->title;
	}

	public function steps() {
		return $this->steps;
	}

}