seajs.use(['jdf/2.0.0/ui/tab/1.0.0/tab', 'jdf/2.0.0/ui/lazyload/1.0.0/lazyload'],function(tab, lazyload){
    $(function () {
    	var triggerLazyimg = function (ele) {
	        var img = ele.find('img[trigger-lazy-img]');

	        if (img.length) {
	            img.each(function (index) {
	                $(this).attr('src', $(this).attr('trigger-lazy-img'))
	                    .removeAttr('trigger-lazy-img');
	            });
	        };
	    };

    	var $pslider = $('.slider-160822');
    	var tab = $pslider.tab({
	    	navEl: '.ui-slider-trigger-item',
	    	contentEl: '.slider-item',
		    curCls: 'selected',
		    delay: 200,
		    isAutoPlay: true,
		    interval: 2000,
		    effect: 'flash',
			effectSpeed: 400,
			onChange: function(obj) {
                //obj.contentEl.lazyload({attrSource:'data-lazy-img'});
                triggerLazyimg(obj.contentEl);
            }
	    });

	    $pslider.find('.prevBtn').click(function(){
            tab.prev();
        });

        $pslider.find('.nextBtn').click(function(){
            tab.next();
        });
	});

});
seajs.use(['jdf/2.0.0/ui/elevator/1.0.0/elevator'], function (elevator) {
    $('body').elevator({
        floorEl:'.abroad-item',
        elevatorEl: '.country-list',
        handlerSelector: '.country-item',
        curCls:'ui-elevator-select',
        threshold: null,
        floorScrollMargin: -45
    });
});