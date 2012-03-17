<?php

class apiConfiguration extends sfApplicationConfiguration {
    
    public function configure(){
        
        // set the session_name that the api will look for.
            sfConfig::set( 'altumo_api_session_cookie_name',  'altumoApi' );
        
    }

}
