<?php

namespace Nexmo\Service;

use Nexmo\Exception;

/**
 * Class VerifyCheck
 * @package Nexmo\Service
 */
class VerifyCheck extends Service
{
    /**
     * @inheritdoc
     */
    public function getRateLimit()
    {
        // Max number of requests per second. Nexmo developer API claims 3/sec max, but actually more than 2/sec causes error 429 Too Many Requests.
        return 2;
    }


    /**
     * @return string
     */
    public function getEndpoint()
    {
        return 'https://api.nexmo.com/verify/check/json';
    }

    /**
     * @param string $requestId
     * @param string $code
     * @param string $ipAddress
     * @throws Exception
     * @return array
     */
    public function invoke($requestId = null, $code = null, $ipAddress = null)
    {
        if(!$requestId) {
            throw new Exception("\$requestId parameter cannot be blank");
        }

        if(!$code) {
            throw new Exception("\$code parameter cannot be blank");
        }

        return $this->exec([
            'request_id' => $requestId,
            'code' => $code,
            'ip_address' => $ipAddress
        ]);
    }

    /**
     * @param array $response
     * @return bool
     * @throws Exception
     */
    protected function validateResponse(array $response)
    {
        if (!isset($response['status'])) {
            throw new Exception('status property expected');
        }

        if (!empty($response['error_text'])) {
            throw new Exception('Unable to verify number: ' . $response['error_text'] . ' - status ' . $response['status']);
        }

        if ($response['status'] > 0) {
            throw new Exception('Unable to verify number: status ' . $response['status']);
        }

        return true;
    }
}
