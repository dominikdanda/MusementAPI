<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

class WeatherForecastTest extends TestCase
{
    protected static $weatherapiForecastInstance;
    private static $weatherApiResponse = '';

    public static function setUpBeforeClass(): void
    {
        static::$weatherApiResponse = file_get_contents('./WeatherApiResponse.json');
        static::$weatherapiForecastInstance = new WeatherapiForecast;
    }

    public function testSetAndGetApiKey()
    {
        $dummyString = md5(time());
        static::$weatherapiForecastInstance->setApiKey($dummyString);

        $this->assertEquals($dummyString, static::$weatherapiForecastInstance->getApiKey());
    }

    public function testSetAndGetApiUri()
    {
        $dummyString = md5(time());
        static::$weatherapiForecastInstance->setApiUri($dummyString);

        $this->assertEquals($dummyString, static::$weatherapiForecastInstance->getApiUri());
    }

    public function testSetAndGetForecastHour()
    {
        $dummyString = md5(time());
        static::$weatherapiForecastInstance->setForecastHour($dummyString);

        $this->assertEquals($dummyString, static::$weatherapiForecastInstance->getForecastHour());
    }

    public function testSetAndGetCities()
    {
        $jsonObject = json_encode('[
            {
                "id": 1337
            }
        ]');
        static::$weatherapiForecastInstance->setCities($jsonObject);

        $this->assertEquals($jsonObject, static::$weatherapiForecastInstance->getCities());
    }
}
