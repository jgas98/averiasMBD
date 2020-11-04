<?php

namespace App\AdminModule\Presenters;

use App\Forms\AlumnosFormFactory;

use App\Model\Orm\Averias;

use Nette\Application\UI\Form;

use Nextras\Orm\Collection\ICollection;

use Nette\SmartObject;

class AveriasPresenter extends BaseAdminPresenter {

    /** @var $averiaEditada Averia */
    //private $averiaEditada;

    /*public function renderDefault($idClase): void {
        
        $this->template->rol = $this->getDbUser()->rol;
        
         if(!$idClase){

                $this->template->todosLosCentros = $this->orm->centros->findAll();
            } else {

            $this->template->alumnos = $this->orm->alumnos->findBy(['claseid' => $idClase])->orderBy('primerapellidoalumno', ICollection::DESC);
            $this->template->clasex = $this->orm->clases->getById($idClase);
            }

    }*/

// _____________________________ EDITAR _______________________________________________

    public function actionEditar( $idAveria) {
        
        $averia = $this->orm->averias->getById($idAveria);
        
        $this->averiaEditada = $averia;
        
        $this->template->averia = $averia;
    }
    
    public function createComponentEditarAveriaForm() {

        $form = ( new AveriasFormFactory() )->createEdit($this->averiaEditada);
        
        $form->onSuccess[] = [ $this, 'onSuccessEditarAveria' ];

        return $form;
    }
    
    public function onSuccessEditarAveria (Form $form, \stdClass $values ): void {
        
        $averiax = new Averias();
        
        try {
            
            $id = $values->id;
            
            $averiax = $this->orm->averias->getById($id);

            $averiax->inicioAveria = $values->inicioAveria;
            
            $averiax->finalAveria = $values->finalAveria;
            
            $averiax->cumplimentado = $values->cumplimentado;

            $averiax->aparato = $values->aparato;

            $averiax->marca = $values->marca;

            $averiax->modelo = $values->modelo;

            $averiax->numeroSerie = $values->numeroSerie;

            $averiax->garantia = $values->garantia;
            
            $this->orm->persistAndFlush($averiax);
            
            $this->flashMessage('Averia editada correctamente', 'success');
        }
         
        catch( \Exception $e ) {
        
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        
        }
        $this->redirect('Alumnos:default', $this->claseEdit->id);
    }

//-
//IMPORTAR
//-
    /*public function createComponentImportarAlumnosForm(){
        $form = ( new AlumnosFormFactory())->createImport();
        $form->onSuccess[] = [ $this, 'onSuccessImportarAlumnos' ];

        return $form;
    }

    public function onSuccessImportarAlumnos(Form $form, \stdClass $values ): void {
     try{
         $archivo = $values->import->getContents();
         $xml = simplexml_load_string($archivo);

             foreach ($xml->aulas->aula as $aula){
                $p = $aula->attributes()->codigo;
                d($p);
             }

         dd($xml->aulas->aula[0]);

     } catch( \Exception $e ) {

         $this->flashMessage("Error: " . $e->getMessage(), 'danger');
     }
        $this->redirect('this');
    }*/
//-
//AÑADIR
//-
    /*public function actionAdd($idClase) {
        $clase = $this->orm->clases->getById($idClase);
        $this->claseEdit = $clase;
        //
        $this->template->item = $clase;
        $this->template->clase = $clase;
    }*/

//__________________AÑADIR____________________________

    public function createComponentMasAveriasForm(){
        
        $averia = new Averias();
        
        $form = ( new AveriasFormFactory() )->createNuevo($averia, $this->averia->id);
        
        $form->onSuccess[] = [ $this, 'onSuccessMasAverias' ];

        return $form;
    }

    public function onSuccessMasAverias (Form $form, \stdClass $values ): void {
        
        try {
            
            $averiax = $this->averiaEdit;

            $averiax = new Averia();
            
            $averiax->inicioAveria = $values->inicioAveria;
            
            $averiax->finalAveria = $values->finalAveria;
            
            $averiax->cumplimentado = $values->cumplimentado;

            $averiax->aparato = $values->aparato;
            
            $averiax->marca = $values->marca;
            
            $averiax->modelo = $values->modelo;

            $averiax->numeroSerie = $values->numeroSerie;

            $averiax->garantia = $values->garantia;
           
            $this->orm->persistAndFlush($clasex);
            
            $this->flashMessage('Averia añadida correctamente', 'success');
        
        } catch( \Exception $e ) {

            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }

    //____________________BORRAR_____________________________________
    
    public function actionBorrarAverias ($idAveria){

        try {
            
            if( !$averia = $this->orm->averias->getById($idAveria) ) {$this->flashMessage("La averia no existe", "danger");};
            
            $this->orm->averias->removeAndFlush($averia);
            
            $this->flashMessage("Averia eliminada", "success");
        
        } catch( \Exception $e ) {
            
            $this->flashMessage("Error al eliminar la averia, contacte con el administrador",'danger');
        }
        
        $this->redirect('Averias:default', $idAveria);
    }

}
