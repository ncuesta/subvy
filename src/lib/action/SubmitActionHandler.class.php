<?php

class SubmitActionHandler extends ActionHandler
{
  public function execute()
  {
    if ('' === $name = trim($this->getRequest()->getParameter('name', '')))
    {
      die('Bad request');
    }

    $this->getResponse()->setParameter('title', 'Subvy');
    $this->getResponse()->setParameter('subversion_root_url', Configuration::get('svn_root_url'));

    $escaped_name = RepoManager::escape($name);
    $repo         = new Repo($escaped_name);

    if ($created_repo_name = $repo->create())
    {
      $this->getResponse()->setParameter('name', $escaped_name);
      $this->getResponse()->setParameter('image', 'images/tick.png');
      $this->getResponse()->setParameter('status', 'Exito');
      $this->getResponse()->setParameter('message', 'El repositorio '.$created_repo_name.' fue creado.');
    }
    else
    {
      $this->getResponse()->setParameter('name', $escaped_name);
      $this->getResponse()->setParameter('image', 'images/error.png');
      $this->getResponse()->setParameter('status', 'No disponible');
      $this->getResponse()->setParameter('message', 'El repositorio '.$created_repo_name.' ya existe.');
    }
  }

}
