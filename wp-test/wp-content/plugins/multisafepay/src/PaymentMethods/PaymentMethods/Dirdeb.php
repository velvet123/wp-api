<?php declare(strict_types=1);

namespace MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods;

use MultiSafepay\Api\Transactions\OrderRequest\Arguments\GatewayInfo\Account;
use MultiSafepay\Api\Transactions\OrderRequest\Arguments\GatewayInfoInterface;
use MultiSafepay\ValueObject\IbanNumber;
use MultiSafepay\WooCommerce\PaymentMethods\Base\BasePaymentMethod;

class Dirdeb extends BasePaymentMethod {

    /**
     * @return string
     */
    public function get_payment_method_id(): string {
        return 'multisafepay_dirdeb';
    }

    /**
     * @return string
     */
    public function get_payment_method_code(): string {
        return 'DIRDEB';
    }

    /**
     * @return string
     */
    public function get_payment_method_type(): string {
        return ( $this->get_option( 'direct', 'yes' ) === 'yes' ) ? 'direct' : 'redirect';
    }

    /**
     * @return string
     */
    public function get_payment_method_title(): string {
        return 'SEPA Direct Debit';
    }

    /**
     * @return string
     */
    public function get_payment_method_description(): string {
        $method_description = sprintf(
            /* translators: %2$: The payment method title */
            __( 'Suitable for collecting funds from your customers bank account on a recurring basis by means of authorization. <br />Read more about <a href="%1$s" target="_blank">%2$s</a> on MultiSafepay\'s Documentation Center.', 'multisafepay' ),
            'https://docs.multisafepay.com',
            $this->get_payment_method_title()
        );
        return $method_description;
    }

    /**
     * @return boolean
     */
    public function has_fields(): bool {
        return ( $this->get_option( 'direct', 'yes' ) === 'yes' ) ? true : false;
    }

    /**
     * @return array
     */
    public function add_form_fields(): array {
        $form_fields           = parent::add_form_fields();
        $form_fields['direct'] = array(
            'title'    => __( 'Transaction Type', 'multisafepay' ),
            /* translators: %1$: The payment method title */
            'label'    => sprintf( __( 'Enable direct %1$s', 'multisafepay' ), $this->get_payment_method_title() ),
            'type'     => 'checkbox',
            'default'  => 'yes',
            'desc_tip' => __( 'If enabled, additional information can be entered during WooCommerce checkout. If disabled, additional information will be requested on the MultiSafepay payment page.', 'multisafepay' ),
        );
        return $form_fields;
    }

    /**
     * @return array
     */
    public function get_checkout_fields_ids(): array {
        return array( 'account_holder_name', 'account_holder_iban', 'emandate' );
    }

    /**
     * @return string
     */
    public function get_payment_method_icon(): string {
        return 'dirdeb.png';
    }

    /**
     * @param array|null $data
     * @return Account
     */
    public function get_gateway_info( array $data = null ): GatewayInfoInterface {

        $gateway_info = new Account();

        if ( isset( $_POST[ $this->id . '_account_holder_iban' ] ) ) {
            $gateway_info->addAccountId( new IbanNumber( sanitize_text_field( $_POST[ $this->id . '_account_holder_iban' ] ) ) );
        }

        if ( isset( $_POST[ $this->id . '_account_holder_iban' ] ) ) {
            $gateway_info->addAccountHolderIban( new IbanNumber( sanitize_text_field( $_POST[ $this->id . '_account_holder_iban' ] ) ) );
        }

        if ( isset( $_POST[ $this->id . '_emandate' ] ) ) {
            $gateway_info->addEmanDate( sanitize_text_field( $_POST[ $this->id . '_emandate' ] ) );
        }

        if ( isset( $_POST[ $this->id . '_account_holder_name' ] ) ) {
            $gateway_info->addAccountHolderName( sanitize_text_field( $_POST[ $this->id . '_account_holder_name' ] ) );
        }

        return $gateway_info;

    }

}
