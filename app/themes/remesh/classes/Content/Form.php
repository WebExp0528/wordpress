<?php

namespace Remesh\Content;

use ILab\StemContent\Traits\Content\HasLink;
use Stem\Core\Context;

class Form {
	protected $action = null;
	protected $method = null;
	protected $fieldName = null;
	protected $type = null;
	protected $placeholder = null;
	protected $buttonLabel = null;
	protected $formEmbed = null;
	protected $hiddenFields = [];

	public function __construct(Context $context, $data = null) {
		$this->action = arrayPath($data, 'form_action', null);
		$this->method = arrayPath($data, 'form_method', null);
		$this->fieldName = arrayPath($data, 'form_field_name', null);
		$this->type = arrayPath($data, 'form_field_type', null);
		$this->placeholder = arrayPath($data, 'form_field_placeholder', null);
		$this->buttonLabel = arrayPath($data, 'form_button_label', null);
		$this->formEmbed = arrayPath($data, 'form_embed', null);

		if (empty($this->fieldName)) {
			$this->fieldName = 'email';
		}

		if (empty($this->type)) {
			$this->type = 'email';
		}

		if (empty($this->placeholder)) {
			$this->placeholder = 'Your e-mail address';
		}

		if (empty($this->buttonLabel)) {
			$this->buttonLabel = 'Submit';
		}

		$hiddenFields = arrayPath($data, 'form_hidden_fields', []);
		if (!empty($hiddenFields)) {
			foreach($hiddenFields as $hiddenField) {
				$this->hiddenFields[$hiddenField['name']] = $hiddenField['value'];
			}
		}
	}

	/**
	 * @return string|null
	 */
	public function action() {
		return $this->action;
	}

	/**
	 * @return string|null
	 */
	public function method() {
		return $this->method;
	}

	/**
	 * @return string|null
	 */
	public function fieldName() {
		return $this->fieldName;
	}

	/**
	 * @return string|null
	 */
	public function type() {
		return $this->type;
	}

	/**
	 * @return string|null
	 */
	public function placeholder() {
		return $this->placeholder;
	}

	/**
	 * @return string|null
	 */
	public function buttonLabel() {
		return $this->buttonLabel;
	}

	/**
	 * @return string|null
	 */
	public function formEmbed() {
		return $this->formEmbed;
	}

	/**
	 * @return array
	 */
	public function hiddenFields() {
		return $this->hiddenFields;
	}

}