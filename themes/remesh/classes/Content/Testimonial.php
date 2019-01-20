<?php

namespace Remesh\Content;

use Stem\Core\Context;

class Testimonial {
	protected $testimonial = null;
	protected $reviewer = null;
	protected $logo = null;

	public function __construct(Context $context, $data = null) {
		$this->testimonial = arrayPath($data, 'testimonial', null);
		$this->reviewer = arrayPath($data, 'reviewer', null);

		$imageID = arrayPath($data, 'logo', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->logo = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->logo = $context->modelForPost($imageID);
			}
		}
	}

	/**
	 * @return string|null
	 */
	public function testimonial() {
		return $this->testimonial;
	}

	/**
	 * @return string|null
	 */
	public function reviewer() {
		return $this->reviewer;
	}

	/**
	 * @return null|\Stem\Models\Attachment|\Stem\Models\Page|\Stem\Models\Post
	 */
	public function logo() {
		return $this->logo;
	}
}