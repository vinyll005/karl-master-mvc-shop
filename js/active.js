(function ($) {
    'use strict';

    // :: 1.0 Fullscreen Active Code
    // :: 2.0 Welcome Slider Active Code
    // :: 3.0 Related Product Active Code
    // :: 4.0 Testimonials Slider Active Code
    // :: 5.0 Gallery Menu Style Active Code
    // :: 6.0 Masonary Gallery Active Code
    // :: 7.0 Header Cart btn Active Code
    // :: 8.0 Side Menu Active Code
    // :: 9.0 Magnific-popup Video Active Code
    // :: 10.0 ScrollUp Active Code
    // :: 11.0 Slider Range Price Active Code
    // :: 12.0 PreventDefault a Click
    // :: 13.0 wow Active Code

    var $window = $(window);

    // :: 1.0 Fullscreen Active Code
    $window.on('resizeEnd', function () {
        $(".full_height").height($window.height());
    });

    $window.on('resize', function () {
        if (this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function () {
            $(this).trigger('resizeEnd');
        }, 300);
    }).trigger("resize");

    var welcomeSlide = $('.welcome_slides');

    // :: 2.0 Welcome Slider Active Code
    if ($.fn.owlCarousel) {
        welcomeSlide.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 7000,
            smartSpeed: 1000
        });
    }

    // :: 3.0 Related Product Active Code
    if ($.fn.owlCarousel) {
        $('.you_make_like_slider').owlCarousel({
            items: 3,
            margin: 30,
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 7000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }

    welcomeSlide.on('translate.owl.carousel', function () {
        var slideLayer = $("[data-animation]");
        slideLayer.each(function () {
            var anim_name = $(this).data('animation');
            $(this).removeClass('animated ' + anim_name).css('opacity', '0');
        });
    });

    welcomeSlide.on('translated.owl.carousel', function () {
        var slideLayer = welcomeSlide.find('.owl-item.active').find("[data-animation]");
        slideLayer.each(function () {
            var anim_name = $(this).data('animation');
            $(this).addClass('animated ' + anim_name).css('opacity', '1');
        });
    });

    $("[data-delay]").each(function () {
        var anim_del = $(this).data('delay');
        $(this).css('animation-delay', anim_del);
    });

    $("[data-duration]").each(function () {
        var anim_dur = $(this).data('duration');
        $(this).css('animation-duration', anim_dur);
    });

    // :: 4.0 Testimonials Slider Active Code
    if ($.fn.owlCarousel) {
        $(".karl-testimonials-slides").owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            dots: true,
            autoplay: true,
            smartSpeed: 1200
        });
    }

    // :: 5.0 Gallery Menu Style Active Code
    $('.portfolio-menu button.btn').on('click', function () {
        $('.portfolio-menu button.btn').removeClass('active');
        $(this).addClass('active');
    })

    // :: 6.0 Masonary Gallery Active Code
    if ($.fn.imagesLoaded) {
        $('.karl-new-arrivals').imagesLoaded(function () {
            // filter items on button click
            $('.portfolio-menu').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            // init Isotope
            var $grid = $('.karl-new-arrivals').isotope({
                itemSelector: '.single_gallery_item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.single_gallery_item'
                }
            });
        });
    }

    // :: 7.0 Header Cart btn Active Code
    $('#header-cart-btn').on('click', function () {
        $('body').toggleClass('cart-data-open');
    })

    $('#loginBtn').click(function() {
        $("#login").fadeIn(3, function(){
            $("#login").addClass('form-visible');
            $("#wrapper").addClass('blur');
            $("body").addClass('overflow-hidden');
        });
    });

    $('#exitLoginBtn').click(function() {
        $("#login").fadeOut(300, function(){
        resetErrors();
        $("#login").removeClass('form-visible');
        $("#login").removeClass('change-modal-form');
        $("#wrapper").removeClass('blur');
        $("body").removeClass('overflow-hidden');
    });
    });

    $('#exitRegisterBtn').click(function() {
        $("#register").fadeOut(300, function(){
        resetErrors();
        $("#register").removeClass('form-visible');
        $("#register").removeClass('change-modal-form');
        $("#wrapper").removeClass('blur');
        $("body").removeClass('overflow-hidden');
    });
    });

    $('#registration').click(function(){
        resetErrors();
        $("#login").removeClass('form-visible');
        $("#login").removeClass('change-modal-form');
        $("#register").addClass('change-modal-form');
    });

    $('#loggingIn').click(function(){
        resetErrors();
        $("#register").removeClass('form-visible');
        $("#register").removeClass('change-modal-form');
        $("#login").addClass('change-modal-form');
    });

    // let prevent = true;

    $(document).ready(function() {
    $('#registerForm').submit(function(e)   {

        // if(prevent) {
            e.preventDefault();
        // }

        // let elem = document.querySelector('#registerForm');
        // console.log(elem.hasAttribute('onsubmit'));
        // if(!elem.hasAttribute('onsubmit'))  {
        //     $('#registerForm').submit();
        // }
        resetErrors();

        $.ajax({
            url: 'ajax/checkRegisterForm',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(responce) {

                if(responce.success == '1')  {
                    // alert('All gooood');
                    // prevent = false;
                    // $('#registerForm').removeAttr('onsubmit');
                    // $("#register").removeClass('form-visible');
                    // $('#registerForm').submit();


                    // return prevent = false;
                    location.href = 'register';
                    
                }   else    {
                    if(responce.email)  {
                        $('.loginEmail').addClass('inputTxtError').after('<label class="error">'+responce.email+'</label>');
                    }   
                    if(responce.password)   {
                        $('.loginPassword').addClass('inputTxtError').after('<label class="error">'+responce.password+'</label>');
                    }
                    // return prevent = true;
                }
                
            },
            error: function()   {
                console.log('error on check errors');
            }
        });
    });
    });

    $('#loginForm').submit(function(e)   {
        
        e.preventDefault();
        resetErrors();

        $.ajax({
            url: 'ajax/checkLoginForm',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(responce) {

                if(responce.success == '1')  {
                    // alert('All gooood');
                    location.href = 'login';
                }   else    {
                    if(responce.email)  {
                        $('.loginEmail').addClass('inputTxtError').after('<label class="error">'+responce.email+'</label>');
                    }   
                    if(responce.password)   {
                        $('.loginPassword').addClass('inputTxtError').after('<label class="error">'+responce.password+'</label>');
                    }
                    return false;
                }
                return false;
            },
            error: function()   {
                console.log('error on check errors');
            }
        });

    });

    function resetErrors() {
        $('.loginEmail, .loginPassword').removeClass('inputTxtError');
        $('label.error').remove();
    }

    // // :: 9.0 Magnific-popup Video Active Code
    if ($.fn.magnificPopup) {
        $('.video_btn').magnificPopup({
            disableOn: 0,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: true,
            fixedContentPos: false
        });
        $('.gallery_img').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }

    // :: 10.0 ScrollUp Active Code
    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1000,
            easingType: 'easeInOutQuart',
            scrollText: '<i class="ti-angle-up" aria-hidden="true"></i>'
        });
    }

    // :: 11.0 Slider Range Price Active Code
    $('.slider-range-price').each(function () {
        var min = jQuery(this).data('min');
        var max = jQuery(this).data('max');
        var unit = jQuery(this).data('unit');
        var value_min = jQuery(this).data('value-min');
        var value_max = jQuery(this).data('value-max');
        var label_result = jQuery(this).data('label-result');
        var t = $(this);
        $(this).slider({
            range: true,
            min: min,
            max: max,
            values: [value_min, value_max],
            slide: function (event, ui) {
                var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                console.log(t);
                t.closest('.slider-range').find('.range-price').html(result);
                
            },
            stop: function(event, ui)   {
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data();
            }
        });
    })

    // :: 12.0 PreventDefault a Click
    $("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });

    // :: 13.0 wow Active Code
    if ($window.width() > 767) {
        new WOW().init();
    }

    // filter_data();

    function filter_data()
    {
        // clean_style('category');

        var action = '/ajax/filterProducts';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var page = $('#pageNumber').val();

        var category = get_filter('category');
        var color = get_filter('color');
        var size = get_filter('size');


        $.ajax({
            url: '/ajax/filterProducts',
            method: 'POST',
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, category:category, color:color, size:size, page:page},
            success(data){
                // console.log('I here');
                // console.log(data);
                $('.filter_data').html(data);
            },
            error(){
                console.log('Ajax filter error');
            }
        });

        $.ajax({
            url: '/ajax/updatePagination',
            method: 'POST',
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, category:category, color:color, size:size, page:page},
            success(data){
                // console.log('I here2');
                // console.log(data);
                $('.updPagination').html(data);
            },
            error(){
                console.log('Ajax filter error');
            }
        });
    }

    function get_filter(class_name)
    {
        

        var filter = [];
        
        $('.'+class_name+':checked').each(function()    {
            filter.push($(this).val());
            // console.log(this);
            // update_style(class_name);
        });

        return filter;
    }

    // function clean_style(class_name)
    // {

    //     var elems = document.querySelectorAll("label");

    //     [].forEach.call(elems, function(el) {
    //         el.classList.remove(class_name+"Button-active");
    //         el.classList.add(class_name+"Button");
    //     });
    //     console.log('Cleaned!');
    // }

    // function update_style(class_name)
    // {
    //     var parent = event.target.parentNode;
    //     parent.classList.remove(class_name+'Button');
    //     parent.classList.add(class_name+'Button-active');
    //     console.log('Added');
    // }

    // function change_stile(class_name)
    // {
    //     $('.'+class_name).each(function()   {
    //         if($(this.checked))    {
    //             var parent = class_name.target.parentNode;
    //             parent.classList.remove(class_name+'Button');
    //             parent.classList.add(class_name+'Button-active');
    //         }   else    {
    //             parent.classList.remove(class_name+'Button-active');
    //             parent.classList.add(class_name+'Button');
    //         }
    //     });
    // }



    $('.common_selector').click(function(){
        filter_data();
    });

    $('.cart-form').submit(function(e)    {

        e.preventDefault();

        var productId = $(this).find('input:hidden').val();
        console.log(productId);
    });

})(jQuery);