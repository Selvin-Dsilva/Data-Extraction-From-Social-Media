<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>twitter and Facebook Info</title>
    </head>
    <body>
        <?php

        function getTwitterInfo($user) {
            $consumer_key = '1pZbN72S0wOazEVKQN68e698N';
            $consumer_secret = '4bgSSALrjOu1ft6TrIx62KABhw8exFgR7696gTbKpjaIaGMkaE';
            $token = '797100959847632896-pVvniache8zAd6hLmBFpWgHgtOTOJbQ';
            $token_secret = 'RULJlIjYNvNzubxvunnoHMR2MnzRLGYQYQPG3zrSDVEU0';
            $url = "https://api.twitter.com/1.1/users/lookup.json";

            $oauth = array(
                'oauth_consumer_key' => $consumer_key,
                'oauth_token' => $token,
                'oauth_nonce' => time(),
                'oauth_timestamp' => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_version' => '1.0',
                'screen_name' => $user);

            $oauth = array_map("rawurlencode", $oauth);
            ksort($oauth);
            $querystring = urldecode(http_build_query($oauth, '', '&'));
            $base_string = "GET&" . rawurlencode($url) . "&" . rawurlencode($querystring);
            $key = $consumer_secret . "&" . $token_secret;
            $signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));
            $url .= "?screen_name=" . $user;
            $oauth['oauth_signature'] = $signature;
            ksort($oauth);
            $auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

            $options = array(CURLOPT_HTTPHEADER => array("Authorization: $auth"),
                CURLOPT_HEADER => false,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false);

            $feed = curl_init();
            curl_setopt_array($feed, $options);
            $json = curl_exec($feed);
            curl_close($feed);
            $twitter_data = json_decode($json, true);
            $twitterout['url'] = $twitter_data[0]['profile_image_url'];
            $twitterout['followers'] = $twitter_data[0]['followers_count'];
            return $twitterout;
        }

        function getfacebookFans($id) {
            $appid = '634750913373224';
            $appsecret = 'eab221e49a8253cc9f3bae4768fe1f11';
            $json_url = 'https://graph.facebook.com/' . $id . '?access_token=' . $appid . '|' . $appsecret . '&fields=fan_count';
            $json = file_get_contents($json_url);
            $json_output = json_decode($json);

            if ($json_output->fan_count) {
                $fan_count = $json_output->fan_count;
                return $fan_count;
            } else {
                return 0;
            }
        }

        #key=>twitter name and value=>facebook page
        $celebs = array(
            'sachin_rt' => 'sachintendulkar',
            'cristiano' => 'cristiano',
            'therock' => 'dwaynejohnson',
            'katyperry' => 'katyperry',
            'gigihadid' => 'officialgigihadid',
            'leodicaprio' => 'leonardodicaprio',
            'kimkardashian' => 'kimkardashian',
            'robertdowneyjr' => 'robertdowneyjr',
            'jessicaalba' => 'jessicaalba',
            'adamsandler' => 'sandler');
        echo '<a href=index.php class="btn btn-info">Home</a>';
        echo '<div class="container">';
        echo '<h2 align=center>Followers and Fans</h2>';
        echo '<table class="table table-bordered">';
        echo '<thead><tr>';
        echo '<th>Profile Picture</th>';
        echo '<th>Twitter Followers</th>';
        echo '<th>Facebook Fans</th>';
        echo '</tr></thead><tbody>';
        foreach ($celebs as $twitter => $facebook) {
            $twitterdata = getTwitterInfo($twitter);
            $facebookdata = getfacebookFans($facebook);
            echo '<tr>';
            echo '<td><img src="' . $twitterdata['url'] . '">   @' . $twitter . '</td>';
            echo '<td>' . $twitterdata['followers'] . '</td>';
            echo '<td>' . $facebookdata . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
        
        ?>
    </body>
</html>
