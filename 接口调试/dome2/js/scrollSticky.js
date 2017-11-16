(function() {
    function Sticky(){
        this.init.apply(this, arguments);
    }

    Sticky.setting = {
        stickyNode: null,
        fixedNode: null,
        top: 0,
        zIndex: 100,
        fixedClazz: '',
        runInScrollFn: null
    };

    var sPro = Sticky.prototype;
    var g = window;

    sPro.init = function(options){
        this.setting = $.extend({}, Sticky.setting, options, true);
        if (options.fixedNode) {
            this.fixedNode = options.fixedNode[0] || options.fixedNode;
            this.stickyNode = options.stickyNode[0] || options.stickyNode;
            this.cssStickySupport = this.checkStickySupport();
            this.stickyNodeHeight = this.stickyNode.clientHeight;
            this.fixedClazz = options.fixedClazz;
            this.top = parseInt(options.top, 10) || 0;
            this.zIndex = parseInt(options.zIndex) || 1;
            this.setStickyCss();
            this.isfixed = false;
            // 把改变定位的操作添加到节流函数与window.requestAnimationFrame方法中，确保一定事件内必须执行一次
            this.onscrollCb = this.throttle(function() {
                this.nextFrame(this.sticky.bind(this));
            }.bind(this), 50, 100);
            this.initCss = this.getInitCss();
            this.fixedCss = this.getFixedCss();
            this.addEvent();
        }
    };

    sPro.getInitCss = function() {
        if (!!this.fixedNode) {
            return "position:" + this.fixedNode.style.position + ";top:" + this.fixedNode.style.top + "px;z-index:" + this.fixedNode.style.zIndex + ";";
        }
        return "";
    };

    sPro.getFixedCss = function() {
        return "position:fixed;top:" + this.top + "px;z-index:" + this.zIndex + ";";
    };

    sPro.setFixedCss = function(style) {
        if(!this.cssStickySupport){
            if (!!this.fixedNode){
                this.fixedNode.style.cssText = style;
            }
        }
    };

    sPro.checkStickySupport = function() {
        var div= null;
        if(g.CSS && g.CSS.supports){
            return g.CSS.supports("(position: sticky) or (position: -webkit-sticky)");
        }
        div = document.createElement("div");
        div.style.position = "sticky";
        if("sticky" === div.style.position){
            return true;
        }
        div.style.position = "-webkit-sticky";
        if("-webkit-sticky" === div.style.position){
            return true;
        }
        div = null;
        return false;
    };

    sPro.setStickyCss = function() {
        if(this.cssStickySupport){
            this.stickyNode.style.cssText = "position:-webkit-sticky;position:sticky;top:" + this.top + "px;z-index:" + this.zIndex + ";";
        }
    };

    sPro.addEvent = function() {
        $(g).on('scroll', this.onscrollCb.bind(this));
    };

    sPro.throttle = function(fn, delay, mustRunDelay){
        var timer = null;
        var lastTime;
        return function(){
            var now = +new Date();
            var args = arguments;
            g.clearTimeout(timer);
            if(!lastTime){
                lastTime = now;
            }
            if(now - lastTime > mustRunDelay){
                fn.apply(this, args);
                lastTime = now;
            }else{
                g.setTimeout(function(){
                    fn.apply(this, args);
                }.bind(this), delay);
            }
        }.bind(this);
    };

    sPro.nextFrame = (function(fn){
        var prefix = ["ms", "moz", "webkit", "o"];
        var handle = {};
        handle.requestAnimationFrame = window.requestAnimationFrame;
        for(var i = 0; i < prefix.length && !handle.requestAnimationFrame; ++i){
            handle.requestAnimationFrame = window[prefix[i] + "RequestAnimationFrame"];
        }
        if(!handle.requestAnimationFrame){
            handle.requestAnimationFrame = function(fn) {
                var raf = window.setTimeout(function() {
                    fn();
                }, 16);
                return raf;
            };
        }
        return function(fn) {
            handle.requestAnimationFrame.apply(g, arguments);
        }
    })();

    sPro.sticky = function() {
        this.setting.runInScrollFn && this.setting.runInScrollFn();
        var stickyNodeBox = this.stickyNode.getBoundingClientRect();

        if(stickyNodeBox.top <= this.top && !this.isfixed){
            this.setFixedCss(this.fixedCss);
            this.fixedClazz && $(this.fixedNode).addClass(this.fixedClazz);
            this.isfixed = true;
            $(this).trigger('onsticky', true);
        } else if(stickyNodeBox.top > this.top && this.isfixed) {
            this.setFixedCss(this.initCss.replace(/position:[^;]*/, "position:static"));
            g.setTimeout(function() {
                this.setFixedCss(this.initCss)
            }.bind(this), 30);
            this.fixedClazz && $(this.fixedNode).removeClass(this.fixedClazz);
            this.isfixed = false;
            $(this).trigger('onsticky', true);
        }
    };

    $.initSticky = function(options){
        return new Sticky(options);
    };
})();