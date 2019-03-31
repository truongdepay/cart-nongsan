<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 2/22/2019
 * Time: 10:08 PM
 */

use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;

class FacebookSdk extends Facebook
{
    protected $_CI;

    protected $helper;

    protected $fbException;

    public function __construct()
    {
        $this->_CI = & get_instance();
        $this->_CI->load->helper([
            'url'
        ]);
        $this->_CI->load->library([
            'monolog',
            'session'
        ]);
        $config = [
            'app_id' => '289706458294984',
            'app_secret' => 'e22eab6d2e2723e4a6451bcc528ba3f8',
            'default_graph_version' => 'v2.10',
        ];
        parent::__construct($config);
        $this->helper = $this->getRedirectLoginHelper();
        $this->fbException = new FacebookSDKException;
    }

    public function getToken()
    {
        $permissions = ['email']; // Optional permissions
        $loginUrl = $this->helper->getLoginUrl('https://vegitozenn.cf/testFacebook/index/callback', $permissions);
        return $loginUrl;
    }

    public function callback()
    {
        //$this->_CI->monolog->creatMonolog($accessToken, 'facebook/facbook');
        try {
            $accessToken = $this->helper->getAccessToken();

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($this->helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $this->helper->getError() . "\n";
                echo "Error Code: " . $this->helper->getErrorCode() . "\n";
                echo "Error Reason: " . $this->helper->getErrorReason() . "\n";
                echo "Error Description: " . $this->helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        return $accessToken;
    }
}