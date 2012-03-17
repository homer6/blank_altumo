<?php

/**
 * Common parent class for all API requests
 * 
 * This is meant to be application specific; You can modify it.
 */
class ApiRequest extends \sfAltumoPlugin\Api\ApiRequest {

    /**
    * Authenticates this user and signs them in, if the API key or session is valid
    * 
    * Overridden because currently sfAltumoPlugin's version is specific to ApiUser.
    * @todo that behavior needs to be changed and updated on applications that rely on it.
    * 
    * @param sfActions $action
    * @return void
    * @throws Exception if validation fails.
    */
    public function authenticate(){

        //require SSL, if applicable
        $this->assertSslApiRequest();

        //authenticate via the API key, if provided
        $api_key = $this->getHttpRequestHeader( 'Authorization', null );


        if( !is_null($api_key) ){

            if( preg_match('/\\s*Basic\\s+(.*?)\\s*$/im', $api_key, $regs) ){
                $api_key = $regs[1];

                $user = \UserQuery::create()
                    ->filterByActive( true )
                    ->filterByApiKey( $api_key )
                ->findOne();

                if( !$user ){
                    throw new \Exception('Unknown or inactive user.');
                }

                $sf_guard_user = $user->getsfGuardUser();

                if( $sf_guard_user->getIsActive() ){
                    
                    \sfContext::getInstance()->getUser()->signIn( $sf_guard_user, false );
                    
                    return;
                    
                }else{
                    
                    throw new \Exception('Unknown or inactive user.');
                    
                }

            }else{
                throw new \Exception('API key format not recognized');
            }

        }

        //try to authenticate via the session, if the api key was not provided
        if( is_null($api_key) ){

            $sf_user = sfContext::getInstance()->getUser();
            
            if( !$sf_user || !$sf_user->isAuthenticated() ){
                
                throw new \Exception('Your session is not valid for API usage.'); 
                
            }

        }else{
            throw new \Exception('Please provide either a valid session or valid API key.'); 
        }

    }


    /**
    * Override inorder to ignore trailing slashes in requests.
    *   @see \sfWebRequest::getPathInfo()
    */
    public function getPathInfo(){
        
        $pathInfo = parent::getPathInfo();

        // remove trailing slash.
            $pathInfo = preg_replace( '/\/$/', '', $pathInfo );

        return $pathInfo;
        
    }

}