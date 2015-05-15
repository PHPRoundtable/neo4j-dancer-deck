<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Dancer Deck - Local
define('FACEBOOK_APP_ID', '1595165144050880');
define('FACEBOOK_APP_SECRET', '4097dfd10741796d55563fd703886bf2');
$accessToken = 'CAAWqy1PE7MABANbHxvqUadYR14LXDYhpmZBLYLgRfylqLEiBaZCaTR1GlPeKMZB1cGE9yUZB6ZArHly0UixF8Axe2BqH5NZBGG3O2mPWIx6dAAs90FmD5LXmpf7OQaNPmpisAiZBsK2EVV7DLZCjn90PyhsgH0MOhTaGGh5ZCPKedyJZBinICo25tLg8QmrxelrxovKifgeC1uUwZDZD';
$fqb = new SammyK\FacebookQueryBuilder\FQB([
	//'' => 'v2.3',
	'default_access_token' => $accessToken,
]);


$fqb = new SammyK\FacebookQueryBuilder\FQB;

$photosEdge = $fqb->edge('photos')->fields(['id', 'source'])->limit(5);
$request = $fqb->node('me')->fields(['id', 'email', $photosEdge]);

echo (string) $request;

/*
$request = $fqb->node('me')->fields(['id', 'email']);

var_dump((string) $request);
*/

/*
$edge = $fqb->edge('edge-name')->fields('field-name');
echo $fqb->node('node-id')->fields($edge);
*/

/*
$request = $fqb->node('me')
               ->fields(['id', 'email'])
               ->accessToken($accessToken)
               ->graphVersion('v2.3');
*/

/*
$photosEdge = $fqb->edge('photos')->fields(['id', 'source'])->limit(5);
$request = $fqb->node('me')->fields(['name', $photosEdge]);
*/

/*
$likesEdge = $fqb->edge('likes');
$commentsEdge = $fqb->edge('comments')->fields('message')->limit(2);
$photosEdge = $fqb->edge('photos')
                  ->fields(['id', 'source', $commentsEdge, $likesEdge])
                  ->limit(10);

$request = $fqb->node('me')->fields(['name', $photosEdge]);
*/

/*
$fb = new Facebook\Facebook([
    'app_id' => FACEBOOK_APP_ID,
    'app_secret' => FACEBOOK_APP_SECRET,
    'default_graph_version' => 'v2.3',
    ]);

$fqb = new SammyK\FacebookQueryBuilder\FQB;

$fb->setDefaultAccessToken($accessToken);

$request = $fqb->node('me')->fields(['id', 'name', 'email']);

try {
    $response = $fb->get($request->asEndpoint());
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo $e->getMessage();
    exit;
}

var_dump($response->getDecodedBody());
*/

/*
$fqb = new SammyK\FacebookQueryBuilder\FQB([
    'default_graph_version' => 'v2.3',
    'app_secret'            => FACEBOOK_APP_SECRET,
]);

$request = $fqb->node('1234')->accessToken($accessToken);
*/

/*
$fqb = new SammyK\FacebookQueryBuilder\FQB([
    'default_access_token' => 'fallback_access_token',
]);

$request = $fqb->node('me');
echo $request->asEndpoint();
# /me?access_token=fallback_access_token

$request = $fqb->node('me')->accessToken('bar_token');
echo $request->asEndpoint();
# /me?access_token=bar_token
*/

/*
$fqb = new SammyK\FacebookQueryBuilder\FQB([
    'default_graph_version' => 'v2.3',
]);

$request = $fqb->node('me');
echo $request->asEndpoint();
# /v2.3/me

$request = $fqb->node('me')->graphVersion('v1.0');
echo $request->asEndpoint();
# /v1.0/me
*/

/*
$fqb = new SammyK\FacebookQueryBuilder\FQB([
    'app_secret' => 'foo_secret',
]);

$request = $fqb->node('me')->accessToken('bar_token');
echo $request->asEndpoint();
*/

/*
$fqb = new SammyK\FacebookQueryBuilder\FQB([
    'enable_beta_mode' => true,
]);

echo (string) $fqb->node('1337');
*/

/*
$commentsEdge = $fqb->edge('comments')->modifiers(['filter' => 'stream']);
$request = $fqb->node('1044180305609983')->fields('name', $commentsEdge);
*/
/*
$request = $fqb->node('Some-Invalid-Node');

$response = file_get_contents((string) $request);

if ($response === false) {
    var_dump($http_response_header);
    exit;
}

$data = json_decode($response, true);

var_dump($data);
*/

//$response = file_get_contents((string) $request);
//dd((string) $request, $response, $http_response_header);

