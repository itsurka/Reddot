
var URL = (function (a) {
    return {
        // create a querystring from a params object
        serialize: function (params) { 
            var key, query = [];
            for (key in params) {
                query.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
            }
            return query.join('&');
        },

        // create a params object from a querystring
        unserialize: function (query) {
            var pair, params = {};
            query = query.replace(/^\?/, '').split(/&/);
            for (pair in query) {
                pair = query[pair].split('=');
                params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
            }
            return params;
        },

        parse: function (url) {
            a.href = url;
            return {
                // native anchor properties
                hash: a.hash,
                host: a.host,
                hostname: a.hostname,
                href: url,
                pathname: a.pathname,
                port: a.port,
                protocol: a.protocol,
                search: a.search,
                // added properties
                file: a.pathname.split('/').pop(),
                params: URL.unserialize(a.search)
            };
        }
    };
}(document.createElement('a')));

function array_merge () {
    var args = Array.prototype.slice.call(arguments),
    argl = args.length,
    arg,
    retObj = {},
    k = '', 
    argil = 0,
    j = 0,
    i = 0,
    ct = 0,
    toStr = Object.prototype.toString,
    retArr = true;
 
    for (i = 0; i < argl; i++) {
        if (toStr.call(args[i]) !== '[object Array]') {
            retArr = false;
            break;
        }
    }
 
    if (retArr) {
        retArr = [];
        for (i = 0; i < argl; i++) {
            retArr = retArr.concat(args[i]);
        }
        return retArr;
    }
 
    for (i = 0, ct = 0; i < argl; i++) {
        arg = args[i];
        if (toStr.call(arg) === '[object Array]') {
            for (j = 0, argil = arg.length; j < argil; j++) {
                retObj[ct++] = arg[j];
            }
        }
        else {
            for (k in arg) {
                if (arg.hasOwnProperty(k)) {
                    if (parseInt(k, 10) + '' === k) {
                        retObj[ct++] = arg[k];
                    }
                    else {
                        retObj[k] = arg[k];
                    }
                }
            }
        }
    }
    return retObj;
}

function array_key_exists (key, search) {
    if (!search || (search.constructor !== Array && search.constructor !== Object)) {
        return false;
    }
 
    return key in search;
}


// показать корзину
function show_replenishment() {

    if ($('#fade')[0] == undefined)
    {
        $("body").append('<div id="fade" ></div>');
        body_height = document.documentElement.scrollHeight;
        $("body #fade").css("height",body_height);
    }

    $("#shop_replenishment").center();

    var w = $(window);
    $("#shop_replenishment").css('top', 20+w.scrollTop()+'px');

    if ($.browser.msie) {

        $("body #fade").fadeTo(300, 0.4, function() {
            $("#shop_replenishment").show();
        });

    } else {

        $("body #fade").fadeTo(500, 0.4);
        $("#shop_replenishment").fadeTo(500, 1);
    }
    $("#fade").click(close_basket);
    return false;
}

// закрыть корзину
function close_replenishment() {

    $('#shop_replenishment').slideUp(500, function() {
        $("#fade").remove();
    });
}