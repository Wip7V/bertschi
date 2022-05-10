/*
 * NoGray Color Picker Component
 *
 * Copyright (c), All right reserved
 * Gazing Design - http://www.NoGray.com
 * http://www.nogray.com/license.php
 */
 
ng.Language.load("colorpicker");ng.Assets.load_style(ng_config.assets_dir+"components/colorpicker/css/"+ng_config.css_skin_prefix+"colorpicker_style.css");ng.ColorPicker=function(b){this.p=this.create_options(b,{value:null,current_color:"#ff0000",standard_colors:[["#ff8080","#ffff80","#80ff80","#00ff80","#80ffff","#0080ff","#ff80c0","#ff80ff"],["#ff0000","#ffff00","#80ff00","#00ff40","#00ffff","#0080c0","#8080c0","#ff00ff"],["#804040","#ff8040","#00ff00","#008080","#004080","#8080ff","#800040","#ff0080"],["#800000","#ff8000","#008000","#008040","#0000ff","#0000a0","#800080","#8000ff"],["#400000","#804000","#004000","#004040","#000080","#000040","#400040","#400080"],["#000000","#808000","#808040","#808080","#408080","#c0c0c0","#400040","#ffffff"]],css_prefix:"ng_colorpicker_",swatches_only:false,hue_slider_options:null,sl_slider_options:null,picker_image:ng_config.assets_dir+"components/colorpicker/images/picker_icon.png",picker_image_disabled:ng_config.assets_dir+"components/colorpicker/images/picker_icon_disabled.png",close_on_select:true,opacity:false});this.make_id("colorpicker");this.create_events();if(!ng.defined(ng.Slider)){this.p.swatches_only=true}if(this.p.disabled){this.p.disabled=false;this.disable.delay(100,this)}if(ng.defined(this.p.value)){if(ng.type(this.p.value)=="color"){this.p.value=this.p.value.get_hex(true)}var a=this.p.value;this.p.value="";this.select_color.defer(this,[a,true])}if(ng.defined(this.p.input)){this.set_input(this.p.input)}if((ng.defined(this.p.input))||(ng.defined(this.p.object))){this.make()}};ng.ColorPicker.inherit(ng.Component);ng.extend_proto(ng.ColorPicker,{has_type:"color_picker",make:function(c){if(ng.defined(c)){this.set_input(c)}if(ng.defined(this.p.input)){this.p.input.type="text"}var e=this.p.css_prefix;var h=this.id;this.p.click_evt=new ng.InnerHtmlEvents({click:function(m,j){var i=j.src_element.get("rel");if(ng.defined(i)){if(i.indexOf("select_")!=-1){var k=new ng.Color(i.replace("select_",""));var l=this.get_current_color().get_alpha();k.set_alpha(l);this.select_color(k)}else{if(i.indexOf("update_")!=-1){this.set_current_color(j.src_element.get_style("backgroundColor"))}}}}.bind(this)});var d=['<div id="'+h+'_swatch_div" '+this.p.click_evt.get_html()+"><span></span>"];if(!this.p.swatches_only){d.push('<div id="'+h+'more_colors_div" class="'+e+'more_colors_div"></div>')}d.push('<div id="'+h+'_opacity_div" class="'+e+'opacity_div"');if(!this.p.opacity){d.push(' style="display:none;"')}d.push('"><table width="100%"><tr><td>'+ng.Language.t("opacity")+": </td>");d.push('<td><input type="text" id="'+h+'_opacity_input1" size="5" /> %</td>');d.push('<td id="'+h+'_apply_opacity_td"></td></tr></table></div>');d.push("</div>");var g={color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,checked_color:this.p.buttons_checked_color,light_border:this.p.buttons_light_border};if(!this.p.swatches_only){d.push('<table cellpadding="5" id="'+h+'_sliders_table" style="display:none;"><tr><td id="'+h+'_sl_slider" valign="top" colspan="2"></td>');d.push('<td id="'+h+'_hue_slider" class="'+e+'hue_slider" valign="top"></td>');d.push('<td class="'+e+'input_fields_td" valign="top">'+ng.Language.t("new_color",this.get_language()));d.push("<div "+this.p.click_evt.get_html()+' class="'+e+'checkered_bg">');d.push('<div id="'+h+'_current_color_div" class="'+e+'current_swatch" rel="update_color">&nbsp;</div>');d.push('<div id="'+h+'_previous_color_div" class="'+e+'previous_swatch" rel="update_color">&nbsp;</div>');d.push("</div>");d.push(ng.Language.t("current_color",this.get_language())+"<br />&nbsp;");d.push('<table cellspacing="0" cellpadding="0"><tr><td>'+ng.Language.t("hue_short",this.get_language())+":</td>");d.push('<td><input type="text" size="1" id="'+h+'_h_input" title="'+ng.Language.t("hue",this.get_language())+'" /></td>');d.push("<td>&deg;</td></tr>");d.push("<tr><td>"+ng.Language.t("saturation_short",this.get_language())+":</td>");d.push('<td><input type="text" size="1" id="'+h+'_s_input" title="'+ng.Language.t("saturation",this.get_language())+'" /></td>');d.push("<td>%</td></tr>");d.push("<tr><td>"+ng.Language.t("lightness_short",this.get_language())+":</td>");d.push('<td><input type="text" size="1" id="'+h+'_l_input" title="'+ng.Language.t("lightness",this.get_language())+'" /></td>');d.push("<td>%</td></tr>");d.push('<tr><td style="padding-top:5px;">'+ng.Language.t("red_short",this.get_language())+":</td>");d.push('<td style="padding-top:5px;"><input type="text" size="1" id="'+h+'_r_input" title="'+ng.Language.t("red",this.get_language())+'" /></td>');d.push("<td></td></tr>");d.push("<tr><td>"+ng.Language.t("green_short",this.get_language())+":</td>");d.push('<td><input type="text" size="1" id="'+h+'_g_input" title="'+ng.Language.t("green",this.get_language())+'" /></td>');d.push("<td></td></tr>");d.push("<tr><td>"+ng.Language.t("blue_short",this.get_language())+":</td>");d.push('<td><input type="text" size="1" id="'+h+'_b_input" title="'+ng.Language.t("blue",this.get_language())+'" /></td>');d.push("<td></td></tr>");d.push('</table><div style="margin-top:5px;"># <input type="text" size="5" id="'+h+'_hex_input" /></div>');d.push('</td></tr><tr><td id="'+h+'_swatches_button_td"></td>');d.push('<td class="'+e+'opacity_td"><div id="'+h+'_opacity_advance_div"');if(!this.p.opacity){d.push(' style="display:none;"')}d.push(">"+ng.Language.t("opacity")+": ");d.push('<input type="text" id="'+h+'_opacity_input2" size="5" /> %</div></td>');d.push('<td colspan="2" id="'+h+'_okcancel_buttons_td" nowrap="nowrap"></td></tr></table>')}this.set_html(d);this.p.opacity_input1=ng.get(h+"_opacity_input1");this.p.opacity_evt_func=function(i){var k=i.src_element.value.to_int();if(isNaN(k)){k=100}var j=this.get_current_color();j.set_alpha(k/100);this.set_current_color(j)}.bind(this);this.p.opacity_input1.add_event("change",this.p.opacity_evt_func);this.p.apply_opacity_button=new ng.Button(ng.obj_merge({text:ng.Language.t("apply",this.get_language()),events:{click:function(){this.select_color(this.get_current_color())}.bind(this)}},g));this.p.apply_opacity_button.make(h+"_apply_opacity_td");if(!this.p.swatches_only){this.p.h_input=ng.get(h+"_h_input");this.p.s_input=ng.get(h+"_s_input");this.p.l_input=ng.get(h+"_l_input");this.p.r_input=ng.get(h+"_r_input");this.p.g_input=ng.get(h+"_g_input");this.p.b_input=ng.get(h+"_b_input");this.p.hex_input=ng.get(h+"_hex_input");this.p.opacity_input2=ng.get(h+"_opacity_input2");this.p.opacity_input2.add_event("change",this.p.opacity_evt_func);this.p.input_evt_func=function(n){var i=n.src_element.id;var j=n.src_element.value.to_int();var o=this.get_current_color();var p=o.get_hsl(true);var k=o.get_rgb(true);if(isNaN(j)){if(i==this.id+"_h_input"){j=p[0]}if(i==this.id+"_s_input"){j=p[1]}if(i==this.id+"_l_input"){j=p[2]}if(i==this.id+"_r_input"){j=k[0]}if(i==this.id+"_g_input"){j=k[1]}if(i==this.id+"_b_input"){j=k[2]}}var m=255;if(i==this.id+"_h_input"){m=359}if((i==this.id+"_s_input")||(i==this.id+"_l_input")){m=100}if(i.indexOf("opacity")!=-1){m=100}if(j>m){j=m}if(j<0){j=0}n.src_element.value=j;var l="rgb";if(i==this.id+"_h_input"){p[0]=j;l="hsl"}if(i==this.id+"_s_input"){p[1]=j;l="hsl"}if(i==this.id+"_l_input"){p[2]=j;l="hsl"}if(i==this.id+"_r_input"){k[0]=j}if(i==this.id+"_g_input"){k[1]=j}if(i==this.id+"_b_input"){k[2]=j}if(l=="hsl"){var q=new ng.Color(p,"hsl")}else{var q=new ng.Color(k)}this.set_current_color(q)}.bind(this);this.p.h_input.add_event("change",this.p.input_evt_func);this.p.s_input.add_event("change",this.p.input_evt_func);this.p.l_input.add_event("change",this.p.input_evt_func);this.p.r_input.add_event("change",this.p.input_evt_func);this.p.g_input.add_event("change",this.p.input_evt_func);this.p.b_input.add_event("change",this.p.input_evt_func);this.p.hex_input.add_event("change",function(){var i=new ng.Color(this.p.hex_input.value);var j=this.get_current_color().get_alpha();i.set_alpha(j);this.set_current_color(i)}.bind(this));if(!ng.defined(this.p.sl_slider_options)){this.p.sl_slider_options={}}ng.obj_merge(this.p.sl_slider_options,{type:"rectangle",width:250,height:250,visible:true,fill:false,object:h+"_sl_slider",show_value:false,parent:this.id,rectangle_separator:":",language:this.get_language(),events:{slide:function(k){var j=this.get_current_color();var i=j.get_hsl(true);j.set_hsl([i[0],k[0],k[1],i[3]]);this.set_current_color(j,true)}.bind(this),change:function(){this.fire_event("slide",[this.get_value()[0]])}}});this.p.sl_slider=new ng.Slider(this.p.sl_slider_options);var b=ng.get(this.p.sl_slider.get_id()+"_inner_div");b.set_html('<div style="position:position:absolute; background: url('+ng_config.assets_dir+'components/colorpicker/images/lightness_bg.png); width:250px; height:250px;">&nbsp;</div>');var f="_"+ng.Language.get_dir(this.get_language());if(f!="_rtl"){f=""}b.set_style("background","url("+ng_config.assets_dir+"components/colorpicker/images/saturation_bg"+f+".png)");if(!ng.defined(this.p.hue_slider_options)){this.p.hue_slider_options={}}ng.obj_merge(this.p.hue_slider_options,{type:"vertical",start:0,end:359,fill:false,height:250,visible:true,object:h+"_hue_slider",parent:this.id,show_value:false,language:this.get_language(),events:{slide:function(k){var j=this.get_current_color();var i=j.get_hsl(true);j.set_hsl([k,i[1],i[2],i[3]]);this.set_current_color(j,true)}.bind(this),change:function(){this.fire_event("slide",[this.get_value()[0]])}}});this.p.hue_slider=new ng.Slider(this.p.hue_slider_options);this.p.swatches_button=new ng.Button(ng.obj_merge({text:ng.Language.t("swatches",this.get_language()),events:{click:function(){ng.get(this.id+"_swatch_div").set_style("display","");ng.get(this.id+"_sliders_table").set_style("display","none");this.reposition();this.fire_event("onSwatchsHide")}.bind(this)}},g));this.p.swatches_button.make(h+"_swatches_button_td");this.p.cancel_button=new ng.Button(ng.obj_merge({text:ng.Language.t("cancel",this.get_language()),width:"50%",events:{click:function(){this.set_current_color(this.get_previous_color());this.close();this.fire_event("cancelClick")}.bind(this)}},g));this.p.cancel_button.make(h+"_okcancel_buttons_td");this.p.ok_button=new ng.Button(ng.obj_merge({text:ng.Language.t("ok",this.get_language()),width:"50%",events:{click:function(){this.select_color(this.get_current_color());this.close();this.fire_event("okClick")}.bind(this)}},g));this.p.ok_button.make(h+"_okcancel_buttons_td");this.p.more_colors_button=new ng.Button(ng.obj_merge({text:ng.Language.t("more_colors",this.get_language()),width:"100%",events:{click:function(){ng.get(this.id+"_swatch_div").set_style("display","none");ng.get(this.id+"_sliders_table").set_style("display","");this.reposition();this.p.hue_slider.reset_elements();this.p.sl_slider.reset_elements();this.fire_event("onSwatchsShow")}.bind(this)}},g));this.p.more_colors_button.make(this.id+"more_colors_div")}var a=this.get_input();if(ng.defined(a)){if((!ng.defined(this.p.value))&&(a.value!="")){this.select_color.defer(this,[a.value,true])}a.add_events({change:function(){var i=this.get_input().value;if(i==""){this.unselect_color()}else{this.select_color(i)}}.bind(this)});var d=this.get_input_html();ng.hold_html(d);a.append_element(ng.get("input_button_table"+this.id),"before");ng.get("input_holder_td"+this.id).append_element(a);this.p.icon_button=new ng.Button(ng.obj_merge({icon:this.p.picker_image,stop_default:true,hide_component:true,events:{disable:function(){this.p.icon_button.set_icon(this.p.picker_image_disabled)}.bind(this),enable:function(){this.p.icon_button.set_icon(this.p.picker_image)}.bind(this)}},g));this.p.icon_button.make("button_holder_td"+this.id);this.set_button(this.p.icon_button);if(a.disabled){this.disable.delay(100,this)}}this.set_standard_colors(this.p.standard_colors);this.set_current_color(this.p.current_color);this.set_previous_color(this.p.current_color);return this},process_color:function(a){if(!ng.defined(this.p.elm)){this.p.elm=ng.create("div")}if(ng.type(a)=="string"){a=a.toLowerCase();if(a.indexOf("rgb")!=-1){a=a.replace(/[rgb(a)?|\(|\)|\s]/g,"");a=new ng.Color(a.split(","))}else{if(a.indexOf("hsl")!=-1){a=a.replace(/[hsl(a)?|\(|\)|\s]/g,"");a=new ng.Color(a.split(","),"hsl")}else{if(a.substr(0,1)!="#"){a="#"+a}}}}this.p.elm.set_style("backgroundColor",a);a=this.p.elm.get_style("backgroundColor");return new ng.Color(a)},select_color:function(b,d){if(this.is_disabled()){return this}var b=this.process_color(b);if((ng.defined(this.p.value))&&(this.p.value!="")){this.unselect_color()}this.p.value=b;var c=this.get_button();if(ng.defined(c)){c.get_icon_element().set_style("backgroundColor",b)}var e=ng.get(this.id+"_swatch_td_"+b.get_hex(false).toUpperCase().replace("#",""));if(ng.defined(e)){e.add_class(this.p.css_prefix+"selected")}var a=this.get_input();if(ng.defined(a)){if(b.get_alpha()!=1){a.value="rgba("+b.get_rgb(true).join(",")+")"}else{a.value=b.get_hex(false)}}this.set_current_color(b);this.set_previous_color(b);if(!ng.defined(d)){this.fire_event("select")}if(this.p.close_on_select){this.close()}return this},unselect_color:function(){if(this.is_disabled()){return this}if((ng.defined(this.p.value))&&(this.p.value!="")){this.set_previous_color(this.p.value)}var b=this.get_button();if(ng.defined(b)){b.get_icon_element().set_style("background","none")}var a=this.get_current_color();var c=ng.get(this.id+"_swatch_td_"+a.get_hex().toUpperCase().replace("#",""));if(ng.defined(c)){c.remove_class(this.p.css_prefix+"selected")}this.p.value=null;this.fire_event("unselect",[a]);return this},get_value:function(){return this.p.value},set_current_color:function(c,a){if(this.is_disabled()){return this}c=this.process_color(c);this.p.current_color=c;this.p.opacity_input1.value=c.get_alpha()*100;if(!this.p.swatches_only){ng.get(this.id+"_current_color_div").set_style("backgroundColor",c);var e=new ng.Color(c.get_hex(false));e.set_hsl([e.get_hsl()[0],100,100]);ng.get(this.p.sl_slider.get_id()+"_inner_div").set_style("backgroundColor",e.get_hex(false));var b=c.get_hsl();var d=c.get_rgb();this.p.h_input.value=b[0];this.p.s_input.value=b[1];this.p.l_input.value=b[2];this.p.r_input.value=d[0];this.p.g_input.value=d[1];this.p.b_input.value=d[2];this.p.hex_input.value=c.get_hex().substr(1);this.p.opacity_input2.value=c.get_alpha()*100;if(!ng.defined(a)){this.p.sl_slider.set_value(b[1]+":"+b[2]);this.p.hue_slider.set_value(b[0])}}this.fire_event("colorchange");return this},get_current_color:function(){return this.p.current_color},set_previous_color:function(a){if(this.is_disabled()){return this}a=this.process_color(a);this.p.previous_color=a;if(!this.p.swatches_only){ng.get(this.id+"_previous_color_div").set_style("backgroundColor",a)}return this},get_previous_color:function(){return this.p.previous_color},set_standard_colors:function(h){this.p.standard_colors=h;var g=this.id;if(ng.defined(h)){var d=['<table class="'+this.p.css_prefix+'swatch_table">'];for(var c=0;c<h.length;c++){d.push("<tr>");for(var b=0;b<h[c].length;b++){var a=h[c][b];if(ng.type(a)=="color"){a=a.get_hex()}var f=a.toUpperCase().replace("#","");d.push('<td id="'+g+"_swatch_td_"+f+'" class="'+this.p.css_prefix+'swatch_td">');d.push('<div rel="select_'+a+'" class="ng_colorpicker_swatch" style="background:'+a+';">&nbsp;</div></td>')}d.push("</tr>")}d.push("</table>");var e=ng.get(g+"_swatch_div").getElementsByTagName("span")[0];e.innerHTML=d.join("");if(!this.p.swatches_only){this.p.swatches_button.get_object().set_style("display","")}}else{var e=ng.get(g+"_swatch_div").getElementsByTagName("span")[0];e.innerHTML="";if(!this.p.swatches_only){this.p.more_colors_button.fire_event("click")}this.p.swatches_button.get_object().set_style("display","none")}return this},get_standard_colors:function(){return this.p.standard_colors},set_close_on_select:function(a){this.close_on_select=a;return this},get_close_on_select:function(){return this},set_opacity:function(b){this.p.opacity=b;if(b){var a=""}else{var a="none"}ng.get(this.id+"_opacity_div").set_style("display",a);ng.get(this.id+"_opacity_advance_div").set_style("display",a);return this},get_opacity:function(){return this.p.opacity}});