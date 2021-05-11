<?php

namespace Baselinker;

class Baselinker {
    
    const API_URL = 'https://api.baselinker.com/connector.php';
    
    public function __construct($token) {
        $this->token = $token;
    }
    
    public function __call($name, $args) {
        $id = json_encode(array_shift($args));
        $method_type = preg_split('/(?=[A-Z])/',$name)[0];

        return $this->request($id, $name, $method_type);
    }
    
    public function request($params, $method, $method_type) {
        
        $apiParams = [
			"token" => $this->token,
			"method" => $method,
			"parameters" => $params
		];
		
		//echo '<pre>';
		//print_r($params);
		//print_r(http_build_query($apiParams));
		//echo '</pre>';
		
		$curl = curl_init(static::API_URL);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($apiParams));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($curl));
		curl_close($curl);
		
		//echo '<pre>';
		//print_r($response);
		//echo '</pre>';
		return $response;
    }
    
    protected $token;
}

