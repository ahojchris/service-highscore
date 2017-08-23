<?php

namespace App\Core;

class FaceookSignedRequest
{

	var $signed_request_raw;
	var $signed_request;

	var $secret = "21db65a65e204cca7b5afcbad91fea59"; // Use your app secret here

	function __construct($signed_request_raw)
	{
		$this->signed_request_raw = $signed_request_raw;
	}

	public function parse()
	{
		list($encoded_sig, $payload) = explode('.', $this->signed_request_raw, 2);

		// decode the data
		$sig  = $this->base64_url_decode($encoded_sig);
		$data = json_decode($this->base64_url_decode($payload), true);

		// confirm the signature
		$expected_sig = hash_hmac('sha256', $payload, $this->secret, $raw = true);
		if ($sig !== $expected_sig) {
			error_log('Bad signature!');

			return null;
		}

		return $data;
	}

	private function base64_url_decode($input)
	{
		return base64_decode(strtr($input, '-_', '+/'));
	}

}