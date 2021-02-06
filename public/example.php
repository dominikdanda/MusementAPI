<?php

declare(strict_types=1);

require '../config.inc.php';
require '../Controllers/MusementCities.php';
require '../Controllers/WeatherapiForecast.php';
require '../View/DisplayWeather.php';

$musementCities = new MusementCities();
$cities = $musementCities
	->setMusementApiUri($_ENV['MusementApiUri'])
	->setRowsLimit(5)
	->setRowsOffset(0)
	->getCities();

$weatherapiForecast = new WeatherapiForecast();
$citiesWithForecast = $weatherapiForecast
	->setApiKey($_ENV['WeatherApiKey'])
	->setForecastHour('12:00')
	->setCities($cities)
	->getCitiesWithForecast();

$displayWeather = new DisplayWeather();
$displayWeather
	->setCitiesWithForecast($citiesWithForecast)
	->show();
