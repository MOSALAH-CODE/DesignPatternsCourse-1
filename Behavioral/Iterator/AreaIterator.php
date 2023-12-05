<?php


namespace Behavioral\Iterator;


class AreaIterator implements \Iterator
{
    /**
     * @var EgyptCitiesCollection
     */
    private EgyptCitiesCollection $citiesCollection;
    private $sortedCitries = [];
    private $index = 0;


    public function __construct(EgyptCitiesCollection $citiesCollection)
    {
        $this->citiesCollection = $citiesCollection;
        $this->sortByArea();
    }

    public function current()
    {
        return $this->sortedCitries[$this->index];
    }

    public function next(): void
    {
        $this->index +=1;
    }

    public function key()
    {
       return $this->index;
    }

    public function valid(): bool
    {
       return isset($this->citiesCollection->getEgyptCities()[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    private function sortByArea()
    {
        $areas = [];
       $this->sortedCitries = $this->citiesCollection->getEgyptCities();

        foreach ($this->citiesCollection->getEgyptCities() as $key => $city)
        {
            $areas [] = $city->getArea();
        }
        array_multisort($areas,SORT_DESC,$this->sortedCitries);
    }
}