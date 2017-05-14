<?php

class brainFuck
{
  public $memoryPointer = 0;
  public $input = null;
  public $memoryStack = [];
  public $executionStack = [];
  public $argsStack = [];
  public $execPrimitive = false;
  public $labels = [];
  
  function __construct()
  {
      $this->memoryStack = array_fill(0,10000, null);
  }
  
  function __destruct()
  {
      $this->executor(0, count($this->executionStack));
     
  }
  
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
  
  
   public function loop($label, $start)
   {
       $args = $this->argsStack;
       $end  = $this->getLoopEnd($label, $start);
       
       while($this->memoryStack[$this->memoryPointer] > 1){
           $this->executor($start, $end);
       }
   }

   public function getLoopEnd($label, $start)
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

   private function dumpMemory()
   {
      echo implode(' ',$this->memoryStack);
   }
  
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

  private function input($inputValue)
  {
       
        $this->input = ord($inputValue);
        return $this;
  }

    
   private  function  output(&$output = null, $print=true)
   {
        $output = chr($this->memoryStack[$this->memoryPointer]);
        if($print){echo $output;}
        return $this;
   }
    
    private function shiftFwd($num=1)
    {
        $this->memoryPointer += $num;
        return $this;
    }
    
    private function shiftBck ($num=1)
    {
        $this->memoryPointer -= $num;
        return $this;
    }
    
    private function inc($num=1)
    {
        $this->memoryStack[$this->memoryPointer] += $num; 
        return $this;
    }
    
    private function dec($num=1)
    {
        $this->memoryStack[$this->memoryPointer] -= $num;
        return $this;
    }
    
    private function label($label)
    {
        return $this;
    }
    
    private function jmp($label) 
    {
        return $this;
    }
}



