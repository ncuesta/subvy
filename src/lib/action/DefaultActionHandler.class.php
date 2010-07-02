<?php

class DefaultActionHandler extends ActionHandler
{
  public function execute()
  {
    $this->getResponse()->setParameter('response', 'testing');
  }

}
