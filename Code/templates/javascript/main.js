//  @codekit-prepend "plugins.js";
/**
 *
 *  @function
 *  @description:   Anonimous function autoexecutable
 *  @params jQuery $.- An jQuery object instance
 *  @params window window.- A Window object Instance
 *  @author: @_Chucho_
 *
 */
( function ( $, window, document, undefined ) {
    //  Revisa la disponibilidad de localStorage
    var storage, deviceWidth, isPortable, typeOfDevice, minDeviceWidth  = 320, maxDeviceWidth = 568, timeLapseOfCarrousel    = 6000;
    if( 'localStorage' in window && window.localStorage !== null ) {
        storage = localStorage;
    } else {
        try {
            if ( localStorage.getItem ) {
                storage = localStorage;
            }
        } catch( e ) {
            storage = {};
        }
    }

    //  When DOM is loaded
    $( function ( ) {

        //  Click behavior for Menu button in mobile version
        $( '.cell' ).on( 'click', function( e ) {
            e.preventDefault();
            e.stopPropagation();

            $( '.header ul' ).toggleClass( 'active' );
        } );
    } );

    //  When page is finished loaded
    $( 'document' ).ready( function ( e ) {

        //  Calculate paginator's width
        if ( $( '.pageList' ).exists() ) {
            yourPhoto.resizePaginator();

            $( window ).on( 'resize', function ( e ) {
                e.preventDefault();
                e.stopPropagation();

                yourPhoto.resizePaginator();
            } );
        }

        if ( $( 'form[name="contact-form"]' ).exists() ) {

            //  Validation of the contact form
            $( 'input[type="submit"]' ).on( 'click', function ( e ) {
                e.preventDefault();
                e.stopPropagation();

                var contact         = {};
                contact.nombre      = $.trim( $( 'input[name="name"]' ).val() );
                contact.correo      = $.trim( $( 'input[name="email"]' ).val() );
                contact.mensaje     = $.trim( $( 'textarea[name="comments"]' ).val() );
                var flag            = true;

                $( 'input.error, textarea.error' ).removeClass( 'error' );

                //  Valida el nombre
                if ( !yourPhoto._validateMinLength( 2, contact.nombre.length ) ) {
                    $( 'input[name="name"]' ).addClass( 'error' );
                    flag    = false;
                }
                if ( !yourPhoto._validateMaxLength( 140, contact.nombre.length ) ) {
                    $( 'input[name="name"]' ).addClass( 'error' );
                    flag    = false;
                }

                //  Valida el correo
                if ( !yourPhoto._validateMinLength( 2, contact.correo.length ) ) {
                    $( 'input[name="email"]' ).addClass( 'error' );
                    flag    = false;
                }
                if ( !yourPhoto._validateMail( contact.correo ) ) {
                    $( 'input[name="email"]' ).addClass( 'error' );
                    flag    = false;
                }

                //  Valida que se escriba un mensaje
                if ( !yourPhoto._validateMinLength( 8, contact.mensaje.length ) ) {
                    $( 'textarea' ).addClass( 'error' );
                    flag    = false;
                }
                if ( !yourPhoto._validateMaxLength( 140, contact.mensaje.length ) ) {
                    $( 'textarea' ).addClass( 'error' );
                    flag    = false;
                }

                if ( !flag ) {
                    return false;
                }

                var errorFunction   = function () {

                };

                var successFunction = function ( responseText ) {
                    //console.log(responseText.success);

                    var _title, _markup;

                    if ( $.parseJSON( responseText ) ) {

                        responseText    = $.parseJSON( responseText );

                        if( responseText && ( responseText.success === 'true' || responseText.success === true ) ) {

                            alert( 'good' );
                        } else {
                            alert( 'bad' );
                        }
                    } else {
                        alert( 'very bad' );
                    }
                };

                yourPhoto.validateForm( 'form[name="contact-form"]', contact, errorFunction, successFunction );
            } );
        }

        if ( $( 'form[name="share-form"]' ).exists() ) {

            // Show the form to share the image.
            $( '.social-button:last-child' ).on( 'click', 'a', function ( e ) {
                e.preventDefault();
                e.stopPropagation();

                $( 'form[name="share-form"]' ).fadeToggle( 150 );
            } );

            //  validation of Share form
            $( 'input[type="submit"]' ).on( 'click', function ( e ) {
                e.preventDefault();
                e.stopPropagation();

                var share         = {};
                share.correo      = $.trim( $( 'input[name="email"]' ).val() );
                var flag          = true;

                $( 'input.error' ).removeClass( 'error' );

                //  Valida el correo
                if ( !yourPhoto._validateMinLength( 2, share.correo.length ) ) {
                    $( 'input[name="email"]' ).addClass( 'error' );
                    flag    = false;
                }
                if ( !yourPhoto._validateMail( share.correo ) ) {
                    $( 'input[name="email"]' ).addClass( 'error' );
                    flag    = false;
                }

                if ( !flag ) {
                    return false;
                }

                var errorFunction   = function () {

                };

                var successFunction = function ( responseText ) {
                    //console.log(responseText.success);

                    var _title, _markup;

                    if ( $.parseJSON( responseText ) ) {

                        responseText    = $.parseJSON( responseText );

                        if( responseText && ( responseText.success === 'true' || responseText.success === true ) ) {

                            $( 'form[name="share-form"]' ).fadeOut( 150 );
                        } else {
                            alert( 'bad' );
                        }
                    } else {
                        alert( 'very bad' );
                    }
                };

                yourPhoto.validateForm( 'form[name="share-form"]', share, errorFunction, successFunction );
            } );
        }
    } );
} ) ( jQuery, window, document );