<?php


namespace App\Tests\Service;

use App\Service\CalculateDistance;
use App\Service\ManageBreweryVisits;
use App\Service\ManageTravelData;
use PHPUnit\Framework\TestCase;

class ManageBreweryVisitsTest extends TestCase
{
    /**
     * @var ManageBreweryVisits
     */
    private $manageBreweryVisits;

    /**
     * @var CalculateDistance
     */
    protected $calculateDistance;

    /**
     * @var array
     */
    private $locations;
    /**
     * @var array
     */
    private $coordinates;

    public function setUp()
    {
        $this->locations = [
            [
                'breweryId' => 1,
                'coordinates' => [
                    'latitude' => 54.898940,
                    'longitude' => 23.901350,
                ],
                'name' => 'Kauno Alus',
                'city' => 'Kaunas',
                'country' => 'Lietuva',
                'beers' => [
                    1 => 'Kauno Gyvas',
                    3 =>'Kauno Šviesusis',
                    5 => 'Kauno Tamsusis',
                ]
            ],
            [
                'breweryId' => 2,
                'coordinates' => [
                    'latitude' => 54.885870,
                    'longitude' => 23.927810,
                ],
                'name' => 'Volfas Engelman',
                'city' => 'Kaunas',
                'country' => 'Lietuva',
                'beers' => [
                    6 => 'Volfo IPA',
                    7 => 'Volfo APA',
                    8 => 'Volfo Rinktinis',
                ]
            ],
            [
                'breweryId' => 3,
                'coordinates' => [
                    'latitude' => 54.699380,
                    'longitude' => 25.433160,
                ],
                'name' => 'Vilniaus Alus',
                'city' => 'Vilnius',
                'country' => 'Lietuva',
                'beers' => [
                    9 => 'Vilnius Nefiltruotas',
                    10 => 'Vilniaus Tamsusis',
                ]
            ],
            [
                'breweryId' => 4,
                'coordinates' => [
                    'latitude' => 55.497010,
                    'longitude' => 25.643010,
                ],
                'name' => 'Utenos Alus',
                'city' => 'Utena',
                'country' => 'Lietuva',
                'beers' => [
                    15 => 'Žalgirio alus',
                    20 => 'Utenos Radler',
                ]
            ],
        ];

        // Starting coordinates
        $this->coordinates = [
            'latitude' => 54.966480,
            'longitude' => 23.922131,
        ];

        $this->calculateDistance = new CalculateDistance();
        $this->manageBreweryVisits = new ManageBreweryVisits($this->calculateDistance);
    }

    public function testBreweryVisitsWithAllTravelIncluded(): void
    {
        $maxDistance = 500;
        $result = $this->manageBreweryVisits->breweryVisits($this->locations, $this->coordinates, $maxDistance);

        $this->assertCount(6, $result['travels']);
        $this->assertCount(10, $result['beers']);
        $this->assertEquals(320, $result['total']);
    }

    public function testBreweryVisitsWithShorterDistance(): void
    {
        $maxDistance = 300;
        $result = $this->manageBreweryVisits->breweryVisits($this->locations, $this->coordinates, $maxDistance);

        $this->assertCount(5, $result['travels']);
        $this->assertCount(8, $result['beers']);
        $this->assertEquals(208, $result['total']);
    }
}
