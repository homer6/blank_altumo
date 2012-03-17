<?php

/**
 * Common parent class for all API controllers
 * 
 * This is meant to be application specific; You can modify it.
 */
class ApiActions extends sfActions {
		
	/**
	 * Asserts user is authenticated
	 * 
	 * @param \sfAltumoPlugin\Api\ApiRequest $request
	 * 
	 * @throws wfException	// if user is not authenticated
	 * 
	 * @return ApiActions
	 */
	protected function assertRequestAuthenticated( $request ){
		
        try{
            
			$request->authenticate();
            
		}catch( Exception $e ){
            
			$this->getResponse()->setStatusCode( '401' );
			throw $e;
            
		}
		
		return $this;

	}
	
}