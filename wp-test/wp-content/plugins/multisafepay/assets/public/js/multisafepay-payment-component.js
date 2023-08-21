(function (multisafepay_payment_component_gateways, $) {

    const PAYMENT_METHOD_SELECTOR = 'ul.wc_payment_methods input[type=\'radio\'][name=\'payment_method\']';
    const FORM_BUTTON_SELECTOR    = '#place_order';

    class MultiSafepayPaymentComponent {

        payment_component                    = false;
        config                               = [];
        gateway                              = '';
        payment_component_container_selector = '';

        constructor(config, gateway) {
            this.payment_component_container_selector = '#' + gateway + '_payment_component_container';
            this.payment_component                    = false;
            this.config                               = config;
            this.gateway                              = gateway;

            // Triggered when change the payment method selected
            $( document ).on( 'payment_method_selected', ( event ) => { this.on_payment_method_selected( event ); } );

            // Triggered when something changes in the and start the process to refresh everything
            $( document ).on( 'update_checkout', ( event ) => { this.on_update_checkout( event ); } );

            // Triggered when something changed in the checkout and the process to refresh everything is finished
            $( document ).on( 'updated_checkout', ( event ) => { this.on_updated_checkout( event ); } );

            // Trigered when the checkout loads
            $( document ).on( 'init_checkout', ( event ) => { this.on_init_checkout( event ); } );

            // Trigered when user click on submit button of the checkout form
            $( document ).on( 'click', FORM_BUTTON_SELECTOR, ( event ) => { this.on_click_place_order( event ); } );

        }

        on_payment_method_selected( event ) {
            this.logger( event.type );

            if ( false === this.is_selected() || false === this.is_payment_component_gateway() ) {
                return;
            }
            this.maybe_init_payment_component();
        }

        on_update_checkout( event ) {
            this.logger( event.type );

            if ( false === this.is_selected() || false === this.is_payment_component_gateway() ) {
                return;
            }

            this.maybe_init_payment_component();
        }

        on_updated_checkout( event ) {
            this.logger( event.type );

            if ( false === this.is_selected() || false === this.is_payment_component_gateway() ) {
                return;
            }

            this.refresh_payment_component_config();
            this.maybe_init_payment_component();
        }

        on_init_checkout( event ) {
            this.logger( event.type );

            if ( false === this.is_selected() || false === this.is_payment_component_gateway() ) {
                return;
            }

            this.maybe_init_payment_component();
        }

        on_click_place_order( event ) {
            this.logger( event.type );
            this.remove_errors();

            if ( true === this.is_selected() && true === this.is_payment_component_gateway() ) {
                if (this.get_payment_component().hasErrors()) {
                    this.logger( this.get_payment_component().getErrors() );
                    this.insert_errors( this.get_payment_component().getErrors() );
                } else {
                    this.remove_payload();
                    this.logger( this.get_payment_component().getOrderData() );
                    var payload = this.get_payment_component().getPaymentData().payload;
                    this.insert_payload( payload );
                }
                $( '.woocommerce-checkout' ).submit();
            }

        }

        is_selected() {
            if ( $( PAYMENT_METHOD_SELECTOR + ":checked" ).val() == this.gateway ) {
                return true;
            }
            return false;
        }

        is_payment_component_gateway() {
            if ( $.inArray( $( PAYMENT_METHOD_SELECTOR + ":checked" ).val(), multisafepay_payment_component_gateways ) !== -1 ) {
                return true;
            }
            return false;
        }

        get_new_payment_component() {
            return new MultiSafepay(
                {
                    env: this.config.env,
                    apiToken: this.config.api_token,
                    order: this.config.orderData
                }
            );
        }

        get_payment_component() {
            if ( ! this.payment_component ) {
                this.payment_component = this.get_new_payment_component();
            }
            return this.payment_component;
        }

        init_payment_component() {
            this.show_loader();
            var multisafepay_component = this.get_payment_component();
            multisafepay_component.init(
                'payment',
                {
					container: this.payment_component_container_selector,
					gateway: this.config.gateway,
					onLoad: state => { this.logger( 'onLoad' ); },
					onError: state => { this.logger( 'onError' ); }
                }
            );
            this.hide_loader();
        }

        maybe_init_payment_component() {
            // there is no way to know if the payment component exist or not; except for checking the DOM elements
            if ( $( this.payment_component_container_selector + ' > .msp-container-ui' ).length > 0) {
                return;
            }
            this.logger( 'Container exist' );
            this.init_payment_component();
        }

        show_loader() {
            $( '#' + this.gateway + '_payment_component_container' ).html( '<div class="loader-wrapper"><span class="loader"></span></span></div>' );
            $( FORM_BUTTON_SELECTOR ).prop( 'disabled', true );
        }

        hide_loader() {
            $( '#' + this.gateway + '_payment_component_container .loader-wrapper' ).remove();
            $( FORM_BUTTON_SELECTOR ).prop( 'disabled', false );
        }

        insert_payload( payload ) {
            $( '#' + this.gateway + '_payment_component_payload' ).val( payload );
        }

        remove_payload() {
            $( '#' + this.gateway + '_payment_component_payload' ).val( '' );
        }

        insert_errors( errors ) {
            var gateway_id = this.gateway;
            $.each(
                errors.errors,
                function( index, value ) {
                    $( 'form.woocommerce-checkout' ).append(
                        '<input type="hidden" class="' + gateway_id + '_payment_component_errors" name="' + gateway_id + '_payment_component_errors[]" value="' + value.message + '" />'
                    );
                }
            );
        }

        remove_errors() {
            $( 'form.woocommerce-checkout .' + this.gateway + '_payment_component_errors' ).remove();
        }

        refresh_payment_component_config() {
            $.ajax(
                {
                    url: this.config.ajax_url,
                    type: 'POST',
                    data: {
                        'nonce': this.config.nonce,
                        'action': 'multisafepay_creditcard_component_arguments',
                        'gateway_id': this.config.gateway_id,
                        'gateway': this.config.gateway,
                    },
                    success: function (response) {
                        this.config = response;
                    }.bind( this )
                }
            );
        }

        logger( argument ) {
            if ( this.config.debug ) {
                console.log( argument );
            }
        }

    }

    $.each(
        multisafepay_payment_component_gateways,
        function ( index, gateway ) {
			if ( $( '#payment ul.wc_payment_methods li.payment_method_' + gateway ).length > 0 ) {
				new MultiSafepayPaymentComponent( window['payment_component_config_' + gateway], gateway );
			}
		}
    );

})( multisafepay_payment_component_gateways, jQuery );
