<?php

require './config.inc.php';
require './Controllers/MusementCities.php';
require './Controllers/WeatherapiForecast.php';

$musementCities = new MusementCities();
$weatherapiForecast = new WeatherapiForecast();
$cities = $musementCities
		->setMusementApiUri($_ENV['MusementApiUri'])
		->setRowsLimit(10)
		->setRowsOffset(0)
		->getCities();

$citiesWithForecast = $weatherapiForecast
		->setApiKey($_ENV['WeatherApiKey'])
		->setForecastHour('12:00')
		->setCities($cities)
		->getCitiesWithForecast();

foreach ($citiesWithForecast as $cityForecast) {
	/**
	 * 0 = ~now [eg. "Sunny"]
	 * 1 = today (00:00) [eg. "Overcast"]
	 * 2 = tomorrow (00:00) [eg. "Partly cloudy"]
	 */
	$msg = sprintf('Processed city %s | %s - %s', $cityForecast->name, $cityForecast->forecast[0], $cityForecast->forecast[2]);
	fwrite(STDOUT, $msg . PHP_EOL);
}
