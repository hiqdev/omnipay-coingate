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
 * CoinGate Abstract Request
 */

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Merchant endpoint
     * @var string
     */
    protected $liveEndpoint = 'https://api.coingate.com/v2';
    protected $testEndpoint = 'https://api-sandbox.coingate.com/v2';

    /**
     * Get merchant api key
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param string $value merchant api key
     * @return self
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the merchant currency
     * @return string merchant currency
     */
    public function getReceiveCurrency()
    {
        return $this->getParameter('receiveCurrency');
    }

    /**
     * @param string $value merchant currency
     * @return self
     */
    public function setReceiveCurrency($value)
    {
        return $this->setParameter('receiveCurrency', $value);
    }

    /**
     * @param string $value merchant id
     * @return self
     */
    public function setId($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getParameter('title');
    }

    /**
     * @param string $value operation title
     * @return self
     */
    public function setTitle($value)
    {
        return $this->setParameter('title', $value);
    }

    /**
     * Get merchant endpoint
     * @return string
     */
    public function getEndpoint()
    {
        return $this->testEndpoint;
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * Send data to merchat
     * @param array $data
     * return \Omnipay\CoinGate\Message\PurchaseResponse
     */
    public function sendData($data)
    {
        $body = $data ? http_build_query($data) : null;

        $httpRequest = $this->httpClient->createRequest($this->getHttpMethod(), $this->getEndpoint(), null, $body);
        $httpRequest->setHeader('Authorization', "Token " . $this->getApiKey());

        if ($this->getHttpMethod() == 'POST') {
            $httpRequest->setHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        $httpResponse = $httpRequest->send();

        return $this->response = $this->createResponse($httpResponse->json(), $httpResponse->getStatusCode());
    }

    /**
     * @param string $value merchant http method
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @param array $data
     * @param integer $statusCode
     * @return \Omnipay\CoinGate\Message\PurchaseResponse
     */
    protected function createResponse($data, $statusCode)
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
