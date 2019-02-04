<?php

namespace Remesh\Content;

use Stem\Core\Context;

class Stat {
	protected $title = null;
	protected $value = null;

	public function __construct(Context $context, $data = null) {
		$this->title = arrayPath($data, 'title', null);
		$this->value = arrayPath($data, 'value', null);
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
	public function value() {
		return $this->value;
	}
}