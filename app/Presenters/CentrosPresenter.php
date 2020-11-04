<?php

namespace App\Presenters;

use App\Forms\FormFactory;
use App\Forms\CentrosFormFactory;
use App\Model\Orm\Centro;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class CentrosPresenter extends BasePresenter {

    /** @var $centroEditado Centro */
    private $centroEditado;


    public function renderDefault(): void {
        $this->template->centros = $this->orm->centros->findAll();
    }
//    -
//    EDITAR CENTRO
//    -
    public function actionEditar( $id ) {
        $centro = $this->orm->centros->getById($id);
        $this->centroEditado = $centro;
        //
        $this->template->item = $centro;
        $this->template->clases = $centro->clases;
    }

    public function createComponentEditarCentroForm() {

        $form = ( new CentrosFormFactory() )->createEdit($this->centroEditado);
        $form->onSuccess[] = [ $this, 'onSuccessEditarCentro' ];

        return $form;
    }
    public function onSuccessEditarCentro(Form $form, \stdClass $values ): void {

        try {
            $centro = $this->centroEditado;
            $centro->nombre = $values->nombre;
            $centro->direccion = $values->direccion;
            $centro->correo = $values->correo;
            $this->orm->persistAndFlush($centro);
            $this->flashMessage('Centro modificado correctamente', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
//    -
//    AÑADIR CENTRO
//    -
    public function createComponentMasCentrosForm(){
        
        $form = ( new FormFactory() )->create();
        
        $form->addText('nombre', 'Nombre del centro')->setRequired();
        
        $form->addText('direccion', 'Dirección del centro')->setRequired();
        
        $form->addText('correo', 'Correo del centro')->setRequired();
        
        $form->addSubmit('send', 'Guardar')->setHtmlAttribute("class", 'btn btn-success');
        
        $form->onSuccess[] = [ $this, 'onSuccessMasCentros' ];

        return $form;
    }

    public function onSuccessMasCentros(Form $form, \stdClass $values ): void {

        try {
            $centro = new Centro();
            $centro->nombre = $values->nombre;
            $centro->direccion = $values->direccion;
            $centro->correo = $values->correo;
            $this->orm->persistAndFlush($centro);
            $this->flashMessage('Centro añadido correctamente', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
            $this->redirect('this');
        }

    /*public function actionBorrarCentro($idCentro){
        try {
            if( !$centro = $this->orm->centros->getById($idCentro) ) {
                $this->flashMessage("El centro no existe", "danger");
            };
            $this->orm->centros->removeAndFlush($centro);
            $this->flashMessage("Centro eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar el centro, contacte con el administrador",'danger');
        }
        $this->redirect('default');
    }*/ //borrar

}
