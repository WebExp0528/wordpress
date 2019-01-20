<?php

namespace Remesh\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class MultiButtonPanel extends InformationPanel {
	/** @var Button[]  */
	protected $buttons = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->type = 'simple';

		$this->template = "partials.content.multi-button-panel.{$this->type}";

		$buttons = arrayPath($data, 'buttons', []);
		if (!empty($buttons)) {
			foreach($buttons as $button) {
				$this->buttons[] = new Button($context, $button);
			}
		}
	}

	/**
	 * @return Button[]
	 */
	public function buttons() {
		return $this->buttons;
	}

	public function cssPrefix() {
		return 'multi-button-';
	}
}