$.fn.scrollTabToL = function(options){
    var defaults = {toL : 0, durTime : 10, delay : 1, callback:null };
    var opts = $.extend(defaults,options),
        timer = null,
        _this = this,
        curLeft = _this.scrollLeft(),
        subTop = opts.toL - curLeft,
        index = 0,
        dur = Math.round(opts.durTime / opts.delay),
        smoothScroll = function(t){
            index++;
            var per = Math.round(subTop/dur);
            if(index >= dur){
                _this.scrollLeft(t);
                window.clearInterval(timer);
                if(opts.callback && typeof opts.callback == 'function'){
                    opts.callback();
                }
                return;
            }else{
                _this.scrollLeft(curLeft + index*per);
            }
        };
    timer = window.setInterval(function(){
        smoothScroll(opts.toL);
    }, opts.delay);
    return _this;
};