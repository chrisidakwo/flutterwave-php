<?php

namespace ChrisIdakwo\Flutterwave\StandardPayment;

class StandardPayment {
    private string $paymentUrl;

    /**
     * StandardPayment constructor.
     *
     * @param string $paymentUrl
     */
    public function __construct(string $paymentUrl) {
        $this->paymentUrl = $paymentUrl;
    }

    /**
     * @return string
     */
    public function getPaymentUrl(): string {
        return $this->paymentUrl;
    }

    /**
     * @param string $paymentUrl
     * @return static
     */
    public static function builder(string $paymentUrl) {
        return new static($paymentUrl);
    }
}
