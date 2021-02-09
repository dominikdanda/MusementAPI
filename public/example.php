<?php

declare(strict_types=1);

require __DIR__ . '/../config.inc.php';
require __DIR__ . '/../vendor/autoload.php';
// require __DIR__.'/../src/MusementCities.php';
// require __DIR__.'/../src/WeatherapiForecast.php';
require __DIR__ . '/../View/DisplayWeather.php';

$musementCities = new MusementCities;
$cities = $musementCities
	->setMusementApiUri($_ENV['MusementApiUri'])
	->setRowsLimit(5)
	->setRowsOffset(0)
	->loadCities();

$weatherapiForecast = new WeatherapiForecast;
$citiesWithForecast = $weatherapiForecast
	->setApiKey($_ENV['WeatherApiKey'])
	->setForecastHour('12:00')
	->setCities($cities)
	->loadCitiesWithForecast();

$displayWeather = new DisplayWeather;
$displayWeather->showCitiesWithForecast($citiesWithForecast);
