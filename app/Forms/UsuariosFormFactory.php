<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Usuario;
use Nette;
use Nette\Application\UI\Form;

final class UsuariosFormFactory {

    private const PASSWORD_MIN_LENGTH = 7;
    
    use Nette\SmartObject;

    public function createNuevo() {
        $form = $this->create();
        return $form;
    }
    
    public function createEdit(Usuario $usuario) {
        $form = $this->createx();
        $form->setDefaults($usuario->toArray(2));
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();

        $form->addHidden('id', 'Id de Usuario');

        $form->addText('nombre', 'Nombre del Usuario')->setRequired();

        $form->addEmail('correo', 'Correo electronico')->setRequired();

        $form->addPassword('password', 'Contraseña')

            ->setRequired('Please create a password.')

            ->addRule($form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

        $form->addSelect('rol', 'Rol',[
            'operario' => 'Operario',
            'administrador' => 'Administrador',
            'jefeEmpresa' => 'JefeEmpresa'
        ]);
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }

}
