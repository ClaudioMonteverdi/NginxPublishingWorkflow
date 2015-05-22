/* jslint browser:true, devel:true, unparam:true */
/* global $:true, console:true, URI:true */
(function () {
    'use strict';
    var sourceWindow;
    var ignoreScroll = false;
    var trackScroll = function (event) {
        if (ignoreScroll) {
            return;
        }
        //console.dir(event);
        ignoreScroll = true;
        // var iframe = event.data.iframe;
        var side = event.data.side;
        var scrollTarget = {
            'left': 'right',
            'right': 'left'
        };


        $('.compare-frame.' + side).each(function (idx, iframe) {
            sourceWindow = iframe.contentWindow;
            var scrollTop = iframe.contentWindow.document.body.scrollTop;
            $('.compare-frame.' + scrollTarget[side]).each(function (idx, iframe) {
                if (sourceWindow !== iframe.contentWindow) {
                    iframe.contentWindow.document.body.scrollTop = scrollTop;
                    ignoreScroll = false;
                }
            });
        });
        // console.log('scroll',event);
    };

    var postLoadSetup = function (iframe, side) {
        var $window = $(iframe.contentWindow);
        console.log('iframe.contentWindow', iframe.contentWindow);
        $window.on('scroll', null, {
            iframe: iframe,
            side: side
        }, trackScroll);

        $(iframe.contentWindow.document).find('a').each(function(idx,el){
            $(el).click(function(event) {
                event.preventDefault();
                return false;
            });
        });
        $(iframe.contentWindow.document).find('form').each(function(idx,el){
            $(el).submit(function(event) {
                event.preventDefault();
                return false;
            });
        });

        //console.log('URI', URI(iframe.contentWindow.location));
    };

    var setVersion = function (url, version) {
        url = URI(url);
        var params = url.search(true);
        params['site-version'] = version;
        url.search(params);
        return url.toString();
    };


    $('.compare-control').on('do-compare', null, null, function (event, liveUrl, pendingUrl) {
        //console.log('do-compare!');
        var uri;
        if (!liveUrl) {
            liveUrl = $('#compare-url-live').val();
        }
        $('#compare-url-live').val(liveUrl);

        if (!pendingUrl) {
            pendingUrl = $('#compare-url-approval').val();
        }
        $('#compare-url-approval').val(pendingUrl);

        uri = setVersion(liveUrl, 'live');
        $('#left-url').val(uri);

        uri = setVersion(pendingUrl, 'pending-review');
        $('#right-url').val(uri);

        $('.compare-frame.left').one('load', function () {
            setTimeout(function () {
                $('.compare-frame.right').trigger('compare-load', [$('#right-url').val(), 'right']);
            }, 1000);
        });
        $('.compare-frame.left').trigger('compare-load', [$('#left-url').val(), 'left']);

    });

    $(function ($) {

        $('#compare-url').keypress(function (event) {

            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode.toString() === '13') {
                $('.compare-control').trigger('do-compare');
            }

        });

        $('.compare-frame').on('compare-load', function (event, url, side) {
            var iframe = this;
            $(iframe).hide();

            $(iframe).one('load', function () {

                $(iframe).one('load', function () {


                    $(iframe).one('load', function () {

                        $(iframe).show();
                        postLoadSetup(iframe, side);
                    });
                    this.contentWindow.location.reload(true);

                });
                $(iframe).attr('src', url);
            });
            $(iframe).attr('src', 'about:blank');


            //console.log('compare-load',this);
        });

        $('.compare-frame.left').one('load', function () {
            setTimeout(function () {
                $('.compare-frame.right').trigger('compare-load', [$('#right-url').val(), 'right']);
            }, 1000);
        });
        $('.compare-frame.left').trigger('compare-load', [$('#left-url').val(), 'left']);
        $('.compare-control').trigger('do-compare');


    });



})(this);