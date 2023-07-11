<?php

require __DIR__ . "/assets/config.php";
require __DIR__ . "/../vendor/autoload.php";

use LeandroFerreiraMa\GoogleAuth\Auth;

/**
 * token
 */
echo "<h1>GET URL</h1>";
$url = (new Auth)->url(GOOGLE_CLIENT_ID, GOOGLE_CLIENT_REDIRECT_URL);
echo '<p>Não funciona com url local, isto é apenas um exemplo de uso</p>';
var_dump($url);
?>
<a href="<?= $url; ?>" title="Autenticar"><button>Autenticar</button></a>
<?php
echo "<h1>GET TOKEN</h1>";
if(isset($_GET['code'])){
    $data = (new Auth)->accessToken(GOOGLE_CLIENT_ID, GOOGLE_CLIENT_REDIRECT_URL, GOOGLE_CLIENT_SECRET, $_GET['code']);
    $token = $data->access_token;
    $refresh = $data->refresh_token;
    var_dump($token, $token);
}