<?php

use PHPUnit\Framework\TestCase;

class MusementCitiesTest extends TestCase
{
    protected static $musementCitiesInstance;

    public static function setUpBeforeClass(): void
    {
        // static::$queue = new Queue;
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

    public function testLoadCities()
    {
        
    }
}
