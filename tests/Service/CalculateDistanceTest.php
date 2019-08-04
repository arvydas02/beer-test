<?php


namespace App\Tests\Service;

use App\Service\CalculateDistance;
use PHPUnit\Framework\TestCase;

class CalculateDistanceTest extends TestCase
{

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
