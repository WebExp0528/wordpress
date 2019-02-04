<?php

namespace Remesh\Content;

use Stem\Core\Context;

class ComparisonItem {
	protected $title = null;
	protected $options = [];

	public function __construct(Context $context, $columnCount = 2, $data = null) {
		$this->title = arrayPath($data, 'title', null);

		for($i = 1; $i <= $columnCount; $i++) {
			$this->options[] = arrayPath($data, "column_{$i}", false);
		}
	}

	/**
	 * @return string|null
	 */
	public function title() {
		return $this->title;
	}

	/**
	 * @return boolean[]|null
	 */
	public function options() {
		return $this->options;
	}
}