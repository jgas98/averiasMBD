<?php

namespace App\Presenters;

use App\Forms\ClasesFormFactory;
use App\Model\Orm\Centro;
use App\Model\Orm\Clase;
use Nette\Application\UI\Form;

class ClasesPresenter extends BasePresenter {

    /** @var $claseEditada Clase */
    private $claseEditada;

    /** @var $claseEditada Centro */
    private $centroEdit;


    public function renderDefault($centroId): void {

        if($this->getDbUser()){
            if ($this->getDbUser()->centro) {
                $centroId = $this->getDbUser()->centro;
            }
            $this->template->rol = $this->getDbUser()->rol;
        }
        //
        $this->template->clases = $this->orm->clases->findBy(isset($centroId) ? ['centro' => $centroId] : []);
        //
        $centro = $this->orm->centros->getById($centroId);
        $this->template->centro = $centro;
        $this->centroEdit = new Centro();
        $this->centroEdit = $centro;
        $this->template->item = $centro;
    }
}
