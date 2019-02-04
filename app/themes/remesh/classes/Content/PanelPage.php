<?php

namespace Remesh\Content;

use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;

class PanelPage {
	use HasLink;

	protected $tabTitle = null;
	protected $tabIcon = null;
	protected $header = null;
	protected $image = null;
	protected $text = null;
	protected $link = null;

	public function __construct(Context $context, $data = null) {
		$this->tabTitle = arrayPath($data, 'tab_title', null);

		$imageID = arrayPath($data, 'tab_icon', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->tabIcon = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->tabIcon = $context->modelForPost($imageID);
			}
		}

		$this->header = arrayPath($data, 'header', null);

		$imageID = arrayPath($data, 'image', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->image = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->image = $context->modelForPost($imageID);
			}
		}

		$this->text = arrayPath($data, 'text', null);

		if (!empty($data['link'])) {
			$this->link = new Link($context, $data['link']);
		} else {
			$this->link = new Link($context, []);
		}
	}

	/**
	 * @return string|null
	 */
	public function tabTitle() {
		return $this->tabTitle;
	}

	/**
	 * @return null|\Stem\Models\Attachment
	 */
	public function tabIcon() {
		return $this->tabIcon;
	}

	/**
	 * @return string|null
	 */
	public function header() {
		return $this->header;
	}

	/**
	 * @return null|\Stem\Models\Attachment
	 */
	public function image() {
		return $this->image;
	}

	/**
	 * @return string|null
	 */
	public function text() {
		return $this->text;
	}

	/**
	 * @return null|Link
	 */
	public function link() {
		return $this->link;
	}
}