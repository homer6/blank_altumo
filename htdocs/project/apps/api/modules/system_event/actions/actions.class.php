<?php

/**
* system_event actions.
*
* @author Steve Sperandeo <steve.sperandeo@altumo.com>
*/
class system_eventActions extends sfActions{
    
    /**
    * This method represents all four API methods (GET, POST, PUT and DELETE) 
    * for SystemEvents.
    *
    * @param \sfAltumoPlugin\Api\ApiRequest $request
    */
    public function executeIndex( \sfAltumoPlugin\Api\ApiRequest $request ){
    
        try{
        
            $response = $this->getResponse();
            //for code completion
                if( 0 ) $response = new \sfAltumoPlugin\Api\ApiResponse();
            
            try{
                //$request->authenticate();
            }catch( wfException $e ){
                $response->setStatusCode( '401' );
                throw $e;
            }
            
            //Common (to all API methods) function that is responsible for returning
            //a custom, yet consistent result. For security, only fields that are 
            //explicitly added to $result will be returned.
            $modify_result = function( &$system_event, &$result ){
                
                $result['id'] = $system_event->getId();
                
            };
            
            //the common query that will be used in all four methods
            $query = SystemEventQuery::create();


            //The fields in the field maps represent the writable fields in the 
            //model (and whether they're required).
            //Make sure each of these fields have rhobust model validation that 
            //throws exceptions and has appropriate user error messages in the 
            //exception message.
            $system_event_field_maps = array(
                new ApiFieldMap( 'name', false ),
                new ApiFieldMap( 'slug', false )
            );
        

            switch( $request->getMethod() ){

                case sfWebRequest::GET:

                        $response->setStatusCode( '200' );

                        $api_get_query = new \sfAltumoPlugin\Api\ApiGetQuery( $request, $response, $query, 'system_events', $modify_result );

                        //extract the primary keys from the request and add them to the query, if they exist and are valid
                        try{
                            $ids = \Altumo\Validation\Arrays::sanitizeCsvArrayPostitiveInteger( $request->getParameter('ids', '') );
                            if( !empty( $ids ) ){
                                $query->filterById($ids);
                            }
                        }catch( Exception $e ){}
                                                
                        $api_get_query->runQuery();

                    break;
                
                case sfWebRequest::POST:
                
                        //not supported
                        $response->setStatusCode( '405' );
                        
                    break;
                    
                case sfWebRequest::PUT:
                
                        //not supported
                        $response->setStatusCode( '405' );

                    break;

                case sfWebRequest::DELETE:

                        //not supported
                        $response->setStatusCode( '405' );

                    break;
                    
                default:
                        //not supported
                        $response->setStatusCode( '405' );

            }
            
        }catch( Exception $e ){
            
            $response->addException( $e );
            
        }
        
        return $response->respond();        
        
    }
    
}
