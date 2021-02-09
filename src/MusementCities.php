<?php

declare(strict_types=1);

/**
 * Get and return Musement's cities list
 *
 * @author Dominik
 */
class MusementCities
{

	private $musementApiUri;
	private $rowsLimit = 10;
	private $rowsOffset = 0;

	const MUSEMENT_GET_CITIES = '/cities?offset=%d&limit=%d';

	public function loadCities(): string | bool
	{
		// if(!$this->isMusementApiSet()) {
		// 	throw new Exception('Musement API URI Required');
		// }

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->musementApiUri . sprintf(self::MUSEMENT_GET_CITIES, $this->rowsOffset, $this->rowsLimit));

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'accept: application/json',
			'Accept-Language: en-US'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_exec($ch);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	public function setRowsLimit(int $_limit): self
	{
		$this->rowsLimit = $_limit;

		return $this;
	}

	public function getRowsLimit(): int
	{
		return $this->rowsLimit;
	}

	public function setRowsOffset(int $_limit): self
	{
		$this->rowsOffset = $_limit;

		return $this;
	}

	public function getRowsOffset(): int
	{
		return $this->rowsOffset;
	}

	public function setMusementApiUri(string $_uri): self
	{
		$this->musementApiUri = $_uri;

		return $this;
	}

	public function getMusementApiUri(): string
	{
		return $this->musementApiUri;
	}

	// private function isMusementApiSet(): bool
	// {
	// 	if (strlen($this->musementApiUri) <= 0) {
	// 		return false;
	// 	}

	// 	return true;
	// }
}
