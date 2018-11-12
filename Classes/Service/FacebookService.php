<?php

namespace SaschaEnde\Facebooklogin\Service;

class FacebookService {

    protected $clientid;
    protected $clientsecret;
    protected $redirecturi;
    protected $accessToken;

    /**
     * @param mixed $clientid
     */
    public function setClientid($clientid)
    {
        $this->clientid = $clientid;
    }

    /**
     * @param mixed $clientsecret
     */
    public function setClientsecret($clientsecret)
    {
        $this->clientsecret = $clientsecret;
    }

    /**
     * @param mixed $redirecturi
     */
    public function setRedirecturi($redirecturi)
    {
        $this->redirecturi = $redirecturi;
    }

    public function getAuthUri(){
        return 'https://www.facebook.com/v3.2/dialog/oauth?client_id='.$this->clientid.'&redirect_uri='.urlencode($this->redirecturi).'&scope=email&state='.time();
    }

    public function auth($code){
        $url = 'https://graph.facebook.com/v3.2/oauth/access_token?client_id='.$this->clientid.'&client_secret='.$this->clientsecret.'&redirect_uri='.urlencode($this->redirecturi).'&code='.$code;
        $data = json_decode(file_get_contents($url));
        $this->accessToken = $data->access_token;
    }

    public function getUserdata(){
        // get user data
        $url = 'https://graph.facebook.com/v3.2/me?fields=id,name,email,first_name,last_name&access_token='.$this->accessToken;
        return json_decode(file_get_contents($url));
    }

}