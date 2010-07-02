<?php

class Request
{
  protected $_parameters = array();

  public function __construct()
  {
    $this->_parameters = array(
      'get'  => $_GET,
      'post' => $_POST
    );
  }

  public function getParameters()
  {
    return $this->_parameters;
  }

  public function setParameters($parameters)
  {
    $this->_parameters = $parameters;
  }

  public function setParameter($parameter, $value, $method = 'get')
  {
    if (!in_array($method, array('get', 'post')))
    {
      return false;
    }

    return $this->_parameter[$method][$parameter] = $value;
  }

  public function getParameter($parameter, $default = null, $method = null)
  {
    if (null !== $method && in_array($method, array('get', 'post')))
    {
      $method = array($method);
    }
    else
    {
      $method = array('get', 'post');
    }

    foreach ($method as $m)
    {
      if (isset($this->_parameters[$m][$parameter]))
      {
        return $this->_parameters[$m][$parameter];
      }
    }

    return $default;
  }

}
