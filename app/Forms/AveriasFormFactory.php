<?php

declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Averia;

use Nette;

use Nette\Application\UI\Form;

final class AveriasFormFactory {

    use Nette\SmartObject;

    public function createNuevo(Averia $averia) {
        
        $form = $this->create();
        
        $form->setDefaults($averia->toArray(2));
        
        return $form;
    }

    public function create(): Form {

        $form = ( new FormFactory() )->create();

        $form->addHidden('id', 'Id de la averia');

        $form->addText('inicioAveria', 'Inicio de la averia')->setRequired();

        //$form->addText('finalAveria', 'Final de la averia')->setRequired();

        $form->addText('cumplimentado', 'Cumplimentado')->setRequired();

        $form->addText('aparato', 'Aparato');

        $form->addText('marca', 'Marca');

        $form->addText('modelo', 'Modelo');

        $form->addText('numeroSerie', 'Numero de serie');

        $form->addText('garantia', 'Garantia');

        $form->addSubmit('send', 'Guardar')->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }

}
