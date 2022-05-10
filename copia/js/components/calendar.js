/*
 * NoGray Calendar Component
 *
 * Copyright (c), All right reserved
 * Gazing Design - http://www.NoGray.com
 * http://www.nogray.com/license.php
 */
 
ng.Language.load("calendar");ng.Assets.load_style(ng_config.assets_dir+"components/calendar/css/"+ng_config.css_skin_prefix+"cal_style.css");ng.Calendar=function(a){this.p=this.create_options(a,{date_format:"D, d M Y",server_date_format:"Y-n-j",num_months:1,num_col:3,css_prefix:"ng_cal_",start_day:0,start_date:"today",end_date:"year+10",year_select:null,month_select:null,date_select:null,allow_selection:true,multi_selection:false,max_selection:0,formatter:this.standard_date_print,selected_date_formatter:this.standard_date_print,out_of_range_formatter:this.standard_date_print,other_month_formatter:this.standard_date_print,dates_off:null,allow_dates_off_selection:false,dates_off_formatter:this.standard_date_print,days_off:null,allow_days_off_selection:false,days_off_formatter:this.standard_date_print,range_off:null,allow_range_off_selection:false,range_off_formatter:this.standard_date_print,weekend:null,allow_weekend_selection:false,weekend_formatter:this.standard_date_print,force_selections:null,date_on_avaliable:null,days_text:"mid",months_text:"long",right_arrow_img:ng_config.assets_dir+"components/calendar/images/right_arrow.gif",right_arrow_img_disabled:ng_config.assets_dir+"components/calendar/images/right_arrow_dis.gif",left_arrow_img:ng_config.assets_dir+"components/calendar/images/left_arrow.gif",left_arrow_img_disabled:ng_config.assets_dir+"components/calendar/images/left_arrow_dis.gif",calendar_img:ng_config.assets_dir+"components/calendar/images/calendar.gif",calendar_img_disabled:ng_config.assets_dir+"components/calendar/images/calendar_dis.gif",header_format:"F Y",close_on_select:null,selected_date:null,display_date:null,hide_clear_button:false,hide_view_all_dates_button:false,was_cal_made:false});this.create_events();if(this.p.disabled){this.p.disabled=false;this.disable.delay(100,this)}if(!ng.defined(this.p.close_on_select)){if(this.p.multi_selection){this.p.close_on_select=false}else{this.p.close_on_select=true}}this.make_id("calendar");this.p.start_date=this.process_date(this.p.start_date,new Date());this.p.end_date=this.process_date(this.p.end_date);if(ng.defined(this.p.range_off)){this.set_range_off(this.p.range_off,false)}if(!ng.defined(this.p.date_on_avaliable)){this.p.date_on_avaliable={}}this.p.to_be_selected=this.p.selected_date;this.p.selected_date=[];if(!ng.defined(this.p.display_date)){if(this.p.selected_date.length>0){this.p.display_date=this.p.selected_date[0].clone()}else{this.p.display_date=this.p.start_date.clone()}}else{this.p.display_date=this.process_date(this.p.display_date,new Date())}if((ng.defined(this.p.input))||(ng.defined(this.p.object))){this.make()}};ng.Calendar.inherit(ng.Component);ng.extend_proto(ng.Calendar,{has_type:"calendar",make:function(i){if(this.p.was_cal_made){return this}this.p.was_cal_made=true;if(!ng.defined(i)){if(ng.defined(this.p.input)){var i=this.p.input}else{var i=this.p.object}}if(ng.type(i)=="object"){this.p.year_select=ng.get(i.year);this.p.month_select=ng.get(i.month);this.p.date_select=ng.get(i.date)}else{var d=ng.get(i);if((d.get("tag")=="input")||(d.get("tag")=="textarea")){this.p.input_field=d}else{this.set_object(d)}}var a=((ng.defined(this.p.input_field))||(ng.defined(this.p.year_select)));if(a){var e="<table cellspacing='0' cellpadding='0' class='ng-input-button-table ng_input_button_table' id='input_button_table"+this.id+"' dir='"+ng.Language.get_dir(this.get_language())+"'>";var g="";if(this.get_visible()){g=' style="display:none;"'}e+="<tr><td id='input_holder_td"+this.id+"'></td><td id='button_holder_td"+this.id+"'"+g+"></td></tr>";e+="</table>";ng.dump_div.innerHTML=e;this.p.input_table_holder=ng.get("input_button_table"+this.id);this.set_input(ng.create("input",{"class":this.p.css_prefix+"input_field",id:"input_field"+this.id,events:{change:function(){if(this.get_input().value!=""){var n="";var j=this.get_input().value;if(this.get_date_format().indexOf("\\")!=-1){n="\\"}else{if(this.get_date_format().indexOf("-")!=-1){n="-"}else{if(this.get_date_format().indexOf("/")!=-1){n="/"}}}if(n!=""){var k=this.get_date_format().split(n);if(k.length>=3){if((k[0]=="j")||(k[0]=="d")){var m=j.split(n);j=m[1]+"-"+m[0]+"-"+m[2]}}}else{if(this.get_language()!="en"){j=ng.Language.date_to_english(j,this.get_language())}}var l=this.process_date(j);if(l.getTime()<this.get_start_date().getTime()){l=this.get_start_date().clone();this.fire_event("inputPreStartDate")}if(l.getTime()>this.get_end_date().getTime()){l=this.get_end_date().clone();this.fire_event("inputPostEndDate")}this.update_calendar(l);this.select_date(l)}else{this.unselect_date(this.get_last_selected_date())}}.bind(this)}}));ng.get("input_holder_td"+this.id).append_element(this.get_input());if(ng.defined(this.p.input_field)){this.p.input_field=ng.get(this.p.input_field);var h=this.p.input_field;h.type="text";h.append_element(this.p.input_table_holder,"before");var f=this.get_input();f.className+=" "+h.className;f.readOnly=h.readOnly;f.size=h.size;f.placeholder=h.placeholder;if(h.disabled){this.disable.delay(100,this)}var c=h.value;h.value="";h.set_style("display","none");if((!ng.defined(this.p.to_be_selected))&&(c!="")){this.p.to_be_selected=c}}if(ng.defined(this.p.year_select)){this.p.year_select=ng.get(this.p.year_select);this.p.month_select=ng.get(this.p.month_select);this.p.date_select=ng.get(this.p.date_select);if(this.p.year_select.disabled){this.disable.delay(100,this)}var c=this.p.year_select.value+"-"+this.p.month_select.value+"-"+this.p.date_select.value;this.p.year_select.append_element(this.p.input_table_holder,"before");this.p.year_input=ng.create("input",{name:this.p.year_select.name,id:this.p.year_select.id,styles:{display:"none"}});this.p.month_input=ng.create("input",{name:this.p.month_select.name,id:this.p.month_select.id,styles:{display:"none"}});this.p.date_input=ng.create("input",{name:this.p.date_select.name,id:this.p.date_select.id,styles:{display:"none"}});this.p.year_select.replace(this.p.year_input);this.p.month_select.replace(this.p.month_input);this.p.date_select.replace(this.p.date_input);if((!ng.defined(this.p.to_be_selected))&&(c!="--")){this.p.to_be_selected=c}}if(ng.defined(this.p.to_be_selected)){this.select_date.defer(this,[this.p.to_be_selected,true])}this.p.calendar_button=new ng.Button({icon:this.p.calendar_img,stop_default:true,hide_component:true,color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,checked_color:this.p.buttons_checked_color,events:{disable:function(){this.p.calendar_button.set_icon(this.p.calendar_img_disabled)}.bind(this),enable:function(){this.p.calendar_button.set_icon(this.p.calendar_img)}.bind(this)}});this.p.calendar_button.make("button_holder_td"+this.id);this.set_button(this.p.calendar_button)}var b=this.get_last_selected_date();if((ng.defined(b))&&(b!="")){this.update_field_value()}this.set();return this.create_calendar_frame()},process_date:function(c,b){var a;if(!ng.defined(b)){var b=this.p.start_date.clone()}b=b.clone();if(ng.type(c)=="date"){a=c}else{if(ng.type(c)=="object"){a=b.from_object(c)}else{if(ng.type(c)=="string"){a=b.from_string(c)}else{if(ng.type(c)=="number"){a=new Date(c)}else{return null}}}}return this.set_time(a)},set_time:function(a){a.setHours(11);a.setSeconds(0);a.setMinutes(0);a.setMilliseconds(0);return a},is_selectable:function(b){if(!this.p.allow_selection){return[false,"selection not allowed"]}b=this.process_date(b);var a=[true,b];if(this.is_out_of_range(b)){a=[false,"out of range"]}else{if(this.is_date_off(b)){a=[this.p.allow_dates_off_selection,"date off"]}else{if(this.is_day_off(b)){a=[this.p.allow_days_off_selection,"day off"]}else{if(this.is_range_off(b)){a=[this.p.allow_range_off_selection,"range off"]}else{if(this.is_weekend(b)){a=[this.p.allow_weekend_selection,"weekend"]}}}}}if(!a[0]){if(this.is_forced_selection(b)){a[0]=true}}return a},is_out_of_range:function(a){a=this.process_date(a);if(a.getTime()<this.p.start_date.getTime()){return true}if(a.getTime()>this.p.end_date.getTime()){return true}return false},check_dates_off:function(e,b){e=this.process_date(e);var d=false;for(var c=0;c<b.length;c++){var a=this.process_date(b[c],e);if(e.getTime()==a.getTime()){d=true;break}}return d},is_date_off:function(a){if(!ng.defined(this.p.dates_off)){return false}return this.check_dates_off(a,this.p.dates_off)},is_forced_selection:function(a){if(!ng.defined(this.p.force_selections)){return false}return this.check_dates_off(a,this.p.force_selections)},check_days_off:function(d,a){d=this.process_date(d);var c=false;for(var b=0;b<a.length;b++){if(a[b]==d.getDay()){c=true;break}}return c},is_day_off:function(a){if(!ng.defined(this.p.days_off)){return false}return this.check_days_off(a,this.p.days_off)},is_weekend:function(a){if(!ng.defined(this.p.weekend)){return false}return this.check_days_off(a,this.p.weekend)},is_range_off:function(b){if(!ng.defined(this.p.range_off)){return false}b=this.process_date(b);for(var a=0;a<this.p.range_off.length;a++){if((b.getTime()>=this.p.range_off[a][0].getTime())&&(b.getTime()<=this.p.range_off[a][1].getTime())){return true}}return false},is_selected:function(a){if(!this.get_allow_selection()){return false}return this.check_dates_off(a,this.p.selected_date)},select_dates:function(a){return this.select_date(a)},select_date:function(c,b){if(this.is_disabled()){return}if(!this.get_allow_selection()){return}if(!ng.defined(c)){return}if(ng.type(c)!="array"){c=[c]}if(c.length==0){return}c=c.unique();for(var a=0;a<c.length;a++){c[a]=this.process_date(c[a]);if((this.is_selectable(c[a])[0])&&(!this.is_selected(c[a]))){this.push_select_date(c[a]);var d="date_"+this.id+"_"+(c[a].getMonth()+1)+"_"+c[a].getDate()+"_"+c[a].getFullYear();if(ng.defined(ng.get(d))){ng.get(d).add_class(this.p.css_prefix+"selected_date")}this.create_multi_select_dates_list();if(!ng.defined(b)){this.fire_event.defer(this,["select",[c[a]]])}}}this.update_field_value();if(this.get_close_on_select()){(function(){this.close()}.delay(100,this))}return this},create_multi_select_dates_list:function(){if(!ng.defined(this.p.show_sel_dts_button)){return}if(this.p.multi_selection){if(this.p.selected_date.length>0){if((!this.p.hide_clear_button)&&(ng.defined(this.p.clear_button))){this.p.clear_button.enable()}if(!this.p.hide_view_all_dates_button){this.p.show_sel_dts_button.enable()}}else{if((!this.p.hide_clear_button)&&(ng.defined(this.p.clear_button))){this.p.clear_button.disable()}if(!this.p.hide_view_all_dates_button){this.p.show_sel_dts_button.disable();this.p.show_sel_dts_button.set_text(ng.Language.t("view_selected_dates",this.get_language()));ng.get("all_sel_dts_tr"+this.id).set_style("display","none")}}}if((this.p.multi_selection)&&(ng.get("all_sel_dts_tr"+this.id).get_style("display")!="none")){var c=[];var b=0;c.push("<table class='"+this.p.css_prefix+"date_list_table'>");var e=Math.min(this.get_num_col(),this.get_num_months());for(var a=0;a<this.p.selected_date.length;a++){var d=this.p.selected_date[a];if(b%e==0){c.push("<tr>")}c.push("<td class='"+this.p.css_prefix+"date_list_td' rel='goto-");c.push((d.getMonth()+1)+"/"+d.getDate()+"/"+d.getFullYear());c.push("'>"+d.print(this.get_date_format(),this.get_language())+"</td>");c.push("<td class='"+this.p.css_prefix+"date_list_remove_td' rel='remove-");c.push((d.getMonth()+1)+"/"+d.getDate()+"/"+d.getFullYear());c.push("'>&nbsp;</td>");b++;if(b%e==0){c.push("</tr>")}}c.push("</table>");ng.get("all_dates_td"+this.id).set_html(c)}},push_select_date:function(b){if(this.p.multi_selection){this.p.selected_date=[b].concat(this.p.selected_date);if((this.p.max_selection>0)&&(this.p.selected_date.length>this.p.max_selection)){for(var a=this.p.max_selection;a<this.p.selected_date.length;a++){this.unselect_date(this.p.selected_date[a])}this.p.selected_date=this.p.selected_date.slice(0,this.p.max_selection)}}else{this.unselect_date(this.p.selected_date);this.p.selected_date=[b]}},get_selected_dates:function(){return this.get_selected_date()},get_selected_date:function(){if(this.p.selected_date.length<=1){return this.get_last_selected_date()}else{return this.p.selected_date}},get_last_selected_date:function(){if(this.p.selected_date.length>0){return this.p.selected_date[0]}else{return null}},get_first_selected_date:function(){if(this.p.selected_date.length>0){return this.p.selected_date[this.p.selected_date.length-1]}else{return null}},unselect_dates:function(a){return this.unselect_date(a)},unselect_date:function(c){if(this.is_disabled()){return}if(!this.get_allow_selection()){return}if(!ng.defined(c)){return}if(ng.type(c)!="array"){c=[c]}if(c.length==0){return}for(var a=0;a<c.length;a++){c[a]=this.process_date(c[a]);var b=c[a].clone();this.p.selected_date.remove_value(c[a],function(e){return e.getTime()});var d="date_"+this.id+"_"+(b.getMonth()+1)+"_"+b.getDate()+"_"+b.getFullYear();if(ng.defined(ng.get(d))){ng.get(d).remove_class(this.p.css_prefix+"selected_date")}this.create_multi_select_dates_list();this.fire_event.defer(this,["unselect",[b]])}this.update_field_value();return this},clear_selection:function(){if(this.is_disabled()){return}this.p.selected_date.empty();if(ng.defined(this.p.year_input)){this.p.year_input.value=this.p.month_input.value=this.p.date_input.value=""}if(ng.defined(this.p.input_field)){this.p.input_field.value=""}if(ng.defined(this.get_input())){this.get_input().value=""}this.create_calendar();this.create_multi_select_dates_list();this.fire_event("clear");return this},update_field_value:function(d,e){if(this.p.selected_date.length){var a="en";if((ng.is_lite)&&(!ng.defined(ng_lang.en))){a=this.get_language()}ng.Language.load("general",a);var c=this.p.selected_date[0];if(ng.defined(this.p.input_field)){var f=[];for(var b=0;b<this.p.selected_date.length;b++){f.push(this.p.selected_date[b].print(this.get_server_date_format(),a))}this.p.input_field.value=f.join()}if(ng.defined(this.p.year_input)){this.p.year_input.value=c.getFullYear();this.p.month_input.value=c.getMonth()+1;this.p.date_input.value=c.getDate()}if(ng.defined(this.get_input())){this.get_input().value=c.print(this.get_date_format(),this.get_language())}}else{if(ng.defined(this.p.year_input)){this.p.year_input.value=this.p.month_input.value=this.p.date_input.value=""}if(ng.defined(this.p.input_field)){this.p.input_field.value=""}if(ng.defined(this.get_input())){this.get_input().value=""}}return this.update_calendar(this.get_display_date(),true)},set_formatter:function(b,a){this.p.formatter=b;return this.create_calendar(a)},get_formatter:function(){return this.p.formatter},set_out_of_range_formatter:function(b,a){this.p.out_of_range_formatter=b;return this.create_calendar(a)},get_out_of_range_formatter:function(){return this.p.out_of_range_formatter},set_other_month_formatter:function(b,a){this.p.other_month_formatter=b;return this.create_calendar(a)},get_other_month_formatter:function(){return this.p.other_month_formatter},get_date_format:function(){return this.p.date_format},set_date_format:function(a){this.p.date_format=a;return this},get_server_date_format:function(){return this.p.server_date_format},set_server_date_format:function(a){this.p.server_date_format=a;return this},get_num_months:function(){return this.p.num_months},set_num_months:function(a,b){this.p.num_months=a;return this.create_calendar(b)},get_num_col:function(){return this.p.num_col},set_num_col:function(a,b){this.p.num_col=a;return this.create_calendar(b)},get_start_day:function(){return this.p.start_day.to_int()},set_start_day:function(b,a){this.p.start_day=b.to_int();return this.create_calendar(a)},get_start_date:function(){return this.p.start_date},set_start_date:function(a,b){this.p.start_date=this.process_date(a,new Date());return this.update_year_select(b)},get_display_date:function(){return this.p.display_date},set_display_date:function(a,b){this.p.display_date=this.process_date(a);return this.create_calendar(b)},get_end_date:function(){return this.p.end_date},set_end_date:function(a,b){this.p.end_date=this.process_date(a);return this.update_year_select(b)},update_year_select:function(e){if(!ng.defined(ng.get("yr_sel_span"+this.id))){return this}if(ng.defined(this.p.year_select_menu)){this.p.year_select_menu.remove_element();this.p.year_select_menu=null}var f=this.get_start_date().getFullYear();var b=this.get_end_date().getFullYear();if((b-f)>15){var c="input"}else{var c="select"}if(!ng.defined(this.p.year_select_event)){this.p.year_select_event=(function(){var n=this.get_display_date().clone();var l=this.p.year_select_menu;if(l.get("tag")=="input"){var o=ng.Language.numbers_to_english(l.value,this.get_language()).to_int()}else{var o=l.value.to_int()}if(isNaN(o)){o=n.getFullYear()}var k=this.get_start_date().getFullYear();if(o<k){o=k}var i=this.get_end_date().getFullYear();if(o>i){o=i}n.setFullYear(o);this.update_calendar(n);if(l.get("tag")=="input"){var m=this.get_display_date().getFullYear();if(l.value!=m){l.value=ng.Language.translate_numbers(m,this.get_language())}}}.bind(this))}var d=ng.create(c,{events:{change:this.p.year_select_event}});var j=this.get_display_date().getFullYear();if((b-f)>15){var h='<a href="#" onclick="ng.extend_event(event).stop();"></a>';d.size=4;d.value=ng.Language.translate_numbers(j,this.get_language())}else{var a;var h="";for(var g=f;g<=b;g++){a=document.createElement("option");a.value=g;a.innerHTML=ng.Language.translate_numbers(g,this.get_language());if(g==j){a.selected="selected"}d.appendChild(a)}}ng.get("yr_sel_span"+this.id).set_html(h);ng.get("yr_sel_span"+this.id).append_element(d,"top");this.p.year_select_menu=d;if(e){return this.create_calendar(e)}return this.update_calendar(this.get_display_date(),true)},get_date_on_avaliable:function(){return this.p.date_on_avaliable},set_date_on_avaliable:function(a){this.p.date_on_avaliable=a;return this},get_allow_selection:function(){return this.p.allow_selection},set_allow_selection:function(a){this.p.allow_selection=a;return this},get_multi_selection:function(){return this.p.multi_selection},set_multi_selection:function(b){this.p.multi_selection=b;if((!b)&&(this.p.selected_date.length>1)){var a=this.get_last_selected_date();if(ng.defined(a)){this.clear_selection();this.select_date(a)}}return this},get_max_selection:function(){return this.p.max_selection},set_max_selection:function(c){this.p.max_selection=c;if(this.p.selected_date.length>c){var b=[];for(var a=c;a<this.p.selected_date.length;a++){b.push(this.p.selected_date)}this.unselect_date(b)}return this},get_dates_off:function(){return this.p.dates_off},set_dates_off:function(a,b){this.p.dates_off=a;return this.create_calendar(b)},get_allow_dates_off_selection:function(){return this.p.allow_dates_off_selection},set_allow_dates_off_selection:function(a,b){this.p.allow_dates_off_selection=a;return this.create_calendar(b)},set_dates_off_formatter:function(b,a){this.p.dates_off_formatter=b;return this.create_calendar(a)},get_days_off:function(){return this.p.days_off},set_days_off:function(a,b){this.p.days_off=a;return this.create_calendar(b)},get_allow_days_off_selection:function(){return this.p.allow_days_off_selection},set_allow_days_off_selection:function(a,b){this.p.allow_days_off_selection=a;return this.create_calendar(b)},set_days_off_formatter:function(b,a){this.p.days_off_formatter=b;return this.create_calendar(a)},get_range_off:function(){return this.p.range_off},set_range_off:function(a,c){var d=new Date();if(ng.type(a[0])!="array"){a=[a]}for(var b=0;b<a.length;b++){a[b]=[this.process_date(a[b][0],d),this.process_date(a[b][1],d)]}this.p.range_off=a;return this.create_calendar(c)},get_allow_range_off_selection:function(){return this.p.allow_range_off_selection},set_allow_range_off_selection:function(a,b){this.p.allow_range_off_selection=a;return this.create_calendar(b)},set_range_off_formatter:function(b,a){this.p.range_off_formatter=b;return this.create_calendar(a)},get_weekend:function(){return this.p.weekend},set_weekend:function(a,b){this.p.weekend=a;return this.create_calendar(b)},get_allow_weekend_selection:function(){return this.p.allow_weekend_selection},set_allow_weekend_selection:function(a,b){this.p.allow_weekend_selection=a;return this.create_calendar(b)},set_weekend_formatter:function(b,a){this.p.weekend_formatter=b;return this.create_calendar(a)},get_force_selections:function(){return this.p.force_selections},set_force_selections:function(a,b){this.p.force_selections=a;return this.create_calendar(b)},get_days_text:function(){return this.p.days_text},set_days_text:function(a,b){this.p.days_text=a;return this.create_calendar(b)},get_months_text:function(){return this.p.months_text},set_months_text:function(a,b){this.p.months_text=a;return this.create_calendar(b)},get_header_format:function(){return this.p.header_format},set_header_format:function(a,b){this.p.header_format=a;return this.create_calendar(b)},get_close_on_select:function(){return this.p.close_on_select},set_close_on_select:function(a){this.p.close_on_select=a;return this},create_calendar_frame:function(){var e=[];this.p.main_events=new ng.InnerHtmlEvents({click:function(l,k){if(this.is_disabled()){return}var i=k.src_element.get("rel");if(!ng.defined(i)){return this}if(i!=""){if(i.indexOf("out_of_range")!=-1){return}if(i.indexOf("other_month")!=-1){var j=this.process_date(i.replace("other_month",""))}else{var j=this.process_date(i)}if(ng.defined(j)){if(!this.is_month_visible(j)){this.update_calendar(j)}if(this.is_selected(j)){this.unselect_date(j)}else{this.select_date(j)}this.fire_event("dateclick",[j],k)}}}.bind(this)});this.p.mn_sel_events=new ng.InnerHtmlEvents({change:function(){var i=this.get_display_date().clone();i.setMonth(ng.get("mn_sel_menu"+this.id).value);this.update_calendar(i)}.bind(this)});e.push("<table class='"+this.p.css_prefix+"cal_frame_table' id='cal_frame_table"+this.id+"'>");e.push("<tr id='calendar_buttons"+this.id+"' style='display:none;'>");var h="left";var g="right";if(ng.Language.get_dir(this.get_language())=="rtl"){h="right";g="left"}e.push("<td id='pre_month"+this.id+"' class='"+this.p.css_prefix+h+"_month_td'></td>");e.push("<td id='year_td"+this.id+"' class='"+this.p.css_prefix+"year_td'></td>");e.push("<td id='nex_month"+this.id+"' class='"+this.p.css_prefix+g+"_month_td'></td>");e.push("</tr>");e.push("<tr id='years_sel_tr"+this.id+"' style='display:none;'>");e.push("<td colspan='3' id='years_sel_td"+this.id+"' class='"+this.p.css_prefix+"years_select_td'>");e.push("<select id='mn_sel_menu"+this.id+"' "+this.p.mn_sel_events.get_html()+">");var c=ng.Language.t("date",this.get_language());for(var d=0;d<12;d++){e.push("<option value='"+d+"'>"+c.months[this.get_months_text()][d]+"</option>")}e.push("</select> <span id='yr_sel_span"+this.id+"'></span>");e.push("</td></tr>");e.push("<tr><td id='cal_td"+this.id+"' class='"+this.p.css_prefix+"cal_td' colspan='3' ");e.push(this.p.main_events.get_html()+"></td></tr>");if(this.get_multi_selection()){this.p.multi_dates_events=new ng.InnerHtmlEvents({click:function(l,k){var j=k.src_element.get("rel");if(!ng.defined(j)){return this}if(j!=""){var i=j.split("-");if(i[0]=="remove"){this.unselect_date(i[1])}else{this.update_calendar(i[1])}}}.bind(this)});e.push("<tr><td colspan='3' id='clear_all_td"+this.id+"' class='"+this.p.css_prefix+"bottom_bar'></td></tr>");e.push("<tr id='all_sel_dts_tr"+this.id+"' style='display:none;'>");e.push("<td colspan='3' class='"+this.p.css_prefix+"all_selected_dates' ");e.push(this.p.multi_dates_events.get_html()+" id='all_dates_td"+this.id+"'></td></tr>")}e.push("</table>");this.set_html(e);this.p.content_td=ng.get("cal_td"+this.id);this.update_year_select(true);var b=this.p.right_arrow_img;if(ng.Language.get_dir(this.get_language())=="rtl"){b=this.p.left_arrow_img}this.p.pre_button=new ng.Button({icon:this.p.right_arrow_img,stop_default:true,color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,events:{disable:function(){if(ng.Language.get_dir(this.get_language())=="rtl"){this.p.pre_button.set_icon(this.p.left_arrow_img_disabled)}else{this.p.pre_button.set_icon(this.p.right_arrow_img_disabled)}}.bind(this),enable:function(){if(ng.Language.get_dir(this.get_language())=="rtl"){this.p.pre_button.set_icon(this.p.left_arrow_img)}else{this.p.pre_button.set_icon(this.p.right_arrow_img)}}.bind(this),click:function(){var i=new Date(this.get_display_date().getFullYear(),this.get_display_date().getMonth(),1);i.setMonth(i.getMonth()-this.get_num_months());this.update_calendar(i);this.fire_event("premonthclick")}.bind(this)}});this.p.pre_button.make("pre_month"+this.id);this.p.year_button=new ng.Button({text:"",stop_default:true,width:"100%",color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,events:{click:function(){if(ng.get("years_sel_tr"+this.id).get_style("display")=="none"){ng.get("years_sel_tr"+this.id).set_style("display","");this.fire_event("showyear")}else{ng.get("years_sel_tr"+this.id).set_style("display","none");this.fire_event("hideyear")}this.fire_event("yearclick")}.bind(this)}});this.p.year_button.make("year_td"+this.id);var b=this.p.left_arrow_img;if(ng.Language.get_dir(this.get_language())=="rtl"){b=this.p.right_arrow_img}this.p.nex_button=new ng.Button({icon:b,stop_default:true,color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,events:{disable:function(){if(ng.Language.get_dir(this.get_language())=="rtl"){this.p.nex_button.set_icon(this.p.right_arrow_img_disabled)}else{this.p.nex_button.set_icon(this.p.left_arrow_img_disabled)}}.bind(this),enable:function(){if(ng.Language.get_dir(this.get_language())=="rtl"){this.p.nex_button.set_icon(this.p.right_arrow_img)}else{this.p.nex_button.set_icon(this.p.left_arrow_img)}}.bind(this),click:function(){var i=new Date(this.get_display_date().getFullYear(),this.get_display_date().getMonth(),1);i.setMonth(i.getMonth()+this.get_num_months());this.update_calendar(i);this.fire_event("nextmonthclick")}.bind(this)}});this.p.nex_button.make("nex_month"+this.id);if(this.get_multi_selection()){var f=true;if(this.p.selected_date.length>0){f=false}if(!this.p.hide_clear_button){this.p.clear_button=new ng.Button({text:ng.Language.t("clear",this.get_language()),stop_default:true,color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,disabled:f,events:{click:function(){this.clear_selection()}.bind(this)}});this.p.clear_button.make("clear_all_td"+this.id)}if(!this.p.hide_view_all_dates_button){var a=ng.Language.t("view_selected_dates",this.get_language());if(!ng.defined(a)){ng.Language.load("calendar")}a=ng.Language.t("view_selected_dates",this.get_language());if(!ng.defined(a)){a="View Selected Dates"}this.p.show_sel_dts_button=new ng.Button({text:a,stop_default:true,color:this.p.buttons_color,over_color:this.p.buttons_over_color,down_color:this.p.buttons_down_color,disable_color:this.p.buttons_disable_color,gloss:this.p.buttons_gloss,disabled:f,events:{click:function(){if(ng.get("all_sel_dts_tr"+this.id).get_style("display")=="none"){this.p.show_sel_dts_button.set_text(ng.Language.t("hide_selected_dates",this.get_language()));ng.get("all_sel_dts_tr"+this.id).set_style("display","");this.create_multi_select_dates_list()}else{this.p.show_sel_dts_button.set_text(ng.Language.t("view_selected_dates",this.get_language()));ng.get("all_sel_dts_tr"+this.id).set_style("display","none")}}.bind(this)}});this.p.show_sel_dts_button.make("clear_all_td"+this.id)}}this.update_calendar(this.get_display_date(),true);ng.get("calendar_buttons"+this.id).style.display="";this.fire_event.defer(this,["load"]);return this},is_month_visible:function(c){c=this.process_date(c);var b=0;var a=this.get_display_date().clone();a.setDate(1);while(b<this.get_num_months()){if((c.getMonth()==a.getMonth())&&(c.getFullYear()==a.getFullYear())){return true}a.setMonth(a.getMonth()+1);b++}return false},update_calendar:function(d,c){if(this.is_disabled()){return}d=this.process_date(d);if((!ng.defined(c))&&(this.is_month_visible(d))){return this}var b=this.get_start_date();var a=this.get_end_date();if(d.getTime()<b.getTime()){d=b.clone()}if(d.getTime()>a.getTime()){d=a.clone()}var g=d.clone();g.setMonth(d.getMonth()-1);if((g.getFullYear()<b.getFullYear())||((g.getFullYear()==b.getFullYear())&&(g.getMonth()<b.getMonth()))){this.p.pre_button.disable()}else{this.p.pre_button.enable()}var f=d.clone();f.setMonth(d.getMonth()+1);if((f.getFullYear()>a.getFullYear())||((f.getFullYear()==a.getFullYear())&&(f.getMonth()>a.getMonth()))){this.p.nex_button.disable()}else{this.p.nex_button.enable()}this.set_display_date(d.clone());if(this.p.year_select_menu.get("tag")=="input"){this.p.year_select_menu.value=ng.Language.translate_numbers(d.getFullYear(),this.get_language())}else{this.p.year_select_menu.selectedIndex=d.getFullYear()-b.getFullYear()}ng.get("mn_sel_menu"+this.id).selectedIndex=d.getMonth();if(d.getFullYear()==a.getFullYear()){var e=a.getMonth();ng.get("mn_sel_menu"+this.id).get_children("option",function(i,h){if(h>e){i.disabled=true}else{i.disabled=false}})}else{if(d.getFullYear()==b.getFullYear()){var e=b.getMonth();ng.get("mn_sel_menu"+this.id).get_children("option",function(i,h){if(h<e){i.disabled=true}else{i.disabled=false}})}else{ng.get("mn_sel_menu"+this.id).get_children("option",function(i,h){i.disabled=false})}}this.update_calendar_header();this.create_calendar();if(!ng.defined(c)){this.fire_event("monthchange")}return this},update_calendar_header:function(){if(this.get_num_months()>1){var a=this.get_display_date().getFullYear()}else{var a=this.get_display_date().print(this.get_header_format(),this.get_language())}this.p.year_button.set_text(a)},create_calendar:function(c){if(ng.defined(c)){return this}var b=[];if(this.get_num_months()>1){b.push('<table id="months_group_table'+this.id+'" class="'+this.p.css_prefix+'months_group_table" cellspacing="3"><tr>');var d=this.get_display_date().clone();var e=this.get_num_col();for(var a=0;a<this.get_num_months();a++){b.push('<td class="'+this.p.css_prefix+'month_group_td">');b=b.concat(this.create_month_table(d));b.push("</td>");if(((a+1)%e==0)&&(a>0)){b.push("</tr><tr>")}if(this.is_out_of_range(d)&&!this.p.visible){break}}b.push("</table>")}else{var d=this.get_display_date().clone();b=this.create_month_table(d)}this.p.content_td.set_html(b);return this},create_month_table:function(k){var f=[];var r=k.getMonth()+1;var p=k.getFullYear();var e=this.p.css_prefix;f.push('<table id="month_'+r+"_"+p+"_table"+this.id+'" class="'+e+'month_table">');if(this.get_num_months()>1){f.push('<tr><th id="header_'+r+"_"+p+"_th"+this.id+'" class="'+e+'header_th" colspan="7">');f.push(k.print(this.get_header_format(),this.get_language()));f.push("</th></tr>")}f.push("<tr>");var d=0;var s=ng.Language.t("date",this.get_language());for(var q=0;q<7;q++){d=(q+this.get_start_day())%7;f.push('<td class="'+e+'day_name_td" id="day_name_'+d+"_"+r+"_"+p+"_td"+this.id+'">');f.push(s.days[this.get_days_text()][d]);f.push("</td>")}f.push("</tr>");var b=k.getMonth();var c=k.getFullYear();k.setDate(1);k.setDate(k.getDate()-(k.getDay()-this.get_start_day()));if((k.getDate()<=7)&&(k.getDate()!=1)){k.setDate(k.getDate()-7)}var g,h,n,m,a,t;var e=this.p.css_prefix;var l=this.set_time(new Date()).getTime();for(var q=0;q<7;q++){f.push('<tr class="'+e+'dates_tr">');for(var o=0;o<7;o++){g=h="";m=(k.getMonth()+1)+"_"+k.getDate()+"_"+k.getFullYear();n=this.id+"_"+m;if(k.getMonth()!=b){if(this.is_out_of_range(k)){g="out_of_range";h=this.p.out_of_range_formatter.bind(this,[k])()}else{g="other_month";h=this.p.other_month_formatter.bind(this,[k])()}f.push('<td class="'+e+"date_"+m+" "+e+g+'" ');f.push('rel="'+g+(k.getMonth()+1)+"/"+k.getDate()+"/"+k.getFullYear()+'">'+h+"</td>")}else{a=this.is_selectable(k);if(a[1]=="out of range"){g=e+"out_of_range";h=this.p.out_of_range_formatter.bind(this,[k])()}else{if(a[1]=="weekend"){g=e+"weekend";h=this.p.weekend_formatter.bind(this,[k])()}else{if(a[1]=="day off"){g=e+"day_off";h=this.p.days_off_formatter.bind(this,[k])()}else{if(a[1]=="date off"){g=e+"date_off";h=this.p.dates_off_formatter.bind(this,[k])()}else{if(a[1]=="range off"){g=e+"range_off";h=this.p.range_off_formatter.bind(this,[k])()}else{h=this.p.formatter.bind(this,[k])()}}}}}if(a[0]){if(this.is_selected(k)){g+=" "+e+"selected_date";h=this.p.selected_date_formatter.bind(this,[k])()}g+=" "+e+"selectable"}if(l==k.getTime()){g+=" "+e+"today"}f.push('<td class="'+e+"date_"+m+" "+g+'" id="date_'+n+'" ');f.push('rel="'+(k.getMonth()+1)+"/"+k.getDate()+"/"+k.getFullYear()+'">'+h+"</td>");if(ng.defined(this.get_date_on_avaliable()[m])){this.get_date_on_avaliable()[m].defer(this,["date_"+n])}}k.setDate(k.getDate()+1)}f.push("</tr>");if((k.getFullYear()>c)||(k.getMonth()>b)){break}}f.push("</table>");return f},standard_date_print:function(a){return ng.Language.translate_numbers(a.getDate(),this.get_language())}});ng.map_html5_prop("date",{min:"start_date",max:"end_date"});
