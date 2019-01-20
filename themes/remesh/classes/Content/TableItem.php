<?php

namespace Remesh\Content;

use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;

class TableItem {
	use HasLink;

	protected $title = null;
	protected $text = null;
	protected $image = null;
	protected $link = null;

	public function __construct(Context $context, $data = null) {
		$this->title = arrayPath($data, 'title', null);
		$this->text = arrayPath($data, 'text', null);

		$imageID = arrayPath($data, 'image', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->image = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->image = $context->modelForPost($imageID);
			}
		}

		$this->link = new Link($context, $data['link']);
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

	/**
	 * @return null|\Stem\Models\Attachment|\Stem\Models\Page|\Stem\Models\Post
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
}