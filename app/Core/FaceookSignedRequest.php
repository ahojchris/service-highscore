<?php

namespace App\Core;

/**
 * Class FaceookSignedRequest
 * @package App\Core
 */
class FaceookSignedRequest
{

    var $signed_request_raw;
    var $signed_request;

    var $secret;

	/**
	 * FaceookSignedRequest constructor.
	 *
	 * @param $signed_request_raw
     */
    function __construct($signed_request_raw)
    {
        $this->signed_request_raw = $signed_request_raw;
        $this->secret             = Config::get('FB_APP_SECRET');
    }

	/**
	 * @return mixed|null
     */
	public function parse()
    {
        list($encoded_sig, $payload) = explode('.', $this->signed_request_raw, 2);

        // decode the data
        $sig  = $this->base64UrlDecode($encoded_sig);
        $data = json_decode($this->base64UrlDecode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $this->secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad signature!');

            return null;
        }

        return $data;
    }

	/**
	 * @param $input
	 *
	 * @return string
     */
    private function base64UrlDecode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }

}