/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth

(function ($, Drupal, window, document, undefined) {
  
// Mobile
$(document).ready(function() {
    
  enquire.register("screen and (max-width:47.9375em)", {

      // OPTIONAL
      // If supplied, triggered when a media query matches.
      match : function() {
        // alert('match');
        toggleMenu.init();
      },
                                  
      // OPTIONAL
      // If supplied, triggered when the media query transitions 
      // *from a matched state to an unmatched state*.
      unmatch : function() {
        // alert('unmatch');
        toggleMenu.destroy();
      },
      
      // OPTIONAL
      // If supplied, triggered once, when the handler is registered.
      setup : function() {
        // alert('handler registered');
      },
                                  
      // OPTIONAL, defaults to false
      // If set to true, defers execution of the setup function 
      // until the first time the media query is matched
      deferSetup : false,
                                  
      // OPTIONAL
      // If supplied, triggered when handler is unregistered. 
      // Place cleanup code here
      destroy : function() {}
        
  });

});  // End Ready


  var toggleMenu = {

    init : function () {
      var mainMenu = $('#navigation'),
          mainNavToggle = $('#toggle-nav'),
          $body = $('body');

      $('#admin-menu').hide();
      
      $(mainNavToggle).on('click', function(event){
        event.preventDefault();
        event.stopPropagation();

        $body.toggleClass('show-nav');
      });

    },
    reinit : function () {
    },
    destroy : function () {
      $('body').removeClass('show-nav');
    }
  };

})(jQuery, Drupal, this, this.document);