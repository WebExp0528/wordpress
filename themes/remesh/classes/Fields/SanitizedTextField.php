<?php

namespace Remesh\Fields;

class SanitizedTextField extends \acf_field {
	function __construct() {
		$this->name = 'sanitized_text_field';
		$this->label = __('Sanitized Text Field', 'Remesh');
		$this->category = 'basic';
		$this->defaults = [];
		$this->l10n = [];

		parent::__construct();
	}

	function render_field( $field ) {
		?>
        <input type="text" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo esc_attr($field['value']) ?>" />
		<?php
	}

	function update_value( $value, $post_id, $field ) {
		return sanitize_title(strtolower($value));
	}
}