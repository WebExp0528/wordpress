<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class InformationTable extends InformationPanel {
	use HasLink;

	protected $tableItems = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.stacked-panel.table";
		$items = arrayPath($data, 'items', []);
		if (!empty($items)) {
			foreach($items as $item) {
				$this->tableItems[] = new TableItem($context, $item);
			}
		}
	}

	/**
	 * @return TableItem[]
	 */
	public function items() {
		return $this->tableItems;
	}

	public function cssPrefix() {
		return 'info-table-';
	}

}