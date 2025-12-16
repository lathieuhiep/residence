(function($) {
	"use strict";
	window.isIE = /(MSIE|Trident\/|Edge\/)/i.test(navigator.userAgent);
	window.windowHeight = window.innerHeight;
	window.windowWidth = window.innerWidth;
	
	// Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.

    const MathUtils = {
        // map number x from range [a, b] to [c, d]
        map: (x, a, b, c, d) => (x - a) * (d - c) / (b - a) + c,
        // linear interpolation
        lerp: (a, b, n) => (1 - n) * a + n * b,
        // Random float
        getRandomFloat: (min, max) => Math.ceil((Math.random() * (max - min) + min).toFixed(2))
    };

    // console.log(MathUtils.getRandomFloat(0,3));


    if (history.scrollRestoration) {
        // history.scrollRestoration = 'auto';
    }

    // setTimeout(function() {
    //     window.scrollTo({ top: 0, behavior: 'smooth' })
    // });
    
    gsap.registerPlugin(ScrollTrigger, TextPlugin, SplitText);

    $.fn.numberTextLine = function(opts) {
        $(this).each( function () {
            var el = $(this),
                defaults = {
                    numberLine: 0
                },
                data = el.data(),
                dataTemp = $.extend(defaults, opts),
                options = $.extend(dataTemp, data);

            if (!options.numberLine)
                return false;

            // el.ellipsis({
            //     lines: 2
            // });

            el.bind('customResize', function(event) {
                event.stopPropagation();
                reInit();
            }).trigger('customResize');
            $(window).resize( function () {
                el.trigger('customResize');
            })
            function reInit() {
                var fontSize = parseInt(el.css('font-size')),
                    lineHeight = parseInt(el.css('line-height')),
                    overflow = fontSize * (lineHeight / fontSize) * options.numberLine;

                el.css({
                    'display': 'block',
                    'display': '-webkit-box',
                    'height': overflow,
                    '-webkit-line-clamp': String(options.numberLine),
                    '-webkit-box-orient': 'vertical',
                    'overflow': 'hidden',
                    'text-overflow': 'ellipsis'
                });
            }
        })
    }

    $.fn.countTo = function(options) {
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                if( typeof options.break  === 'undefined' ) {
                    if( value.toFixed(options.decimals) > 10 ) {
                        $(_this).html(value.toFixed(options.decimals));
                    } else {
                        $(_this).html('0'+value.toFixed(options.decimals));
                    }
                } else {
                    console.log(value);
                    $(_this).html(value.toFixed(options.decimals).toString().replace('.', options.break));
                }
                                
                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 50,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    
    const ww = $(window).width();
    const wh = $(window).height();

    gsap.registerPlugin(ScrollTrigger);

    const update = (time, deltaTime, frame) => {
        lenis.raf(time * 1000)
    }
    const resize = (e) => {
        ScrollTrigger.refresh();
    }
    const lenis = new Lenis({
        duration: 1,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        // smoothTouch: false,
        // mouseMultiplier: 1,
        // touchMultiplier: 1,
        // smoothTouch: false,
        // syncTouch: true,
        // syncTouchLerp: 0.1,
        // touchMultiplier: 1.5
    });
    lenis.on('scroll', ({ scroll, limit, velocity, direction, progress }) => {
        ScrollTrigger.update();
    })
    gsap.ticker.add(update);
    gsap.ticker.lagSmoothing(0);
    window.addEventListener('resize', resize);
    lenis.scrollTo(0);
    lenis.stop();

    $('.onePageNav .scroll-link').on('click', function(e) {
        e.preventDefault();
        const getId = $(this).attr('href');
        const offset = $(getId).offset().top
        console.log(offset);
        lenis.scrollTo(offset, {
            duration: 0
        });
    });

    const onePageNav = () => {
        var wrap = $('.onePageNav');
        if( wrap.length ) {

            const data = [];
            wrap.find('.scroll-link').each(function() {
                const getId = $(this).attr('href');
                const getOffset = $(this).offset().left;
                data.push({
                    'id': getId,
                    'offset': getOffset,
                });
            });

            Object.keys(data).map(function(key, index) {
                ScrollTrigger.create({
                    trigger: data[key].id,
                    start: 'top center',
                    end: 'bottom bottom',
                    onEnter: () => {
                        wrap.find('li a').removeClass('is-active');
                        wrap.find(`li a[href="${data[key].id}"]`).addClass('is-active');
                        wrap.animate({ scrollLeft: data[key].offset }, 300);
                    },
                });
    
                ScrollTrigger.create({
                    trigger: data[key].id,
                    start: 'bottom bottom-=30%',
                    end: 'bottom+=5% bottom',
                    onEnterBack: () => {
                        wrap.find('li a').removeClass('is-active');
                        wrap.find(`li a[href="${data[key].id}"]`).addClass('is-active');

                        if( data[key].id === '#nav-id-1' ) {
                            wrap.animate({ scrollLeft: 0 }, 0);
                        } else {
                            wrap.animate({ scrollLeft: data[key].offset -100 }, 300);
                        }
                    },
                });
            });

            $('.header__humberger').on('click', function() {
                $('.header').toggleClass('header--showMb');
            });
        }
    }

    function wowReponsiveJs() {
        if ( ww < 768) {
            $('[data-mb-wow]').each(function() {
                var getClass = $(this).attr('data-mb-wow');
                $(this).addClass('wow');
                $(this).addClass(getClass);
            })
        }
        
        if ( ww >= 768 && ww < 1200) {
            $('[data-md-wow-delay]').each(function() {
                var getTime = $(this).attr('data-md-wow-delay');
                $(this).attr('data-wow-delay', getTime);
            })
        }

        if( ww >= 1200) {
            $('[data-xl-wow-delay]').each(function() {
                var getTime = $(this).attr('data-xl-wow-delay');
                $(this).attr('data-wow-delay', getTime);
            })
        }

        if ( ww < 1200 ) {
            $('[wow-down-xl]').each(function() {
                var getClass = $(this).attr('wow-down-xl');
                $(this).addClass('wow');
                $(this).addClass(getClass);
            })
        }

        if ( ww < 768 ) {
            $('[wow-down-md]').each(function() {
                var getClass = $(this).attr('wow-down-md');
                $(this).addClass('wow');
                $(this).addClass(getClass);
            })
        }
    }

    function wowLoadDoneJs() {
        var wow = new WOW({
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            mobile:       true,       // trigger animations on mobile devices (default is true)
            live:         true,       // act on asynchronously loaded content (default is true)
            callback:     function(box) {
                $(box).addClass('effect');
                $(box).removeClass('fix');
                setTimeout(() => {
                    $(box).addClass('done');
                }, 600);
            },
            scrollContainer: null // optional scroll container selector, otherwise use window
        });
        wow.init();
    }
    
    function dataImageMobileUrl() {
        var update = function() {
            var ww = $(window).outerWidth();
            if(ww < 768) {
                $('[data-img-mb').each(function() {
                    var self = $(this),
                        url = self.attr('data-img-mb');
                    self.attr('src', url);
                });
    
                $('[data-bg-mb').each(function() {
                    var self = $(this),
                        url = self.attr('data-bg-mb');
                    self.css('background-image', 'url('+url+')');
                });
                $('[data-mb-xlink]').each(function() {
                    const self = $(this),
                        url = self.attr('data-mb-xlink');
                    self.attr('xlink:href', url);
                });

            }else {
                $('[data-img-pc]').each(function() {
                    var self = $(this),
                        url = self.attr('data-img-pc');
                    self.attr('src', url);
                });
    
                $('[data-bg-pc]').each(function() {
                    var self = $(this),
                        url = self.attr('data-bg-pc');
                    self.css('background-image', 'url('+url+')');
                });

                $('[data-pc-xlink]').each(function() {
                    const self = $(this),
                        url = self.attr('data-pc-xlink');
                    self.attr('xlink:href', url);
                });
            }

            if(ww > 1279) {
                $('[data-img-pcc]').each(function() {
                    var self = $(this),
                        url = self.attr('data-img-pcc');
                    self.attr('src', url);
                });
    
                $('[data-bg-pcc]').each(function() {
                    var self = $(this),
                        url = self.attr('data-bg-pcc');
                    self.css('background-image', 'url('+url+')');
                });
            }

            $('[data-img-sm]').each(function() {
                var self = $(this),
                    url = self.attr('data-img-sm');
                self.attr('src', url);
            });

            $('[data-bg-sm]').each(function() {
                var self = $(this),
                    url = self.attr('data-bg-sm');
                self.css('background-image', 'url('+url+')');
            });
        }
        update();
        $(window).on('resize', debounce(update, 200));
    }

    function lazyLoading() {
        const updateRatio = () => {
            const ww = window.innerWidth;
            if( ww > 767 ) {
                $('[data-ratio-pc]').each(function() {
                    const self = $(this);
                    const getRatio = self.attr('data-ratio-pc');
                    self.find('.fixRatio').css('--ratio', getRatio);
                });
            }else {
                $('[data-ratio-mb]').each(function() {
                    const self = $(this);
                    const getRatio = self.attr('data-ratio-mb');
                    self.find('.fixRatio').css('--ratio', getRatio);
                });
            }
        }
        updateRatio();
        $(window).on('resize', debounce(updateRatio, 200));

        const lazyLoadingImg = () => {
            const ww = window.innerWidth;
            const wh = window.outerHeight;
            $('[data-lazy-img]').each(function() {
                const self = $(this);
                const loadImage = () => {
                    const getSrc = self.attr('data-lazy-img');
                    self.attr('src', getSrc);
                    self.closest('.lazyloading').addClass('loaded');
                };

                const ST = ScrollTrigger.create({
                    trigger: self,
                    start: `top-=${wh} bottom`,
                    onEnter: loadImage,
                    onEnterBack: loadImage,
                    invalidateOnRefresh: true,
                });
            });

            $('[data-lazy-bg]').each(function() {
                const self = $(this);
                const getTrigger = self.attr('data-lazy-trigger-pc');
                const loadImage = () => {
                    const getSrc = self.attr('data-lazy-bg');
                    self.css('background-image', `url(${getSrc})`);
                    self.addClass('loaded');
                };
                if( getTrigger === 'undefined' ) {
                    ScrollTrigger.create({
                        trigger: self,
                        start: `top-=${wh/2} bottom`,
                        onEnter: loadImage,
                        onEnterBack: loadImage,
                    });
                }else {
                    ScrollTrigger.create({
                        trigger: getTrigger,
                        start: `top-=${wh/5} bottom`,
                        onEnter: loadImage,
                        onEnterBack: loadImage,
                    });
                }
            });

            if( ww  > 767) {
                $('[data-lazy-img-pc]').each(function() {
                    const self = $(this);
                    const loadImage = () => {
                        const getSrc = self.attr('data-lazy-img-pc');
                        self.attr('src', getSrc);
                        self.closest('.lazyloading').addClass('loaded');
                    };
    
                    ScrollTrigger.create({
                        trigger: self,
                        start: `top-=${wh} bottom`,
                        onEnter: loadImage,
                        onEnterBack: loadImage,
                    });
                });

                $('[data-lazy-bg-pc]').each(function() {
                    const self = $(this);
                    const getTrigger = self.attr('data-lazy-trigger-pc');
                    const loadImage = () => {
                        const getSrc = self.attr('data-lazy-bg-pc');
                        self.css('background-image', `url(${getSrc})`);
                        self.addClass('loaded');
                    };
                    if( getTrigger === 'undefined' ) {
                        ScrollTrigger.create({
                            trigger: self,
                            start: `top-=${wh/2} bottom`,
                            onEnter: loadImage,
                            onEnterBack: loadImage,
                        });
                    }else {
                        ScrollTrigger.create({
                            trigger: getTrigger,
                            start: `top-=${wh/5} bottom`,
                            onEnter: loadImage,
                            onEnterBack: loadImage,
                        });
                    }
                });

            }else {
                $('[data-lazy-img-mb]').each(function() {
                    const self = $(this);
                    const loadImage = () => {
                        const getSrc = self.attr('data-lazy-img-mb');
                        self.attr('src', getSrc);
                        self.closest('.lazyloading').addClass('loaded');
                    };
    
                    ScrollTrigger.create({
                        trigger: self,
                        start: `top-=${wh} bottom`,
                        onEnter: loadImage,
                        onEnterBack: loadImage,
                    });
                });

                $('[data-lazy-bg-mb]').each(function() {
                    const self = $(this);
                    const loadImage = () => {
                        const getSrc = self.attr('data-lazy-bg-mb');
                        self.css('background-image', `url(${getSrc})`);
                        self.addClass('loaded');
                    };

                    ScrollTrigger.create({
                        trigger: self,
                        start: `top-=${wh/2} bottom`,
                        onEnter: loadImage,
                        onEnterBack: loadImage,
                    });
                });
            }
        }
        $(window).on('load', lazyLoadingImg);
    }

    function headerJs() {
        const header = $('.header');
        const megamenu = $('.menuMobile');
        
        if(header.length) {
            var headeroom = new Headroom(document.querySelector("header"), {
                tolerance : 4,
                offset : 100,
                classes: {
                    pinned: "header-pin",
                    unpinned: "header-unpin"
                },
                onPin : function() {
                },
                onUnpin : function() {
                },
            });
            headeroom.init();
        }

        const showMenu = () => {
            const btn = $('.header__humberger');

            btn.on('click', function() {
                if( header.hasClass('header--showmenu') ) {
                    header.removeClass('header--showmenu');
                    megamenu.removeClass('show-megamenu');
                    // lenis.start();
                    // $('body').removeClass('body-fix-scroll');
                } else {
                    header.addClass('header--showmenu');
                    megamenu.addClass('show-megamenu');
                    // lenis.stop();
                    // $('body').addClass('body-fix-scroll');
                }
            });
            
            megamenu.find('.menuMobile__bg').on('click', function() {
                btn.trigger('click');
            });
            
            megamenu.find('li.menu-has-children > a').on('click', function(e){
                e.preventDefault();
                const el = $(this);
                el.toggleClass('show-menu');
                el.next().slideToggle();
            });

            // megamenu.find('a[data-trigger]').on('click', function(e) {
            //     e.preventDefault();
            //     const self = $(this);
            //     const getId = self.attr('data-trigger');
            //     self.closest('.item').addClass('hide-item');
            //     megamenu.find('.item-sub').removeClass('show-sub');
            //     megamenu.find(getId).addClass('show-sub');
            // });

            // megamenu.find('.item-back').on('click', function(e) {
            //     e.preventDefault();
            //     $(this).closest('.item-sub').removeClass('show-sub');
            //     megamenu.find('.item').removeClass('hide-item');
            // })
        }
        showMenu();
    }

    function tabboxJs() {
        const tabWrap = $('.tabbox');
        if(tabWrap.length) {
            tabWrap.each(function() {
                const self = $(this);
                const link = self.find('.tabbox__list');
                const panel = self.find('.tabbox__content .panel');
                const fixWow = self.attr('data-fix-wow');

                link.find('a').on('click', function(e) {
                    e.preventDefault();
                    const _this = $(this);

                    if( !_this.hasClass('current') ) {
                        link.find('a').removeClass('current');
                        _this.addClass('current');
                        panel.removeClass('show');
                        const getId = _this.attr('href');
                        $(getId).addClass('show');

                        if (fixWow === 'true') {
                            tabWrap.find('.wow').addClass('fix-tab');
                        }
                    }
                })
            });
        }
    }

    function accordionJs() {
        var wrap = $('.accordion');
        if( wrap.length ) {
            wrap.each(function() {
                var self = $(this);
                var panel = self.find('.accordion__panel'),
                    title = panel.find('.accordion__title'),
                    dataFirst = self.attr('data-first');
                
                title.on('click', function() {
                    var el = $(this),
                    _closest = el.closest('.accordion'),
                    _parant = el.closest('.accordion__panel'),
                    _content = _parant.find('.accordion__content');

                    if( dataFirst ) {
                        if( _parant.hasClass('show') ) {
                            _content.slideUp(function()  {
                                _content.removeClass('active');
                                _parant.removeClass('show');
                            });
                        }else {
                            panel.removeClass('active');
                            _parant.addClass('active');
                            _closest.find('.accordion__panel.show .accordion__content').slideUp();
                            _content.slideDown(function() {
                                panel.removeClass('show');
                                _parant.addClass('show');
                            });
                        }
                    }else {
                        if( !_parant.hasClass('active')) {
                            if( _parant.hasClass('show') ) {
                                _closest.find('.accordion__panel').removeClass('show');
                                _content.slideUp(function()  {
                                    _content.removeClass('active');
                                });
                            }else {
                                panel.removeClass('active');
                                _parant.addClass('active');
                                _closest.find('.accordion__panel.show .accordion__content').slideUp();
                                _content.slideDown(function() {
                                    panel.removeClass('show');
                                    _parant.addClass('show');
                                });
                            }
                        }
                    }
                });
            });

            const fixAcc1 = $('.sec-HLVCGia');
            if( fixAcc1.length ) {
                if( ww > 1199 ) {
                    fixAcc1.find('.accordion__panel').each(function() {
                        const self = $(this);
                        const getHeight = self.find('.accordion__title').outerHeight();
                        self.find('.accordion__content').css('margin-top', -getHeight+'px');
                    });
                }
            }
        }
    }

    function backToTopJs() {
        var wrap = $('.btn-backtotop');
        if( wrap.length ) {
            wrap.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop:0}, 500);
            });

            const update = () => {
                const scroll = $(window).scrollTop();
                if( scroll >= wh ) {
                    wrap.closest('.chatbox-fixed').addClass('show');
                } else {
                    wrap.closest('.chatbox-fixed').removeClass('show');
                }
            }
            update();
            $(window).on('scroll', update);
        }
    }

    function scrollToId() {
        var wrap = $('.scrollToJs');
        if( wrap.length ) {
            wrap.on('click', function(e) {
                e.preventDefault();
                const getId = $(this).attr('href');
                const offsetTop = $(getId).offset().top;
                const getHeaderH = $('.header__wrap').outerHeight() + 10;
                $('html, body').animate({scrollTop:  Math.floor(offsetTop-getHeaderH) }, 500);
                
                if( $('.header').hasClass('header--showmenu') ) {
                    $('.header__humberger').trigger('click');
                }
            });
        }
    }

    function selectLangJs() {
        $('.select-lang__label').on('click', function() {
            $(this).parent().toggleClass('show');
        });

        $(document).click(function(e){ 
            var target = e.target; 
            if (!$(target).is('.select-lang__label') && !$(target).parents().is('.select-lang__label')){
                $('.select-lang').removeClass('show');
            }
        });
    }

    // new
    function selectCustom() {
        const wrap = $('.select-custom');
        if( wrap.length ) {
            wrap.find('select').each(function() {
                new SlimSelect({
                    select: $(this)[0],
                    settings: {
                        showSearch: false,
                    }
                })
            });
        }
    }
    
    function loadingVideoJs() {
        const list = $('[data-load-video]');
        if( list.length ) {
            list.each(function() {
                const self = $(this);
                const getSrc = self.attr('data-load-video');
                const video = self.parent();

                const loadVideo = () => {
                    self.attr('src', getSrc);
                    video[0].load();
                    video[0].play();
                };

                ScrollTrigger.create({
                    trigger: self.parent(),
                    start: `top-=${wh}px bottom`,
                    onEnter: loadVideo,
                    onEnterBack: loadVideo,
                    invalidateOnRefresh: true,
                });
            });
        }
    }

    function homeChiNhanhJs() {
        const wrap = $('.sec-homeChiNhanh');

        if( wrap.length ) {
            const itemDom = wrap.find('.item-duan');
            const slideDom = wrap.find('.swiper');
            const slideBtnGropu = slideDom.find('.swiper-btn');
            if( ww > 1199 ) {
                const swiper = new Swiper(slideDom[0], {
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    freeMode: true,
                    loop: false,
                    allowTouchMove: false,
                    allowTouchMove: false, // Tắt swipe tay
                    simulateTouch: false,
                    watchSlidesProgress: true,
                    noSwiping: true,
                });
    
                let totalWidth = 0;
                let fixWidthRun = 0;
                let offsetTop = 0;
                let offsetTopMax = 0;
                let isRunning = false;
                const updateTotalWidth = () => {
                    totalWidth = swiper.wrapperEl.scrollWidth;
                    fixWidthRun = totalWidth - swiper.width;
                    offsetTop = itemDom.offset().top;
                    offsetTopMax = offsetTop + itemDom.outerHeight() - wh;
                };
                updateTotalWidth();


                let getScrollPage = lenis.targetScroll;
    
                const prevBtn = slideDom.find('.btn-prev');
                const nextBtn = slideDom.find('.btn-next');
    
                ScrollTrigger.create({
                    trigger: wrap.find('.item-duan')[0],
                    start: "top top",
                    end: "bottom bottom",
                    scrub: 1,
                    onUpdate: (self) => {
                        const progress = self.progress;
                        getScrollPage = lenis.targetScroll;
                        gsap.set(swiper.wrapperEl, { x: fixWidthRun*-progress });

                        if( progress === 0 ) {
                            prevBtn.addClass('disable');
                        }
    
                        if ( progress < 1 && progress > 0) {
                            prevBtn.removeClass('disable')
                            nextBtn.removeClass('disable')
                        }
    
                        if( progress === 1 ) {
                            nextBtn.addClass('disable');
                        }
                    },
                    onEnter: () => {
                        slideBtnGropu.addClass('show');
                    },
                    onEnterBack: () => {
                        slideBtnGropu.addClass('show');
                    },
                    onLeave: () => {
                        // slideBtnGropu.removeClass('show');
                    },
                    onLeaveBack: () => {
                        // slideBtnGropu.removeClass('show');
                    }
                });
                
                prevBtn.on('click', function(){
                    let diemcong = getScrollPage-swiper.width;
                    if( diemcong < offsetTop ) {
                        diemcong = offsetTop;
                    }
                    lenis.scrollTo(diemcong);
                });
    
                nextBtn.on('click', function(){
                    let diemcong = getScrollPage+swiper.width;
                    if( diemcong > offsetTopMax ) {
                        diemcong = offsetTopMax;
                    }
                    console.log(diemcong);
                    lenis.scrollTo(diemcong);
                });
    
                // Resize
                window.addEventListener('resize', () => {
                    updateTotalWidth();
                    ScrollTrigger.refresh();
                });
    
                ScrollTrigger.addEventListener("refresh", () => {
                    updateTotalWidth();
                    swiper.update();
                });
            } else {
                const swiper = new Swiper(slideDom[0], {
                    slidesPerView: 'auto',
                    spaceBetween: 10,
                    loop: false,
                    navigation: {
                        prevEl: slideBtnGropu.find('.btn-prev')[0],
                        nextEl: slideBtnGropu.find('.btn-next')[0],
                    },
                    breakpoints: {
                        768: {
                            spaceBetween: 15,
                        },
                        1024: {
                            spaceBetween: 20,
                        },
                    },
                });
            }

        }
    }
    
    function bigBranchJs() {
        const wrap = $('.sec-bigBranch');
        if( wrap.length ) {
            const infoSlide = () => {
                const slideDom = wrap.find('.item-info .swiper');
                const slide = new Swiper(slideDom[0], {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    speed: 700,
                    navigation: {
                        prevEl: slideDom.find('.swiper-buttonCustom-prev')[0],
                        nextEl: slideDom.find('.swiper-buttonCustom-next')[0]
                    },
                    pagination: {
                        el: slideDom.find('.swiper-pagination')[0],
                        clickable: true,
                    },
                    loop: true,
                    on: {
                        // click: function () {
                        //     slide.slideNext();
                        // },
                    },
                });
            }
            infoSlide();
        }
    }

    function detailInfoSlideJs() {
        const wrap = $('.sec-detailInfo');
        if( wrap.length && ww < 1200 ) {
            const slideDom = wrap.find('.item-mobile .swiper');
            slideDom.each(function() {
                const self = $(this);
                const slide = new Swiper(self[0], {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    speed: 700,
                    navigation: {
                        prevEl: self.find('.swiper-buttonCustom-prev')[0],
                        nextEl: self.find('.swiper-buttonCustom-next')[0]
                    },
                    pagination: {
                        el: self.find('.swiper-pagination')[0],
                        clickable: true,
                    },
                });
            })
        }
    }

    function popoverJs() {
        const triggers = document.querySelectorAll('.popover-trigger');

        // Hàm ẩn tất cả popover
        function hideAllPopovers() {
            document.querySelectorAll('.popover.show').forEach(popover => {
            popover.classList.remove('show');
            });
        }

        // Hàm hiển thị popover
        function showPopover(popover, trigger) {
            const rect = trigger.getBoundingClientRect();
            const popoverRect = popover.getBoundingClientRect();

            // Tính toán vị trí (dưới trigger, căn giữa)
            let top = rect.bottom + window.scrollY + 20;
            let left = rect.left + window.scrollX + (rect.width / 2) - (popoverRect.width / 2);

            // Giới hạn trong viewport
            const viewportWidth = window.innerWidth;
            if (left < 10) left = 10;
            if (left + popoverRect.width > viewportWidth - 10) {
            left = viewportWidth - popoverRect.width - 10;
            }

            popover.style.top = `${top}px`;
            popover.style.left = `${left}px`;

            popover.classList.add('show');
        }

        // Gắn sự kiện cho từng trigger
        triggers.forEach(trigger => {
            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const targetId = this.getAttribute('data-target');
                const popover = document.getElementById(targetId);

                if (!popover) return;

                hideAllPopovers();
                showPopover(popover, this);
            });
        });

        document.addEventListener('click', hideAllPopovers);

        // Ngăn popover tự ẩn khi click vào nó
        document.querySelectorAll('.popover').forEach(popover => {
            popover.addEventListener('click', e => e.stopPropagation());
        });
    }

    function dataStickyFix() {
        const wrap = $('[data-stickyFix]');
        if( wrap.length ) {
            const inner = wrap.closest(wrap.attr('data-stickyFix'));
            const ulScroll = wrap.find('.ul-menu');
            const ST = ScrollTrigger.create({
                trigger: inner[0],
                start: 'top top',
                end: `bottom top+=${wrap.outerHeight()}px`,
                invalidateOnRefresh : true,
                onEnter: () => {
                    $('.header').addClass('fix-unpin');
                },
                onLeave: () => {
                    $('.header').removeClass('fix-unpin');
                },
                onEnterBack: () => {
                    $('.header').addClass('fix-unpin');
                },
                onLeaveBack: () => {
                    $('.header').removeClass('fix-unpin');
                },
                onUpdate: self => {
                    // let progress = self.progress.toFixed(3);
                    // ulScroll[0].scrollTo((ulScroll[0].scrollWidth - window.innerWidth) * progress,0);
                },
            });
            ulScroll.find('a').on('click', function() {
                setTimeout(function() {
                    ST.refresh();
                }, 500);
            });
        }
    }
    
    function counterJs() {
        const wrap = $('.counterJs');
        if( wrap.length ) {
            wrap.each(function() {
                const self = $(this);
                const getTo = self.attr('data-to');
                function loadImage () {
                    self.countTo({
                        to: getTo
                    })
                };

                ScrollTrigger.create({
                    trigger: self,
                    start: 'top bottom',
                    end: 'bottom top',
                    onEnter: loadImage,
                    onEnterBack: loadImage,
                    invalidateOnRefresh: true,
                });
            });
        }
    }

    function loadingJs() {
        const wrap = $('.loading');
        let _timeout = 700;
        let _dur = 2.5;
        if(wrap.length) {
            if ((device.mobile() || device.tablet()) && device.orientation === 'portrait') {
                _timeout = 600;
                _dur = 1;
            }
            console.log(_timeout);
            const tl = new TimelineMax();
            tl.to('.loading__logo', 1, { });
            tl.to('.loading__logo', 0.3, { autoAlpha: 0 });
            tl.to('.loading__inner', _dur, { width: '100%', ease: 'none' });
            tl.to('.loading__inner', _dur, {
                scale: 6.3, z: 10, transformOrigin: 'bottom center', ease: 'none',
                onStart: () => {
                    setTimeout(() => {
                        wowLoadDoneJs();
                        lenis.start();
                    }, _timeout);
                },
                onComplete: () => {
                    // wrap.remove();
                }
            }, `-=${_dur}`);
        } else {
            wowLoadDoneJs();
            lenis.start();
        }
    }

    // function popupJs() {
    //     $('[data-popup]').on('click', function(e) {
    //         e.preventDefault();
    //         const self = $(this);
    //         const getId = self.attr('href');
    //         $(getId).addClass('show-popup');
    //         $('body').addClass('body-fix-scroll');
    //         lenis.stop();
    //     });

    //     $('.popup__close').on('click', function() {
    //         $('.popup__bg').trigger('click')
    //     });

    //     $('.popup__bg').on('click', function() {
    //         $(this).closest('.popup').removeClass('show-popup');
    //         $('body').removeClass('body-fix-scroll');
    //         lenis.start();
    //     });
    // }

    wowReponsiveJs()
    dataImageMobileUrl();
    // lazyLoading();
    headerJs();
    accordionJs();
    tabboxJs();
    bigBranchJs();
    detailInfoSlideJs();
    // roomBoxJs();
    selectLangJs();
    backToTopJs();
    popoverJs();
    loadingJs();
    // popupJs();
    // scrollToId();

    $(window).on('load', function() {
        // loadingVideoJs();
        onePageNav();
        homeChiNhanhJs();
        dataStickyFix();
        counterJs();
        if( ww > 1199 ) {
            // var cursor = new MouseFollower();
        }
        setTimeout(function() {
            $('body').addClass('body-load-done');
        }, 20)
    });

})(jQuery);