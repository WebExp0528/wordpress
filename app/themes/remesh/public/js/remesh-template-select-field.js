(function($){
    var template_select_field = acf.Field.extend({
        type: 'template_select',
        $input: function(){
            return this.$('select');
        }
    });
    acf.registerFieldType(template_select_field);
    acf.registerConditionForFieldType('equalTo', 'template_select');
    acf.registerConditionForFieldType('notEqualTo', 'template_select');
})(jQuery);