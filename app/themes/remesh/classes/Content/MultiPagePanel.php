<?php

namespace Remesh\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class MultiPagePanel extends InformationPanel {
	/** @var PanelPage[]  */
	protected $pages = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.multi-page-panel.{$this->type}";

		$background_color = arrayPath($data, 'background_color', null);
		if (!empty($background_color) && ($background_color != 'none')) {
			$this->additionalCSSClasses[] = 'background-'.$background_color;
		}

		$pages = arrayPath($data, 'pages', []);
		if (!empty($pages)) {
			foreach($pages as $page) {
				$this->pages[] = new PanelPage($context, $page);
			}
		}
	}

	/**
	 * @return PanelPage[]
	 */
	public function pages() {
		return $this->pages;
	}

	public function cssPrefix() {
		return 'multi-page-';
	}
}