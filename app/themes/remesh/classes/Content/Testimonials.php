<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class Testimonials extends BaseContentBlock {
	protected $title = null;
	protected $testimonials = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		if (!$template) {
			$template = 'partials.content.testimonials';
		}

		parent::__construct($context, $data, $post, $page, $template);

		$this->title = arrayPath($data, 'title', null);

		$type = arrayPath($data, 'type', null);
		if (!empty($type) && ($type == 'aqua')) {
			$this->additionalCSSClasses[] = 'testimonial-aqua';
		}

		$testimonials = arrayPath($data, 'testimonials', []);
		if (!empty($testimonials)) {
			foreach($testimonials as $testimonial) {
				$this->testimonials[] = new Testimonial($context, $testimonial);
			}
		}

		$this->additionalCSSClasses[] = 'testimonial-slider';
	}

	/**
	 * @return string|null
	 */
	public function title() {
		return $this->title;
	}

	/**
	 * @return Testimonial[]
	 */
	public function testimonials() {
		return $this->testimonials;
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
		return "testimonial";
	}
}