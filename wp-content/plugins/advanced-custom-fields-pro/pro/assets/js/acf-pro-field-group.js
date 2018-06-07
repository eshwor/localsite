(function($){        
	
	/*
	*  Repeater
	*
	*  This field type requires some extra logic for its settings
	*
	*  @type	function
	*  @date	24/10/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	var RepeaterCollapsedFieldSetting = acf.FieldSetting.extend({
		type: 'repeater',
		name: 'collapsed',
		events: {
			'focus select': 'onFocus',
		},
		onFocus: function( e, $el ){
			
			// vars
			var $select = $el;
			
			// collapsed
			var choices = [];
			
			// keep 'null' choice
			choices.push({
				label: $select.find('option[value=""]').text(),
				value: ''
			});
			
			// find sub fields
			var $list = this.fieldObject.$('.acf-field-list:first');
			var fields = acf.getFieldObjects({
				list: $list
			});
			
			// loop
			fields.map(function( field ){
				choices.push({
					label: field.prop('label'),
					value: field.prop('key')
				});
			});			
			
			// render
			acf.renderSelect( $select, choices );
		}
	});
	
	acf.registerFieldSetting( RepeaterCollapsedFieldSetting );
	
})(jQuery);

(function($){        
	
	/**
	*  CloneDisplayFieldSetting
	*
	*  Extra logic for this field setting
	*
	*  @date	18/4/18
	*  @since	5.6.9
	*
	*  @param	void
	*  @return	void
	*/
	
	var FlexibleContentLayoutFieldSetting = acf.FieldSetting.extend({
		type: 'flexible_content',
		name: 'fc_layout',
		
		events: {
			'blur .layout-label':		'onChangeLabel',
			'click .add-layout':		'onClickAdd',
			'click .duplicate-layout':	'onClickDuplicate',
			'click .delete-layout':		'onClickDelete'
		},
		
		findInput: function( name ){
			return $('#' + this.getInputId() + '-' + name);
		},
		
		getInputId: function(){
			return this.fieldObject.getInputId() + '-layouts-' + this.field.get('id');
		},
		
		render: function(){
			
			// add sortable
			var $tbody = this.$el.parent();
			if( !$tbody.hasClass('ui-sortable') ) {
				
				$tbody.sortable({
					items: '> .acf-field-setting-fc_layout',
					handle: '[data-name="acf-fc-reorder"]',
					forceHelperSize: true,
					forcePlaceholderSize: true,
					scroll: true,
		   			stop: this.proxy(function(event, ui) {
						this.fieldObject.save();
		   			})
				});
			}
			
			// add meta to sub fields
			this.updateFieldLayouts();
		},
		
		updateFieldLayouts: function(){
			
			// vars
			var $list = this.$('.acf-field-list:first');
			var fields = acf.getFieldObjects({
				list: $list
			});
			
			// loop
			fields.map(this.updateFieldLayout, this);
			
		},
		
		updateFieldLayout: function( field ){
			field.prop('parent_layout', this.get('id'));
		},
		
		reset: function(){
			
			// vars
			var $list = this.$('.acf-field-list:first');
			
			// remove sub fields
			$list.children('.acf-field-object').remove();
			
			// show empty
			$list.addClass('-empty');
			
			// reset layout meta values
			this.$('.acf-fc-meta input').val('');
		},
		
		onChangeLabel: function( e, $el ){
			
			// vars
			var label = $el.val();
			var $name = this.findInput('name');
			
			// render name
			if( $name.val() == '' ) {
				acf.val($name, acf.strSanitize(label));
			}
		},
		
		getList: function(){
			return this.$('.acf-field-list:first');
		},
		
		getChildren: function(){
			return acf.getFieldObjects({ list: this.getList() });
		},
		
		wipe: function(){
			
			// vars
			var layoutKey = this.get('id');
			
			// update hidden input
			this.$('.layout-key').val( layoutKey );
			
			// refresh children
			this.getChildren().map(function( child ){
				child.wipe();
				child.prop('parent_layout', layoutKey);
				child.save();
			});
		},

		onClickAdd: function( e, $el ){
			
			// duplicate
			$layout = acf.duplicate({
				$el: this.$el,
				after: function( $el, $el2 ){
					
					// vars
					var $list = $el2.find('.acf-field-list:first');
					
					// remove sub fields
					$list.children('.acf-field-object').remove();
					
					// show empty
					$list.addClass('-empty');
					
					// reset layout meta values
					$el2.find('.acf-fc-meta input').val('');
				}
			});
			
			// get layout
			var layout = acf.getFieldSetting( $layout );
			
			// wipe layout
			layout.wipe();
			
			// save
			this.fieldObject.save();
		},
			
		onClickDuplicate: function( e, $el ){
			
			// duplicate
			$layout = acf.duplicate({
				$el: this.$el
			});
			
			// get layout
			var layout = acf.getFieldSetting( $layout );
			
			// wipe layout
			layout.wipe();
			
			// save
			this.fieldObject.save();		
		},
		
		onClickDelete: function( e, $el ){
			
			// add class
			this.$el.addClass('-hover');
			
			// add tooltip
			var tooltip = acf.newTooltip({
				confirmRemove: true,
				target: $el,
				context: this,
				confirm: function(){
					this.delete();
				},
				cancel: function(){
					this.$el.removeClass('-hover');
				}
			});
		},
		
		delete: function(){
			
			// vars
			var $siblings = this.$el.siblings('.acf-field-setting-fc_layout');
			
			// validate
			if( !$siblings.length ) {
				alert( acf._e('flexible_content', 'layout_warning') );
				return false;
			}
			
			// delete sub fields
			this.getChildren().map(function( child ){
				child.delete({
					animate: false
				});
			});
			
			// remove tr
			acf.remove( this.$el );
			
			// save
			this.fieldObject.save();
		}
		
	});
	
	acf.registerFieldSetting( FlexibleContentLayoutFieldSetting );
	
	
	/**
	*  flexibleContentHelper
	*
	*  description
	*
	*  @date	19/4/18
	*  @since	5.6.9
	*
	*  @param	type $var Description. Default.
	*  @return	type Description.
	*/
	
	var flexibleContentHelper = new acf.Model({
		actions: {
			'sortstop_field_object':		'updateParentLayout',
			'change_field_object_parent': 	'updateParentLayout'
		},
		
		updateParentLayout: function( fieldObject ){
			
			// vars
			var parent = fieldObject.getParent();
			
			// delete meta
			if( !parent || parent.prop('type') !== 'flexible_content' ) {
				fieldObject.prop('parent_layout', null);
				return;
			}
			
			// get layout
			var $layout = fieldObject.$el.closest('.acf-field-setting-fc_layout');
			var layout = acf.getFieldSetting($layout);
			
			// check if previous prop exists
			// - if not, set prop to allow following code to trigger 'change' and save the field
			if( !fieldObject.has('parent_layout') ) {
				fieldObject.prop('parent_layout', 0);
			}
			
			// update meta
			fieldObject.prop('parent_layout', layout.get('id'));
		}
	});
	
})(jQuery);

(function($){        
	
	/**
	*  CloneDisplayFieldSetting
	*
	*  Extra logic for this field setting
	*
	*  @date	18/4/18
	*  @since	5.6.9
	*
	*  @param	void
	*  @return	void
	*/
	
	var CloneDisplayFieldSetting = acf.FieldSetting.extend({
		type: 'clone',
		name: 'display',
		render: function(){
			
			// vars
			var display = this.field.val();
			
			// set data attribute used by CSS to hide/show
			this.$fieldObject.attr('data-display', display);
		}
	});
	
	acf.registerFieldSetting( CloneDisplayFieldSetting );
	
	
	/**
	*  ClonePrefixLabelFieldSetting
	*
	*  Extra logic for this field setting
	*
	*  @date	18/4/18
	*  @since	5.6.9
	*
	*  @param	void
	*  @return	void
	*/
	
	var ClonePrefixLabelFieldSetting = acf.FieldSetting.extend({
		type: 'clone',
		name: 'prefix_label',
		render: function(){
			
			// vars
			var prefix = '';
			
			// if checked
			if( this.field.val() ) {
				prefix = this.fieldObject.prop('label') + ' ';
			}
			
			// update HTML
			this.$('code').html( prefix + '%field_label%' );
		}
	});
	
	acf.registerFieldSetting( ClonePrefixLabelFieldSetting );
	
	
	/**
	*  ClonePrefixNameFieldSetting
	*
	*  Extra logic for this field setting
	*
	*  @date	18/4/18
	*  @since	5.6.9
	*
	*  @param	void
	*  @return	void
	*/
	
	var ClonePrefixNameFieldSetting = acf.FieldSetting.extend({
		type: 'clone',
		name: 'prefix_name',
		render: function(){
			
			// vars
			var prefix = '';
			
			// if checked
			if( this.field.val() ) {
				prefix = this.fieldObject.prop('name') + '_';
			}
			
			// update HTML
			this.$('code').html( prefix + '%field_name%' );
		}
	});
	
	acf.registerFieldSetting( ClonePrefixNameFieldSetting );
	
	
	/**
	*  cloneFieldSelectHelper
	*
	*  Customizes the clone field setting Select2 isntance
	*
	*  @date	18/4/18
	*  @since	5.6.9
	*
	*  @param	void
	*  @return	void
	*/
	
	var cloneFieldSelectHelper = new acf.Model({
		filters: {
			'select2_args': 'select2Args'
		},
		
		select2Args: function( options, $select, data, $el, instance ){
			
			// check
			if( data.ajaxAction == 'acf/fields/clone/query' ) {
				
				// remain open on select
				options.closeOnSelect = false;
				
				// customize ajaxData function
				instance.data.ajaxData = this.ajaxData;
			}
			
			// return
			return options;
		},
		
		ajaxData: function( data ){
			
			// find current fields
			data.fields = {};
			
			// loop
			acf.getFieldObjects().map(function(fieldObject){
				
				// append
				data.fields[ fieldObject.prop('key') ] = {
					key: fieldObject.prop('key'),
					type: fieldObject.prop('type'),
					label: fieldObject.prop('label'),
					ancestors: fieldObject.getParents().length
				};
			});
			
			// append title
			data.title = $('#title').val();
			
			// return
			return data;
		}
	});
	
})(jQuery);

// @codekit-prepend "../js/acf-setting-repeater.js
// @codekit-prepend "../js/acf-setting-flexible-content.js
// @codekit-prepend "../js/acf-setting-clone.js

