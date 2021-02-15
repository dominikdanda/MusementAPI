<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

class MusementCitiesPropertiesTest extends TestCase
{
    protected static $musementCitiesInstance;

    public static function setUpBeforeClass(): void
    {
        static::$musementCitiesInstance = new MusementCities;
    }

    public function testSetAndGetRowsLimit()
    {
        $testValue = 10;
        static::$musementCitiesInstance->setRowsLimit($testValue);

        $this->assertEquals($testValue, static::$musementCitiesInstance->getRowsLimit());
    }

    public function testSetAndGetRowsOffset()
    {
        $testValue = 10;
        static::$musementCitiesInstance->setRowsOffset($testValue);

        $this->assertEquals($testValue, static::$musementCitiesInstance->getRowsOffset());
    }

    public function testSetAndGetMusementApiUri()
    {
        $dummyString = md5(time());
        static::$musementCitiesInstance->setMusementApiUri($dummyString);

        $this->assertEquals($dummyString, static::$musementCitiesInstance->getMusementApiUri());
    }

    public function testSetAndGetMusementGetCitiesEndpoint()
    {
        $dummyString = md5(time());
        static::$musementCitiesInstance->setMusementGetCitiesEndpoint($dummyString);

        $this->assertEquals($dummyString, static::$musementCitiesInstance->getMusementGetCitiesEndpoint());
    }

    public function testIsMusementApiSet()
    {
        static::$musementCitiesInstance = new MusementCities;

        $this->assertFalse(static::$musementCitiesInstance->isMusementApiSet());

        $dummyString = md5(time());
        static::$musementCitiesInstance->setMusementApiUri($dummyString);

        $this->assertTrue(static::$musementCitiesInstance->isMusementApiSet());
    }
}
