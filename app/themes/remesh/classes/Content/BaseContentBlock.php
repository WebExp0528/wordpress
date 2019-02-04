<?php

namespace Remesh\Content;

use ILab\StemContent\Models\ContentBlock;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

abstract class BaseContentBlock extends ContentBlock {
	protected $additionalCSSClasses = [];
	protected $identifier = null;

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		parent::__construct($context, $data, $post, $page, $template);

		$id = arrayPath($data, 'identifier', null);
		if (!empty($id)) {
			$this->identifier = $id;
		}

		$background_template = arrayPath($data, 'background_template', null);
		if (!empty($background_template)) {
			$this->additionalCSSClasses[] = $background_template;
		}
	}

	/**
	 * Returns the CSS prefix for this block
	 * @return string
	 */
	abstract public function cssPrefix();

	/**
	 * The type of block
	 * @return string
	 */
	abstract public function type();

	/**
	 * The unique identifier for this block
	 * @return string|null
	 */
	public function identifier() {
		return $this->identifier;
	}

	/**
	 * The CSS classes for this content block
	 *
	 * @return null|string
	 */
	public function containerCSS() {
		$cssClasses = [$this->cssPrefix().$this->type()];

		if (!empty($this->alignment)) {
			$cssClasses[] = 'info-'.$this->alignment;
		}

		if (!empty($this->additionalCSSClasses)) {
			$cssClasses = array_merge($cssClasses, $this->additionalCSSClasses);
		}

		if (!empty($this->previousBlock) && ($this->previousBlock instanceof BaseContentBlock)) {
			$cssClasses[] = 'previous-'.$this->previousBlock->cssPrefix().$this->previousBlock->type();
		}

		if (!empty($this->nextBlock) && ($this->nextBlock instanceof BaseContentBlock)) {
			$cssClasses[] = 'next-'.$this->nextBlock->cssPrefix().$this->nextBlock->type();
		}

		return implode(' ', $cssClasses);
	}
}