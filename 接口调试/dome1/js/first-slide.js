<div id="first-slide" class="swiper-container" data-id="00757377" data-activeid="00064673" data-url="//pro.m.jd.com/mall/active/42CbJtjWZwE1HZWSPWGMqEngbgaY/index.html"></div>

<script type="text/javascript">
/* m-fashion/1.0.0 first-slide.js Date:2017-10-31 19:53:32 */
require([
	"//misc.360buyimg.com/m/fashion/1.0.0/js/swiper-3.4.2.jquery.min.js",
	"//misc.360buyimg.com/m/fashion/1.0.0/js/fashion.js",
	"//misc.360buyimg.com/m/fashion/1.0.0/js/trimPath.js",
	"//misc.360buyimg.com/m/fashion/1.0.0/js/css.min.js!//misc.360buyimg.com/m/fashion/1.0.0/css/fashion.css",
	"//misc.360buyimg.com/m/fashion/1.0.0/js/css.min.js!//misc.360buyimg.com/m/fashion/1.0.0/css/swiper.min.css",
	"//misc.360buyimg.com/m/fashion/1.0.0/js/css.min.js!//misc.360buyimg.com/m/fashion/1.0.0/widget/first-slide/first-slide.css"],
	function(a) {
		var b = $("#first-slide"),
	        c = b.attr("data-id"),
	        d = b.attr("data-activeid"),
	        e = b.attr("data-url");
        var f = '<div class="swiper-wrapper">{for item in list}<div class="swiper-slide"><a class="J_ping" {if (item.linkType != null)} href="${item.link}"{/if} target="_self" report-eventid="Babel_dev_adv_fashion" report-eventparam="' + d + '_${groupId}_${stageId}_NULL_${item.mcInfo}_${item_index}" report-pagename="http:' + e + '" report-eventlevel="3"><img class="swiper-lazy" {if (item_index == 0)} src{else} data-src{/if}="${item.pictureUrl}"/></a></div>{/for}</div><div class="swiper-pagination"></div>';
	    $.ajax({
	    	url: '//api.m.jd.com/client.action?functionId=queryMaterialAdverts&body={"ids":"' + c + '","commentType":"","sourceCode":"fashion","pageId":""}&clientVersion=1.0.0&client=wh5&sid=&uuid=' + window.pageConfig.uuid,
	    	dataType: "jsonp",
	    	timeout: 5e3,
	    	success: function(c) {
	    		if ("success" == c.returnMsg && c.advertInfos && c.advertInfos[0].list.length > 0) {
	    			var d = c.advertInfos[0];
	            	b.html(f.process(d));

	                try {
	                	MPing.inputs.Click.attachEvent()
	                }
	                catch (e) {}

	                // var g;
	                // g = setTimeout(function() {
	                // 	$("#J_babelOptPage .bab_opt_mod_2").animate({ marginTop: "-3.44rem" }, 400)
	                // }, 500);

	                var h;
	                h = setTimeout(function() {
	                	new a("#first-slide", {
	                		pagination: ".swiper-pagination",
	                		paginationClickable: !0,
	                		slidesPerView: "auto",
	                		autoplay: 4e3,
	                		loop: !0,
	                		watchSlidesProgress: !0,
	                		watchSlidesVisibility: !0,
	                		lazyLoading: !0
	                	})
	                }, 2e3)
	            }
	        }
	    })
	}
);
</script>