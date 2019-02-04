<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class ClientList extends InformationTable {
	protected $clients = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->type = 'client-list';
		$this->template = "partials.content.stacked-panel.client-list";
		$this->header = arrayPath($data, 'header', null);
		$this->title = arrayPath($data, 'title', null);

		$clients = arrayPath($data, 'clients', []);
		foreach($clients as $client) {
			$this->clients[] = new Client($context, $client);
		}
	}

	/**
	 * @return Client[]
	 */
	public function clients() {
		return $this->clients;
	}
}