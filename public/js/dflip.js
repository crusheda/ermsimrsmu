!function() {
    var e = {
        745: function() {
            !function() {
                var e, t, i = i || (e = [],
                {
                    getAll: function() {
                        return e
                    },
                    removeAll: function() {
                        e = []
                    },
                    add: function(t) {
                        e.push(t)
                    },
                    remove: function(t) {
                        var i = e.indexOf(t);
                        -1 !== i && e.splice(i, 1)
                    },
                    update: function(t) {
                        if (0 === e.length)
                            return !1;
                        var i = 0;
                        for (t = null != t ? t : window.performance.now(); i < e.length; )
                            e[i].update(t) ? i++ : e.splice(i, 1);
                        return !0
                    }
                });
                i.Tween = function(e) {
                    var t = e
                      , n = {}
                      , o = {}
                      , a = {}
                      , r = 1e3
                      , s = 0
                      , l = !1
                      , u = !1
                      , h = !1
                      , p = 0
                      , c = null
                      , d = i.Easing.Linear.None
                      , f = i.Interpolation.Linear
                      , g = []
                      , v = null
                      , m = !1
                      , y = null
                      , b = null
                      , w = null;
                    for (var P in e)
                        n[P] = parseFloat(e[P], 10);
                    this.to = function(e, t) {
                        return null != t && (r = t),
                        o = e,
                        this
                    }
                    ,
                    this.start = function(e) {
                        for (var r in i.add(this),
                        u = !0,
                        m = !1,
                        c = null != e ? e : window.performance.now(),
                        c += p,
                        o) {
                            if (o[r]instanceof Array) {
                                if (0 === o[r].length)
                                    continue;
                                o[r] = [t[r]].concat(o[r])
                            }
                            null != n[r] && (n[r] = t[r],
                            n[r]instanceof Array == !1 && (n[r] *= 1),
                            a[r] = n[r] || 0)
                        }
                        return this
                    }
                    ,
                    this.stop = function() {
                        return u ? (i.remove(this),
                        u = !1,
                        null != w && w.call(t),
                        this.stopChainedTweens(),
                        this) : this
                    }
                    ,
                    this.stopChainedTweens = function() {
                        for (var e = 0, t = g.length; e < t; e++)
                            g[e].stop()
                    }
                    ,
                    this.complete = function() {
                        return u ? (i.remove(this),
                        u = !1,
                        null != b && b.call(t),
                        this.completeChainedTweens(),
                        this) : this
                    }
                    ,
                    this.completeChainedTweens = function() {
                        for (var e = 0, t = g.length; e < t; e++)
                            g[e].complete()
                    }
                    ,
                    this.delay = function(e) {
                        return p = e,
                        this
                    }
                    ,
                    this.repeat = function(e) {
                        return s = e,
                        this
                    }
                    ,
                    this.yoyo = function(e) {
                        return l = e,
                        this
                    }
                    ,
                    this.easing = function(e) {
                        return d = null == e ? d : e,
                        this
                    }
                    ,
                    this.interpolation = function(e) {
                        return f = e,
                        this
                    }
                    ,
                    this.chain = function() {
                        return g = arguments,
                        this
                    }
                    ,
                    this.onStart = function(e) {
                        return v = e,
                        this
                    }
                    ,
                    this.onUpdate = function(e) {
                        return y = e,
                        this
                    }
                    ,
                    this.onComplete = function(e) {
                        return b = e,
                        this
                    }
                    ,
                    this.onStop = function(e) {
                        return w = e,
                        this
                    }
                    ,
                    this.update = function(e) {
                        var i, u, w;
                        if (e < c)
                            return !0;
                        for (i in !1 === m && (null != v && v.call(t),
                        m = !0),
                        w = d(u = (u = (e - c) / r) > 1 ? 1 : u),
                        o)
                            if (null != n[i]) {
                                var P = n[i] || 0
                                  , S = o[i];
                                S instanceof Array ? t[i] = f(S, w) : ("string" == typeof S && (S = S.startsWith("+") || S.startsWith("-") ? P + parseFloat(S, 10) : parseFloat(S, 10)),
                                "number" == typeof S && (t[i] = P + (S - P) * w))
                            }
                        if (null != y && y.call(t, w),
                        1 === u) {
                            if (s > 0) {
                                for (i in isFinite(s) && s--,
                                a) {
                                    if ("string" == typeof o[i] && (a[i] = a[i] + parseFloat(o[i], 10)),
                                    l) {
                                        var C = a[i];
                                        a[i] = o[i],
                                        o[i] = C
                                    }
                                    n[i] = a[i]
                                }
                                return l && (h = !h),
                                c = e + p,
                                !0
                            }
                            null != b && b.call(t);
                            for (var T = 0, x = g.length; T < x; T++)
                                g[T].start(c + r);
                            return !1
                        }
                        return !0
                    }
                }
                ,
                i.Easing = {
                    Linear: {
                        None: function(e) {
                            return e
                        }
                    },
                    Quadratic: {
                        In: function(e) {
                            return e * e
                        },
                        Out: function(e) {
                            return e * (2 - e)
                        },
                        InOut: function(e) {
                            return (e *= 2) < 1 ? .5 * e * e : -.5 * (--e * (e - 2) - 1)
                        }
                    },
                    Quartic: {
                        In: function(e) {
                            return e * e * e * e
                        },
                        Out: function(e) {
                            return 1 - --e * e * e * e
                        },
                        InOut: function(e) {
                            return (e *= 2) < 1 ? .5 * e * e * e * e : -.5 * ((e -= 2) * e * e * e - 2)
                        }
                    },
                    Sinusoidal: {
                        In: function(e) {
                            return 1 - Math.cos(e * Math.PI / 2)
                        },
                        Out: function(e) {
                            return Math.sin(e * Math.PI / 2)
                        },
                        InOut: function(e) {
                            return .5 * (1 - Math.cos(Math.PI * e))
                        }
                    },
                    Cubic: {
                        In: function(e) {
                            return e * e * e
                        },
                        Out: function(e) {
                            return --e * e * e + 1
                        },
                        InOut: function(e) {
                            return (e *= 2) < 1 ? .5 * e * e * e : .5 * ((e -= 2) * e * e + 2)
                        }
                    }
                },
                i.Interpolation = {
                    Linear: function(e, t) {
                        var n = e.length - 1
                          , o = n * t
                          , a = Math.floor(o)
                          , r = i.Interpolation.Utils.Linear;
                        return t < 0 ? r(e[0], e[1], o) : t > 1 ? r(e[n], e[n - 1], n - o) : r(e[a], e[a + 1 > n ? n : a + 1], o - a)
                    },
                    Bezier: function(e, t) {
                        for (var n = 0, o = e.length - 1, a = Math.pow, r = i.Interpolation.Utils.Bernstein, s = 0; s <= o; s++)
                            n += a(1 - t, o - s) * a(t, s) * e[s] * r(o, s);
                        return n
                    },
                    Utils: {
                        Linear: function(e, t, i) {
                            return (t - e) * i + e
                        },
                        Bernstein: function(e, t) {
                            var n = i.Interpolation.Utils.Factorial;
                            return n(e) / n(t) / n(e - t)
                        },
                        Factorial: (t = [1],
                        function(e) {
                            var i = 1;
                            if (t[e])
                                return t[e];
                            for (var n = e; n > 1; n--)
                                i *= n;
                            return t[e] = i,
                            i
                        }
                        ),
                        CatmullRom: function(e, t, i, n, o) {
                            var a = .5 * (i - e)
                              , r = .5 * (n - t)
                              , s = o * o;
                            return (2 * t - 2 * i + a + r) * (o * s) + (-3 * t + 3 * i - 2 * a - r) * s + a * o + t
                        }
                    }
                },
                window.TWEEN = i
            }()
        }
    }
      , t = {};
    function i(n) {
        var o = t[n];
        if (void 0 !== o)
            return o.exports;
        var a = t[n] = {
            exports: {}
        };
        return e[n](a, a.exports, i),
        a.exports
    }
    i.amdO = {},
    function() {
        "use strict";
        var e = {
            jQuery: jQuery,
            version: "2.2.57",
            autoDetectLocation: !0,
            slug: void 0,
            locationVar: "dearViewerLocation",
            locationFile: void 0,
            MOUSE_CLICK_ACTIONS: {
                NONE: "none",
                NAV: "nav"
            },
            ARROW_KEYS_ACTIONS: {
                NONE: "none",
                NAV: "nav"
            },
            MOUSE_DBL_CLICK_ACTIONS: {
                NONE: "none",
                ZOOM: "zoom"
            },
            MOUSE_SCROLL_ACTIONS: {
                NONE: "none",
                ZOOM: "zoom",
                NAV: "nav"
            },
            PAGE_SCALE: {
                PAGE_FIT: "fit",
                PAGE_WIDTH: "width",
                AUTO: "auto",
                ACTUAL: "actual",
                MANUAL: "manual"
            },
            READ_DIRECTION: {
                LTR: "ltr",
                RTL: "rtl"
            },
            TURN_DIRECTION: {
                LEFT: "left",
                RIGHT: "right",
                NONE: "none"
            },
            INFO_TYPE: {
                INFO: "info",
                ERROR: "error"
            },
            FLIPBOOK_PAGE_MODE: {
                SINGLE: "single",
                DOUBLE: "double",
                AUTO: "auto"
            },
            FLIPBOOK_SINGLE_PAGE_MODE: {
                ZOOM: "zoom",
                BOOKLET: "booklet",
                AUTO: "auto"
            },
            FLIPBOOK_PAGE_SIZE: {
                AUTO: "auto",
                SINGLE: "single",
                DOUBLE_INTERNAL: "dbl_int",
                DOUBLE: "dbl",
                DOUBLE_COVER_BACK: "dbl_cover_back"
            },
            LINK_TARGET: {
                NONE: 0,
                SELF: 1,
                BLANK: 2,
                PARENT: 3,
                TOP: 4
            },
            CONTROLS_POSITION: {
                HIDDEN: "hidden",
                TOP: "top",
                BOTTOM: "bottom"
            },
            TURN_CORNER: {
                TL: "tl",
                TR: "tr",
                BL: "bl",
                BR: "br",
                L: "l",
                R: "r",
                NONE: "none"
            },
            REQUEST_STATUS: {
                OFF: "none",
                ON: "pending",
                COUNT: "counting"
            },
            TEXTURE_TARGET: {
                THUMB: 0,
                VIEWER: 1,
                ZOOM: 2
            },
            FLIPBOOK_CENTER_SHIFT: {
                RIGHT: 1,
                LEFT: -1,
                NONE: 0
            },
            FLIPBOOK_COVER_TYPE: {
                NONE: "none",
                PLAIN: "plain",
                BASIC: "basic",
                RIDGE: "ridge"
            }
        };
        function t(e) {
            return t = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            t(e)
        }
        e._defaults = {
            is3D: !0,
            has3DShadow: !0,
            color3DCover: "#aaaaaa",
            color3DSheets: "#fff",
            cover3DType: e.FLIPBOOK_COVER_TYPE.NONE,
            flexibility: .9,
            height: "auto",
            autoOpenOutline: !1,
            autoOpenThumbnail: !1,
            showDownloadControl: !0,
            showSearchControl: !0,
            showPrintControl: !0,
            enableSound: !0,
            duration: 800,
            pageRotation: 0,
            flipbook3DTiltAngleUp: 0,
            flipbook3DTiltAngleLeft: 0,
            readDirection: e.READ_DIRECTION.LTR,
            pageMode: e.FLIPBOOK_PAGE_MODE.AUTO,
            singlePageMode: e.FLIPBOOK_SINGLE_PAGE_MODE.AUTO,
            flipbookFitPages: !1,
            backgroundColor: "transparent",
            flipbookHardPages: "none",
            openPage: 1,
            annotationClass: "",
            maxTextureSize: 3200,
            minTextureSize: 256,
            rangeChunkSize: 524288,
            disableAutoFetch: !0,
            disableStream: !0,
            disableFontFace: !1,
            icons: {
                altnext: "df-icon-arrow-right1",
                altprev: "df-icon-arrow-left1",
                next: "df-icon-arrow-right1",
                prev: "df-icon-arrow-left1",
                end: "df-icon-last-page",
                start: "df-icon-first-page",
                share: "df-icon-share",
                "outline-open": "df-icon-arrow-right",
                "outline-close": "df-icon-arrow-down",
                help: "df-icon-help",
                more: "df-icon-more",
                download: "df-icon-download",
                zoomin: "df-icon-add-circle",
                zoomout: "df-icon-minus-circle",
                resetzoom: "df-icon-minus-circle",
                fullscreen: "df-icon-fullscreen",
                "fullscreen-off": "df-icon-fit-screen",
                fitscreen: "df-icon-fit-screen",
                thumbnail: "df-icon-grid-view",
                outline: "df-icon-list",
                close: "df-icon-close",
                doublepage: "df-icon-double-page",
                singlepage: "df-icon-file",
                print: "df-icon-print",
                play: "df-icon-play",
                pause: "df-icon-pause",
                search: "df-icon-search",
                sound: "df-icon-volume",
                "sound-off": "df-icon-volume",
                facebook: "df-icon-facebook",
                google: "df-icon-google",
                twitter: "df-icon-twitter",
                whatsapp: "df-icon-whatsapp",
                linkedin: "df-icon-linkedin",
                pinterest: "df-icon-pinterest",
                mail: "df-icon-mail"
            },
            text: {
                toggleSound: "Turn on/off Sound",
                toggleThumbnails: "Toggle Thumbnails",
                toggleOutline: "Toggle Outline/Bookmark",
                previousPage: "Previous Page",
                nextPage: "Next Page",
                toggleFullscreen: "Toggle Fullscreen",
                zoomIn: "Zoom In",
                zoomOut: "Zoom Out",
                resetZoom: "Reset Zoom",
                pageFit: "Fit Page",
                widthFit: "Fit Width",
                toggleHelp: "Toggle Help",
                search: "Search in PDF",
                singlePageMode: "Single Page Mode",
                doublePageMode: "Double Page Mode",
                downloadPDFFile: "Download PDF File",
                gotoFirstPage: "Goto First Page",
                gotoLastPage: "Goto Last Page",
                print: "Print",
                play: "Start AutoPlay",
                pause: "Pause AutoPlay",
                share: "Share",
                close: "Close",
                mailSubject: "Check out this FlipBook",
                mailBody: "Check out this site {{url}}",
                loading: "Loading",
                analyticsEventCategory: "DearPDF",
                analyticsViewerReady: "Document Ready",
                analyticsViewerOpen: "Document Opened",
                analyticsViewerClose: "Document Closed",
                analyticsFirstPageChange: "First Page Changed"
            },
            share: {
                facebook: "https://www.facebook.com/sharer/sharer.php?u={{url}}&t={{mailsubject}}",
                twitter: "https://twitter.com/share?url={{url}}&text={{mailsubject}}",
                mail: void 0,
                whatsapp: "https://api.whatsapp.com/send/?text={{mailsubject}}+{{url}}&type=custom_url&app_absent=0",
                linkedin: "https://www.linkedin.com/shareArticle?url={{url}}&title={{mailsubject}}",
                pinterest: "https://www.pinterest.com/pin/create/button/?url={{url}}&media=&description={{mailsubject}}"
            },
            allControls: "altPrev,pageNumber,altNext,play,outline,thumbnail,zoomIn,zoomOut,zoom,fullScreen,share,download,search,pageMode,startPage,endPage,sound,search,print,more",
            moreControls: "download,pageMode,pageFit,startPage,endPage,sound",
            leftControls: "outline,thumbnail",
            rightControls: "fullScreen,share,download,more",
            hideControls: "",
            hideShareControls: "",
            controlsPosition: e.CONTROLS_POSITION.BOTTOM,
            paddingTop: 20,
            paddingLeft: 15,
            paddingRight: 15,
            paddingBottom: 20,
            enableAnalytics: !1,
            zoomRatio: 2,
            pageScale: e.PAGE_SCALE.PAGE_FIT,
            controlsFloating: !0,
            sideMenuOverlay: !0,
            enableAnnotation: !0,
            enableAutoLinks: !0,
            arrowKeysAction: e.ARROW_KEYS_ACTIONS.NAV,
            clickAction: e.MOUSE_CLICK_ACTIONS.NAV,
            dblClickAction: e.MOUSE_DBL_CLICK_ACTIONS.NONE,
            mouseScrollAction: e.MOUSE_SCROLL_ACTIONS.NONE,
            linkTarget: e.LINK_TARGET.BLANK,
            soundFile: "sound/turn2.mp3",
            imagesLocation: "images",
            imageResourcesPath: "images/pdfjs/",
            popupThumbPlaceholder: "data:image/svg+xml," + escape('<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 210 297"><rect width="210" height="297" style="fill:#f1f2f2"/><circle cx="143" cy="95" r="12" style="fill:#e3e8ed"/><polygon points="131 138 120 149 95 124 34 184 176 185 131 138" style="fill:#e3e8ed"/></svg>'),
            cMapUrl: "js/libs/cmaps/",
            logo: "",
            logoUrl: "",
            sharePrefix: "",
            pageSize: e.FLIPBOOK_PAGE_SIZE.AUTO,
            backgroundImage: "",
            pixelRatio: window.devicePixelRatio || 1,
            spotLightIntensity: .22,
            ambientLightColor: "#fff",
            ambientLightIntensity: .8,
            shadowOpacity: .1,
            slug: void 0,
            headerElementSelector: void 0,
            onReady: function(e) {},
            onPageChanged: function(e) {},
            beforePageChanged: function(e) {},
            onCreate: function(e) {},
            onCreateUI: function(e) {},
            onFlip: function(e) {},
            beforeFlip: function(e) {},
            autoPDFLinktoViewer: !1,
            autoLightBoxFullscreen: !1,
            thumbLayout: "book-title-hover",
            cleanupAfterRender: !0,
            canvasWillReadFrequently: !0,
            providerType: "pdf",
            loadMoreCount: -1,
            autoPlay: !1,
            autoPlayDuration: 1e3,
            autoPlayStart: !1,
            popupBackGroundColor: "#eee",
            mockupMode: !1,
            pdfVersion: "default"
        },
        e.defaults = {},
        e.jQuery.extend(!0, e.defaults, e._defaults),
        e.viewers = {},
        e.providers = {},
        e.openFileOptions = {},
        e.executeCallback = function() {}
        ;
        var n, o, a = e, r = e.jQuery, s = "WebKitCSSMatrix"in window || document.body && "MozPerspective"in document.body.style, l = "onmousedown"in window, u = a.utils = {
            mouseEvents: l ? {
                type: "mouse",
                start: "mousedown",
                move: "mousemove",
                end: "mouseup"
            } : {
                type: "touch",
                start: "touchstart",
                move: "touchmove",
                end: "touchend"
            },
            html: {
                div: "<div></div>",
                a: "<a>",
                input: "<input type='text'/>",
                select: "<select></select>"
            },
            getSharePrefix: function() {
                return u.getSharePrefixes()[0]
            },
            getSharePrefixes: function() {
                return (a.defaults.sharePrefix + ",dflip-,flipbook-,dearflip-,dearpdf-").split(",").map((function(e) {
                    return e.trim()
                }
                ))
            },
            toRad: function(e) {
                return e * Math.PI / 180
            },
            toDeg: function(e) {
                return 180 * e / Math.PI
            },
            ifdef: function(e) {
                return null == e ? arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null : e
            },
            createBtn: function(e, t, i) {
                var n = r(u.html.div, {
                    class: "df-ui-btn df-ui-" + e,
                    title: i,
                    html: void 0 !== i ? "<span>" + i + "</span>" : ""
                });
                return void 0 !== t && t.indexOf("<svg") > -1 ? n.html(t.replace("<svg", '<svg xmlns="http://www.w3.org/2000/svg" ')) : n.addClass(t),
                n
            },
            transition: function(e, t) {
                return e ? t / 1e3 + "s ease-out" : "0s none"
            },
            display: function(e) {
                return e ? "block" : "none"
            },
            resetTranslate: function() {
                return u.translateStr(0, 0)
            },
            bgImage: function(e) {
                return null == e || "blank" === e ? "" : ' url("' + e + '")'
            },
            translateStr: function(e, t) {
                return s ? " translate3d(" + e + "px," + t + "px, 0px) " : " translate(" + e + "px, " + t + "px) "
            },
            httpsCorrection: function(e) {
                try {
                    if (null == e)
                        return null;
                    if ("string" != typeof e)
                        return e;
                    var t = window.location;
                    if (t.href.split(".")[0] === e.split(".")[0])
                        return e;
                    e.split("://")[1].split("/")[0].replace("www.", "") === t.hostname.replace("www.", "") && e.indexOf(t.hostname.replace("www.", "")) > -1 && (t.href.indexOf("https://") > -1 ? e = e.replace("http://", "https://") : t.href.indexOf("http://") > -1 && (e = e.replace("https://", "http://")),
                    t.href.indexOf("://www.") > -1 && -1 === e.indexOf("://www.") && (e = e.replace("://", "://www.")),
                    -1 === t.href.indexOf("://www.") && e.indexOf("://www.") > -1 && (e = e.replace("://www.", "://")))
                } catch (t) {
                    console.log("Skipping URL correction: " + e)
                }
                return e
            },
            rotateStr: function(e) {
                return " rotateZ(" + e + "deg) "
            },
            lowerPowerOfTwo: function(e) {
                return Math.pow(2, Math.floor(Math.log(e) / Math.LN2))
            },
            nearestPowerOfTwo: function(e, t) {
                return Math.min(t || 2048, Math.pow(2, Math.ceil(Math.log(e) / Math.LN2)))
            },
            getFullscreenElement: function() {
                return document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement
            },
            hasFullscreenEnabled: function() {
                return document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled
            },
            fixMouseEvent: function(e) {
                if (e) {
                    var t = e.originalEvent || e;
                    if (t.changedTouches && t.changedTouches.length > 0) {
                        var i = r.event.fix(e)
                          , n = t.changedTouches[0];
                        return i.clientX = n.clientX,
                        i.clientY = n.clientY,
                        i.pageX = n.pageX,
                        i.touches = t.touches,
                        i.pageY = n.pageY,
                        i.movementX = n.movementX,
                        i.movementY = n.movementY,
                        i
                    }
                    return e
                }
                return e
            },
            limitAt: function(e, t, i) {
                return e < t ? t : e > i ? i : e
            },
            distOrigin: function(e, t) {
                return u.distPoints(0, 0, e, t)
            },
            distPoints: function(e, t, i, n) {
                return Math.sqrt(Math.pow(i - e, 2) + Math.pow(n - t, 2))
            },
            angleByDistance: function(e, t) {
                var i = t / 2
                  , n = u.limitAt(e, 0, t);
                return n < i ? u.toDeg(Math.asin(n / i)) : 90 + u.toDeg(Math.asin((n - i) / i))
            },
            calculateScale: function(e, t) {
                var i = u.distPoints(e[0].x, e[0].y, e[1].x, e[1].y);
                return u.distPoints(t[0].x, t[0].y, t[1].x, t[1].y) / i
            },
            getVectorAvg: function(e) {
                return {
                    x: e.map((function(e) {
                        return e.x
                    }
                    )).reduce(u.sum) / e.length,
                    y: e.map((function(e) {
                        return e.y
                    }
                    )).reduce(u.sum) / e.length
                }
            },
            sum: function(e, t) {
                return e + t
            },
            getTouches: function(e, t) {
                return t = t || {
                    left: 0,
                    top: 0
                },
                Array.prototype.slice.call(e.touches).map((function(e) {
                    return {
                        x: e.pageX - t.left,
                        y: e.pageY - t.top
                    }
                }
                ))
            },
            getScriptCallbacks: [],
            getScript: function(e, t, i, n) {
                var o, a = u.getScriptCallbacks[e];
                function s() {
                    o.removeEventListener("load", l, !1),
                    o.removeEventListener("readystatechange", l, !1),
                    o.removeEventListener("complete", l, !1),
                    o.removeEventListener("error", h, !1),
                    o.onload = o.onreadystatechange = null,
                    o = null,
                    o = null
                }
                function l(e, t) {
                    if (null != o && (t || !o.readyState || /loaded|complete/.test(o.readyState))) {
                        if (!t) {
                            for (var n = 0; n < a.length; n++)
                                a[n] && a[n](),
                                a[n] = null;
                            i = null
                        }
                        s()
                    }
                }
                function h() {
                    i(),
                    s(),
                    i = null
                }
                if (0 === r("script[src='" + e + "']").length) {
                    (a = u.getScriptCallbacks[e] = []).push(t),
                    o = document.createElement("script");
                    var p = document.body.getElementsByTagName("script")[0];
                    o.async = !0,
                    o.setAttribute("data-cfasync", "false"),
                    !0 === n && o.setAttribute("type", "module"),
                    null != p ? (p.parentNode.insertBefore(o, p),
                    p = null) : document.body.appendChild(o),
                    o.addEventListener("load", l, !1),
                    o.addEventListener("readystatechange", l, !1),
                    o.addEventListener("complete", l, !1),
                    i && o.addEventListener("error", h, !1),
                    o.src = e + ("MS" === u.prefix.dom ? "?" + Math.random() : "")
                } else
                    a.push(t)
            },
            detectScriptLocation: function() {
                if (void 0 === window[e.locationVar])
                    r("script").each((function() {
                        var t = r(this)[0].src;
                        if ((t.indexOf("/" + e.locationFile + ".js") > -1 || t.indexOf("/" + e.locationFile + ".min.js") > -1 || t.indexOf("js/" + e.locationFile + ".") > -1) && (t.indexOf("https://") > -1 || t.indexOf("http://") > -1)) {
                            var i = t.split("/");
                            window[e.locationVar] = i.slice(0, -2).join("/")
                        }
                    }
                    ));
                else if (-1 == window[e.locationVar].indexOf(":")) {
                    var t = document.createElement("a");
                    t.href = window[e.locationVar],
                    window[e.locationVar] = t.href,
                    t = null
                }
                void 0 !== window[e.locationVar] && window[e.locationVar].length > 2 && "/" !== window[e.locationVar].slice(-1) && (window.window[e.locationVar] += "/")
            },
            disposeObject: function(e) {
                return e && e.dispose && e.dispose(),
                e = null
            },
            log: function() {
                var e;
                !0 === a.defaults.enableDebugLog && window.console && (e = console).log.apply(e, arguments)
            },
            color: {
                getBrightness: function(e) {
                    var t = e.replace("#", "").match(/.{1,2}/g).map((function(e) {
                        return parseInt(e, 16)
                    }
                    ));
                    return .299 * t[0] + .587 * t[1] + .114 * t[2]
                },
                isLight: function(e) {
                    return !u.color.isDark(e)
                },
                isDark: function(e) {
                    return u.color.getBrightness(e) < 128
                }
            },
            isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
            isIOS: /(iPad|iPhone|iPod)/g.test(navigator.userAgent),
            isIPad: "iPad" === navigator.platform || void 0 !== navigator.maxTouchPoints && navigator.maxTouchPoints > 2 && /Mac/.test(navigator.platform),
            isMac: navigator.platform.toUpperCase().indexOf("MAC") >= 0,
            isSafari: /constructor/i.test(window.HTMLElement) || "[object SafariRemoteNotification]" === (!window.safari || window.safari.pushNotification).toString(),
            isIEUnsupported: !!navigator.userAgent.match(/(MSIE|Trident)/),
            isSafariWindows: function() {
                return !u.isMac && u.isSafari
            },
            hasWebgl: function() {
                try {
                    var e = document.createElement("canvas");
                    return !(!window.WebGLRenderingContext || !e.getContext("webgl") && !e.getContext("experimental-webgl"))
                } catch (e) {
                    return !1
                }
            }(),
            hasES2022: void 0 !== Array.prototype.at,
            canSupport3D: function() {
                var e = !0;
                try {
                    if (0 == u.hasWebgl)
                        e = !1,
                        console.log("Proper Support for Canvas webgl 3D not detected!");
                    else if (0 == u.hasES2022)
                        e = !1,
                        console.log("Proper Support for 3D not extpected in older browser!");
                    else if (-1 !== navigator.userAgent.indexOf("MSIE") || navigator.appVersion.indexOf("Trident/") > 0)
                        e = !1,
                        console.log("Proper Support for 3D not detected for IE!");
                    else if (u.isSafariWindows())
                        e = !1,
                        console.log("Proper Support for 3D not detected for Safari!");
                    else {
                        var t = navigator.userAgent.toString().toLowerCase().match(/android\s([0-9\.]*)/i);
                        (t = t ? t[1] : void 0) && (t = parseInt(t, 10),
                        !isNaN(t) && t < 9 && (e = !1,
                        console.log("Proper Support for 3D not detected for Android below 9.0!")))
                    }
                } catch (e) {}
                return e
            },
            prefix: (n = window.getComputedStyle(document.documentElement, ""),
            o = Array.prototype.slice.call(n).join("").match(/-(moz|webkit|ms)-/)[1],
            {
                dom: "WebKit|Moz|MS".match(new RegExp("(" + o + ")","i"))[1],
                lowercase: o,
                css: "-" + o + "-",
                js: o[0].toUpperCase() + o.substr(1)
            }),
            scrollIntoView: function(e, t, i) {
                (t = t || e.parentNode).scrollTop = e.offsetTop + (!1 === i ? e.offsetHeight - t.offsetHeight : 0),
                t.scrollLeft = e.offsetLeft - t.offsetLeft
            },
            getVisibleElements: function(e) {
                var t = e.container
                  , i = e.elements
                  , n = e.visible || []
                  , o = t.scrollTop
                  , a = o + t.clientHeight;
                if (0 == a)
                    return n;
                var r = 0
                  , s = i.length - 1
                  , l = i[r]
                  , u = l.offsetTop + l.clientTop + l.clientHeight;
                if (u < o)
                    for (; r < s; ) {
                        var h = r + s >> 1;
                        (u = (l = i[h]).offsetTop + l.clientTop + l.clientHeight) > o ? s = h : r = h + 1
                    }
                for (var p = r; p < i.length; p++) {
                    if (!((l = i[p]).offsetTop + l.clientTop <= a))
                        break;
                    n.push(p + 1)
                }
                return n
            },
            getMouseDelta: function(e) {
                var t = 0;
                return null != e.wheelDelta ? t = e.wheelDelta : null != e.detail && (t = -e.detail),
                t
            },
            pan: function(e, t) {
                var i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2]
                  , n = e.startPoint
                  , o = e.app.zoomValue
                  , a = e.left + (!0 === i ? 0 : t.raw.x - n.raw.x)
                  , r = e.top + (!0 === i ? 0 : t.raw.y - n.raw.y);
                e.left = Math.ceil(u.limitAt(a, -e.shiftWidth, e.shiftWidth)),
                e.top = Math.ceil(u.limitAt(r, -e.shiftHeight, e.shiftHeight)),
                1 === o && (e.left = 0,
                e.top = 0),
                !1 === i && (e.startPoint = t)
            }
        };
        u.isChromeExtension = function() {
            return 0 === window.location.href.indexOf("chrome-extension://")
        }
        ;
        var h = /\x00+/g
          , p = /[\x01-\x1F]/g;
        u.removeNullCharacters = function(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
            return "string" != typeof e ? (warn("The argument for removeNullCharacters must be a string."),
            e) : (t && (e = e.replace(p, " ")),
            e.replace(h, ""))
        }
        ,
        e.hashFocusBookFound = !1,
        u.detectHash = function() {
            e.preParseHash = window.location.hash;
            var t = u.getSharePrefixes();
            -1 == t.indexOf("") && t.push(""),
            Array.prototype.forEach.call(t, (function(t) {
                var i = e.preParseHash;
                if (i && i.indexOf(t) >= 0 && !1 === e.hashFocusBookFound) {
                    t.length > 0 && (i = i.split(t)[1]);
                    var n = i.split("/")[0].replace("#", "");
                    if (n.length > 0) {
                        var o, a = i.split("/")[1];
                        if (null != a && (a = a.split("/")[0]),
                        0 === (o = r("[data-df-slug=" + n + "]")).length && (o = r("[data-slug=" + n + "]")),
                        0 === o.length && (o = r("#df-" + n + ",#" + n)),
                        0 === o.length && (o = r("[data-_slug=" + n + "]")),
                        o.length > 0 && o.is("._df_thumb,._df_button,._df_custom,._df_link,._df_book,.df-element,.dp-element")) {
                            o = r(o[0]),
                            e.hashFocusBookFound = !0,
                            a = parseInt(a, 10),
                            u.focusHash(o);
                            var s = e.activeLightBox && e.activeLightBox.app || o.data("df-app");
                            if (null != s)
                                return s.gotoPage(a),
                                s.hashNavigationEnabled = !0,
                                u.focusHash(s.element),
                                !1;
                            null != a && o.attr("data-hash-page", a),
                            o.addClass("df-hash-focused", !0),
                            (null != o.data("lightbox") || null != o.data("df-lightbox") || null != o.attr("href") && o.attr("href").indexOf(".pdf") > -1) && o.trigger("click")
                        }
                    }
                }
            }
            ))
        }
        ,
        u.focusHash = function(e) {
            var t, i;
            null === (t = (i = e[0]).scrollIntoView) || void 0 === t || t.call(i, {
                behavior: "smooth",
                block: "nearest",
                inline: "nearest"
            })
        }
        ,
        u.contain = function(e, t, i, n) {
            var o = Math.min(i / e, n / t);
            return {
                width: e * o,
                height: t * o
            }
        }
        ,
        u.containUnStretched = function(e, t, i, n) {
            var o = Math.min(1, i / e, n / t);
            return {
                width: e * o,
                height: t * o
            }
        }
        ,
        u.fallbackOptions = function(e) {
            return void 0 === e.share.mail && (e.share.mail = "mailto:?subject=" + e.text.mailSubject + "&body=" + e.text.mailBody),
            e.openPage && (e.openPage = parseInt(e.openPage, 10)),
            e
        }
        ;
        u.getOptions = function(e) {
            null == (e = r(e)).data("df-option") & null == e.data("option") && e.data("df-option", "option_" + e.attr("id")),
            void 0 !== e.attr("source") && e.data("df-source", e.attr("source"));
            var i = e.data("df-option") || e.data("option")
              , n = void 0;
            n = "object" === t(i) ? i : null == i || "" === i || null == window[i] ? {} : window[i];
            var o = function(e) {
                var t = {}
                  , i = {
                    id: "",
                    thumb: "",
                    openPage: "data-hash-page,df-page,data-df-page,data-page,page",
                    target: "",
                    height: "",
                    showDownloadControl: "data-download",
                    source: "pdf-source,df-source,source",
                    is3D: "webgl,is3d",
                    viewerType: "viewertype,viewer-type",
                    pagemode: ""
                };
                for (var n in i)
                    for (var o = (n + "," + i[n]).split(","), a = 0; a < o.length; a++) {
                        var r = o[a];
                        if ("" !== r) {
                            var s = e.data(r);
                            if (null !== s && "" != s && null != s) {
                                t[n] = s;
                                break
                            }
                            if (null !== (s = e.attr(r)) && "" != s && null != s) {
                                t[n] = s;
                                break
                            }
                        }
                    }
                return e.removeAttr("data-hash-page"),
                t
            }(e);
            return n = r.extend(!0, {}, n, o)
        }
        ,
        u.isTrue = function(e) {
            return "true" === e || !0 === e
        }
        ,
        u.parseInt = function(e) {
            return parseInt(e, 10)
        }
        ,
        u.parseFloat = function(e) {
            return parseFloat(e)
        }
        ,
        u.parseIntIfExists = function(e) {
            return void 0 !== e && (e = parseInt(e, 10)),
            e
        }
        ,
        u.parseFloatIfExists = function(e) {
            return void 0 !== e && (e = parseFloat(e)),
            e
        }
        ,
        u.parseBoolIfExists = function(e) {
            return void 0 !== e && (e = u.isTrue(e)),
            e
        }
        ,
        u.sanitizeOptions = function(e) {
            if (e.showDownloadControl = u.parseBoolIfExists(e.showDownloadControl),
            e.showSearchControl = u.parseBoolIfExists(e.showSearchControl),
            e.showPrintControl = u.parseBoolIfExists(e.showPrintControl),
            e.flipbook3DTiltAngleLeft = u.parseIntIfExists(e.flipbook3DTiltAngleLeft),
            e.flipbook3DTiltAngleUp = u.parseIntIfExists(e.flipbook3DTiltAngleUp),
            e.paddingLeft = u.parseIntIfExists(e.paddingLeft),
            e.paddingRight = u.parseIntIfExists(e.paddingRight),
            e.paddingTop = u.parseIntIfExists(e.paddingTop),
            e.paddingBottom = u.parseIntIfExists(e.paddingBottom),
            e.duration = u.parseIntIfExists(e.duration),
            e.rangeChunkSize = u.parseIntIfExists(e.rangeChunkSize),
            e.maxTextureSize = u.parseIntIfExists(e.maxTextureSize),
            e.linkTarget = u.parseIntIfExists(e.linkTarget),
            e.zoomRatio = u.parseFloatIfExists(e.zoomRatio),
            e.enableAnalytics = u.parseBoolIfExists(e.enableAnalytics),
            e.autoPlay = u.parseBoolIfExists(e.autoPlay),
            e.autoPlayStart = u.parseBoolIfExists(e.autoPlayStart),
            e.autoPlayDuration = u.parseIntIfExists(e.autoPlayDuration),
            void 0 !== e.loadMoreCount && (e.loadMoreCount = u.parseInt(e.loadMoreCount),
            (isNaN(e.loadMoreCount) || 0 === e.loadMoreCount) && (e.loadMoreCount = -1)),
            null != e.source && (Array === e.source.constructor || Array.isArray(e.source) || e.source instanceof Array))
                for (var t = 0; t < e.source.length; t++)
                    e.source[t] = u.httpsCorrection(e.source[t]);
            else
                e.source = u.httpsCorrection(e.source);
            return e
        }
        ,
        u.finalizeOptions = function(e) {
            return e
        }
        ,
        u.urlify = function(e) {
            for (var t, i, n = /[a-zA-Z0-9][^\s,]{3,}\.[^\s,]+[a-zA-Z0-9]/gi, o = []; t = n.exec(e); ) {
                var a = t[0];
                1 == (a.match(/@/g) || []).length ? a.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+/gi) && o.push({
                    index: t.index,
                    length: a.length,
                    text: a
                }) : a.match(/[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b[-a-zA-Z0-9@:%_\+.~#?&//=]*/g) && (0 !== (i = a.toLowerCase()).indexOf("http:") && 0 !== i.indexOf("https:") && 0 !== i.indexOf("www.") || o.push({
                    index: t.index,
                    length: a.length,
                    text: a
                }))
            }
            return o
        }
        ,
        u.oldurlify = function(e) {
            return e.replace(/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[.\!\/\\w]*))?)/g, (function(e, t, i, n, o) {
                var a = e = e.toLowerCase();
                if (e.indexOf(":") > 0 && -1 === e.indexOf("http:") && -1 === e.indexOf("https:"))
                    return u.log("AutoLink Rejected: " + a + " for " + e),
                    e;
                if (0 === e.indexOf("www."))
                    a = "http://" + e;
                else if (0 === e.indexOf("http://") || 0 === e.indexOf("https://"))
                    ;
                else if (0 === e.indexOf("mailto:"))
                    ;
                else if (e.indexOf("@") > 0) {
                    a = "mailto:" + e;
                    if (null === e.match(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/))
                        return u.log("AutoLink Rejected: " + a + " for " + e),
                        e
                }
                return u.log("AutoLink: " + a + " for " + e),
                '<a href="' + a + '" class="df-autolink" target="_blank">' + e + "</a>"
            }
            ))
        }
        ,
        u.supportsPassive = !1;
        try {
            var c = Object.defineProperty({}, "passive", {
                get: function() {
                    u.supportsPassive = !0
                }
            });
            window.addEventListener("testPassive", null, c),
            window.removeEventListener("testPassive", null, c)
        } catch (e) {}
        e.parseCSSElements = function() {
            r(".dvcss").each((function() {
                var e, t = r(this), i = function(e) {
                    for (var t, i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "dvcss_e_", n = e.classList, o = 0; o < n.length; o++)
                        if (0 === (t = n[o]).indexOf(i))
                            return t;
                    return null
                }(t[0]);
                t.removeClass(i).removeClass("dvcss"),
                i = i.replace("dvcss_e_", "");
                try {
                    e = JSON.parse(atob(i))
                } catch (e) {}
                if (e) {
                    var n = "df_option_" + e.id;
                    window[n] = r.extend(!0, {}, window[n], e),
                    t.addClass("df-element"),
                    "none" !== e.lightbox && (t.attr("data-df-lightbox", void 0 === e.lightbox ? "custom" : e.lightbox),
                    "thumb" == e.lightbox && t.attr("data-df-thumb", e.pdfThumb),
                    e.thumbLayout && t.attr("data-df-thumb-layout", e.thumbLayout),
                    e.apl && t.attr("apl", e.apl)),
                    t.data("df-option", n),
                    t.attr("data-df-slug", e.slug),
                    t.attr("id", "df_" + e.id)
                }
            }
            ))
        }
        ,
        e.parseThumbs = function(t) {
            t.element.html(""),
            null != t.thumbURL && "" != t.thumbURL.toString().trim() || (t.element.addClass("df-thumb-not-found"),
            t.thumbURL = e.defaults.popupThumbPlaceholder);
            var i = r("<span class='df-book-title'>").html(t.title)
              , n = r("<div class='df-book-wrapper'>").appendTo(t.element);
            n.append(r("<div class='df-book-page1'>")),
            n.append(r("<div class='df-book-page2'>"));
            var o = r("<div class='df-book-cover'>").append(i).appendTo(n)
              , a = r('<img width="210px" height="297px" class="df-lazy" alt="' + t.title + '"/>');
            a.attr("data-src", t.thumbURL),
            a.attr("src", e.defaults.popupThumbPlaceholder),
            o.prepend(a),
            e.addLazyElement(a[0]),
            !0 === e.defaults.displayLightboxPlayIcon && o.addClass("df-icon-play-popup"),
            "book-title-top" === t.thumbLayout ? i.prependTo(t.element) : "book-title-bottom" !== t.thumbLayout && "cover-title" !== t.thumbLayout || (t.hasShelf ? t.thumbLayout = "book-title-fixed" : i.appendTo(t.element),
            !0 === e.defaults.displayLightboxPlayIcon && (t.element.removeClass("df-icon-play-popup"),
            n.addClass("df-icon-play-popup"))),
            t.element.addClass("df-tl-" + t.thumbLayout),
            t.element.attr("title", t.title)
        }
        ,
        e.initId = 10,
        e.embeds = [],
        e.removeEmbeds = [],
        e.removeEmbedsLimit = u.isMobile ? 1 : 2,
        e.parseNormalElements = function() {
            r(".df-posts").each((function() {
                if (!1 !== e.defaults.loadMoreCount && -1 !== e.defaults.loadMoreCount) {
                    var t = r(this);
                    if ("true" !== t.data("df-parsed")) {
                        t.data("df-parsed", "true"),
                        t.attr("df-parsed", "true");
                        var i = 0
                          , n = t.find(".df-element")
                          , o = n.length;
                        n.each((function() {
                            ++i > e.defaults.loadMoreCount && r(this).attr("skip-parse", "true")
                        }
                        )),
                        o > e.defaults.loadMoreCount && t.append("<div class='df-load-more-button-wrapper'><div class='df-load-more-button'>Load More..</div></div>")
                    }
                }
            }
            )),
            e.triggerId = 10,
            r(".df-element").each((function() {
                var t = r(this);
                if ("true" !== t.attr("skip-parse") && "true" !== t.data("df-parsed")) {
                    t.data("df-parsed", "true"),
                    t.attr("df-parsed", "true");
                    var i = t.data("df-lightbox") || t.data("lightbox");
                    if (void 0 === i)
                        t.addClass("df-lazy-embed"),
                        e.addLazyElement(t[0]);
                    else if (t.addClass("df-popup-" + i),
                    "thumb" === i) {
                        var n = t.data("df-thumb-layout") || e.defaults.thumbLayout
                          , o = u.httpsCorrection(t.data("df-thumb"));
                        t.removeAttr("data-thumb").removeAttr("data-thumb-layout");
                        var a = t.html().trim();
                        void 0 !== a && "" !== a || (a = "Click to Open");
                        var s = t.parent().hasClass("df-has-shelf");
                        e.parseThumbs({
                            element: t,
                            thumbURL: o,
                            title: a,
                            thumbLayout: n,
                            hasShelf: s
                        }),
                        s && t.after(r("<df-post-shelf>"))
                    } else
                        "button" === i && e.defaults.buttonClass && t.addClass(e.defaults.buttonClass);
                    var l = t.attr("data-trigger");
                    null != l && l.length > 1 && (l = l.split(","),
                    e.triggerId++,
                    l.forEach((function(i) {
                        t.attr("df-trigger-id", e.triggerId),
                        r("#" + i).addClass("df-trigger").attr("df-trigger", e.triggerId)
                    }
                    ))),
                    t.data("df-editlink") && t.append('<a class="df-edit-link" href="' + t.data("df-editlink") + '" >Edit Book</a>')
                }
            }
            )),
            e.handleLazy = function() {
                var t;
                if (e.removeEmbeds.length > e.removeEmbedsLimit && (t = e.removeEmbeds.shift())) {
                    var i = r("[initID='" + t + "']");
                    if (i.length > 0) {
                        var n = i.data("df-app");
                        n && (i.attr("data-df-page", n.currentPageNumber),
                        u.log("Removed app id " + t),
                        n.dispose(),
                        n = null)
                    }
                }
                if (t = e.embeds.shift()) {
                    var o = r("[initID='" + t + "']");
                    if (o.length > 0)
                        if (o.is("img"))
                            o.hasClass("df-lazy") ? (o.attr("src", o.attr("data-src")),
                            o.removeAttr("data-src"),
                            o.removeClass("df-lazy"),
                            e.lazyObserver.unobserve(o[0]),
                            e.handleLazy()) : (u.log("Prevent this"),
                            e.handleLazy());
                        else {
                            var a = o.data("df-app");
                            null == a ? o.dearviewer() : a.softInit(),
                            u.log("Created app id " + t)
                        }
                }
                e.removeEmbeds.length <= e.removeEmbedsLimit && 0 == e.embeds.length && (e.checkRequestQueue = null)
            }
        }
        ,
        e.lazyObserver = {
            observe: function(e) {
                (e = r(e)).is("img") ? e.hasClass("df-lazy") && (e.attr("src", e.attr("data-src")),
                e.removeAttr("data-src"),
                e.removeClass("df-lazy")) : e.dearviewer()
            }
        },
        "function" == typeof IntersectionObserver && (e.lazyObserver = new IntersectionObserver((function(t, i) {
            t.forEach((function(t) {
                var i, n = r(t.target), o = n.attr("initID");
                t.isIntersecting ? (n.attr("initID") || (n.attr("initID", e.initId),
                o = e.initId.toString(),
                e.initId++),
                (i = e.removeEmbeds.indexOf(o)) > -1 ? (e.removeEmbeds.splice(i, 1),
                u.log("Removed id " + o + "from Removal list")) : -1 == (i = e.embeds.indexOf(o)) && (e.embeds.push(o),
                u.log("Added id " + o + "to Add list"))) : o && ((i = e.embeds.indexOf(o)) > -1 ? (e.embeds.splice(i, 1),
                u.log("Removed id " + o + " from Add list")) : -1 == (i = e.removeEmbeds.indexOf(o)) && (e.removeEmbeds.push(o),
                u.log("Added id " + o + " to Removal list"))),
                d = 0,
                (e.removeEmbeds.length > e.removeEmbedsLimit || e.embeds.length > 0) && null == e.checkRequestQueue && (e.checkRequestQueue = function() {
                    d++,
                    e.checkRequestQueue && requestAnimationFrame((function() {
                        e && e.checkRequestQueue && e.checkRequestQueue()
                    }
                    )),
                    d > 20 && (d = 0,
                    e.handleLazy())
                }
                ,
                e.checkRequestQueue())
            }
            ))
        }
        )));
        var d = 0;
        function f(e) {
            return f = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            f(e)
        }
        function g(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== f(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== f(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === f(a) ? a : String(a)), n)
            }
            var o, a
        }
        e.addLazyElement = function(t) {
            e.lazyObserver.observe(t)
        }
        ,
        e.parseElements = u.parseElements = function() {
            e.parseCSSElements(),
            e.parseNormalElements()
        }
        ,
        e.initUtils = function() {
            u.detectScriptLocation();
            var t = r("body");
            (u.isSafari || u.isIOS) && t.addClass("df-ios"),
            t.on("click", (function() {}
            )),
            t.on("click", ".df-posts .df-load-more-button", (function() {
                var t = r(this).closest(".df-posts");
                if (t.length > 0) {
                    var i = 0;
                    t.find(".df-element").each((function() {
                        var t = r(this);
                        "true" === t.attr("skip-parse") && (i < e.defaults.loadMoreCount && t.removeAttr("skip-parse"),
                        i++)
                    }
                    )),
                    e.parseNormalElements()
                }
            }
            )),
            e.defaults.shelfImage && "" != e.defaults.shelfImage && t.append("<style>.df-has-shelf df-post-shelf:before, .df-has-shelf df-post-shelf:after{background-image: url('" + e.defaults.shelfImage + "');}</style>")
        }
        ;
        var v = e
          , m = e.utils
          , y = function() {
            function t(e, i) {
                !function(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }(this, t),
                this.pages = [],
                this.app = i,
                this.parentElement = this.app.viewerContainer;
                var n = "df-viewer " + (e.viewerClass || "");
                this.element = jQuery("<div>", {
                    class: n
                }),
                this.parentElement.append(this.element),
                this.wrapper = jQuery("<div>", {
                    class: "df-viewer-wrapper"
                }),
                this.element.append(this.wrapper),
                this.oldBasePageNumber = 0,
                this.pages = [],
                this.minZoom = 1,
                this.maxZoom = 4,
                this.swipeThreshold = 20,
                this.stageDOM = null,
                this.events = {},
                this.arrowKeysAction = e.arrowKeysAction,
                this.clickAction = e.clickAction,
                this.scrollAction = e.scrollAction,
                this.dblClickAction = e.dblClickAction,
                this.pageBuffer = [],
                this.pageBufferSize = 10
            }
            var i, n, o;
            return i = t,
            n = [{
                key: "init",
                value: function() {}
            }, {
                key: "softDispose",
                value: function() {}
            }, {
                key: "updateBuffer",
                value: function(e) {}
            }, {
                key: "pageResetCallback",
                value: function(e) {}
            }, {
                key: "initCustomControls",
                value: function() {}
            }, {
                key: "_getInnerWidth",
                value: function() {
                    return this.app.dimensions.containerWidth - this.app.dimensions.padding.width - this.app.dimensions.offset.width
                }
            }, {
                key: "_getInnerHeight",
                value: function() {
                    return this.app.dimensions.maxHeight - this.app.dimensions.padding.height
                }
            }, {
                key: "_getOuterHeight",
                value: function(e) {
                    return e
                }
            }, {
                key: "dispose",
                value: function() {
                    this.stageDOM && (this.stageDOM.removeEventListener("mousemove", this.events.mousemove, !1),
                    this.stageDOM.removeEventListener("mousedown", this.events.mousedown, !1),
                    this.stageDOM.removeEventListener("mouseup", this.events.mouseup, !1),
                    this.stageDOM.removeEventListener("touchmove", this.events.mousemove, !1),
                    this.stageDOM.removeEventListener("touchstart", this.events.mousedown, !1),
                    this.stageDOM.removeEventListener("touchend", this.events.mouseup, !1),
                    this.stageDOM.removeEventListener("dblclick", this.events.dblclick, !1),
                    this.stageDOM.removeEventListener("scroll", this.events.scroll, !1),
                    this.stageDOM.removeEventListener("mousewheel", this.events.mousewheel, !1),
                    this.stageDOM.removeEventListener("DOMMouseScroll", this.events.mousewheel, !1)),
                    this.events = null,
                    this.stageDOM = null,
                    this.element.remove()
                }
            }, {
                key: "checkDocumentPageSizes",
                value: function() {}
            }, {
                key: "getViewerPageNumber",
                value: function(e) {
                    return e
                }
            }, {
                key: "getDocumentPageNumber",
                value: function(e) {
                    return e
                }
            }, {
                key: "getRenderContext",
                value: function(t, i) {
                    var n = this.app
                      , o = n.provider
                      , a = i.pageNumber
                      , r = m.ifdef(i.textureTarget, e.TEXTURE_TARGET.VIEWER)
                      , s = (n.dimensions.pageFit,
                    o.viewPorts[a])
                      , l = n.viewer.getTextureSize(i)
                      , u = null;
                    if (u = r === e.TEXTURE_TARGET.THUMB ? n.thumbSize : Math.floor(l.height),
                    void 0 === o.getCache(a, u)) {
                        var h = l.height / s.height
                          , p = document.createElement("canvas")
                          , c = this.filterViewPort(t.getViewport({
                            scale: h,
                            rotation: t._pageInfo.rotate + n.options.pageRotation
                        }), a);
                        r === e.TEXTURE_TARGET.THUMB && (h = c.width / c.height > 180 / n.thumbSize ? 180 * h / c.width : h * n.thumbSize / c.height,
                        c = this.filterViewPort(t.getViewport({
                            scale: h,
                            rotation: t._pageInfo.rotate + n.options.pageRotation
                        }), a)),
                        p.height = Math.floor(c.height),
                        p.width = Math.floor(c.width);
                        var d = Math.abs(p.width - l.width) / l.width * 100;
                        return d > .001 && d < 2 && (p.width = Math.floor(l.width),
                        p.height = Math.floor(l.height)),
                        n.viewer.filterViewPortCanvas(c, p, a),
                        {
                            canvas: p,
                            canvasContext: p.getContext("2d", {
                                willReadFrequently: !0 === e.defaults.canvasWillReadFrequently
                            }),
                            viewport: c
                        }
                    }
                }
            }, {
                key: "filterViewPort",
                value: function(e, t) {
                    return e
                }
            }, {
                key: "getViewPort",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , i = this.app.provider.viewPorts[e];
                    return t ? null != i ? i : this.app.provider.defaultPage.viewPort : i
                }
            }, {
                key: "pagesReady",
                value: function() {}
            }, {
                key: "onReady",
                value: function() {}
            }, {
                key: "filterViewPortCanvas",
                value: function(e) {}
            }, {
                key: "finalizeAnnotations",
                value: function() {}
            }, {
                key: "finalizeTextContent",
                value: function() {}
            }, {
                key: "updateTextContent",
                value: function(e) {
                    null == e && (e = this.getBasePage(e)),
                    this.app.provider.processTextContent(e, this.getTextElement(e, !0))
                }
            }, {
                key: "isActivePage",
                value: function(e) {
                    return e === this.app.currentPageNumber
                }
            }, {
                key: "initEvents",
                value: function() {
                    var e = this
                      , t = e.stageDOM = m.ifdef(e.stageDOM, e.parentElement[0]);
                    if (t) {
                        var i = !1;
                        t.addEventListener("mousemove", e.events.mousemove = e.mouseMove.bind(e), !1),
                        t.addEventListener("mousedown", e.events.mousedown = e.mouseDown.bind(e), !1),
                        t.addEventListener("mouseup", e.events.mouseup = e.mouseUp.bind(e), !1),
                        t.addEventListener("touchmove", e.events.mousemove = e.mouseMove.bind(e), i),
                        t.addEventListener("touchstart", e.events.mousedown = e.mouseDown.bind(e), i),
                        t.addEventListener("touchend", e.events.mouseup = e.mouseUp.bind(e), !1),
                        t.addEventListener("dblclick", e.events.dblclick = e.dblclick.bind(e), !1),
                        t.addEventListener("scroll", e.events.scroll = e.onScroll.bind(e), !1),
                        t.addEventListener("mousewheel", e.events.mousewheel = e.mouseWheel.bind(e), i),
                        t.addEventListener("DOMMouseScroll", e.events.mousewheel = e.mouseWheel.bind(e), !1)
                    }
                    this.startTouches = null,
                    this.lastScale = null,
                    this.startPoint = null
                }
            }, {
                key: "refresh",
                value: function() {}
            }, {
                key: "reset",
                value: function() {}
            }, {
                key: "eventToPoint",
                value: function(e) {
                    var t = {
                        x: e.clientX,
                        y: e.clientY
                    };
                    return t.x = t.x - this.app.viewerContainer[0].getBoundingClientRect().left,
                    t.y = t.y - this.app.viewerContainer[0].getBoundingClientRect().top,
                    {
                        raw: t
                    }
                }
            }, {
                key: "mouseMove",
                value: function(e) {
                    e = m.fixMouseEvent(e),
                    this.pinchMove(e),
                    !0 === this.pinchZoomDirty && e.preventDefault(),
                    this.startPoint && 1 != this.pinchZoomDirty && (this.pan(this.eventToPoint(e)),
                    e.preventDefault())
                }
            }, {
                key: "mouseDown",
                value: function(e) {
                    e = m.fixMouseEvent(e),
                    this.pinchDown(e),
                    this.startPoint = this.eventToPoint(e)
                }
            }, {
                key: "mouseUp",
                value: function(e) {
                    e = m.fixMouseEvent(e);
                    var t = this;
                    !0 === t.pinchZoomDirty && e.preventDefault();
                    var i = t.eventToPoint(e)
                      , n = e.target || e.originalTarget
                      , o = t.startPoint && i.x === t.startPoint.x && i.y === t.startPoint.y && "A" !== n.nodeName;
                    !0 === e.ctrlKey && o && this.zoomOnPoint(i),
                    this.pinchUp(e),
                    this.startPoint = null
                }
            }, {
                key: "pinchDown",
                value: function(e) {}
            }, {
                key: "pinchUp",
                value: function(e) {}
            }, {
                key: "pinchMove",
                value: function(e) {}
            }, {
                key: "updateTemporaryScale",
                value: function() {
                    if (!0 === (arguments.length > 0 && void 0 !== arguments[0] && arguments[0]))
                        this.parentElement[0].style.transform = "none";
                    else if (this.app.viewer.zoomCenter) {
                        var e = this.app.viewer.pinchZoomUpdateScale;
                        this.parentElement[0].style.transformOrigin = this.app.viewer.zoomCenter.x + "px " + this.app.viewer.zoomCenter.y + "px",
                        this.parentElement[0].style.transform = "scale3d(" + e + "," + e + ",1)"
                    }
                }
            }, {
                key: "pan",
                value: function(t) {
                    var i = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
                    this.panRequestStatus = e.REQUEST_STATUS.ON,
                    m.pan(this, t, i)
                }
            }, {
                key: "updatePan",
                value: function() {
                    this.element.css({
                        transform: "translate3d(" + this.left + "px," + this.top + "px,0)"
                    })
                }
            }, {
                key: "dblclick",
                value: function(e) {}
            }, {
                key: "onScroll",
                value: function(e) {}
            }, {
                key: "mouseWheel",
                value: function(t) {
                    var i = this.app
                      , n = m.getMouseDelta(t)
                      , o = !0 === t.ctrlKey
                      , a = i.options.mouseScrollAction === e.MOUSE_SCROLL_ACTIONS.ZOOM && (!0 === i.options.isLightBox || !0 === i.isFullscreen);
                    o || a ? (n > 0 || n < 0) && (t.preventDefault(),
                    i.viewer.zoomCenter = this.eventToPoint(t).raw,
                    i.zoom(n),
                    i.ui.update()) : i.options.mouseScrollAction === e.MOUSE_SCROLL_ACTIONS.NAV && (n > 0 ? i.next() : n < 0 && i.prev())
                }
            }, {
                key: "zoomOnPoint",
                value: function(e) {
                    this.app.viewer.zoomCenter = e.raw,
                    this.app.zoom(1)
                }
            }, {
                key: "getVisiblePages",
                value: function() {
                    return this.visiblePagesCache = [],
                    {
                        main: this.visiblePagesCache,
                        buffer: []
                    }
                }
            }, {
                key: "getBasePage",
                value: function() {
                    return this.app.currentPageNumber
                }
            }, {
                key: "isFirstPage",
                value: function(e) {
                    return void 0 === e && (e = this.app.currentPageNumber),
                    1 === e
                }
            }, {
                key: "isLastPage",
                value: function(e) {
                    return void 0 === e && (e = this.app.currentPageNumber),
                    e === this.app.pageCount
                }
            }, {
                key: "isEdgePage",
                value: function(e) {
                    return void 0 === e && (e = this.app.currentPageNumber),
                    1 === e || e === this.app.pageCount
                }
            }, {
                key: "checkRequestQueue",
                value: function() {
                    var t = e.REQUEST_STATUS;
                    this.panRequestStatus === t.ON && (this.updatePan(),
                    this.panRequestStatus = t.OFF),
                    this.app.viewer.pinchZoomRequestStatus === t.ON && (this.app.viewer.updateTemporaryScale(),
                    this.app.viewer.pinchZoomRequestStatus = t.OFF)
                }
            }, {
                key: "isAnimating",
                value: function() {
                    return !1
                }
            }, {
                key: "updatePendingStatusClass",
                value: function(e) {
                    void 0 === e && (e = this.isAnimating()),
                    this.app.container.toggleClass("df-pending", e)
                }
            }, {
                key: "initPages",
                value: function() {}
            }, {
                key: "resize",
                value: function() {}
            }, {
                key: "determinePageMode",
                value: function() {}
            }, {
                key: "zoom",
                value: function() {}
            }, {
                key: "gotoPageCallBack",
                value: function() {
                    this.requestRefresh()
                }
            }, {
                key: "requestRefresh",
                value: function() {
                    var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    this.app.refreshRequestStatus = !0 === e ? v.REQUEST_STATUS.ON : v.REQUEST_STATUS.OFF
                }
            }, {
                key: "getPageByNumber",
                value: function(e) {
                    var t = this.pages
                      , i = void 0;
                    if (this.app.isValidPage(e))
                        for (var n = 0; n < t.length; n++)
                            if (e === t[n].pageNumber) {
                                i = t[n];
                                break
                            }
                    return i
                }
            }, {
                key: "changeAnnotation",
                value: function() {
                    return !1
                }
            }, {
                key: "getAnnotationElement",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , i = this.getPageByNumber(e);
                    if (void 0 !== i)
                        return void 0 === i.annotationElement && (i.annotationElement = jQuery("<div class='df-link-content'>"),
                        i.contentLayer.append(i.annotationElement)),
                        !0 === t && i.annotationElement.html(""),
                        i.annotationElement[0]
                }
            }, {
                key: "getTextElement",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , i = this.getPageByNumber(e);
                    if (void 0 !== i)
                        return void 0 === i.textElement && (i.textElement = jQuery("<div class='df-text-content'>"),
                        i.contentLayer.append(i.textElement)),
                        !0 === t && (i.textElement.html(""),
                        i.textElement.siblings(".df-auto-link-content").html("")),
                        i.textElement[0]
                }
            }, {
                key: "render",
                value: function() {}
            }, {
                key: "textureLoadedCallback",
                value: function(e) {}
            }, {
                key: "handleZoom",
                value: function() {}
            }, {
                key: "getTextureSize",
                value: function(e) {
                    console.error("Texture calculation missing!")
                }
            }, {
                key: "textureHeightLimit",
                value: function(e) {
                    return m.limitAt(e, 1, this.app.dimensions.maxTextureHeight)
                }
            }, {
                key: "textureWidthLimit",
                value: function(e) {
                    return m.limitAt(e, 1, this.app.dimensions.maxTextureWidth)
                }
            }, {
                key: "setPage",
                value: function(e) {
                    m.log("Set Page detected", e.pageNumber);
                    var t = this.getPageByNumber(e.pageNumber);
                    return !!t && (e.callback = this.textureLoadedCallback.bind(this),
                    t.loadTexture(e),
                    this.updateBuffer(t),
                    !0)
                }
            }, {
                key: "cleanPage",
                value: function(e) {
                    return !0
                }
            }, {
                key: "validatePageChange",
                value: function(e) {
                    return e !== this.app.currentPageNumber
                }
            }, {
                key: "afterControlUpdate",
                value: function() {}
            }, {
                key: "searchPage",
                value: function(e) {
                    return {
                        include: !0,
                        label: this.app.provider.getLabelforPage(e)
                    }
                }
            }],
            n && g(i.prototype, n),
            o && g(i, o),
            Object.defineProperty(i, "prototype", {
                writable: !1
            }),
            t
        }();
        function b(e, t) {
            return b = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            b(e, t)
        }
        function w(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = P(e);
                if (t) {
                    var o = P(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === S(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return function(e) {
                        if (void 0 === e)
                            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                        return e
                    }(e)
                }(this, i)
            }
        }
        function P(e) {
            return P = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            P(e)
        }
        function S(e) {
            return S = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            S(e)
        }
        function C(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function T(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== S(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== S(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === S(a) ? a : String(a)), n)
            }
            var o, a
        }
        function x(e, t, i) {
            return t && T(e.prototype, t),
            i && T(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        var k = e.utils
          , E = function() {
            function e() {
                C(this, e),
                this.textureLoadFallback = "blank",
                this.textureStamp = "-1",
                this.textureLoaded = !1,
                this.texture = "blank",
                this.textureSrc = "blank",
                this.pageNumber = void 0,
                this.contentLayer = jQuery("<div>", {
                    class: "df-page-content"
                })
            }
            return x(e, [{
                key: "reset",
                value: function() {
                    this.resetTexture(),
                    this.resetContent()
                }
            }, {
                key: "resetTexture",
                value: function() {
                    this.textureLoaded = !1,
                    this.textureStamp = "-1",
                    this.loadTexture({
                        texture: this.textureLoadFallback
                    }),
                    this.contentLayer.removeClass("df-content-loaded")
                }
            }, {
                key: "clearTexture",
                value: function() {
                    this.loadTexture({
                        texture: this.textureLoadFallback
                    })
                }
            }, {
                key: "resetContent",
                value: function() {}
            }, {
                key: "loadTexture",
                value: function(e) {}
            }, {
                key: "getTexture",
                value: function() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0]
                      , t = this.textureSrc;
                    return !0 === e && t && t.cloneNode && (t = t.cloneNode()).getContext && t.getContext("2d").drawImage(this.textureSrc, 0, 0),
                    t
                }
            }, {
                key: "setLoading",
                value: function() {}
            }, {
                key: "updateTextureLoadStatus",
                value: function(e) {
                    this.textureLoaded = !0 === e,
                    k.log((!0 === this.textureLoaded ? "Loaded " : "Loading ") + this.textureStamp + " for " + this.pageNumber),
                    this.contentLayer.toggleClass("df-content-loaded", !0 === e),
                    this.setLoading()
                }
            }, {
                key: "changeTexture",
                value: function(e, t) {
                    var i = this
                      , n = e + "|" + t;
                    return i.textureStamp !== n && (k.log("Page " + e + " : texture changed from - " + i.textureStamp + " to " + n),
                    i.textureLoaded = !1,
                    i.textureStamp = n,
                    i.updateTextureLoadStatus(!1),
                    !0)
                }
            }]),
            e
        }()
          , O = function(e) {
            !function(e, t) {
                if ("function" != typeof t && null !== t)
                    throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }),
                Object.defineProperty(e, "prototype", {
                    writable: !1
                }),
                t && b(e, t)
            }(i, e);
            var t = w(i);
            function i(e) {
                var n;
                return C(this, i),
                (n = t.call(this)).canvasMode = null,
                e && e.parentElement && (n.parentElement = e.parentElement),
                n.init(),
                n
            }
            return x(i, [{
                key: "init",
                value: function() {
                    var e = this.element = jQuery("<div>", {
                        class: "df-page"
                    });
                    e[0].appendChild(this.contentLayer[0]),
                    this.texture = new Image,
                    this.parentElement && this.parentElement[0].append(e[0])
                }
            }, {
                key: "resetContent",
                value: function() {
                    void 0 !== this.annotationElement && this.annotationElement.html(""),
                    void 0 !== this.textElement && this.textElement.html("")
                }
            }, {
                key: "setLoading",
                value: function() {
                    this.element.toggleClass("df-loading", !0 !== this.textureLoaded)
                }
            }, {
                key: "loadTexture",
                value: function(e) {
                    var t = this
                      , i = e.texture
                      , n = e.callback;
                    function o() {
                        t.textureSrc = i,
                        t.element.css({
                            backgroundImage: k.bgImage(i)
                        }),
                        t.updateTextureLoadStatus(!0),
                        "function" == typeof n && n(e)
                    }
                    null === t.canvasMode && i && "CANVAS" === i.nodeName && (t.canvasMode = !0),
                    !0 === t.canvasMode ? (t.element.find(">canvas").remove(),
                    i !== t.textureLoadFallback && (t.textureSrc = i,
                    t.element.append(jQuery(i))),
                    t.updateTextureLoadStatus(!0),
                    "function" == typeof n && n(e)) : i === t.textureLoadFallback ? o() : (t.texture.onload = o,
                    t.texture.src = i)
                }
            }, {
                key: "updateCSS",
                value: function(e) {
                    this.element.css(e)
                }
            }, {
                key: "resetCSS",
                value: function() {
                    this.element.css({
                        transform: "",
                        boxShadow: "",
                        display: "block"
                    })
                }
            }]),
            i
        }(E);
        function R(e) {
            return R = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            R(e)
        }
        function L(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== R(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== R(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === R(a) ? a : String(a)), n)
            }
            var o, a
        }
        function N() {
            return N = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = M(e)); )
                        ;
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(arguments.length < 3 ? e : i) : o.value
                }
            }
            ,
            N.apply(this, arguments)
        }
        function I(e, t) {
            return I = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            I(e, t)
        }
        function _(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = M(e);
                if (t) {
                    var o = M(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === R(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return A(e)
                }(this, i)
            }
        }
        function A(e) {
            if (void 0 === e)
                throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }
        function M(e) {
            return M = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            M(e)
        }
        var D = e.utils
          , F = function(t) {
            !function(e, t) {
                if ("function" != typeof t && null !== t)
                    throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }),
                Object.defineProperty(e, "prototype", {
                    writable: !1
                }),
                t && I(e, t)
            }(r, t);
            var i, n, o, a = _(r);
            function r(t, i) {
                var n;
                return function(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }(this, r),
                t.viewerClass = "df-reader",
                i.options.mouseScrollAction = e.MOUSE_SCROLL_ACTIONS.NONE,
                (n = a.call(this, t, i)).app.jumpStep = 1,
                n.minZoom = .25,
                n.stackCount = n.app.pageCount,
                n.app.options.paddingLeft = 0,
                n.app.options.paddingRight = 0,
                n.app.options.paddingTop = 10,
                n.app.options.paddingBottom = !0 === n.app.options.controlsFloating ? 20 : 10,
                n.app.pageScaling = n.app.options.pageScale,
                n.acceptAppMouseEvents = !0,
                n.scrollStatus = e.REQUEST_STATUS.OFF,
                n.deltaPanX = 0,
                n.deltaPanY = 0,
                i._viewerPrepared(),
                n.zoomViewer = A(n),
                n
            }
            return i = r,
            n = [{
                key: "init",
                value: function() {
                    N(M(r.prototype), "init", this).call(this),
                    this.initEvents(),
                    this.initPages(),
                    this.initScrollBar()
                }
            }, {
                key: "initEvents",
                value: function() {
                    this.stageDOM = this.element[0],
                    N(M(r.prototype), "initEvents", this).call(this)
                }
            }, {
                key: "initPages",
                value: function() {
                    this.stackCount = this.app.pageCount;
                    for (var e = 0; e < this.stackCount; e++) {
                        var t = new O({
                            parentElement: this.wrapper
                        });
                        t.index = e,
                        t.viewer = this,
                        this.pages.push(t)
                    }
                }
            }, {
                key: "initScrollBar",
                value: function() {
                    this.scrollBar = jQuery("<div class='df-reader-scrollbar'>"),
                    this.scrollBar.appendTo(this.app.container),
                    this.scrollPageNumber = jQuery("<div class='df-reader-scroll-page-number'>").appendTo(this.app.container)
                }
            }, {
                key: "afterControlUpdate",
                value: function() {
                    void 0 !== this.scrollBar && (this.scrollBar[0].innerHTML = this.app.getCurrentLabel(),
                    this.app.provider.pageLabels ? this.scrollPageNumber[0].innerHTML = this.app.getCurrentLabel() + "<div>(" + this.app.currentPageNumber + " of " + this.app.pageCount + ")</div>" : this.scrollPageNumber[0].innerHTML = this.app.getCurrentLabel() + "<div>of " + this.app.pageCount + "</div>")
                }
            }, {
                key: "updateBuffer",
                value: function(e) {
                    if ("-1" !== e.textureStamp && void 0 !== e.pageNumber) {
                        for (var t = e.pageNumber, i = e.pageNumber, n = 0, o = 0; o < this.pageBuffer.length; o++) {
                            var a = this.pageBuffer[o].pageNumber;
                            if (t === a)
                                return void D.log("Page " + t + " already in buffer, skipping");
                            Math.abs(this.app.currentPageNumber - a) > Math.abs(this.app.currentPageNumber - i) && (i = a,
                            n = o)
                        }
                        this.pageBuffer.push(e),
                        this.pageBuffer.length > this.pageBufferSize && (D.log("Farthest buffer: " + i),
                        this.pageBuffer[n].reset(),
                        this.pageBuffer.splice(n, 1))
                    }
                }
            }, {
                key: "initCustomControls",
                value: function() {
                    var e = this.app.ui.controls;
                    e.openRight.hide(),
                    e.openLeft.hide()
                }
            }, {
                key: "dispose",
                value: function() {
                    N(M(r.prototype), "dispose", this).call(this),
                    this.scrollBar && this.scrollBar.remove(),
                    this.scrollPageNumber && this.scrollPageNumber.remove(),
                    this.element.remove()
                }
            }, {
                key: "_getInnerHeight",
                value: function() {
                    N(M(r.prototype), "_getInnerHeight", this).call(this);
                    var t = this.app.dimensions.maxHeight - this.app.dimensions.padding.height
                      , i = this.app.dimensions.defaultPage.viewPort
                      , n = this.app.dimensions.containerWidth - 20 - this.app.dimensions.padding.width;
                    this.app.pageScaling === e.PAGE_SCALE.ACTUAL && (n = 1 * this.app.provider.defaultPage.viewPort.width);
                    var o = t;
                    return this.app.pageScaling === e.PAGE_SCALE.PAGE_WIDTH ? o = 100 * i.height : this.app.pageScaling === e.PAGE_SCALE.AUTO ? o = 1.5 * i.height : this.app.pageScaling === e.PAGE_SCALE.ACTUAL && (o = 1 * i.height),
                    o -= 2,
                    this._containCover = D.contain(i.width, i.height, n, o),
                    o = Math.min(t, this._containCover.height + 2),
                    this.app.pageScaleValue = this._containCover.height / i.height,
                    this.app.dimensions.isFixedHeight ? t : o
                }
            }, {
                key: "handleZoom",
                value: function() {
                    var e = this.app
                      , t = this.maxZoom = 4
                      , i = e.zoomValue;
                    !0 === e.pendingZoom && null != e.zoomDelta ? i = e.zoomDelta > 0 ? i * e.options.zoomRatio : i / e.options.zoomRatio : null != this.lastScale && (i *= this.lastScale,
                    this.lastScale = null),
                    i = D.limitAt(i, this.minZoom, t),
                    e.zoomValueChange = i / e.zoomValue,
                    e.zoomChanged = e.zoomValue !== i,
                    e.zoomValue = i
                }
            }, {
                key: "resize",
                value: function() {
                    var e = this
                      , t = e.app
                      , i = (t.dimensions,
                    t.dimensions.padding)
                      , n = this.shiftHeight = 0;
                    this.element.css({
                        top: -n,
                        bottom: -n,
                        right: -0,
                        left: -0,
                        paddingTop: i.top,
                        paddingRight: i.right,
                        paddingBottom: i.bottom,
                        paddingLeft: i.left
                    });
                    for (var o = e.getVisiblePages().main[0] - 1, a = (o = e.pages[o].element[0]).getBoundingClientRect(), r = this.parentElement[0].getBoundingClientRect(), s = 0; s < e.pages.length; s++) {
                        var l = e.pages[s]
                          , u = e.getViewPort(s + 1, !0)
                          , h = l.element[0].style;
                        h.height = Math.floor(u.height * t.pageScaleValue * t.zoomValue) + "px",
                        h.width = Math.floor(u.width * t.pageScaleValue * t.zoomValue) + "px"
                    }
                    if (e.oldScrollHeight != e.element[0].scrollHeight && void 0 !== e.oldScrollHeight) {
                        var p, c = e.element[0].scrollHeight / e.oldScrollHeight;
                        e.skipScrollCheck = !0;
                        var d = o.offsetTop + o.clientTop - (a.top - r.top + o.clientTop) * c
                          , f = o.offsetLeft + o.clientLeft - (a.left - r.left + o.clientLeft) * c;
                        d += 10 * (c - 1) / 2,
                        f += 10 * (c - 1) / 2,
                        this.zoomCenter = null !== (p = this.zoomCenter) && void 0 !== p ? p : {
                            x: 0,
                            y: 0
                        },
                        d += (c - 1) * this.zoomCenter.y,
                        f += (c - 1) * this.zoomCenter.x,
                        this.zoomCenter = null,
                        e.element[0].scrollTop = d,
                        e.element[0].scrollLeft = f,
                        e.skipScrollCheck = !1
                    }
                    e.oldScrollHeight = e.element[0].scrollHeight,
                    this.scrollBar[0].style.transform = "none",
                    this.updateScrollBar()
                }
            }, {
                key: "onReady",
                value: function() {
                    this.gotoPageCallBack(),
                    this.oldScrollHeight = this.element[0].scrollHeight
                }
            }, {
                key: "refresh",
                value: function() {
                    for (var t = this, i = this.app, n = t.getVisiblePages().main, o = 0; o < n.length; o++) {
                        var a = void 0
                          , r = n[o];
                        r !== (a = t.pages[r - 1]).pageNumber && (a.resetTexture(),
                        this.app.textureRequestStatus = e.REQUEST_STATUS.ON),
                        a.element.attr("number", r),
                        a.pageNumber = r
                    }
                    t.requestRefresh(!1),
                    i.textureRequestStatus = e.REQUEST_STATUS.ON
                }
            }, {
                key: "isAnimating",
                value: function() {
                    return this.scrollStatus === e.REQUEST_STATUS.ON || this.scrollStatus === e.REQUEST_STATUS.COUNT
                }
            }, {
                key: "checkRequestQueue",
                value: function() {
                    N(M(r.prototype), "checkRequestQueue", this).call(this),
                    this.scrollStatus === e.REQUEST_STATUS.ON && (this.scrollStatus = e.REQUEST_STATUS.OFF),
                    this.scrollStatus === e.REQUEST_STATUS.COUNT && (this.scrollStatus = e.REQUEST_STATUS.ON)
                }
            }, {
                key: "isActivePage",
                value: function(e) {
                    return void 0 !== this.visiblePagesCache && this.visiblePagesCache.includes(e)
                }
            }, {
                key: "getVisiblePages",
                value: function() {
                    var e = D.getVisibleElements({
                        container: this.element[0],
                        elements: this.wrapper[0].children
                    });
                    return e = 0 === e.length ? [this.app.currentPageNumber] : e.splice(0, this.pageBufferSize),
                    this.visiblePagesCache = e,
                    {
                        main: e,
                        buffer: []
                    }
                }
            }, {
                key: "getPageByNumber",
                value: function(e) {
                    var t = this.pages[e - 1];
                    return void 0 === t && D.log("Page Not found for: " + e),
                    t
                }
            }, {
                key: "onScroll",
                value: function(t) {
                    for (var i = this, n = i.element[0].scrollTop + i.app.dimensions.containerHeight / 2, o = i.getVisiblePages().main, a = o[0], r = 0; r < o.length; r++) {
                        a = o[r];
                        var s = i.pages[a - 1].element[0]
                          , l = s.offsetTop + s.clientTop;
                        if (l <= n && s.clientHeight + l >= n)
                            break;
                        if (r > 0 && l > n && s.clientHeight + l >= n) {
                            a = o[r - 1];
                            break
                        }
                    }
                    i.skipScrollIntoView = !0,
                    i.app.gotoPage(a),
                    i.skipScrollIntoView = !1,
                    i.updateScrollBar(),
                    t.preventDefault && t.preventDefault(),
                    t.stopPropagation(),
                    i.requestRefresh(),
                    this.scrollStatus = e.REQUEST_STATUS.COUNT,
                    e.handlePopup(i.element, !1)
                }
            }, {
                key: "updateScrollBar",
                value: function() {
                    var e = this.element[0]
                      , t = (this.app.container[0],
                    e.scrollLeft,
                    60 + (e.offsetHeight - 40 - 60 - 60) * e.scrollTop / (e.scrollHeight - e.offsetHeight));
                    isNaN(t) && (t = 60),
                    this.scrollBar.lastY = t,
                    this.scrollBar[0].style.transform = "translateY(" + t + "px)"
                }
            }, {
                key: "validatePageChange",
                value: function(e) {}
            }, {
                key: "gotoPageCallBack",
                value: function() {
                    var e = this;
                    if (!0 !== e.skipScrollIntoView) {
                        var t = e.getPageByNumber(e.app.currentPageNumber);
                        null != t && D.scrollIntoView(t.element[0], e.element[0])
                    }
                    e.skipScrollIntoView = !1,
                    e.requestRefresh()
                }
            }, {
                key: "getTextureSize",
                value: function(e) {
                    var t = this.app.provider.viewPorts[1];
                    this.app.provider.viewPorts[e.pageNumber] && (t = this.app.provider.viewPorts[e.pageNumber]);
                    var i = this.app.options.pixelRatio;
                    return {
                        height: t.height * this.app.zoomValue * this.app.pageScaleValue * i,
                        width: t.width * this.app.zoomValue * this.app.pageScaleValue * i
                    }
                }
            }, {
                key: "textureLoadedCallback",
                value: function(e) {
                    var t = this.getPageByNumber(e.pageNumber)
                      , i = this.app
                      , n = this.getViewPort(e.pageNumber, !0);
                    t.element.height(Math.floor(n.height * i.pageScaleValue * i.zoomValue)).width(Math.floor(n.width * i.pageScaleValue * i.zoomValue))
                }
            }, {
                key: "pan",
                value: function(t) {
                    var i = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , n = this
                      , o = n.startPoint
                      , a = t.raw.y - o.raw.y
                      , r = t.raw.x - o.raw.x;
                    n.deltaPanY += a,
                    n.deltaPanX += r,
                    n.panRequestStatus = e.REQUEST_STATUS.ON,
                    !1 === i && (n.startPoint = t)
                }
            }, {
                key: "updatePan",
                value: function() {
                    this.element[0].scrollTop = this.element[0].scrollTop - this.deltaPanY,
                    this.element[0].scrollLeft = this.element[0].scrollLeft - this.deltaPanX,
                    this.deltaPanY = 0,
                    this.deltaPanX = 0
                }
            }, {
                key: "mouseMove",
                value: function(e) {
                    if (this.startPoint && this.isScrollBarPressed) {
                        var t = D.fixMouseEvent(e)
                          , i = this.eventToPoint(t)
                          , n = this.element[0]
                          , o = this.scrollBar.lastY - (this.startPoint.raw.y - i.raw.y);
                        return this.scrollBar.lastY = o,
                        n.scrollTop = (o - 60) * (n.scrollHeight - n.offsetHeight) / (n.offsetHeight - 40 - 60 - 60),
                        this.startPoint = i,
                        void e.preventDefault()
                    }
                    e.touches && e.touches.length < 2 || N(M(r.prototype), "mouseMove", this).call(this, e)
                }
            }, {
                key: "mouseDown",
                value: function(e) {
                    N(M(r.prototype), "mouseDown", this).call(this, e),
                    e.srcElement === this.scrollBar[0] && (this.isScrollBarPressed = !0,
                    this.scrollBar.addClass("df-active"),
                    this.scrollPageNumber.addClass("df-active"))
                }
            }, {
                key: "mouseUp",
                value: function(e) {
                    N(M(r.prototype), "mouseUp", this).call(this, e),
                    (this.isScrollBarPressed = this.scrollBar) && (this.isScrollBarPressed = !1,
                    this.scrollBar.removeClass("df-active"),
                    this.scrollPageNumber.removeClass("df-active"))
                }
            }],
            n && L(i.prototype, n),
            o && L(i, o),
            Object.defineProperty(i, "prototype", {
                writable: !1
            }),
            r
        }(y);
        function z(e) {
            return z = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            z(e)
        }
        function B(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function H(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== z(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== z(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === z(a) ? a : String(a)), n)
            }
            var o, a
        }
        function U(e, t, i) {
            return t && H(e.prototype, t),
            i && H(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        function j() {
            return j = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = q(e)); )
                        ;
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(arguments.length < 3 ? e : i) : o.value
                }
            }
            ,
            j.apply(this, arguments)
        }
        function V(e, t) {
            if ("function" != typeof t && null !== t)
                throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            t && W(e, t)
        }
        function W(e, t) {
            return W = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            W(e, t)
        }
        function G(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = q(e);
                if (t) {
                    var o = q(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === z(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return function(e) {
                        if (void 0 === e)
                            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                        return e
                    }(e)
                }(this, i)
            }
        }
        function q(e) {
            return q = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            q(e)
        }
        var Z = e.utils
          , K = function(t) {
            V(n, t);
            var i = G(n);
            function n(t, o) {
                var a, r;
                return B(this, n),
                t.viewerClass = "df-flipbook " + (t.viewerClass || ""),
                (r = i.call(this, t, o)).isFlipBook = !0,
                r.sheets = [],
                r.isRTL = r.app.isRTL,
                r.foldSense = 50,
                r.isOneSided = !1,
                r.stackCount = null !== (a = t.stackCount) && void 0 !== a ? a : 6,
                r.annotedPage = null,
                r.pendingAnnotations = [],
                r.seamPosition = 0,
                r.dragSheet = null,
                r.drag = null,
                r.soundOn = !0 === t.enableSound,
                r.soundFile = null,
                r.minZoom = 1,
                r.maxZoom = 4,
                r.app.options.pageSize !== e.FLIPBOOK_PAGE_SIZE.AUTO && r.app.options.pageSize !== e.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL || (r.app.checkSecondPage = !0),
                r.app.pageScaling = e.PAGE_SCALE.PAGE_FIT,
                t.viewerClass = "",
                r.zoomViewer = new Q(t,o),
                r
            }
            return U(n, [{
                key: "init",
                value: function() {
                    j(q(n.prototype), "init", this).call(this),
                    this.initSound();
                    var t = this.app;
                    this.pageMode = t.options.pageMode === e.FLIPBOOK_PAGE_MODE.AUTO ? Z.isMobile || t.pageCount <= 2 ? e.FLIPBOOK_PAGE_MODE.SINGLE : e.FLIPBOOK_PAGE_MODE.DOUBLE : t.options.pageMode,
                    this.singlePageMode = t.options.singlePageMode || (Z.isMobile ? e.FLIPBOOK_SINGLE_PAGE_MODE.BOOKLET : e.FLIPBOOK_SINGLE_PAGE_MODE.ZOOM),
                    this.updatePageMode(),
                    this.rightSheetHeight = this.leftSheetHeight = this._defaultPageSize.height,
                    this.leftSheetWidth = this.rightSheetWidth = this._defaultPageSize.width,
                    this.leftSheetTop = this.rightSheetTop = (this.availablePageHeight() - this._defaultPageSize.height) / 2,
                    this.zoomViewer.rightSheetHeight = this.zoomViewer.leftSheetHeight = this._defaultPageSize.height,
                    this.zoomViewer.leftSheetWidth = this.zoomViewer.rightSheetWidth = this._defaultPageSize.width
                }
            }, {
                key: "determineHeight",
                value: function() {}
            }, {
                key: "initCustomControls",
                value: function() {
                    j(q(n.prototype), "initCustomControls", this).call(this);
                    var e = this
                      , t = this.app
                      , i = t.ui
                      , o = i.controls
                      , a = t.options.text
                      , r = t.options.icons;
                    o.sound = Z.createBtn("sound", r.sound, a.toggleSound).on("click", (function() {
                        e.soundOn = !e.soundOn,
                        i.updateSound()
                    }
                    )),
                    i.updateSound = function() {
                        !1 === e.soundOn ? o.sound.addClass("disabled") : o.sound.removeClass("disabled")
                    }
                    ,
                    i.updateSound()
                }
            }, {
                key: "dispose",
                value: function() {
                    j(q(n.prototype), "dispose", this).call(this);
                    for (var e = 0; e < this.sheets.length; e++) {
                        var t = this.sheets[e];
                        t && t.currentTween && (t.currentTween.stop(),
                        t.currentTween = null)
                    }
                    this.zoomViewer.dispose(),
                    this.soundFile = null
                }
            }, {
                key: "determinePageMode",
                value: function() {
                    var t = this.app
                      , i = this.pageMode;
                    if (this.app.pageCount < 3)
                        this.pageMode = e.FLIPBOOK_PAGE_MODE.SINGLE;
                    else if (this.app.options.pageMode === e.FLIPBOOK_PAGE_MODE.AUTO && 1 != this.pageModeChangedManually) {
                        if (!0 === Z.isMobile)
                            if (this.app.dimensions.isAutoHeight && 0 == this.app.dimensions.isFixedHeight) {
                                var n = this._calculateInnerHeight(!0)
                                  , o = this._calculateInnerHeight(!1)
                                  , a = t.dimensions.stage.innerWidth + (1 != t.options.sideMenuOverlay && t.isSideMenuOpen ? 220 : 0);
                                this.pageMode = n > 1.1 * o && a < 768 ? e.FLIPBOOK_PAGE_MODE.SINGLE : e.FLIPBOOK_PAGE_MODE.DOUBLE,
                                this._calculateInnerHeight()
                            } else {
                                var r = t.dimensions.stage.innerWidth + (1 != t.options.sideMenuOverlay && t.isSideMenuOpen ? 220 : 0);
                                this.pageMode = t.dimensions.stage.innerHeight > 1.1 * r && r < 768 ? e.FLIPBOOK_PAGE_MODE.SINGLE : e.FLIPBOOK_PAGE_MODE.DOUBLE
                            }
                        this.pageMode != i && this.setPageMode({
                            isSingle: this.pageMode == e.FLIPBOOK_PAGE_MODE.SINGLE
                        })
                    }
                }
            }, {
                key: "initSound",
                value: function() {
                    this.soundFile = document.createElement("audio"),
                    this.soundFile.setAttribute("src", this.app.options.soundFile + "?ver=" + e.version),
                    this.soundFile.setAttribute("type", "audio/mpeg")
                }
            }, {
                key: "playSound",
                value: function() {
                    var e = this;
                    try {
                        !0 === e.app.userHasInteracted && !0 === e.soundOn && (e.soundFile.currentTime = 0,
                        e.soundFile.play())
                    } catch (e) {}
                }
            }, {
                key: "checkDocumentPageSizes",
                value: function() {
                    var t = this.app.provider;
                    t.pageSize === e.FLIPBOOK_PAGE_SIZE.AUTO && (t._page2Ratio && t._page2Ratio > 1.5 * t.defaultPage.pageRatio ? t.pageSize = e.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL : t.pageSize = e.FLIPBOOK_PAGE_SIZE.SINGLE),
                    t.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL && (t.pageCount = 1 === t.numPages ? 1 : 2 * t.numPages - 2),
                    t.pageSize !== e.FLIPBOOK_PAGE_SIZE.DOUBLE_COVER_BACK && t.pageSize !== e.FLIPBOOK_PAGE_SIZE.DOUBLE || (t.pageCount = 2 * t.numPages)
                }
            }, {
                key: "getViewerPageNumber",
                value: function(t) {
                    return this.app.provider.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL && t > 2 && (t = 2 * t - 1),
                    this.app.provider.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_COVER_BACK && t > 2 && (t = 2 * t - 1),
                    t
                }
            }, {
                key: "getDocumentPageNumber",
                value: function(t) {
                    return this.app.provider.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL && t > 2 ? Math.ceil((t - 1) / 2) + 1 : this.app.provider.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_COVER_BACK && t > 1 ? t === this.app.pageCount ? 1 : Math.ceil((t - 1) / 2) + 1 : t
                }
            }, {
                key: "getViewPort",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , i = arguments.length > 2 ? arguments[2] : void 0;
                    return this.filterViewPort(j(q(n.prototype), "getViewPort", this).call(this, e, t), e, i)
                }
            }, {
                key: "isDoubleInternal",
                value: function() {
                    return this.app.provider.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL
                }
            }, {
                key: "isDoubleCoverBack",
                value: function() {
                    return this.app.provider.pageSize === e.FLIPBOOK_PAGE_SIZE.DOUBLE_COVER_BACK
                }
            }, {
                key: "isDoubleInternalPage",
                value: function(e) {
                    return this.isDoubleInternal() && e > 1 && e < this.app.provider.pageCount
                }
            }, {
                key: "getDoublePageWidthFix",
                value: function(e) {
                    return this.isDoubleInternalPage(e) || this.isDoubleCoverBack() ? 2 : 1
                }
            }, {
                key: "isDoublePageFix",
                value: function(e) {
                    var t = !1;
                    return (this.isDoubleCoverBack() || this.isDoubleInternalPage(e)) && (this.app.isRTL ? e % 2 == 0 && (t = !0) : e % 2 == 1 && (t = !0)),
                    t
                }
            }, {
                key: "finalizeAnnotations",
                value: function(e, t) {}
            }, {
                key: "finalizeTextContent",
                value: function(e, t) {}
            }, {
                key: "isActivePage",
                value: function(e) {
                    return void 0 !== this.visiblePagesCache && this.visiblePagesCache.includes(e)
                }
            }, {
                key: "isSheetCover",
                value: function(e) {
                    var t = this.isBooklet;
                    return 0 === e || t && 1 === e || e === Math.ceil(this.app.pageCount / (t ? 1 : 2)) - (t ? 0 : 1)
                }
            }, {
                key: "isSheetHard",
                value: function(e) {
                    var t = this.app.options.flipbookHardPages;
                    this.isBooklet;
                    if ("cover" === t)
                        return this.isSheetCover(e);
                    if ("all" === t)
                        return !0;
                    var i = ("," + t + ",").indexOf("," + (2 * e + 1) + ",") > -1
                      , n = ("," + t + ",").indexOf("," + (2 * e + 2) + ",") > -1;
                    return i || n
                }
            }, {
                key: "sheetsIndexShift",
                value: function(e, t, i) {
                    e > t ? (this.sheets[i - 1].skipFlip = !0,
                    this.sheets.unshift(this.sheets.pop())) : e < t && (this.sheets[0].skipFlip = !0,
                    this.sheets.push(this.sheets.shift()))
                }
            }, {
                key: "checkSwipe",
                value: function(e, t) {
                    var i = this;
                    if (!0 !== i.pinchZoomDirty && 1 === i.app.zoomValue && !0 === i.canSwipe) {
                        var n = "vertical" == i.orientation ? e.y - i.lastPosY : e.x - i.lastPosX;
                        Math.abs(n) > i.swipeThreshold && (n < 0 ? i.app.openRight() : i.app.openLeft(),
                        i.canSwipe = !1,
                        t.preventDefault()),
                        i.lastPosX = e.x,
                        i.lastPosY = e.y
                    }
                }
            }, {
                key: "checkCenter",
                value: function() {
                    var t, i = arguments.length > 0 && void 0 !== arguments[0] && arguments[0], n = this, o = this.app, a = e.FLIPBOOK_CENTER_SHIFT, r = o.currentPageNumber % 2 == 0, s = n.getBasePage(), l = n.isRTL, u = n.isSingle;
                    t = 0 === s || n.isBooklet ? n.isRTL ? a.RIGHT : a.LEFT : s === o.pageCount ? l ? a.LEFT : a.RIGHT : u ? l ? r ? a.LEFT : a.RIGHT : r ? a.RIGHT : a.LEFT : a.NONE,
                    !0 !== n.centerNeedsUpdate && (n.centerNeedsUpdate = n.centerShift !== t),
                    n.centerNeedsUpdate && (n.centerShift = t,
                    n.updateCenter(i),
                    n.centerNeedsUpdate = !1)
                }
            }, {
                key: "updateCenter",
                value: function() {
                    console.log("UpdateCenter: missing implementation.")
                }
            }, {
                key: "reset",
                value: function() {
                    for (var e, t = 0; t < this.sheets.length; t++)
                        (e = this.sheets[t]).reset(),
                        e.pageNumber = -1,
                        e.frontPage && (e.frontPage.pageNumber = -1),
                        e.backPage && (e.backPage.pageNumber = -1),
                        e.resetTexture();
                    this.annotedPage = null,
                    this.oldBasePageNumber = -1,
                    this.centerShift = null,
                    this.refresh()
                }
            }, {
                key: "handleZoom",
                value: function() {
                    var e = this.app
                      , t = (e.dimensions,
                    this.getLeftPageTextureSize({
                        zoom: !1,
                        isAnnotation: !0
                    }))
                      , i = this.getRightPageTextureSize({
                        zoom: !1,
                        isAnnotation: !0
                    })
                      , n = (this.maxZoom,
                    e.zoomValue,
                    this.maxZoom = e.dimensions.maxTextureSize / Math.max(t.height, t.width, i.height, i.width))
                      , o = e.zoomValue
                      , a = !1
                      , r = !1;
                    (n < this.minZoom && (n = this.maxZoom = this.minZoom),
                    !0 === e.pendingZoom && null != e.zoomDelta) ? o = e.zoomDelta > 0 ? o * e.options.zoomRatio : o / e.options.zoomRatio : null != this.lastScale && (o *= this.lastScale,
                    this.lastScale = null);
                    o = Z.limitAt(o, this.minZoom, n),
                    e.zoomValueChange = o / e.zoomValue,
                    !(e.zoomChanged = e.zoomValue !== o) || 1 !== o && 1 !== e.zoomValue || (a = 1 === o,
                    r = 1 === e.zoomValue),
                    e.zoomValue = o,
                    (r || a) && (e.container.toggleClass("df-zoom-active", 1 !== o),
                    r && this.enterZoom(),
                    a && this.exitZoom())
                }
            }, {
                key: "refresh",
                value: function() {
                    var t = this
                      , i = this.app
                      , n = t.stackCount
                      , o = t.isRTL
                      , a = t.isBooklet
                      , r = t.getBasePage()
                      , s = a ? 1 : 2;
                    o && (r = i.pageCount - r);
                    var l, u = t.oldBasePageNumber, h = Math.ceil(i.pageCount / s), p = Math.floor(n / 2);
                    r !== t.oldBasePageNumber && (t.pageNumberChanged = !0,
                    this.updatePendingStatusClass(!0),
                    t.zoomViewer.reset()),
                    t.sheetsIndexShift(u, r, n);
                    var c = Math.ceil(r / s);
                    for (l = 0; l < n; l++) {
                        var d = void 0
                          , f = c - p + l;
                        if (o && (f = h - f - 1),
                        null != (d = t.sheets[l])) {
                            d.targetSide = l < p ? e.TURN_DIRECTION.LEFT : e.TURN_DIRECTION.RIGHT;
                            var g = d.side !== d.targetSide
                              , v = f !== d.pageNumber
                              , m = g && !1 === d.skipFlip && 1 === i.zoomValue;
                            if (!g && v && d.isFlipping && d.currentTween && d.currentTween.stop(),
                            d.isHard = t.isSheetHard(f),
                            d.isCover = t.isSheetCover(f),
                            v)
                                d.resetTexture(),
                                (this.app.isRTL ? d.backPage : d.frontPage).pageNumber = this.isBooklet ? f : 2 * f + 1,
                                (this.app.isRTL ? d.frontPage : d.backPage).pageNumber = this.isBooklet ? -1 : 2 * f + 2,
                                i.textureRequestStatus = e.REQUEST_STATUS.ON;
                            d.pageNumber = f,
                            t.refreshSheet({
                                sheet: d,
                                sheetNumber: f,
                                totalSheets: h,
                                zIndex: this.stackCount + (l < p ? l - p : p - l),
                                visible: a ? o ? l < p || d.isFlipping || m : l >= p || d.isFlipping || m : f >= 0 && f < h || a && f === h,
                                index: l,
                                needsFlip: m,
                                midPoint: p
                            })
                        }
                    }
                    t.requestRefresh(!1),
                    i.textureRequestStatus = e.REQUEST_STATUS.ON,
                    t.oldBasePageNumber = r,
                    this.checkCenter(),
                    this.zoomViewer.refresh(),
                    t.pageNumberChanged = !1
                }
            }, {
                key: "validatePageChange",
                value: function(e) {
                    if (e === this.app.currentPageNumber)
                        return !1;
                    var t = this.app
                      , i = !this.isFlipping() || void 0 === t.oldPageNumber;
                    return i = (i = i || t.currentPageNumber < e && t.oldPageNumber < t.currentPageNumber) || t.currentPageNumber > e && t.oldPageNumber > t.currentPageNumber
                }
            }, {
                key: "getVisiblePages",
                value: function() {
                    for (var e = this, t = [], i = e.getBasePage(), n = e.app.zoomValue > 1 ? 1 : e.isBooklet && Z.isMobile ? Math.min(e.stackCount / 2, 2) : e.stackCount / 2, o = 0; o < n; o++)
                        t.push(i - o),
                        t.push(i + o + 1);
                    return this.visiblePagesCache = t,
                    {
                        main: t,
                        buffer: []
                    }
                }
            }, {
                key: "getBasePage",
                value: function(e) {
                    return void 0 === e && (e = this.app.currentPageNumber),
                    this.isBooklet ? e : 2 * Math.floor(e / 2)
                }
            }, {
                key: "getRightPageNumber",
                value: function() {
                    return this.getBasePage() + (this.isBooklet || this.isRTL ? 0 : 1)
                }
            }, {
                key: "getLeftPageNumber",
                value: function() {
                    return this.getBasePage() + (this.isBooklet ? 0 : this.isRTL ? 1 : 0)
                }
            }, {
                key: "afterFlip",
                value: function() {
                    !0 !== this.isAnimating() && (this.pagesReady(),
                    this.updatePendingStatusClass())
                }
            }, {
                key: "isFlipping",
                value: function() {
                    var e = !1;
                    return this.sheets.forEach((function(t) {
                        !0 === t.isFlipping && (e = !0)
                    }
                    )),
                    e
                }
            }, {
                key: "isAnimating",
                value: function() {
                    return this.isFlipping()
                }
            }, {
                key: "mouseWheel",
                value: function(t) {
                    this.app.options.mouseScrollAction === e.MOUSE_SCROLL_ACTIONS.ZOOM ? this.zoomViewer.mouseWheel(t) : j(q(n.prototype), "mouseWheel", this).call(this, t)
                }
            }, {
                key: "checkRequestQueue",
                value: function() {
                    this.app.zoomValue > 1 ? this.zoomViewer.checkRequestQueue() : j(q(n.prototype), "checkRequestQueue", this).call(this)
                }
            }, {
                key: "updatePan",
                value: function() {}
            }, {
                key: "resetPageTween",
                value: function() {}
            }, {
                key: "gotoPageCallBack",
                value: function() {
                    this.resetPageTween(),
                    1 !== this.app.zoomValue && !0 === this.app.options.resetZoomBeforeFlip && this.app.resetZoom(),
                    this.beforeFlip(),
                    this.requestRefresh()
                }
            }, {
                key: "beforeFlip",
                value: function() {
                    var e = this;
                    e.app.executeCallback("beforeFlip"),
                    1 === e.app.zoomValue && e.playSound()
                }
            }, {
                key: "onFlip",
                value: function() {
                    this.app.executeCallback("onFlip")
                }
            }, {
                key: "getAnnotationElement",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2]
                      , o = void 0;
                    return (o = this.app.zoomValue > 1 || !0 === i ? this.zoomViewer.getAnnotationElement(e, t) : j(q(n.prototype), "getAnnotationElement", this).call(this, e, t)) && (o.parentNode.classList.toggle("df-double-internal", this.isDoubleInternalPage(e)),
                    o.parentNode.classList.toggle("df-double-internal-fix", this.isDoublePageFix(e))),
                    o
                }
            }, {
                key: "getTextElement",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
                    return this.app.zoomValue > 1 || !0 === i ? this.zoomViewer.getTextElement(e, t) : j(q(n.prototype), "getTextElement", this).call(this, e, t)
                }
            }, {
                key: "enterZoom",
                value: function() {
                    this.exchangeTexture(this, this.zoomViewer)
                }
            }, {
                key: "exitZoom",
                value: function() {
                    this.exchangeTexture(this.zoomViewer, this)
                }
            }, {
                key: "exchangeTexture",
                value: function(e, t) {
                    var i = this.getBasePage()
                      , n = e.getPageByNumber(i)
                      , o = t.getPageByNumber(i);
                    if (o && "-1" === o.textureStamp ? (o.textureStamp = n.textureStamp,
                    o.loadTexture({
                        texture: n.getTexture(!0)
                    }),
                    Z.log("Texture Exchanging at " + i)) : Z.log("Texture Exchanging Bypassed at " + i),
                    !this.isBooklet) {
                        var a = e.getPageByNumber(i + 1)
                          , r = t.getPageByNumber(i + 1);
                        r && "-1" === r.textureStamp ? (r.textureStamp = a.textureStamp,
                        r.loadTexture({
                            texture: a.getTexture(!0)
                        }),
                        Z.log("Texture Exchanging at " + (i + 1))) : Z.log("Texture Exchanging Bypassed at " + (i + 1))
                    }
                    t.pagesReady()
                }
            }, {
                key: "setPageMode",
                value: function(t) {
                    var i = this.app
                      , n = !0 === t.isSingle;
                    this.pageMode = n ? e.FLIPBOOK_PAGE_MODE.SINGLE : e.FLIPBOOK_PAGE_MODE.DOUBLE,
                    this.updatePageMode(),
                    i.resizeRequestStart(),
                    i.viewer.pageMode === e.FLIPBOOK_PAGE_MODE.DOUBLE && i.ui.controls.pageMode ? i.ui.controls.pageMode.removeClass(i.options.icons.doublepage).addClass(i.options.icons.singlepage).attr("title", i.options.text.singlePageMode).html("<span>" + i.options.text.singlePageMode + "</span>") : i.ui.controls.pageMode.addClass(i.options.icons.doublepage).removeClass(i.options.icons.singlepage).attr("title", i.options.text.doublePageMode).html("<span>" + i.options.text.doublePageMode + "</span>")
                }
            }, {
                key: "updatePageMode",
                value: function() {
                    this.app.pageCount < 3 && (this.pageMode = e.FLIPBOOK_PAGE_MODE.SINGLE),
                    this.isSingle = this.pageMode === e.FLIPBOOK_PAGE_MODE.SINGLE,
                    this.isBooklet = this.isSingle && this.singlePageMode === e.FLIPBOOK_SINGLE_PAGE_MODE.BOOKLET,
                    this.app.jumpStep = this.isSingle ? 1 : 2,
                    this.totalSheets = Math.ceil(this.app.pageCount / (this.isBooklet ? 1 : 2)),
                    this.sheets.length > 0 && this.reset()
                }
            }, {
                key: "setPage",
                value: function(t) {
                    return t.textureTarget === e.TEXTURE_TARGET.ZOOM ? this.zoomViewer.setPage(t) : j(q(n.prototype), "setPage", this).call(this, t)
                }
            }, {
                key: "_calculateInnerHeight",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : void 0;
                    void 0 === t && (t = this.pageMode === e.FLIPBOOK_PAGE_MODE.SINGLE);
                    var i = this.app.dimensions.defaultPage.viewPort
                      , n = this.availablePageWidth(!1, !0, t)
                      , o = this.app.dimensions.maxHeight - this.app.dimensions.padding.height;
                    "vertical" == this.orientation && 0 == t && (o /= 2),
                    this._defaultPageSize = Z.contain(i.width, i.height, n, o),
                    this._pageFitArea = {
                        width: n,
                        height: o
                    };
                    var a = this.app.dimensions.isFixedHeight ? o : this._pageFitArea.height;
                    return this.app.dimensions.isAutoHeight && 0 == this.app.dimensions.isFixedHeight && (a = Math.floor(this._defaultPageSize.height)),
                    a
                }
            }, {
                key: "_getInnerHeight",
                value: function() {
                    var e = this._calculateInnerHeight();
                    return this.app.dimensions.stage.width = this.app.dimensions.stage.innerWidth + this.app.dimensions.padding.width,
                    this.app.dimensions.stage.height = e + this.app.dimensions.padding.height,
                    e
                }
            }, {
                key: "availablePageWidth",
                value: function() {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0]
                      , i = arguments.length > 1 && void 0 !== arguments[1] && arguments[1]
                      , n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : void 0;
                    void 0 === n && (n = this.pageMode === e.FLIPBOOK_PAGE_MODE.SINGLE);
                    var o = !0 === i ? this.app.dimensions.offset.width : 0
                      , a = this.app.dimensions.stage.innerWidth + o;
                    return a /= !0 === n || "vertical" == this.orientation ? 1 : 2,
                    Math.floor(a * (t ? this.app.zoomValue : 1))
                }
            }, {
                key: "availablePageHeight",
                value: function() {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0]
                      , i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : void 0;
                    void 0 === i && (i = this.pageMode === e.FLIPBOOK_PAGE_MODE.SINGLE);
                    var n = this.app.dimensions.stage.innerHeight;
                    return !1 === i && "vertical" == this.orientation && (n /= 2),
                    Math.floor(n * (t ? this.app.zoomValue : 1))
                }
            }, {
                key: "getTextureSize",
                value: function(e) {
                    var t = this.getViewPort(e.pageNumber, !0)
                      , i = this.app.options.pixelRatio
                      , n = Z.contain(t.width, t.height, i * this.availablePageWidth(e.zoom), i * this.availablePageHeight(e.zoom));
                    return {
                        height: (n = Z.containUnStretched(n.width, n.height, this.app.options.maxTextureSize, this.app.options.maxTextureSize)).height,
                        width: n.width
                    }
                }
            }, {
                key: "getLeftPageTextureSize",
                value: function() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    return e.pageNumber = this.getLeftPageNumber(),
                    this.getTextureSize(e)
                }
            }, {
                key: "getRightPageTextureSize",
                value: function() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    return e.pageNumber = this.getRightPageNumber(),
                    this.getTextureSize(e)
                }
            }, {
                key: "filterViewPort",
                value: function(e, t) {
                    if (void 0 !== e) {
                        if (1 != (!(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2]))
                            return e;
                        var i = e.clone();
                        return i.width = i.width / this.getDoublePageWidthFix(t),
                        i
                    }
                }
            }, {
                key: "filterViewPortCanvas",
                value: function(e, t, i) {
                    this.isDoublePageFix(i) && (e.transform[4] = e.transform[4] - Math.floor(Math.min(t.width, 2 * e.width - t.width))),
                    e.widthFix = this.isDoubleInternalPage(i) ? 2 : 1
                }
            }, {
                key: "isClosedPage",
                value: function(e) {
                    return void 0 === e && (e = this.app.currentPageNumber),
                    1 === e || e === this.app.jumpStep * Math.ceil(this.app.pageCount / this.app.jumpStep) && !this.isBooklet
                }
            }, {
                key: "isLeftPage",
                value: function(e) {
                    return void 0 === e && (e = this.app.currentPageNumber),
                    this.isBooklet ? this.isRTL : e % 2 == (this.isRTL ? 1 : 0)
                }
            }, {
                key: "cleanPage",
                value: function(e) {
                    if (this.isDoubleInternalPage(e)) {
                        var t = e + (e % 2 == 1 ? -1 : 1);
                        return !1 === this.app.provider.requestedPages[e] && !1 === this.app.provider.requestedPages[t]
                    }
                    return j(q(n.prototype), "cleanPage", this).call(this, e)
                }
            }, {
                key: "onReady",
                value: function() {
                    j(q(n.prototype), "onReady", this).call(this)
                }
            }, {
                key: "searchPage",
                value: function(e) {
                    return {
                        include: !this.isDoublePageFix(e),
                        label: this.app.provider.getLabelforPage(e) + (this.isDoubleInternalPage(e) ? "-" + this.app.provider.getLabelforPage(e + 1) : "")
                    }
                }
            }]),
            n
        }(y)
          , Q = function(t) {
            V(n, t);
            var i = G(n);
            function n(e, t) {
                var o;
                return B(this, n),
                e.viewerClass = "df-zoomview " + (e.viewerClass || ""),
                (o = i.call(this, e, t)).viewer = o.app.viewer,
                o.events = {},
                o.init(),
                o.initEvents(),
                o.left = 0,
                o.top = 0,
                o
            }
            return U(n, [{
                key: "init",
                value: function() {
                    this.leftPage = new O,
                    this.rightPage = new O,
                    this.pages.push(this.leftPage),
                    this.pages.push(this.rightPage),
                    this.leftPage.element.addClass("df-page-back"),
                    this.rightPage.element.addClass("df-page-front"),
                    this.wrapper.append(this.leftPage.element),
                    this.wrapper.append(this.rightPage.element),
                    this.bookShadow = jQuery("<div>", {
                        class: "df-book-shadow"
                    }),
                    this.wrapper.append(this.bookShadow),
                    this.wrapper.addClass("df-sheet")
                }
            }, {
                key: "initEvents",
                value: function() {
                    this.stageDOM = this.element[0],
                    j(q(n.prototype), "initEvents", this).call(this)
                }
            }, {
                key: "dispose",
                value: function() {
                    this.element.remove()
                }
            }, {
                key: "resize",
                value: function() {
                    var t = this
                      , i = t.app.dimensions
                      , n = i.padding
                      , o = this.app.viewer.availablePageHeight()
                      , a = this.app.viewer.availablePageWidth()
                      , r = t.fullWidth = a * (this.app.viewer.pageMode === e.FLIPBOOK_PAGE_MODE.SINGLE ? 1 : 2)
                      , s = i.stage.innerWidth
                      , l = i.stage.innerHeight
                      , u = t.shiftHeight = Math.ceil(Z.limitAt((o - l) / 2, 0, o))
                      , h = t.shiftWidth = Math.ceil(Z.limitAt((r - s) / 2, 0, r));
                    1 === t.app.zoomValue && (t.left = 0,
                    t.top = 0),
                    t.element.css({
                        top: -u,
                        bottom: -u,
                        right: -h,
                        left: -h,
                        paddingTop: n.top,
                        paddingRight: n.right,
                        paddingBottom: n.bottom,
                        paddingLeft: n.left,
                        transform: "translate3d(" + t.left + "px," + t.top + "px,0)"
                    }),
                    t.wrapper.css({
                        width: r,
                        height: o,
                        marginTop: i.height - o - n.height > 0 ? (i.height - n.height - o) / 2 : 0
                    }),
                    this.wrapper.height(o).width(r - r % 2),
                    !0 === t.app.pendingZoom && t.zoom(),
                    this.app.viewer.annotedPage = null,
                    this.pagesReady()
                }
            }, {
                key: "zoom",
                value: function() {
                    var e = this
                      , t = this.app;
                    if (t.zoomChanged) {
                        var i = t.dimensions.origin
                          , n = t.zoomValueChange;
                        if (1 === t.zoomValue)
                            e.left = 0,
                            e.top = 0;
                        else {
                            e.left *= n,
                            e.top *= n,
                            t.viewer.zoomCenter || (t.viewer.zoomCenter = {
                                x: i.x,
                                y: i.y
                            });
                            var o = {
                                raw: t.viewer.zoomCenter
                            }
                              , a = {
                                raw: {}
                            }
                              , r = (o.raw.x - i.x) * n
                              , s = (o.raw.y - i.y) * n;
                            a.raw.x = i.x + r,
                            a.raw.y = i.y + s,
                            e.startPoint = a,
                            e.pan(o),
                            e.startPoint = null
                        }
                    }
                    t.viewer.zoomCenter = null
                }
            }, {
                key: "reset",
                value: function() {
                    this.leftPage.resetTexture(),
                    this.rightPage.resetTexture()
                }
            }, {
                key: "refresh",
                value: function() {
                    var e = this.app
                      , t = e.viewer
                      , i = t.getBasePage()
                      , n = t.isBooklet ? !e.isRTL : e.isRTL
                      , o = n ? this.rightPage : this.leftPage
                      , a = n ? this.leftPage : this.rightPage;
                    o.pageNumber = i,
                    a.pageNumber = i + 1,
                    o.updateCSS({
                        display: 0 === i ? "none" : "block"
                    }),
                    a.updateCSS({
                        display: a.pageNumber > e.pageCount || t.isBooklet ? "none" : "block"
                    })
                }
            }, {
                key: "updateCenter",
                value: function() {
                    var e = this;
                    if (null !== e && null !== e.app.viewer) {
                        var t = e.app.viewer.centerShift
                          , i = e.app.viewer.isRTL
                          , n = t * (!i && e.app.currentPageNumber > 1 || i && e.app.currentPageNumber < e.app.pageCount ? e.leftSheetWidth : e.rightSheetWidth) / 2;
                        e.wrapper[0].style.left = n + "px"
                    }
                }
            }, {
                key: "isDoubleInternalPage",
                value: function(e) {
                    return this.app.viewer.isDoubleInternalPage(e)
                }
            }, {
                key: "pagesReady",
                value: function() {
                    if (!this.app.viewer.isFlipping() && (1 !== this.app.zoomValue && this.app.viewer.updatePendingStatusClass(!1),
                    !1 === this.app.options.flipbookFitPages)) {
                        var e = this.app.viewer.getBasePage()
                          , t = this.leftViewport = this.app.viewer.getViewPort(e + (this.app.viewer.isBooklet ? 0 : this.app.viewer.isRTL ? 1 : 0))
                          , i = this.rightViewPort = this.app.viewer.getViewPort(e + (this.app.viewer.isBooklet || this.app.viewer.isRTL ? 0 : 1));
                        if (t) {
                            var n = Z.contain(t.width, t.height, this.app.viewer.availablePageWidth(), this.app.viewer.availablePageHeight());
                            this.leftSheetWidth = Math.floor(n.width),
                            this.leftSheetHeight = Math.floor(n.height),
                            this.leftSheetTop = (this.app.viewer.availablePageHeight() - this.leftSheetHeight) / 2
                        }
                        if (i) {
                            var o = Z.contain(i.width, i.height, this.app.viewer.availablePageWidth(), this.app.viewer.availablePageHeight());
                            this.rightSheetWidth = Math.floor(o.width),
                            this.rightSheetHeight = Math.floor(o.height),
                            this.rightSheetTop = (this.app.viewer.availablePageHeight() - this.rightSheetHeight) / 2
                        }
                        null == t && null == i || (this.totalSheetsWidth = this.leftSheetWidth + this.rightSheetWidth,
                        this.leftPage.element.height(Math.floor(this.leftSheetHeight)).width(Math.floor(this.leftSheetWidth)).css({
                            transform: "translateY(" + Math.floor(this.leftSheetTop) + "px)"
                        }),
                        this.rightPage.element.height(Math.floor(this.rightSheetHeight)).width(Math.floor(this.rightSheetWidth)).css({
                            transform: "translateY(" + Math.floor(this.rightSheetTop) + "px)"
                        }))
                    }
                }
            }, {
                key: "textureLoadedCallback",
                value: function(e) {
                    this.getPageByNumber(e.pageNumber);
                    this.pagesReady()
                }
            }]),
            n
        }(y)
          , X = function() {
            function t(e) {
                B(this, t),
                this.parentElement = e.parentElement,
                this.isFlipping = !1,
                this.isOneSided = !1,
                this.viewer = e.viewer,
                this.frontPage = null,
                this.backPage = null,
                this.pageNumber = void 0,
                this.animateToReset = null
            }
            return U(t, [{
                key: "init",
                value: function() {}
            }, {
                key: "flip",
                value: function() {}
            }, {
                key: "frontImage",
                value: function(e) {
                    this.frontPage.loadTexture({
                        texture: e.texture,
                        callback: e.callback
                    })
                }
            }, {
                key: "backImage",
                value: function(e) {
                    this.backPage.loadTexture({
                        texture: e.texture,
                        callback: e.callback
                    })
                }
            }, {
                key: "resetTexture",
                value: function() {
                    this.frontPage.resetTexture(),
                    this.backPage.resetTexture()
                }
            }, {
                key: "reset",
                value: function() {
                    var t = this;
                    t.animateToReset = null,
                    t.isFlipping = !1,
                    t.currentTween = null,
                    t.pendingPoint = null,
                    t.magnetic = !1,
                    t.skipFlip = !0,
                    t.animateToReset = null,
                    t.viewer.dragPage = null,
                    t.viewer.flipPage = null,
                    t.viewer.corner = e.TURN_CORNER.NONE
                }
            }]),
            t
        }();
        function Y(e) {
            return Y = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            Y(e)
        }
        function J() {
            return J = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = ae(e)); )
                        ;
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(arguments.length < 3 ? e : i) : o.value
                }
            }
            ,
            J.apply(this, arguments)
        }
        function $(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function ee(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== Y(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== Y(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === Y(a) ? a : String(a)), n)
            }
            var o, a
        }
        function te(e, t, i) {
            return t && ee(e.prototype, t),
            i && ee(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        function ie(e, t) {
            if ("function" != typeof t && null !== t)
                throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            t && ne(e, t)
        }
        function ne(e, t) {
            return ne = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            ne(e, t)
        }
        function oe(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = ae(e);
                if (t) {
                    var o = ae(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === Y(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return function(e) {
                        if (void 0 === e)
                            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                        return e
                    }(e)
                }(this, i)
            }
        }
        function ae(e) {
            return ae = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            ae(e)
        }
        var re = e
          , se = re.utils
          , le = function(t) {
            ie(n, t);
            var i = oe(n);
            function n(e) {
                var t;
                return $(this, n),
                (t = i.call(this, e)).init(),
                t
            }
            return te(n, [{
                key: "init",
                value: function() {
                    var e = this
                      , t = "<div>"
                      , i = e.element = jQuery(t, {
                        class: "df-sheet"
                    })
                      , n = e.frontPage = new O;
                    n.element.addClass("df-page-front");
                    var o = e.backPage = new O;
                    o.element.addClass("df-page-back");
                    var a = e.wrapper = jQuery(t, {
                        class: "df-sheet-wrapper"
                    })
                      , r = e.foldInnerShadow = jQuery(t, {
                        class: "df-sheet-fold-inner-shadow"
                    })
                      , s = e.foldOuterShadow = jQuery(t, {
                        class: "df-sheet-fold-outer-shadow"
                    });
                    this.parentElement.append(i),
                    i.append(a),
                    i.append(s),
                    a.append(n.element),
                    a.append(o.element),
                    a.append(r)
                }
            }, {
                key: "updateCSS",
                value: function(e) {
                    this.element.css(e)
                }
            }, {
                key: "resetCSS",
                value: function() {
                    var e = this;
                    e.wrapper.css({
                        transform: ""
                    }),
                    e.frontPage.resetCSS(),
                    e.backPage.resetCSS()
                }
            }, {
                key: "updateSize",
                value: function(e, t, i) {
                    e = Math.floor(e),
                    t = Math.floor(t),
                    i = Math.floor(i),
                    this.wrapper[0].style.height = this.wrapper[0].style.width = Math.ceil(se.distOrigin(e, t) * this.viewer.app.zoomValue) + "px",
                    this.element[0].style.height = this.frontPage.element[0].style.height = this.backPage.element[0].style.height = this.foldInnerShadow[0].style.height = t + "px",
                    this.element[0].style.width = this.frontPage.element[0].style.width = this.backPage.element[0].style.width = this.foldInnerShadow[0].style.width = e + "px",
                    this.element[0].style.transform = "translateY(" + i + "px)"
                }
            }, {
                key: "flip",
                value: function(t) {
                    var i = this;
                    if (t = t || i.pendingPoint,
                    null != i && null != i.viewer) {
                        i.isFlipping = !0,
                        i.viewer.flipPage = i;
                        var n, o, a = i.viewer.isBooklet, r = i.side === e.TURN_DIRECTION.RIGHT, s = i.viewer.isRTL, l = i.viewer.corner === e.TURN_CORNER.BL || i.viewer.corner === e.TURN_CORNER.BR ? i.element.height() : 0, u = i.viewer.leftSheetWidth + i.viewer.rightSheetWidth, h = 0;
                        o = i.end = i && !0 === i.animateToReset ? {
                            x: r ? u : 0,
                            y: l
                        } : {
                            x: r ? 0 : u,
                            y: l
                        },
                        i.flipEasing = i.isHard ? TWEEN.Easing.Quadratic.InOut : TWEEN.Easing.Linear.None;
                        var p = i.viewer.app.options.duration;
                        !0 === i.isHard ? (null != t && (h = se.angleByDistance(t.distance, t.fullWidth)),
                        n = i.init = {
                            angle: h * (r ? -1 : 1)
                        },
                        o = i.end = i && !0 === i.animateToReset ? {
                            angle: r ? 0 : -0
                        } : {
                            angle: r ? -180 : 180
                        }) : null == t ? n = i.init = i && !0 === i.animateToReset ? {
                            x: r ? 0 : u,
                            y: 0
                        } : {
                            x: r ? u : 0,
                            y: 0
                        } : (n = i.init = {
                            x: t.x,
                            y: t.y,
                            opacity: 1
                        },
                        p = i.viewer.app.options.duration * se.distPoints(n.x, n.y, o.x, o.y) / i.viewer.fullWidth,
                        p = se.limitAt(p, i.viewer.app.options.duration / 3, i.viewer.duration)),
                        n.index = 0,
                        o.index = 1,
                        i.isFlipping = !0,
                        a && (!r && !s || r && s) && (i.element[0].style.opacity = 0),
                        !0 === i.isHard ? i.currentTween = new TWEEN.Tween(n).delay(0).to(o, i.viewer.app.options.duration).onUpdate((function() {
                            i.updateTween(this)
                        }
                        )).easing(i.flipEasing).onComplete(i.completeTween.bind(i)).start() : i.currentTween = null == t ? new TWEEN.Tween(n).delay(0).to(o, i.viewer.app.options.duration).onUpdate((function() {
                            i.updateTween(this)
                        }
                        )).easing(TWEEN.Easing.Sinusoidal.Out).onComplete(i.completeTween.bind(i)).start() : new TWEEN.Tween(n).delay(0).to(o, p).onUpdate((function() {
                            i.updateTween(this)
                        }
                        )).easing(TWEEN.Easing.Sinusoidal.Out).onComplete(i.completeTween.bind(i)).start()
                    }
                }
            }, {
                key: "updatePoint",
                value: function(t) {
                    var i = this;
                    if (null != t) {
                        var n = i.element.width()
                          , o = i.element.height()
                          , a = i.viewer.corner !== e.TURN_CORNER.NONE ? i.viewer.corner : t.corner
                          , r = e.TURN_CORNER
                          , s = i.side === e.TURN_DIRECTION.RIGHT
                          , l = a === r.BL || a === r.BR;
                        t.rx = !0 === s ? i.viewer.leftSheetWidth + n - t.x : t.x,
                        t.ry = !0 === l ? o - t.y : t.y;
                        var u = Math.atan2(t.ry, t.rx);
                        u = Math.PI / 2 - se.limitAt(u, 0, se.toRad(90));
                        var h = n - t.rx / 2
                          , p = t.ry / 2
                          , c = Math.max(0, Math.sin(u - Math.atan2(p, h)) * se.distOrigin(h, p))
                          , d = .5 * se.distOrigin(t.rx, t.ry)
                          , f = Math.ceil(n - c * Math.sin(u))
                          , g = Math.ceil(c * Math.cos(u))
                          , v = se.toDeg(u)
                          , m = l ? s ? 90 - v + 180 : 180 + v : s ? v : 90 - v
                          , y = l ? s ? 90 - v + 180 : v : s ? v + 180 : m
                          , b = l ? s ? 90 - v : v + 90 : s ? m - 90 : m + 180
                          , w = s ? n - f : f
                          , P = l ? o + g : -g
                          , S = s ? -f : f - n
                          , C = l ? -o - g : g
                          , T = se.limitAt(.5 * t.distance / n, 0, .5)
                          , x = se.limitAt(.5 * (i.viewer.leftSheetWidth + n - t.rx) / n, .05, .3);
                        i.element.addClass("df-folding");
                        var k = s ? i.backPage.element : i.frontPage.element
                          , E = s ? i.frontPage.element : i.backPage.element
                          , O = i.foldOuterShadow
                          , R = i.foldInnerShadow;
                        i.wrapper.css({
                            transform: se.translateStr(w, P) + se.rotateStr(m)
                        }),
                        E.css({
                            transform: se.rotateStr(-m) + se.translateStr(-w, -P)
                        }),
                        k.css({
                            transform: se.rotateStr(y) + se.translateStr(S, C),
                            boxShadow: "rgba(0, 0, 0, " + T + ") 0px 0px 20px"
                        }),
                        R.css({
                            transform: se.rotateStr(y) + se.translateStr(S, C),
                            opacity: x / 2,
                            backgroundImage: se.prefix.css + "linear-gradient( " + b + "deg, rgba(0, 0, 0, 0.25) , rgb(0, 0, 0) " + .7 * d + "px, rgb(255, 255, 255) " + d + "px)"
                        }),
                        O.css({
                            opacity: x / 2,
                            left: s ? "auto" : 0,
                            right: s ? 0 : "auto",
                            backgroundImage: se.prefix.css + "linear-gradient( " + (180 - b) + "deg, rgba(0, 0, 0,0) " + d / 3 + "px, rgb(0, 0, 0) " + d + "px)"
                        })
                    }
                }
            }, {
                key: "updateAngle",
                value: function(e, t) {
                    var i = this
                      , n = 5 * i.element.width();
                    i.wrapper.css({
                        perspective: n,
                        perspectiveOrigin: !0 === t ? "0% 50%" : "100% 50%"
                    }),
                    i.element.addClass("df-folding"),
                    i.backPage.updateCSS({
                        display: !0 === t ? e <= -90 ? "block" : "none" : e < 90 ? "block" : "none",
                        transform: ("MfS" !== se.prefix.dom ? "" : "perspective(" + n + "px) ") + (!0 === t ? "translateX(-100%) " : "") + "rotateY(" + ((!0 === t ? 180 : 0) + e) + "deg)"
                    }),
                    i.frontPage.updateCSS({
                        display: !0 === t ? e > -90 ? "block" : "none" : e >= 90 ? "block" : "none",
                        transform: ("MSd" !== se.prefix.dom ? "" : "perspective(" + n + "px) ") + (!1 === t ? "translateX(100%) " : "") + "rotateY(" + ((!1 === t ? -180 : 0) + e) + "deg)"
                    })
                }
            }, {
                key: "updateTween",
                value: function(t) {
                    var i = this
                      , n = i.viewer.isBooklet
                      , o = i.side === e.TURN_DIRECTION.RIGHT
                      , a = i.viewer.isRTL
                      , r = !0 === i.animateToReset;
                    !0 === i.isHard ? (i.updateAngle(t.angle, o),
                    i.angle = t.angle) : (i.updatePoint({
                        x: t.x,
                        y: t.y
                    }),
                    i.x = t.x,
                    i.y = t.y),
                    n && !r && (i.element[0].style.opacity = o && !a || !o && a ? t.index > .5 ? 2 * (1 - t.index) : 1 : t.index < .5 ? 2 * t.index : 1)
                }
            }, {
                key: "completeTween",
                value: function() {
                    var e = this;
                    !0 === e.isHard ? (e.updateAngle(e.end.angle),
                    e.backPage.element.css({
                        display: "block"
                    }),
                    e.frontPage.element.css({
                        display: "block"
                    })) : e.updatePoint({
                        x: e.end.x,
                        y: e.end.y
                    }),
                    e.element[0].style.opacity = 1,
                    !0 !== e.animateToReset && (e.side = e.targetSide),
                    e.reset(),
                    e.viewer.onFlip(),
                    e.viewer.afterFlip(),
                    e.viewer.requestRefresh()
                }
            }]),
            n
        }(X)
          , ue = function(t) {
            ie(n, t);
            var i = oe(n);
            function n(t, o) {
                var a, r;
                return $(this, n),
                t.viewerClass = null !== (a = t.viewerClass) && void 0 !== a ? a : "df-flipbook-2d",
                t.skipViewerLoaded = !0,
                (r = i.call(this, t, o)).bookShadow = jQuery("<div>", {
                    class: "df-book-shadow"
                }),
                r.wrapper.append(r.bookShadow),
                r.corner = e.TURN_CORNER.NONE,
                o._viewerPrepared(),
                r
            }
            return te(n, [{
                key: "init",
                value: function() {
                    J(ae(n.prototype), "init", this).call(this),
                    this.initEvents(),
                    this.initPages()
                }
            }, {
                key: "initEvents",
                value: function() {
                    this.stageDOM = this.element[0],
                    J(ae(n.prototype), "initEvents", this).call(this)
                }
            }, {
                key: "dispose",
                value: function() {
                    J(ae(n.prototype), "dispose", this).call(this),
                    this.element.remove()
                }
            }, {
                key: "initPages",
                value: function() {
                    for (var e = 0; e < this.stackCount; e++) {
                        var t = new le({
                            parentElement: this.wrapper
                        });
                        t.index = e,
                        t.viewer = this,
                        this.sheets.push(t),
                        this.pages.push(t.frontPage),
                        this.pages.push(t.backPage)
                    }
                }
            }, {
                key: "resize",
                value: function() {
                    J(ae(n.prototype), "resize", this).call(this);
                    var e = this
                      , t = e.app.dimensions
                      , i = t.padding
                      , o = this.availablePageHeight()
                      , a = this.availablePageWidth()
                      , r = e.fullWidth = 2 * a
                      , s = t.width
                      , l = t.height
                      , u = e.shiftHeight = Math.ceil(se.limitAt((o - l + i.height) / 2, 0, o))
                      , h = e.shiftWidth = Math.ceil(se.limitAt((r - s + i.width) / 2, 0, r));
                    1 === e.app.zoomValue && (e.left = 0,
                    e.top = 0),
                    e.element.css({
                        top: -u,
                        bottom: -u,
                        right: -h,
                        left: -h,
                        paddingTop: i.top,
                        paddingRight: i.right,
                        paddingBottom: i.bottom,
                        paddingLeft: i.left,
                        transform: "translate3d(" + e.left + "px," + e.top + "px,0)"
                    }),
                    e.wrapper.css({
                        marginTop: Math.max(t.height - o - i.height) / 2,
                        height: o,
                        width: r - r % 2
                    }),
                    e.zoomViewer.resize(),
                    e.centerNeedsUpdate = !0,
                    e.checkCenter(!0),
                    e.pagesReady()
                }
            }, {
                key: "updateCenter",
                value: function() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0]
                      , t = this
                      , i = t.centerShift
                      , n = (t.isRTL,
                    i * (this.isLeftPage() ? this.leftSheetWidth : this.rightSheetWidth) / 2);
                    t.seamPosition = (-t.app.dimensions.offset.width + t.app.dimensions.containerWidth) / 2 + n,
                    t.wrapperShift = (t.isSingle ? -t.app.dimensions.stage.innerWidth / 2 : 0) + n,
                    t.wrapper[0].style.left = t.wrapperShift + "px",
                    t.wrapper[0].style.transition = e ? "none" : "",
                    this.zoomViewer.updateCenter()
                }
            }, {
                key: "refreshSheet",
                value: function(e) {
                    var t = e.sheet
                      , i = e.sheetNumber;
                    !1 === t.isFlipping && (e.needsFlip ? (t.element.addClass("df-flipping"),
                    t.flip()) : (t.skipFlip = !1,
                    t.element.removeClass("df-flipping df-quick-turn df-folding df-left-side df-right-side"),
                    t.element.addClass(t.targetSide === re.TURN_DIRECTION.LEFT ? "df-left-side" : "df-right-side"),
                    t.side = t.targetSide,
                    t.targetSide === re.TURN_DIRECTION.LEFT ? t.updateSize(this.leftSheetWidth, this.leftSheetHeight, this.leftSheetTop) : t.updateSize(this.rightSheetWidth, this.rightSheetHeight, this.rightSheetTop))),
                    t.visible = e.visible,
                    t.isHard ? t.element.addClass("df-hard-sheet") : (t.element.removeClass("df-hard-sheet"),
                    t.frontPage.updateCSS({
                        display: "block"
                    }),
                    t.backPage.updateCSS({
                        display: "block"
                    })),
                    t.updateCSS({
                        display: !0 === t.visible ? "block" : "none",
                        zIndex: e.zIndex
                    }),
                    null == t.pendingPoint && !1 === t.isFlipping && t.resetCSS(),
                    i !== t.pageNumber && (t.element.attr("number", i),
                    t.backPage.element.attr("pagenumber", t.backPage.pageNumber),
                    t.frontPage.element.attr("pagenumber", t.frontPage.pageNumber))
                }
            }, {
                key: "eventToPoint",
                value: function(e) {
                    var t = this;
                    e = se.fixMouseEvent(e);
                    var i, n, o, a, r, s, l, u, h, p = t.wrapper[0].getBoundingClientRect(), c = t.is3D, d = t.sheets, f = (t.app.dimensions,
                    {
                        x: e.clientX,
                        y: e.clientY
                    }), g = t.parentElement[0].getBoundingClientRect();
                    f.x = f.x - g.left,
                    f.y = f.y - g.top,
                    i = (h = t.dragSheet ? t.dragSheet.side === re.TURN_DIRECTION.RIGHT : f.x > t.seamPosition) ? t.rightSheetWidth : t.leftSheetWidth,
                    o = h ? t.rightSheetHeight : t.leftSheetHeight,
                    n = t.rightSheetWidth + t.leftSheetWidth,
                    r = h ? t.rightSheetTop : t.leftSheetTop,
                    a = f.x - (t.seamPosition - t.leftSheetWidth),
                    r = f.y - (p.top - g.top) - r,
                    s = t.drag === re.TURN_DIRECTION.NONE ? a < i ? a : n - a : t.drag === re.TURN_DIRECTION.LEFT ? a : n - a,
                    l = h ? d[t.stackCount / 2] : d[t.stackCount / 2 - 1],
                    u = a < t.foldSense ? re.TURN_DIRECTION.LEFT : a > n - t.foldSense ? re.TURN_DIRECTION.RIGHT : re.TURN_DIRECTION.NONE;
                    var v, m = a, y = r, b = o, w = n, P = t.foldSense;
                    return {
                        isInsideSheet: m >= 0 && m <= w && y >= 0 && y <= b,
                        isInsideCorner: (v = m >= 0 && m < P ? y >= 0 && y <= P ? re.TURN_CORNER.TL : y >= b - P && y <= b ? re.TURN_CORNER.BL : y > P && y < b - P ? re.TURN_CORNER.L : re.TURN_CORNER.NONE : m >= w - P && m <= w ? y >= 0 && y <= P ? re.TURN_CORNER.TR : y >= b - P && y <= b ? re.TURN_CORNER.BR : y > P && y < b - P ? re.TURN_CORNER.R : re.TURN_CORNER.NONE : re.TURN_CORNER.NONE) !== re.TURN_CORNER.NONE && v !== re.TURN_CORNER.L && v !== re.TURN_CORNER.R,
                        x: c ? f.x : a,
                        y: c ? f.y : r,
                        fullWidth: n,
                        sheetWidth: i,
                        sheetHeight: o,
                        rawDistance: n - a,
                        distance: s,
                        sheet: l,
                        drag: u,
                        foldSense: t.foldSense,
                        event: e,
                        raw: f,
                        corner: v
                    }
                }
            }, {
                key: "pan",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
                    se.pan(this, e, t)
                }
            }, {
                key: "mouseMove",
                value: function(e) {
                    var t = this
                      , i = t.eventToPoint(e);
                    if (null == e.touches || 2 != e.touches.length) {
                        1 !== t.app.zoomValue && null != t.startPoint && !0 === t.canSwipe && (t.pan(i),
                        e.preventDefault());
                        var n = t.dragSheet || i.sheet;
                        if (null == t.flipPage && (null != t.dragSheet || !0 === i.isInsideCorner)) {
                            null != t.dragSheet || (i.y = se.limitAt(i.y, 1, t.availablePageHeight() - 1),
                            i.x = se.limitAt(i.x, 1, i.fullWidth - 1));
                            var o = null != t.dragSheet ? t.corner : i.corner;
                            if (n.isHard) {
                                var a = o === re.TURN_CORNER.BR || o === re.TURN_CORNER.TR
                                  , r = se.angleByDistance(i.distance, i.fullWidth);
                                n.updateAngle(r * (a ? -1 : 1), a)
                            } else
                                n.updatePoint(i);
                            n.magnetic = !0,
                            n.magneticCorner = i.corner,
                            e.preventDefault()
                        }
                        null == t.dragSheet && null != n && !1 === i.isInsideCorner && !0 === n.magnetic && (n.pendingPoint = i,
                        n.animateToReset = !0,
                        n.magnetic = !1,
                        t.corner = n.magneticCorner,
                        n.flip(n.pendingPoint),
                        n.pendingPoint = null),
                        t.checkSwipe(i, e)
                    } else
                        this.pinchMove(e)
                }
            }, {
                key: "mouseUp",
                value: function(t) {
                    var i = this;
                    if (null != i.startPoint && (t.touches || 0 === t.button))
                        if (null != i.dragSheet || null == t.touches || 0 != t.touches.length) {
                            var n = i.eventToPoint(t)
                              , o = t.target || t.originalTarget
                              , a = 1 === i.app.zoomValue && n.x === i.startPoint.x && n.y === i.startPoint.y && "A" !== o.nodeName;
                            if (!0 === t.ctrlKey && a)
                                this.zoomOnPoint(n);
                            else if (i.dragSheet) {
                                t.preventDefault();
                                var r = i.dragSheet;
                                if (r.pendingPoint = n,
                                i.drag = n.drag,
                                a && (!0 === n.isInsideCorner || n.isInsideSheet && i.clickAction === re.MOUSE_CLICK_ACTIONS.NAV))
                                    n.corner.indexOf("l") > -1 ? i.app.openLeft() : i.app.openRight();
                                else {
                                    var s = this.getBasePage();
                                    n.distance > n.sheetWidth / 2 && (n.sheet.side === e.TURN_DIRECTION.LEFT ? i.app.openLeft() : i.app.openRight()),
                                    s === this.getBasePage() && (r.animateToReset = !0,
                                    r.flip(n))
                                }
                                i.dragSheet = null,
                                r.magnetic = !1
                            } else
                                a && !n.sheet.isFlipping && n.isInsideSheet && i.clickAction === re.MOUSE_CLICK_ACTIONS.NAV && ("left" === n.sheet.side ? i.app.openLeft() : i.app.openRight());
                            i.startPoint = null,
                            i.canSwipe = !1,
                            i.drag = re.TURN_DIRECTION.NONE
                        } else
                            this.pinchUp(t)
                }
            }, {
                key: "mouseDown",
                value: function(e) {
                    if (e.touches || 0 === e.button)
                        if (null == e.touches || 2 != e.touches.length) {
                            var t = this
                              , i = t.eventToPoint(e);
                            t.startPoint = i,
                            t.lastPosX = i.x,
                            t.lastPosY = i.y,
                            i.isInsideCorner && null == t.flipPage ? (t.dragSheet = i.sheet,
                            t.drag = i.drag,
                            t.corner = i.corner,
                            0 === i.sheet.pageNumber ? t.bookShadow.css({
                                width: "50%",
                                left: t.app.isRTL ? 0 : "50%",
                                transitionDelay: ""
                            }) : i.sheet.pageNumber === Math.ceil(t.app.pageCount / 2) - 1 && t.bookShadow.css({
                                width: "50%",
                                left: t.app.isRTL ? "50%" : 0,
                                transitionDelay: ""
                            })) : t.canSwipe = !0
                        } else
                            this.pinchDown(e)
                }
            }, {
                key: "onScroll",
                value: function(e) {}
            }, {
                key: "resetPageTween",
                value: function() {
                    for (var e = this, t = 0; t < e.stackCount; t++) {
                        var i = e.sheets[t];
                        i.currentTween && i.currentTween.complete(!0)
                    }
                    e.requestRefresh()
                }
            }, {
                key: "pagesReady",
                value: function() {
                    if (!this.isFlipping()) {
                        if (!1 === this.app.options.flipbookFitPages) {
                            var e = this.app.viewer.getBasePage()
                              , t = this.leftViewport = this.getViewPort(e + (this.isBooklet ? 0 : this.isRTL ? 1 : 0))
                              , i = this.rightViewPort = this.getViewPort(e + (this.isBooklet || this.isRTL ? 0 : 1));
                            if (t) {
                                var n = se.contain(t.width, t.height, this.availablePageWidth(), this.availablePageHeight());
                                this.leftSheetWidth = Math.floor(n.width),
                                this.leftSheetHeight = Math.floor(n.height),
                                this.leftSheetTop = (this.availablePageHeight() - this.leftSheetHeight) / 2
                            }
                            if (i) {
                                var o = se.contain(i.width, i.height, this.availablePageWidth(), this.availablePageHeight());
                                this.rightSheetWidth = Math.floor(o.width),
                                this.rightSheetHeight = Math.floor(o.height),
                                this.rightSheetTop = (this.availablePageHeight() - this.rightSheetHeight) / 2
                            }
                            this.totalSheetsWidth = this.leftSheetWidth + this.rightSheetWidth;
                            for (var a = 0; a < this.sheets.length; a++) {
                                var r = this.sheets[a];
                                r.side === re.TURN_DIRECTION.LEFT ? r.updateSize(this.leftSheetWidth, this.leftSheetHeight, this.leftSheetTop) : r.updateSize(this.rightSheetWidth, this.rightSheetHeight, this.rightSheetTop)
                            }
                        }
                        this.updateCenter(),
                        this.updatePendingStatusClass()
                    }
                }
            }, {
                key: "textureLoadedCallback",
                value: function(e) {
                    this.getPageByNumber(e.pageNumber);
                    this.pagesReady()
                }
            }]),
            n
        }(K);
        function he(e) {
            return he = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            he(e)
        }
        function pe() {
            return pe = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = ye(e)); )
                        ;
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(arguments.length < 3 ? e : i) : o.value
                }
            }
            ,
            pe.apply(this, arguments)
        }
        function ce(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function de(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== he(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== he(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === he(a) ? a : String(a)), n)
            }
            var o, a
        }
        function fe(e, t, i) {
            return t && de(e.prototype, t),
            i && de(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        function ge(e, t) {
            if ("function" != typeof t && null !== t)
                throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            t && ve(e, t)
        }
        function ve(e, t) {
            return ve = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            ve(e, t)
        }
        function me(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = ye(e);
                if (t) {
                    var o = ye(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === he(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return function(e) {
                        if (void 0 === e)
                            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                        return e
                    }(e)
                }(this, i)
            }
        }
        function ye(e) {
            return ye = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            ye(e)
        }
        var be = e.utils
          , we = function(e) {
            ge(i, e);
            var t = me(i);
            function i() {
                return ce(this, i),
                t.apply(this, arguments)
            }
            return fe(i, [{
                key: "init",
                value: function() {
                    var e = this
                      , t = e.element = jQuery("<div>", {
                        class: "df-sheet"
                    });
                    (e.frontPage = new O).element.addClass("df-page-front").appendTo(e.element),
                    (e.backPage = new O).element.addClass("df-page-back").appendTo(e.element),
                    this.parentElement.append(t),
                    this.frontPage.sheet = this.backPage.sheet = this
                }
            }, {
                key: "completeTween",
                value: function() {
                    var e = this;
                    e.isFlipping = !1,
                    e.viewer.onFlip(),
                    e.viewer.afterFlip(),
                    e.viewer.requestRefresh(),
                    e.element[0].style.opacity = 1
                }
            }, {
                key: "flip",
                value: function(e) {
                    this.side = this.targetSide,
                    this.completeTween()
                }
            }, {
                key: "updateSize",
                value: function(e, t, i) {
                    e = Math.floor(e),
                    t = Math.floor(t),
                    i = Math.floor(i),
                    this.element[0].style.height = this.frontPage.element[0].style.height = t + "px",
                    this.element[0].style.width = this.frontPage.element[0].style.width = e + "px",
                    this.element[0].style.transform = "translateX(" + this.positionX + "px) translateY(" + i + "px)"
                }
            }]),
            i
        }(le)
          , Pe = function(t) {
            ge(n, t);
            var i = me(n);
            function n(t, o) {
                var a;
                return ce(this, n),
                t.viewerClass = "df-slider",
                t.pageMode = e.FLIPBOOK_PAGE_MODE.SINGLE,
                t.singlePageMode = e.FLIPBOOK_SINGLE_PAGE_MODE.BOOKLET,
                t.pageSize = e.FLIPBOOK_PAGE_SIZE.SINGLE,
                (a = i.call(this, t, o)).stackCount = 10,
                a.soundOn = !1,
                a.foldSense = 0,
                o._viewerPrepared(),
                a
            }
            return fe(n, [{
                key: "initPages",
                value: function() {
                    for (var e = 0; e < this.stackCount; e++) {
                        var t = new we({
                            parentElement: this.wrapper
                        });
                        t.index = e,
                        t.viewer = this,
                        this.sheets.push(t),
                        this.pages.push(t.frontPage),
                        this.pages.push(t.backPage)
                    }
                }
            }, {
                key: "resize",
                value: function() {
                    pe(ye(n.prototype), "resize", this).call(this),
                    this.skipTransition = !0
                }
            }, {
                key: "refreshSheet",
                value: function(t) {
                    var i = t.sheet
                      , n = t.sheetNumber;
                    i.element.toggleClass("df-no-transition", i.skipFlip || this.skipTransition),
                    !1 === i.isFlipping && (t.needsFlip ? i.flip() : (i.skipFlip = !1,
                    i.element.removeClass("df-flipping df-quick-turn df-folding df-left-side df-right-side"),
                    i.element.addClass(i.targetSide === e.TURN_DIRECTION.LEFT ? "df-left-side" : "df-right-side"),
                    i.side = i.targetSide)),
                    i.visible = t.visible,
                    i.updateCSS({
                        display: t.sheetNumber > 0 && t.sheetNumber <= this.app.pageCount ? "block" : "none",
                        zIndex: t.zIndex
                    }),
                    n !== i.pageNumber && (i.element.attr("number", n),
                    i.backPage.element.attr("pagenumber", i.backPage.pageNumber),
                    i.frontPage.element.attr("pagenumber", i.frontPage.pageNumber))
                }
            }, {
                key: "refresh",
                value: function() {
                    pe(ye(n.prototype), "refresh", this).call(this),
                    this.skipTransition = !1
                }
            }, {
                key: "eventToPoint",
                value: function(e) {
                    var t = pe(ye(n.prototype), "eventToPoint", this).call(this, e);
                    return t.isInsideSheet = jQuery(e.srcElement).closest(".df-page").length > 0,
                    t.isInsideCorner = !1,
                    t
                }
            }, {
                key: "initCustomControls",
                value: function() {
                    var e = this.app.ui.controls;
                    e.pageMode && e.pageMode.hide()
                }
            }, {
                key: "setPageMode",
                value: function(e) {
                    e.isSingle = !0,
                    pe(ye(n.prototype), "setPageMode", this).call(this, e)
                }
            }, {
                key: "pagesReady",
                value: function() {
                    if (!this.isFlipping()) {
                        for (var e = 0, t = 0, i = this.app, n = (Math.floor(this.stackCount / 2),
                        []), o = i.currentPageNumber, a = 0; a < this.stackCount / 2; a++)
                            n.push(o + a),
                            n.push(o - a - 1);
                        for (var r = 0; r < this.stackCount; r++) {
                            var s = n[r];
                            if (this.getPageByNumber(s)) {
                                var l = this.getPageByNumber(s).sheet
                                  , u = this.getViewPort(l.pageNumber, !0)
                                  , h = be.contain(u.width, u.height, this.availablePageWidth(), this.availablePageHeight());
                                i.currentPageNumber === l.pageNumber && (this.leftSheetWidth = this.rightSheetWidth = Math.floor(h.width)),
                                i.currentPageNumber > l.pageNumber ? (e -= Math.floor(h.width) + 10,
                                l.positionX = e) : (l.positionX = t,
                                t += Math.floor(h.width) + 10);
                                var p = (this.availablePageHeight() - h.height) / 2;
                                l.updateSize(Math.floor(h.width * i.zoomValue), Math.floor(h.height * i.zoomValue), p)
                            }
                        }
                        this.updateCenter(),
                        this.updatePendingStatusClass()
                    }
                }
            }]),
            n
        }(ue);
        function Se(e) {
            return Se = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            Se(e)
        }
        function Ce() {
            return Ce = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = Ne(e)); )
                        ;
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(arguments.length < 3 ? e : i) : o.value
                }
            }
            ,
            Ce.apply(this, arguments)
        }
        function Te(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function xe(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== Se(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== Se(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === Se(a) ? a : String(a)), n)
            }
            var o, a
        }
        function ke(e, t, i) {
            return t && xe(e.prototype, t),
            i && xe(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        function Ee(e, t) {
            if ("function" != typeof t && null !== t)
                throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            t && Oe(e, t)
        }
        function Oe(e, t) {
            return Oe = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            Oe(e, t)
        }
        function Re(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = Ne(e);
                if (t) {
                    var o = Ne(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === Se(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return Le(e)
                }(this, i)
            }
        }
        function Le(e) {
            if (void 0 === e)
                throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }
        function Ne(e) {
            return Ne = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            Ne(e)
        }
        var Ie = e
          , _e = Ie.utils
          , Ae = function(e) {
            Ee(i, e);
            var t = Re(i);
            function i(e) {
                var n;
                return Te(this, i),
                (n = t.call(this, e)).flexibility = e.flexibility,
                n.sheetAngle = 180,
                n.curveAngle = 0,
                n.parent3D = e.parent3D,
                n.segments = e.segments || 50,
                n.width = e.width || 100,
                n.height = e.height || 100,
                n.depth = e.depth || .5,
                n.matColor = "white",
                n.fallbackMatColor = Fe.WHITE_COLOR,
                n.init(),
                n.bumpScale = [0, 0, 0, 0, 1, 1],
                n
            }
            return ke(i, [{
                key: "init",
                value: function() {
                    var e = this;
                    e.element = new Fe.Paper({
                        parent3D: e.parent3D,
                        segments: e.segments,
                        depth: e.depth,
                        height: e.height,
                        width: e.width,
                        flatShading: 0 === e.flexibility
                    }),
                    e.element.sheet = e,
                    e.frontPage = new De({
                        sheet: e,
                        face: 5
                    }),
                    e.backPage = new De({
                        sheet: e,
                        face: 4
                    }),
                    e.reset(),
                    e.updateAngle()
                }
            }, {
                key: "setMatColor",
                value: function(e, t) {
                    if (this.matColor = new THREE.Color(e),
                    void 0 === t)
                        for (var i = 0; i < 6; i++)
                            this.element.material[i].color = this.matColor;
                    else
                        this.element.material[t].color = this.matColor
                }
            }, {
                key: "getBumpScale",
                value: function(e) {
                    return this.bumpScale[e]
                }
            }, {
                key: "resetMatColor",
                value: function(e, t) {
                    this.element.material[e].color = t ? this.matColor : this.fallbackMatColor
                }
            }, {
                key: "frontImage",
                value: function(e, t) {
                    this.element.frontImage(e, t)
                }
            }, {
                key: "backImage",
                value: function(e, t) {
                    this.element.backImage(e, t)
                }
            }, {
                key: "updateAngle",
                value: function() {
                    var e = this;
                    if (void 0 !== this.viewer && null !== this.viewer) {
                        var t = !0 === e.isHard ? 0 : e.flexibility
                          , i = ("vertical" === this.viewer.orientation ? this.height : this.width) * (1 - Math.sin(t / 2 * (t / 2)) / 2 - t / 20);
                        this.element.scale.y = ("vertical" === this.viewer.orientation ? this.width : this.height) / this.element.geometry.parameters.height;
                        var n = e.segments
                          , o = i / 1
                          , a = o * t
                          , r = o
                          , s = []
                          , l = []
                          , u = []
                          , h = []
                          , p = []
                          , c = []
                          , d = e.depth
                          , f = 0
                          , g = [];
                        g.push(f),
                        p[0] = [],
                        c[0] = [];
                        var v = e.sheetAngle * Math.PI / 180;
                        "vertical" !== this.viewer.orientation && (this.element.position.x = -Math.cos(v) * this.viewer.pageOffset),
                        "vertical" === this.viewer.orientation && (this.element.position.y = Math.cos(v) * this.viewer.pageOffset);
                        var m = !0 === e.isHard ? v : e.curveAngle * Math.PI / 180
                          , y = e.sheetAngle * Math.PI / 180
                          , b = y - Math.PI / 2
                          , w = Math.sin(b) * d / 2;
                        p[0][0] = p[0][1] = new THREE.Vector3(-r * Math.cos(v),0,Math.sin(v) * r - w),
                        c[0][0] = c[0][1] = new THREE.Vector3(p[0][0].x - Math.cos(b) * d,0,p[0][0].z + 2 * w),
                        p[0][1] = new THREE.Vector3(-r / 2 * Math.cos(m),0,r / 2 * Math.sin(m) - w),
                        c[0][1] = new THREE.Vector3(p[0][1].x - Math.cos(b) * d,0,p[0][1].z + 2 * w),
                        y = (45 + e.sheetAngle / 2) * Math.PI / 180,
                        p[0][2] = new THREE.Vector3(-Math.cos(y) * a / 2,0,Math.sin(y) * a - w),
                        c[0][2] = new THREE.Vector3(p[0][2].x + Math.cos(b) * d,0,p[0][2].z + 2 * w),
                        Math.abs(c[0][2].x - 0) < 5e-4 && (c[0][2].x = 0),
                        p[0][3] = new THREE.Vector3(0,0,-w),
                        c[0][3] = new THREE.Vector3(p[0][3].x - Math.cos(b) * d,0,p[0][3].z + 2 * w),
                        Math.abs(c[0][3].x - 0) < 5e-4 && (c[0][3].x = 0);
                        for (var P = 0; P < 1; P++) {
                            var S = Math.max(e.segments - 1, 1);
                            s[P] = new THREE.CubicBezierCurve3(p[P][0],p[P][1],p[P][2],p[P][3]),
                            u[P] = s[P].getPoints(S),
                            S > 2 && u[P].push((new THREE.Vector3).copy(u[P][S]));
                            for (var C = void 0, T = u[P][0], x = 1; x < u[P].length; x++)
                                f += (C = u[P][x]).distanceTo(T),
                                g.push(f),
                                T = C;
                            l[P] = new THREE.CubicBezierCurve3(c[P][0],c[P][1],c[P][2],c[P][3]),
                            h[P] = l[P].getPoints(S),
                            S > 2 && h[P].push((new THREE.Vector3).copy(h[P][S]))
                        }
                        var k = e.element.geometry;
                        if (void 0 !== k.attributes) {
                            var E = k.attributes.position
                              , O = k.attributes.uv
                              , R = n + 1;
                            E.setZ(0, u[0][n].z),
                            E.setZ(2, u[0][n].z),
                            E.setX(0, u[0][n].x),
                            E.setX(2, u[0][n].x),
                            E.setZ(1, h[0][n].z),
                            E.setZ(3, h[0][n].z),
                            E.setX(1, h[0][n].x),
                            E.setX(3, h[0][n].x),
                            E.setZ(5, u[0][0].z),
                            E.setZ(7, u[0][0].z),
                            E.setX(5, u[0][0].x),
                            E.setX(7, u[0][0].x),
                            E.setZ(4, h[0][0].z),
                            E.setZ(6, h[0][0].z),
                            E.setX(4, h[0][0].x),
                            E.setX(6, h[0][0].x);
                            for (var L = 0; L < 1; L++)
                                for (var N = 0; N < R; N++)
                                    E.setZ(8 + 0 * R + N, u[0][N].z),
                                    E.setX(8 + 0 * R + N, u[0][N].x),
                                    E.setZ(8 + 1 * R + N, h[0][N].z),
                                    E.setX(8 + 1 * R + N, h[0][N].x),
                                    E.setZ(8 + 2 * R + N, u[0][N].z),
                                    E.setX(8 + 2 * R + N, u[0][N].x),
                                    E.setZ(8 + 3 * R + N, h[0][N].z),
                                    E.setX(8 + 3 * R + N, h[0][N].x),
                                    E.setZ(8 + 4 * R + N, u[0][N].z),
                                    E.setX(8 + 4 * R + N, u[0][N].x),
                                    E.setZ(8 + 5 * R + N, u[0][N].z),
                                    E.setX(8 + 5 * R + N, u[0][N].x),
                                    O.setX(8 + 4 * R + N, g[N] / f),
                                    O.setX(8 + 5 * R + N, g[N] / f),
                                    E.setZ(8 + 6 * R + N, h[0][n - N].z),
                                    E.setX(8 + 6 * R + N, h[0][n - N].x),
                                    E.setZ(8 + 7 * R + N, h[0][n - N].z),
                                    E.setX(8 + 7 * R + N, h[0][n - N].x),
                                    O.setX(8 + 6 * R + N, 1 - g[n - N] / f),
                                    O.setX(8 + 7 * R + N, 1 - g[n - N] / f);
                            k.computeBoundingBox(),
                            e.element.scale.x = 1 * r / f,
                            k.computeBoundingSphere(),
                            E.needsUpdate = !0,
                            O.needsUpdate = !0,
                            k.computeVertexNormals()
                        } else {
                            var I = k.vertices
                              , _ = n - 1
                              , A = 8;
                            I[0].z = I[2].z = u[0][n].z,
                            I[0].x = I[2].x = u[0][n].x,
                            I[1].z = I[3].z = h[0][n].z,
                            I[1].x = I[3].x = h[0][n].x,
                            I[5].z = I[7].z = u[0][0].z,
                            I[5].x = I[7].x = u[0][0].x,
                            I[4].z = I[6].z = h[0][0].z,
                            I[4].x = I[6].x = h[0][0].x;
                            for (var M = 0; M < 1; M++)
                                for (var D = 1; D < n; D++)
                                    I[A].z = I[A + 3 * _].z = h[0][D].z,
                                    I[A].x = I[A + 3 * _].x = h[0][D].x,
                                    I[A + _].z = I[A + 2 * _].z = u[0][D].z,
                                    I[A + _].x = I[A + 2 * _].x = u[0][D].x,
                                    A++;
                            for (var F = k.faceVertexUvs[0], z = k.faces, B = 0, H = 0; H < F.length; H++)
                                if (z[H].materialIndex === Fe.MATERIAL_FACE.BACK) {
                                    var U = g[B] / f;
                                    H % 2 == 0 ? (F[H][0].x = F[H][1].x = F[H + 1][0].x = U,
                                    B++) : F[H - 1][2].x = F[H][1].x = F[H][2].x = U
                                } else if (z[H].materialIndex === Fe.MATERIAL_FACE.FRONT) {
                                    var j = 1 - g[B] / f;
                                    H % 2 == 0 ? (F[H][0].x = F[H][1].x = F[H + 1][0].x = j,
                                    B--) : F[H - 1][2].x = F[H][1].x = F[H][2].x = j
                                }
                            k.computeBoundingBox(),
                            e.element.scale.x = 1 * r / f,
                            k.computeBoundingSphere(),
                            k.verticesNeedUpdate = !0,
                            k.computeFaceNormals(),
                            k.computeVertexNormals(),
                            k.uvsNeedUpdate = !0,
                            k.normalsNeedUpdate = !0
                        }
                        s.forEach((function(e) {
                            null
                        }
                        )),
                        l.forEach((function(e) {
                            null
                        }
                        )),
                        h.forEach((function(e) {
                            null
                        }
                        )),
                        u.forEach((function(e) {
                            null
                        }
                        ))
                    }
                }
            }, {
                key: "flip",
                value: function(e, t) {
                    var i = this
                      , n = i.viewer.isBooklet;
                    1 == i.isCover && (0 === e && (e = 2.5 * i.viewer.flexibility),
                    180 === e && (e -= 2.5 * i.viewer.flexibility));
                    var o = t - e
                      , a = e > 90
                      , r = i.viewer.isRTL
                      , s = a ? i.backPage.pageNumber : i.frontPage.pageNumber
                      , l = this.viewer.getViewPort(s);
                    l && (l = _e.contain(l.width, l.height, i.viewer.availablePageWidth(), i.viewer.availablePageHeight()));
                    var u = -(i.viewer.has3DCover && i.viewer.isClosedPage() ? i.viewer.coverExtraWidth : 0)
                      , h = -(i.viewer.has3DCover && i.viewer.isClosedPage() ? i.viewer.coverExtraHeight : 0);
                    i.init = {
                        angle: e,
                        angle2: a ? 180 : 0,
                        height: a ? i.viewer.rightSheetHeight : i.viewer.leftSheetHeight,
                        width: a ? i.viewer.rightSheetWidth : i.viewer.leftSheetWidth,
                        index: a && !r || !a && r ? 1 : 0,
                        _index: 0
                    },
                    i.first = {
                        angle: e + o / 4,
                        angle2: 90,
                        index: a && !r || !a && r ? 1 : .25
                    },
                    i.mid = {
                        angle: e + 2 * o / 4,
                        angle2: a ? 45 : 135,
                        index: .5
                    },
                    i.mid2 = {
                        angle: e + 3 * o / 4,
                        angle2: a ? 0 : 180,
                        index: a && !r || !a && r ? .25 : 1
                    },
                    i.end = {
                        angle: t,
                        angle2: a ? 0 : 180,
                        index: a && !r || !a && r ? 0 : 1,
                        height: h + (l ? l.height : i.height),
                        width: u + (l ? l.width : i.width)
                    },
                    i.isFlipping = !0;
                    n && (!a && !r || a && r) && (i.element.material[5].opacity = i.element.material[4].opacity = 0,
                    i.element.castShadow = !1),
                    i.currentTween = new TWEEN.Tween(i.init).to({
                        angle: [i.first.angle, i.mid.angle, i.mid2.angle, i.end.angle],
                        angle2: [i.first.angle2, i.mid.angle2, i.mid2.angle2, i.end.angle2],
                        index: [i.first.index, i.mid.index, i.mid2.index, i.end.index],
                        _index: 1,
                        height: i.end.height,
                        width: i.end.width
                    }, i.viewer.app.options.duration).onUpdate((function(e) {
                        !function(e) {
                            i.sheetAngle = e.angle,
                            i.curveAngle = i.isHard ? e.angle : e.angle2,
                            !0 === i.isHard ? (i.flexibility = 0,
                            i.isCover && i.viewer.flipCover(i)) : i.flexibility = e.angle < 90 ? i.leftFlexibility : i.rightFlexibility,
                            i.element.position.z = (e.angle < 90 ? i.leftPos : i.rightPos) + i.depth,
                            n && (i.element.material[5].opacity = i.element.material[4].opacity = e.index,
                            i.element.castShadow = e.index > .5),
                            i.height = e.height,
                            i.width = e.width,
                            i.updateAngle(!0)
                        }(this)
                    }
                    )).easing(TWEEN.Easing.Sinusoidal.Out).onStop((function() {
                        i.currentTween = null,
                        i.isFlipping = !1,
                        i.isCover && (i.viewer.leftCover.isFlipping = !1,
                        i.viewer.rightCover.isFlipping = !1),
                        i.element.material[5].opacity = i.element.material[4].opacity = 1
                    }
                    )).onComplete((function() {
                        i.updateAngle(),
                        i.element.material[5].opacity = i.element.material[4].opacity = 1,
                        i.element.castShadow = !0,
                        i.isFlipping = !1,
                        i.isCover && (i.viewer.leftCover.isFlipping = !1,
                        i.viewer.rightCover.isFlipping = !1),
                        i.side = i.targetSide,
                        i.viewer.onFlip(),
                        i.viewer.afterFlip(),
                        i.currentTween = null,
                        i.viewer && i.viewer.requestRefresh && i.viewer.requestRefresh()
                    }
                    )).start(),
                    i.currentTween.update(window.performance.now())
                }
            }]),
            i
        }(X)
          , Me = function(t) {
            Ee(n, t);
            var i = Re(n);
            function n(e, t) {
                var o, a, r, s, l;
                return Te(this, n),
                e.viewerClass = "df-flipbook-3d",
                (l = i.call(this, e, t)).pageOffset = 5,
                l.spiralCount = 20,
                l.groundDistance = null !== (o = e.groundDistance) && void 0 !== o ? o : 2,
                l.hasSpiral = "true" === e.hasSpiral || !0 === e.hasSpiral,
                l.flexibility = _e.limitAt(null !== (a = e.flexibility) && void 0 !== a ? a : .9, 0, 10),
                l.hasSpiral && (l.flexibility = 0),
                0 == l.flexibility && (e.sheetSegments = 8),
                l.drag3D = !1,
                l.texturePowerOfTwo = !_e.isMobile && (null === (r = e.texturePowerOfTwo) || void 0 === r || r),
                l.color3DSheets = null !== (s = l.app.options.color3DSheets) && void 0 !== s ? s : "white",
                l.midPosition = 0,
                l.initMOCKUP((function() {
                    t._viewerPrepared()
                }
                )),
                l
            }
            return ke(n, [{
                key: "initMOCKUP",
                value: function(e) {
                    var t = this.app;
                    "undefined" == typeof THREE ? (t.updateInfo(t.options.text.loading + " WEBGL 3D ..."),
                    "function" == typeof window.define && window.define.amd && window.requirejs ? (window.requirejs.config({
                        paths: {
                            three: t.options.threejsSrc.replace(".js", "")
                        },
                        shim: {
                            three: {
                                exports: "THREE"
                            }
                        }
                    }),
                    window.require(["three"], (function(t) {
                        return window.THREE = t,
                        Fe.init(),
                        "function" == typeof e && e(),
                        t
                    }
                    ))) : "function" == typeof window.define && window.define.amd ? window.require(["three", t.options.threejsSrc.replace(".js", "")], (function(t) {
                        t((function() {
                            Fe.init(),
                            "function" == typeof e && e()
                        }
                        ))
                    }
                    )) : _e.getScript(t.options.threejsSrc + "?ver=" + Ie.version, (function() {
                        Fe.init(),
                        "function" == typeof e && e()
                    }
                    ), (function() {
                        t.updateInfo("Unable to load THREE.js...")
                    }
                    ))) : (Fe.init(),
                    "function" == typeof e && e())
                }
            }, {
                key: "init",
                value: function() {
                    var e = this.app;
                    Ce(Ne(n.prototype), "init", this).call(this);
                    e.provider.defaultPage.pageRatio;
                    this.pageScaleX = 1,
                    this.initDepth(),
                    this.initStage(),
                    this.initPages(),
                    this.initEvents(),
                    this.render()
                }
            }, {
                key: "updatePageMode",
                value: function() {
                    Ce(Ne(n.prototype), "updatePageMode", this).call(this);
                    var t = this.app;
                    this.has3DCover = t.options.cover3DType !== e.FLIPBOOK_COVER_TYPE.NONE && t.pageCount > 7 && !this.isBooklet,
                    this.has3DCover && "none" === t.options.flipbookHardPages && (t.options.flipbookHardPages = "cover")
                }
            }, {
                key: "initDepth",
                value: function() {
                    var e, t;
                    this.sheetDepth = this.pageScaleX * (null !== (e = this.app.options.sheetDepth) && void 0 !== e ? e : .5),
                    this.sheetSegments = null !== (t = this.app.options.sheetSegments) && void 0 !== t ? t : 20,
                    this.coverDepth = 2 * this.sheetDepth,
                    this.sheetsDepth = Math.min(10, this.app.pageCount / 4) * this.sheetDepth
                }
            }, {
                key: "initStage",
                value: function() {
                    var e = this
                      , t = e.stage = new Fe.Stage({
                        pixelRatio: e.app.options.pixelRatio
                    });
                    (t.canvas = jQuery(t.renderer.domElement).addClass("df-3dcanvas")).appendTo(this.element),
                    t.camera.position.set(0, 0, 600),
                    t.camera.lookAt(new THREE.Vector3(0,0,0)),
                    e.camera = t.camera,
                    t.spotLight.position.set(-220, 220, 550),
                    t.spotLight.castShadow = !_e.isMobile && e.app.options.has3DShadow,
                    t.spotLight.shadow && (t.spotLight.shadow.bias = -.005),
                    t.ambientLight.color = new THREE.Color("#fff"),
                    t.ambientLight.intensity = .82;
                    var i = new THREE.ShadowMaterial;
                    i.opacity = e.app.options.shadowOpacity,
                    t.ground.oldMaterial = t.ground.material,
                    t.ground.material = i,
                    t.ground.position.z = this.has3DCover ? -6 : -4,
                    t.selectiveRendering = !0;
                    var n = t.cssRenderer = new THREE.CSS3DRenderer;
                    jQuery(n.domElement).css({
                        position: "absolute",
                        top: 0,
                        pointerEvents: "none"
                    }).addClass("df-3dcanvas df-csscanvas"),
                    e.element[0].appendChild(n.domElement),
                    t.cssScene = new THREE.Scene,
                    e.wrapper.remove(),
                    e.wrapper = new THREE.Group,
                    e.stage.add(e.wrapper),
                    e.wrapper.add(t.ground),
                    e.bookWrapper = new THREE.Group,
                    e.bookWrapper.name = "bookwrapper",
                    e.wrapper.add(e.bookWrapper),
                    e.bookHelper = t.bookHelper = new THREE.BoxHelper(e.bookWrapper,16776960),
                    t.add(e.bookHelper),
                    e.bookHelper.visible = !1,
                    e.cameraWrapper = new THREE.Group,
                    e.cameraWrapper.add(t.camera),
                    t.add(e.cameraWrapper),
                    e.app.renderRequestStatus = Ie.REQUEST_STATUS.ON
                }
            }, {
                key: "initPages",
                value: function() {
                    for (var e = {
                        parent3D: this.bookWrapper,
                        viewer: this,
                        segments: this.sheetSegments,
                        depth: this.sheetDepth,
                        flexibility: this.flexibility
                    }, t = 0; t < this.stackCount; t++) {
                        var i = new Ae(e);
                        i.index = t,
                        i.viewer = this,
                        this.sheets.push(i),
                        i.setMatColor(this.color3DSheets),
                        this.pages.push(i.frontPage),
                        this.pages.push(i.backPage),
                        this.stage.cssScene.add(i.frontPage.cssPage),
                        this.stage.cssScene.add(i.backPage.cssPage)
                    }
                    e.depth = this.sheetsDepth,
                    e.segments = 1,
                    e.flexibility = 0,
                    this.leftSheets = new Ae(e),
                    this.rightSheets = new Ae(e),
                    this.leftSheets.setMatColor(this.color3DSheets),
                    this.rightSheets.setMatColor(this.color3DSheets),
                    e.depth = this.coverDepth,
                    this.leftCover = new Ae(e),
                    this.rightCover = new Ae(e),
                    this.leftCover.isHard = !0,
                    this.rightCover.isHard = !0,
                    this.set3DCoverNormal(),
                    this.setcolor3DCover(this.app.options.color3DCover),
                    this.stage.cssScene.add(this.leftCover.frontPage.cssPage),
                    this.stage.cssScene.add(this.rightCover.backPage.cssPage),
                    this.zoomViewer.leftPage.element.css({
                        backgroundColor: this.color3DSheets
                    }),
                    this.zoomViewer.rightPage.element.css({
                        backgroundColor: this.color3DSheets
                    }),
                    "vertical" === this.orientation && this.bookWrapper.children.forEach((function(e) {
                        e.rotateZ(THREE.MathUtils.degToRad(-90)),
                        e.textureCenter = new THREE.Vector2(.5,.5),
                        e.textureRotation = 90
                    }
                    )),
                    this.initSpiral()
                }
            }, {
                key: "initSpiral",
                value: function() {
                    var e;
                    if (this.app.pageCount < 3 && (this.hasSpiral = !1),
                    !0 === this.hasSpiral) {
                        this.spirals = new THREE.Group,
                        this.leftHoles = new THREE.Group,
                        this.rightHoles = new THREE.Group,
                        this.spiralGroup = new THREE.Group;
                        var t = new THREE.TorusGeometry(30,2,6,20)
                          , i = new THREE.MeshPhongMaterial({
                            color: null !== (e = this.app.options.spiralColor) && void 0 !== e ? e : 8947848
                        })
                          , n = new THREE.Mesh(t,i);
                        n.castShadow = !0,
                        n.rotateX(-THREE.MathUtils.degToRad(-90));
                        for (var o = new THREE.Mesh(new THREE.BoxGeometry(8,15,5,1,1,1),new THREE.MeshBasicMaterial({
                            color: 4473924
                        })), a = new THREE.Mesh(new THREE.BoxGeometry(8,15,5,1,1,1),new THREE.MeshBasicMaterial({
                            color: 4473924
                        })), r = 0; r < this.spiralCount; r++) {
                            var s = 935 * r / this.spiralCount - 467.5 + 935 / this.spiralCount / 2
                              , l = n.clone();
                            l.position.y = s - 4,
                            this.spirals.add(l),
                            (l = n.clone()).position.y = s + 4,
                            this.spirals.add(l),
                            (l = o.clone()).position.y = s,
                            l.position.x = -28,
                            this.leftHoles.add(l),
                            (l = a.clone()).position.y = s,
                            l.position.x = 28,
                            this.rightHoles.add(l)
                        }
                        this.spiralGroup.add(this.spirals),
                        this.spiralGroup.add(this.leftHoles),
                        this.spiralGroup.add(this.rightHoles),
                        this.bookWrapper.add(this.spiralGroup),
                        "vertical" === this.orientation && this.spiralGroup.rotateZ(THREE.MathUtils.degToRad(-90)),
                        this.spiralGroup.scale.set(.1, .1, .1)
                    }
                }
            }, {
                key: "set3DCoverNormal",
                value: function() {
                    var t = this.app.options.cover3DType;
                    if (t !== e.FLIPBOOK_COVER_TYPE.PLAIN) {
                        var i, n = t == e.FLIPBOOK_COVER_TYPE.RIDGE;
                        this.hasSpiral && 1 == n && (n = !1),
                        this.leftCover.fallbackMatColor = new THREE.Color("#f7f7f7"),
                        this.rightCover.fallbackMatColor = new THREE.Color("#f7f7f7"),
                        this.leftCover.setMatColor(this.color3DSheets, 5),
                        this.rightCover.setMatColor(this.color3DSheets, 4);
                        var o = 128
                          , a = "rgb(127,127,255)"
                          , r = document.createElement("canvas");
                        r.height = o,
                        r.width = o;
                        var s = r.getContext("2d");
                        s.fillStyle = a,
                        s.fillRect(0, 0, o, o);
                        var l = 1.92;
                        (i = s.createLinearGradient(0, 0, l, 0)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(127,255,255)"),
                        s.fillStyle = i,
                        s.beginPath(),
                        s.moveTo(0, 0),
                        s.lineTo(l, l),
                        s.lineTo(l, 126.08),
                        s.lineTo(0, 126.08),
                        s.closePath(),
                        s.fill(),
                        n && ((i = s.createLinearGradient(l, 0, 7.68, 0)).addColorStop(0, "rgb(127,127,255)"),
                        i.addColorStop(.25, "rgb(255,127,255)"),
                        i.addColorStop(.5, "rgb(0,127,255)"),
                        i.addColorStop(.75, "rgb(127,127,255)"),
                        i.addColorStop(1, "rgb(127,127,255)"),
                        s.fillStyle = i,
                        s.fillRect(l, 0, 7.68, o)),
                        (i = s.createLinearGradient(0, l, 0, 0)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(127,255,255)"),
                        s.fillStyle = i,
                        s.beginPath(),
                        s.moveTo(n ? 5.76 : l, 0),
                        s.lineTo(o, 0),
                        s.lineTo(126.08, l),
                        s.lineTo(n ? 7.68 : l, l),
                        s.closePath(),
                        s.fill(),
                        (i = s.createLinearGradient(126.08, 0, o, 0)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(255,127,255)"),
                        s.fillStyle = i,
                        s.beginPath(),
                        s.moveTo(126.08, l),
                        s.lineTo(o, 0),
                        s.lineTo(o, o),
                        s.lineTo(126.08, 126.08),
                        s.closePath(),
                        s.fill(),
                        (i = s.createLinearGradient(0, 126.08, 0, o)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(127,0,255)"),
                        s.fillStyle = i,
                        s.beginPath(),
                        s.moveTo(n ? 7.68 : l, 126.08),
                        s.lineTo(126.08, 126.08),
                        s.lineTo(o, o),
                        s.lineTo(n ? 5.76 : l, o),
                        s.closePath(),
                        s.fill(),
                        this.leftCover.element.loadNormalMap(r, Fe.MATERIAL_FACE.FRONT);
                        var u = document.createElement("canvas");
                        u.height = o,
                        u.width = o;
                        var h = u.getContext("2d");
                        h.fillStyle = a,
                        h.fillRect(0, 0, o, o),
                        (i = h.createLinearGradient(126.08, 0, o, 0)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(255,127,255)"),
                        h.fillStyle = i,
                        h.beginPath(),
                        h.moveTo(126.08, l),
                        h.lineTo(o, 0),
                        h.lineTo(o, o),
                        h.lineTo(126.08, 126.08),
                        h.closePath(),
                        h.fill(),
                        n && ((i = h.createLinearGradient(120.32, 0, 126.08, 0)).addColorStop(0, "rgb(127,127,255)"),
                        i.addColorStop(.25, "rgb(127,127,255)"),
                        i.addColorStop(.5, "rgb(255,127,255)"),
                        i.addColorStop(.75, "rgb(0,127,255)"),
                        i.addColorStop(1, "rgb(127,127,255)"),
                        h.fillStyle = i,
                        h.fillRect(120.32, 0, 5.76, o)),
                        (i = h.createLinearGradient(0, l, 0, 0)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(127,255,255)"),
                        h.fillStyle = i,
                        h.beginPath(),
                        h.moveTo(0, 0),
                        h.lineTo(o - l * (n ? 3 : 0), 0),
                        h.lineTo(o - l * (n ? 4 : 1), l),
                        h.lineTo(l, l),
                        h.closePath(),
                        h.fill(),
                        (i = h.createLinearGradient(0, 0, l, 0)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(127,255,255)"),
                        h.fillStyle = i,
                        h.beginPath(),
                        h.moveTo(0, 0),
                        h.lineTo(l, l),
                        h.lineTo(l, 126.08),
                        h.lineTo(0, 126.08),
                        h.closePath(),
                        h.fill(),
                        (i = h.createLinearGradient(0, 126.08, 0, o)).addColorStop(0, a),
                        i.addColorStop(1, "rgb(127,0,255)"),
                        h.fillStyle = i,
                        h.beginPath(),
                        h.moveTo(l, 126.08),
                        h.lineTo(o - l * (n ? 4 : 1), 126.08),
                        h.lineTo(o - l * (n ? 3 : 0), o),
                        h.lineTo(0, o),
                        h.closePath(),
                        h.fill(),
                        this.rightCover.element.loadNormalMap(u, Fe.MATERIAL_FACE.BACK)
                    }
                }
            }, {
                key: "setcolor3DCover",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
                    0 == (t = t.trim()).indexOf("#") && 4 === t.length && (t = t.split("").map((function(e) {
                        return "#" == e ? e : e + e
                    }
                    )).join(""));
                    var i = _e.color.getBrightness(t);
                    isNaN(i) && (console.log("Improper Color code value. Needs a hex value! Using default 0.25"),
                    i = .25);
                    var n = (255 - i) / 255
                      , o = 1024
                      , a = document.createElement("canvas");
                    a.height = o,
                    a.width = o;
                    var r = a.getContext("2d");
                    if (r.fillStyle = t,
                    r.fillRect(0, 0, o, o),
                    r.strokeStyle = "rgba(50,50,50," + (n / 2 + .4) + ")",
                    r.strokeRect(.1 * o, .05 * o, o * (this.hasSpiral ? .9 : .85), .9 * o),
                    r.beginPath(),
                    r.strokeStyle = "rgba(50,50,50," + (n / 2 + .3) + ")",
                    r.lineWidth = 2,
                    r.moveTo(0, 0),
                    r.lineTo(.1 * o, .05 * o),
                    r.stroke(),
                    r.beginPath(),
                    r.strokeStyle = "rgba(50,50,50," + (n / 2 + .4) + ")",
                    r.moveTo(0, o),
                    r.lineTo(.1 * o, .95 * o),
                    r.stroke(),
                    r.beginPath(),
                    r.strokeStyle = "rgba(255,255,255,0.3)",
                    r.lineWidth = 4,
                    r.moveTo(0, 0),
                    r.lineTo(0, o),
                    r.moveTo(0, 0),
                    r.lineTo(o, 0),
                    r.stroke(),
                    r.beginPath(),
                    r.strokeStyle = "rgba(50,50,50," + (n / 2 + .3) + ")",
                    r.lineWidth = 4,
                    r.moveTo(0, o),
                    r.lineTo(o, o),
                    r.stroke(),
                    !1 === this.hasSpiral) {
                        r.beginPath();
                        var s = r.createLinearGradient(.95 * o, 0, o, 0);
                        s.addColorStop(0, "rgba(30,30,30," + (n + .3) + ")"),
                        s.addColorStop(1, "rgba(60,60,60," + (n + .3) + ")"),
                        r.fillStyle = s,
                        r.fillRect(.95 * o, 0, .05 * o, o),
                        r.beginPath(),
                        r.lineWidth = 1,
                        r.strokeStyle = "rgba(40,40,40," + (n + .3) + ")";
                        for (var l = 0; l < 17; l++)
                            r.moveTo(o - 3 * l, 0),
                            r.lineTo(o - 3 * l, o);
                        r.stroke()
                    } else
                        r.beginPath(),
                        r.strokeStyle = "rgba(50,50,50,0.2)",
                        r.lineWidth = 4,
                        r.moveTo(o, 0),
                        r.lineTo(o, o),
                        r.stroke();
                    this.leftCover.backImage(a);
                    var u = document.createElement("canvas");
                    u.height = o,
                    u.width = o;
                    var h = u.getContext("2d");
                    if (h.fillStyle = t,
                    h.fillRect(0, 0, o, o),
                    h.strokeStyle = "rgba(50,50,50," + (n / 2 + .5) + ")",
                    h.strokeRect(o * (this.hasSpiral ? 0 : .05), .05 * o, o * (this.hasSpiral ? .9 : .85), .9 * o),
                    h.beginPath(),
                    h.strokeStyle = "rgba(50,50,50," + (n / 2 + .3) + ")",
                    h.lineWidth = 2,
                    h.moveTo(o, 0),
                    h.lineTo(.9 * o, .05 * o),
                    h.stroke(),
                    h.beginPath(),
                    h.strokeStyle = "rgba(50,50,50," + (n / 2 + .5) + ")",
                    h.moveTo(o, o),
                    h.lineTo(.9 * o, .95 * o),
                    h.stroke(),
                    h.beginPath(),
                    h.strokeStyle = "rgba(255,255,255,0.3)",
                    h.lineWidth = 4,
                    h.moveTo(0, 0),
                    h.lineTo(o, 0),
                    h.stroke(),
                    h.beginPath(),
                    h.strokeStyle = "rgba(50,50,50," + (n / 2 + .3) + ")",
                    h.lineWidth = 4,
                    h.moveTo(o, 0),
                    h.lineTo(o, o),
                    h.moveTo(0, o),
                    h.lineTo(o, o),
                    h.stroke(),
                    !1 === this.hasSpiral) {
                        h.beginPath();
                        var p = h.createLinearGradient(0, 0, .05 * o, 0);
                        p.addColorStop(0, "rgba(0,0,0," + (n + .3) + ")"),
                        p.addColorStop(.2, "rgba(10,10,10," + (n + .3) + ")"),
                        p.addColorStop(1, "rgba(80,80,80," + (n + .3) + ")"),
                        h.fillStyle = p,
                        h.fillRect(0, 0, .05 * o, o),
                        h.beginPath(),
                        h.lineWidth = 1,
                        h.strokeStyle = "rgba(40,40,40," + (n + .3) + ")";
                        for (var c = 0; c < 17; c++)
                            h.moveTo(3 * c, 0),
                            h.lineTo(3 * c, o);
                        h.stroke()
                    } else
                        h.beginPath(),
                        h.strokeStyle = "rgba(255,255,255,0.2)",
                        h.lineWidth = 4,
                        h.moveTo(0, 0),
                        h.lineTo(0, o),
                        h.stroke();
                    this.rightCover.frontImage(u);
                    var d = document.createElement("canvas");
                    o = 128,
                    d.height = o,
                    d.width = o;
                    var f = d.getContext("2d");
                    f.fillStyle = "#ffffff",
                    f.fillRect(0, 0, o, o),
                    f.strokeStyle = "#cccccc",
                    f.lineWidth = 1;
                    for (var g = 0; g < o / 4; g++)
                        f.moveTo(4 * g, 0),
                        f.lineTo(4 * g, o);
                    f.stroke(),
                    this.leftSheets.element.loadImage(d, 1, null),
                    this.rightSheets.element.loadImage(d, 3, null),
                    this.app.renderRequestStatus = e.REQUEST_STATUS.ON
                }
            }, {
                key: "initEvents",
                value: function() {
                    this.stageDOM = this.element[0],
                    Ce(Ne(n.prototype), "initEvents", this).call(this)
                }
            }, {
                key: "dispose",
                value: function() {
                    Ce(Ne(n.prototype), "dispose", this).call(this);
                    var e = this;
                    e.stage && (e.stage.clearChild(),
                    e.stage.cssRenderer.domElement.parentNode.removeChild(e.stage.cssRenderer.domElement),
                    e.stage.cssRenderer = null,
                    e.stage.orbitControl = _e.disposeObject(e.stage.orbitControl),
                    e.stage.renderer = _e.disposeObject(e.stage.renderer),
                    jQuery(e.stage.canvas).remove(),
                    e.stage.canvas = null,
                    e.stage = _e.disposeObject(e.stage)),
                    e.centerTween && e.centerTween.stop && e.centerTween.stop()
                }
            }, {
                key: "render",
                value: function() {
                    this.stage.render(),
                    this.stage.cssRenderer.render(this.stage.cssScene, this.stage.camera)
                }
            }, {
                key: "resize",
                value: function() {
                    Ce(Ne(n.prototype), "resize", this).call(this);
                    var e = this
                      , t = e.app
                      , i = e.stage
                      , o = t.dimensions
                      , a = (o.padding,
                    e.isSingle,
                    this.availablePageWidth())
                      , r = this.availablePageHeight();
                    i.resizeCanvas(o.stage.width, o.stage.height),
                    i.cssRenderer.setSize(o.stage.width, o.stage.height),
                    this.pageScaleX = Math.max(Math.max(a, r) / 400, 1),
                    this.initDepth(),
                    this.sheets.forEach((function(t) {
                        t.depth = e.sheetDepth
                    }
                    )),
                    t.refreshRequestStart();
                    var s = this.refSize = Math.min(r, a);
                    this.coverExtraWidth = ("vertical" == e.orientation ? 2 : 1) * s * .025,
                    this.coverExtraHeight = ("vertical" == e.orientation ? 1 : 2) * s * .025,
                    !0 !== this.has3DCover && (this.coverExtraWidth = 0,
                    this.coverExtraHeight = 0),
                    e.zoomViewer.resize(),
                    e.cameraPositionDirty = !0,
                    e.centerNeedsUpdate = !0,
                    e.checkCenter(!0),
                    e.pagesReady(),
                    this.pageOffset = (this.hasSpiral ? 6 : 0) * Math.min(this._defaultPageSize.width, this._defaultPageSize.height) / 1e3
                }
            }, {
                key: "fitCameraToCenteredObject",
                value: function(e, t, i, n) {
                    var o = new THREE.Box3;
                    o.setFromObject(t);
                    new THREE.Vector3;
                    var a = new THREE.Vector3;
                    o.getSize(a);
                    var r = this.coverExtraHeight
                      , s = 2 * this.coverExtraWidth;
                    this.isClosedPage() && (s = 0,
                    r = 0),
                    a.x = a.x - s + this.app.dimensions.padding.width,
                    a.y = a.y - r + this.app.dimensions.padding.height;
                    var l = e.fov * (Math.PI / 180)
                      , u = 2 * Math.atan(Math.tan(l / 2) * e.aspect)
                      , h = a.z / 2 + Math.abs(a.x / 2 / Math.tan(u / 2))
                      , p = a.z / 2 + Math.abs(a.y / 2 / Math.tan(l / 2))
                      , c = Math.max(h, p);
                    void 0 !== i && 0 !== i && (c *= i),
                    e.position.set(0, 0, c);
                    var d = o.min.z
                      , f = d < 0 ? -d + c : c - d;
                    e.far = 3 * f,
                    e.updateProjectionMatrix(),
                    void 0 !== n && (n.target = new THREE.Vector3(0,0,0),
                    n.maxDistance = 2 * f)
                }
            }, {
                key: "updateShadowSize",
                value: function() {}
            }, {
                key: "refresh",
                value: function() {
                    var e = this
                      , t = this.app
                      , i = e.getBasePage();
                    this.refreshRequested = !0;
                    var o = 1 / t.pageCount * i
                      , a = this.isRTL ? 1 - o : o
                      , r = 1 - a
                      , s = Math.min(e.stackCount, e.totalSheets)
                      , l = _e.limitAt(e.totalSheets, e.stackCount, 2 * e.stackCount)
                      , u = (Math.max(a, r),
                    this.isBooklet ? 0 : this.flexibility / l);
                    e.leftFlexibility = u * r,
                    e.rightFlexibility = u * a,
                    e.midPosition = .5 * s * e.sheetDepth,
                    Ce(Ne(n.prototype), "refresh", this).call(this);
                    var h = !0 === this.has3DCover;
                    this.leftCover.element.visible = this.rightCover.element.visible = this.leftSheets.element.visible = this.rightSheets.element.visible = h,
                    this.wrapper.position.z = -this.midPosition;
                    var p = 0
                      , c = 0
                      , d = e.isRTL
                      , f = this.isFirstPage()
                      , g = this.isLastPage()
                      , v = this.isLeftClosed = this.isClosedPage() && (d && g || !d && f)
                      , m = this.isRightClosed = this.isClosedPage() && (!d && g || d && f);
                    if (h) {
                        e.leftSheets.depth = d ? e.sheetsDepth * (1 - e.getBasePage() / t.pageCount) : e.sheetsDepth * i / t.pageCount,
                        e.leftSheets.element.visible = d ? t.pageCount - e.getBasePage() > 2 : i > 2,
                        p -= e.leftSheets.depth / 2,
                        e.leftSheets.element.position.z = p,
                        p -= e.coverDepth + (e.leftSheets.element.visible ? e.leftSheets.depth / 2 : 0) + 3 * e.coverDepth,
                        e.leftCover.depth = e.rightCover.depth = e.coverDepth;
                        var y = Math.max(this.leftSheetHeight, this.rightSheetHeight);
                        m && (y = this.leftSheetHeight),
                        v && (y = this.rightSheetHeight),
                        !0 !== e.leftCover.isFlipping && (e.leftCover.element.position.z = v ? e.midPosition + e.coverDepth : p + e.coverDepth / 2,
                        e.leftCover.element.position.z = Math.max(e.leftCover.element.position.z, .05 * -e.refSize),
                        e.leftCover.element.position.x = 0,
                        e.leftSheets.sheetAngle = e.leftCover.sheetAngle = v ? 180 : 0,
                        e.leftSheets.curveAngle = e.leftCover.curveAngle = v ? 180 : 0,
                        !0 !== e.rightCover.isFlipping && (e.leftCover.height = y,
                        e.leftCover.width = e.leftCover.sheetAngle < 90 ? this.leftSheetWidth : this.rightSheetWidth,
                        this.isClosedPage() || (e.leftCover.width += this.coverExtraWidth,
                        e.leftCover.height += this.coverExtraHeight)),
                        e.leftSheets.updateAngle(),
                        e.leftCover.updateAngle()),
                        e.rightSheets.depth = e.sheetsDepth - e.leftSheets.depth,
                        e.rightSheets.element.visible = d ? i > 2 : t.pageCount - e.getBasePage() > 2,
                        c -= e.rightSheets.depth / 2,
                        e.rightSheets.element.position.z = c,
                        c -= e.coverDepth + (e.rightSheets.element.visible ? e.rightSheets.depth / 2 : 0) + 3 * e.coverDepth,
                        !0 !== e.rightCover.isFlipping && (e.rightCover.element.position.z = m ? e.midPosition + e.coverDepth : c + e.coverDepth / 2,
                        e.rightCover.element.position.z = Math.max(e.rightCover.element.position.z, .05 * -e.refSize),
                        e.rightCover.element.position.x = 0,
                        e.rightSheets.sheetAngle = e.rightCover.sheetAngle = m ? 0 : 180,
                        e.rightSheets.curveAngle = e.rightCover.curveAngle = m ? 0 : 180,
                        !0 !== e.leftCover.isFlipping && (e.rightCover.height = y,
                        e.rightCover.width = e.rightCover.sheetAngle < 90 ? this.leftSheetWidth : this.rightSheetWidth,
                        this.isClosedPage() || (e.rightCover.width += this.coverExtraWidth,
                        e.rightCover.height += this.coverExtraHeight)),
                        e.rightSheets.updateAngle(),
                        e.rightCover.updateAngle()),
                        e.updateSheets(),
                        e.stage.ground.position.z = Math.min(p, c) - e.refSize * e.groundDistance / 100,
                        e.stage.ground.position.z = Math.max(e.stage.ground.position.z, .1 * -e.refSize)
                    } else
                        e.stage.ground.position.z = -e.midPosition - 15 * e.sheetDepth;
                    !0 === e.cameraPositionDirty && e.updateCameraPosition(),
                    e.spiralRefreshRequested = !0,
                    this.refreshSpiral()
                }
            }, {
                key: "refreshSpiral",
                value: function() {
                    if (!0 === this.hasSpiral) {
                        var e = this.midPosition + this.sheetDepth;
                        this.bookWrapper.children.forEach((function(t) {
                            t && t.sheetAngle && t.position.z + t.depth / 2 > e && (e = t.position.z + t.depth / 2)
                        }
                        )),
                        this.leftHoles.visible = this.isBooklet ? this.isRTL : 0 == this.isLeftClosed && 0 == this.leftCover.isFlipping,
                        this.rightHoles.visible = this.isBooklet ? !this.isRTL : 0 == this.isRightClosed && 0 == this.rightCover.isFlipping;
                        var t = "vertical" === this.orientation ? Math.max(this.leftHoles.visible ? this.leftSheetWidth : 0, this.rightHoles.visible ? this.rightSheetWidth : 0) : Math.max(this.leftHoles.visible ? this.leftSheetHeight : 0, this.rightHoles.visible ? this.rightSheetHeight : 0);
                        t /= 1e3,
                        this.leftHoles.position.z = this.rightHoles.position.z = e + 2 / t + (this.isClosedPage() ? 2 * this.leftCover.depth : 0) / t,
                        this.spiralGroup.scale.set(t, t, t)
                    }
                }
            }, {
                key: "updateCameraPosition",
                value: function() {
                    var e = this
                      , t = e.app
                      , i = e.stage
                      , n = t.dimensions
                      , o = n.padding
                      , a = 1 / (2 * Math.tan(Math.PI * i.camera.fov * .5 / 180) / (n.stage.height / t.zoomValue)) + 2.2;
                    this.updateShadowSize(),
                    this.stage.spotLight.position.x = 440 * -this.pageScaleX,
                    this.stage.spotLight.position.y = 440 * this.pageScaleX,
                    this.stage.spotLight.position.z = 660 * this.pageScaleX,
                    this.stage.spotLight.shadow.camera.far = 1200 * this.pageScaleX,
                    this.stage.spotLight.shadow.camera.updateProjectionMatrix();
                    var r = (o.top - o.bottom) / t.zoomValue / 2
                      , s = -(o.left - o.right) / t.zoomValue / 2;
                    i.camera.position.z !== a && !0 === t.pendingZoom && (i.camera.position.z = a),
                    1 === t.zoomValue && (e.bookWrapper.rotation.set(0, 0, 0),
                    e.bookHelper.rotation.set(0, 0, 0),
                    e.cameraWrapper.rotation.set(0, 0, 0),
                    0 !== t.options.flipbook3DTiltAngleUp || 0 !== t.options.flipbook3DTiltAngleLeft ? (i.camera.aspect = n.stage.width / n.stage.height,
                    i.camera.updateProjectionMatrix(),
                    e.bookWrapper.rotateZ(THREE.Math.degToRad(-t.options.flipbook3DTiltAngleLeft)),
                    e.bookWrapper.rotateX(THREE.Math.degToRad(-t.options.flipbook3DTiltAngleUp)),
                    "vertical" == e.orientation ? e.bookWrapper.scale.y = 1 / (this.isSingle ? 2 : 1) : e.bookWrapper.scale.x = 1 / (this.isSingle ? 2 : 1),
                    e.bookHelper.update(),
                    e.fitCameraToCenteredObject(i.camera, e.bookWrapper),
                    e.bookWrapper.rotation.set(0, 0, 0),
                    e.bookWrapper.scale.x = 1,
                    e.bookWrapper.scale.y = 1,
                    i.camera.position.set(s, r, i.camera.position.z + i.ground.position.z),
                    this.camera.aspect = n.stage.width / n.stage.height,
                    this.camera.updateProjectionMatrix(),
                    e.cameraWrapper.rotateX(THREE.Math.degToRad(t.options.flipbook3DTiltAngleUp)),
                    e.cameraWrapper.rotateZ(THREE.Math.degToRad(t.options.flipbook3DTiltAngleLeft))) : i.camera.position.set(s, r, a)),
                    i.camera.updateProjectionMatrix(),
                    e.app.renderRequestStatus = Ie.REQUEST_STATUS.ON,
                    e.cameraPositionDirty = !1
                }
            }, {
                key: "refreshSheet",
                value: function(t) {
                    var i, n = this, o = t.sheet, a = t.index, r = o.sheetAngle, s = !(o.isHard || 0 === this.flexibility);
                    o.leftFlexibility = s ? n.leftFlexibility : 0,
                    o.rightFlexibility = s ? n.rightFlexibility : 0,
                    o.leftPos = n.midPosition + (a - t.midPoint + 1) * n.sheetDepth - n.sheetDepth / 2,
                    o.rightPos = n.midPosition - (a - t.midPoint) * n.sheetDepth - n.sheetDepth / 2,
                    i = o.targetSide === e.TURN_DIRECTION.LEFT ? 0 : 180,
                    !1 === o.isFlipping && (t.needsFlip ? (o.isFlipping = !0,
                    o.isCover && 0 === t.sheetNumber && (n.isRTL ? n.rightCover.isFlipping = !0 : n.leftCover.isFlipping = !0),
                    o.isCover && n.totalSheets - t.sheetNumber == 1 && (n.isRTL ? n.leftCover.isFlipping = !0 : n.rightCover.isFlipping = !0),
                    o.element.position.z = Math.max(r < 90 ? o.leftPos : o.rightPos, n.midPosition) + n.sheetDepth,
                    o.flexibility = r < 90 ? o.leftFlexibility : o.rightFlexibility,
                    o.flip(r, i)) : (o.skipFlip = !1,
                    o.sheetAngle = o.curveAngle = i,
                    o.flexibility = i < 90 ? o.leftFlexibility : o.rightFlexibility,
                    o.element.position.z = i < 90 ? o.leftPos : o.rightPos,
                    o.side = o.targetSide,
                    o.height = i < 90 ? this.leftSheetHeight : this.rightSheetHeight,
                    o.width = i < 90 ? this.leftSheetWidth : this.rightSheetWidth),
                    o.updateAngle(),
                    this.app.renderRequestStatus = Ie.REQUEST_STATUS.ON),
                    o.element.visible = t.visible
                }
            }, {
                key: "updateCenter",
                value: function() {
                    var e = this
                      , t = this.app
                      , i = "vertical" == this.orientation ? e.wrapper.position.y : e.wrapper.position.x
                      , n = ("vertical" === this.orientation ? -1 : 1) * e.centerShift * (this.isLeftPage() ? "vertical" == this.orientation ? this.leftSheetHeight : this.leftSheetWidth : "vertical" == this.orientation ? this.rightSheetHeight : this.rightSheetWidth) / 2;
                    e.seamPosition = (-t.dimensions.offset.width + t.dimensions.containerWidth) / 2 + n,
                    n !== e.centerEnd && (e.centerTween && e.centerTween.stop && e.centerTween.stop(),
                    e.onCenterStartAnimation(this),
                    e.centerTween = new TWEEN.Tween({
                        x: i
                    }).delay(0).to({
                        x: n
                    }, 1 === t.zoomValue && !0 !== e.skipCenterAnimation ? e.app.options.duration : 1).onStart((function() {}
                    )).onUpdate((function() {
                        e.onCenterUpdateAnimation(this)
                    }
                    )).onComplete((function() {
                        e.onCenterCompleteAnimation(this)
                    }
                    )).onStop((function() {
                        e.onCenterStopAnimation(this)
                    }
                    )).easing(TWEEN.Easing.Cubic.InOut).start(),
                    this.updatePendingStatusClass(),
                    e.skipCenterAnimation = !1,
                    e.centerEnd = n),
                    e.renderRequestStatus = Ie.REQUEST_STATUS.ON,
                    this.zoomViewer.updateCenter()
                }
            }, {
                key: "onCenterUpdateAnimation",
                value: function(e) {
                    "vertical" == this.orientation ? (this.wrapper.position.y = e.x,
                    this.stage && this.stage.cssScene && (this.stage.cssScene.position.y = e.x)) : (this.wrapper.position.x = e.x,
                    this.stage && this.stage.cssScene && (this.stage.cssScene.position.x = e.x))
                }
            }, {
                key: "onCenterStartAnimation",
                value: function(e) {}
            }, {
                key: "onCenterStopAnimation",
                value: function(e) {}
            }, {
                key: "onCenterCompleteAnimation",
                value: function(e) {}
            }, {
                key: "flipCover",
                value: function(e) {
                    var t, i, n = null;
                    0 === e.pageNumber || this.isBooklet && 1 === e.pageNumber ? (n = this.isRTL ? this.rightCover : this.leftCover,
                    t = this.isRTL ? 1 : -1) : e.pageNumber === this.totalSheets - 1 && (n = this.isRTL ? this.leftCover : this.rightCover,
                    t = this.isRTL ? -1 : 1),
                    null !== n && (i = n.depth + e.depth + 1,
                    n.sheetAngle = e.sheetAngle,
                    n.curveAngle = e.curveAngle,
                    this.rightCover.height = this.leftCover.height = e.height + this.coverExtraHeight,
                    this.rightCover.width = this.leftCover.width = e.width + this.coverExtraWidth,
                    n.flexibility = e.flexibility,
                    this.rightCover.updateAngle(),
                    this.leftCover.updateAngle(),
                    n.element.position.x = e.element.position.x + t * Math.sin(e.sheetAngle * Math.PI / 180) * i,
                    n.element.position.z = e.element.position.z + t * Math.cos(e.sheetAngle * Math.PI / 180) * i)
                }
            }, {
                key: "pagesReady",
                value: function() {
                    if (!this.isAnimating() && !0 === this.refreshRequested) {
                        if (!1 === this.app.options.flipbookFitPages) {
                            var e = this.app.viewer.getBasePage()
                              , t = this.leftViewport = this.getViewPort(e + (this.isBooklet ? 0 : this.isRTL ? 1 : 0))
                              , i = this.rightViewPort = this.getViewPort(e + (this.isBooklet || this.isRTL ? 0 : 1));
                            if (t) {
                                var n = _e.contain(t.width, t.height, this.availablePageWidth(), this.availablePageHeight());
                                this.leftSheetWidth == Math.floor(n.width) && this.leftSheetHeight == Math.floor(n.height) || (this.cameraPositionDirty = !0),
                                this.leftSheetWidth = Math.floor(n.width),
                                this.leftSheetHeight = Math.floor(n.height)
                            }
                            if (i) {
                                var o = _e.contain(i.width, i.height, this.availablePageWidth(), this.availablePageHeight());
                                this.rightSheetWidth == Math.floor(o.width) && this.rightSheetWidth == Math.floor(o.height) || (this.cameraPositionDirty = !0),
                                this.rightSheetWidth = Math.floor(o.width),
                                this.rightSheetHeight = Math.floor(o.height)
                            }
                            for (var a = 0; a < this.sheets.length; a++) {
                                var r = this.sheets[a];
                                r.side === Ie.TURN_DIRECTION.LEFT ? (r.height = this.leftSheetHeight,
                                r.width = this.leftSheetWidth,
                                r.updateAngle()) : (r.height = this.rightSheetHeight,
                                r.width = this.rightSheetWidth,
                                r.updateAngle())
                            }
                            if (this.isClosedPage()) {
                                var s = this.isRTL && this.isLastPage() || !this.isRTL && this.isFirstPage();
                                this.leftCover.width = this.rightCover.width = s ? this.rightSheetWidth : this.leftSheetWidth,
                                this.leftCover.height = this.rightCover.height = s ? this.rightSheetHeight : this.leftSheetHeight
                            } else
                                this.leftCover.height = this.rightCover.height = this.coverExtraHeight + Math.max(this.leftSheetHeight, this.rightSheetHeight),
                                this.leftCover.width = this.coverExtraWidth + this.leftSheetWidth,
                                this.rightCover.width = this.coverExtraWidth + this.rightSheetWidth;
                            this.leftSheets.width = this.leftSheetWidth,
                            this.leftSheets.height = this.leftSheetHeight,
                            this.rightSheets.height = this.rightSheetHeight,
                            this.rightSheets.width = this.rightSheetWidth,
                            this.leftCover.updateAngle(),
                            this.leftSheets.updateAngle(),
                            this.rightCover.updateAngle(),
                            this.rightSheets.updateAngle(),
                            this.updateSheets(!0)
                        }
                        this.updateCenter(),
                        this.updateCSSLayer(),
                        this.updatePendingStatusClass(),
                        this.refreshSpiral(),
                        !0 === this.cameraPositionDirty && this.updateCameraPosition()
                    }
                }
            }, {
                key: "updateSheets",
                value: function(e) {
                    if (!0 !== this.isClosedPage()) {
                        var t = this.getPageByNumber(this.getRightPageNumber());
                        if (!0 !== this.rightCover.isFlipping && t && t.sheet.element.geometry.attributes) {
                            var i = this.rightSheets.element.geometry.attributes.position
                              , n = e ? t.sheet.element.geometry.boundingBox.max.x * t.sheet.element.scale.x : this.rightSheets.lastSlopeX;
                            i.setX(21, n),
                            i.setX(23, n),
                            i.setX(4, n),
                            i.setX(6, n),
                            i.setX(10, n),
                            i.setX(14, n),
                            i.needsUpdate = !0,
                            this.rightSheets.element.geometry.attributes.uv.needsUpdate = !0,
                            this.rightSheets.element.geometry.computeVertexNormals(),
                            e && (this.rightSheets.lastSlopeX = n)
                        }
                        var o = this.getPageByNumber(this.getLeftPageNumber());
                        if (!0 !== this.leftCover.isFlipping && o && o.sheet.element.geometry.attributes) {
                            var a = this.leftSheets.element.geometry.attributes.position
                              , r = e ? o.sheet.element.geometry.boundingBox.min.x * o.sheet.element.scale.x : this.leftSheets.lastSlopeX;
                            a.setX(16, r),
                            a.setX(18, r),
                            a.setX(5, r),
                            a.setX(7, r),
                            a.setX(8, r),
                            a.setX(12, r),
                            a.needsUpdate = !0,
                            this.leftSheets.element.geometry.attributes.uv.needsUpdate = !0,
                            this.leftSheets.element.geometry.computeVertexNormals(),
                            e && (this.leftSheets.lastSlopeX = r)
                        }
                    }
                }
            }, {
                key: "updateCSSLayer",
                value: function() {
                    var e, t, i = this, n = i.getBasePage(), o = n + (i.isBooklet ? 0 : i.isRTL ? 1 : 0), a = n + (i.isBooklet || this.isRTL ? 0 : 1), r = !this.isRTL && i.isBooklet ? void 0 : i.getPageByNumber(o), s = this.isRTL && i.isBooklet ? void 0 : i.getPageByNumber(a);
                    jQuery(i.stage.cssRenderer.domElement).find(".df-page-content").css({
                        display: "none"
                    });
                    var l = "vertical" == this.orientation;
                    if (this.leftViewport && null != r && r.sheet.element.visible) {
                        var u = r.cssPage;
                        if (null != u) {
                            var h = r.sheet.element.geometry.boundingBox;
                            e = Math.abs(h.max.x - h.min.x) * r.sheet.element.scale.x,
                            t = Math.abs(h.max.y - h.min.y) * r.sheet.element.scale.y,
                            u.rotation.y = 0,
                            u.position.z = 0,
                            u.position.x = 0,
                            jQuery(u.element).css({
                                width: l ? t : e,
                                height: l ? e : t,
                                top: l ? this.pageOffset + e / 2 : 0,
                                left: l ? 0 : -this.pageOffset - e / 2,
                                display: "block"
                            }),
                            this.resizeAnnotations(o)
                        }
                    }
                    if (this.rightViewPort && null != s && s.sheet.element.visible) {
                        var p = s.cssPage;
                        if (null != p) {
                            var c = s.sheet.element.geometry.boundingBox;
                            e = Math.abs(c.max.x - c.min.x) * s.sheet.element.scale.x,
                            t = Math.abs(c.max.y - c.min.y) * s.sheet.element.scale.y,
                            p.rotation.y = 0,
                            p.position.z = 0,
                            p.position.x = 0,
                            jQuery(p.element).css({
                                width: l ? t : e,
                                height: l ? e : t,
                                top: l ? -this.pageOffset - e / 2 : 0,
                                left: l ? 0 : this.pageOffset + e / 2,
                                display: "block"
                            }),
                            this.resizeAnnotations(a)
                        }
                    }
                }
            }, {
                key: "mouseMove",
                value: function(e) {
                    if (e = _e.fixMouseEvent(e),
                    this.app.renderRequestStatus = Ie.REQUEST_STATUS.ON,
                    null == e.touches || 2 != e.touches.length) {
                        var t = this
                          , i = t.eventToPoint(e);
                        if (null !== t.dragSheet && !1 !== t.drag3D) {
                            var n = 180 * Math.acos(_e.limitAt(1 - (i.x - i.left) / this.leftSheetWidth, -1, 1)) / Math.PI
                              , o = t.dragSheet
                              , a = t.drag === Ie.TURN_DIRECTION.LEFT;
                            o.sheetAngle = n;
                            var r = a ? _e.limitAt(o.sheetAngle + 45, 0, 180) : _e.limitAt(o.sheetAngle, 0, 180);
                            o.curveAngle = o.isHard ? o.sheetAngle : r * TWEEN.Easing.Sinusoidal.Out(.8 * r / 180),
                            o.updateAngle()
                        }
                        t.checkSwipe(i, e)
                    } else
                        this.pinchMove(e)
                }
            }, {
                key: "mouseUp",
                value: function(e) {
                    var t = this;
                    if ((e = _e.fixMouseEvent(e)).touches || 0 === e.button)
                        if (null != t.dragSheet || null == e.touches || 0 != e.touches.length) {
                            var i = t.eventToPoint(e);
                            if (1 === t.app.zoomValue) {
                                null !== t.dragSheet && (i.x > t.app.dimensions.width / 2 ? t.drag === Ie.TURN_DIRECTION.LEFT && t.app.openLeft() : t.drag === Ie.TURN_DIRECTION.RIGHT && t.app.openRight(),
                                t.requestRefresh());
                                var n = e.target || e.originalTarget
                                  , o = t.startPoint && i.x === t.startPoint.x && i.y === t.startPoint.y && "A" !== n.nodeName;
                                !0 === e.ctrlKey && o ? this.zoomOnPoint(i) : o && t.clickAction === Ie.MOUSE_CLICK_ACTIONS.NAV && t.raycastCLick(e)
                            }
                            t.dragSheet = null,
                            t.drag = null,
                            t.startPoint = null,
                            t.canSwipe = !1,
                            t.app.renderRequestStatus = Ie.REQUEST_STATUS.ON
                        } else
                            this.pinchUp(e)
                }
            }, {
                key: "raycastCLick",
                value: function(e) {
                    var t = this;
                    t.mouse = new THREE.Vector2,
                    t.raycaster = new THREE.Raycaster,
                    t.mouse.x = e.offsetX / t.app.dimensions.stage.width * 2 - 1,
                    t.mouse.y = 1 - e.offsetY / t.app.dimensions.stage.height * 2,
                    t.raycaster.setFromCamera(t.mouse, t.camera);
                    var i = t.raycaster.intersectObjects(t.bookWrapper.children, !0);
                    if (i.length > 0) {
                        var n, o = 0;
                        do {
                            if ((n = null != i[o] ? i[o].object : null).sheet && !0 !== n.sheet.isFlipping) {
                                n.sheet.sheetAngle > 90 ? t.app.openRight() : t.app.openLeft();
                                break
                            }
                            o++
                        } while (o < i.length)
                    }
                }
            }, {
                key: "mouseDown",
                value: function(e) {
                    if ((e = _e.fixMouseEvent(e)).touches || 0 === e.button)
                        if (null == e.touches || 2 != e.touches.length) {
                            e = _e.fixMouseEvent(e);
                            var t = this
                              , i = t.eventToPoint(e);
                            t.startPoint = i,
                            t.lastPosX = i.x,
                            t.lastPosY = i.y,
                            i.isInsideDragZone && !1 !== t.drag3D ? (t.dragSheet = i.sheet,
                            t.drag = i.sheet.sheetAngle < 90 ? Ie.TURN_DIRECTION.LEFT : Ie.TURN_DIRECTION.RIGHT) : t.canSwipe = !0
                        } else
                            this.pinchDown(e)
                }
            }, {
                key: "eventToPoint",
                value: function(e) {
                    var t = this
                      , i = this.app.dimensions
                      , n = {
                        x: (e = _e.fixMouseEvent(e)).clientX,
                        y: e.clientY
                    };
                    n.x = n.x - t.parentElement[0].getBoundingClientRect().left,
                    n.y = n.y - t.parentElement[0].getBoundingClientRect().top;
                    var o = (-i.offset.width + i.containerWidth) / 2 - i.stage.width / 2
                      , a = (-i.offset.width + i.containerWidth) / 2 + i.stage.width / 2
                      , r = i.padding.top
                      , s = i.padding.top + t.availablePageHeight()
                      , l = n.x < t.seamPosition
                      , u = t.getBasePage() + (l ? 0 : 1)
                      , h = this.getPageByNumber(u);
                    h && (h = h.sheet);
                    var p = n.x > o && n.x < a && n.y > r && n.y < s;
                    return {
                        isInsideSheet: p,
                        isInsideDragZone: p && n.x - o < t.foldSense || a - n.x < t.foldSense,
                        x: n.x,
                        y: n.y,
                        left: o,
                        top: r,
                        right: a,
                        bottom: s,
                        raw: n,
                        isLeftSheet: l,
                        sheet: h
                    }
                }
            }, {
                key: "checkPageLoading",
                value: function() {
                    for (var e = !0, t = this.getVisiblePages().main, i = 0; i < (this.isBooklet ? 1 : 2); i++) {
                        var n = this.getPageByNumber(t[i]);
                        n && (e = n.textureLoaded && e)
                    }
                    this.element.toggleClass("df-loading", !e)
                }
            }, {
                key: "textureLoadedCallback",
                value: function(e) {
                    this.app.renderRequestStart(),
                    this.pagesReady()
                }
            }, {
                key: "getTextureSize",
                value: function(e) {
                    var t = Ce(Ne(n.prototype), "getTextureSize", this).call(this, e);
                    if (1 !== this.app.zoomValue || !0 === e.isAnnotation)
                        return t;
                    var i = _e.nearestPowerOfTwo(t.height)
                      , o = t.width * i / t.height;
                    return this.texturePowerOfTwo ? {
                        height: i,
                        width: o
                    } : t
                }
            }, {
                key: "getPageByNumber",
                value: function(e) {
                    if (this.has3DCover) {
                        var t = !this.isBooklet && e === this.app.pageCount && e % 2 == 0
                          , i = 1 === e;
                        if (!this.isRTL && i || this.isRTL && t)
                            return this.leftCover.frontPage;
                        if (!this.isRTL && t || this.isRTL && i)
                            return this.rightCover.backPage
                    }
                    return Ce(Ne(n.prototype), "getPageByNumber", this).call(this, e)
                }
            }, {
                key: "setPage",
                value: function(e) {
                    return Ce(Ne(n.prototype), "setPage", this).call(this, e)
                }
            }, {
                key: "beforeFlip",
                value: function() {
                    Ce(Ne(n.prototype), "beforeFlip", this).call(this)
                }
            }, {
                key: "resizeAnnotations",
                value: function(e) {
                    var t = this.getAnnotationElement(e);
                    if ((!t || "" === t.style.width) && 1 === this.app.zoomValue) {
                        var i = this.getPageByNumber(e)
                          , o = Ce(Ne(n.prototype), "getViewPort", this).call(this, e);
                        if (i && o) {
                            o = o.clone({
                                dontFlip: !0
                            });
                            var a = e + "|" + this.rightSheetHeight
                              , r = i.cssPage;
                            if (r.lastStamp != a) {
                                r.lastStamp = a;
                                var s = i.sheet.element.geometry.boundingBox
                                  , l = Math.abs(s.max.x - s.min.x) * i.sheet.element.scale.x
                                  , u = this.getDoublePageWidthFix(e) * l / o.width
                                  , h = i.sheet.height / o.height
                                  , p = r.element.querySelectorAll("section");
                                p.length > 0 && p.forEach((function(e) {
                                    e.style.transform = "matrix(" + u + ", 0, 0, " + h + "," + o.transform[4] * u + "," + o.transform[5] * h + ")"
                                }
                                )),
                                this.app.provider.processTextContent(e, this.getTextElement(e, !0))
                            }
                        }
                    }
                }
            }, {
                key: "finalizeAnnotations",
                value: function(e, t) {
                    Ce(Ne(n.prototype), "finalizeAnnotations", this).call(this, e, t),
                    this.resizeAnnotations(t)
                }
            }]),
            n
        }(K)
          , De = function(e) {
            Ee(i, e);
            var t = Re(i);
            function i(e) {
                var n;
                Te(this, i);
                var o = Le(n = t.call(this, e));
                return o.element = null,
                o.face = e.face,
                o.parent3D = e.sheet,
                o.sheet = e.sheet,
                o.cssPage = new THREE.CSS3DObject(o.contentLayer[0]),
                n
            }
            return ke(i, [{
                key: "setLoading",
                value: function() {
                    this.sheet.viewer.checkPageLoading()
                }
            }, {
                key: "clearMap",
                value: function() {
                    this.sheet.element.material[this.face].map = null,
                    this.sheet.element.material[this.face].needsUpdate = !0
                }
            }, {
                key: "loadTexture",
                value: function(e) {
                    var t = this
                      , i = e.texture
                      , n = e.callback;
                    function o(i, o) {
                        t.updateTextureLoadStatus(!0),
                        t.sheet.resetMatColor(t.face, e.texture === t.textureLoadFallback),
                        "function" == typeof n && n(e)
                    }
                    t.textureSrc = i;
                    var a = !0 === Ie.defaults.mockupMode && "CANVAS" === i.nodeName && 0 !== t.parent3D.viewer.flexibility && !t.parent3D.isHard;
                    if (4 === this.face) {
                        if (a) {
                            var r = i.getContext("2d");
                            r.fillStyle = "rgb(127,127,255)";
                            var s = i.width * t.parent3D.viewer.leftFlexibility
                              , l = r.createLinearGradient(i.width, 0, i.width - s, 0);
                            l.addColorStop(0, "rgba(0,0,0,.2)"),
                            l.addColorStop(.05, "rgba(100,100,100,.1)"),
                            l.addColorStop(.25, "rgba(100,100,100,.1)"),
                            l.addColorStop(1, "rgba(200,200,200,0)"),
                            r.fillStyle = l,
                            r.beginPath(),
                            r.moveTo(i.width - s, 0),
                            r.lineTo(i.width, 0),
                            r.lineTo(i.width, i.height),
                            r.lineTo(i.width - s, i.height),
                            r.closePath(),
                            r.fill()
                        }
                        this.sheet.backImage(i, o)
                    } else {
                        if (a) {
                            var u = i.getContext("2d");
                            u.fillStyle = "rgb(127,127,255)";
                            var h = i.width * t.parent3D.viewer.rightFlexibility / 2
                              , p = u.createLinearGradient(0, 0, h, 0);
                            p.addColorStop(0, "rgba(0,0,0,.4)"),
                            p.addColorStop(0, "rgba(100,100,100,.1)"),
                            p.addColorStop(.25, "rgba(100,100,100,.1)"),
                            p.addColorStop(1, "rgba(200,200,200,0)"),
                            u.fillStyle = p,
                            u.beginPath(),
                            u.moveTo(0, 0),
                            u.lineTo(h, 0),
                            u.lineTo(h, i.height),
                            u.lineTo(0, i.height),
                            u.closePath(),
                            u.fill()
                        }
                        this.sheet.frontImage(i, o)
                    }
                }
            }]),
            i
        }(O)
          , Fe = {};
        function ze(e) {
            return ze = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            ze(e)
        }
        function Be(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function He(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== ze(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== ze(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === ze(a) ? a : String(a)), n)
            }
            var o, a
        }
        function Ue(e, t, i) {
            return t && He(e.prototype, t),
            i && He(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        function je() {
            return je = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = qe(e)); )
                        ;
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(arguments.length < 3 ? e : i) : o.value
                }
            }
            ,
            je.apply(this, arguments)
        }
        function Ve(e, t) {
            if ("function" != typeof t && null !== t)
                throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            t && We(e, t)
        }
        function We(e, t) {
            return We = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            We(e, t)
        }
        function Ge(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = qe(e);
                if (t) {
                    var o = qe(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === ze(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return function(e) {
                        if (void 0 === e)
                            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                        return e
                    }(e)
                }(this, i)
            }
        }
        function qe(e) {
            return qe = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            qe(e)
        }
        Fe.init = function() {
            if (!0 !== Fe.initialized) {
                var e = window.THREE;
                Fe = {
                    init: function() {},
                    initialized: !0,
                    GEOMETRY_TYPE: {
                        PLANE: 0,
                        BOX: 1,
                        MODEL: 2
                    },
                    MATERIAL_FACE: {
                        FRONT: 5,
                        BACK: 4
                    },
                    WHITE_COLOR: new e.Color("white"),
                    defaults: {
                        anisotropy: 8,
                        maxTextureSize: 2048,
                        groundTexture: "blank",
                        color: 16777215,
                        shininess: 15,
                        width: 210,
                        height: 297,
                        depth: .2,
                        segments: 150,
                        textureLoadFallback: "blank"
                    },
                    textureLoader: new e.TextureLoader,
                    clearChild: function(e) {
                        var t, i = e.material;
                        if (e.parent.remove(e),
                        e = _e.disposeObject(e),
                        null != i) {
                            if (null == i.length)
                                i.map && (t = i.map,
                                i.dispose(),
                                t.dispose()),
                                i.bumpMap && (t = i.bumpMap,
                                i.dispose(),
                                t.dispose()),
                                i.normalMap && (t = i.normalMap,
                                i.dispose(),
                                t.dispose());
                            else
                                for (var n = 0; n < i.length; n++)
                                    i[n] && (i[n].map && (t = i[n].map,
                                    i[n].dispose(),
                                    t.dispose()),
                                    i[n].bumpMap && (t = i[n].bumpMap,
                                    i[n].dispose(),
                                    t.dispose()),
                                    i[n].normalMap && (t = i[n].normalMap,
                                    i[n].dispose(),
                                    t.dispose())),
                                    i[n] = null;
                            i = null,
                            t = null
                        }
                    },
                    loadImage: function(t, i, n, o, a) {
                        if (null == i) {
                            var r = null == t.material[n] ? null : t.material[n][o] ? t.material[n][o].sourceFile : null;
                            return null == r || r.indexOf("data:image") > -1 ? null : r
                        }
                        var s = null;
                        return "CANVAS" === i.nodeName || "IMG" === i.nodeName ? ((s = new e.Texture(i)).needsUpdate = !0,
                        Fe.loadTexture(s, t, o, n),
                        "function" == typeof a && a(t, s)) : "blank" !== i ? (s = null == i ? null : Fe.textureLoader.load(i, (function(e) {
                            e.sourceFile = i,
                            Fe.loadTexture(e, t, o, n),
                            "function" == typeof a && a(t, e)
                        }
                        ), void 0, (function() {
                            null == s.image && Fe.loadImage(t, Fe.defaults.textureLoadFallback, n, o),
                            Fe.loadTextureFailed()
                        }
                        ))) && (s.mapping = e.UVMapping) : (Fe.loadTexture(null, t, o, n),
                        "function" == typeof a && a(t, s)),
                        0
                    },
                    loadTexture: function(t, i, n, o) {
                        if (t) {
                            var a = t.image;
                            t.naturalWidth = a.naturalWidth,
                            t.naturalHeight = a.naturalHeight,
                            t.needsUpdate = !0,
                            null != i.textureRotation && (t.rotation = e.MathUtils.degToRad(i.textureRotation),
                            t.center = i.textureCenter)
                        }
                        null !== t && "map" === n && (t.anisotropy = 0,
                        Fe.defaults.anisotropy > 0 && (t.anisotropy = Fe.defaults.anisotropy),
                        !0 === e.skipPowerOfTwo && (t.minFilter = e.LinearFilter,
                        t.magFilter = e.LinearFilter),
                        t.name = (new Date).toTimeString()),
                        Fe.clearTexture(i.material[o][n]),
                        i.material[o][n] = t,
                        "bumpMap" === n && (i.material[o].bumpScale = i.sheet.getBumpScale(o)),
                        i.material[o].needsUpdate = !0
                    },
                    loadTextureFailed: function() {
                        return null
                    },
                    clearTexture: function(e) {
                        e && (e.image && "CANVAS" === e.image.nodeName && (e.image.remove && e.image.remove(),
                        delete e.image),
                        e = _e.disposeObject(e))
                    }
                },
                e.skipPowerOfTwo = !0;
                var t = function(t) {
                    Ee(n, t);
                    var i = Re(n);
                    function n(t) {
                        var o;
                        Te(this, n);
                        var a = t.width || Fe.defaults.width
                          , r = t.height || Fe.defaults.height
                          , s = t.color || Fe.defaults.color
                          , l = t.segments || Fe.defaults.segments
                          , u = t.depth || Fe.defaults.depth
                          , h = {
                            color: s,
                            flatShading: !1,
                            shininess: t.shininess || Fe.defaults.shininess
                        }
                          , p = new e.MeshPhongMaterial(h)
                          , c = [p, p, p, p, new e.MeshPhongMaterial(h), new e.MeshPhongMaterial(h)];
                        return (o = i.call(this, new e.BoxGeometry(a,r,u,l,1,1), c)).material[5].transparent = !0,
                        o.material[4].transparent = !0,
                        o.baseType = "Paper",
                        o.type = "Paper",
                        o.castShadow = !0,
                        o.receiveShadow = !0,
                        t.parent3D.add(Le(o)),
                        o
                    }
                    return ke(n, [{
                        key: "loadImage",
                        value: function(e, t, i) {
                            Fe.loadImage(this, e, t, "map", i)
                        }
                    }, {
                        key: "frontImage",
                        value: function(e, t) {
                            Fe.loadImage(this, e, Fe.MATERIAL_FACE.FRONT, "map", t)
                        }
                    }, {
                        key: "backImage",
                        value: function(e, t) {
                            Fe.loadImage(this, e, Fe.MATERIAL_FACE.BACK, "map", t)
                        }
                    }, {
                        key: "loadBump",
                        value: function(e) {
                            Fe.loadImage(this, e, Fe.MATERIAL_FACE.FRONT, "bumpMap", null),
                            Fe.loadImage(this, e, Fe.MATERIAL_FACE.BACK, "bumpMap", null)
                        }
                    }, {
                        key: "loadNormalMap",
                        value: function(e, t) {
                            void 0 === t ? (Fe.loadImage(this, e, Fe.MATERIAL_FACE.FRONT, "normalMap", null),
                            Fe.loadImage(this, e, Fe.MATERIAL_FACE.BACK, "normalMap", null)) : Fe.loadImage(this, e, t, "normalMap", null)
                        }
                    }]),
                    n
                }(e.Mesh)
                  , i = function(e) {
                    Ee(i, e);
                    var t = Re(i);
                    function i(e) {
                        var n;
                        return Te(this, i),
                        (n = t.call(this, e)).receiveShadow = !0,
                        n.frontImage(Fe.defaults.groundTexture),
                        n.backImage(Fe.defaults.groundTexture),
                        n.type = "Ground",
                        n
                    }
                    return ke(i)
                }(t)
                  , n = function(t) {
                    Ee(o, t);
                    var n = Re(o);
                    function o(t) {
                        var a;
                        Te(this, o);
                        var r = Le(a = n.call(this));
                        r.canvas = t.canvas || document.createElement("canvas"),
                        r.canvas = jQuery(a.canvas),
                        r.camera = new e.PerspectiveCamera(20,r.width / r.height,4,5e4),
                        r.renderer = new e.WebGLRenderer({
                            canvas: r.canvas[0],
                            antialias: !0,
                            alpha: !0
                        }),
                        r.renderer.setPixelRatio(t.pixelRatio),
                        r.renderer.setSize(r.width, r.height),
                        r.renderer.setClearColor(16777215, 0),
                        r.renderer.shadowMap.enabled = !0,
                        r.renderer.shadowMap.type = 1,
                        r.ground = new i({
                            color: 16777215,
                            height: r.camera.far / 10,
                            width: r.camera.far / 10,
                            segments: 2,
                            parent3D: r
                        }),
                        r.ambientLight = new e.AmbientLight(4473924),
                        r.add(r.ambientLight);
                        var s = r.spotLight = new e.DirectionalLight(16777215,.25);
                        return s.position.set(0, 1, 0),
                        !1 !== t.castShadow && (s.castShadow = !0,
                        s.shadow.camera.near = 200,
                        s.shadow.camera.far = 2e3,
                        s.shadow.camera.top = 1350,
                        s.shadow.camera.bottom = -1350,
                        s.shadow.camera.left = -1350,
                        s.shadow.camera.right = 1350,
                        s.shadow.radius = 2,
                        s.shadow.mapSize.width = 1024,
                        s.shadow.mapSize.height = 1024),
                        r.add(s),
                        r.animateCount = 0,
                        r.renderCount = 0,
                        r.camera.position.set(-300, 300, 300),
                        r.camera.lookAt(new e.Vector3(0,0,0)),
                        a
                    }
                    return ke(o, [{
                        key: "resizeCanvas",
                        value: function(e, t) {
                            this.renderer.setSize(e, t),
                            this.camera.aspect = e / t,
                            this.camera.updateProjectionMatrix()
                        }
                    }, {
                        key: "render",
                        value: function() {
                            this.animateCount++,
                            this.renderer.render(this, this.camera),
                            null != this.stats && this.stats.update()
                        }
                    }, {
                        key: "clearMaterials",
                        value: function() {
                            for (var e = this.children.length - 1; e >= 0; e--) {
                                var t = this.children[e];
                                if (t.baseType && "Paper" === t.baseType && t.material)
                                    if (t.material.length)
                                        for (var i = 0; i < t.material.length; i++)
                                            t.material[i].needsUpdate = !0;
                                    else
                                        t.material.needsUpdate = !0
                            }
                        }
                    }, {
                        key: "clearChild",
                        value: function() {
                            this.spotLight.shadow.map = _e.disposeObject(this.spotLight.shadow.map),
                            this.spotLight.castShadow = !1,
                            this.clearMaterials();
                            for (var e = this.children.length - 1; e >= 0; e--) {
                                var t = this.children[e];
                                if (t.children && t.children.length > 0)
                                    for (var i = t.children.length - 1; i >= 0; i--)
                                        Fe.clearChild(t.children[i]);
                                Fe.clearChild(t),
                                t = null
                            }
                            this.render()
                        }
                    }]),
                    o
                }(e.Scene);
                Fe.Paper = t,
                Fe.Stage = n;
                var o = function(e) {
                    Ee(i, e);
                    var t = Re(i);
                    function i(e) {
                        var n;
                        return Te(this, i),
                        (n = t.call(this)).element = e,
                        n.element.style.position = "absolute",
                        n.addEventListener("removed", (function() {
                            null !== this.element.parentNode && this.element.parentNode.removeChild(this.element)
                        }
                        )),
                        n
                    }
                    return ke(i)
                }(e.Object3D);
                e.CSS3DObject = o;
                var a = function(e) {
                    Ee(i, e);
                    var t = Re(i);
                    function i(e) {
                        return Te(this, i),
                        t.call(this, e)
                    }
                    return ke(i)
                }(e.CSS3DObject);
                e.CSS3DSprite = a,
                e.MathUtils && (e.Math = e.MathUtils),
                e.CSS3DRenderer = function() {
                    var t, i, n, o;
                    _e.log("THREE.CSS3DRenderer", e.REVISION);
                    var a = new e.Matrix4
                      , r = {
                        camera: {
                            fov: 0,
                            style: ""
                        },
                        objects: {}
                    }
                      , s = document.createElement("div");
                    s.style.overflow = "hidden",
                    s.style.WebkitTransformStyle = "preserve-3d",
                    s.style.MozTransformStyle = "preserve-3d",
                    s.style.oTransformStyle = "preserve-3d",
                    s.style.transformStyle = "preserve-3d",
                    this.domElement = s;
                    var l = document.createElement("div");
                    l.style.WebkitTransformStyle = "preserve-3d",
                    l.style.MozTransformStyle = "preserve-3d",
                    l.style.oTransformStyle = "preserve-3d",
                    l.style.transformStyle = "preserve-3d",
                    s.appendChild(l),
                    this.setClearColor = function() {}
                    ,
                    this.getSize = function() {
                        return {
                            width: t,
                            height: i
                        }
                    }
                    ,
                    this.setSize = function(e, a) {
                        n = (t = e) / 2,
                        o = (i = a) / 2,
                        s.style.width = e + "px",
                        s.style.height = a + "px",
                        l.style.width = e + "px",
                        l.style.height = a + "px"
                    }
                    ;
                    var u = function(e) {
                        return Math.abs(e) < Number.EPSILON ? 0 : e
                    }
                      , h = function(e) {
                        var t = e.elements;
                        return "matrix3d(" + u(t[0]) + "," + u(-t[1]) + "," + u(t[2]) + "," + u(t[3]) + "," + u(t[4]) + "," + u(-t[5]) + "," + u(t[6]) + "," + u(t[7]) + "," + u(t[8]) + "," + u(-t[9]) + "," + u(t[10]) + "," + u(t[11]) + "," + u(t[12]) + "," + u(-t[13]) + "," + u(t[14]) + "," + u(t[15]) + ")"
                    }
                      , p = function(e) {
                        var t = e.elements;
                        return "translate3d(-50%,-50%,0) matrix3d(" + u(t[0]) + "," + u(t[1]) + "," + u(t[2]) + "," + u(t[3]) + "," + u(-t[4]) + "," + u(-t[5]) + "," + u(-t[6]) + "," + u(-t[7]) + "," + u(t[8]) + "," + u(t[9]) + "," + u(t[10]) + "," + u(t[11]) + "," + u(t[12]) + "," + u(t[13]) + "," + u(t[14]) + "," + u(t[15]) + ")"
                    }
                      , c = function t(i, n) {
                        if (i instanceof e.CSS3DObject) {
                            var o;
                            i instanceof e.CSS3DSprite ? (a.copy(n.matrixWorldInverse),
                            a.transpose(),
                            a.copyPosition(i.matrixWorld),
                            a.scale(i.scale),
                            a.elements[3] = 0,
                            a.elements[7] = 0,
                            a.elements[11] = 0,
                            a.elements[15] = 1,
                            o = p(a)) : o = p(i.matrixWorld);
                            var s = i.element
                              , u = r.objects[i.id];
                            void 0 !== u && u === o || (s.style.WebkitTransform = o,
                            s.style.MozTransform = o,
                            s.style.oTransform = o,
                            s.style.transform = o,
                            r.objects[i.id] = o),
                            s.parentNode !== l && l.appendChild(s)
                        }
                        for (var h = 0, c = i.children.length; h < c; h++)
                            t(i.children[h], n)
                    };
                    this.render = function(t, a) {
                        var u = .5 / Math.tan(e.Math.degToRad(.5 * a.fov)) * i;
                        r.camera.fov !== u && (s.style.WebkitPerspective = u + "px",
                        s.style.MozPerspective = u + "px",
                        s.style.oPerspective = u + "px",
                        s.style.perspective = u + "px",
                        r.camera.fov = u),
                        t.updateMatrixWorld(),
                        null === a.parent && a.updateMatrixWorld(),
                        a.matrixWorldInverse.invert ? a.matrixWorldInverse.copy(a.matrixWorld).invert() : a.matrixWorldInverse.getInverse(a.matrixWorld);
                        var p = "translate3d(0,0," + u + "px)" + h(a.matrixWorldInverse) + " translate3d(" + n + "px," + o + "px, 0)";
                        r.camera.style !== p && (l.style.WebkitTransform = p,
                        l.style.MozTransform = p,
                        l.style.oTransform = p,
                        l.style.transform = p,
                        r.camera.style = p),
                        c(t, a)
                    }
                }
            }
        }
        ;
        var Ze = e.utils;
        y.prototype.pinchDown = function(e) {
            null != e.touches && 2 == e.touches.length && null == this.startTouches && (this.startTouches = Ze.getTouches(e),
            this.app.viewer.zoomCenter = Ze.getVectorAvg(Ze.getTouches(e, this.parentElement.offset())),
            this.lastScale = 1)
        }
        ,
        y.prototype.pinchUp = function(e) {
            null != e.touches && e.touches.length < 2 && 1 == this.pinchZoomDirty && (this.app.viewer.lastScale = this.lastScale,
            this.app.container.removeClass("df-pinch-zoom"),
            this.updateTemporaryScale(!0),
            this.app.zoom(),
            this.lastScale = null,
            this.app.viewer.canSwipe = !1,
            this.pinchZoomDirty = !1,
            this.app.viewer._pinchZoomLastScale = null,
            this.startTouches = null)
        }
        ,
        y.prototype.pinchMove = function(t) {
            if (null != t.touches && 2 == t.touches.length && null != this.startTouches) {
                this.pinchZoomDirty = !0,
                this.app.container.addClass("df-pinch-zoom");
                var i = Ze.calculateScale(this.startTouches, Ze.getTouches(t));
                this.lastScale;
                return this.lastScale = i,
                this.app.viewer.pinchZoomUpdateScale = Ze.limitAt(i, this.app.viewer.minZoom / this.app.zoomValue, this.app.viewer.maxZoom / this.app.zoomValue),
                this.app.viewer._pinchZoomLastScale != this.app.viewer.pinchZoomUpdateScale && (this.app.viewer.pinchZoomRequestStatus = e.REQUEST_STATUS.ON,
                this.app.viewer._pinchZoomLastScale = this.app.viewer.pinchZoomUpdateScale),
                void t.preventDefault()
            }
        }
        ;
        var Ke = function(t) {
            Ve(n, t);
            var i = Ge(n);
            function n(t, o) {
                return Be(this, n),
                t.flipbook3DTiltAngleUp = 0,
                t.flipbook3DTiltAngleLeft = 0,
                t.hasSpiral = !1,
                t.flexibility = 0,
                t.cover3DType !== e.FLIPBOOK_COVER_TYPE.RIDGE && t.cover3DType !== e.FLIPBOOK_COVER_TYPE.BASIC || (t.cover3DType = e.FLIPBOOK_COVER_TYPE.PLAIN),
                i.call(this, t, o)
            }
            return Ue(n, [{
                key: "init",
                value: function() {
                    je(qe(n.prototype), "init", this).call(this),
                    this.texturePowerOfTwo = !1,
                    this.app.container.addClass("df-hybrid-viewer df-pending")
                }
            }, {
                key: "getAnnotationElement",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
                    return je(qe(n.prototype), "getAnnotationElement", this).call(this, e, t, !0)
                }
            }, {
                key: "getTextElement",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
                    return je(qe(n.prototype), "getTextElement", this).call(this, e, t, !0)
                }
            }, {
                key: "isAnimating",
                value: function() {
                    return this.isFlipping()
                }
            }, {
                key: "onCenterStartAnimation",
                value: function(e) {
                    this.app.container.addClass("df-hide-zoomview")
                }
            }, {
                key: "onCenterStopAnimation",
                value: function(e) {
                    this.finalizeCenterAnimation()
                }
            }, {
                key: "onCenterCompleteAnimation",
                value: function(e) {
                    this.zoomViewer.updateCenter(),
                    this.finalizeCenterAnimation()
                }
            }, {
                key: "finalizeCenterAnimation",
                value: function() {
                    this.app.container.removeClass("df-hide-zoomview")
                }
            }, {
                key: "afterFlip",
                value: function() {
                    !0 !== this.isAnimating() && (this.pagesReady(),
                    this.updatePendingStatusClass(),
                    this.updateZoomViewerTexture({
                        pageNumber: this.getBasePage()
                    }),
                    this.updateZoomViewerTexture({
                        pageNumber: this.getBasePage() + 1
                    }))
                }
            }, {
                key: "exchangeTexture",
                value: function(e, t) {
                    this.skipCenterAnimation = !0,
                    je(qe(n.prototype), "exchangeTexture", this).call(this, e, t),
                    this.updateZoomViewerTextContent({
                        pageNumber: this.getBasePage()
                    }),
                    this.updateZoomViewerTextContent({
                        pageNumber: this.getBasePage() + 1
                    })
                }
            }, {
                key: "updateZoomViewerTexture",
                value: function(e) {
                    var t = this.zoomViewer.getPageByNumber(e.pageNumber);
                    t && "-1" === t.textureStamp && (this.zoomViewer.setPage({
                        pageNumber: t.pageNumber,
                        texture: this.getPageByNumber(t.pageNumber).getTexture()
                    }) && this.updateZoomViewerTextContent(e))
                }
            }, {
                key: "updateZoomViewerTextContent",
                value: function(e) {
                    this.app.provider.processAnnotations(e.pageNumber, this.app.viewer.getAnnotationElement(e.pageNumber, !0)),
                    this.app.provider.processTextContent(e.pageNumber, this.app.viewer.getTextElement(e.pageNumber, !0))
                }
            }, {
                key: "textureLoadedCallback",
                value: function(e) {
                    this.app.renderRequestStart(),
                    this.updateZoomViewerTexture(e),
                    this.pagesReady()
                }
            }, {
                key: "resizeAnnotations",
                value: function(e) {}
            }]),
            n
        }(Me)
          , Qe = function(e) {
            Ve(i, e);
            var t = Ge(i);
            function i(e, n) {
                var o;
                return Be(this, i),
                (o = t.call(this, e, n)).orientation = "vertical",
                o
            }
            return Ue(i)
        }(Me)
          , Xe = Ue((function t(i, n) {
            return Be(this, t),
            0 != e.utils.canSupport3D() && void 0 !== i.is3D || (i.is3D = !1),
            "flat3D" === i.is3D ? (i.flexibility = 0,
            new Ke(i,n)) : "calendar3D" === i.is3D ? new Qe(i,n) : Ze.isTrue(i.is3D) ? new Me(i,n) : new ue(i,n)
        }
        ));
        function Ye(e, t) {
            return Ye = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            Ye(e, t)
        }
        function Je(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = et(e);
                if (t) {
                    var o = et(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === tt(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return $e(e)
                }(this, i)
            }
        }
        function $e(e) {
            if (void 0 === e)
                throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }
        function et(e) {
            return et = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            et(e)
        }
        function tt(e) {
            return tt = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            tt(e)
        }
        function it(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function nt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== tt(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== tt(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === tt(a) ? a : String(a)), n)
            }
            var o, a
        }
        function ot(e, t, i) {
            return t && nt(e.prototype, t),
            i && nt(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        e.viewers = e.viewers || {},
        e.viewers.flipbook = Xe,
        e.viewers.default = e.viewers.reader = F,
        e.viewers.slider = Pe;
        var at = e.utils
          , rt = function() {
            function t() {
                it(this, t),
                this.baseUrl = null,
                this.pdfDocument = null,
                this.pdfApp = null,
                this.pdfHistory = null,
                this.externalLinkRel = null,
                this.externalLinkEnabled = !0,
                this._pagesRefCache = null
            }
            return ot(t, [{
                key: "dispose",
                value: function() {
                    this.baseUrl = null,
                    this.pdfDocument = null,
                    this.pdfApp = null,
                    this.pdfHistory = null,
                    this._pagesRefCache = null
                }
            }, {
                key: "setDocument",
                value: function(e, t) {
                    this.baseUrl = t,
                    this.pdfDocument = e,
                    this._pagesRefCache = Object.create(null)
                }
            }, {
                key: "setViewer",
                value: function(e) {
                    this.pdfApp = e,
                    this.externalLinkTarget = e.options.linkTarget
                }
            }, {
                key: "setHistory",
                value: function(e) {
                    this.pdfHistory = e
                }
            }, {
                key: "pagesCount",
                get: function() {
                    return this.pdfDocument.numPages
                }
            }, {
                key: "page",
                get: function() {
                    return this.pdfApp.currentPageNumber
                },
                set: function(e) {
                    this.pdfApp.gotoPage(e)
                }
            }, {
                key: "navigateTo",
                value: function(e) {
                    this.goToDestination(e)
                }
            }, {
                key: "addLinkAttributes",
                value: function(t, i) {
                    var n = this.externalLinkTarget
                      , o = this.externalLinkRel
                      , a = this.externalLinkEnabled;
                    if (!i || "string" != typeof i)
                        throw new Error('A valid "url" parameter must provided.');
                    var r = (0,
                    at.removeNullCharacters)(i);
                    a ? t.href = t.title = r : (t.href = "",
                    t.title = "Disabled: ".concat(r),
                    t.onclick = function() {
                        return !1
                    }
                    );
                    var s = "";
                    switch (n) {
                    case e.LINK_TARGET.NONE:
                        break;
                    case e.LINK_TARGET.SELF:
                        s = "_self";
                        break;
                    case e.LINK_TARGET.BLANK:
                        s = "_blank";
                        break;
                    case e.LINK_TARGET.PARENT:
                        s = "_parent";
                        break;
                    case e.LINK_TARGET.TOP:
                        s = "_top"
                    }
                    t.target = s,
                    t.rel = "string" == typeof o ? o : "noopener noreferrer nofollow"
                }
            }, {
                key: "goToDestination",
                value: function(e) {
                    var t, i = "", n = this, o = function t(o) {
                        at.log("Requested: ", o);
                        var a = o instanceof Object ? n._pagesRefCache[o.num + " " + o.gen + " R"] : o + 1;
                        a ? ((a = n.pdfApp.viewer.getViewerPageNumber(a)) > n.pdfApp.pageCount && (a = n.pdfApp.pageCount),
                        at.log("Loading for:", o, " at page ", a),
                        n.pdfApp.requestDestRefKey === o.num + " " + o.gen + " R" ? (n.pdfApp.gotoPage(a),
                        n.pdfHistory && n.pdfHistory.push({
                            dest: e,
                            hash: i,
                            page: a
                        })) : at.log("Expired Request for ", a, " with ", o)) : (n.pdfApp.container.addClass("df-fetch-pdf"),
                        n.pdfDocument.getPageIndex(o).then((function(e) {
                            var i = e + 1
                              , a = o.num + " " + o.gen + " R";
                            n._pagesRefCache[a] = i,
                            t(o)
                        }
                        )))
                    };
                    "string" == typeof e ? (i = e,
                    t = this.pdfDocument.getDestination(e)) : t = Promise.resolve(e),
                    t.then((function(t) {
                        at.log("Started:", t),
                        e = t,
                        t instanceof Array && (n.pdfApp.requestDestRefKey = t[0].num + " " + t[0].gen + " R",
                        o(t[0]))
                    }
                    ))
                }
            }, {
                key: "customNavigateTo",
                value: function(t) {
                    if ("" !== t && null != t && "null" !== t) {
                        var i = null;
                        if (isNaN(Math.floor(t))) {
                            if ("string" == typeof t && (i = parseInt(t.replace("#", ""), 10),
                            isNaN(i)))
                                return void window.open(t, this.pdfApp.options.linkTarget === e.LINK_TARGET.SELF ? "_self" : "_blank")
                        } else
                            i = t;
                        null != i && this.pdfApp.gotoPage(i)
                    }
                }
            }, {
                key: "getDestinationHash",
                value: function(e) {
                    if ("string" == typeof e)
                        return this.getAnchorUrl("#" + escape(e));
                    if (e instanceof Array) {
                        var t = e[0]
                          , i = t instanceof Object ? this._pagesRefCache[t.num + " " + t.gen + " R"] : t + 1;
                        if (i) {
                            var n = this.getAnchorUrl("#page=" + i)
                              , o = e[1];
                            if ("object" === tt(o) && "name"in o && "XYZ" === o.name) {
                                var a = e[4] || this.pdfApp.pageScaleValue
                                  , r = parseFloat(a);
                                r && (a = 100 * r),
                                n += "&zoom=" + a,
                                (e[2] || e[3]) && (n += "," + (e[2] || 0) + "," + (e[3] || 0))
                            }
                            return n
                        }
                    }
                    return this.getAnchorUrl("")
                }
            }, {
                key: "getCustomDestinationHash",
                value: function(e) {
                    return "#" + escape(e)
                }
            }, {
                key: "getAnchorUrl",
                value: function(e) {
                    return (this.baseUrl || "") + e
                }
            }, {
                key: "executeNamedAction",
                value: function(e) {
                    switch (e) {
                    case "GoBack":
                        this.pdfHistory && this.pdfHistory.back();
                        break;
                    case "GoForward":
                        this.pdfHistory && this.pdfHistory.forward();
                        break;
                    case "NextPage":
                        this.page++;
                        break;
                    case "PrevPage":
                        this.page--;
                        break;
                    case "LastPage":
                        this.page = this.pagesCount;
                        break;
                    case "FirstPage":
                        this.page = 1
                    }
                    var t = document.createEvent("CustomEvent");
                    t.initCustomEvent("namedaction", !0, !0, {
                        action: e
                    }),
                    this.pdfApp.container.dispatchEvent(t)
                }
            }, {
                key: "cachePageRef",
                value: function(e, t) {
                    var i = t.num + " " + t.gen + " R";
                    this._pagesRefCache[i] = e
                }
            }]),
            t
        }()
          , st = function() {
            function e(t, i) {
                it(this, e),
                this.props = t,
                this.app = i,
                this.textureCache = [],
                this.pageCount = 0,
                this.numPages = 0,
                this.outline = [],
                this.viewPorts = [],
                this.requestedPages = "",
                this.requestIndex = 0,
                this.pagesToClean = [],
                this.defaultPage = void 0,
                this.pageSize = this.app.options.pageSize,
                this._page1Pass = !1,
                this._page2Pass = !1,
                this.pageLabels = void 0,
                this.textSearchLength = 0,
                this.textSearch = "",
                this.textContentSearch = [],
                this.textContentJoinedSearch = [],
                this.textOffsetSearch = [],
                this.textContent = [],
                this.textContentJoined = [],
                this.textOffset = [],
                this.autoLinkItemsCache = [],
                this.autoLinkHitsCache = [],
                this.searchHitItemsCache = [],
                this.searchHits = [],
                this.PDFLinkItemsCache = [],
                this.canPrint = !0,
                this.textPostion = []
            }
            return ot(e, [{
                key: "finalize",
                value: function() {}
            }, {
                key: "dispose",
                value: function() {}
            }, {
                key: "softDispose",
                value: function() {}
            }, {
                key: "setCache",
                value: function(e, t, i) {
                    var n = this
                      , o = i;
                    i && (void 0 === n.textureCache[o] && (n.textureCache[o] = []),
                    n.textureCache[o][e] = t)
                }
            }, {
                key: "getCache",
                value: function(e, t) {
                    return void 0 === this.textureCache[t] ? void 0 : this.textureCache[t][e]
                }
            }, {
                key: "_isValidPage",
                value: function(e) {
                    return e > 0 && e <= this.pageCount
                }
            }, {
                key: "getLabelforPage",
                value: function(e) {
                    return this.pageLabels && void 0 !== this.pageLabels[e - 1] ? this.pageLabels[e - 1] : e
                }
            }, {
                key: "getThumbLabel",
                value: function(e) {
                    var t = this.getLabelforPage(e);
                    return t !== e ? t + " (" + e + ")" : e
                }
            }, {
                key: "getPageNumberForLabel",
                value: function(e) {
                    if (!this.pageLabels)
                        return e;
                    var t = this.pageLabels.indexOf(e);
                    return t < 0 ? null : t + 1
                }
            }, {
                key: "processPage",
                value: function(e) {}
            }, {
                key: "cleanUpPages",
                value: function() {}
            }, {
                key: "checkRequestQueue",
                value: function() {}
            }, {
                key: "processAnnotations",
                value: function() {}
            }, {
                key: "processTextContent",
                value: function() {}
            }, {
                key: "loadDocument",
                value: function() {}
            }, {
                key: "pagesLoaded",
                value: function() {
                    var e = this;
                    e._page1Pass && e._page2Pass && (e.app.viewer.checkDocumentPageSizes(),
                    e.finalize())
                }
            }, {
                key: "_documentLoaded",
                value: function() {
                    this.finalizeOutLine(),
                    this.app && this.app.dimensions && void 0 === this.app.dimensions.pageFit && at.log("Provider needs to initialize page properties for the app"),
                    this.app._documentLoaded()
                }
            }, {
                key: "finalizeOutLine",
                value: function() {
                    if (null !== this.app && null !== this.app.options) {
                        var e = this.app.options.outline;
                        if (e)
                            for (var t = 0; t < e.length; t++)
                                e[t].custom = !0,
                                this.outline.push(e[t])
                    }
                }
            }, {
                key: "search",
                value: function() {}
            }]),
            e
        }()
          , lt = function(t) {
            !function(e, t) {
                if ("function" != typeof t && null !== t)
                    throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }),
                Object.defineProperty(e, "prototype", {
                    writable: !1
                }),
                t && Ye(e, t)
            }(o, t);
            var n = Je(o);
            function o(t, a) {
                var r;
                it(this, o);
                var s, l = (r = n.call(this, t, a)).app, u = $e(r);
                function h(t) {
                    l.updateInfo(l.options.text.loading + " PDF Worker ...");
                    var i = document.createElement("a");
                    i.href = l.options.pdfjsWorkerSrc + u.cacheBustParameters,
                    i.hostname !== window.location.hostname && !0 === e.loadCorsPdfjsWorker ? (l.updateInfo(l.options.text.loading + " PDF Worker CORS ..."),
                    jQuery.ajax({
                        url: l.options.pdfjsWorkerSrc + u.cacheBustParameters,
                        cache: !0,
                        success: function(e) {
                            l.options.pdfjsWorkerSrc = at.createObjectURL(e, "text/javascript"),
                            "function" == typeof t && t()
                        }
                    })) : "function" == typeof t && t()
                }
                return u.pdfDocument = void 0,
                u._page2Ratio = void 0,
                u.cacheBustParameters = "?ver=" + e.version + "&pdfver=" + l.options.pdfVersion,
                s = function() {
                    pdfjsLib.GlobalWorkerOptions.workerSrc = l.options.pdfjsWorkerSrc + u.cacheBustParameters,
                    pdfjsLib.canvasWillReadFrequently = e.defaults.canvasWillReadFrequently,
                    u.loadDocument()
                }
                ,
                "undefined" == typeof pdfjsLib ? (l.updateInfo(l.options.text.loading + " PDF Service ..."),
                at.getScript(l.options.pdfjsSrc + u.cacheBustParameters, (function() {
                    "function" == typeof define && i.amdO && window.requirejs && window.require && window.require.config ? (l.updateInfo(l.options.text.loading + " PDF Service (require) ..."),
                    window.require.config({
                        paths: {
                            "pdfjs-dist/build/pdf.worker": l.options.pdfjsWorkerSrc.replace(".js", "")
                        }
                    }),
                    window.require(["pdfjs-dist/build/pdf"], (function(e) {
                        window.pdfjsLib = e,
                        h(s)
                    }
                    ))) : h(s)
                }
                ), (function() {
                    l.updateInfo("Unable to load PDF service.."),
                    u.dispose()
                }
                ), l.options.pdfjsSrc.indexOf("pdfjs-4") > 1)) : "function" == typeof s && s(),
                r
            }
            return ot(o, [{
                key: "dispose",
                value: function() {
                    this.pdfDocument && this.pdfDocument.destroy(),
                    this.linkService = at.disposeObject(this.linkService),
                    this.pdfLoadProgress && this.pdfLoadProgress.destroy(),
                    this.pdfLoadProgress = null,
                    this.pdfDocument = null
                }
            }, {
                key: "loadDocument",
                value: function() {
                    var e = this.app
                      , t = this.app.options
                      , i = this
                      , n = t.pdfParameters || {};
                    if (n.url = at.httpsCorrection(n.url || t.source),
                    n.rangeChunkSize = t.rangeChunkSize,
                    n.cMapPacked = !0,
                    n.disableAutoFetch = t.disableAutoFetch,
                    n.disableStream = t.disableStream,
                    n.disableRange = !0 === t.disableRange,
                    n.disableFontFace = t.disableFontFace,
                    n.isEvalSupported = !1,
                    n.cMapUrl = t.cMapUrl,
                    n.imagesLocation = t.imagesLocation,
                    n.imageResourcesPath = t.imageResourcesPath,
                    n.url || n.data || n.range) {
                        var o = i.pdfLoadProgress = pdfjsLib.getDocument(n);
                        o._worker.promise.then((function(t) {
                            e.updateInfo(e.options.text.loading + " PDF ...")
                        }
                        )),
                        o.onPassword = function(e, t) {
                            switch (t) {
                            case pdfjsLib.PasswordResponses.NEED_PASSWORD:
                                if (null === (i = prompt("Enter the password to open the PDF file.")))
                                    throw new Error("No password givsen.");
                                e(i);
                                break;
                            case pdfjsLib.PasswordResponses.INCORRECT_PASSWORD:
                                var i;
                                if (!(i = prompt("Invalid password. Please try again.")))
                                    throw new Error("No password givaen.");
                                e(i)
                            }
                        }
                        ,
                        o.promise.then((function(n) {
                            i.pdfDocument = n,
                            n.getPage(1).then((function(o) {
                                var a;
                                i.defaultPage = o;
                                var r = i.defaultPage.viewPort = o.getViewport({
                                    scale: 1,
                                    rotation: o._pageInfo.rotate + e.options.pageRotation
                                })
                                  , s = i.defaultPage.pageRatio = r.width / r.height
                                  , l = s > 1;
                                i.viewPorts[1] = r,
                                e.dimensions.defaultPage = {
                                    ratio: s,
                                    viewPort: r,
                                    width: r.width,
                                    height: r.height
                                },
                                e.dimensions.maxTextureHeight = (null !== (a = t.maxTextureSize) && void 0 !== a ? a : 3200) / (l ? s : 1),
                                e.dimensions.maxTextureWidth = e.dimensions.maxTextureHeight * s,
                                e.dimensions.autoHeightRatio = 1 / s,
                                i.pageCount = n.numPages,
                                i.numPages = n.numPages,
                                i._page1Pass = !0,
                                i.pagesLoaded()
                            }
                            )),
                            n.numPages > 1 && !0 === e.checkSecondPage ? n.getPage(2).then((function(t) {
                                var n = t.getViewport({
                                    scale: 1,
                                    rotation: t._pageInfo.rotate + e.options.pageRotation
                                });
                                i._page2Ratio = n.width / n.height,
                                i.viewPorts[2] = n,
                                i._page2Pass = !0,
                                i.pagesLoaded()
                            }
                            )) : (i._page2Pass = !0,
                            i.pagesLoaded())
                        }
                        )).catch((function(t) {
                            if (null !== e && null != e.options) {
                                var n, o = "", a = document.createElement("a");
                                a.href = e.options.source,
                                a.hostname === window.location.hostname || -1 !== a.href.indexOf("file://") || at.isChromeExtension() || -1 !== a.href.indexOf("blob:") || (o = "<strong>CROSS ORIGIN!! </strong>");
                                var r = (null === (n = e.options) || void 0 === n ? void 0 : n.fileName) || a.href;
                                e.updateInfo(o + "<strong>Error: Cannot access file!  </strong>" + unescape(r) + "<br><br>" + t.message, "df-error"),
                                console.log(t),
                                e.container.removeClass("df-loading").addClass("df-error"),
                                i.dispose()
                            }
                        }
                        )),
                        o.getTotalLength = function() {
                            return i.pdfLoadProgress._transport._networkStream._fullRequestReader.contentLength
                        }
                        ,
                        o.onProgress = function(t) {
                            if (null !== e) {
                                var i = 100 * t.loaded / o.getTotalLength();
                                isNaN(i) ? t && t.loaded ? (void 0 === o.lastLoaded || o.lastLoaded + 25e4 < t.loaded) && (o.lastLoaded = t.loaded,
                                e.updateInfo(e.options.text.loading + " PDF " + (Math.ceil(t.loaded / 1e4) / 100).toFixed(2).toString() + "MB ...")) : e.updateInfo(e.options.text.loading + " PDF ...") : e.updateInfo(e.options.text.loading + " PDF " + Math.ceil(Math.min(100, i)).toString().split(".")[0] + "% ...")
                            }
                        }
                    } else
                        e.updateInfo("ERROR : No PDF File provided! ", "df-error")
                }
            }, {
                key: "pdfFetchStarted",
                value: function() {
                    this.pdfFetchStatusCount = 0,
                    this.app.container.addClass("df-fetch-pdf"),
                    this.pdfFetchStatus = e.REQUEST_STATUS.COUNT
                }
            }, {
                key: "checkRequestQueue",
                value: function() {}
            }, {
                key: "finalize",
                value: function() {
                    var e = this.app
                      , t = this;
                    null !== e && null !== e.options && (t.linkService = new rt,
                    t.linkService.setDocument(t.pdfDocument, null),
                    t.linkService.setViewer(e),
                    t.pdfDocument.getOutline().then((function(i) {
                        !0 === e.options.overwritePDFOutline && (i = []),
                        i = i || [],
                        t.outline = i
                    }
                    )).finally((function() {
                        t._getLabels()
                    }
                    )))
                }
            }, {
                key: "_getLabels",
                value: function() {
                    var e = this.app
                      , t = this;
                    t.pdfDocument.getPageLabels().then((function(i) {
                        if (i && !0 !== e.options.disablePageLabels) {
                            for (var n = i.length, o = 0, a = 0, r = 0; r < n; r++) {
                                var s = i[r];
                                if (s === (r + 1).toString())
                                    o++;
                                else {
                                    if ("" !== s)
                                        break;
                                    a++
                                }
                            }
                            o >= n || a >= n || (t.pageLabels = i)
                        }
                    }
                    )).finally((function() {
                        t._getPermissions()
                    }
                    ))
                }
            }, {
                key: "_getPermissions",
                value: function() {
                    var e = this.app
                      , t = this;
                    t.pdfDocument.getPermissions().then((function(i) {
                        null !== i && Array.isArray(i) && (t.canPrint = i.indexOf(pdfjsLib.PermissionFlag.PRINT) > -1,
                        0 == t.canPrint && (console.log("PDF printing is disabled."),
                        e.options.showPrintControl = e.options.showPrintControl && t.canPrint))
                    }
                    )).finally((function() {
                        t._documentLoaded()
                    }
                    ))
                }
            }, {
                key: "processPage",
                value: function(e) {
                    var t = this.app
                      , i = this
                      , n = e.pageNumber
                      , o = performance.now()
                      , a = t.viewer.getDocumentPageNumber(n);
                    at.log("Requesting PDF Page:" + a),
                    i.pdfDocument.getPage(a).then((function(r) {
                        i.viewPorts[n] || (e.isFreshPage = !0,
                        i.viewPorts[n] = r.getViewport({
                            scale: 1,
                            rotation: r._pageInfo.rotate + t.options.pageRotation
                        }));
                        var s, l = t.viewer.getRenderContext(r, e);
                        e.isFreshPage && (null === (s = t.viewer.getPageByNumber(e.pageNumber)) || void 0 === s || s.changeTexture(e.pageNumber, l.canvas.height));
                        at.log("Page " + n + " rendering - " + l.canvas.width + "x" + l.canvas.height),
                        e.trace = i.requestIndex++,
                        i.requestedPages += "," + e.trace + "[" + a + "|" + l.canvas.height + "]",
                        r.cleanupAfterRender = !1,
                        r.render(l).promise.then((function() {
                            if (t.applyTexture(l.canvas, e),
                            !0 === t.options.cleanupAfterRender) {
                                var s = "," + e.trace + "[" + a + "|" + l.canvas.height + "]";
                                at.log("CleanUp Requesting for (" + n + ") actual " + a),
                                i.requestedPages.indexOf(s) > -1 && (i.requestedPages = i.requestedPages.replace(s, ""),
                                -1 == i.requestedPages.indexOf("[" + a + "|") ? (at.log("CleanUp Passed for (" + n + ") actual " + a),
                                i.pagesToClean.push(r),
                                i.pagesToClean.length > 0 && i.cleanUpPages()) : at.log("CleanUp Cancelled waiting for (" + n + ") actual " + a + " : " + i.requestedPages))
                            }
                            l = null,
                            at.log("Rendered " + n + " in " + (performance.now() - o) + " milliseconds")
                        }
                        )).catch((function(e) {
                            console.log(e)
                        }
                        ))
                    }
                    )).catch((function(e) {
                        console.log(e)
                    }
                    ))
                }
            }, {
                key: "cleanUpPages",
                value: function() {
                    for (; this.pagesToClean.length > 0; ) {
                        var e = this.pagesToClean.splice(-1)[0];
                        at.log("Cleanup Completed for PDF page: " + (e._pageIndex + 1)),
                        e.cleanup()
                    }
                }
            }, {
                key: "clearSearch",
                value: function() {
                    var e = this;
                    e.searchHits = [],
                    e.searchHitItemsCache = [],
                    e.totalHits = 0,
                    e.app.searchResults.html(""),
                    e.app.container.removeClass("df-search-open"),
                    e.textSearch = "",
                    e.app.container.find(".df-search-hits").remove()
                }
            }, {
                key: "search",
                value: function(e) {
                    var t = this;
                    t.textSearch !== e && (t.clearSearch(),
                    e.length < 3 && "" != e ? t.app.updateSearchInfo("Minimum 3 letters required.") : (t.textSearch = e,
                    t.textSearchLength = e.length,
                    t.app.searchContainer.addClass("df-searching"),
                    t.app.container.addClass("df-fetch-pdf"),
                    t._search(e, 1)))
                }
            }, {
                key: "_search",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1
                      , i = this;
                    i.app.updateSearchInfo("Searching Page: " + t),
                    i.searchPage(t).then((function(n) {
                        for (var o, a = n, r = new RegExp(e,"gi"), s = []; o = r.exec(a); )
                            s.push({
                                index: o.index,
                                length: i.textSearchLength
                            });
                        if (i.searchHits[t] = s,
                        s.length > 0) {
                            var l = i.app.viewer.searchPage(t);
                            !0 === l.include && (i.totalHits += s.length,
                            i.app.searchResults.append('<div class="df-search-result ' + (i.app.currentPageNumber === t ? "df-active" : "") + '" data-df-page="' + t + '"><span>Page ' + l.label + "</span><span>" + s.length + " " + (s.length > 1 ? "results" : "result") + "</span></div>"))
                        }
                        i.app.viewer.isActivePage(t) && (i.processTextContent(t, i.app.viewer.getTextElement(t, !0)),
                        i.app.ui.update()),
                        i._search(e, t + 1)
                    }
                    )).catch((function() {}
                    )).finally((function() {
                        0 == i.totalHits ? i.app.updateSearchInfo("No results Found!") : i.app.updateSearchInfo(i.totalHits + " results found"),
                        i.app.searchContainer.removeClass("df-searching"),
                        i.app.container.removeClass("df-fetch-pdf")
                    }
                    ))
                }
            }, {
                key: "prepareTextContent",
                value: function(e, t) {
                    var i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
                    if (null == (n = this).textContentJoinedSearch[t] || i) {
                        var n, o, a = 0, r = 0, s = 0;
                        (n = this).textContentSearch[t] = [],
                        n.textContent[t] = [],
                        n.textOffsetSearch[t] = [],
                        n.textOffset[t] = [],
                        n.textContentJoinedSearch[t] = [],
                        n.textContentJoined[t] = [];
                        for (var l = 0; l < e.items.length; l++)
                            o = e.items[l],
                            n.textContentSearch[t].push(!0 === o.hasEOL ? o.str + " " : o.str),
                            n.textContent[t].push(o.str + " "),
                            r += s = (o.str.length || 0) + (!0 === o.hasEOL ? 1 : 0),
                            n.textOffsetSearch[t].push({
                                length: s,
                                offset: r - s
                            }),
                            a += s = (o.str.length || 0) + 1,
                            n.textOffset[t].push({
                                length: s,
                                offset: a - s
                            });
                        n.textContentJoinedSearch[t] = n.textContentSearch[t].join(""),
                        n.textContentJoined[t] = n.textContent[t].join("")
                    }
                }
            }, {
                key: "searchPage",
                value: function(e) {
                    var t = this;
                    return new Promise((function(i, n) {
                        if (t._isValidPage(e))
                            try {
                                var o = t.app.viewer.getDocumentPageNumber(e);
                                null == t.textContentJoinedSearch[o] ? t.pdfDocument.getPage(o).then((function(e) {
                                    e.getTextContent().then((function(e) {
                                        t.prepareTextContent(e, o),
                                        i(t.textContentJoinedSearch[o])
                                    }
                                    ))
                                }
                                )) : i(t.textContentJoinedSearch[o])
                            } catch (e) {
                                at.log(e),
                                n(e)
                            }
                        else
                            n()
                    }
                    ))
                }
            }]),
            o
        }(st);
        function ut(e, t) {
            return ut = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function(e, t) {
                return e.__proto__ = t,
                e
            }
            ,
            ut(e, t)
        }
        function ht(e) {
            var t = function() {
                if ("undefined" == typeof Reflect || !Reflect.construct)
                    return !1;
                if (Reflect.construct.sham)
                    return !1;
                if ("function" == typeof Proxy)
                    return !0;
                try {
                    return Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], (function() {}
                    ))),
                    !0
                } catch (e) {
                    return !1
                }
            }();
            return function() {
                var i, n = ct(e);
                if (t) {
                    var o = ct(this).constructor;
                    i = Reflect.construct(n, arguments, o)
                } else
                    i = n.apply(this, arguments);
                return function(e, t) {
                    if (t && ("object" === dt(t) || "function" == typeof t))
                        return t;
                    if (void 0 !== t)
                        throw new TypeError("Derived constructors may only return object or undefined");
                    return pt(e)
                }(this, i)
            }
        }
        function pt(e) {
            if (void 0 === e)
                throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }
        function ct(e) {
            return ct = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            }
            ,
            ct(e)
        }
        function dt(e) {
            return dt = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            dt(e)
        }
        function ft(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function gt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== dt(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== dt(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === dt(a) ? a : String(a)), n)
            }
            var o, a
        }
        function vt(e, t, i) {
            return t && gt(e.prototype, t),
            i && gt(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        e.providers.pdf = lt;
        var mt = e.utils
          , yt = function() {
            function e(t) {
                ft(this, e),
                this._viewPort = new wt(0,0),
                this._pageInfo = {
                    rotate: 0
                },
                this.src = t.src
            }
            return vt(e, [{
                key: "getViewport",
                value: function() {
                    var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {
                        scale: 1
                    };
                    return new wt(this._viewPort.height * e.scale,this._viewPort.width * e.scale,e.scale)
                }
            }]),
            e
        }()
          , bt = function() {
            function e(t) {
                ft(this, e),
                this.source = [],
                this.pages = [],
                this.numPages = t.length;
                for (var i = 0; i < t.length; i++)
                    this.source[i] = mt.httpsCorrection(t[i].toString()),
                    this.pages.push(new yt({
                        src: this.source[i]
                    }))
            }
            return vt(e, [{
                key: "getPage",
                value: function(e) {
                    var t = this;
                    return new Promise((function(i, n) {
                        try {
                            jQuery("<img/>").attr("src", t.source[e - 1]).prop("crossOrigin", "Anonymous").on("load", (function() {
                                jQuery(this).off();
                                var e = new yt({
                                    src: this.src
                                });
                                e._viewPort.height = this.height,
                                e._viewPort.width = this.width,
                                e._viewPort.scale = 1,
                                e.image = this,
                                i(e)
                            }
                            ))
                        } catch (e) {
                            n(e)
                        }
                    }
                    ))
                }
            }]),
            e
        }()
          , wt = function() {
            function e(t, i) {
                var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1;
                ft(this, e),
                this.scale = n,
                this.height = t,
                this.width = i,
                this.scale = n,
                this.transform = [0, 0, 0, 0, 0, this.height]
            }
            return vt(e, [{
                key: "clone",
                value: function() {
                    return new e(this.height,this.width,this.scale)
                }
            }]),
            e
        }()
          , Pt = function(e) {
            !function(e, t) {
                if ("function" != typeof t && null !== t)
                    throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }),
                Object.defineProperty(e, "prototype", {
                    writable: !1
                }),
                t && ut(e, t)
            }(i, e);
            var t = ht(i);
            function i(e, n) {
                var o;
                ft(this, i);
                var a = (o = t.call(this, e, n)).app
                  , r = pt(o);
                return r.document = new bt(a.options.source),
                r.pageCount = r.document.numPages,
                r.numPages = r.document.numPages,
                r.loadDocument(),
                o
            }
            return vt(i, [{
                key: "dispose",
                value: function() {}
            }, {
                key: "loadDocument",
                value: function() {
                    var e = this.app
                      , t = this.app.options
                      , i = this;
                    i.document.getPage(1).then((function(n) {
                        var o;
                        i.defaultPage = n;
                        var a = i.defaultPage.viewPort = n._viewPort
                          , r = i.defaultPage.pageRatio = a.width / a.height
                          , s = r > 1;
                        i.viewPorts[1] = a,
                        e.dimensions.defaultPage = {
                            ratio: r,
                            viewPort: a,
                            width: a.width,
                            height: a.height
                        },
                        e.dimensions.maxTextureHeight = (null !== (o = t.maxTextureSize) && void 0 !== o ? o : 3200) / (s ? r : 1),
                        e.dimensions.maxTextureWidth = e.dimensions.maxTextureHeight * r,
                        e.dimensions.autoHeightRatio = 1 / r,
                        i._page1Pass = !0,
                        i.pagesLoaded()
                    }
                    )),
                    i.pageCount > 1 && !0 === e.checkSecondPage ? i.document.getPage(2).then((function(e) {
                        var t = e._viewPort;
                        i._page2Ratio = t.width / t.height,
                        i.viewPorts[2] = t,
                        i._page2Pass = !0,
                        i.pagesLoaded()
                    }
                    )) : (i._page2Pass = !0,
                    i.pagesLoaded())
                }
            }, {
                key: "finalize",
                value: function() {
                    var e = this.app
                      , t = this;
                    null !== e && null !== e.options && (t.linkService = new rt,
                    t.linkService.setViewer(e),
                    t._documentLoaded())
                }
            }, {
                key: "processPage",
                value: function(e) {
                    var t = this.app
                      , i = this
                      , n = e.pageNumber
                      , o = performance.now()
                      , a = t.viewer.getDocumentPageNumber(n);
                    mt.log("Requesting PDF Page:" + a),
                    i.document.getPage(a).then((function(a) {
                        i.viewPorts[n] || (e.isFreshPage = !0,
                        i.viewPorts[n] = a._viewPort);
                        var r, s, l = t.viewer.getRenderContext(a, e);
                        e.isFreshPage && (null === (r = t.viewer.getPageByNumber(e.pageNumber)) || void 0 === r || r.changeTexture(e.pageNumber, l.canvas.height));
                        (e.preferCanvas = !0,
                        !0 === e.preferCanvas) ? (l.canvas.getContext("2d").drawImage(a.image, l.viewport.transform[4], 0, l.canvas.width * (null !== (s = l.viewport.widthFix) && void 0 !== s ? s : 1), l.canvas.height),
                        t.applyTexture(l.canvas, e)) : t.applyTexture({
                            src: a.src,
                            height: l.canvas.height,
                            width: l.canvas.width
                        }, e);
                        mt.log("Rendered " + n + " in " + (performance.now() - o) + " milliseconds")
                    }
                    ))
                }
            }]),
            i
        }(st);
        e.providers.image = Pt;
        i(745);
        function St(e) {
            return St = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            St(e)
        }
        function Ct(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function")
        }
        function Tt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== St(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== St(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === St(a) ? a : String(a)), n)
            }
            var o, a
        }
        function xt(e, t, i) {
            return t && Tt(e.prototype, t),
            i && Tt(e, i),
            Object.defineProperty(e, "prototype", {
                writable: !1
            }),
            e
        }
        var kt = e.jQuery
          , Et = e.utils
          , Ot = e.REQUEST_STATUS
          , Rt = function() {
            function t(e, i) {
                Ct(this, t),
                this.options = e,
                this.app = i,
                this.parentElement = this.app.container,
                this.element = kt("<div>", {
                    class: "df-ui"
                }),
                this.leftElement = kt("<div>", {
                    class: "df-ui-left"
                }).appendTo(this.element),
                this.centerElement = kt("<div>", {
                    class: "df-ui-center"
                }).appendTo(this.element),
                this.rightElement = kt("<div>", {
                    class: "df-ui-right"
                }).appendTo(this.element),
                this.parentElement.append(this.element),
                this.events = {},
                this.controls = {}
            }
            return xt(t, [{
                key: "init",
                value: function() {
                    var t = this
                      , i = "<div>"
                      , n = this.app
                      , o = this.controls
                      , a = n.options.text
                      , r = n.options.icons;
                    t.createLogo(),
                    this.openRight = o.openRight = kt(i, {
                        class: "df-ui-nav df-ui-next",
                        title: n.isRTL ? a.previousPage : a.nextPage,
                        html: '<div class="df-ui-btn ' + r.next + '"></div>'
                    }).on("click", (function() {
                        n.openRight()
                    }
                    )),
                    this.openLeft = o.openLeft = kt(i, {
                        class: "df-ui-nav df-ui-prev",
                        title: n.isRTL ? a.nextPage : a.previousPage,
                        html: '<div class="df-ui-btn ' + r.prev + '"></div>'
                    }).on("click", (function() {
                        n.openLeft()
                    }
                    )),
                    1 == n.options.autoPlay && (this.play = o.play = Et.createBtn("play", r.play, a.play).on("click", (function() {
                        var e = kt(this);
                        n.setAutoPlay(!e.hasClass(n.options.icons.pause))
                    }
                    )),
                    n.setAutoPlay(n.options.autoPlayStart)),
                    this.pageNumber = o.pageNumber = Et.createBtn("page").on("change", (function() {
                        n.gotoPageLabel(o.pageInput.val())
                    }
                    )).on("keyup", (function(e) {
                        13 === e.keyCode && n.gotoPageLabel(o.pageInput.val())
                    }
                    ));
                    var s = "df_book_page_number_" + Math.ceil(performance.now() / 10);
                    this.pageInput = o.pageInput = kt('<input id="' + s + '" type="text"/>').appendTo(o.pageNumber),
                    this.pageLabel = o.pageLabel = kt('<label for="' + s + '"></label>').appendTo(o.pageNumber),
                    this.thumbnail = o.thumbnail = Et.createBtn("thumbnail", r.thumbnail, a.toggleThumbnails),
                    o.thumbnail.on("click", (function() {
                        var e = kt(this);
                        null == n.thumblist && n.initThumbs(),
                        n.thumbContainer.toggleClass("df-sidemenu-visible"),
                        e.toggleClass("df-active"),
                        e.hasClass("df-active") && (e.siblings(".df-active").trigger("click"),
                        n.thumbRequestStatus = Ot.ON),
                        t.update(),
                        !1 === n.options.sideMenuOverlay && n.resizeRequestStart()
                    }
                    )).addClass("df-sidemenu-trigger"),
                    n.hasOutline() && (this.outline = o.outline = Et.createBtn("outline", r.outline, a.toggleOutline),
                    o.outline.on("click", (function() {
                        var e = kt(this);
                        if (null == n.outlineViewer && n.initOutline(),
                        n.outlineContainer) {
                            var i = n.outlineContainer;
                            e.toggleClass("df-active"),
                            i.toggleClass("df-sidemenu-visible"),
                            e.hasClass("df-active") && e.siblings(".df-active").trigger("click"),
                            t.update(),
                            !1 === n.options.sideMenuOverlay && n.resizeRequestStart()
                        }
                    }
                    )).addClass("df-sidemenu-trigger")),
                    !0 === n.options.showSearchControl && !0 !== Et.isMobile && "string" == typeof n.options.source && (o.search = Et.createBtn("search", r.search, a.search),
                    o.search.on("click", (function() {
                        var e = kt(this);
                        if (null == n.searchContainer && n.initSearch(),
                        n.searchContainer) {
                            var i = n.searchContainer;
                            e.toggleClass("df-active"),
                            i.toggleClass("df-sidemenu-visible"),
                            e.hasClass("df-active") && (e.siblings(".df-active").trigger("click"),
                            n.searchBox.focus()),
                            t.update(),
                            !1 === n.options.sideMenuOverlay && n.resizeRequestStart()
                        }
                    }
                    )).addClass("df-sidemenu-trigger"));
                    var l = t.element;
                    if (this.zoomIn = o.zoomIn = Et.createBtn("zoomin", r.zoomin, a.zoomIn).on("click", (function() {
                        n.zoom(1),
                        t.update()
                    }
                    )),
                    this.zoomOut = o.zoomOut = Et.createBtn("zoomout", r.zoomout, a.zoomOut).on("click", (function() {
                        n.zoom(-1),
                        t.update()
                    }
                    )),
                    this.resetZoom = o.resetZoom = Et.createBtn("resetzoom", r.resetzoom, a.resetZoom).on("click", (function() {
                        n.resetZoom(-1),
                        t.update()
                    }
                    )),
                    n.viewer.isFlipBook) {
                        if (n.pageCount > 2) {
                            var u = n.viewer.pageMode === e.FLIPBOOK_PAGE_MODE.SINGLE;
                            this.pageMode = o.pageMode = Et.createBtn("pagemode", r[u ? "doublepage" : "singlepage"], u ? a.doublePageMode : a.singlePageMode).on("click", (function() {
                                var e = kt(this);
                                n.viewer.setPageMode({
                                    isSingle: !e.hasClass(r.doublepage)
                                }),
                                n.viewer.pageModeChangedManually = !0
                            }
                            ))
                        }
                    } else
                        this.pageFit = o.pageFit = Et.createBtn("pagefit", r.pagefit, a.pageFit).on("click", (function() {
                            var e = o.pageFit;
                            !0 === !e.hasClass(r.widthfit) ? (e.addClass(r.widthfit),
                            e.html("<span>" + a.widthFit + "</span>"),
                            e.attr("title", a.widthFit)) : (e.removeClass(r.widthfit),
                            e.html("<span>" + a.pageFit + "</span>"),
                            e.attr("title", a.pageFit))
                        }
                        ));
                    if (t.shareBox = new Lt(n.container,n.options),
                    this.share = o.share = Et.createBtn("share", r.share, a.share).on("click", (function() {
                        !0 === t.shareBox.isOpen ? t.shareBox.close() : (t.shareBox.update(n.getURLHash()),
                        t.shareBox.show())
                    }
                    )),
                    this.more = o.more = Et.createBtn("more", r.more).on("click", (function(e) {
                        !0 !== t.moreContainerOpen && (kt(this).addClass("df-active"),
                        t.moreContainerOpen = !0,
                        e.stopPropagation())
                    }
                    )),
                    this.startPage = o.startPage = Et.createBtn("start", r.start, a.gotoFirstPage).on("click", (function() {
                        n.start()
                    }
                    )),
                    this.endPage = o.endPage = Et.createBtn("end", r.end, a.gotoLastPage).on("click", (function() {
                        n.end()
                    }
                    )),
                    !0 === n.options.showPrintControl && !0 !== Et.isMobile && "string" == typeof n.options.source && (this.print = o.print = Et.createBtn("print", r.print, a.print).on("click", (function() {
                        e.printHandler = e.printHandler || new It,
                        e.printHandler.printPDF(n.options.source)
                    }
                    ))),
                    !0 === n.options.showDownloadControl && "string" == typeof n.options.source) {
                        var h = "df-ui-btn df-ui-download " + r.download;
                        this.download = o.download = kt('<a download target="_blank" class="' + h + '"><span>' + a.downloadPDFFile + "</span></a>"),
                        o.download.attr("href", Et.httpsCorrection(n.options.source)).attr("title", a.downloadPDFFile)
                    }
                    t.moreContainer = kt(i, {
                        class: "df-more-container"
                    }),
                    o.more.append(t.moreContainer),
                    !0 === n.options.isLightBox && !0 !== n.fullscreenSupported || (this.fullScreen = o.fullScreen = Et.createBtn("fullscreen", r.fullscreen, a.toggleFullscreen).on("click", n.switchFullscreen.bind(n))),
                    n.viewer.initCustomControls();
                    var p = n.options.allControls.replace(/ /g, "").split(",")
                      , c = "," + n.options.moreControls.replace(/ /g, "") + ","
                      , d = "," + n.options.hideControls.replace(/ /g, "") + ",";
                    n.options.leftControls.replace(/ /g, ""),
                    n.options.rightControls.replace(/ /g, "");
                    d += ",";
                    for (var f = 0; f < p.length; f++) {
                        var g = p[f];
                        if (d.indexOf("," + g + ",") < 0) {
                            var v = o[g];
                            null != v && "object" == St(v) && (c.indexOf("," + g + ",") > -1 && "more" !== g && "pageNumber" !== g ? t.moreContainer.append(v) : 1 == n.options.controlsFloating ? l.append(v) : this.centerElement.append(v))
                        }
                    }
                    0 == t.moreContainer.children().length && this.more.addClass("df-hidden"),
                    n.container.append(l),
                    n.container.append(o.openLeft),
                    n.container.append(this.controls.openRight),
                    window.addEventListener("click", t.events.closePanels = t.closePanels.bind(t), !1),
                    window.addEventListener("keyup", t.events.keyup = t.keyUp.bind(t), !1),
                    document.addEventListener("fullscreenchange", t.events.fullscreenChange = t.fullscreenChange.bind(t), !1),
                    !0 === n.options.autoOpenThumbnail && t.controls.thumbnail.trigger("click"),
                    n.hasOutline() && !0 === n.options.autoOpenOutline && t.controls.outline.trigger("click"),
                    n.executeCallback("onCreateUI")
                }
            }, {
                key: "closePanels",
                value: function(e) {
                    var t;
                    !0 === this.moreContainerOpen && (null === (t = this.controls.more) || void 0 === t || t.removeClass("df-active"),
                    this.moreContainerOpen = !1)
                }
            }, {
                key: "fullscreenChange",
                value: function(e) {
                    void 0 === Et.getFullscreenElement() && !0 === this.app.isFullscreen && this.app.switchFullscreen()
                }
            }, {
                key: "keyUp",
                value: function(t) {
                    var i = this.app;
                    if ("INPUT" !== t.target.nodeName) {
                        var n = !0 === i.isFullscreen || !0 === i.options.isLightBox || i.options.arrowKeysAction === e.ARROW_KEYS_ACTIONS.NAV;
                        switch (t.keyCode) {
                        case 27:
                            e.activeLightBox && e.activeLightBox.app && !Et.isChromeExtension() && e.activeLightBox.closeButton.trigger("click");
                            break;
                        case 37:
                            n && i.openLeft();
                            break;
                        case 39:
                            n && i.openRight()
                        }
                    }
                }
            }, {
                key: "createLogo",
                value: function() {
                    var e = this.app
                      , t = null;
                    e.options.logo.indexOf("<") > -1 ? t = kt(e.options.logo).addClass("df-logo df-logo-html") : e.options.logo.trim().length > 2 && (t = kt('<a class="df-logo df-logo-img" target="_blank" href="' + e.options.logoUrl + '"><img alt="" src="' + e.options.logo + '"/>')),
                    this.element.append(t)
                }
            }, {
                key: "dispose",
                value: function() {
                    var e = this;
                    for (var t in this.controls)
                        if (this.controls.hasOwnProperty(t)) {
                            var i = this.controls[t];
                            null !== i && "object" == St(i) && i.off().remove()
                        }
                    e.element.remove(),
                    e.shareBox = Et.disposeObject(e.shareBox),
                    window.removeEventListener("click", e.events.closePanels, !1),
                    window.removeEventListener("keyup", e.events.keyup, !1),
                    document.removeEventListener("fullscreenchange", e.events.fullscreenChange, !1)
                }
            }, {
                key: "update",
                value: function() {
                    var e = this.app
                      , t = this.controls;
                    !0 !== this._pageLabelWidthSet && (this.pageLabel.width(""),
                    e.provider.pageLabels ? this.pageLabel.html("88888888888888888".substring(0, 3 * e.pageCount.toString().length + 4)) : this.pageLabel.html("88888888888".substring(0, 2 * e.pageCount.toString().length + 3)),
                    this.pageNumber.width(this.pageLabel.width()),
                    this.pageLabel.width(this.pageLabel.width()),
                    this.pageLabel.html(""),
                    this._pageLabelWidthSet = !0);
                    var i = e.getCurrentLabel();
                    i.toString() !== e.currentPageNumber.toString() ? t.pageLabel.html(i + "(" + e.currentPageNumber + "/" + e.pageCount + ")") : t.pageLabel.html(i + "/" + e.pageCount),
                    t.pageInput.val(i),
                    e.container.toggleClass("df-sidemenu-open", e.container.find(".df-sidemenu-visible").length > 0);
                    var n = e.provider.totalHits > 0 && e.container.find(".df-sidemenu-visible.df-search-container").length > 0;
                    if (e.container.toggleClass("df-search-open", n),
                    n) {
                        var o = e.searchContainer.find(".df-search-result[data-df-page=" + e.currentPageNumber + "]");
                        if (e.searchContainer.find(".df-search-result.df-active").removeClass("df-active"),
                        o.length > 0 && !o.hasClass(".df-active")) {
                            o.addClass("df-active");
                            var a = e.searchResults[0]
                              , r = a.scrollTop;
                            r + a.getBoundingClientRect().height < (o = o[0]).offsetTop + o.scrollHeight ? Et.scrollIntoView(o, null, !1) : r > o.offsetTop && Et.scrollIntoView(o)
                        }
                    }
                    t.zoomIn.toggleClass("disabled", e.zoomValue === e.viewer.maxZoom),
                    t.zoomOut.toggleClass("disabled", e.zoomValue === e.viewer.minZoom);
                    var s = e.isRTL
                      , l = e.currentPageNumber === e.startPage
                      , u = e.currentPageNumber === e.endPage
                      , h = l && !s || u && s
                      , p = u && !s || l && s;
                    t.openRight.toggleClass("df-hidden", p),
                    t.openLeft.toggleClass("df-hidden", h),
                    e.viewer.afterControlUpdate()
                }
            }]),
            t
        }()
          , Lt = function() {
            function e(t, i) {
                Ct(this, e);
                var n = this;
                n.isOpen = !1,
                n.shareUrl = "",
                n.init(t, i)
            }
            return xt(e, [{
                key: "init",
                value: function(e, t) {
                    var i = this;
                    i.wrapper = kt('<div class="df-share-wrapper" style="display: none;">').on("click", (function() {
                        i.close()
                    }
                    )),
                    i.box = kt('<div class="df-share-box">'),
                    i.box.on("click", (function(e) {
                        e.preventDefault(),
                        e.stopPropagation()
                    }
                    )),
                    i.box.appendTo(i.wrapper).html('<span class="df-share-title">' + t.text.share + "</span>"),
                    i.urlInput = kt('<textarea name="df-share-url" class="df-share-url">').on("click", (function() {
                        kt(this).select()
                    }
                    )),
                    i.box.append(i.urlInput);
                    var n = function() {
                        if (t.share.hasOwnProperty(o) && t.hideShareControls.indexOf(o) < 0) {
                            var e = t.share[o];
                            null !== e && (i[o] = kt("<div>", {
                                class: "df-share-button df-share-" + o + " " + t.icons[o]
                            }).on("click", (function(n) {
                                n.preventDefault(),
                                window.open(e.replace("{{url}}", encodeURIComponent(i.shareUrl)).replace("{{mailsubject}}", t.text.mailSubject), "Sharer", "width=500,height=400"),
                                n.stopPropagation()
                            }
                            )),
                            i.box.append(i[o]))
                        }
                    };
                    for (var o in t.share)
                        n();
                    kt(e).append(i.wrapper)
                }
            }, {
                key: "show",
                value: function() {
                    this.wrapper.fadeIn(300),
                    this.urlInput.val(this.shareUrl),
                    this.urlInput.trigger("click"),
                    this.isOpen = !0
                }
            }, {
                key: "dispose",
                value: function() {
                    var e = this;
                    for (var t in e)
                        e.hasOwnProperty(t) && e[t] && e[t].off && e[t].off();
                    e.wrapper.remove()
                }
            }, {
                key: "close",
                value: function() {
                    this.wrapper.fadeOut(300),
                    this.isOpen = !1
                }
            }, {
                key: "update",
                value: function(e) {
                    this.shareUrl = e
                }
            }]),
            e
        }()
          , Nt = function() {
            function t(i) {
                Ct(this, t),
                this.duration = 300;
                var n = this;
                return n.lightboxWrapper = kt("<div>").addClass("df-lightbox-wrapper"),
                n.backGround = kt("<div>").addClass("df-lightbox-bg").appendTo(n.lightboxWrapper),
                n.element = kt("<div>").addClass("df-app").appendTo(n.lightboxWrapper),
                n.controls = kt("<div>").addClass("df-lightbox-controls").appendTo(n.lightboxWrapper),
                n.closeButton = kt("<div>").addClass("df-lightbox-close df-ui-btn " + e.defaults.icons.close).on("click", (function() {
                    n.close(i)
                }
                )).appendTo(n.controls),
                n.lightboxWrapper.append(n.element),
                n
            }
            return xt(t, [{
                key: "show",
                value: function(e) {
                    return 0 === this.lightboxWrapper.parent().length && kt("body").append(this.lightboxWrapper),
                    kt("html,body").addClass("df-lightbox-open"),
                    this.lightboxWrapper.fadeIn(this.duration),
                    "function" == typeof e && e(),
                    this
                }
            }, {
                key: "close",
                value: function(t) {
                    return this.lightboxWrapper.fadeOut(this.duration),
                    Array.prototype.forEach.call(e.utils.getSharePrefixes(), (function(e) {
                        0 === window.location.hash.indexOf("#" + e) && history.replaceState(void 0, void 0, "#_")
                    }
                    )),
                    "function" == typeof t && setTimeout(t, this.duration),
                    kt("html,body").removeClass("df-lightbox-open"),
                    this.element.attr("class", "df-app").attr("style", ""),
                    this.lightboxWrapper.attr("class", "df-lightbox-wrapper").attr("style", ""),
                    this.backGround.attr("style", ""),
                    this
                }
            }]),
            t
        }()
          , It = function() {
            function e() {
                Ct(this, e);
                var t = this;
                return t.frame = kt('<iframe id="df-print-frame" style="display:none">').appendTo(kt("body")),
                t.frame.on("load", (function() {
                    try {
                        t.frame[0].contentWindow.print()
                    } catch (e) {
                        console.log(e)
                    }
                }
                )),
                t
            }
            return xt(e, [{
                key: "printPDF",
                value: function(e) {
                    this.frame[0].src = e
                }
            }]),
            e
        }()
          , _t = function() {
            function e(t, i) {
                Ct(this, e),
                this.options = t,
                this.app = i,
                this.parentElement = t.parentElement,
                this.element = kt("<div>", {
                    class: "df-sidemenu-wrapper"
                }),
                this.parentElement.append(this.element),
                this.buttons = kt("<div>", {
                    class: "df-sidemenu-buttons df-ui-wrapper"
                }).appendTo(this.element),
                this.close = Et.createBtn("close", i.options.icons.close, i.options.text.close),
                this.buttons.append(this.close)
            }
            return xt(e, [{
                key: "dispose",
                value: function() {
                    this.element.remove()
                }
            }]),
            e
        }()
          , At = function() {
            function e(t) {
                Ct(this, e),
                this.outline = null,
                this.lastToggleIsShow = !0,
                this.container = t.container,
                this.linkService = t.linkService,
                this.outlineItemClass = t.outlineItemClass || "outlineItem",
                this.outlineToggleClass = t.outlineToggleClass || "outlineItemToggler",
                this.outlineToggleHiddenClass = t.outlineToggleHiddenClass || "outlineItemsHidden"
            }
            return xt(e, [{
                key: "dispose",
                value: function() {
                    this.container && this.container.parentNode && this.container.parentNode.removeChild(this.container),
                    this.linkService = null
                }
            }, {
                key: "reset",
                value: function() {
                    this.outline = null,
                    this.lastToggleIsShow = !0;
                    for (var e = this.container; e.firstChild; )
                        e.removeChild(e.firstChild)
                }
            }, {
                key: "_dispatchEvent",
                value: function(e) {
                    var t = document.createEvent("CustomEvent");
                    t.initCustomEvent("outlineloaded", !0, !0, {
                        outlineCount: e
                    }),
                    this.container.dispatchEvent(t)
                }
            }, {
                key: "_bindLink",
                value: function(e, t) {
                    var i = this.linkService;
                    if (!0 === t.custom)
                        e.href = i.getCustomDestinationHash(t.dest),
                        e.onclick = function() {
                            return i.customNavigateTo(t.dest),
                            !1
                        }
                        ;
                    else {
                        if (t.url)
                            return void pdfjsLib.addLinkAttributes(e, {
                                url: t.url
                            });
                        e.href = i.getDestinationHash(t.dest),
                        e.onclick = function() {
                            return i.navigateTo(t.dest),
                            !1
                        }
                    }
                }
            }, {
                key: "_addToggleButton",
                value: function(e) {
                    var t = this
                      , i = document.createElement("div");
                    i.className = this.outlineToggleClass + " " + this.outlineToggleHiddenClass,
                    i.onclick = function(n) {
                        if (n.stopPropagation(),
                        i.classList.toggle(this.outlineToggleHiddenClass),
                        n.shiftKey) {
                            var o = !i.classList.contains(this.outlineToggleHiddenClass);
                            t._toggleOutlineItem(e, o)
                        }
                    }
                    .bind(this),
                    e.insertBefore(i, e.firstChild)
                }
            }, {
                key: "_toggleOutlineItem",
                value: function(e, t) {
                    this.lastToggleIsShow = t;
                    for (var i = e.querySelectorAll("." + this.outlineToggleClass), n = 0, o = i.length; n < o; ++n)
                        i[n].classList[t ? "remove" : "add"](this.outlineToggleHiddenClass)
                }
            }, {
                key: "render",
                value: function(e) {
                    var t = e && e.outline || null
                      , i = 0;
                    if (this.outline && this.reset(),
                    this.outline = t,
                    t) {
                        for (var n = document.createDocumentFragment(), o = [{
                            parent: n,
                            items: this.outline,
                            custom: !1
                        }], a = !1; o.length > 0; )
                            for (var r = o.shift(), s = r.custom, l = 0, u = r.items.length; l < u; l++) {
                                var h = r.items[l]
                                  , p = document.createElement("div");
                                p.className = this.outlineItemClass;
                                var c = document.createElement("a");
                                if (null == h.custom && null != s && (h.custom = s),
                                this._bindLink(c, h),
                                c.textContent = h.title.replace(/\x00/g, ""),
                                p.appendChild(c),
                                h.items && h.items.length > 0) {
                                    a = !0,
                                    this._addToggleButton(p);
                                    var d = document.createElement("div");
                                    d.className = this.outlineItemClass + "s",
                                    p.appendChild(d),
                                    o.push({
                                        parent: d,
                                        custom: h.custom,
                                        items: h.items
                                    })
                                }
                                r.parent.appendChild(p),
                                i++
                            }
                        a && (null != this.container.classList ? this.container.classList.add(this.outlineItemClass + "s") : null != this.container.className && (this.container.className += " picWindow")),
                        this.container.appendChild(n),
                        this._dispatchEvent(i)
                    }
                }
            }]),
            e
        }()
          , Mt = function() {
            function t(e) {
                Ct(this, t);
                var i = this.itemHeight = e.itemHeight
                  , n = this.itemWidth = e.itemWidth
                  , o = this.app = e.app;
                this.items = e.items,
                this.generatorFn = e.generatorFn,
                this.totalRows = e.totalRows || e.items && e.items.length,
                this.addFn = e.addFn,
                this.scrollFn = e.scrollFn,
                this.container = document.createElement("div");
                for (var a = this, r = 0; r < this.totalRows; r++) {
                    var s = document.createElement("div")
                      , l = r + 1;
                    s.id = "df-thumb" + l;
                    var u = document.createElement("div")
                      , h = document.createElement("div")
                      , p = document.createElement("div");
                    p.className = "df-wrapper",
                    h.className = "df-thumb-number",
                    s.className = "df-thumb",
                    u.className = "df-bg-image",
                    p.style.height = i + "px",
                    p.style.width = n + "px",
                    h.innerText = o.provider.getLabelforPage(l),
                    s.appendChild(p),
                    p.appendChild(h),
                    p.appendChild(u),
                    this.container.appendChild(s)
                }
                function c() {
                    o.thumbRequestCount = 0,
                    o.thumbRequestStatus = Ot.COUNT
                }
                a.dispose = function() {
                    a.container && a.container.parentNode && a.container.parentNode.removeChild(a.container),
                    a.container.removeEventListener("scroll", c)
                }
                ,
                a.container.addEventListener("scroll", c)
            }
            return xt(t, [{
                key: "processThumbRequest",
                value: function() {
                    Et.log("Thumb Request Initiated");
                    var t = this.app;
                    if ((t.thumbRequestStatus = Ot.OFF,
                    t.activeThumb !== t.currentPageNumber) && (null != t.thumbContainer && t.thumbContainer.hasClass("df-sidemenu-visible"))) {
                        var i = t.thumblist.container
                          , n = i.scrollTop
                          , o = i.getBoundingClientRect().height
                          , a = t.thumbContainer.find("#df-thumb" + t.currentPageNumber);
                        a.length > 0 ? (t.thumbContainer.find(".df-selected").removeClass("df-selected"),
                        a.addClass("df-selected"),
                        n + o < (a = a[0]).offsetTop + a.scrollHeight ? Et.scrollIntoView(a, null, !1) : n > a.offsetTop && Et.scrollIntoView(a),
                        t.activeThumb = t.currentPageNumber) : (kt(i).scrollTop(124 * t.currentPageNumber),
                        t.thumbRequestStatus = Ot.ON)
                    }
                    if (0 === t.thumblist.container.getElementsByClassName("df-thumb-requested").length) {
                        var r = Et.getVisibleElements({
                            container: t.thumblist.container,
                            elements: t.thumblist.container.children
                        });
                        kt.inArray(r) && r.unshift(t.activeThumb);
                        for (var s = 0; s < r.length; s++) {
                            var l = t.thumblist.container.children[r[s] - 1];
                            if (void 0 !== l && !1 === l.classList.contains("df-thumb-loaded") && !1 === l.classList.contains("df-thumb-requested"))
                                return l.classList.add("df-thumb-requested"),
                                Et.log("Thumb Requested for " + r[s]),
                                t.provider.processPage({
                                    pageNumber: r[s],
                                    textureTarget: e.TEXTURE_TARGET.THUMB
                                }),
                                !1
                        }
                    }
                }
            }, {
                key: "setPage",
                value: function(t) {
                    var i = this.app
                      , n = t.pageNumber
                      , o = t.texture;
                    if (t.textureTarget === e.TEXTURE_TARGET.THUMB) {
                        var a = i.container.find("#df-thumb" + n);
                        a.find(".df-wrapper").css({
                            height: t.height,
                            width: t.width
                        }),
                        a.find(".df-bg-image").css({
                            backgroundImage: Et.bgImage(o)
                        }),
                        a.addClass("df-thumb-loaded").removeClass("df-thumb-requested")
                    }
                    Et.log("Thumbnail set for " + t.pageNumber),
                    i.thumbRequestStatus = Ot.ON
                }
            }]),
            t
        }();
        function Dt() {
            if (void 0 === e.openLocalFileInput) {
                var t = e.openLocalFileInput = kt('<input type="file" accept=".pdf" style="display:none">').appendTo(kt("body")).data("df-option", e.openFileOptions);
                t.change((function() {
                    var i, n = t[0].files;
                    n.length && (i = n[0],
                    t.val(""),
                    e.openFile(i))
                }
                ))
            }
        }
        function Ft(e) {
            return Ft = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            Ft(e)
        }
        function zt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1,
                n.configurable = !0,
                "value"in n && (n.writable = !0),
                Object.defineProperty(e, (o = n.key,
                a = void 0,
                a = function(e, t) {
                    if ("object" !== Ft(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== Ft(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(o, "string"),
                "symbol" === Ft(a) ? a : String(a)), n)
            }
            var o, a
        }
        e.openLightBox = function(t) {
            e.activeLightBox || (e.activeLightBox = new Nt((function() {
                e.activeLightBox.app && (e.activeLightBox.app.closeRequested = !0,
                e.activeLightBox.app.analytics({
                    eventAction: e.activeLightBox.app.options.analyticsViewerClose,
                    options: e.activeLightBox.app.options
                })),
                e.activeLightBox.app = Et.disposeObject(e.activeLightBox.app)
            }
            ))),
            e.activeLightBox.duration = 300,
            void 0 !== e.activeLightBox.app && null !== e.activeLightBox.app && !0 !== e.activeLightBox.app.closeRequested && e.openLocalFileInput != t || (e.activeLightBox.app = Et.disposeObject(e.activeLightBox.app),
            null === e.activeLightBox.app && e.activeLightBox.show((function() {
                e.activeLightBox.app = kt(e.activeLightBox.element).dearviewer({
                    transparent: !1,
                    isLightBox: !0,
                    hashNavigationEnabled: !0,
                    height: "100%",
                    dataElement: t
                }),
                e.activeLightBox.lightboxWrapper.toggleClass("df-lightbox-padded", !1 === e.activeLightBox.app.options.popupFullsize),
                e.activeLightBox.lightboxWrapper.toggleClass("df-rtl", e.activeLightBox.app.options.readDirection === e.READ_DIRECTION.RTL),
                e.activeLightBox.backGround.css({
                    backgroundColor: "transparent" === e.activeLightBox.app.options.backgroundColor ? e.defaults.popupBackGroundColor : e.activeLightBox.app.options.backgroundColor
                })
            }
            )))
        }
        ,
        e.checkBrowserURLforDefaults = function() {
            if (!Et.isIEUnsupported) {
                var t = new URL(location.href).searchParams.get("viewer-type") || new URL(location.href).searchParams.get("viewertype")
                  , i = new URL(location.href).searchParams.get("is-3d") || new URL(location.href).searchParams.get("is3d");
                t && (e.defaults.viewerType = t),
                "true" !== i && "false" !== i || (e.defaults.is3D = "true" === i)
            }
        }
        ,
        e.checkBrowserURLforPDF = function() {
            var t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
            if (!Et.isIEUnsupported) {
                var i = new URL(location.href).searchParams.get("pdf-source");
                return i && (i = unescape(i),
                t && e.openURL(i)),
                i
            }
        }
        ,
        e.fileDropHandler = function(t, i) {
            var n = t[0];
            "application/pdf" === n.type && (i.preventDefault(),
            i.stopPropagation(),
            e.openFile(n))
        }
        ,
        e.openFile = function(t) {
            var i;
            t ? (e.oldLocalFileObjectURL && window.URL.revokeObjectURL(e.oldLocalFileObjectURL),
            e.oldLocalFileObjectURL = window.URL.createObjectURL(t),
            null === (i = e.openFileSelected) || void 0 === i || i.call(e, {
                url: e.oldLocalFileObjectURL,
                file: t
            }),
            e.openURL(e.oldLocalFileObjectURL)) : e.openURL()
        }
        ,
        e.openURL = function(t) {
            Dt(),
            t && (e.openFileOptions.source = t,
            e.openFileOptions.pdfParameters = null),
            e.openLightBox(e.openLocalFileInput)
        }
        ,
        e.openBase64 = function(t) {
            e.openFileOptions.source = null,
            e.openFileOptions.pdfParameters = {
                data: atob(t)
            },
            e.openURL()
        }
        ,
        e.openLocalFile = function() {
            Dt(),
            e.openLocalFileInput.click()
        }
        ,
        e.initControls = function() {
            var t = kt("body");
            if (!1 !== e.defaults.autoPDFLinktoViewer && t.on("click", 'a[href$=".pdf"]', (function(t) {
                var i = kt(this);
                void 0 !== i.attr("download") || "_blank" === i.attr("target") || i.hasClass("df-ui-btn") || i.parents(".df-app").length > 0 || (t.preventDefault(),
                i.data("df-source", i.attr("href")),
                e.openLightBox(i))
            }
            )),
            t.on("click", ".df-open-local-file", (function(t) {
                e.openLocalFile()
            }
            )),
            t.on("click", ".df-sidemenu-buttons .df-ui-close", (function() {
                kt(this).closest(".df-app").find(".df-ui-btn.df-active").trigger("click")
            }
            )),
            t.on("mouseout", ".df-link-content section.squareAnnotation, .df-link-content section.textAnnotation, .df-link-content section.freeTextAnnotation", (function() {
                var t = kt(this);
                e.handlePopup(t, !1)
            }
            )),
            t.on("mouseover", ".df-link-content section.squareAnnotation, .df-link-content section.textAnnotation, .df-link-content section.freeTextAnnotation", (function() {
                var t = kt(this);
                e.handlePopup(t, !0)
            }
            )),
            e.handlePopup = function(e) {
                var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1]
                  , i = e.closest(".df-container")
                  , n = i.find(".df-comment-popup");
                if (n.toggleClass("df-active", t),
                t) {
                    var o = e[0].getBoundingClientRect()
                      , a = i[0].getBoundingClientRect()
                      , r = e.find(".popupWrapper").first();
                    if (e.hasClass("popupTriggerArea")) {
                        var s = e.data("annotation-id");
                        void 0 !== s && (r = e.siblings("[data-annotation-id=popup_" + s + "]"))
                    }
                    n.html(r.html());
                    var l = o.left - a.left;
                    l + 360 > a.width ? l = a.width - 360 - 10 : l < 10 && (l = 10);
                    var u = o.top - a.top + o.height + 5;
                    u + n.height() > a.height ? u = o.top - n.height() - o.height - 10 : u < 10 && (u = 10),
                    n.css({
                        left: l,
                        top: u
                    })
                }
            }
            ,
            null != e.fileDropElement) {
                var i = kt(e.fileDropElement);
                i.length > 0 && (i.on("dragover", (function(e) {
                    e.preventDefault(),
                    e.stopPropagation(),
                    kt(this).addClass("df-dragging")
                }
                )),
                i.on("dragleave", (function(e) {
                    e.preventDefault(),
                    e.stopPropagation(),
                    kt(this).removeClass("df-dragging")
                }
                )),
                i.on("drop", (function(t) {
                    var i = t.originalEvent.dataTransfer.files;
                    i.length && e.fileDropHandler(i, t)
                }
                )))
            }
        }
        ;
        var Bt = e.jQuery
          , Ht = e.REQUEST_STATUS
          , Ut = e.utils
          , jt = function() {
            function t(i) {
                var n, o;
                !function(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }(this, t),
                this.options = i,
                this.viewerType = this.options.viewerType,
                this.startPage = 1,
                this.endPage = 1,
                this.element = Bt(this.options.element),
                i.maxTextureSize = null !== (n = i.maxTextureSize) && void 0 !== n ? n : 2048,
                Ut.isMobile && (i.maxTextureSize = 4096 === i.maxTextureSize ? 3200 : i.maxTextureSize),
                this.dimensions = {
                    padding: {},
                    offset: {},
                    pageFit: {},
                    stage: {},
                    isAutoHeight: "auto" === i.height,
                    maxTextureSize: i.maxTextureSize
                },
                this.is3D = i.is3D,
                this.options.pixelRatio = Ut.limitAt(this.options.pixelRatio, 1, 2),
                this.events = {},
                this.links = i.links,
                this.thumbSize = 128,
                this.pendingZoom = !0,
                this.currentPageNumber = this.options.openPage || this.startPage,
                this.hashNavigationEnabled = !0 === this.options.hashNavigationEnabled,
                this.pendingZoom = !0,
                this.zoomValue = 1,
                this.pageScaling = e.PAGE_SCALE.MANUAL,
                this.isRTL = i.readDirection === e.READ_DIRECTION.RTL,
                this.jumpStep = 1,
                this.resizeRequestStatus = Ht.OFF,
                this.refreshRequestStatus = Ht.OFF,
                this.refreshRequestCount = 0,
                this.resizeRequestCount = 0,
                this.fullscreenSupported = Ut.hasFullscreenEnabled(),
                this.thumbRequestCount = 0,
                this.isExternalReady = null === (o = this.options.isExternalReady) || void 0 === o || o,
                this.init(),
                !0 === this.options.autoLightBoxFullscreen && !0 === this.options.isLightBox && this.switchFullscreen(),
                this.executeCallback("onCreate"),
                this.target = this
            }
            var i, n, o;
            return i = t,
            n = [{
                key: "init",
                value: function() {
                    var t = this.options
                      , i = this;
                    return i.initDOM(),
                    i.initResourcesLocation(),
                    i.initInfo(),
                    null != t.source && 0 !== t.source.length || null != t.pdfParameters ? Ut.isIEUnsupported ? (i.updateInfo("Your browser (Internet Explorer) is out of date! <br><a href='https://browsehappy.com/'>Upgrade to a new browser.</a>", "df-old-browser"),
                    void i.container.removeClass("df-loading").addClass("df-error")) : (i.commentPopup = Bt('<div class="df-comment-popup">').appendTo(i.container),
                    i.viewer = new i.viewerType(t,this),
                    i.sideMenu = new _t({
                        parentElement: this.container
                    },i),
                    i.provider = new e.providers[t.providerType](t,i),
                    i.state = "loading",
                    void i.checkRequestQueue()) : (i.updateInfo("ERROR: Set a Valid Document Source.", e.INFO_TYPE.ERROR),
                    void i.container.removeClass("df-loading").addClass("df-error"))
                }
            }, {
                key: "initDOM",
                value: function() {
                    this.element.addClass("df-app").removeClass("df-container df-loading"),
                    this.container = Bt("<div>").appendTo(this.element),
                    this.container.addClass("df-container df-loading df-init df-controls-" + this.options.controlsPosition + (!0 === this.options.controlsFloating ? " df-float" : " df-float-off") + ("transparent" === this.options.backgroundColor ? " df-transparent" : "") + (!0 === this.isRTL ? " df-rtl" : "") + (!0 === Ut.isIOS || !0 === Ut.isIPad ? " df-ios" : "")),
                    this._offsetParent = this.container[0].offsetParent,
                    this.backGround = Bt("<div class='df-bg'>").appendTo(this.container).css({
                        backgroundColor: this.options.backgroundColor,
                        backgroundImage: this.options.backgroundImage ? "url('" + this.options.backgroundImage + "')" : ""
                    }),
                    this.viewerContainer = Bt("<div>").appendTo(this.container),
                    this.viewerContainer.addClass("df-viewer-container")
                }
            }, {
                key: "initResourcesLocation",
                value: function() {
                    var t = this.options;
                    if (void 0 !== window[e.locationVar]) {
                        if (t.pdfjsSrc = window[e.locationVar] + "js/libs/pdf.min.js",
                        t.threejsSrc = window[e.locationVar] + "js/libs/three.min.js",
                        t.pdfjsWorkerSrc = window[e.locationVar] + "js/libs/pdf.worker.min.js",
                        t.soundFile = window[e.locationVar] + t.soundFile,
                        t.imagesLocation = window[e.locationVar] + t.imagesLocation,
                        t.imageResourcesPath = window[e.locationVar] + t.imageResourcesPath,
                        t.cMapUrl = window[e.locationVar] + t.cMapUrl,
                        void 0 !== t.pdfVersion) {
                            var i = "";
                            "latest" == t.pdfVersion || "beta" == t.pdfVersion ? i = "latest" : "stable" == t.pdfVersion && (i = "stable"),
                            ("latest" == t.pdfVersion || "default" == t.pdfVersion) && (Array.prototype.at,
                            void 0 === Array.prototype.at && (i = "stable",
                            console.log("Proper Support for Latest version PDF.js 3.7 not available. Switching to PDF.js 2.5!"))),
                            "default" !== i && "" !== i && (t.pdfjsSrc = window[e.locationVar] + "js/libs/pdfjs/" + i + "/pdf.min.js",
                            t.pdfjsWorkerSrc = window[e.locationVar] + "js/libs/pdfjs/" + i + "/pdf.worker.min.js")
                        }
                    } else
                        console.warn("DEARVIEWER locationVar not found!");
                    this.executeCallback("onInitResourcesLocation")
                }
            }, {
                key: "initEvents",
                value: function() {
                    var e = this
                      , t = this.container[0];
                    window.addEventListener("resize", e.events.resize = e.resetResizeRequest.bind(e), !1),
                    t.addEventListener("mousemove", e.events.mousemove = e.mouseMove.bind(e), !1),
                    t.addEventListener("mousedown", e.events.mousedown = e.mouseDown.bind(e), !1),
                    window.addEventListener("mouseup", e.events.mouseup = e.mouseUp.bind(e), !1),
                    t.addEventListener("touchmove", e.events.touchmove = e.mouseMove.bind(e), !1),
                    t.addEventListener("touchstart", e.events.touchstart = e.mouseDown.bind(e), !1),
                    window.addEventListener("touchend", e.events.touchend = e.mouseUp.bind(e), !1)
                }
            }, {
                key: "mouseMove",
                value: function(e) {
                    e.touches && e.touches.length > 1 && e.preventDefault(),
                    !0 === this.viewer.acceptAppMouseEvents && this.viewer.mouseMove(e)
                }
            }, {
                key: "mouseDown",
                value: function(e) {
                    this.userHasInteracted = !0,
                    !0 === this.viewer.acceptAppMouseEvents && 0 === Bt(e.srcElement).closest(".df-sidemenu").length && this.viewer.mouseDown(e)
                }
            }, {
                key: "mouseUp",
                value: function(e) {
                    this.viewer && !0 === this.viewer.acceptAppMouseEvents && this.viewer.mouseUp(e)
                }
            }, {
                key: "softDispose",
                value: function() {
                    var e = this;
                    e.softDisposed = !0,
                    e.provider.dispose(),
                    e.viewer.dispose()
                }
            }, {
                key: "softInit",
                value: function() {
                    var t = this;
                    t.viewer = new t.viewerType(t.options,this),
                    t.provider = new e.providers[t.options.providerType](t.options,t),
                    t.softDisposed = !1
                }
            }, {
                key: "dispose",
                value: function() {
                    var e, t, i, n, o, a = this, r = this.container[0];
                    clearInterval(this.autoPlayTimer),
                    this.autoPlayTimer = null,
                    this.autoPlayFunction = null,
                    a.provider = Ut.disposeObject(a.provider),
                    a.contentProvider = null,
                    a.target = null,
                    a.viewer = Ut.disposeObject(a.viewer),
                    a.sideMenu = Ut.disposeObject(a.sideMenu),
                    a.ui = Ut.disposeObject(a.ui),
                    a.thumblist = Ut.disposeObject(a.thumblist),
                    a.outlineViewer = Ut.disposeObject(a.outlineViewer),
                    this.events && (window.removeEventListener("resize", a.events.resize, !1),
                    r.removeEventListener("mousemove", a.events.mousemove, !1),
                    r.removeEventListener("mousedown", a.events.mousedown, !1),
                    window.removeEventListener("mouseup", a.events.mouseup, !1),
                    r.removeEventListener("touchmove", a.events.touchmove, !1),
                    r.removeEventListener("touchstart", a.events.touchstart, !1),
                    window.removeEventListener("touchend", a.events.touchend, !1)),
                    a.events = null,
                    a.options = null,
                    a.element.removeClass("df-app"),
                    a.viewerType = null,
                    a.checkRequestQueue = null,
                    null === (e = a.info) || void 0 === e || e.remove(),
                    a.info = null,
                    null === (t = a.loadingIcon) || void 0 === t || t.remove(),
                    a.loadingIcon = null,
                    null === (i = a.backGround) || void 0 === i || i.remove(),
                    a.backGround = null,
                    null === (n = a.outlineContainer) || void 0 === n || n.remove(),
                    a.outlineContainer = null,
                    null === (o = a.commentPopup) || void 0 === o || o.remove(),
                    a.commentPopup = null,
                    a.viewerContainer.off(),
                    a.viewerContainer.remove(),
                    a.viewerContainer = null,
                    a.container.off(),
                    a.container.remove(),
                    a.container = null,
                    a.element.off(),
                    a.element.data("df-app", null),
                    a.element = null,
                    a._offsetParent = null,
                    a.dimensions = null
                }
            }, {
                key: "resetResizeRequest",
                value: function() {
                    this.resizeRequestStatus = Ht.COUNT,
                    this.resizeRequestCount = 0,
                    this.container.addClass("df-pendingresize"),
                    this.pendingResize = !0
                }
            }, {
                key: "initInfo",
                value: function() {
                    this.info = Bt("<div>", {
                        class: "df-loading-info"
                    }),
                    this.container.append(this.info),
                    this.info.html(this.options.text.loading + "..."),
                    this.loadingIcon = Bt("<div>", {
                        class: "df-loading-icon"
                    }).appendTo(this.container)
                }
            }, {
                key: "updateInfo",
                value: function(e, t) {
                    Ut.log(e),
                    void 0 !== this.info && this.info.html(e)
                }
            }, {
                key: "_documentLoaded",
                value: function() {
                    Ut.log("Document Loaded"),
                    this.isDocumentReady = !0,
                    this.contentProvider = this.provider,
                    this.executeCallback("onDocumentLoad"),
                    this.endPage = this.pageCount = this.provider.pageCount,
                    this.currentPageNumber = this.getValidPage(this.currentPageNumber)
                }
            }, {
                key: "_viewerPrepared",
                value: function() {
                    Ut.log("Viewer Prepared"),
                    this.isViewerPrepared = !0,
                    this.executeCallback("onViewerLoad")
                }
            }, {
                key: "requestFinalize",
                value: function() {
                    !0 === this.isDocumentReady && !0 === this.isViewerPrepared && !0 === this.isExternalReady && !0 !== this.finalizeRequested && (this.finalizeRequested = !0,
                    this.finalize())
                }
            }, {
                key: "finalizeComponents",
                value: function() {
                    this.ui = new Rt({},this),
                    this.ui.init(),
                    this.calculateLayout(),
                    this.viewer.init()
                }
            }, {
                key: "finalize",
                value: function() {
                    this.resize(),
                    this.ui.update(),
                    this.initEvents(),
                    1 == this.options.isLightBox && this.analytics({
                        eventAction: this.options.analyticsViewerOpen,
                        options: this.options
                    }),
                    this.container.removeClass("df-loading df-init"),
                    this.viewer.onReady(),
                    this.analytics({
                        eventAction: this.options.analyticsViewerReady,
                        options: this.options
                    }),
                    this.executeCallback("onReady"),
                    !0 === this.options.dataElement.hasClass("df-hash-focused") && (Ut.focusHash(this.options.dataElement),
                    this.options.dataElement.removeClass("df-hash-focused")),
                    Ut.log("App Finalized")
                }
            }, {
                key: "initOutline",
                value: function() {
                    var e = this
                      , t = Bt("<div>").addClass("df-outline-container df-sidemenu");
                    t.append('<div class="df-sidemenu-title">Table of Contents</div>');
                    var i = Bt("<div>").addClass("df-wrapper");
                    t.append(i),
                    e.sideMenu.element.append(t),
                    e.outlineContainer = t,
                    e.outlineViewer = new At({
                        container: i[0],
                        linkService: e.provider.linkService,
                        outlineItemClass: "df-outline-item",
                        outlineToggleClass: "df-outline-toggle",
                        outlineToggleHiddenClass: "df-outlines-hidden"
                    }),
                    e.outlineViewer.render({
                        outline: e.provider.outline
                    })
                }
            }, {
                key: "initThumbs",
                value: function() {
                    var e = this;
                    e.thumblist = new Mt({
                        app: e,
                        addFn: function(e) {},
                        scrollFn: function() {
                            e.thumbRequestStatus = Ht.ON
                        },
                        itemHeight: e.thumbSize,
                        itemWidth: Ut.limitAt(Math.floor(e.dimensions.defaultPage.ratio * e.thumbSize), 32, 180),
                        totalRows: e.pageCount
                    }),
                    e.thumblist.lastScrolled = Date.now(),
                    e.thumbRequestStatus = Ht.ON;
                    var t = Bt("<div>").addClass("df-thumb-container df-sidemenu");
                    t.append('<div class="df-sidemenu-title">Thumbnails</div>'),
                    t.append(Bt(e.thumblist.container).addClass("df-wrapper")),
                    e.thumbContainer = t,
                    e.sideMenu.element.append(t),
                    e.container.on("click", ".df-thumb-container .df-thumb", (function(t) {
                        t.stopPropagation();
                        var i = Bt(this).attr("id").replace("df-thumb", "");
                        e.gotoPage(parseInt(i, 10))
                    }
                    ))
                }
            }, {
                key: "initSearch",
                value: function() {
                    var e = this
                      , t = Bt("<div>").addClass("df-search-container df-sidemenu");
                    t.append('<div class="df-sidemenu-title">Search</div>'),
                    e.searchForm = Bt('<div class="df-search-form">').appendTo(t),
                    e.searchBox = Bt('<input type="text" class="df-search-text" placeholder="Search">').on("keyup", (function(t) {
                        13 === t.keyCode && e.search()
                    }
                    )).appendTo(e.searchForm),
                    e.searchButton = Bt('<div class="df-ui-btn df-search-btn df-icon-search">').on("click", (function(t) {
                        e.search()
                    }
                    )).appendTo(e.searchForm),
                    e.clearButton = Bt('<a class="df-search-clear">Clear</a>').on("click", (function(t) {
                        e.clearSearch()
                    }
                    )).appendTo(e.searchForm),
                    e.searchInfo = Bt('<div class="df-search-info">').appendTo(t),
                    e.searchResults = Bt('<div class="df-wrapper df-search-results">').appendTo(t),
                    e.searchContainer = t,
                    e.sideMenu.element.append(t),
                    e.container.on("click", ".df-search-result", (function(t) {
                        t.stopPropagation();
                        var i = Bt(this).data("df-page");
                        e.gotoPage(parseInt(i, 10))
                    }
                    ))
                }
            }, {
                key: "search",
                value: function(e) {
                    null == e && (e = this.searchBox.val()),
                    this.provider.search(e.trim())
                }
            }, {
                key: "clearSearch",
                value: function() {
                    this.searchBox.val(""),
                    this.searchInfo.html(""),
                    this.provider.clearSearch()
                }
            }, {
                key: "updateSearchInfo",
                value: function(e) {
                    Ut.log(e),
                    void 0 !== this.searchInfo && this.searchInfo.html(e)
                }
            }, {
                key: "checkRequestQueue",
                value: function() {
                    var e = this;
                    if (e.checkRequestQueue && requestAnimationFrame((function() {
                        e && e.checkRequestQueue && e.checkRequestQueue()
                    }
                    )),
                    !e.softDisposed) {
                        if ("ready" != e.state)
                            return "loading" === e.state && !0 === this.isDocumentReady && !0 === this.isViewerPrepared && !0 === this.isExternalReady && (e.state = "finalizing",
                            this.finalizeComponents()),
                            void ("finalizing" === e.state && (e.state = "ready",
                            e.finalize()));
                        e.container && e.container[0] && e._offsetParent !== e.container[0].offsetParent && (e._offsetParent = e.container[0].offsetParent,
                        null !== e._offsetParent && (e.resize(),
                        e.resizeRequestStatus = Ht.OFF),
                        Ut.log("Visibility Resize Detected")),
                        (null !== e._offsetParent || e.isFullscreen) && (TWEEN.getAll().length > 0 && (TWEEN.update(),
                        e.renderRequestStatus = Ht.ON),
                        e.resizeRequestStatus === Ht.ON ? (e.resizeRequestStatus = Ht.OFF,
                        e.resize()) : e.resizeRequestStatus === Ht.COUNT && (e.resizeRequestCount++,
                        e.resizeRequestCount > 10 && (e.resizeRequestCount = 0,
                        e.resizeRequestStatus = Ht.ON)),
                        e.refreshRequestStatus === Ht.ON ? (e.refreshRequestStatus = Ht.OFF,
                        e.pendingResize = !1,
                        e.viewer.refresh(),
                        this.container.removeClass("df-pendingresize")) : e.refreshRequestStatus === Ht.COUNT && (e.refreshRequestCount++,
                        e.refreshRequestCount > 3 && (e.refreshRequestCount = 0,
                        e.refreshRequestStatus = Ht.ON)),
                        e.textureRequestStatus === Ht.ON && e.processTextureRequest(),
                        e.thumbRequestStatus === Ht.ON ? e.processThumbRequest() : e.thumbRequestStatus === Ht.COUNT && (e.thumbRequestCount++,
                        e.thumbRequestCount > 3 && (e.thumbRequestCount = 0,
                        e.thumbRequestStatus = Ht.ON)),
                        e.renderRequestStatus === Ht.ON && (e.viewer.render(),
                        e.renderRequestStatus = Ht.OFF),
                        e.provider.checkRequestQueue(),
                        e.viewer.checkRequestQueue())
                    }
                }
            }, {
                key: "processTextureRequest",
                value: function() {
                    var t, i, n = this, o = this.viewer, a = this.provider, r = o.getVisiblePages().main, s = 0, l = n.zoomValue > 1;
                    if (o.isAnimating())
                        n.textureRequestStatus = Ht.ON;
                    else {
                        Ut.log("Texture Request Working");
                        for (var u = 0; u < r.length; u++) {
                            s = 0;
                            var h = r[u];
                            if (h > 0 && h <= n.pageCount && ((t = l ? o.zoomViewer.getPageByNumber(h) : o.getPageByNumber(h)) && (i = o.getTextureSize({
                                pageNumber: h
                            }),
                            t.changeTexture(h, Math.floor(i.height)) && (a.processPage({
                                pageNumber: h,
                                textureTarget: l ? e.TEXTURE_TARGET.ZOOM : e.TEXTURE_TARGET.VIEWER
                            }),
                            s++,
                            n.viewer.getAnnotationElement(h, !0))),
                            s > 0))
                                break
                        }
                        0 === s && (n.textureRequestStatus = Ht.OFF)
                    }
                }
            }, {
                key: "applyTexture",
                value: function(t, i) {
                    var n = this
                      , o = void 0 !== t.toDataURL;
                    if (i.textureTarget === e.TEXTURE_TARGET.THUMB) {
                        if (i.height = t.height,
                        i.width = t.width,
                        o) {
                            var a = t.toDataURL("image/png");
                            n.provider.setCache(i.pageNumber, a, n.thumbSize),
                            i.texture = a
                        } else
                            i.texture = t.src;
                        n.thumblist.setPage(i)
                    } else
                        i.texture = o ? t : t.src,
                        !0 === n.viewer.setPage(i) && (n.provider.processAnnotations(i.pageNumber, n.viewer.getAnnotationElement(i.pageNumber, !0)),
                        n.provider.processTextContent(i.pageNumber, n.viewer.getTextElement(i.pageNumber, !0)))
                }
            }, {
                key: "processThumbRequest",
                value: function() {
                    null !== this.thumblist && void 0 !== this.thumblist && this.thumblist.processThumbRequest()
                }
            }, {
                key: "refreshRequestStart",
                value: function() {
                    this.refreshRequestStatus = Ht.COUNT,
                    this.refreshRequestCount = 0
                }
            }, {
                key: "renderRequestStart",
                value: function() {
                    this.renderRequestStatus = Ht.ON
                }
            }, {
                key: "resizeRequestStart",
                value: function() {
                    this.resizeRequestStatus = Ht.ON
                }
            }, {
                key: "zoom",
                value: function(e) {
                    var t = this;
                    t.pendingZoom = !0,
                    t.zoomDelta = e,
                    t.resize()
                }
            }, {
                key: "resetZoom",
                value: function() {
                    1 !== this.zoomValue && (this.zoomValue = 1.001,
                    this.zoom(-1))
                }
            }, {
                key: "calculateLayout",
                value: function() {
                    var t, i, n = this, o = n.isSideMenuOpen = n.container.hasClass("df-sidemenu-open"), a = n.dimensions, r = n.dimensions.padding, s = Bt(window).height();
                    a.offset = {
                        top: 0,
                        left: n.options.sideMenuOverlay || !o || n.isRTL ? 0 : 220,
                        right: !n.options.sideMenuOverlay && o && n.isRTL ? 220 : 0,
                        bottom: 0,
                        width: !n.options.sideMenuOverlay && o ? 220 : 0
                    },
                    n.viewerContainer.css({
                        left: a.offset.left,
                        right: a.offset.right
                    });
                    var l = a.controlsHeight = n.container.find(".df-ui").height();
                    if (r.top = n.options.paddingTop + (n.options.controlsPosition === e.CONTROLS_POSITION.TOP ? l : 0),
                    r.left = n.options.paddingLeft,
                    r.right = n.options.paddingRight,
                    r.bottom = n.options.paddingBottom + (n.options.controlsPosition === e.CONTROLS_POSITION.BOTTOM ? l : 0),
                    r.height = r.top + r.bottom,
                    r.width = r.left + r.right,
                    r.heightDiff = r.top - r.bottom,
                    r.widthDiff = r.left - r.right,
                    a.isFullSize = !0 === n.isFullscreen,
                    a.isFixedHeight = a.isFullSize || !a.isAutoHeight,
                    a.containerWidth = a.isFullSize ? Bt(window).width() : this.element.width(),
                    n.container.toggleClass("df-xs", a.containerWidth < 400).toggleClass("df-xss", a.containerWidth < 320),
                    a.maxHeight = s - (a.containerWidth > 600 && null !== (t = Bt(null !== (i = n.options.headerElementSelector) && void 0 !== i ? i : "#wpadminbar").height()) && void 0 !== t ? t : 0),
                    a.isFixedHeight)
                        if (a.isFullSize)
                            a.maxHeight = s;
                        else {
                            n.element.height(n.options.height);
                            var u = n.element.height();
                            a.maxHeight = Math.min(u, a.maxHeight)
                        }
                    a.width,
                    a.stage.innerWidth = this.viewer._getInnerWidth();
                    var h = a.stage.innerHeight = this.viewer._getInnerHeight()
                      , p = this.viewer._getOuterHeight(h + a.padding.height);
                    a.containerHeight = a.isFullSize ? s : p,
                    n.element.height(a.containerHeight);
                    var c = n.element.height();
                    a.isFullSize || c == a.containerHeight || (a.containerHeight = c,
                    a.stage.innerHeight = c - a.padding.height,
                    a.stage.height = c),
                    a.origin = {
                        x: (r.widthDiff + a.containerWidth - a.offset.left - a.offset.right) / 2,
                        y: (r.heightDiff + a.containerHeight) / 2
                    },
                    n.viewer.determinePageMode()
                }
            }, {
                key: "resize",
                value: function() {
                    var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    Ut.log("Resize Request Initiated");
                    var t = this;
                    this.calculateLayout(),
                    t.viewer.handleZoom(),
                    t.viewer.resize(),
                    !1 !== e && (t.pendingZoom ? (this.viewer.refresh(),
                    Ut.log("Pending Zoom updated")) : this.refreshRequestStart(),
                    this.ui.update(),
                    this.renderRequestStatus = Ht.ON,
                    t.zoomChanged = !1,
                    t.pendingZoom = !1,
                    this.executeCallback("afterResize"))
                }
            }, {
                key: "hasOutline",
                value: function() {
                    if (this.provider.outline.length > 0)
                        return !0
                }
            }, {
                key: "switchFullscreen",
                value: function() {
                    var e, t = this, i = t.container[0];
                    if (t.container.toggleClass("df-fullscreen", !0 !== t.isFullscreen),
                    null != t && null !== (e = t.ui) && void 0 !== e && null !== (e = e.controls) && void 0 !== e && e.fullscreen && t.ui.controls.fullScreen.toggleClass(t.options.icons["fullscreen-off"], !0 !== t.isFullscreen),
                    !0 !== t.isFullscreen) {
                        var n = null;
                        i.requestFullscreen ? n = i.requestFullscreen() : i.msRequestFullscreen ? n = i.msRequestFullscreen() : i.mozRequestFullScreen ? n = i.mozRequestFullScreen() : i.webkitRequestFullscreen && (n = i.webkitRequestFullscreen()),
                        n && n.then && n.then((function() {
                            t.refreshRequestStatus,
                            Ht.ON,
                            t.resize()
                        }
                        )),
                        t.isFullscreen = !0
                    } else
                        t.isFullscreen = !1,
                        document.exitFullscreen ? document.fullscreenElement && document.exitFullscreen() : document.msExitFullscreen ? document.msExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen(),
                        Ut.hasFullscreenEnabled() || t.container[0].scrollIntoView();
                    Ut.hasFullscreenEnabled() || (t.resizeRequestStatus = Ht.ON)
                }
            }, {
                key: "next",
                value: function() {
                    this.jumpBy(this.jumpStep)
                }
            }, {
                key: "prev",
                value: function() {
                    this.jumpBy(-this.jumpStep)
                }
            }, {
                key: "jumpBy",
                value: function(e) {
                    var t = this.currentPageNumber + e;
                    t = Ut.limitAt(t, this.startPage, this.endPage),
                    1 != this.anyFirstPageChanged && (this.analytics({
                        eventAction: this.options.analyticsFirstPageChange,
                        options: this.options
                    }),
                    this.anyFirstPageChanged = !0),
                    this.gotoPage(t),
                    this.ui.update()
                }
            }, {
                key: "openRight",
                value: function() {
                    this.isRTL ? this.prev() : this.next()
                }
            }, {
                key: "openLeft",
                value: function() {
                    this.isRTL ? this.next() : this.prev()
                }
            }, {
                key: "start",
                value: function() {
                    this.gotoPage(this.startPage)
                }
            }, {
                key: "end",
                value: function() {
                    this.gotoPage(this.endPage)
                }
            }, {
                key: "gotoPage",
                value: function(e) {
                    var t = this;
                    e = t.getValidPage(parseInt(e, 10)),
                    null !== t.viewer && !1 !== t.viewer.validatePageChange(e) && (this.executeCallback("beforePageChanged"),
                    t.requestDestRefKey = void 0,
                    t.container.removeClass("df-fetch-pdf"),
                    t.oldPageNumber = t.currentPageNumber,
                    t.currentPageNumber = e,
                    t.thumbRequestStatus = Ht.ON,
                    t.viewer.gotoPageCallBack && t.viewer.gotoPageCallBack(),
                    t.ui.update(),
                    1 == this.autoPlay && this.setAutoPlay(this.autoPlay),
                    !0 === this.hashNavigationEnabled && this.getURLHash(),
                    this.executeCallback("onPageChanged"))
                }
            }, {
                key: "gotoPageLabel",
                value: function(e) {
                    this.gotoPage(this.provider.getPageNumberForLabel(e.toString().trim()))
                }
            }, {
                key: "getCurrentLabel",
                value: function() {
                    return this.provider.getLabelforPage(this.currentPageNumber)
                }
            }, {
                key: "autoPlayFunction",
                value: function() {
                    this && this.autoPlay && (Ut.limitAt(this.currentPageNumber + this.jumpStep, this.startPage, this.endPage) !== this.currentPageNumber ? this.next() : this.setAutoPlay(!1))
                }
            }, {
                key: "setAutoPlay",
                value: function(e) {
                    if (this.options.autoPlay) {
                        var t = (e = 1 == e) ? this.options.text.pause : this.options.text.play;
                        this.ui.controls.play.toggleClass(this.options.icons.pause, e),
                        this.ui.controls.play.html("<span>" + t + "</span>"),
                        this.ui.controls.play.attr("title", t),
                        clearInterval(this.autoPlayTimer),
                        e && (this.autoPlayTimer = setInterval(this.autoPlayFunction.bind(this), this.options.autoPlayDuration)),
                        this.autoPlay = e
                    }
                }
            }, {
                key: "isValidPage",
                value: function(e) {
                    return this.provider._isValidPage(e)
                }
            }, {
                key: "getValidPage",
                value: function(e) {
                    var t = this;
                    return isNaN(e) ? e = t.currentPageNumber : e < 1 ? e = 1 : e > t.pageCount && (e = t.pageCount),
                    e
                }
            }, {
                key: "getURLHash",
                value: function() {
                    if (null != this.options.id) {
                        var e = Ut.getSharePrefix(this.options.sharePrefix) + (null != this.options.slug ? this.options.slug : this.options.id) + "/";
                        null != this.currentPageNumber && (e += this.currentPageNumber + "/"),
                        history.replaceState(void 0, void 0, "#" + e)
                    }
                    return window.location.href
                }
            }, {
                key: "executeCallback",
                value: function(e) {}
            }, {
                key: "analytics",
                value: function(e) {}
            }],
            n && zt(i.prototype, n),
            o && zt(i, o),
            Object.defineProperty(i, "prototype", {
                writable: !1
            }),
            t
        }();
        function Vt(e) {
            return Vt = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            }
            : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            }
            ,
            Vt(e)
        }
        function Wt(e, t) {
            var i = Object.keys(e);
            if (Object.getOwnPropertySymbols) {
                var n = Object.getOwnPropertySymbols(e);
                t && (n = n.filter((function(t) {
                    return Object.getOwnPropertyDescriptor(e, t).enumerable
                }
                ))),
                i.push.apply(i, n)
            }
            return i
        }
        function Gt(e) {
            for (var t = 1; t < arguments.length; t++) {
                var i = null != arguments[t] ? arguments[t] : {};
                t % 2 ? Wt(Object(i), !0).forEach((function(t) {
                    qt(e, t, i[t])
                }
                )) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(i)) : Wt(Object(i)).forEach((function(t) {
                    Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(i, t))
                }
                ))
            }
            return e
        }
        function qt(e, t, i) {
            return (t = function(e) {
                var t = function(e, t) {
                    if ("object" !== Vt(e) || null === e)
                        return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== Vt(n))
                            return n;
                        throw new TypeError("@@toPrimitive must return a primitive value.")
                    }
                    return ("string" === t ? String : Number)(e)
                }(e, "string");
                return "symbol" === Vt(t) ? t : String(t)
            }(t))in e ? Object.defineProperty(e, t, {
                value: i,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = i,
            e
        }
        function Zt(e, t, i) {
            for (var n = [], o = !1, a = 0, r = 0, s = 0, l = void 0, u = 0, h = 0; h < e.length; h++) {
                var p, c, d = Gt({}, e[h]);
                if (s = (r = t[h].offset) + t[h].length,
                0 == o)
                    l = null === (p = i[u]) || void 0 === p ? void 0 : p.index,
                    a = null === (c = i[u]) || void 0 === c ? void 0 : c.length;
                for (; l >= r && l < s; ) {
                    var f, g;
                    if (d.searchHits || (d.searchHits = []),
                    d.searchHits.push({
                        start: l - r,
                        length: a,
                        text: i[u].text
                    }),
                    1 == d.searchHits.length && n.push(d),
                    l + a > s)
                        a = l + a - s,
                        l = s,
                        o = !0;
                    else
                        o = !1,
                        l = null === (f = i[++u]) || void 0 === f ? void 0 : f.index,
                        a = null === (g = i[u]) || void 0 === g ? void 0 : g.length
                }
            }
            return n
        }
        e.prepareOptions = function(t) {
            t.element instanceof Bt || (t.element = Bt(t.element));
            var i = t.element;
            null == t.dataElement && (t.dataElement = i);
            var n = t.dataElement
              , o = e.utils.getOptions(n)
              , a = Bt.extend(!0, {}, e.defaults, t, o);
            a = Ut.fallbackOptions(a),
            Ut.log(a);
            var r = Bt.extend(!0, {}, e._defaults, a);
            return Ut.isMobile && "function" == typeof e.viewers[r.mobileViewerType] && (r.viewerType = r.mobileViewerType),
            "function" != typeof e.viewers[r.viewerType] ? (console.warn("Invalid Viewer Type! " + r.viewerType + " | Using default Viewer!"),
            r.viewerType = e.viewers.default) : r.viewerType = e.viewers[r.viewerType],
            r = Ut.finalizeOptions(Ut.sanitizeOptions(r))
        }
        ,
        e.Application = function(t) {
            var i = e.prepareOptions(t)
              , n = new jt(i);
            return t.element.data("df-app", n),
            null != i.id && !0 !== i.isLightBox && (window[i.id.toString()] = n),
            n
        }
        ,
        Bt.fn.extend({
            dearviewer_options: function(t) {
                return null == t && (t = {}),
                t.element = Bt(this),
                new e.prepareOptions(t)
            },
            dearviewer: function(t) {
                return null == t && (t = {}),
                t.element = Bt(this),
                new e.Application(t)
            }
        }),
        e.defaults.search = !0,
        jt.prototype.executeCallback = function(e) {
            this.options && "function" == typeof this.options[e] && this.options[e](this)
        }
        ,
        jt.prototype.analytics = function(e) {
            if (1 == this.options.enableAnalytics)
                try {
                    var t = e.options
                      , i = void 0;
                    t && (i = t.bookTitle || t.slug || t.id);
                    var n = window.gtag;
                    if (n)
                        n("event", e.eventAction, {
                            event_category: t.analyticsEventCategory,
                            event_label: i
                        });
                    else
                        (window.ga || window.__gaTracker)("send", {
                            hitType: "event",
                            eventCategory: t.analyticsEventCategory,
                            eventAction: e.eventAction,
                            eventLabel: i
                        })
                } catch (e) {}
        }
        ,
        e.executeCallback = function(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : window;
            "function" == typeof t[e] && t[e]()
        }
        ,
        e.openAttachmentLightBoxes = function() {
            var t = jQuery("body .df-auto-open-lightbox");
            t.length > 0 && jQuery(t[0]).trigger("click"),
            jQuery(window).on("hashchange", (function(t) {
                var i = location.hash;
                i && i.length > 5 && (e.hashFocusBookFound = !1,
                u.detectHash())
            }
            ))
        }
        ,
        st.prototype.processCustomLinks = function(e, t) {
            var i = this
              , n = this.app;
            if (!1 !== n.options.enableAnnotation && i._isValidPage(e) && null != t) {
                var o = n.viewer.getDocumentPageNumber(e)
                  , a = n.options.links;
                if (null != a && null != a[o])
                    for (var r = a[o], s = 0; s < r.length; s++) {
                        var l = r[s]
                          , u = void 0;
                        l.dest && l.dest.indexOf && 0 == l.dest.indexOf("[html]") ? ((u = document.createElement("div")).innerHTML = l.dest.substr(6),
                        u.className = "customHtmlAnnotation") : ((u = document.createElement("a")).setAttribute("dest", l.dest),
                        u.className = "customLinkAnnotation",
                        u.href = "#" + l.dest,
                        u.onclick = function() {
                            var e = this.getAttribute("dest");
                            return e && i.linkService.customNavigateTo(e),
                            !1
                        }
                        ),
                        u.style.left = l.x + "%",
                        u.style.top = l.y + "%",
                        u.style.width = l.w + "%",
                        u.style.height = l.h + "%",
                        t.appendChild(u)
                    }
            }
        }
        ,
        lt.prototype.processTextContent = function(e, t) {
            var i = this
              , n = this.app;
            if (i._isValidPage(e) && null != t) {
                var o = !0 === n.options.enableAnnotation && !0 === n.options.enableAutoLinks;
                if (o || !1 !== n.options.showSearchControl) {
                    var a = n.viewer.getDocumentPageNumber(e);
                    t.innerHTML = "",
                    i.pdfDocument.getPage(a).then((function(r) {
                        var s = r.getViewport({
                            scale: 1,
                            rotation: r._pageInfo.rotate + n.options.pageRotation
                        });
                        s = r.getViewport({
                            scale: n.viewer.getTextureSize({
                                pageNumber: e,
                                isAnnotation: !0
                            }).height / (s.height * n.options.pixelRatio),
                            rotation: r._pageInfo.rotate + n.options.pageRotation
                        }),
                        t.parentNode.style.setProperty("--scale-factor", s.scale),
                        r.getTextContent().then((function(r) {
                            var l;
                            i.prepareTextContent(r, a);
                            var h = i.autoLinkItemsCache[a]
                              , p = i.autoLinkHitsCache[a]
                              , c = i.searchHitItemsCache[a]
                              , d = i.searchHits[e]
                              , f = i.textOffset[a];
                            if (!0 === o && null == h) {
                                h = [],
                                p = u.urlify(i.textContentJoined[a]);
                                var g = i.PDFLinkItemsCache[a];
                                g && g.length < 5 && (g = void 0),
                                h = Zt(r.items, f, p),
                                i.autoLinkItemsCache[a] = h,
                                i.autoLinkHitsCache[a] = p
                            }
                            if (null == c && null != i.textOffsetSearch[a] && d && d.length > 0 && (c = Zt(r.items, i.textOffsetSearch[a], d),
                            i.searchHitItemsCache[a] = c),
                            h && h.length > 0) {
                                var v = jQuery(t).siblings(".df-auto-link-content");
                                0 == v.length && (v = jQuery('<div class="df-auto-link-content">'),
                                jQuery(t).parent().prepend(v)),
                                v.html(""),
                                r.items = h;
                                var m = pdfjsLib.renderTextLayer({
                                    textContentSource: r,
                                    textContent: r,
                                    container: v[0],
                                    viewport: s,
                                    textDivs: []
                                })
                                  , y = 0;
                                m._textDivs.forEach((function(e) {
                                    var t = r.items[y]
                                      , i = ""
                                      , n = 0
                                      , o = 0
                                      , a = 0
                                      , s = ""
                                      , l = "";
                                    for (a = 0; a < t.searchHits.length; a++)
                                        i += t.str.substring(n, t.searchHits[a].start),
                                        n = t.searchHits[a].start,
                                        o = t.searchHits[a].length,
                                        s = t.str.substring(n, n + o),
                                        l = t.searchHits[a].text,
                                        s.indexOf("@") > 0 ? ((l = l.toLowerCase()).indexOf(!1) && (l = "mailto:" + s),
                                        i += '<a href="' + l + '" class="df-autolink" target="_blank">' + s + "</a>") : (0 === l.indexOf("www.") && (l = "http://" + l),
                                        i += '<a href="' + l + '" class="df-autolink" target="_blank">' + s + "</a>"),
                                        u.log("AutoLink: " + l + " for " + s),
                                        n += o;
                                    i += t.str.substring(n, t.str.length),
                                    y++,
                                    e.innerHTML = i
                                }
                                ))
                            }
                            if (c && c.length > 0) {
                                r.items = c;
                                m = pdfjsLib.renderTextLayer({
                                    textContentSource: r,
                                    textContent: r,
                                    container: t,
                                    viewport: s,
                                    textDivs: []
                                });
                                var b = 0;
                                m._textDivs.forEach((function(e) {
                                    var t = r.items[b]
                                      , i = ""
                                      , n = 0
                                      , o = 0
                                      , a = 0;
                                    for (a = 0; a < t.searchHits.length; a++)
                                        i += t.str.substring(n, t.searchHits[a].start),
                                        n = t.searchHits[a].start,
                                        o = t.searchHits[a].length,
                                        i += '<span class="df-search-highlight">' + t.str.substring(n, n + o) + "</span>",
                                        n += o;
                                    i += t.str.substring(n, t.str.length),
                                    b++,
                                    e.innerHTML = i,
                                    e.classList += " df-search-hits"
                                }
                                ))
                            }
                            null == n || null === (l = n.viewer) || void 0 === l || l.finalizeTextContent(t, e)
                        }
                        ))
                    }
                    ))
                }
            }
        }
        ,
        lt.prototype.processAnnotations = function(e, t) {
            var i = this
              , n = this.app;
            if (!1 !== n.options.enableAnnotation && i._isValidPage(e) && null != t) {
                var o = n.viewer.getDocumentPageNumber(e);
                i.pdfDocument.getPage(o).then((function(a) {
                    var r = a.getViewport({
                        scale: 1,
                        rotation: a._pageInfo.rotate + n.options.pageRotation
                    });
                    r = a.getViewport({
                        scale: n.viewer.getTextureSize({
                            pageNumber: e,
                            isAnnotation: !0
                        }).height / (r.height * n.options.pixelRatio),
                        rotation: a._pageInfo.rotate + n.options.pageRotation
                    }),
                    a.getAnnotations().then((function(s) {
                        if (null !== n.options && null !== n.viewer && 0 != s.length) {
                            r = r.clone({
                                dontFlip: !0
                            });
                            var l = {
                                annotations: s,
                                div: t,
                                page: a,
                                viewport: r,
                                imageResourcesPath: n.options.imageResourcesPath,
                                linkService: i.linkService
                            };
                            if (pdfjsLib.AnnotationLayer.hasOwnProperty("render"))
                                pdfjsLib.AnnotationLayer.render(l);
                            else
                                new pdfjsLib.AnnotationLayer(l).render(l);
                            if (n.options.annotationClass && "" !== n.options.annotationClass && jQuery(t).find(" > section").addClass(n.options.annotationClass),
                            null == i.PDFLinkItemsCache[o])
                                jQuery(t).find("a:not([href^='#'])").map((function() {
                                    return jQuery(this).attr("href")
                                }
                                )).get().join(",");
                            i.processCustomLinks(e, t),
                            n.viewer.finalizeAnnotations(t, e)
                        }
                    }
                    ))
                }
                ))
            }
        }
        ,
        e.getPDFThumb = function(t) {
            var i = {};
            i.url = u.httpsCorrection(t.pdfURL),
            i.rangeChunkSize = 524288,
            i.cMapPacked = !0,
            i.disableAutoFetch = !0,
            i.disableStream = !0,
            i.disableFontFace = e.defaults.disableFontFace,
            i.cMapUrl = e.defaults.cMapUrl,
            i.imagesLocation = e.defaults.imagesLocation,
            i.imageResourcesPath = e.defaults.imageResourcesPath;
            var n = pdfjsLib.getDocument(i)
              , o = n.promise.then((function(e) {
                e.getPage(1).then((function(e) {
                    var i = 1
                      , a = document.createElement("canvas")
                      , r = e.getViewport({
                        scale: i
                    });
                    i = r.width > r.height ? 400 * i / r.width : 400 * i / r.height,
                    r = e.getViewport({
                        scale: i
                    }),
                    a.height = Math.floor(r.height),
                    a.width = Math.floor(r.width),
                    e.render({
                        canvas: a,
                        canvasContext: a.getContext("2d"),
                        viewport: r
                    }).promise.then((function() {
                        var e, i = a.toDataURL("image/jpeg", .9);
                        null === (e = t.callback) || void 0 === e || e.call(t, i),
                        o.destroy && o.destroy(),
                        n.destroy && n.destroy(),
                        o = null,
                        n = null
                    }
                    ))
                }
                ))
            }
            ));
            n.onProgress = function(e) {
                var i = 100 * e.loaded / e.total;
                isNaN(i) ? e && e.loaded ? t.updateInfo("Loading PDF " + (Math.ceil(e.loaded / 1e4) / 100).toFixed(2).toString() + "MB ...") : t.updateInfo("Loading PDF ...") : t.updateInfo("Loading PDF " + Math.ceil(i).toString().split(".")[0] + "% ...")
            }
        }
        ;
        var Kt = e.jQuery
          , Qt = window.DFLIP = window.DEARFLIP = e;
        Qt.defaults.viewerType = "flipbook",
        Qt.defaults.analyticsEventCategory = "Flipbook",
        Qt.defaults.analyticsViewerReady = "Book Ready",
        Qt.defaults.analyticsViewerOpen = "Open Book",
        Qt.defaults.analyticsViewerClose = "Book Closed",
        Qt.defaults.analyticsFirstPageChange = "First Page Flip",
        Qt.slug = "dflip",
        Qt.locationVar = "dFlipLocation",
        Qt.locationFile = "dflip",
        Qt.PAGE_MODE = {
            SINGLE: 1,
            DOUBLE: 2,
            AUTO: null
        },
        Qt.SINGLE_PAGE_MODE = {
            ZOOM: 1,
            BOOKLET: 2,
            AUTO: null
        },
        Qt.CONTROLSPOSITION = {
            HIDDEN: "hide",
            TOP: "top",
            BOTTOM: "bottom"
        },
        Qt.DIRECTION = {
            LTR: 1,
            RTL: 2
        },
        Qt.PAGE_SIZE = {
            AUTO: 0,
            SINGLE: 1,
            DOUBLEINTERNAL: 2
        },
        Qt.ConvertPageLinks = function() {
            for (var e, t = arguments[0] / 100, i = arguments[1] / 100, n = function(e, n, o, a, r) {
                return {
                    x: e / t,
                    y: n / i,
                    w: o / t,
                    h: a / i,
                    dest: r
                }
            }, o = [], a = 2; a < arguments.length; a++)
                e = arguments[a],
                o[a - 2] = n.apply(this, e);
            return o
        }
        ,
        Qt.parseLinks = function(e) {
            var t;
            if (null != e && e.length > 0)
                for (var i = 0; i < e.length; i++)
                    null != (t = e[i]) && null != t[0] && null == t[0].dest && (t = Qt.ConvertPageLinks.apply(this, t),
                    e[i] = t);
            return e
        }
        ,
        Qt.parseFallBack = function() {
            Kt(".df-posts").addClass("dflip-books"),
            Kt(".dflip-books").addClass("df-posts"),
            Kt("._df_button, ._df_thumb, ._df_custom, ._df_book, ._df_hidden").each((function() {
                var e = Kt(this);
                "true" !== e.data("df-parsed") && (e.addClass("df-element"),
                e.hasClass("_df_book") || (e.hasClass("_df_thumb") ? (e.attr("data-df-lightbox", "thumb"),
                void 0 !== e.attr("thumb") && e.data("df-thumb", e.attr("thumb"))) : e.hasClass("_df_button") ? e.attr("data-df-lightbox", "button") : e.hasClass("_df_hidden") ? e.attr("data-df-lightbox", "hidden") : e.attr("data-df-lightbox", "custom")))
            }
            ))
        }
        ,
        Qt.parseBooks = function() {
            Qt.parseFallBack(),
            Qt.parseElements()
        }
        ;
        var Xt = function(e) {
            if (null != e.source && (Array === e.source.constructor || Array.isArray(e.source) || e.source instanceof Array) && (e.providerType = "image"),
            null != e.cover3DType && (1 == e.cover3DType || "true" == e.cover3DType ? e.cover3DType = Qt.FLIPBOOK_COVER_TYPE.BASIC : 0 != e.cover3DType && "false" != e.cover3DType || (e.cover3DType = Qt.FLIPBOOK_COVER_TYPE.NONE)),
            void 0 !== e.pageSize && ("1" === e.pageSize || 1 === e.pageSize || e.pageSize === Qt.FLIPBOOK_PAGE_SIZE.SINGLE ? e.pageSize = Qt.FLIPBOOK_PAGE_SIZE.SINGLE : "2" === e.pageSize || 2 === e.pageSize || e.pageSize === Qt.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL ? e.pageSize = Qt.FLIPBOOK_PAGE_SIZE.DOUBLE_INTERNAL : e.pageSize = Qt.FLIPBOOK_PAGE_SIZE.AUTO),
            void 0 !== e.pageMode && ("1" === e.pageMode || 1 === e.pageMode || e.pageMode === Qt.FLIPBOOK_PAGE_MODE.SINGLE ? e.pageMode = Qt.FLIPBOOK_PAGE_MODE.SINGLE : "2" === e.pageMode || 2 === e.pageMode || e.pageMode === Qt.FLIPBOOK_PAGE_MODE.DOUBLE ? e.pageMode = Qt.FLIPBOOK_PAGE_MODE.DOUBLE : e.pageMode = Qt.FLIPBOOK_PAGE_MODE.AUTO),
            void 0 !== e.singlePageMode && ("1" === e.singlePageMode || 1 === e.singlePageMode || e.singlePageMode === Qt.FLIPBOOK_SINGLE_PAGE_MODE.ZOOM ? e.singlePageMode = Qt.FLIPBOOK_SINGLE_PAGE_MODE.ZOOM : "2" === e.singlePageMode || 2 === e.singlePageMode || e.singlePageMode === Qt.FLIPBOOK_SINGLE_PAGE_MODE.BOOKLET ? e.singlePageMode = Qt.FLIPBOOK_SINGLE_PAGE_MODE.BOOKLET : e.singlePageMode = Qt.FLIPBOOK_SINGLE_PAGE_MODE.AUTO),
            void 0 !== e.controlsPosition && "hide" === e.controlsPosition && (e.controlsPosition = Qt.CONTROLS_POSITION.HIDDEN),
            void 0 !== e.overwritePDFOutline && (e.overwritePDFOutline = u.isTrue(e.overwritePDFOutline)),
            void 0 !== e.webgl && (e.is3D = e.webgl = e.webgl,
            delete e.webgl),
            void 0 !== e.webglShadow && (e.has3DShadow = u.isTrue(e.webglShadow),
            delete e.webglShadow),
            void 0 !== e.scrollWheel && (u.isTrue(e.scrollWheel) && (e.mouseScrollAction = Qt.MOUSE_SCROLL_ACTIONS.ZOOM),
            delete e.scrollWheel),
            void 0 !== e.stiffness && delete e.stiffness,
            void 0 !== e.soundEnable && (e.enableSound = u.isTrue(e.soundEnable),
            delete e.soundEnable),
            void 0 !== e.enableDownload && (e.showDownloadControl = u.isTrue(e.enableDownload),
            delete e.enableDownload),
            void 0 !== e.autoEnableOutline && (e.autoOpenOutline = u.isTrue(e.autoEnableOutline),
            delete e.autoEnableOutline),
            void 0 !== e.autoEnableThumbnail && (e.autoOpenThumbnail = u.isTrue(e.autoEnableThumbnail),
            delete e.autoEnableThumbnail),
            void 0 !== e.direction && ("2" === e.direction || 2 === e.direction || e.direction === Qt.READ_DIRECTION.RTL ? e.readDirection = Qt.READ_DIRECTION.RTL : e.readDirection = Qt.READ_DIRECTION.LTR,
            delete e.direction),
            void 0 !== e.hard && (e.flipbookHardPages = e.hard,
            "hard" === e.flipbookHardPages && (e.flipbookHardPages = "all"),
            delete e.hard),
            void 0 !== e.forceFit && delete e.forceFit,
            "undefined" != typeof dFlipWPGlobal && "true" === e.wpOptions) {
                if (!0 !== e.linksparsed) {
                    e.linksparsed = !0;
                    var t = [];
                    try {
                        for (var i in e.links) {
                            for (var n = e.links[i], o = [100, 100], a = 0; a < n.length; a++) {
                                for (var r = n[a].substr(1).slice(0, -1).split(","), s = [], l = 0; l < 5; l++)
                                    s[l] = r[l];
                                o.push(s)
                            }
                            t[parseInt(i, 10) + 1] = o
                        }
                    } catch (e) {
                        console.error(e.stack)
                    }
                    e.links = Qt.parseLinks(t)
                }
            } else
                e.links = Qt.parseLinks(e.links);
            return u.sanitizeOptions(e)
        };
        Kt.fn.extend({
            flipBook: function(t, i) {
                return null == i && (i = {}),
                i.source = t,
                i.element = Kt(this),
                new e.Application(i)
            }
        }),
        Kt(document).ready((function() {
            var e = Kt("body");
            Qt.executeCallback("beforeDearFlipInit"),
            void 0 !== window.dFlipWPGlobal && Kt.extend(!0, Qt.defaults, Xt(window.dFlipWPGlobal)),
            Qt.initUtils(),
            Qt.initControls(),
            e.on("click", ".df-element[data-df-lightbox],.df-element[data-lightbox]", (function(e) {
                var t = Kt(e.target || e.originalTarget);
                if (!t || !t.hasClass("df-edit-link")) {
                    var i = Kt(this)
                      , n = i.attr("target")
                      , o = i.attr("href")
                      , a = !1;
                    "#" === o || void 0 === o || i.hasClass("df-hash-focused") ? a = !0 : "_self" === n || "_blank" === n || (null == n && "_self" === Qt.defaults.targetWindow ? i.attr("target", "_self") : null == n && "_blank" === Qt.defaults.targetWindow ? i.attr("target", "_blank") : a = !0),
                    a && (e.preventDefault(),
                    e.stopPropagation(),
                    Qt.openLightBox(i))
                }
            }
            )),
            e.on("click", ".df-trigger", (function(e) {
                var t = Kt(this).attr("df-trigger");
                Kt("[df-trigger-id=" + t + "]").trigger("click")
            }
            )),
            Qt.checkBrowserURLforDefaults(),
            Qt.parseCSSElements(),
            Qt.parseFallBack(),
            u.detectHash(),
            Qt.parseNormalElements(),
            Qt.checkBrowserURLforPDF(!0),
            Qt.openAttachmentLightBoxes(),
            Qt.executeCallback("afterDearFlipInit")
        }
        )),
        u.finalizeOptions = function(e) {
            return Xt(e)
        }
        ,
        Pt.prototype.processAnnotations = function(e, t) {
            this.processCustomLinks(e, t),
            this.app.viewer.finalizeAnnotations(t, e)
        }
        ,
        Qt.executeCallback("onDearFlipLoad")
    }()
}();
