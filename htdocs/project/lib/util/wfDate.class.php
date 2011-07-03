<?php
  

  
/**
* Useds for manipulating dates.
* 
* 
* @see http://www.symfony-project.org/plugins/sfDateTime2Plugin
* 
* 
*/
class Date extends sfDate{
    
    protected $time_zone = null;
    
    public function setTimeZone( $time_zone ){
        
        $this->time_zone = $time_zone;
        
    }
    
    public function getTimeZone(){
        
        return $this->time_zone;
        
    }
    
    
}