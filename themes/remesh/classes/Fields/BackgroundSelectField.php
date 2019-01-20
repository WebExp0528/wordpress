<?php

namespace Remesh\Fields;

class BackgroundSelectField extends \acf_field {
	function __construct() {
		$this->name = 'background_select';
		$this->label = __('Background Select', 'Remesh');
		$this->category = 'choice';
		$this->defaults = [
			'allow_null' => true
		];
		$this->l10n = [];

		add_action('wp_ajax_load_remesh_background_templates', array($this, 'loadBackgroundTemplates'));

		parent::__construct();
	}

	function render_field_settings( $field ) {
		// allow_null
		acf_render_field_setting( $field, array(
			'label'			=> __('Allow Null?','acf'),
			'instructions'	=> '',
			'name'			=> 'allow_null',
			'type'			=> 'true_false',
			'ui'			=> 1,
		));

		if(!empty(TemplateSelectField::templateConfig())) {
			$types = ['' => 'None'];

			foreach(TemplateSelectField::templateConfig() as $key => $typeInfo) {
				foreach($typeInfo['templates'] as $templateKey => $templateInfo) {
					$type = "$key/$templateKey";
					$types[$type] = "{$typeInfo['title']} - {$templateInfo['title']}";
				}
			}

			// return_format
			acf_render_field_setting($field, [
				'label' => __('Default Templates', 'acf'),
				'instructions' => __('Specify the default list of background templates', 'acf'),
				'type' => 'select',
				'name' => 'default_templates',
				'choices' => $types
			]);
		}
	}


	function render_field( $field ) {
		$choices = [
			'none' => 'None'
		];

		if (!empty($field['default_templates'])) {
			$def = explode('/', $field['default_templates']);

			if (count($def) > 1) {
				$templatesConfig = TemplateSelectField::templateConfig();
				$backgrounds = arrayPath($templatesConfig, "{$def[0]}/templates/{$def[1]}/backgrounds", null);

				if (!empty($backgrounds)) {
					$choices = array_merge($choices, $backgrounds);
				}
			}
		}

		$value = acf_get_array($field['value']);

		// add empty value (allows '' to be selected)
		if( empty($value) ) {
			$value = array('');
		}

		// vars
		$select = array(
			'id'				=> $field['id'],
			'class'				=> $field['class'],
			'name'				=> $field['name'],
			'data-ui'			=> false,
			'data-ajax'			=> false,
			'data-multiple'		=> false,
			'data-selected-value'		=> $field['value'],
			'data-parent'		=> $field['parent'],
			'data-allow_null'	=> true
		);


		// append
		$select['value'] = $value;
		$select['choices'] = $choices;


		// render
		acf_select_input( $select );

		$script = <<<SCRIPT
<script>
(function($) {
    var request = null;
    
    var findLayoutParent = function(ele) {
    	var parent = ele.parent();
    	while(true) {
    	    if (parent.hasClass('layout')) {
    	        return parent;
    	    }
    	    
    	    parent = parent.parent();
    	}
    };
    
    $(document).on('template-select-changed', function(e, select){
		
        var bgSelect = $('#{$field['id']}');
        var bgLayout = findLayoutParent(bgSelect);
        var selectLayout = findLayoutParent($(select));
        
        if (bgLayout[0] !== selectLayout[0]) {
            return;
        }

		if (request) {
			request.abort();
		}
        
        var data = {
          	action: 'load_remesh_background_templates',
          	template_type: $(select).data('template-type'),
          	template: $(select).val()  
        };
        
        data = acf.prepareForAjax(data);
		
        request = $.ajax({
			url: acf.get('ajaxurl'), // acf stored value
			data: data,
			type: 'post',
			dataType: 'json',
			success: function(json) {
			    console.log(json);
				if (!json) {
					return;
				}
				
				bgSelect.find('option').remove().end();
				
				var selectedValue = bgSelect.data('selected-value');
				var hasSelectedValue = false;
				
				// add the new options to the city field
				for(i=0; i<json.length; i++) {
					var item = '<option value="'+json[i]['value']+'">'+json[i]['label']+'</option>';
					bgSelect.append(item);
					
					if (json[i]['value'] == selectedValue) {
					    hasSelectedValue = true;
					}
				}
				
				if (!hasSelectedValue) {
					bgSelect.val('none');
				} else {
					bgSelect.val(selectedValue);
				}
			}
		});
    });
})(jQuery);
</script>
SCRIPT;

		echo $script;
	}

	public function loadBackgroundTemplates() {
		if (!wp_verify_nonce($_POST['nonce'], 'acf_nonce')) {
			die();
		}

		if (empty($_POST['template_type'])) {
			die();
		}

		if (empty($_POST['template'])) {
			die();
		}

		$template_type = $_POST['template_type'];
		$template = $_POST['template'];

		if (empty(TemplateSelectField::templateConfig()[$template_type])) {
			die();
		}


		$templateInfo = TemplateSelectField::templateConfig()[$template_type];
		if (empty($templateInfo['templates'][$template])) {
			die();
		}

		$options = [];
		$options[] = [
			'value' => 'none',
			'label' => 'None'
		];

		foreach($templateInfo['templates'][$template]['backgrounds'] as $key => $background) {
			$options[] = [
				'value' => $key,
				'label' => $background
			];
		}

		echo json_encode($options);
		exit;
	}
}