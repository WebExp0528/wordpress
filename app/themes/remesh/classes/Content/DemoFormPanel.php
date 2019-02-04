<?php

namespace Remesh\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class DemoFormPanel extends BaseContentBlock {
	protected $header = null;
	protected $text = null;
	protected $formEmbed = null;
	protected $bulletPoints = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.demo-form-panel";

		$this->text = arrayPath($data, 'text', null);
		$this->header = arrayPath($data, 'header', null);
		$this->formEmbed = arrayPath($data, 'form_embed', null);

		$bulletPoints = arrayPath($data, 'bullet_list_items', []);
		if (!empty($bulletPoints)) {
			foreach($bulletPoints as $bulletPoint) {
				$this->bulletPoints[] = $bulletPoint['text'];
			}
		}
	}

	/**
	 * Returns the CSS prefix for this block
	 * @return string
	 */
	public function cssPrefix() {
		return '';
	}

	/**
	 * The type of block
	 * @return string
	 */
	public function type() {
		return 'demo-form-panel';
	}

	/**
	 * @return string|null
	 */
	public function header() {
		return $this->header;
	}

	/**
	 * @return string|null
	 */
	public function text() {
		return $this->text;
	}

	/**
	 * @return string|null
	 */
	public function formEmbed() {
		return $this->formEmbed;
	}

	/**
	 * @return string[]
	 */
	public function bulletPoints() {
		return $this->bulletPoints;
	}
}