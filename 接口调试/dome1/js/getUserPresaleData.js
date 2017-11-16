define(['https://misc.360buyimg.com/m/fashion/1.0.0/js/trimPath.js'], function() {
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
            success: function(d) { cb(d); },
            error: function(d) {console.log(d) }
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

            var initTemplate = '<div class="tab-wraper"><ul class="presale-tabs"></ul></div><div class="presale-content"></div>';
            $presaleEle.html(initTemplate);

            var l = '';
            d.map(function(g, i) {
                if(d.length < 5) {l = (100/d.length)+'%'} else {l = '21.222vw'}
                list += '<li style="width:'+l+';" data-id="'+g.id+'">'+g.name+'</li>';
                productIds.push(g.id);
            });
            $presaleEle.find('.presale-tabs').append(list);
            $presaleEle.find('.presale-tabs li').eq(0).addClass('ysTabsCur');

            var template = '{for list in groupList}<ul class="presale-item" data-flTabs="${list.groupId}">{for item in list.stageList[0].productList}<li class="goods-item"><div class="goodsPic"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><img src="'+baseInfo.srcInitPic+'" data-src="${item.image}'+webpType+'"></a></div><div class="goodsName"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">${item.name}</a></div><div class="goodsYsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"> <span class="ys-price">{if (item.prePrice=="")}京东价:￥${item.pPrice}{else}京东价:￥${item.prePrice}{/if}</span></a></div><div class="goodsPrice"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3"><span class="yuding-num hide{if (item.prePrice=="")}{/if}">${item.appoints}件已预订</span><span class="p-price">上市价:￥${item.pcpPrice}</span></a></div><div class="dingjin"><a class="J_ping" href="'+detailAddress+'${item.skuId}&clickUrl=" target="_self" report-eventid="Babel_dev_sku" report-eventparam="'+window.pageConfig.activityId+'_${item.skuId}_${list.groupId}_null_${item_index}" report-pagename="http:'+window.pageConfig.pageUrl+'" report-eventlevel="3">立即购买</a></div></li>{/for}</ul>{/for}';

            var productUrl = baseInfo.api+baseInfo.productUrl+'&body={"ids":"'+productIds.join(',')+'","currentStageFlag":"Y","sourceCode":"jshop"}&client=wh5&clientVersion=1.0.0&sid=&uuid='+baseInfo.uuid;
            AjaxData(productUrl, function(data) {
                if ("success" == data.returnMsg && data.groupList && data.groupList.length > 0) {
                    var d = data;
                    $presaleEle.find('.presale-content').html(template.process(d));

                    $presaleEle.find('.presale-content ul[data-flTabs="'+productIds[0]+'"]').show().find('img').each(function() {
                        userLazyloadFun($(this));
                    });

                    $presaleEle.find('.presale-tabs li').on("tap",function(e) {
                        var _this = $(this), i = _this.index(), w = _this.width();
                        var $curTabsContent = $presaleEle.find('.presale-content ul[data-flTabs="'+productIds[i]+'"]');
                        _this.addClass('ysTabsCur').siblings().removeClass('ysTabsCur');
                        require(['https://storage.360buyimg.com/babel/00059939/146022/active/scrollTabToL.min.js'],function(scrollTabToL) {
                            $presaleEle.find('.presale-tabs').scrollTabToL({toL: w*(i-2)});
                        });
                        $curTabsContent.show().siblings().hide();
                        // $('html,body').animate({
                        //     scrollTop: $presaleEle.offset().top
                        // }, 200);
                        $('html,body').scrollTop($presaleEle.offset().top);
                        $curTabsContent.find('img').each(function() {
                            userLazyloadFun($(this));
                        });
                    });

                    require(['https://storage.360buyimg.com/babel/00067765/175382/active/scrollSticky.min.js'],function(initSticky) {
                        var stickyNode = $presaleEle.find('.tab-wraper');
                        var navNode = $presaleEle.find('.presale-tabs');

                        $.initSticky({
                            stickyNode: stickyNode,
                            fixedNode: navNode,
                            top: 0,
                            zIndex: 100,
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