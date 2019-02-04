<?php

namespace Remesh\Content;

use Stem\Core\Context;

class Step {
	protected $title = null;
	protected $text = null;

	public function __construct(Context $context, $data = null) {
		$this->title = arrayPath($data, 'title', null);
		$this->text = arrayPath($data, 'text', null);
	}

	/**
	 * @return string|null
	 */
	public function title() {
		return $this->title;
	}

	/**
	 * @return string|null
	 */
	public function text() {
		return $this->text;
	}
}