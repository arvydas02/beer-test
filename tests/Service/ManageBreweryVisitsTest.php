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
    private $travelData;

    public function setUp()
    {
        $this->travelData = [
            '124' => [
                'distance' => 7,
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
            '147' => [
                'distance' => 2,
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
            '888' => [
                'distance' => 98,
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
        ];

        $manageTravelDataStub = $this->createMock(ManageTravelData::class);
        $manageTravelDataStub->method('loadTravelDataByCoordinates')
            ->willReturn($this->travelData);

        $this->calculateDistance = new CalculateDistance();
        $this->manageBreweryVisits = new ManageBreweryVisits($this->calculateDistance, $manageTravelDataStub);
    }

    public function testBreweryVisits(): void
    {
        $coordinates = [
            'latitude' => 54.966480,
            'longitude' => 23.922131,
        ];
        $maxDistance = 500;

        $result = $this->manageBreweryVisits->breweryVisits($this->travelData, $coordinates, $maxDistance);

        $this->assertCount(5, $result['travels']);
        $this->assertCount(8, $result['beers']);
        $this->assertEquals(208, $result['total']);
    }
}
