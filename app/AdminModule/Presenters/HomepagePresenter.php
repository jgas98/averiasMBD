<?php
declare( strict_types = 1 );

namespace App\AdminModule\Presenters;

use App\Model\Orm\Usuarios;
use App\Model\Roles;
use Nette\Application\UI\Form;

final class HomepagePresenter extends BaseAdminPresenter {

    //APARTADO DE CENTROS
    public function renderdefault(): void {
        $rol = $this->getDbUser()->rol;
        $name = $this->getDbUser()->nombre;
        $this->flashMessage('Miercoles 1 de Julio a las 20:00 se incluirán funciones adicionales en el software y arreglos de todos los errores actuales', 'success');
        if($rol == 'alumno'){
            $this->flashMessage('Bienvenido '. $name, 'success');
            $this->redirect('Usuarios:perfilalumno');
        }

    }
}
