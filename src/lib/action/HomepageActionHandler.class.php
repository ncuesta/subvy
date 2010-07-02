<?php

class HomepageActionHandler extends ActionHandler
{
  public function execute()
  {
    $this->getResponse()->setParameter('title', 'Subvy');
    $this->getResponse()->setParameter('subversion_root_url', Configuration::get('svn_root_url'));
  }

}
