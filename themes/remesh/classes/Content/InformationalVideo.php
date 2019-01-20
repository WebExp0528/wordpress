<?php

namespace Remesh\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class InformationalVideo extends InformationPanel {
	protected $video = null;

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->type = 'video';
		$this->template = "partials.content.stacked-panel.video";
		$this->video = arrayPath($data, 'video', null);
	}

	public function video() {
		return $this->video;
	}
}