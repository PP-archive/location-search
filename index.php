<?php
// to have all the composer functionality in place
require "./vendor/autoload.php";

// reading the Google API key
$apiKey = trim(file_get_contents('./_apiKey'));

// creating the new instance of the GooglePlacesApi class
$GooglePlacesApi = new Models\GooglePlacesApi($apiKey);

// wrapping all the further code in try block, because it can throw Exceptions
try {
    // the the query is not set, then throw Exception
    if(isset($_GET['query'])) {
        $query = $_GET['query'];
    } else {
        throw new Exception('query parameter should be stated');
    }
    
    // searching the places, using our class
    $results = $GooglePlacesApi->search($query);

    // printing the results
    Header("Content-type: application/json; charset=utf-8");

    echo json_encode($results, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    // if we cought an Exception, then let's print the message from it
    $result = ['message' => $e->getMessage()];
    
    // let's change the http status code to 500
    http_response_code(500);
    
    // printing the results
    Header("Content-type: application/json; charset=utf-8");
    
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}