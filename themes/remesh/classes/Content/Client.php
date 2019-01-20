<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class Client {
	use HasLink;

	protected $client = null;
	protected $image = null;
	protected $link = null;

	public function __construct(Context $context, $data = null) {
		$this->client = arrayPath($data, 'client', null);

		$imageID = arrayPath($data, 'logo', null);
		if (!empty($imageID)) {
			if (is_numeric($imageID)) {
				$this->image = $context->modelForPostID($imageID);
			} else if ($imageID instanceof \WP_Post) {
				$this->image = $context->modelForPost($imageID);
			}
		}

		$this->link = new Link($context, $data['link']);
	}

	public function client() {
		return $this->client;
	}

	public function image() {
		return $this->image;
	}

	public function link() {
		return $this->link;
	}
}