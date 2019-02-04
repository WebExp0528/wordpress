<?php

namespace Remesh\Content;

use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;

class Button {
	use HasLink;

	protected $title = null;
	protected $icon = null;
	protected $description = null;
	protected $link = null;

	public function __construct(Context $context, $data = null) {
		$this->title = arrayPath($data, 'title', null);

		$imageID = arrayPath($data, 'icon', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->icon = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->icon = $context->modelForPost($imageID);
			}
		}

		$this->description = arrayPath($data, 'description', null);

		if (!empty($data['link'])) {
			$this->link = new Link($context, $data['link']);
		} else {
			$this->link = new Link($context, []);
		}
	}

	/**
	 * @return string|null
	 */
	public function title() {
		return $this->title;
	}

	/**
	 * @return null|\Stem\Models\Attachment
	 */
	public function icon() {
		return $this->icon;
	}

	/**
	 * @return string|null
	 */
	public function description() {
		return $this->description;
	}

	/**
	 * @return null|Link
	 */
	public function link() {
		return $this->link;
	}
}