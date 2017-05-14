<?php

class brainFuck
{
  public $argsStack = [];
  public $memoryStack = [];
  public $memoryPointer = 0;
  public $executionStack = [];
  public $execPrimitive = false;
  
  public function __construct()
  {
    $this->memoryStack = array_fill(0,30000, null);
  }

  public function __destruct()
  {
    $this->executor(0, count($this->executionStack));

  }
  
   /**
   * walk through and excute stack 
   *
   * @param string $start
   * @param string $end
   */
  public function executor($start, $end)
  {
    $this->execPrimitive = true;
    $count = $start;
    $args = $this->argsStack;

    for($count; $count < $end; $count++){
      $aPrimitive = $this->executionStack[$count];

      if($aPrimitive == 'label'){
        $start = $count+1;
        $label = $args[$count][0];
        $this->loop($label, $start);
      } else{
        call_user_func_array([$this, $aPrimitive], $args[$count]);    
      }

    }
    
  }
  
   /**
   * loop over specific sections of the execution stack.
   *
   * @param string $label
   * @param string
   */
  public function loop($label, $start)
  {
   $args = $this->argsStack;
   $end  = $this->findJmp($label, $start);

   while($this->memoryStack[$this->memoryPointer] > 1){
     $this->executor($start, $end);
   }
 }


 /**
   * find the jmp statement for a label
   *
   * @param string $label
   * @param int $start
   */
 public function findJmp($label, $start)
 {
  $args = $this->argsStack;

  foreach($this->executionStack as $index => $aPrimitive){

   if($aPrimitive == 'jmp'){
     $end = ($args[$index][0] == $label)? $index : $start;
     break;
   }

 }

 return $end;
}

/**
   * dump memory stack
   *
   * @return string
   */
private function dumpMemory()
{
  echo implode(' ',$this->memoryStack);
}

/**
   * push metthod sequence to a stack 
   *
   * @param string $method
   * @param array  $args
   */
public function addToExecutionStack($method, $args)
{

 array_push($this->executionStack, $method);
 array_push($this->argsStack, $args);
}


public function __call($method, $args)
{
  if(!$this->execPrimitive){
    $this->addToExecutionStack($method, $args); 
    return $this;
  } else {
   call_user_func_array([$this, $method], $args);
 }
 return $this;
}

/**
   * take character and convert to ASCII
   *
   * @param string $method
   * @return isntance
   */
private function input($inputValue)
{

  $this->memoryStack[$this->memoryPointer] = ord($inputValue);
  return $this;
}

 /**
   * take ASCII and convert to character
   *
   * @param bol $print
   * @return isntance
   */
private  function  output($print=true)
{
  $output = chr($this->memoryStack[$this->memoryPointer]);
  if($print){echo $output;}
  return $this;
}

 /**
   * increment memory counter
   *
   * @param string $label
   * @return instance
   */
private function shiftFwd($num=1)
{
  $this->memoryPointer += $num;
  return $this;
}

/**
   * decrease memory counter
   *
   * @param string $num
   * @return instance
   */
private function shiftBck ($num=1)
{
  $this->memoryPointer -= $num;
  return $this;
}

/**
   * increment cell value
   *
   * @param string $num
   * @return instance
   */
private function inc($num=1)
{
  $this->memoryStack[$this->memoryPointer] += $num; 
  return $this;
}

/**
   * decrement cell value
   *
   * @param string $num
   * @return instance
   */
private function dec($num=1)
{
  $this->memoryStack[$this->memoryPointer] -= $num;
  return $this;
}

/**
   * mark beginning of loop
   *
   * @param string $label
   * @return instance
   */
private function label($label)
{
  return $this;
}

/**
   * mark end of loop
   *
   * @param string $label
   * @return instance
   */
private function jmp($label) 
{
  return $this;
}
}



