jQuery(document).ready(function(){  
    jQuery("#zo2-header-logo").append('<span class="search-sticky-icon visible-xs"><i class="fa fa-search"></i></span>');
    jQuery(".search-sticky-icon").on('click', function(){
        jQuery("#zo2-top-wrap").slideDown().css({
            position: 'fixed',
            top: '0',
            'z-index':'9999'
        });
        jQuery("#mod-search-searchword").focus();
    });
    jQuery('.search .icon-search').click(function(){
        jQuery('.search').addClass('mobie-search-active');
        jQuery('.search .search-form').fadeIn('300');
        jQuery('.search .search-form .inputbox').focus().css("color","#000");
    });
    jQuery('.search .search-close').on('click', function(){
        jQuery('.search').removeClass('mobie-search-active');
        jQuery('.search .search-form').fadeOut();
        jQuery("#zo2-top-wrap").slideUp();
    });
    jQuery(window).resize(function(){
        if (jQuery(window).width() > 991) {
            jQuery('.search .search-form ').show();
        }
        else{jQuery('.search .search-form ').hide();} 
    });
    // jQuery for chose display product
    jQuery('.page-view-item').on('click',function(e) {
        if (jQuery(this).hasClass('list-layout')) {
            jQuery('.windy-products').removeClass('windy-products-grid').addClass('windy-products-list');
            jQuery('.list-layout').addClass('active-mode-preview');
            jQuery('.grid-layout').removeClass('active-mode-preview');
        }
        else if(jQuery(this).hasClass('grid-layout')) {
            jQuery('.windy-products').removeClass('windy-products-list').addClass('windy-products-grid');
            jQuery('.grid-layout').addClass('active-mode-preview');
            jQuery('.list-layout').removeClass('active-mode-preview');
        }
    });
    
    jQuery(".additional-images").owlCarousel({
        items : 3,
        navigation : true
    });

    if( jQuery(window).width() < 768 ){

        jQuery("#zo2-position-22 .mod-content,#zo2-position-23 .mod-content,#zo2-position-24 .mod-content").hide();
        jQuery("#zo2-position-22").click(function(event) {
            jQuery("#zo2-position-22 .mod-content").slideToggle();
        });
        jQuery("#zo2-position-23").click(function(event) {
            jQuery("#zo2-position-23 .mod-content").slideToggle();
        });
        jQuery("#zo2-position-24").click(function(event) {
            jQuery("#zo2-position-24 .mod-content").slideToggle();
        });
        jQuery(".search-form  form.form-inline i#close").click(function(){
            jQuery("#zo2-top-wrap").slideUp();
        })
    } else
        jQuery("#zo2-position-22 .mod-content,#zo2-position-23 .mod-content,#zo2-position-24 .mod-content").show(); 

    var wOb = jQuery('.orderlistcontainer .activeOrder').outerWidth();
    jQuery('.orderlist').outerWidth(wOb);
})