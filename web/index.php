<?php

require_once(dirname(__FILE__).'/../config/config.php');

if (!defined('SUBVY_CONFIGURED'))
{
  die('Unable to configure properly this instance of Subvy. Please check your configuration files.');
}

if ($debug)
{
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
}

$handler = new RequestHandler();
$handler->handle();
