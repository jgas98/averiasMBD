<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Comedor;
use Nette;
use Nette\Application\UI\Form;

final class ComedorFormFactory {
    
    use Nette\SmartObject;

    public function render($comedorid){
        dd($comedorid);
    }

    public function createNuevo(Comedor $comedor) {
        $form = $this->create();
        $form->setDefaults($comedor->toArray(2));
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addHidden('id');
        $form->addHidden('alumno');
        $form->addHidden('fecha');
        $form->addSelect('comentario', '', [
            '0' => 'Todavia no ha comido',
            '1' => 'No ha comido',
            '2' => 'Ha comido poco',
            '3' => 'Se ha dejado cosas',
            '4' => 'Se ha comido todo',
        ]);
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
}
