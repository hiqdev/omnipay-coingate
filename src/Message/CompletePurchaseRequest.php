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
 * CoinGate CompletePurchase Request
 */

class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @return 
     */
    public function getData()
    {
        $this->validate('transactionReference');
    }

    /**
     * Get request endpoint
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint().'/'.$this->getTransactionReference();
    }

    /**
     * Get request method
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    /**
     * Get request response
     * @param array $data
     * @param integer $statusCode
     * @return \Omnipay\CoinGate\Message\CompletePurchaseResponse
     */
    protected function createResponse($data, $statusCode)
    {
        return $this->response = new CompletePurchaseResponse($this, $data, $statusCode);
    }
}
