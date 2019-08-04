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

    public function setUp()
    {
        $manageTravelDataStub = $this->createMock(ManageTravelData::class);
        $manageTravelDataStub->method('loadTravelDataByCoordinates')
            ->willReturn([]);

        $this->calculateDistance = new CalculateDistance();
        $this->manageBreweryVisits = new ManageBreweryVisits($this->calculateDistance, $manageTravelDataStub);
    }

    public function testBreweryVisits(): void
    {
        $travelData = [
            '123' => [
                'distance' => 7,
                'coordinates' => [
                    'latitude' => 54.898940,
                    'longitude' => 23.901350,
                ],
                'name' => 'Kauno Alus',
                'city' => 'Kaunas',
                'country' => 'Lietuva',
                'beers' => [
                    'Kauno Gyvas',
                    'Kauno Šviesusis',
                    'Kauno Tamsusis',
                ]
            ]
        ];
        $coordinates = [
            'latitude' => 54.966480,
            'longitude' => 23.922131,
        ];
        $maxDistance = 500;

        $result = $this->manageBreweryVisits->breweryVisits($travelData, $coordinates, $maxDistance);

        $this->assertCount(3, $result['travels']);
        $this->assertCount(3, $result['beers']);
        $this->assertEquals(14, $result['total']);
    }
}
