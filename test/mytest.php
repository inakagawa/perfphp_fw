<?php

require_once('../application/core/Request.php');

$req = new Request();


$params = array();
$params['requesturi'] = $req->getRequestUri();
$params['baseurl'] = $req->getBaseUrl();
$params['pathinfo'] = $req->getPathInfo();

?>
<pre>
<?php
var_dump($params);
?>
</pre>
