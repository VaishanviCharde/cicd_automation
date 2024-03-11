<?php

$subDomain = "test";
$cPanelUser = 'www@tissatech.in';
$cPanelPass = 'Logitech@123';
$rootDomain = 'tissatech.in';


//  $buildRequest = "/frontend/x3/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain;


//$buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=public_html/code/" . $subDomain;
$buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=public_html/code/";

$openSocket = fsockopen('localhost', 2082);
if (!$openSocket) {
    return "Socket error";
    exit();
}

$authString = $cPanelUser . ":" . $cPanelPass;
$authPass = base64_encode($authString);
$buildHeaders = "GET " . $buildRequest . "\r\n";
$buildHeaders .= "HTTP/1.0\r\n";
$buildHeaders .= "Host:localhost\r\n";
$buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
$buildHeaders .= "\r\n";

fputs($openSocket, $buildHeaders);
while (!feof($openSocket)) {
    fgets($openSocket, 128);
}
fclose($openSocket);

$newDomain = "http://" . $subDomain . "." . $rootDomain . "/";
echo $newDomain;