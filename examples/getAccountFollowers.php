<?php
require __DIR__ . '/../vendor/autoload.php';

$instagram = \InstagramScraper\Instagram::withCredentials('kirill_drozd6', 'qwe123456789', '/var/www/apps/scraper/sessions/');
//$instagram::setProxy(['address' => '185.166.216.44', 'port' => '65233', 'auth' => ['user' => 'ptdima', 'pass' => 'E1c6HyB', 'method' => CURLAUTH_BASIC]]);
$instagram->login(false, true);
sleep(2); // Delay to mimic user

$username = 'nazar.gavaga';
$followers = [];
$account = $instagram->getAccount($username);
sleep(1);

$followers = $instagram->getFollowers($account->getId(), 1000, 100, true); // Get 1000 followers of 'kevin', 100 a time with random delay between requests
echo '<pre>' . json_encode($followers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</pre>';