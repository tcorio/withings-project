<?php

require('../vendor/autoload.php');
require('config.php');

use GuzzleHttp\Client;

$client = new Client([
    'timeout' => 10.0
]);

$response = $client->request('POST', 'https://wbsapi.withings.net/v2/oauth2',[
    'form_params' => [
        'action' => 'requesttoken',
        'grant_type' => 'authorization_code',
        'client_id' => WITHINGS_ID,
        'client_secret' => WITHINGS_SECRET,
        'code' => $_GET['code'],
        'redirect_uri' => 'http://localhost/www/data.php'
    ]
]);

$accesToken = json_decode((string)$response->getBody())->body->access_token;

$response = $client->request('POST', 'https://wbsapi.withings.net/measure', [
    'headers' => [
        'Authorization' => 'Bearer ' . $accesToken
    ],
    'form_params' => [
        'action' => 'getmeas',
        'meastype' => 1,
        'category' => 1,
        'offset' => 10,
        'startdate' => 1612180800,
        'enddate' => 1613901600
    ]
]);

$measureGrps = json_decode((string)$response->getBody())->body->measuregrps;
echo("<table>");
echo("<thead>");
echo("<tr>");
echo('<th colspan="2">Measure value</th>');
echo('<th colspan="2">Unit</th>');
echo('</tr>');
echo('</thead>');     
echo('<tbody>');  
    
foreach($measureGrps as $value) {
    echo('<tr>');
    echo('<td>'. $value->measures[0]->value . '</td>');
    echo('<td>'. $value->measures[0]->unit . '</td>');
    echo('</tr>');
}

echo("</tbody>");
echo("</table>");

