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

class PurchaseRequest extends AbstractRequest
{
    /**
     * Get data to reques
     * @return array
     */
    public function getData()
    {
        $this->validate('amount', 'currency');
        return [
            'order_id' => $this->getTransactionId(),
            'price_amount' => $this->getAmount(),
            'price_currency' => $this->getCurrency(),
            'receive_currency' => $this->getReceiveCurrency(),
            'callback_url' => $this->getNotifyUrl(),
            'success_url' => $this->getReturnUrl(),
            'cancel_url' => $this->getCancelUrl(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
        ];
    }

    /**
     * Get request endpoint
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint().'/orders';
    }
}
