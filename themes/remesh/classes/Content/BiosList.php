<?php

namespace Remesh\Content;

use Remesh\Models\Bio;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

class BiosList extends BaseContentBlock {
	/** @var string|null  */
	protected $title = null;

	/** @var string|null  */
	protected $header = null;

	/** @var null|Arrow  */
	protected $arrow = null;

	/** @var Bio[]  */
	protected $founders = [];

	/** @var Bio[] */
	protected $employees = [];

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$this->template = "partials.content.bios-list";

		$this->title = arrayPath($data, 'title', null);
		$this->header = arrayPath($data, 'header', null);

		$arrowTemplate = arrayPath($data, 'arrow_template', null);
		if (!empty($arrowTemplate) && ($arrowTemplate != 'none')) {
			$arrowColor = arrayPath($data, 'arrow_color', null);
			$this->arrow = new Arrow($arrowTemplate, $arrowColor);
		} else {
			$this->arrow = new Arrow();
		}

		$this->founders = Bio::query()->job_title->equals('Founder')->visible->equals(true)->limit(10000)->get();
		$this->employees = Bio::query()->job_title->notEquals('Founder')->visible->equals(true)->limit(10000)->get();
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
		return "bios-list";
	}

	public function identifier() {

	}

	/**
	 * @return null|Arrow
	 */
	public function arrow() {
		return $this->arrow;
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
	public function header() {
		return $this->header;
	}

	/**
	 * @return Bio[]
	 */
	public function founders() {
		return $this->founders;
	}

	/**
	 * @return Bio[]
	 */
	public function employees() {
		return $this->employees;
	}

}