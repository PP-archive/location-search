<?php

namespace Models;

use Exception;

/**
 * Google Places location search API adapter class
 */
class GooglePlacesApi {

    protected $_key;
    protected $_output;
    protected $_baseUrl;

    const STATUS_REQUEST_DENIED = 'REQUEST_DENIED';

    /**
     * Constructor
     * @param string $apiKey
     */
    public function __construct($apiKey) {
        $this->_key = $apiKey;
        $this->_output = 'json';

        $this->_baseUrl = 'https://maps.googleapis.com/maps/api/place/textsearch/' . $this->_output;
    }

    /**
     * Searching through the Google places API
     * @param string $query
     * @return array
     * @throws Exception
     */
    public function search($query) {

        // assembling the url, adding there the api key and the search query
        $url = $this->_baseUrl . '?' . http_build_query(['key' => $this->_key, 'query' => $query]);

        // executing the http query to the Google API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        // if the response code is not 200, then something went wrong
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
            throw new Exception("Unsuccessful query.");
        }

        // decoding the result from json
        $result = json_decode($result);

        // checking the status
        // if the status is one of the error ones - throwing the exception
        switch ($result->status) {
            case self::STATUS_REQUEST_DENIED:
                throw new Exception($result->error_message);
                break;
            default:
                break;
        }

        $results = [];

        // iterating through the results to fill the "clean" results array
        foreach ($result->results as $record) {
            $results[] = ['formatted_address' => $record->formatted_address, 'name' => $record->name];
        }

        // returing the "clean" results array
        return $results;
    }

}
