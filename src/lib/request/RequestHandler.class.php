<?php

class RequestHandler
{
  private
    $response,
    $request;

  public function __construct()
  {
    $this->response = new Response();
    $this->request  = new Request();
  }

  public function handle()
  {
    try
    {
      $this->getResponse()->setTemplate($this->getView());
      $this->execute();

      echo $this->getResponse()->render();
    }
    catch (Exception $e)
    {
      if (!Configuration::get('debug', false))
      {
        die('Wrong request');
      }

      throw $e;
    }
  }

  public function getRequest()
  {
    return $this->request;
  }

  public function getResponse()
  {
    return $this->response;
  }

  public function getActionName()
  {
    return $this->getRequest()->getParameter('action', 'homepage');
  }

  protected function getView()
  {
    $action = $this->getActionName();

    return Configuration::get('root_dir').'/view/'.$action.'.php';
  }

  protected function execute()
  {
    if ($handler = $this->getActionHandler())
    {
      return $handler->execute();
    }

    throw new LogicException('Missing controller for action.');
  }

  protected function getActionHandler()
  {
    $action = $this->getActionName();
    $class  = ucfirst($action).'ActionHandler';
    $file   = Configuration::get('lib_dir').'/action/'.$class.'.class.php';

    if (!is_readable($file))
    {
      throw new LogicException('Unable to find actions handler: '.$class);
    }

    include_once($file);

    return new $class($this);
  }

}
