<?php

declare(strict_types=1);

/**
 * Get and return Musement's cities list
 *
 * @author Dominik
 */
class MusementCities extends MusementCitiesProperties implements iMusementCities
{
	public function loadCities(): string | bool
	{
		if(!$this->isMusementApiSet()) {
			throw new Exception('Musement API URI Required');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->musementApiUri . sprintf($this->musementGetCitiesEndpoint, $this->rowsOffset, $this->rowsLimit));

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'accept: application/json',
			'Accept-Language: en-US'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_exec($ch);
		$result = curl_exec($ch);
		curl_close($ch);

		error_log($result);
		return $result;
	}
}
