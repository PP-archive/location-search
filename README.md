## location search application

## Overview:
The application is a service which provides the quick access to the Google places location search API.
For the users query, it returns a simplified json array, which is based on the Google places API query results.
The pagination option of Google places API is ignored, only the results from the first page are shown.
The service is a rest service, if the error is happened during the query, the http status code would be 500 (the message which describes the error would be stated in the output json).

If the result is successful, the http status code would be 200.

## Installation:
1. Clone the project from github
1. Create the file named _apiKey to the project folder. Put the correct google API key to the file _apiKey.
2. Put the project folder to the server, which is configured to process PHP. Let's assume it's the folder location-search on your localhost.
3. Open one of the next urls in the browser (assuming that index.php is set as directory index):
  * [http://localhost/location-search/?query=buritos in Berlin](http://localhost/location-search/?query=buritos in Berlin)
  * [http://localhost/location-search/?query=ramen in Tokyo](http://localhost/location-search/?query=ramen in Tokyo)

you can test it working in the web:

* [http://location-search.pavelpolyakov.com/?query=buritos in Berlin](http://location-search.pavelpolyakov.com/?query=buritos in Berlin)
* [http://location-search.pavelpolyakov.com/?query=ramen in Tokyo](http://location-search.pavelpolyakov.com/?query=ramen in Tokyo)


## Testing:
Run the ```phpunit``` command, being in the project folder

## Technical description
The project files:
* [/index.php](/index.php) - entry point of the location search service
* [/Models/GooglePlacesApi.php](/Models/GooglePlacesApi.php) - an abstract wrapper for the Google places location search API
* [/tests/](/tests/) - folder with the tests for PHPUnit

## Other noteworthy points
* The composer is used to have an option to use the additional libraries if needed and in order to use it's autoload
