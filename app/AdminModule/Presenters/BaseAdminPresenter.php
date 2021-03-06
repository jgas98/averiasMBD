<?php

namespace App\AdminModule\Presenters;


use App\Model\Roles;

use App\Model\Menu;

class BaseAdminPresenter extends \App\Presenters\BasePresenter {

    protected $redirectLogin = true;

    protected function startup()
    {
        $this->getUser()->setAuthorizator(new \App\Model\Roles());
        if( !$this->user->isLoggedIn() && !in_array($this->presenter->getName(), [ 'Sign' ]) ) {
            $this->flashMessage('Debes iniciar sesión primero');
            $this->redirect(':Sign:in');
        }
        parent::startup(); // TODO: Change the autogenerated stub

        $this->template->menu = Menu::getMenu($this->getUser());
    }
}
