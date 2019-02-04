<?php

namespace Remesh\Content;

use Stem\Core\Context;

class StatPhoto {
	protected $caption = null;
	protected $image = null;

	public function __construct(Context $context, $data = null) {
		$this->caption = arrayPath($data, 'caption', null);

		$imageID = arrayPath($data, 'image', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->image = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->image = $context->modelForPost($imageID);
			}
		}
	}

	/**
	 * @return string|null
	 */
	public function caption() {
		return $this->caption;
	}

	/**
	 * @return null|\Stem\Models\Attachment
	 */
	public function image() {
		return $this->image;
	}
}