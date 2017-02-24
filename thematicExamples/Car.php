<?php
// Code without code style, without check. Just main structure
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

Interface CarDetailsColection extends Check{
    public function setEngine(Engine $engine);
    public function setWheelsCollection(WheelsCollection $wheelsCollection);
    public function setBody(Body $body);
}

Interface Defaults {
    public function setDefaults();
}

class CarException extends \Exception{
    protected $message = 'Car exception';
}

class EngineException extends \Exception{
    protected $message = 'Engine exception';
}

/** To create proper car we have to have proper collection, e.g. bus has it own collection, 
army car it own, etc.
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

class BusDetailsCollection implements CarDetailsColection, setDefaults{
    private $engine;
    private $wheels;
    private $body;

    public function setEngine(Engine $engine){
        $this->engine = $engine;
    }
    
    public function setWheelsCollection(WheelsCollection $wheelsCollection){
         $this->wheelsCollection = $wheelsCollection;
    }
    
    public function setBody(Body $body){
         $this->body = $body;
    }

    public setDefaults(){
        $this->body = new EnglishBusBody();
        $this->wheels = new BusWheels();
        $this->engine = new BusEngine();
    }

    public function check() {
        if(!($this->engine && $this->wheels && $this->body)){
            throw new EngineException();
        }
    }
}

class Bus extends Car{
   public function drive(){
      // Cann add here turn off breakes, check are doors closed, etc.
      $this->getCarDetailsCollection()->getEngine()->start();
      $this->getCarDetailsCollection()->getEngine()->accelerate();      
   }
}
$bus = (new Bus())->createCar((new BusDetailsCollection())->setDefaults());
$bus->drive();
