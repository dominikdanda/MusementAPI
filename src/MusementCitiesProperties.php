<?php

declare(strict_types=1);

/**
 * Set Musement's API properties
 *
 * @author Dominik
 */
class MusementCitiesProperties
{

	protected $musementApiUri;
	protected $musementGetCitiesEndpoint = '/cities?offset=%d&limit=%d';
	protected $rowsLimit = 10;
	protected $rowsOffset = 0;

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

	public function setMusementGetCitiesEndpoint(string $_uri): self
	{
		$this->musementGetCitiesEndpoint = $_uri;

		return $this;
	}

	public function getMusementGetCitiesEndpoint(): string
	{
		return $this->musementGetCitiesEndpoint;
	}

	public function isMusementApiSet(): bool
	{
		if (empty($this->musementApiUri)) {
			return false;
		}

		return true;
	}
}
