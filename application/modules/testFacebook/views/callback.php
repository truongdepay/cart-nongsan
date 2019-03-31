<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 2/22/2019
 * Time: 11:21 PM
 */
// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());
//
//// The OAuth 2.0 client handler helps us manage access tokens
//$oAuth2Client = $fb->getOAuth2Client();
//
//// Get the access token metadata from /debug_token
//$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);
//
//// Validation (these will throw FacebookSDKException's when they fail)
//$tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
//// If you know the user ID this access token belongs to, you can validate it here
////$tokenMetadata->validateUserId('123');
//$tokenMetadata->validateExpiration();
//
//if (! $accessToken->isLongLived()) {
//    // Exchanges a short-lived access token for a long-lived one
//    try {
//        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
//    } catch (Facebook\Exceptions\FacebookSDKException $e) {
//        echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
//        exit;
//    }
//
//    echo '<h3>Long-lived</h3>';
//    var_dump($accessToken->getValue());
//}
