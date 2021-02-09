<?php

class DisplayWeather
{

    function showCitiesWithForecast($_citiesWithForecast): void
    {
        foreach ($_citiesWithForecast as $cityForecast) {
            /**
             * 0 = ~now [eg. "Sunny"]
             * 1 = today (00:00) [eg. "Overcast"]
             * 2 = tomorrow (00:00) [eg. "Partly cloudy"]
             */
            $msg = sprintf('Processed city %s | %s - %s', $cityForecast->name, $cityForecast->forecast[0], $cityForecast->forecast[2]);
            fwrite(STDOUT, $msg . PHP_EOL);
        }
    }
}
