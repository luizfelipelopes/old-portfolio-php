<?php
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
//var_dump($_SERVER['HTTP_ORIGIN']);
//var_dump($_SERVER['HTTP_REFERER']);
//die;

require '../../../_app/Config.inc.php';
require '../../../_app/Helpers/Check.class.php';
require '../../../_app/Helpers/Upload.class.php';
$accepted_origins = array("http://localhost", "https://localhost", HOME);

$imageFolder = '';
if (strpos($_SERVER['HTTP_REFERER'], 'posts') !== false):
    $imageFolder = '../../uploads';
else:
    $imageFolder = '../../uploads';
endif;

reset($_FILES);
$temp = current($_FILES);

if (is_uploaded_file($temp['tmp_name'])) {

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Same-origin requests won't set an origin. If the origin is set, it must be valid.
        if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        } else {
            header("HTTP/1.1 403 Origin Denied");
            return;
        }
    }

    $upload = new Upload('../../../uploads');
    $upload->Image($temp, null, 300000, '/posts/content');
    $temp['name'] = $upload->getResult();

    $fileName = $imageFolder . $temp['name'];

    echo json_encode(array('location' => $fileName));
} else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
}
?>