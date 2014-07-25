(function ($, Drupal, window, document, undefined) {

  /*
  @media breakpoints based on SASS breakpoints

  ** Enquire.js utilizes the matchMedia Javascript API: 
  Using enquire JS http://wicky.nillia.ms/enquire.js/
  https://developer.mozilla.org/en-US/docs/Web/API/Window.matchMedia
  https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Testing_media_queries?redirectlocale=en-US&redirectslug=DOM%2FUsing_media_queries_from_code

  Typical theme breakpoints:
  Minimum Width: 320px / 20em;
  Phone: 480px / 30em;
  Tablet Small: 600px / 37.5em;
  Tablet: 760px / 47.5em;
  Desktop: 980px / 61.25em;

  */

  // $(document).ready(function() {

  //   // Enquire Variables
  //   var breakMobile = "screen and (max-width:47.499em)";
  //   var breakDesktop = "screen and (min-width:47.5em)";

  //   // Functions to be executed on all breakpoints
  //   // ...place code here ...

  //   // Example matchmedia query.
  //   enquire.register(breakMobile, {

  //       // OPTIONAL
  //       // If supplied, triggered when a media query matches.
  //       match : function() {
  //         // alert('min 45em');

  //       },
                                    
  //       // OPTIONAL
  //       // If supplied, triggered when the media query transitions 
  //       // *from a matched state to an unmatched state*.
  //       unmatch : function() {
  //         // alert('leaving min 45em');
  //       },
        
  //       // OPTIONAL
  //       // If supplied, triggered once, when the handler is registered.
  //       setup : function() {
  //         // alert('set up min 45em');
  //       },
                                    
  //       // OPTIONAL, defaults to false
  //       // If set to true, defers execution of the setup function 
  //       // until the first time the media query is matched
  //       deferSetup : true,
                                    
  //       // OPTIONAL
  //       // If supplied, triggered when handler is unregistered. 
  //       // Place cleanup code here
  //       destroy : function() {}
          
  //   });

  // });  // End Ready

})(jQuery, Drupal, this, this.document);
