<?php
require_once __DIR__ . '/../autoload.php';

use \Qiniu\Auth;

$accessKey = getenv('QINIU_ACCESS_KEY');
$secretKey = getenv('QINIU_SECRET_KEY');
$bucket = getenv('QINIU_TEST_BUCKET');


$auth = new Auth($accessKey, $secretKey);
$config = new \Qiniu\Config();
$bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);

//每次最多不能超过1000个
$keys = array(
    'qiniu.mp4',
    'qiniu.png',
    'qiniu.jpg'
);

$ops = $bucketManager->buildBatchStat($bucket, $keys);
list($ret, $err) = $bucketManager->batch($ops);
if ($err) {
    print_r($err);
} else {
    print_r($ret);
}
