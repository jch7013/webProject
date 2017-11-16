define(['https://h5.m.jd.com/dev/AoY8oPJews28R9bXaCcu41LJPm1/pages/180429/js/jquery.min.js','https://h5.m.jd.com/dev/AoY8oPJews28R9bXaCcu41LJPm1/pages/180429/js/trimPath.js','https://h5.m.jd.com/dev/AoY8oPJews28R9bXaCcu41LJPm1/pages/180429/js/touch.min.js'], function() {
    var baseInfo = {
        'api': 'https://api.m.jd.com/client.action?functionId=',
        'productUrl': 'queryMatProdsForGrps',
        'goodsAppAddress': 'https://item.m.jd.com/ware/view.action?wareId=',
        'goodsWqAddress': 'https://wqitem.jd.com/item/view?sku=',
        'srcInitPic': 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=',
        'uuid': (new Date).getTime() + 97531
    }

    function userLazyloadFun($imgEle) {
        var winHeight = $(window).height(), imgHeight = $imgEle.height(),
            srcInit = baseInfo.srcInitPic,
            scrollTop = $imgEle.offset().top - (document.documentElement.scrollTop+document.body.scrollTop);
        if($imgEle.attr('src') == srcInit && scrollTop <= winHeight && scrollTop > -imgHeight) {
            $imgEle.attr({'src': $imgEle.attr("data-src") ,'data-src': ''});
            $imgEle.css('opacity',1);
        }
    }

    function AjaxData(productUrl, cb) {
        $.ajax({
            url: productUrl,
            dataType: "jsonp",
            timeout: 5000,
            jsonp: "callback",
            jsonpCallback:"jsonpCallback"+new Date().getTime(),
            success: function(d) {cb(d);},
            error: function(d) {console.log(d) }
        }).then(function(){
            try{
                MPing.inputs.Click.attachEvent();
            }catch(e){}
        });
    }

    function checkWebp() {
        try{
            return (document.createElement('canvas').toDataURL('image/webp').indexOf('data:image/webp') == 0);
        }catch(err) {
            return  false;
        }
    }

    var getAddressType = {
        isAppAddress: function(){
            return !!location.pathname.match(/^\/mall\//);
        },
        isWQAddress: function(){
            return !!location.pathname.match(/^\/wq\//);
        }
    }

    var detailAddress = (getAddressType.isWQAddress() ? baseInfo.goodsWqAddress : baseInfo.goodsAppAddress);
    webpType = (checkWebp() ? '.webp' : '');

    return {
        slideStyle: function(presaleData){
            var $presaleEle=$('#'+presaleData.ele);

           var template = '{for item in productList}<li><div class="goodsPic"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><img {if (item_index<4)} src="${item.image}" data-src="" style="opacity:1;"{else} src="'+baseInfo.srcInitPic+'" data-src="${item.image}'+webpType+'" {/if}></a></div><div class="goodsName"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">${item.name}</a></div><div class="goodsYsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><span class="ys-price">{if (item.prePrice=="")}京东价:￥${item.pPrice}{else}京东价:￥${item.prePrice}{/if}</span></a></div><div class="goodsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><span class="p-price hide{if (item.prePrice=="")}{/if}">${item.appoints}件已预订</span></a></div><div class="dingjin"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">立即购买</a></div></li>{/for}';

            var productUrl = baseInfo.api+baseInfo.productUrl+'&body={"ids":"'+presaleData.id+'","currentStageFlag":"Y","sourceCode":"jshop"}&client=wh5&clientVersion=1.0.0&sid=&uuid='+baseInfo.uuid;
            AjaxData(productUrl, function(data) {
                var d = data.groupList[0].stageList[0];
                if ("success" == data.returnMsg && d.productList && d.productList.length > 0) {
                    $presaleEle.html(template.process(d));
                }
            });
        },
        tabStyle: function(presaleData) {
            var productIds = [], list='', d=presaleData.data, $presaleEle=$('#'+presaleData.ele);

            var initTemplate = '<div class="tab-wraper"><div class="tab-nav"><div class="tab-nav-left"><div class="tab-nav-list"><ul></ul></div></div></div></div><div class="presale-content"></div>';
            $presaleEle.html(initTemplate);

            var l='', minLiW = ($presaleEle.width()-160)/4;
            d.map(function(g, i) {
                list += '<li style="min-width:'+minLiW+'px;" data-id="'+g.id+'">'+g.name+'</li>';
                productIds.push(g.id);
            });
            list = list + '<li class="sideline"></li>';
            $presaleEle.find('ul').append(list);
            $presaleEle.find('ul li').eq(0).addClass('ysTabsCur');

            var template = '{for list in groupList}<ul class="presale-item" data-flTabs="${list.groupId}">{for item in list.stageList[0].productList}<li class="goods-item"><div class="goodsPic"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><img src="'+baseInfo.srcInitPic+'" data-src="${item.image}'+webpType+'"></a></div><div class="goodsName"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">${item.name}</a></div><div class="goodsYsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"> <span class="ys-price">{if (item.prePrice=="")}京东价:￥${item.pPrice}{else}京东价:￥${item.prePrice}{/if}</span></a></div><div class="goodsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><span class="yuding-num hide{if (item.prePrice=="")}{/if}">${item.appoints}件已预订</span><span class="p-price">上市价:￥${item.pcpPrice}</span></a></div><div class="dingjin"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">立即购买</a></div></li>{/for}</ul>{/for}';

            var productUrl = baseInfo.api+baseInfo.productUrl+'&body={"ids":"'+productIds.join(',')+'","currentStageFlag":"Y","sourceCode":"jshop"}&client=wh5&clientVersion=1.0.0&sid=&uuid='+baseInfo.uuid;
            AjaxData(productUrl, function(data) {
                if ("success" == data.returnMsg && data.groupList && data.groupList.length > 0) {
                    var d = data;
                    $presaleEle.find('.presale-content').html(template.process(d));

                    $presaleEle.find('.presale-content ul[data-flTabs="'+productIds[0]+'"]').show().find('img').each(function() {
                        userLazyloadFun($(this));
                    });

                    var nav_w=$presaleEle.find('.tab-nav-list li').first().width();
                    var fl_w=$presaleEle.find(".tab-nav-list").width();
                    var flb_w=$presaleEle.find(".tab-nav-left").width();
                    var $sideLine = $presaleEle.find(".tab-nav-list .sideline");
                    $presaleEle.find(".sideline").width(nav_w);

                    $presaleEle.find(".tab-nav-list li").on('tap', function(){
                        var _this = $(this), i = _this.index(), w = _this.width();
                        var $curTabsContent = $presaleEle.find('.presale-content ul[data-flTabs="'+productIds[i]+'"]');
                        var underscore = 0.1;
                        nav_w=$(this).width();
                        $sideLine.stop(true);
                        $sideLine.animate({width:nav_w*underscore,left:$(this).position().left+(nav_w/2-nav_w*underscore/2)},300,function(){
                            $(this).animate({left:$(this).position().left-(nav_w/2-nav_w*underscore/2), width:nav_w},300);
                        });
                        $(this).addClass("tabsCur").siblings().removeClass("tabsCur");

                        var fn_w = ($presaleEle.find(".tab-nav").width() - nav_w) / 2;
                        var fnl_l;
                        var fnl_x = parseInt($(this).position().left);
                        if (fnl_x <= fn_w) {
                            fnl_l = 0;
                        } else if (fn_w - fnl_x <= flb_w - fl_w) {
                            fnl_l = flb_w - fl_w;
                        } else {
                            fnl_l = fn_w - fnl_x;
                        }
                        $presaleEle.find(".tab-nav-list").animate({"left" : fnl_l }, 300);

                        $curTabsContent.show().siblings().hide();

                        $('html,body').animate({
                            scrollTop: $presaleEle.offset().top
                        }, 300);
                        $curTabsContent.find('img').each(function() {
                            userLazyloadFun($(this));
                        });
                    });

                    $presaleEle.find(".tab-nav-list").on('touchstart', function (e) {
                        var touch1 = e.originalEvent.targetTouches[0];
                        x1 = touch1.pageX;
                        y1 = touch1.pageY;
                        ty_left = parseInt($(this).css("left"));
                    });

                    $presaleEle.find(".tab-nav-list").on('touchmove', function (e) {
                        var touch2 = e.originalEvent.targetTouches[0];
                        var x2 = touch2.pageX;
                        var y2 = touch2.pageY;
                        if(ty_left + x2 - x1>=0){
                            $(this).css("left", 0);
                        }else if(ty_left + x2 - x1<=flb_w-fl_w){
                            $(this).css("left", flb_w-fl_w);
                        }else{
                            $(this).css("left", ty_left + x2 - x1);
                        }
                        if(Math.abs(y2-y1)>0){
                            e.preventDefault();
                        }
                    });

                    require(['https://storage.360buyimg.com/babel/00067765/175382/active/scrollSticky.min.js'],function(initSticky) {
                        var stickyNode = $presaleEle.find('.tab-wraper');
                        var navNode = $presaleEle.find('.tab-nav');

                        $.initSticky({
                            stickyNode: stickyNode,
                            fixedNode: navNode,
                            top: 0,
                            zIndex: 9,
                            fixedClazz: 'fixed',
                            runInScrollFn: cbOnscroll
                        });

                        function cbOnscroll() {
                            var wst = $(window).scrollTop();
                            var EH = $presaleEle.height();
                            var estTop = $presaleEle.offset().top;
                            var estEnd = $presaleEle.offset().top + EH;

                            if (Math.floor(estTop) <= wst && Math.floor(estEnd) > wst) {
                                navNode.addClass('fixed');
                            } else {
                                navNode.removeClass('fixed');
                                navNode.css({'position':'', 'top':'', 'z-index':''});
                            }
                        }
                    });
                }
            });
        },
        listStyle: function(presaleData) {
            var $presaleEle=$('#'+presaleData.ele);

            var initTemplate = '<div class="presale-content"><ul class="presale-item" style="display:block;"></ul></div>';
            $presaleEle.html(initTemplate);

            var template = '{for item in productList}<li class="goods-item"><div class="goodsPic"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><img src="'+baseInfo.srcInitPic+'" data-src="${item.image}'+webpType+'"></a></div><div class="goodsName"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">${item.name}</a></div><div class="goodsYsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"> <span class="ys-price">{if (item.prePrice=="")}京东价:￥${item.pPrice}{else}京东价:￥${item.prePrice}{/if}</span></a></div><div class="goodsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><span class="yuding-num hide{if (item.prePrice=="")}{/if}">${item.appoints}件已预订</span><span class="p-price">上市价:￥${item.pcpPrice}</span></a></div><div class="dingjin"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">立即购买</a></div></li>{/for}';
            var productUrl = baseInfo.api+baseInfo.productUrl+'&body={"ids":"'+presaleData.id+'","currentStageFlag":"Y","sourceCode":"jshop"}&client=wh5&clientVersion=1.0.0&sid=&uuid='+baseInfo.uuid;
            AjaxData(productUrl, function(data) {
                var d = data.groupList[0].stageList[0];
                if ("success" == data.returnMsg && d.productList && d.productList.length > 0) {
                    $presaleEle.find('.presale-item').html(template.process(d)).find('img').each(function() {
                        userLazyloadFun($(this));
                    });
                }
            });
        }
    }
});