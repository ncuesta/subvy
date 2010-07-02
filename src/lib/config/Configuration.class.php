<?php

class Configuration
{
  static private $cfg = array();

  static public function get($name, $default = null)
  {
    return isset(self::$cfg[$name]) ? self::$cfg[$name] : $default;
  }

  static public function set($name, $value)
  {
    return self::$cfg[$name] = $value;
  }

  static public function setMany(array $values)
  {
    foreach ($values as $name => $value)
    {
      self::set($name, $value);
    }

    return $values;
  }

}
