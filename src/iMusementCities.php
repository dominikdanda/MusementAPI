<?php

interface iMusementCities
{
    public function loadCities(): string | bool;
    public function setRowsLimit(int $_limit);
    public function setRowsOffset(int $_offest);
    public function setMusementApiUri(string $_uri);
    public function isMusementApiSet(): bool;
}
