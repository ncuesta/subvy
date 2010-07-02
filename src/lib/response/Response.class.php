<?php

class Response
{
  protected
    $template_file,
    $parameters = array();

  public function __construct()
  {
  }

  public function setParameter($name, $value)
  {
    $this->parameters[$name] = $value;
  }

  public function getParameter($name, $default = null)
  {
    return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
  }

  public function setTemplate($filename)
  {
    if (is_readable($filename))
    {
      $this->template_file = $filename;
    }
  }

  public function getTemplate()
  {
    return $this->template_file;
  }

  public function render()
  {
    return $this->readTemplate();
  }

  protected function readTemplate()
  {
    $template = file_get_contents($this->getTemplate());

    $tpl = preg_replace('/{\s*\$([\w_\d]+)\s*\}/', "\$this->getParameter('\\1');", $template);

    return $tpl;
  }

}
