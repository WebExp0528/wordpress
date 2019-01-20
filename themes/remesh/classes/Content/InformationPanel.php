<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use ILab\StemContent\Traits\Content\HasLink;
use Illuminate\Support\Arr;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class InformationPanel extends BaseContentBlock {
	use HasLink;

	protected $type = null;
	protected $alignment = null;
	protected $arrow = null;
	protected $image = null;
	protected $title = null;
	protected $header = null;
	protected $text = null;
	protected $link = null;
	protected $form = null;

	protected $gridItems = [];
	protected $bulletPoints = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		if (!$template) {
			$template = 'partials/content/information-panel';
		}

		parent::__construct($context, $data, $post, $page, $template);

		$template = arrayPath($data, 'template', null);
		if (!empty($template) && ($template == 'alt')) {
			$this->additionalCSSClasses[] = 'info-video-alt';
		}

		$this->type = arrayPath($data, 'type', null);
		$this->template = "partials.content.information-panel.{$this->type}";
		$this->alignment = arrayPath($data, 'alignment', null);
		if (is_array($this->alignment)) {
			$this->alignment = (empty($this->alignment)) ? null : $this->alignment[0];
		}
		$arrowTemplate = arrayPath($data, 'arrow_template', null);
		if (!empty($arrowTemplate) && ($arrowTemplate != 'none')) {
			$arrowColor = arrayPath($data, 'arrow_color', null);
			$this->arrow = new Arrow($arrowTemplate, $arrowColor);
		} else {
			$this->arrow = new Arrow();
		}

		$this->header = arrayPath($data, 'header', null);
		$this->title = arrayPath($data, 'title', null);
		$this->text = arrayPath($data, 'text', null);
		$this->image = $this->parseImage($data, 'image');

		if (!empty($data['link'])) {
			$this->link = new Link($context, $data['link']);
		} else {
			$this->link = new Link($context, []);
		}

		$gridItems = arrayPath($data, 'grid_items', []);
		if (!empty($gridItems)) {
			foreach($gridItems as $gridItem) {
				$this->gridItems[] = new GridItem($context, $gridItem);
			}
		}

		$bulletListItems = arrayPath($data, 'bullet_list_items', []);
		if (!empty($bulletListItems)) {
			foreach($bulletListItems as $bulletListItem) {
				$this->bulletPoints[] = arrayPath($bulletListItem, 'text', null);
			}
		}

		$this->form = new Form($context, $data);
	}

	public function cssPrefix() {
		return 'info-';
	}

	/**
	 * @return string|null
	 */
	public function type() {
		return $this->type;
	}

	/**
	 * @return string|null
	 */
	public function alignment() {
		return $this->alignment;
	}

	/**
	 * @return string|null
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
	 * @return string|null
	 */
	public function text() {
		return $this->text;
	}

	/**
	 * @return null|\Stem\Models\Attachment
	 */
	public function image() {
		return $this->image;
	}

	/**
	 * @return null|Link
	 */
	public function link() {
		return $this->link;
	}

	/**
	 * @return GridItem[]
	 */
	public function gridItems() {
		return $this->gridItems;
	}

	/**
	 * @return string[]
	 */
	public function bulletPoints() {
		return $this->bulletPoints;
	}

	/**
	 * @return Form
	 */
	public function form() {
		return $this->form;
	}
}