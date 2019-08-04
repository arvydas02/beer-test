<?php


namespace App\Tests\Service;

use App\Service\CalculateDistance;
use PHPUnit\Framework\TestCase;

class CalculateDistanceTest extends TestCase
{
    /**
     * @var CalculateDistance
     */
    protected $calculateDistance;

    public function setUp()
    {
        $this->calculateDistance = new CalculateDistance();
    }


    public function coordinateProvider(): array
    {
        return [
            'From Lodz, Poland to Browar Okacim' => [
                [
                    'latFrom' => 51.74250300,
                    'longFrom' => 19.43295600,
                    'latTo' => 49.96220016,
                    'longTo' => 20.60029984,
                ],
                214
            ],
            'From Browar Okacim to BOSS Browar Witnica S. A.' => [
                [
                    'latFrom' => 49.96220016,
                    'longFrom' => 20.60029984,
                    'latTo' => 52.67390060,
                    'longTo' => 14.90040016,
                ],
                498
            ],
            'From BOSS Browar Witnica S. A. to Berliner Kindl Brauerei AG' => [
                [
                    'latFrom' => 52.67390060,
                    'longFrom' => 14.90040016,
                    'latTo' => 52.47930145,
                    'longTo' => 13.42930031,
                ],
                101
            ],
            'From Domeikava to Kauno Alus' => [
                [
                    'latFrom' => 54.966480,
                    'longFrom' => 23.922131,
                    'latTo' => 54.898940,
                    'longTo' => 23.901350,
                ],
                7
            ],
            'From Kauno Alus to Volfas Engelman' => [
                [
                    'latFrom' => 54.898940,
                    'longFrom' => 23.901350,
                    'latTo' => 54.885870,
                    'longTo' => 23.927810,
                ],
                2
            ],
            'From Volfas Engelman to Vilniaus Alus' => [
                [
                    'latFrom' => 54.885870,
                    'longFrom' => 23.927810,
                    'latTo' => 54.699380,
                    'longTo' => 25.433160,
                ],
                98
            ],
            'From Vilniaus Alus to Utenos Alus' => [
                [
                    'latFrom' => 54.699380,
                    'longFrom' => 25.433160,
                    'latTo' => 55.497010,
                    'longTo' => 25.643010,
                ],
                89
            ],
        ];
    }

    /**
     * @dataProvider coordinateProvider
     */
    public function testDistanceCalculation(array $coordinates, int $expectedResult): void
    {
        $result = $this->calculateDistance->calculateDistance(
            $coordinates['latFrom'],
            $coordinates['longFrom'],
            $coordinates['latTo'],
            $coordinates['longTo']
        );

        $this->assertEquals($expectedResult, $result);
    }
}
