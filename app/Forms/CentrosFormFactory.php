<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Centro;
use Nette;
use Nette\Application\UI\Form;

final class CentrosFormFactory {
    
    use Nette\SmartObject;
    
    public function createEdit( Centro $centro) {
        $form = $this->create();
        $form->setDefaults($centro->toArray());
        
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre del centro')
             ->setRequired();
        $form->addText('direccion', 'Dirección del centro')
             ->setRequired();
        $form->addText('correo', 'Correo del centro')
             ->setRequired();
        $form->addUpload('imagen', 'Logo del centro')
            ->addRule(Form::IMAGE, 'El logo debe ser JPEG, PNG o GIF');
        $form->addSubmit('send', 'Guardar')
             ->setHtmlAttribute("class", 'btn btn-success');
        
        return $form;
    }

    public function createImportImagen(Centro $centro){
        $form = $this->createImagen();
        $form->setDefaults([
            'id' => $centro->id,
            'imagen' => ""
        ]);

        return $form;
    }

    public function createImagen(): Form{
        $form = ( new FormFactory())->create();
        $form->addHidden('id');
        $form->addUpload('imagen')
            ->addRule(Form::IMAGE, 'El logo debe ser JPEG, PNG o GIF');
        $form->addSubmit('send', 'Enviar')
            ->setHtmlAttribute("class", "btn btn-success");

        return $form;
    }
}
