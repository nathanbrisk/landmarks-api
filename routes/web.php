<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    $urlToDocs = env('APP_WEB_ROOT', '/rmi-services/landmarks/') . 'storage/api-docs/api-docs.json';
    return view('vendor/swagger-lume/index', ['urlToDocs' => $urlToDocs]);
});

$router->get('canadian-provinces',  [
    'uses' => 'CanadianProvincesController@showAll',
    'as' => 'show_all_canadian_provinces'
]);

$router->get('canadian-provinces/{slug}',  [
    'uses' => 'CanadianProvincesController@showOne',
    'as' => 'show_one_canadian_province'
]);

$router->get('countries',  [
    'uses' => 'CountriesController@showAll',
    'as' => 'show_all_countries'
]);

$router->get('countries/{slug}',  [
    'uses' => 'CountriesController@showOne',
    'as' => 'show_one_country'
]);

$router->get('high-schools',  [
    'uses' => 'HighSchoolsController@showAll',
    'as' => 'show_all_high_schools'
]);

$router->get('high-schools/{slug}',  [
    'uses' => 'HighSchoolsController@showOne',
    'as' => 'show_one_high_school'
]);

$router->get('us-states',  [
    'uses' => 'UsStatesController@showAll',
    'as' => 'show_all_us_states'
]);

$router->get('us-states/{slug}',  [
    'uses' => 'UsStatesController@showOne',
    'as' => 'show_one_us_state'
]);

$router->get('us-zip-codes',  [
    'uses' => 'UsZipCodesController@showAll',
    'as' => 'show_all_us_zip_codes'
]);

$router->get('us-zip-codes/{zip_code}',  [
    'uses' => 'UsZipCodesController@showOne',
    'as' => 'show_one_us_zip_code'
]);
