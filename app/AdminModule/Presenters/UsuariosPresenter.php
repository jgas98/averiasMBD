<?php

namespace App\AdminModule\Presenters;

use App\Forms\AlumnosFormFactory;

use App\Forms\UsuariosFormFactory;

use App\Model\DuplicateNameException;

use App\Model\Orm\Alumno;

use App\Model\Orm\Usuario;

use Nette\Application\UI\Form;

use Nette\Security\Passwords;

use Nette;

class UsuariosPresenter extends BaseAdminPresenter {

    public function __construct(Passwords $passwords ) {$this->passwords = $passwords;}

    /** @var Usuario */
    private $usuarioEditado;

    /** @var Model\Authentication */
    private $authentication;

    /** @var Passwords */
    private $passwords;

    public function renderDefault ($claseID): void {
        
        $this->template->usuarios = $this->orm->usuarios->findAll();
        
        $this->template->rol = $this->getDbUser()->rol;
    }

// ______________________________________________________________ EDITAR  ________________________________________

    public function actionEditar( $idUsuario ) {
        
        $this->usuarioEditado = $this->orm->usuarios->getById($idUsuario);
        
        $this->template->usuario = $this->usuarioEditado;
    
    }
    
    public function createComponentEditarUsuarioForm() {

        $form = ( new UsuariosFormFactory() )->createEdit($this->usuarioEditado);
        
        $form->onSuccess[] = [ $this, 'onSuccessEditarUsuario' ];

        return $form;
    }
    
    public function onSuccessEditarUsuario (Form $form, \stdClass $values ): void {
        
        Nette\Utils\Validators::assert($values->correo, 'email');
        
        try {
            
            $usuario = $this->orm->usuarios->getById($values->id);
            
            $usuario->nombre = $values->nombre;
            
            $usuario->correo = $values->correo;
            
            if ($values->password) {$usuario->password = $values->password;}
            
            $usuario->password = $this->passwords->hash($usuario->password);
            
            $usuario->rol = $values->rol;

            $usuario->telefono = $values->telefono;

            
            /*$alumno = $this->orm->alumnos->getById($values->alumno);
            
            $centro = $this->orm->centros->getById($values->centro);
            
            if ($alumno){
                $usuario->alumno = $alumno;
                $centro->usuarios->add($usuario);
            }

            if ($centro){
                $centro->usuarios->add($usuario);
            }*/



            $this->orm->persistAndFlush($usuario);

            
            $this->flashMessage('Usuario añadido correctamente', 'success');
        
        } catch( Model\DuplicateNameException $e ) {
            
            $form['email']->addError('Este correo ya existe, por favor elige otro o recupera tu contraseña.');
            
            return;
        
        }
        
        $this->redirect('this');
    }

// ______________________________________________________________ AÑADIR ________________________________________

    public function actionAdd() {
        
        $rol = $this->getDbUser()->rol;
        
        if( $rol == 'admin') {} 
        
        else {$this->redirect('default');}
    
    }

    public function createComponentMasUsuariosForm(){
        
        $usuario = new Usuario();
        
        $form = ( new UsuariosFormFactory() )->createNuevo();
        
        $form->onSuccess[] = [ $this, 'onSuccessMasUsuarios' ];

        return $form;
    }

    public function onSuccessMasUsuarios(Form $form, \stdClass $values ): void {

        Nette\Utils\Validators::assert($values->correo, 'email');
        
        try {
        
            if ($this->orm->usuarios->getBy(['correo' => $values->correo])) {throw new DuplicateNameException;}
            
            $usuario = new Usuario();
            
            $usuario->nombre = $values->nombre;
            
            $usuario->correo = $values->correo;
            
            $usuario->password = $values->password;
            
            $usuario->password = $this->passwords->hash($usuario->password);
            
            $usuario->rol = $values->rol;

            $usuario->telefono = $values->telefono;

            
            /*$alumno = $this->orm->alumnos->getById($values->alumno);
            $centro = $this->orm->centros->getById($values->centro);
            if ($alumno){
                $usuario->alumno = $alumno;
                $centro->usuarios->add($usuario);
            }

            if ($centro){
                $centro->usuarios->add($usuario);
            }*/



            $this->orm->persistAndFlush($usuario);

            $this->flashMessage('Usuario añadido correctamente', 'success');
        
        } catch( Model\DuplicateNameException $e ) {
            
            $form['email']->addError('Este correo ya existe, por favor elige otro o recupera tu contraseña.');
            
            return;
        }
        
        $this->redirect('this');
    
    }

// ______________________________________________________________ BORRAR  ________________________________________

    public function actionBorrarUsuario ($id) {
        
        try {
        
            if( !$usuario = $this->orm->usuarios->getById($id)) {
        
                $this->flashMessage("La clase no existe", "danger");
            };
            
            if ($usuario->rol == 'admin') {
                
                $this->flashMessage("Error al eliminar, contacte con el administrador", 'danger');
                
                $this->redirect('Usuarios:default');
            
            } else {
                
                $this->orm->usuarios->removeAndFlush($usuario);
                
                $this->flashMessage("Usuario eliminado", "success");
            
            }
        
        } catch( \Exception $e ) {$this->flashMessage("Error al eliminar, contacte con el administrador",'danger');}
        
        $this->redirect('Usuarios:default');
    
    }


// ______________________________________________________________ CUENTA DEL ALUMNO ________________________________________

    
    public function actionPerfilUsuario() {$this->usuarioEditado = $this->getDbUser()->usuario;}
    
    public function createComponentEditarPerfilUsuarioForm() {
        
        $form = ( new AlumnosFormFactory() )->createMiEdit($this->usuarioEditado);
        
        $form->onSuccess[] = [ $this, 'onSuccessEditarPerfilUsuario' ];

        return $form;
    }
    
    public function onSuccessEditarPerfilUsuario (Form $form, \stdClass $values ): void {
        
        $usuariox = new Alumno();
        
        try {
            
            $id = $values->id;
            
            $usuariox = $this->orm->alumnos->getById($id);

            $usuariox->nombre = $values->nombrea;
            
            $usuariox->correo = $values->correo;
            
            $usuariox->rol = $values->rol;
            
            $usuariox->telefono = $values->telefono;
                        
            $this->orm->persistAndFlush($usuariox);
           
            $this->flashMessage('Usuario editado correctamente', 'success');
        
        
        } catch( \Exception $e ) {$this->flashMessage("Error: " . $e->getMessage(), 'danger');}
        
        $this->redirect('this');
    }

}
