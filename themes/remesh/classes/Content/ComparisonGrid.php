<?php

namespace Remesh\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class ComparisonGrid extends BaseContentBlock {
	protected $title = null;
	protected $header = null;
	protected $arrow = null;
	protected $columnCount = 2;
	protected $columnNames = [];
	protected $rows = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.comparison-grid";

		$this->title = arrayPath($data, 'title', null);
		$this->header = arrayPath($data, 'header', null);

		$arrowTemplate = arrayPath($data, 'arrow_template', null);
		if (!empty($arrowTemplate) && ($arrowTemplate != 'none')) {
			$arrowColor = arrayPath($data, 'arrow_color', null);
			$this->arrow = new Arrow($arrowTemplate, $arrowColor);
		} else {
			$this->arrow = new Arrow();
		}

		$this->columnCount = arrayPath($data, 'number_of_columns', 2);
		for($i = 1; $i <= $this->columnCount; $i++) {
			$this->columnNames[] = arrayPath($data, "column_{$i}_name", null);
		}

		$rows = arrayPath($data, 'data', []);
		if (!empty($rows)) {
			foreach($rows as $row) {
				$this->rows[] = new ComparisonItem($context, $this->columnCount, $row);
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
		return "comparison-grid";
	}

	/**
	 * @return null|Arrow
	 */
	public function arrow() {
		return $this->arrow;
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
	public function header() {
		return $this->header;
	}

	/**
	 * @return int
	 */
	public function columnCount() {
		return $this->columnCount;
	}

	/**
	 * @return string[]
	 */
	public function columnNames() {
		return $this->columnNames;
	}

	/**
	 * @return ComparisonItem[]
	 */
	public function rows() {
		return $this->rows;
	}

}