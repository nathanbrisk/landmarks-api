<?php
namespace Tests\Functional;

use \Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class ApiTest extends TestCase
{
    protected static $wasSetup = false;

    public function setUp(): void
    {
        parent::setUp();

        if ( ! static::$wasSetup) {
            $this->artisan('migrate', ['--seed' => null, '--database' => 'sqlite']);
            static::$wasSetup = true;
        }
    }

    public function testGetCanadianProvince()
    {
        $response = $this->json('GET', '/canadian-provinces/alberta');
        $expected_arr = [
            'canadianProvince' => [
                [
                    'title' => "Alberta",
                    'abbrev' => "AB",
                    'slug' => "alberta",
                    'order' => null
                ]
            ]
        ];

        $response->seeStatusCode(200);
        $response->seeJsonEquals($expected_arr);
    }

    public function testGetCanadianProvinces()
    {
        $response = $this->json('GET', '/canadian-provinces');

        $expected_datum     = ['slug' => "british-columbia"];
        $expected_datum2    = ['slug' => "alberta"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
    }

    public function testDoNotShowInactiveCanadianProvinces()
    {
        $response = $this->json('GET', '/canadian-provinces');

        $unexpected_datum = ['slug' => "hockey-province"];

        $response->seeStatusCode(200);
        $response->dontSeeJson($unexpected_datum);
    }

    public function testInvalidCanadianProvincesSlug()
    {
        $response = $this->json('GET', '/canadian-provinces/&&&&1');

        $response->seeStatusCode(400);
    }

    public function testUnrecognizedCanadianProvincesSlug()
    {
        $response = $this->json('GET', '/canadian-provinces/not-real');

        $response->seeStatusCode(404);
    }

    ///////////////////////

    public function testGetCountry()
    {
        $response = $this->json('GET', '/countries/afghanistan');
        $expected_arr = [
            'country' => [
                [
                    'title' => "Afghanistan",
                    'abbrev' => "AF",
                    'slug' => "afghanistan",
                    'order' => null
                ]
            ]
        ];

        $response->seeStatusCode(200);
        $response->seeJsonEquals($expected_arr);
    }

    public function testGetCountries()
    {
        $response = $this->json('GET', '/countries');

        $expected_datum     = ['slug' => "australia"];
        $expected_datum2    = ['slug' => "belize"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
    }

    public function testDoNotShowInactiveCountries()
    {
        $response = $this->json('GET', '/countries');

        $unexpected_datum = ['slug' => "nathan-town"];

        $response->seeStatusCode(200);
        $response->dontSeeJson($unexpected_datum);
    }

    public function testInvalidCountriesSlug()
    {
        $response = $this->json('GET', '/countries/&&&&1');

        $response->seeStatusCode(400);
    }

    public function testUnrecognizedCountriesSlug()
    {
        $response = $this->json('GET', '/countries/not-real');

        $response->seeStatusCode(404);
    }

    ///////////////////////

    public function testGetHighSchool()
    {
        $response = $this->json('GET', '/high-schools/greenway-high-school-phoenix-az');
        $expected_arr = [
            'highSchool' => [
                [
                    'title' => "Greenway High School",
                    'city' => "Phoenix",
                    'state' => "AZ",
                    'slug' => "greenway-high-school-phoenix-az",
                    'order' => null
                ]
            ]
        ];

        $response->seeStatusCode(200);
        $response->seeJsonEquals($expected_arr);
    }

    public function testGetHighSchools()
    {
        $response = $this->json('GET', '/high-schools');

        $expected_datum     = ['slug' => "greenway-senior-high-coleraine-mn"];
        $expected_datum2    = ['slug' => "west-mec-greenway-high-school-phoenix-az"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
    }

    public function testGetFilteredHighSchools()
    {
        $response = $this->json('GET', '/high-schools?filter[title]=test');

        $expected_datum     = ['title' => "New Testament Baptist Christian School"];
        $expected_datum2    = ['title' => "Whitestone Academy"];
        $unexpected_datum   = ['title' => "Greenway High School"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
        $response->dontSeeJson($unexpected_datum);
    }

    public function testUnrecognizedHighSchoolsFilter()
    {
        $response = $this->json('GET', '/high-schools?filter[title]=te');

        $expected_datum     = ['slug' => "greenway-senior-high-coleraine-mn"];
        $expected_datum2    = ['slug' => "west-mec-greenway-high-school-phoenix-az"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
    }

    public function testInvalidHighSchoolsFilter()
    {
        $response = $this->json('GET', '/high-schools?filter[title]=+*3add');

        $response->seeStatusCode(400);
    }

    public function testDoNotShowInactiveHighSchools()
    {
        $response = $this->json('GET', '/high-schools');

        $unexpected_datum = ['slug' => "derek-zoolander-school"];

        $response->seeStatusCode(200);
        $response->dontSeeJson($unexpected_datum);
    }

    public function testInvalidHighSchoolsSlug()
    {
        $response = $this->json('GET', '/high-schools/&&&&1');

        $response->seeStatusCode(400);
    }

    public function testUnrecognizedHighSchoolsSlug()
    {
        $response = $this->json('GET', '/high-schools/not-real');

        $response->seeStatusCode(404);
    }

    ///////////////////////

    public function testGetUsState()
    {
        $response = $this->json('GET', '/us-states/arizona');
        $expected_arr = [
            'usState' => [
                [
                    'title' => "Arizona",
                    'abbrev' => "AZ",
                    'slug' => "arizona",
                    'order' => null
                ]
            ]
        ];

        $response->seeStatusCode(200);
        $response->seeJsonEquals($expected_arr);
    }

    public function testGetUsStates()
    {
        $response = $this->json('GET', '/us-states');

        $expected_datum     = ['slug' => "alabama"];
        $expected_datum2    = ['slug' => "oklahoma"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
    }

    public function testDoNotShowInactiveUsStates()
    {
        $response = $this->json('GET', '/us-states');

        $unexpected_datum = ['slug' => "state-of-nathan"];

        $response->seeStatusCode(200);
        $response->dontSeeJson($unexpected_datum);
    }

    public function testInvalidUsStatesSlug()
    {
        $response = $this->json('GET', '/us-states/&&&&1');

        $response->seeStatusCode(400);
    }

    public function testUnrecognizedUsStatesSlug()
    {
        $response = $this->json('GET', '/us-states/not-real');

        $response->seeStatusCode(404);
    }

    ///////////////////////

    public function testGetUsZipCode()
    {
        $response = $this->json('GET', '/us-zip-codes/99901');
        $expected_arr = [
            'usZipCode' => [
                [
                    'zip_code' => "99901",
                    'city' => "KETCHIKAN",
                    'state' => "AK",
                    'order' => null
                ]
            ]
        ];

        $response->seeStatusCode(200);
        $response->seeJsonEquals($expected_arr);
    }

    public function testGetUsZipCodes()
    {
        $response = $this->json('GET', '/us-zip-codes');

        $expected_datum     = ['zip_code' => "85023"];
        $expected_datum2    = ['zip_code' => "85080"];

        $response->seeStatusCode(200);
        $response->seeJson($expected_datum);
        $response->seeJson($expected_datum2);
    }

    public function testDoNotShowInactiveUsZipCodes()
    {
        $response = $this->json('GET', '/us-zip-codes');

        $unexpected_datum = ['zip_code' => "00000"];

        $response->seeStatusCode(200);
        $response->dontSeeJson($unexpected_datum);
    }

    public function testInvalidUsZipCodesSlug()
    {
        $response = $this->json('GET', '/us-zip-codes/&&&&1');

        $response->seeStatusCode(400);
    }

    public function testUnrecognizedUsZipCodesSlug()
    {
        $response = $this->json('GET', '/us-zip-codes/not-real');

        $response->seeStatusCode(404);
    }
}
