<?php

Interface Start {
    public function start();
}

Interface Stop{
    public function stop();
}

Interface Accelerate{
    public function accelerate();
}

Interface Car {
   protected function setCarDetailsCollection();
   public function createCar();
}

Interface Engine extends Start, Stop, Accelerate{
    public function check();
    public function getVin();
    public function getModel();
    public function getType();
}

Interface Wheels{
    public function getRadius();
    public function getPressure();
}

Interface WheelsCollection(){
  public function getWheelCount();
  public function addWheel();
  public function removeWheel();
  public function getWeels(); 
}

Interface Body{
    public function getColor();
}

Interface Check{
    public function check();
}

Interface CarDetailsColection extends Check, Collection{
    public function setEngine(Engine $engine);
    public function setWheelsCollection(WheelsCollection $wheelsCollection);
    public function setBody(Body $body);
}

/** To create proper car we have to have proer collection, e.g. bus has it oun collection, 
army car it oun, etc.
**/
abstract class Car{

    protected $carDetailsCollection;

    protected function setCarDetailsCollection(CarDetailsColection $carDetailsCollection){
        $this->carDetailsCollection = $carDetailsCollection;
    }
    
    protected function getCarDetailsCollection(){
        return $this->carDetailsCollection;
    }

    public function createCar(CarDetailsColection $carDetailsCollection) {
      $this->setCarDetailsCollection($carDetailsCollection);
      $this->checkCar();   
    }

    public function checkCar() {
      return $this->carDetailsCollection->check(); 
    }

    abstract public function drive();
}

class Bus extends Car{
   public function drive(){
      $this->getCarDetailsCollection()->getEngine()->start();
      $this->getCarDetailsCollection()->getEngine()->accelerate();      
   }
}
