<?php

/**
 * Get and parse Forecast Weather data for specified Cities
 *
 * @author Dominik
 */
class WeatherapiForecast {

	private $cities;
	private $singleCityApiResp;
	private $apiKey;
	private $daysForecast = 2;
	private $weatherApiUri = 'http://api.weatherapi.com/v1/forecast.json?key=%s&q=%f,%f&days=%d';
	private $forecastHour = '00:00';

	/**
	 * Set WeatherAPI's ApiKey
	 *
	 * @param string $_apiKey
	 * @return $this
	 */
	public function setApiKey(string $_apiKey): self {
		$this->apiKey = $_apiKey;

		return $this;
	}

	/**
	 * Set WeatherAPI's URI
	 *
	 * @param string $_apiUri
	 * @return $this
	 */
	public function setApiUri(string $_apiUri): self {
		$this->weatherApiUri = $_apiUri;

		return $this;
	}

	/**
	 * Make result more accurate.
	 * API returns forecast for 00:00 by default.
	 * Set different hour (eg. "12:00") to get it more accurate to desired time of day
	 *
	 * @param string $_hour eg. "12:00"
	 * @return $this
	 */
	public function setForecastHour(string $_hour): self {
		$this->forecastHour = $_hour;

		return $this;
	}

	/**
	 * Set Musement Cities
	 *
	 * @param json $_jsonCities
	 * @return $this
	 */
	public function setCities(string $_jsonCities): self {
		$this->cities = json_decode($_jsonCities);

		return $this;
	}

	/**
	 * Return Cities (set by setCities() ) with Forecast
	 *
	 * @return iterable
	 */
	public function getCitiesWithForecast(): iterable {
		$forecast = new stdClass();
		foreach ($this->cities as $city) {
			$forecast->forecast = $this->makeApiRequestForCity($city)
					->readForecastFromApiRequest();
			$forecast->name = $city->name;

			yield $forecast;
		}
	}

	/**
	 * Make API request to ewatherapi for single/specified city
	 *
	 * @param Object $_city
	 * @return $this
	 */
	private function makeApiRequestForCity(stdClass $_city): self {
		$requestUri = sprintf($this->weatherApiUri, $this->apiKey, $_city->latitude, $_city->longitude, $this->daysForecast);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestUri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$this->singleCityApiResp = curl_exec($ch);
		curl_close($ch);
		$this->checkApiResponse($httpCode);

		return $this;
	}

	private function checkApiResponse(int $curlCode) {
		if ($curlCode != 200) {
			error_log(var_export($this->singleCityApiResp, true));
			exit('API ERROR');
		}
	}

	/**
	 * Read weather condition
	 *
	 * @return Array Forecast array (0 - now, 1 - today, 2 - tomorrow, etc.)
	 */
	private function readForecastFromApiRequest(): array {
		$day = 0;
		$apiResp = json_decode($this->singleCityApiResp);
		$weatherForecast[$day] = $apiResp->current->condition->text;

		foreach ($apiResp->forecast->forecastday as $forecastday) {
			$day++;
			$weatherForecast[$day] = $this->loadWeatherConditionText($forecastday);
		}

		return $weatherForecast;
	}

	/**
	 * Read weather condition for specified hour
	 *
	 * @param Object $_forecastday
	 * @return string weather condition
	 */
	private function loadWeatherConditionText(stdClass $_forecastday): string {
		if ($this->forecastHour == '00:00') {
			return $_forecastday->day->condition->text;
		}

		return $this->loadWeatherForecastForTargetHour($_forecastday);
	}

	/**
	 * Try to get the weather condition as close to desited hour as possible
	 *
	 * @param Object $_forecastday
	 * @return string weather condition
	 */
	private function loadWeatherForecastForTargetHour(stdClass $_forecastday): string {
		$targetTimestamp = $this->prepareTargetTimestamp($_forecastday);
		$this->previousDiff = null;
		foreach ($_forecastday->hour as $hour) {
			$diffFromTarget = abs($targetTimestamp - $hour->time_epoch);

			if ($this->isHourCloserToTargetHour($diffFromTarget)) {
				$condition = $hour->condition;
			}
		}

		return $condition->text;
	}

	/**
	 * Checks, is the tested hour closer to desired hour than the one in previous test
	 *
	 * @param integer $_diffFromTarget
	 * @return boolean
	 */
	private function isHourCloserToTargetHour(int $_diffFromTarget): bool {
		if (is_null($this->previousDiff) || $_diffFromTarget < $this->previousDiff) {
			$this->previousDiff = $_diffFromTarget;
			return true;
		}

		return false;
	}

	/**
	 * Returns Unix Timestamp for specified day and desired forecast hour (set by setForecastHour() )
	 *
	 * @param Object $_forecastday
	 * @return integer Unix Timestamp
	 */
	private function prepareTargetTimestamp(stdClass $_forecastday): int {
		$targetFormat = 'Y-m-d ' . $this->forecastHour;
		$targetHourDate = date($targetFormat, $_forecastday->date_epoch);
		$targetHourDateTime = DateTime::createFromFormat('Y-m-d h:i', $targetHourDate);

		return $targetHourDateTime->getTimestamp();
	}

}
