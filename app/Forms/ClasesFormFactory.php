<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Centro;
use App\Model\Orm\Clase;
use Nette;
use Nette\Application\UI\Form;

final class ClasesFormFactory {
    
    use Nette\SmartObject;

    public function createNuevo(Clase $clase) {
        $form = $this->create();
        $form->setDefaults($clase->toArray());
        return $form;
    }
    
    public function createEdit( Clase $clase) {
        $form = $this->createx();
        $values = $clase->toArray();
        $values['centro'] = $clase->centro->id;
        $form->setDefaults($values);
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('tutor', 'Nombre del tutor')
            ->setRequired();
        $form->addText('apellidos', 'Apellidos del tutor')
            ->setRequired();
        $form->addText('nombre', 'Nombre de la clase')
            ->setRequired();
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
    public function createx(): Form {
        $form = ( new FormFactory() )->create();
        $form->addHidden('id', 'Id de la clase');
        $form->addHidden('centro', 'Id del centro');
        $form->addText('tutornombre', 'Nombre del tutor')
            ->setRequired();
        $form->addText('tutorapellidos', 'Apellidos del tutor')
            ->setRequired();
        $form->addText('nombreclase', 'Nombre de la clase')
            ->setRequired();
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
}
