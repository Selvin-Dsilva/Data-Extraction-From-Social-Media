<?php

function post_get_HTTP($method, $url, $header, $data, $json) {
    if ($method == 1) {
        $method_type = 1;
    } else {
        $method_type = 0;
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    if ($header !== 0) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    curl_setopt($curl, CURLOPT_POST, $method_type);

    if ($data !== 0) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    $response = curl_exec($curl);

    if ($json == 0) {
        $json = $response;
    } else {
        $json = json_decode($response, true);
    }

    curl_close($curl);

    return $json;
}

?>