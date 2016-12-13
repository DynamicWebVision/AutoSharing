<?php namespace App\Service;

use App\Config;

class Utility  {

    const GOOGLE_SHORTENER_URL =  "https://www.googleapis.com/urlshortener/v1/url";

    public function checkStringInString($searchTerm , $tweet)
    {
        if (strpos(strtoupper($tweet),strtoupper($searchTerm)) !== false) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function pluckText($haystack, $start, $finish) {
        $stringToEnd = substr($haystack, strpos($haystack, $start));

        if ($this->checkStringInString(" ", $stringToEnd)) {
            return substr($stringToEnd, 0, strpos($stringToEnd, " "));
        }
        else {
            return $stringToEnd;
        }
    }

    public function url_exists($url) {
        if (!$fp = curl_init($url)) return false;
        return true;
    }

    public function googleUrlShortener($long_url) {

        $config = new Config();

        $ch = curl_init(Utility::GOOGLE_SHORTENER_URL . '?key=' . $config->googleApiKey);

        curl_setopt_array(
            $ch,
            array(
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_CONNECTTIMEOUT => 0,
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POSTFIELDS => '{"longUrl": "' . $long_url . '"}'
            )
        );

        $json_response = json_decode(curl_exec($ch), true);
        return $json_response['id'] ? $json_response['id'] : $long_url;
    }
}
