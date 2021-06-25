/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.bar_folio = {
    attach: function (context, settings) {

      $('div.js-webform-image-file').addClass('row');
      $('div.webform-image-file-preview-wrapper').addClass('col-sm-3 text-center align-items-center');

      $( "div.webform-image-file-preview-wrapper .form-checkbox" ).addClass("no-display");
      $( "div.webform-image-file-preview-wrapper .form-checkbox" ).next().addClass("white-border");

      $( "div.webform-image-file-preview-wrapper .form-checkbox" ).on( "click", function() {
        if($(this).is(":checked")) { $(this).next().addClass("black-border").removeClass("white-border");}
      else {$(this).next().addClass("white-border").removeClass("black-border");}
      })

      // $(".hover-animate").hover( function (e) {
      $(".hover-animate").mouseenter( function (e) {
        var class_name = $(this).attr('class');
        console.log(class_name);
        $(this).addClass('animated');
        // $(this).toggleClass('animated '+class_name , e.type === 'mouseenter');
      });


    }
  };



})(jQuery, Drupal);
