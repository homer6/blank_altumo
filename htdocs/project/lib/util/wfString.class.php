<?php
 
 
/**
* Functions for string manipulations.
* 
* 
*/ 
class wfString{
    
    
    /**
    * Makes an underscored string camel case
    * eg.
    *   how_are_you
    * becomes
    *   HowAreYou
    * 
    * 
    * @param string $string
    * @return string
    */
    static public function formatCamelCase( $string ) {
        
        $output = "";
        $string_parts = explode( '_', $string );
        
        foreach( $string_parts as $string_part ){
            $string_part = strtolower($string_part);
            $output .= strtoupper(substr( $string_part, 0, 1 )) . substr( $string_part, 1 ) ;
        }
        
        return $output;
        
    }    
    
    
    /**
    * Makes a camel case string underscored 
    * eg.
    *   HowAreYou
    * becomes
    *   how_are_you
    * 
    * 
    * @param string $string
    * @return string
    */
    static public function formatUnderscored( $string ) {
        
        $output = "";
        //put underscores before the capitals and lower case all characters
        $output = strtolower( preg_replace('/([A-Z])/', '_\\1', $string) );
        
        //remove the first "_", if there is one
        $output = preg_replace('/^_(.*?)$/m', '\\1', $output);
        
        return $output;
        
    }
    
    
    /**
    * Generates a string $number_of_chars long with the $character_pool as potential characters.
    * 
    * @param integer $number_of_chars
    * @param string $number_of_chars
    */
    static public function generateRandomString( $number_of_chars, $character_pool = '0123456789abcdefghijklmnopqrstuvwxyz' ){
        
        if( !is_integer($number_of_chars) || $number_of_chars < 1 ){
            throw new wfException('Number of chars must be a positive integer.');
        }
        $output = '';
        $pool_count = strlen($character_pool);
        for( $x = 0; $x < $number_of_chars; $x++ ){
            $index = rand(0,$pool_count-1);
            $output .= $character_pool[$index];
        }        
        return $output;
        
    }
    
    
    /**
    * Generates a url parameter string from the supplied array.
    * Adds the ? to the beginning.
    * Returns an empty string if $parameters is empty.
    * This method will url_encode the values, but not the keys.
    * 
    * @param array $parameters
    * @return string
    */    
    static public function generateUrlParameterString( $parameters = array() ){
        
        if( empty($parameters) ) return '';
        
        //combine and encode the parameters
            $combined_parameters = array();            
            foreach( $parameters as $key => $parameter ){
                $combined_parameters[] = $key . '=' . urlencode($parameter);
            }
        
        //build the request url
            $parameter_string = '';
            if( !empty($parameters) ){
                $parameter_string .= '?' . implode( '&', $combined_parameters );
            }
        
        return $parameter_string;
        
    }
    
    
    
    /**
    * Throws an exception if this is not a non-empty string.
    * 
    * @param string $string
    * @throws wfException if argument passed is not a string or is empty
    * @return string
    */
    static public function assertNonEmptyString( $string ){
        
        if( !is_string($string) ){
            throw new wfException('Value passed is not a string.');
        }
        if( empty($string) ){
            throw new wfException('Value must not be an empty string.');
        }
        return $string;
        
    }
    
    
    /**
    * Formats a number into a human readable string.
    * 
    * eg. 1000
    *   1kb
    * 
    * @param integer $bytes
    * @param integer $precision
    * @return string
    */
    static public function formatBytesToHuman( $bytes, $precision = 2 ){
        
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
      
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
      
        $bytes /= pow(1024, $pow);
      
        return round($bytes, $precision) . ' ' . $units[$pow]; 
        
    }
    
    
    
    /**
    * Converts a value to boolean true or false based on a loosely provided value.
    * 
    * @param mixed $value
    * @return boolean
    */
    static public function toBoolean( $value ){
        
        if( is_string($value) ){
            
            $value = strtolower($value);
            if( $value === 'false' ){
                return false;
            }elseif(  $value === 'true' ){
                return true;
            }else{
                throw new wfException('Invalid value provided.');
            }            
            
        }
        
        if( is_bool($value) ){
            return $value;
        }
        
        if( is_integer($value) ){
            if( $value === 0 ){
                return false;
            }else{
                return true;
            }
        }
        
    }
    
}
