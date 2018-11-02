<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirmwareController extends Controller
{
  /**
   * Return the current firmware version
   *
   * @param  string  mac
   * @return \Illuminate\Http\Response
   */
  public function ver($mac)
  {
    return firmwareVersion();
  }

  /**
   * Return the current version firmware binary
   *
   * @param  string  mac
   * @return \Illuminate\Http\Response
   */
  public function bin($mac)
  {
    if(!check_header('HTTP_USER_AGENT', 'ESP8266-http-Update')) {
      header($_SERVER["SERVER_PROTOCOL"].' 403 Forbidden', true, 403);
      return "Forbidden\n";
    }

    $fwImagePath = '../storage/firmware/dormio_wearable_' . firmwareVersion() . '.bin';
    $fwImage = file_get_contents($fwImagePath);

    header($_SERVER["SERVER_PROTOCOL"].' 200 OK', true, 200);
    header('Content-Type: application/octet-stream', true);
    header('Content-Disposition: attachment; filename='.basename($fwImagePath));
    header('Content-Length: '.filesize($fwImagePath), true);
    header('x-MD5: '.md5_file($fwImagePath), true);

    return $fwImage;
  }
}

function firmwareVersion() {
  return 1001;
}

function check_header($name, $value = false) {
    if(!isset($_SERVER[$name])) {
        return false;
    }
    if($value && $_SERVER[$name] != $value) {
        return false;
    }
    return true;
}
