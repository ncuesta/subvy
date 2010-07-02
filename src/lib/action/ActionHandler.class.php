<?php

abstract class ActionHandler
{
  protected $request_handler;

  public function __construct(RequestHandler $request_handler)
  {
    $this->request_handler = $request_handler;
  }

  public function getRequestHandler()
  {
    return $this->request_handler;
  }

  public function getRequest()
  {
    return $this->getRequestHandler()->getRequest();
  }

  public function getResponse()
  {
    return $this->getRequestHandler()->getResponse();
  }

  abstract public function execute();
}
