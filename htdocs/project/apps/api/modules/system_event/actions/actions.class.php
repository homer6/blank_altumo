<?php

/**
 * SystemEvent and SystemEventSUbscription actions.
 *
 * @package    reseller_platform
 * @subpackage system_event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class system_eventActions extends ApiActions{

	
    /**
    * API Action for api users to list events
    * 
    * @param ApiRequest $request
    * 
    * @return void
    */
    public function executeSystemEvent( \sfAltumoPlugin\Api\ApiRequest $request ){

        try{
            
        	/* @var $response \sfAltumoPlugin\Api\ApiResponse */
            $response = $this->getResponse();

            // authenticate and return user
        	$user = $this->assertAndRetrieveAuthenticatedUser( $request );

            //prepare the query            
			$query = SystemEventQuery::create();

			$query->addAscendingOrderByColumn( SystemEventPeer::UNIQUE_KEY );

			// if ids set, filter for those
			$ids_filter_value = $request->getParameter( 'ids' );
			if ( ! empty( $ids_filter_value ) ) {
				$query->filterByPrimaryKey(
					\Altumo\Validation\Arrays::sanitizeCsvArrayPostitiveInteger( $ids_filter_value )
				);
			}

            //make sure each of these fields have rhobust model validation that throws exceptions
			$field_mappings = array(
				//new \sfAltumoPlugin\Api\ApiFieldMap( 'order_status_id' )
			);
                
            //do the before_save checks
			$before_save = function( &$model, &$request_object, &$response, $remote_id, $update ){
			};

            switch( $request->getMethod() ){

                case sfWebRequest::GET:
                    $response->setStatusCode( '200' );
                        
                        $api_get_query = new \sfAltumoPlugin\Api\ApiGetQuery( $request, $response, $query, 'system_events', $this->getSystemEventResultModifier() );                        
                        $api_get_query->runQuery();

                    break;

                    
                default:            
                        //action not supported
                        $response->setStatusCode( '405' );
                }
             
        }catch( Exception $e ){
            
            $response->addException( $e );
            
        }
        
        return $response->respond();
    }
    
    
    /**
    * API Action for api users to crud event subscriptions
    * 
    * @param ApiRequest $request
    * 
    * @return void
    */
    public function executeSystemEventSubscription( \sfAltumoPlugin\Api\ApiRequest $request ){

        try{
            
        	/* @var $response \sfAltumoPlugin\Api\ApiResponse() */
            $response = $this->getResponse();

            $user = $this->assertAndRetrieveAuthenticatedUser( $request );
            
            //prepare the query            
            $query = SystemEventSubscriptionQuery::create()
            	->joinSystemEvent();

            // if ids set, filter for those
            $ids_filter_value = $request->getParameter( 'ids' );
            if ( ! empty( $ids_filter_value ) ) {
            	$query->filterById(
            		\Altumo\Validation\Arrays::sanitizeCsvArrayPostitiveInteger( $ids_filter_value )
            	);
            }
                
            //do before_save checks
			$before_save = function( &$model, &$request_object, &$response, $remote_id, $update ){
				if( !$model->getUser() ){
					$current_user = sfContext::getInstance()->getUser()->getUser();
					$model->setUser( $current_user );
				}
			};
			
			$plural = 'system_event_subscriptions';

            switch( $request->getMethod() ){

                    case sfWebRequest::GET: // select

                    	$response->setStatusCode( '200' );
                            
						$api_get_query = new \sfAltumoPlugin\Api\ApiGetQuery( $request, $response, $query, $plural, $this->getSystemEventSubscriptionResultModifier() );
						$api_get_query->runQuery();

                        break;
                        
                    case sfWebRequest::POST: // insert            
						
                    	$response->setStatusCode( '200' );
                            
						$api_write_operation = new \sfAltumoPlugin\Api\ApiWriteOperation( $request, $response, $plural );
						$api_write_operation->setFieldMaps( $this->getSystemEventSubscriptionFieldMappings() );
						$api_write_operation->setUpdate( false );
						$api_write_operation->setQuery( $query );
						$api_write_operation->setModifyResult( $this->getSystemEventSubscriptionResultModifier() );
						$api_write_operation->setBeforeSave( $before_save );
                            
						$api_write_operation->run();
                            
                        break;

                    case sfWebRequest::PUT: // update
                    
						$response->setStatusCode( '200' );
                            
						$api_write_operation = new \sfAltumoPlugin\Api\ApiWriteOperation( $request, $response, $plural );
						$api_write_operation->setFieldMaps($this->getSystemEventSubscriptionFieldMappings());
						$api_write_operation->setUpdate( true );
						$api_write_operation->setQuery($query);
						$api_write_operation->setBeforeSave( $before_save );
						$api_write_operation->setModifyResult( $this->getSystemEventSubscriptionResultModifier() );
                            
						$api_write_operation->run();

                        break;
                        
                    case sfWebRequest::DELETE: // delete
                    	
						$response->setStatusCode( '200' );
                            
						$api_delete_operation = new \sfAltumoPlugin\Api\ApiDeleteOperation( $request, $response, $query );
						$api_delete_operation->run();

						break;
                        
					default: // action not supported

						$response->setStatusCode( '405' );

						break;
                }
             
        }catch( Exception $e ){
            
            $response->addException( $e );
            
        }
        
        return $response->respond();
        

    }
    
    
    /**
    * @return function
    */
    protected function getSystemEventSubscriptionResultModifier()
    {
    	return function( &$system_event_subscription, &$result ){
    		$result['id'] = $system_event_subscription->getId();
    		$result['system_event'] = $system_event_subscription->getSystemEvent()->getUniqueKey();
    		$result['remote_url'] = $system_event_subscription->getRemoteUrl();
    		$result['authorization_token'] = $system_event_subscription->getAuthorizationToken();
    		$result['enabled'] = $system_event_subscription->getEnabled();
    		$result['created_at'] = $system_event_subscription->getCreatedAt();
    		$result['updated_at'] = $system_event_subscription->getUpdatedAt();
    	};
    }
    
    
    /**
    * @return function
    */
    protected function getSystemEventResultModifier()
    {
    	return function( &$system_event, &$result ){
    
    		$result['id'] = $system_event->getId();
    		$result['name'] = $system_event->getName();
    		$result['unique_key'] = $system_event->getUniqueKey();
    		//$result['slug'] = $system_event->getSlug();
    		$result['enabled'] = $system_event->getEnabled();
    	};
    }
    
    
    /**
    * @return \sfAltumoPlugin\Api\ApiFieldMap[]
    */
    protected function getSystemEventSubscriptionFieldMappings()
    {
    	return array(
    	new \sfAltumoPlugin\Api\ApiFieldMap( 'system_event', \sfAltumoPlugin\Api\ApiFieldMap::FLAG_REQUIRED, null, 'SystemEventUniqueKey' ),
    	new \sfAltumoPlugin\Api\ApiFieldMap( 'remote_url', \sfAltumoPlugin\Api\ApiFieldMap::FLAG_REQUIRED, 'Remote URL' ),
    	new \sfAltumoPlugin\Api\ApiFieldMap( 'authorization_token', \sfAltumoPlugin\Api\ApiFieldMap::FLAG_REQUIRED, 'Remote Authorization Token' ),
    	new \sfAltumoPlugin\Api\ApiFieldMap( 'enabled' )
    	);
    }
    
}
