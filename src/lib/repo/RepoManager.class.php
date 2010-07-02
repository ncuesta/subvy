<?php

class RepoManager
{
  const WORD_SEPARATOR = '_';

  static public function create(Repo $repo)
  {
    if ($repo->isNew())
    {
      return false;
    }

    $repo_name = self::generateName($repo->getName());

    if (!self::physicallyCreate($repo_name))
    {
      return false;
    }

    $url = sprintf('%s/%s', self::getBaseUrl(), $repo_name);

    return $repo_name;
  }

  static public function delete(Repo $repo)
  {
    if ($repo->isNew())
    {
      return false;
    }

    return self::physicallyDelete($repo->getEscapedName());
  }

  static protected function physicallyDelete($repo_name)
  {
    $dir = self::getBaseDir().'/'.$repo_name;

    return self::recursivelyDelete($dir);
  }

  static protected function recursivelyDelete($path)
  {
    $response = true;
    $path     = rtrim($path, '/');

    if (is_dir($path))
    {
      if (!$handler = opendir($path))
      {
        return false;
      }

      while ($response && false !== ($file = readdir($handler)))
      {
        if (in_array($file, array('.', '..')))
        {
          continue;
        }

        $response = self::recursivelyDelete($path.'/'.$file);
      }

      closedir($handler);

      if ($response)
      {
        return rmdir($path);
      }
      else
      {
        return false;
      }
    }
    else
    {
      return unlink($path);
    }
  }

  static protected function physicallyCreate($repo_name)
  {
    $dir = self::getBaseDir().'/'.$repo_name;

    if (file_exists($dir))
    {
      return false;
    }

    $return = mkdir($dir);

    if ($return)
    {
      exec('svnadmin create '.$dir, $output, $return);

      $return = (0 == $return);
    }

    return $return;
  }

  static protected function getBaseDir()
  {
    return Configuration::get('svn_base_dir');
  }

  static public function getBaseUrl()
  {
    return Configuration::get('svn_base_url');
  }

  static public function generateName($name)
  {
    $escaped_name = self::escape($name);

    if (!self::isAvailable($escaped_name))
    {
      $escaped_name = self::makeAvailable($escaped_name);
    }

    return $escaped_name;
  }

  static public function isAvailable($name)
  {
    return (!file_exists(self::getBaseDir().'/'.$name));
  }

  static public function makeAvailable($name)
  {
    return $name.'_'.time();
  }

  static public function escape($string, $separator = null)
  {
    if (null === $separator)
    {
      $separator = self::WORD_SEPARATOR;
    }

    // replace non letter or digits by underscore
    $string = trim(preg_replace('#[^\\pL\d]+#u', $separator, $string), $separator.' ');

    // transliterate
    if (function_exists('iconv'))
    {
      $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
    }

    return preg_replace('#[^'.$separator.'\w]+#', '', strtolower($string));
  }
}
