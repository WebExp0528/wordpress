<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class Hero extends BaseContentBlock {
	use HasLink;

	protected $style = null;
	protected $title = null;
	protected $text = null;
	protected $image = null;
	protected $demoLink = null;
	protected $videoLink = null;
	protected $formEmbed = null;

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {

		parent::__construct($context, $data, $post, $page, $template);

		$this->style = arrayPath($data, 'style', null);

		if ($this->style == 'demo-hero') {
			$this->template = 'partials.content.demo-hero';
		} else {
			$this->template = 'partials.content.hero';
		}

		$this->style = $this->style . ' page-hero';

		$this->title = arrayPath($data, 'title', null);
		$this->text = arrayPath($data, 'text', null);
		$this->image = $this->parseImage($data, 'image');
		$this->formEmbed = arrayPath($data, 'form_embed', null);

		if (!empty($data['demo_link'])) {
			$this->demoLink = new Link($context, $data['demo_link']);
		}

		if (!empty($data['video_link'])) {
			$this->videoLink = new Link($context, $data['video_link']);
		}
	}

	public function type() {
		return $this->style;
	}

	public function cssPrefix() {
		return '';
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
	public function style() {
		return $this->style;
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
	public function demoLink() {
		return $this->demoLink;
	}

	public function videoLink() {
		return $this->videoLink;
	}

	/**
	 * @return string|null
	 */
	public function formEmbed() {
		return $this->formEmbed;
	}
}