(function ($) {
  "use strict";

  const MACHIC_APP = {
    init() {
      this.searchSelectWidth();
      this.depatmentsMenu();
      this.offcanvasMenu();
      this.themeTooltip();
      this.stickySidebar();
      this.themeQuantity();
      this.minicartmobile();
      this.mobileSearch();
    },

    searchSelectWidth() {
      const item = document.querySelectorAll( '.site-search .form-select.custom-width' );

      if ( item !== null ) {
        for ( var i = 0; i < item.length; i++ ) {
          const self = item[i];
          const fakeValue = document.createElement( 'SPAN' );
          fakeValue.classList.add( 'selected-value' );
          const parentDiv = self.parentNode;

          parentDiv.insertBefore(fakeValue, self)


          const changeWidth = () => {
            const selectedText = self.options[self.selectedIndex].text;
            fakeValue.innerText = selectedText;
            const fakeWidth = fakeValue.offsetWidth;

            self.style.width = fakeWidth + 10 + 'px';
          }

          self.onchange = () => {
            changeWidth();
          }

          changeWidth();
        }
      }
    },
    depatmentsMenu() {
      const container = document.querySelectorAll( '.site-departments-wrapper' );

      if ( container !== null ) {
        container.forEach( ( el ) => {
          const menu = el.querySelector( '.departments-menu' );

          if ( menu !== null ) {
            // Wrap icon
            const menuIcon = menu.querySelectorAll( 'i' );
            for ( var i = 0; i < menuIcon.length; i++ ) {
              const orgIcon = menuIcon[i];
              const wrapIcon = document.createElement( 'div' );
              wrapIcon.classList.add( 'menu-icon' );

              orgIcon.parentNode.insertBefore( wrapIcon, orgIcon );
              wrapIcon.appendChild( orgIcon );
            }

            // SUbmenu title
            const hasChildMenu = menu.querySelectorAll( '.menu-item-has-children' );
            for ( var i = 0; i < hasChildMenu.length; i++ ) {
              const hasItem = hasChildMenu[i];
              const hasItemText = hasItem.firstElementChild.innerText;
              const subMenu = hasItem.lastElementChild;

              if ( subMenu.classList.contains( 'sub-menu' ) ) {
                const subParent = subMenu.parentNode;
                const subMenuTitle = document.createElement( 'li' );
                subMenuTitle.classList.add( 'menu-item-title' );
                subMenuTitle.innerText = hasItemText;

                //subMenu.prepend( subMenuTitle );

                // Submenu has image
                if ( subParent.classList.contains( 'has-image' ) ) {
                  const menuWidth = subMenu.offsetWidth;
				  
				  if(menuWidth + ( menuWidth / 1.5 ) != 0){
                  subMenu.style.width = menuWidth + ( menuWidth / 1.5 ) + 'px';
				  }
                }

                // Submenu column 2
                if ( subParent.classList.contains( 'column-2' ) ) {
                  const menuWidth = subMenu.offsetWidth;

                  subMenu.style.width = menuWidth * 2 + 'px';
                }
              }
            }
          }
        })
      }
    },
    offcanvasMenu() {
      const container = document.querySelector( '.site-offcanvas' );
      const overlay = document.querySelector( '.site-overlay' );
	  var siteOverlay = $( '.site-overlay' );

      if ( container !== null || overlay !== null ) {
        var tl = gsap.timeline( { paused: true, reversed: true } );
        tl.set( container, {
          autoAlpha: 1
        }).to( container, .5, {
          x:0,
          ease: 'power4.inOut'
        }).to( overlay, .5, {
          autoAlpha: 1,
          ease: 'power4.inOut'
        }, "-=.5");

        const button = document.querySelectorAll( '.menu-toggle' );
		const categoryButton = $( '.mobile-bottom-menu a.categories' );
        const close = document.querySelector( '.site-offcanvas-close' );

        if ( button !== null ) {
          for ( var i = 0; i < button.length; i++ ) {
            const self = button[i];

            self.addEventListener( 'click', ( e ) => {
              e.preventDefault();
              tl.play();
			  $('.site-offcanvas nav.categories ul.departments-menu').removeClass('show');
            });

          }
        }

        if ( categoryButton !== null ) {
          for ( var i = 0; i < categoryButton.length; i++ ) {
            const self = categoryButton[i];

            self.addEventListener( 'click', ( e ) => {
              e.preventDefault();
              tl.play();
			  $('.site-offcanvas nav.categories ul.departments-menu').addClass('show');
            });

          }
        }

        const klb = new Klbmenu({
          selector: '.offcanvas-menu-container',
          speed: 350
        });

        close.addEventListener( 'click', (e) => {
          e.preventDefault();
          tl.reverse(1.5);
        });

		  siteOverlay.on( 'click', function(e) {
			e.preventDefault();
			tl.reverse();
			setTimeout( function() { 
			  siteOverlay.removeClass( 'active' );
			}, 1000);
		  });


      }
    },

    themeTooltip() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    },

    stickySidebar() {
      const sticky = document.querySelectorAll( '.sticky' );

      if ( sticky !== null ) {
        for ( var i = 0; i < sticky.length; i++ ) {
          const self = sticky;

          $( self ).theiaStickySidebar({
            // Settings
            additionalMarginTop: 30
          });
        }
      }
    },
    themeQuantity() {
      function qty() {
        var container = $( '.quantity:not(.ajax-quantity)' );
		
		$("form.cart.grouped_form .input-text.qty").attr("value", "0");
		
        container.each( function() {
          var self = $( this );
          var buttons = $( this ).find( '.quantity-button' );
          buttons.each( function() {
            $(this).on( 'click', function(event) {
              var qty_input = self.find( '.input-text.qty' );
              if ( $(qty_input).prop('disabled') ) return;
			  var qty_step = parseFloat($(qty_input).attr('step')) ? parseFloat($(qty_input).attr('step')) : 0;
              var qty_min = parseFloat($(qty_input).attr('min'));
              var qty_max = parseFloat($(qty_input).attr('max'));


              if ( $(this).hasClass('minus') ){
                var vl = parseFloat($(qty_input).val());
                vl = ( (vl - qty_step) < qty_min ) ? qty_min : (vl - qty_step);
                $(qty_input).val(vl);
              } else if ( $(this).hasClass('plus') ) {
                var vl = parseFloat($(qty_input).val());
                vl = ( (vl + qty_step) > qty_max ) ? qty_max : (vl + qty_step);
                $(qty_input).val(vl);
              }

              qty_input.trigger( 'change' );
            });
          });
        });
      }

      qty();
      $('body').on( 'updated_cart_totals', qty );
    },
	
    minicartmobile() {
	  if($(window).width() < 601){
		  var button = $( '.site-header .cart-button > a' );

		  button.on( 'click', function(e) {
			e.preventDefault();
			if($( '.site-header .cart-button .cart-dropdown' ).hasClass('hide')){
				$( '.site-header .cart-button .cart-dropdown' ).removeClass( 'hide' );
			} else {
				$( '.site-header .cart-button .cart-dropdown' ).addClass( 'hide' );
			}
		  });
	  }
    },
	
    mobileSearch: function() {
      var searchButton = $( '.mobile-bottom-menu .search' );
      var searchHolder = $( '.klb-mobile-search' );

      if ( searchButton.length ) {
        searchButton.on( 'click', function(e) {
          e.preventDefault();
          $(this).toggleClass( 'active' );
          searchHolder.toggleClass( 'active' );
        });
      }
    },	
	
  };

  MACHIC_APP.init();
  
	$(document).ready(function() {
		$('.all-categories').on('click', function (e) {
			e.preventDefault();
			$("ul.departments-menu").collapse('toggle');
		});

		$(".single-product [data-elementor-type='product']" ).wrap( "<div class='shop-content'><div class='single-product-wrapper'></div></div>" );
	});
	
	$(window).on('load', function(){
		$('.site-loading').fadeOut('slow',function(){$(this).remove();});
	});
	
    $(window).scroll(function() {
        $(this).scrollTop() > 135 ? $("header.site-header").addClass("sticky-header") : $("header.site-header").removeClass("sticky-header")
    });

}(jQuery));