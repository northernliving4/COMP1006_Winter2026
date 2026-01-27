<?php

class car
{

    //Properties
    public string $make;
    public string $model;
    public int $year;

    public function __construct(string $make, string $model, int $year)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    //method
    public function getCar(): string
    {
        return "Car: " . $this->year . " " . $this->make . " " . $this->model;
    }













}