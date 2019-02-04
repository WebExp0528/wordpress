<?php

namespace Remesh\Content;

use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class StatsPanel extends BaseContentBlock {
	use HasLink;

	/** @var string|null  */
	protected $title = null;

	/** @var null|Arrow  */
	protected $arrow = null;

	/** @var Stat[]  */
	protected $stats = [];

	/** @var StatPhoto[] */
	protected $photos = [];

	/** @var null|Link  */
	protected $link = null;

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.stats-panel";

		$this->title = arrayPath($data, 'title', null);
		$this->header = arrayPath($data, 'header', null);

		$arrowTemplate = arrayPath($data, 'arrow_template', null);
		if (!empty($arrowTemplate) && ($arrowTemplate != 'none')) {
			$arrowColor = arrayPath($data, 'arrow_color', null);
			$this->arrow = new Arrow($arrowTemplate, $arrowColor);
		} else {
			$this->arrow = new Arrow();
		}

		$stats = arrayPath($data, 'stats', []);
		if (!empty($stats)) {
			foreach($stats as $stat) {
				$this->stats[] = new Stat($context, $stat);
			}
		}

		$photos = arrayPath($data, 'photos', []);
		if (!empty($photos)) {
			foreach($photos as $photo) {
				$this->photos[] = new StatPhoto($context, $photo);
			}
		}

		if (!empty($data['link'])) {
			$this->link = new Link($context, $data['link']);
		} else {
			$this->link = new Link($context, []);
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
		return "stats-panel";
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
	 * @return Stat[]
	 */
	public function stats() {
		return $this->stats;
	}

	/**
	 * @return null|Link
	 */
	public function link() {
		return $this->link;
	}

	/**
	 * @return StatPhoto[]
	 */
	public function photos() {
		return $this->photos;
	}

	public function validPhotos() {
		if (count($this->photos) != 4) {
			return false;
		}

		foreach($this->photos as $photo) {
			if (empty($photo->image())) {
				return false;
			}
		}

		return true;
	}

}