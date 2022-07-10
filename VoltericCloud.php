<?php

class VoltericCloud
{
	static $API_ENDPOINT = "https://api.volteric.com/v1";
	private $authid;
	private $authtoken;

	public function login($id, $token) {
		$requestlogin = $this->internalGet(self::$API_ENDPOINT . "/authentication/session?sessionid=" . $id . "&sessiontoken=" . $token);
		if($requestlogin["status"] != 200) {
			throw new Exception($requestlogin["data"]);
		} else {
			$this->authid = $id;
			$this->authtoken = $token;
			return $requestlogin["data"];
		}
	}

	public function getAuthUrl() {
		if(!isset($this->authid) or !isset($this->authtoken)) {
			throw new Exception("Auth parameters invalid.");
		} else {
			return "?sessionid=".$this->authid."&sessiontoken=".$this->authtoken;
		}
	}

	public function get($route) {
		if(strpos($route, '?') !== false) {
			throw new Exception("Query parameters must be sent as a POST request.");
		} else {
			$makerequest = $this->internalGet(self::$API_ENDPOINT . $route . $this->getAuthUrl());
			if($makerequest["status"] != 200) {
				throw new Exception($makerequest["data"]);
			} else {
				return $makerequest["data"];
			}
		}
	}

	public function post($route, $params) {
		if(strpos($route, '?') !== false) {
			throw new Exception("Query parameters must be sent as a POST request.");
		} else {
			$makerequest = $this->internalPost(self::$API_ENDPOINT . $route . $this->getAuthUrl(), $params);
			if($makerequest["status"] != 200) {
				throw new Exception($makerequest["data"]);
			} else {
				return $makerequest["data"];
			}
		}
	}

	private function internalGet($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $endpoint,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    private function internalPost($endpoint, $params)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
