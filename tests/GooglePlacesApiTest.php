<?php
/**
 * Class which tests the GooglePlacesApi class
 */
class GooglePlacesApiTest extends PHPUnit_Framework_TestCase {

    /**
     * positive test case
     */
    public function testPositive() {
        $apiKey = trim(file_get_contents(__DIR__ . '/../_apiKey'));
        $GooglePlacesApi = new Models\GooglePlacesApi($apiKey);

        $results = $GooglePlacesApi->search('buritos in Berlin');

        $this->assertTrue(count($results) > 0);
    }

    /**
     * testing the Exception handling if the wrong API key provided
     */
    public function testWrongApiKey() {

        $this->setExpectedException('Exception', 'The provided API key is invalid.');

        $apiKey = 'wrong key';
        $GooglePlacesApi = new Models\GooglePlacesApi($apiKey);

        $results = $GooglePlacesApi->search('buritos in Berlin');
    }

}
