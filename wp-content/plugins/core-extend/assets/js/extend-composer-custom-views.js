(function($) {
	"use strict";

	var Shortcodes = vc.shortcodes;
    window.VcRowView = vc.shortcode_view.extend({
        change_columns_layout:false,
        events:{
            'click > .controls .column_delete':'deleteShortcode',
            'click > .controls .set_columns':'setColumns',
            'click > .controls .column_add':'addElement',
            'click > .controls .column_edit':'editElement',
            'click > .controls .column_clone':'clone',
            'click > .controls .column_move':'moveElement',
            'click > .controls .column_toggle': 'toggleElement',
            'click > .wpb_element_wrapper .vc_controls': 'openClosedRow'
        },
        convertRowColumns:function (layout) {
            var layout_split = layout.toString().split(/\_/),
                columns = Shortcodes.where({parent_id:this.model.id}),
                new_columns = [],
                new_layout = [],
                new_width = '';
            _.each(layout_split, function (value, i) {
                var column_data = _.map(value.toString().split(''), function (v, i) {
                        return parseInt(v, 10);
                    }),
                    new_column_params, new_column;
                if(column_data.length > 3)
                    new_width = column_data[0] + '' + column_data[1] + '/' + column_data[2] + '' + column_data[3];
                else if(column_data.length > 2)
                    new_width = column_data[0] + '/' + column_data[1] + '' + column_data[2];
                else
                    new_width = column_data[0] + '/' + column_data[1];
                new_layout.push(new_width);
                new_column_params = _.extend(!_.isUndefined(columns[i]) ? columns[i].get('params') : {}, {width: new_width}),
                vc.storage.lock();
                new_column = Shortcodes.create({shortcode:(this.model.get('shortcode') === 'vc_row_inner' ? 'vc_column_inner' : 'vc_column'), params:new_column_params, parent_id:this.model.id});
                if (_.isObject(columns[i])) {
                    _.each(Shortcodes.where({parent_id:columns[i].id}), function (shortcode) {
                        vc.storage.lock();
                        shortcode.save({parent_id:new_column.id});
                        vc.storage.lock();
                        shortcode.trigger('change_parent_id');
                    });
                }
                new_columns.push(new_column);
            }, this);
            if (layout_split.length < columns.length) {
                _.each(columns.slice(layout_split.length), function (column) {
                    _.each(Shortcodes.where({parent_id:column.id}), function (shortcode) {
                        vc.storage.lock();
                        shortcode.save({'parent_id':_.last(new_columns).id});
                        vc.storage.lock();
                        shortcode.trigger('change_parent_id');
                    });
                });
            }
            _.each(columns, function (shortcode) {
                vc.storage.lock();
                shortcode.destroy();
            }, this);
            this.model.save();
            this.setActiveLayoutButton('' + layout);
            // this.sizeRows();
            return new_layout;
        },
        changeShortcodeParams:function (model) {
          window.VcRowView.__super__.changeShortcodeParams.call(this, model);

          this.buildDesignHelpers();
        },
        buildDesignHelpers: function() {
          //var css = this.model.getParam('css'),
          //$column_toggle = this.$el.find('> .controls .column_toggle'),
          //image, color, $image, $color;
			  
		  var image = this.model.getParam('bg_image'),
		  color = this.model.getParam('bg_color'),
		  $column_toggle = this.$el.find('> .controls .column_toggle');
		  
          this.$el.find('> .controls .vc_row_color').remove();
          this.$el.find('> .controls .vc_row_image').remove();
		 
          var matches = image.match(/background\-image:\s*url\(([^\)]+)\)/)
          if(matches && !_.isUndefined(matches[1])) {
            image = matches[1];
          } /*
          var matches = css.match(/background\-color:\s*([^\s\;]+)\b/)
          if(matches && !_.isUndefined(matches[1])) {
            color = matches[1];
          }*/
          var matches = image.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/)
          if(matches && !_.isUndefined(matches[1])) {
            image = matches[2];
          }
		  
		  
		  // "Hide on screens sizes" preview
          this.$el.find('> .controls .vc_row_screens').remove();
		  var row_show_on = this.model.getParam('row_show_on');
		  if(row_show_on) {		  
		    var hide_on_screen = ' '+ row_show_on.replace(/,/gi, ' ');
		  } else {
		    var hide_on_screen = '';
		  }
          $('<span class="vc_row_screens'+ hide_on_screen +'"><i class="device-icon device-screen"></i><i class="device-icon device-tablet2"></i><i class="device-icon device-tablet"></i><i class="device-icon device-mobile2"></i><i class="device-icon device-mobile"></i></span>').insertAfter($column_toggle);
		  // End preview
		  

          if(color) {
            $('<span class="vc_row_color" style="background-color: ' + color + '" title="' + i18nLocale.row_background_color + '"></span>')
              .insertAfter($column_toggle);
          }
        },
        addElement: function(e) {
          e && e.preventDefault();
          var new_column = Shortcodes.create({shortcode:(this.model.get('shortcode') === 'vc_row_inner' ? 'vc_column_inner' : 'vc_column'), params:{}, parent_id:this.model.id});
          this.setActiveLayoutButton();
          this.$el.removeClass('vc_collapsed-row');
        },
        _getCurrentLayoutString: function() {
            var layouts = [];
            $('> .wpb_vc_column, > .wpb_vc_column_inner', this.$content).each(function () {
                var width = $(this).data('width');
                layouts.push(!width ? '1/1' : width);
            });
            return layouts.join(' + ');
        },
        setSorting:function () {
            var that = this;
            if (this.$content.find("> [data-element_type=vc_column], > [data-element_type=vc_column_inner]").length > 1) {
                this.$content.removeClass('wpb-not-sortable').sortable({
                    forcePlaceholderSize:true,
                    placeholder:"widgets-placeholder-column",
                    tolerance:"pointer",
                    // cursorAt: { left: 10, top : 20 },
                    cursor:"move",
                    //handle: '.controls',
                    items:"> [data-element_type=vc_column], > [data-element_type=vc_column_inner]", //wpb_sortablee
                    distance:0.5,
                    start:function (event, ui) {
                        $('#visual_composer_content').addClass('vc_sorting-started');
                        ui.placeholder.width(ui.item.width());
                    },
                    stop:function (event, ui) {
                        $('#visual_composer_content').removeClass('vc_sorting-started');
                    },
                    update:function () {
                        var $columns = $("> [data-element_type=vc_column], > [data-element_type=vc_column_inner]", that.$content);
                        $columns.each(function () {
                            var model = $(this).data('model'),
                                index = $(this).index();
                            model.set('order', index);
                            if ($columns.length - 1 > index) vc.storage.lock();
                            model.save();
                        });
                    },
                    over:function (event, ui) {
                        ui.placeholder.css({maxWidth:ui.placeholder.parent().width()});
                        ui.placeholder.removeClass('vc_hidden-placeholder');
                        // if (ui.item.hasClass('not-column-inherit') && ui.placeholder.parent().hasClass('not-column-inherit')) {
                        //     ui.placeholder.addClass('hidden-placeholder');
                        // }
                    },
                    beforeStop:function (event, ui) {
                        // if (ui.item.hasClass('not-column-inherit') && ui.placeholder.parent().hasClass('not-column-inherit')) {
                        //     return false;
                        // }
                    }
                });
            } else {
                if (this.$content.hasClass('ui-sortable')) this.$content.sortable('destroy');
                this.$content.addClass('wpb-not-sortable');
            }
        },
        validateCellsList: function(cells) {
            var return_cells = [],
                split = cells.replace(/\s/g, '').split('+'),
                b;
            var sum = _.reduce(_.map(split, function(c){
                if(c.match(/^[vc\_]{0,1}span\d{1,2}$/)) {
                    var converted_c = vc_convert_column_span_size(c);
                    if(converted_c===false) return 1000;
                    b = converted_c.split(/\//);
                    return_cells.push(b[0] + '' + b[1]);
                    return 12*parseInt(b[0], 10)/parseInt(b[1], 10);
                } else if(c.match(/^[1-9]|1[0-2]\/[1-9]|1[0-2]$/)) {
                    b = c.split(/\//);
                    return_cells.push(b[0] + '' + b[1]);
                    return 12*parseInt(b[0], 10)/parseInt(b[1], 10);
                }
                return 10000;

            }), function(num, memo) {
                memo = memo + num;
                return memo;
            }, 0);
            if(sum!==12) return false;
            return return_cells.join('_');
        },
        setActiveLayoutButton: function(column_layout) {
          if( !column_layout ) {
            var layout = [];
            layout =
            column_layout = _.map(vc.shortcodes.where({parent_id: this.model.get('id')}), function(model){
              var width = model.getParam('width');
              return !width ? '11' : width.replace(/\//, '');
            }).join('_');
          }
          this.$el.find('> .controls .vc_active').removeClass('vc_active');
          var $button = this.$el.find('> .controls [data-cells-mask=' + vc_get_column_mask(column_layout) + ']');
          if($button.length) {
            $button.addClass('vc_active');
          } else {
            this.$el.find('> .controls [data-cells-mask=custom]').addClass('vc_active');
          }
        },
        layoutEditor: function() {
          if(_.isUndefined(vc.row_layout_editor)) vc.row_layout_editor = new vc.RowLayoutEditorPanelViewBackend({el: $('#vc_row-layout-panel')});
          return vc.row_layout_editor;
        },
        setColumns:function (e) {
            if (_.isObject(e)) e.preventDefault();
            var $button = $(e.currentTarget);
            if($button.data('cells')==='custom') {
                this.layoutEditor().render(this.model).show();
                    } else {
            if(vc.is_mobile) {
              var $parent = $button.parent();
              if(!$parent.hasClass('vc_visible')) {
                $parent.addClass('vc_visible');
                $(document).bind('click.vcRowColumnsControl', function(e){
                  $parent.removeClass('vc_visible');
                  $(document).unbind('click.vcRowColumnsControl');
                });
              }
            }
                if (!$button.is('.vc_active')) {
            this.change_columns_layout = true;
                _.defer(function (view, cells) {
                    view.convertRowColumns(cells);
                }, this, $button.data('cells'));
                }
            }
            this.$el.removeClass('vc_collapsed-row');
        },
        sizeRows: function () {
            var max_height = 45;
            $('> .wpb_vc_column, > .wpb_vc_column_inner', this.$content).each(function () {
                var content_height = $(this).find('> .wpb_element_wrapper > .wpb_column_container').css({minHeight:0}).height();
                if (content_height > max_height) max_height = content_height;
            }).each(function () {
                    $(this).find('> .wpb_element_wrapper > .wpb_column_container').css({minHeight:max_height });
                });
        },
        ready:function (e) {
            window.VcRowView.__super__.ready.call(this, e);
            return this;
        },
        checkIsEmpty:function () {
            window.VcRowView.__super__.checkIsEmpty.call(this);
            this.setSorting();
        },
        changedContent:function (view) {
            // this.sizeRows();
            if (this.change_columns_layout) return this;
            this.setActiveLayoutButton();
            // this.sizeRows();
        },
        moveElement:function (e) {
            e.preventDefault();
        },
        toggleElement: function(e) {
            e && e.preventDefault();
            var $control = $(e.currentTarget);
            this.$el.toggleClass('vc_collapsed-row');
            // this.setParentSize();
        },
        openClosedRow: function(e) {
          var $control;
          this.$el.removeClass('vc_collapsed-row');
          // this.setParentSize();
        },
        setParentSize: function() {
          if(this.model.get('shortcode') === 'vc_row_inner') {
              var $parent = this.$el.parents('[data-element_type=vc_row]:first'),
                  parent_id;
              if($parent.length) {
                parent_id = $parent.data('modelId');
                parent_id && vc.app.views[parent_id].sizeRows();
              }
          }
        }
    });

	
	window.VcIconView = vc.shortcode_view.extend({
	   changeShortcodeParams:function (model) {
		 var params = model.get('params');
		 window.VcIconView.__super__.changeShortcodeParams.call(this, model);
		 if (_.isObject(params) && _.isString(params.name)) {
			if(_.isString(params.icon_color)){
					var icon_style = ' color:'+ params.icon_color;
			} else {
					var icon_style = '';
			}
			
			this.$el.find('.wpb_element_wrapper').html('<h4 class="wpb_element_title"><span class="vc_element-icon icon-wpb-vc_icons"></span></h4><i style="font-size:32px;'+ icon_style +'" class="fa ' + params.name + '"></i>');
		 }
	   }
	});	
	
	window.VcServiceView = vc.shortcode_view.extend({
	   changeShortcodeParams:function (model) {
		 var params = model.get('params');
		 window.VcServiceView.__super__.changeShortcodeParams.call(this, model);
		 if (_.isObject(params) && _.isString(params.icon_name)) {
			if(_.isString(params.icon_color)){
					var icon_style = ' style="color:'+ params.icon_color + ';"';
			} else {
					var icon_style = '';
			}
			
			this.$el.find('.wpb_element_wrapper .icon_name').html('<i'+ icon_style +' class="service-icon fa ' + params.icon_name + '"></i>');
		 }
	   }
	});	

    window.VcButtonView = vc.shortcode_view.extend({events:function () {
        return _.extend({'click button':'buttonClick'
        }, window.VcToggleView.__super__.events);
    },
        buttonClick:function (e) {
            e.preventDefault();
        },
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcButtonView.__super__.changeShortcodeParams.call(this, model);
            if (_.isObject(params)) {
                var el_class = params.color + ' ' + params.size + ' ' + params.button_style;
                this.$el.find('.wpb_element_wrapper').removeClass(el_class);
                this.$el.find('button.title').attr({ "class":"title textfield wpb_button " + el_class });
				
				if (params.icon_name) {
                    this.$el.find('button.title').append('<i class="fa '+params.icon_name+'"></i>');
                } else {
                    this.$el.find('button.title i.fa').remove();
                }

            }
        }
    });
	
	window.VcTeamView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcTeamView.__super__.changeShortcodeParams.call(this, model);
			if (params.img_url) {
				this.$el.find('.wpb_element_wrapper .img_url').show();
			 } else {
				this.$el.find('.wpb_element_wrapper .img_url').hide();
			 }
        }
    });
	
	window.VcTestimonialSliderView = vc.shortcode_view.extend({
        adding_new_tab:false,
        events:{
            'click .add_tab':'addTab',
            'click > .controls .column_delete':'deleteShortcode',
            'click > .controls .column_edit':'editElement',
            'click > .controls .column_clone':'clone'
        },
        render:function () {
            window.VcTestimonialSliderView.__super__.render.call(this);
            this.$content.sortable({
                axis:"y",
                handle:"h3",
                stop:function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.prev().triggerHandler("focusout");
                    $(this).find('> .wpb_sortable').each(function () {
                        var shortcode = $(this).data('model');
                        shortcode.save({'order':$(this).index()}); // Optimize
                    });
                }
            });
            return this;
        },
        addTab:function (e) {
            this.adding_new_tab = true;
            e.preventDefault();
            vc.shortcodes.create({shortcode:'vc_testimonial', params:{title:window.i18nLocale.section}, parent_id:this.model.id});
        },
        _loadDefaults:function () {
            window.VcTestimonialSliderView.__super__._loadDefaults.call(this);
        }
    });
	   
	window.VcTestimonialView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcTestimonialView.__super__.changeShortcodeParams.call(this, model);
            if (!_.isString(params.name)) {
                this.$el.find('h3.name').text('Testimonial');
            }			
        }
    });
	
	window.VcListItemView = vc.shortcode_view.extend({
	   changeShortcodeParams:function (model) {
			var params = model.get('params');
			window.VcListItemView.__super__.changeShortcodeParams.call(this, model);
			if (_.isObject(params) && _.isString(params.icon_name)) {
				if(_.isString(params.icon_color)){
					var icon_style = ' style="color:'+ params.icon_color +'"';
				} else {
					var icon_style = '';
				}
				
				this.$el.find('.icon_name').html('<i class="fa ' + params.icon_name + '"'+ icon_style +'></i>');
			} else {
				this.$el.find('.icon_name').html('<i class="fa fa-check"></i>');
			}
		}
	});	
	
	window.VcTestimonialSliderView = vc.shortcode_view.extend({
        adding_new_tab:false,
        events:{
            'click .add_tab':'addTab',
            'click > .vc_controls .column_delete, > .vc_controls .vc_control-btn-delete':'deleteShortcode',
            'click > .vc_controls .column_edit, > .vc_controls .vc_control-btn-edit':'editElement',
            'click > .vc_controls .column_clone,> .vc_controls .vc_control-btn-clone':'clone'
        },
        render:function () {
            window.VcTestimonialSliderView.__super__.render.call(this);
            this.$content.sortable({
                axis:"y",
                handle:"h3",
                stop:function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.prev().triggerHandler("focusout");
                    $(this).find('> .wpb_sortable').each(function () {
                        var shortcode = $(this).data('model');
                        shortcode.save({'order':$(this).index()}); // Optimize
                    });
                }
            });
            return this;
        },
        changeShortcodeParams:function (model) {
            window.VcTestimonialSliderView.__super__.changeShortcodeParams.call(this, model);
            var collapsible = _.isString(this.model.get('params').collapsible) && this.model.get('params').collapsible === 'yes' ? true : false;
            if (this.$content.hasClass('ui-accordion')) {
                this.$content.accordion("option", "collapsible", collapsible);
            }
        },
        changedContent:function (view) {
            if (this.$content.hasClass('ui-accordion')) this.$content.accordion('destroy');
            var collapsible = _.isString(this.model.get('params').collapsible) && this.model.get('params').collapsible === 'yes' ? true : false;
            this.$content.accordion({
                header:"h3",
                navigation:false,
                autoHeight:true,
                heightStyle: "content",
                collapsible:collapsible,
                active:this.adding_new_tab === false && view.model.get('cloned') !== true ? 0 : view.$el.index()
            });
            this.adding_new_tab = false;
        },
        addTab:function (e) {
            this.adding_new_tab = true;
            e.preventDefault();
            vc.shortcodes.create({shortcode:'vc_testimonial', params:{title:window.i18nLocale.section}, parent_id:this.model.id});
        },
        _loadDefaults:function () {
            window.VcTestimonialSliderView.__super__._loadDefaults.call(this);
        }
    });
	
	
	window.VcPricingView = window.VcColumnView.extend({
        events:{
          'click > .vc_controls .vc_control-btn-delete':'deleteShortcode',
          'click > .vc_controls .vc_control-btn-prepend':'addElement',
          'click > .vc_controls .vc_control-btn-edit':'editElement',
          'click > .vc_controls .vc_control-btn-clone':'clone',
          'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
        },
		changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcPricingView.__super__.changeShortcodeParams.call(this, model);
            if (_.isObject(params)) {
				this.$el.find( '.wpb_column_container' ).before( this.$el.find( 'h4.title' ) );
				this.$el.find( '.wpb_column_container' ).before( this.$el.find( 'span.wpb_vc_param_value' ) );
            }			
        }
    });
	
	window.VcTooltipView = window.VcColumnView.extend({
        events:{
          'click > .vc_controls .vc_control-btn-delete':'deleteShortcode',
          'click > .vc_controls .vc_control-btn-prepend':'addElement',
          'click > .vc_controls .vc_control-btn-edit':'editElement',
          'click > .vc_controls .vc_control-btn-clone':'clone',
          'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
        }
    });
	

})(window.jQuery);