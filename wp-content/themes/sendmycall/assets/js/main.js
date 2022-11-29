import '../../node_modules/jquery/dist/jquery';
jQuery( document ).ready(function($) {
    /**
     * Back to top btn
     */

    let btn = jQuery('#back-to-top');
    btn.on('click', function(e) {
        e.preventDefault();
        jQuery('html, body').animate({scrollTop:0}, '300');
    });

    /**
     * Burger
     */

    let mobileMenu = {
        settings: {
            button: $( '.mobile-menu-button' ),
            menuWrap: $( '.header-mobile-nav' ),
            header: $( '.header' ),
        },
        show: function(){
            // this.toggleMenu( true, this );
        },
        hide: function() {
            // this.toggleMenu( false, this );
        },
        toggleMenu: function( state, self, e ){
            self.settings.button.toggleClass( 'is-active', state );
            self.settings.menuWrap.toggleClass( 'is-active', state );
            self.settings.header.toggleClass( 'is-active', state );

            if (this.settings.button.hasClass( 'is-active' )) {
                this.onShow();
            } else {
                this.onHide();
            }
        },
        setMenuWrapHeight: function(){
            var maxHeight = $( 'header.header' ).height();

            if ($( '#wpadminbar' ).length && ! $( 'header.header' ).hasClass( 'mobile-fixed' )) {
                maxHeight = maxHeight + $( '#wpadminbar' ).height()
            }
            this.settings.menuWrap.css( 'max-height', 'calc(100vh - ' + maxHeight + 'px)' );
        },
        toggleDropdown: function( e, self, state ){
            var $link = e.target.tagName === 'a' ? $( e.target ) : $( e.target ).closest( 'a' );
            $link.toggleClass( 'is-active',self, state );
            $link.closest( '.menu-item' ).find( '.sub-menu' ).stop().slideToggle(self, state );
        },
        init: function(){
            var self = this;
            self.settings.button.on( 'click', function(e) { self.toggleMenu( null, self, e ) } );

            $( document ).on(
                'click',
                function(e){
                    if ( ! $( e.target ).is( '.mobile-menu-button, .mobile-menu-button *, .header__mobile-nav, .header__mobile-nav *' )) {
                        self.toggleMenu( false, self, e );
                    }
                }
            );

            $( window ).on(
                'toggle-mobile-menu',
                function(e){
                    self.toggleMenu( true, self, e );
                }
            );
        },
        onShow: function() {
            $( 'body' ).addClass( 'overflow-hidden' );
        },
        onHide: function() {
            $( 'body' ).removeClass( 'overflow-hidden' );
        }
    }
    mobileMenu.init();

    /**
     * Accordeon footer
     */

    if(window.outerWidth < 768) {
        $('.footer-row .footer-col:nth-child(1) .acc-head').addClass('active');
        $('.footer-row .footer-col:nth-child(1) .acc-content').slideDown();
        $('.acc-head').on('click', function() {
            if($(this).hasClass('active')) {
                $(this).siblings('.acc-content').slideUp();
                $(this).removeClass('active');
            }
            else {
                $('.acc-content').slideUp();
                $('.acc-head').removeClass('active');
                $(this).siblings('.acc-content').slideToggle();
                $(this).toggleClass('active');
            }
        });
    }

});