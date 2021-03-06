/*
 * bootstrap-list-filter v0.2.2 - 2015-09-21
 *
 * Copyright 2015 Stefano Cudini
 * stefano.cudini@gmail.com
 * http://labs.easyblog.it/
 *
 * Licensed under the MIT license.
 *
 * Demos:
 * http://labs.easyblog.it/bootstrap-list-filter/
 *
 * Source:
 * git@github.com:stefanocudini/bootstrap-list-filter.git
 *
 */
!function(a){a.fn.btsListFilter=function(b,c){"use strict";function d(a,b){return a.replace(/\{ *([\w_]+) *\}/g,function(a,c){return b[c]||""})}function e(a,b){var c;return b=b||300,function(){var d=this,e=arguments;clearTimeout(c),c=setTimeout(function(){a.apply(d,Array.prototype.slice.call(e))},b)}}var f,g,h=this,i=a(this),j=a(b),k=i;return c=a.extend({delay:300,minLength:1,initial:!0,casesensitive:!1,eventKey:"keyup",resetOnBlur:!0,sourceData:null,sourceTmpl:'<a class="list-group-item" href="#"><span>{title}</span></a>',sourceNode:function(a){return d(c.sourceTmpl,a)},emptyNode:function(a){return'<a class="list-group-item well" href="#"><span>No Results</span></a>'},itemClassTmp:"bts-dynamic-item",itemEl:".list-group-item",itemChild:null,itemFilter:function(b,d){d=d&&d.replace(new RegExp("[({[^.$*+?\\]})]","g"),"");var e=a(b).text(),f=c.initial?"^":"",g=new RegExp(f+d,c.casesensitive?"":"i");return g.test(e)},cancelNode:function(){return''}},c),h.reset=function(){j.val("").trigger(c.eventKey)},a.isFunction(c.cancelNode)&&(f=a(c.cancelNode.call(h)),j.after(f),j.parents(".form-group").addClass("has-feedback"),j.prev().is(".control-label")||f.css({top:0}),f.on("click",h.reset)),j.on(c.eventKey,e(function(b){var d=a(this).val();c.itemEl&&(k=i.find(c.itemEl)),c.itemChild&&(k=k.find(c.itemChild));var e=k.filter(function(){return c.itemFilter.call(h,this,d)}),f=k.not(e);c.itemChild&&(e=e.parents(c.itemEl),f=f.parents(c.itemEl).hide()),""!==d&&d.length>=c.minLength?(e.show(),f.hide(),"function"===a.type(c.sourceData)?(e.hide(),f.hide(),g&&(a.isFunction(g.abort)?g.abort():a.isFunction(g.stop)&&g.stop()),g=c.sourceData.call(h,d,function(b){if(g=null,e.hide(),f.hide(),i.find("."+c.itemClassTmp).remove(),b&&0!==b.length)for(var d in b)a(c.sourceNode.call(h,b[d])).addClass(c.itemClassTmp).appendTo(i);else a(c.emptyNode.call(h)).addClass(c.itemClassTmp).appendTo(i)})):(i.find("."+c.itemClassTmp).remove(),0===e.length&&a(c.emptyNode.call(h)).addClass(c.itemClassTmp).appendTo(i))):(e.show(),f.show(),i.find("."+c.itemClassTmp).remove())},c.delay)),c.resetOnBlur&&j.on("blur",function(a){h.reset()}),i}}(jQuery);