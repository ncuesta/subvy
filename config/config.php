<?php

  /**
   * Subvy configuration file.
   *
   * Change configuration values in here.
   *
   * @package    subvy
   * @subpackage config
   * @author     José Nahuel Cuesta Luengo <ncuesta@cespi.unlp.edu.ar>
   */
  $subversion_root_dir = '/var/svn_admin_root';
  $subversion_root_url = 'http://testing.cespi.unlp.edu.ar/svn';

  $root_dir = dirname(__FILE__).'/..';
  $lib_dir  = $root_dir.'/src/lib';

  $debug = true;

  require_once($lib_dir.'/autoload/autoload.php');

  Configuration::setMany(array(
    'svn_base_dir' => $subversion_root_dir,
    'svn_root_url' => $subversion_root_url,
    'root_dir'     => $root_dir,
    'lib_dir'      => $lib_dir,
    'debug'        => $debug
  ));

  define('SUBVY_CONFIGURED', true);
