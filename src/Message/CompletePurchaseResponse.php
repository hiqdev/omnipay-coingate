<?php

/**
 * CoinGate driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-coingate
 * @package   omnipay-coingate
 * @license   MIT
 * @copyright Copyright (c) 2019, HiQDev (http://hiqdev.com/)
 * @forked    https://developer.coingate.com/
 */
namespace Omnipay\CoinGate\Message;

/**
 * CoinGate Purchase Request
 */

class CompletePurchaseResponse extends PurchaseResponse
{
    /**
     * Get purchase status
     * @return boolean
     */
    public function isSuccessful()
    {
        return !$this->getMessage() && $this->isPaid();
    }

    /**
     * @return boolean
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * Get order status
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->data['status'];
    }

    /**
     * Check paid status
     * @return boolean
     */
    public function isPaid()
    {
        return $this->getTransactionStatus() === 'paid';
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function getAmount()
    {
        return $this->data['price_amount'] ?? null;
    }

    /**
     * Get payment time.
     *
     * @return string
     */
    public function getTime()
    {
        $time = new \DateTime($this->data['created_at'], new \DateTimeZone('UTC'));

        return $time->format('c');
    }

    /**
     * Get payment currency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->data['price_currency'];
    }

    /**
     * Get payer info - name, username and id.
     *
     * @return string
     */
    public function getPayer()
    {
        return $this->data['order_id'];
    }
}
