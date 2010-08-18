<?php

class Repo
{
  private $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function isNew()
  {
    return RepoManager::isAvailable($this->getName());
  }

  public function getName()
  {
    return $this->name;
  }

  public function create()
  {
    return RepoManager::create($this);
  }

}
