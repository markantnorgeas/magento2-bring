<?php
namespace Markant\Bring\Model;



/**
 * Copyright (C) Markant Norge AS - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @author petterk
 * @date 5/23/16 3:05 PM
 */
class BookingClientService
{


    const BRING_CUSTOMERS_API = 'https://api.bring.com/booking/api/customers.json';

    const BRING_BOOKING_API = 'https://api.bring.com/booking/api/booking';

    private $clientId;

    private $apiKey;

    private $clientUrl;

    private $_scopeConfig;


    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
        $this->clientId = $this->_scopeConfig->getValue('carriers/bring/global/bring_client_url');
        $this->apiKey = $this->_scopeConfig->getValue('carriers/bring/global/mybring_client_uid');
        $this->clientUrl = $this->_scopeConfig->getValue('carriers/bring/global/mybring_api_key');

        if (!$this->clientId) {
            throw new \Exception("Mybring login ID must not be empty.");
        }
        if (!$this->apiKey) {
            throw new \Exception("Mybring login API KEY must not be empty.");
        }
        if (!$this->clientUrl) {
            throw new \Exception("Bring Client URL must not be empty.");
        }
    }

    public function getBookingClient() {

    }

    public function customersToOptionArray ($client) {
        $option = [];
        foreach ($client->getCustomers() as $customer) {
            $option[] = ['value' => $customer['customerNumber'], 'label' => $customer['name']];
        }
        return $option;
    }

}