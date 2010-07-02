<?php

class CheckActionHandler extends ActionHandler
{
  public function execute()
  {
    if ('' === $name = trim($this->getRequest()->getParameter('n', '')))
    {
      $this->getResponse()->setParameter('image', 'images/error.png');
      $this->getResponse()->setParameter('status', 'Error');
      $this->getResponse()->setParameter('message', 'The name of the repo is required');
    }

    $escaped_name = RepoManager::escape($name);

    if (RepoManager::isAvailable($name))
    {
      $this->getResponse()->setParameter('name', $escaped_name);
      $this->getResponse()->setParameter('image', 'images/tick.png');
      $this->getResponse()->setParameter('status', 'Success');
      $this->getResponse()->setParameter('message', 'The name of the repo is available');
    }
    else
    {
      $this->getResponse()->setParameter('image', 'images/error.png');
      $this->getResponse()->setParameter('status', 'Error');
      $this->getResponse()->setParameter('message', 'The name of the repo is already in use');
    }
  }

}
