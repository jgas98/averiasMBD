<?php

namespace App\Presenters;


use App\Forms\AlumnosFormFactory;
use App\Model\Orm\Alumno;
use App\Model\Orm\Calendario;
use App\Model\Orm\Clase;
use App\Model\Orm\Comedor;
use Nette\Application\UI\Form;
use Nette\Utils\Image;
use Nextras\Orm\Collection\ICollection;

class CalendariosPresenter extends BasePresenter {

    public function renderDefault(): void
    {
        $this->template->calendario = $this->orm->calendarios->getBy(['monthdate'=>date("m-Y")]);
    }
    public function createComponentAddCalendarForm(){
        $form = new Form();
        $form->addText('fecha','Formato mm-yyyy')
            ->addRule(Form::MIN_LENGTH, 'Fecha demasiado corta', 7);
        $form->addUpload('imagen','Foto del calendario');
        $form->addSubmit('send', 'Buscar')
            ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessAddCalendar'];

        return $form;
    }

    public function onSuccessAddCalendar(Form $form, \stdClass $values ): void
    {
        try {
            $calendario = new Calendario();

                if(preg_match("/^(0[1-9]|1[0-2])-[0-9]{4}$/",$values->fecha)){  //Revisa que el formato de fecha sea mm-yyyy
                    if($values->fecha >= date("m-Y")){                          //Revisa que la fecha introducida sea igual o posterior a la actual
                        $calendario->monthdate = $values->fecha;
                    }  else {
                        $this->flashMessage("Una fecha anterior a la actual es invalida",'danger');
                        $this->redirect('this');
                    }
                } else {
                    $this->flashMessage("Fecha incorrecta, consulta el formato",'danger');
                    $this->redirect('this');
                }
//            IMAGEN
            $nombretemporal = $values->imagen->getSanitizedName();
            $image = Image::fromFile($values->imagen->getTemporaryFile());
            $image->resize(1920, 1080, Image::SHRINK_ONLY);         //Cambia el tamaño de la imagen a 1920x1080
            $image->save("/var/www/gyscomedor/www/images/".$nombretemporal);       //Ruta absoluta donde se guarda el archivo
            $calendario->imagen = "/images/".$nombretemporal;                           //Guardado en la base de datos de la ruta de la imagen
            $centro = $this->getDbUser()->centro;
            $centro->calendarios->add($calendario);

            $this->orm->persistAndFlush($centro);
            $this->flashMessage('Calendario añadido correctamente', 'success');
        } catch( \Exception $e ) {

            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }

    public function actionBorrarCalendario(){
            $calendario = $this->orm->calendarios->getBy(['monthdate'=>date("m-Y")]);
            unlink("/var/www/gyscomedor/www".$calendario->imagen);              //Borra el archivo
            $centro = $this->orm->centros->getById( $this->getDbUser()->centro->id);
            $centro->calendarios->remove($calendario);
            $this->orm->persistAndFlush($centro);
            $calendario->monthdate = "removed";                                         //La fecha del dato en la BD pasa a ser removed para evitar BUGS
            $this->orm->calendarios->persistAndFlush($calendario);                      //Borra el registro
        $this->flashMessage('Calendario borrado correctamente', 'success');
        $this->redirect('Calendarios:default');
    }
}
