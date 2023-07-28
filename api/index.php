<?php
header('Access-Control-Allow-Origin: *');
header(
  'Access-Control-Allow-Methods: POST, PATCH, PUT, DELETE, OPTIONS'
);
header('Content-Type: application/json; charset=utf8');
header(
  'Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, X-Auth-Token, Origin, Application'
);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

date_default_timezone_set('Asia/Manila');

$apiPath = $_SERVER['DOCUMENT_ROOT'] . '/remindapi/api';
require_once $apiPath . '/config/Connection.php';
require_once $apiPath . '/controllers/Path.controller.php';

$db = new Connection();
$pdo = $db->connect();
$gm = new GlobalMethods($pdo);
$delivery = new Task($pdo, $gm);

$req = [];

if (isset($_REQUEST['request'])) {
  $req = explode('/', $_REQUEST['request']);
} else {
  $req = ['errorcatcher'];
}

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    print_r('Bad Request');
    http_response_code(403);
    break;

  case 'POST':
    $d = json_decode(file_get_contents('php://input'));
    require_once $apiPath . '/routes/Task.route.php';
    break;

  default:
    print_r('Forbidden Access');
    http_response_code(403);
    break;
}

?>
