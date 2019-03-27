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

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * CoinGate Purchase Response
 */

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @return boolean
     */
    public function isRedirect()
    {
        return !isset($this->data['reason']);
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        if (isset($this->data['payment_url'])) {
            return $this->data['payment_url'];
        }
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return null
     */
    public function getRedirectData()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if (isset($this->data['reason'])) {
            return $this->data['reason'].': '.$this->data['message'];
        }
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }
}
