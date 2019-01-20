<?php

namespace Remesh\Fields;

class TemplateSelectField extends \acf_field {
	static $templateConfig = null;

	function __construct() {
		$this->name = 'template_select';
		$this->label = __('Template Select', 'Remesh');
		$this->category = 'choice';
		$this->defaults = [
			'choices'       => [],
			'template_type' => 'info-panel',
			'allow_null' => true,
			'return_format' => 'value'
		];
		$this->l10n = [];

		parent::__construct();
	}

	public static function templateConfig() {
		if(static::$templateConfig == null) {
			static::$templateConfig = include get_stylesheet_directory() . '/config/templates.php';
		}

		return static::$templateConfig;
	}

	function input_admin_enqueue_scripts() {
		acf_get_field_type('select')->input_admin_enqueue_scripts();

		// register & include JS
		wp_register_script('remesh-template-select-js', get_template_directory_uri() . "/public/js/remesh-template-select-field.js", array('acf-input'), '1.0');
		wp_enqueue_script('remesh-template-select-js');
	}

	function render_field_settings($field) {
		// allow_null
		acf_render_field_setting($field, array('label' => __('Allow Null?', 'acf'), 'instructions' => '', 'name' => 'allow_null', 'type' => 'true_false', 'ui' => 1,));

		if(!empty(static::templateConfig())) {
			$types = [];

			foreach(static::templateConfig() as $key => $typeInfo) {
				$types[$key] = $typeInfo['title'];
			}

			// return_format
			acf_render_field_setting($field, array('label' => __('Template Types', 'acf'), 'instructions' => __('Specify the type of templates to select', 'acf'), 'type' => 'select', 'name' => 'template_type', 'choices' => $types));

			if (!empty($field['template_type'])) {
				$choices = ['none' => 'None'];

				if (!empty(static::templateConfig()[$field['template_type']])) {
					$type = static::templateConfig()[$field['template_type']];
					foreach($type['templates'] as $key => $templateInfo) {
						$choices[$key] = $templateInfo['title'];
					}

					$field['choices'] = acf_encode_choices($choices);
					acf_render_field_setting(
						$field,
						[
							'label'   => __( 'Choices', 'acf' ),
							'name'    => 'choices',
							'type'    => 'textarea',
							'wrapper' => [
								'class' => 'hidden',
							],
						]
					);
				}

			}
		}
	}


	function render_field($field) {
		if(empty(static::templateConfig())) {
			return;
		}

		$templateType = (empty($field['template_type'])) ? 'info-panel' : $field['template_type'];
		if(empty(static::templateConfig()[$templateType])) {
			return;
		}

		$type = static::templateConfig()[$templateType];

		$choices = ['none' => 'None'];

		foreach($type['templates'] as $key => $templateInfo) {
			$choices[$key] = $templateInfo['title'];
		}

		$value = acf_get_array($field['value']);

		// add empty value (allows '' to be selected)
		if(empty($value)) {
			$value = array('');
		}

		// vars
		$select = array('id' => $field['id'], 'class' => $field['class'], 'name' => $field['name'], 'data-ui' => false, 'data-ajax' => false, 'data-multiple' => false, 'data-parent' => $field['parent'], 'data-template-type' => $field['template_type'], 'data-allow_null' => true);


		// append
		$select['value'] = $value;
		$select['choices'] = $choices;


		// render
		acf_select_input($select);

		$script = <<<SCRIPT
<script>
(function($) {
    $('#{$select['id']}').each(function(){
        var select = $(this);
        
	    select.on('change', function(e){
	        $(document).trigger('template-select-changed', select);
	    });
	    
	    $(document).ready(function(){
	        $(document).trigger('template-select-changed', select);
	    });
    });
})(jQuery);
</script>
SCRIPT;

		echo $script;

	}

	public function load_value($value, $post_id, $field) {
		return acf_get_field_type('select')->load_value($value, $post_id, $field);
	}

	public function update_value( $value, $post_id, $field ) {
		return acf_get_field_type( 'select' )->update_value( $value, $post_id, $field );
	}


}