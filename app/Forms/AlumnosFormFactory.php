<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Alumno;
use Nette;
use Nette\Application\UI\Form;

final class AlumnosFormFactory {
    
    use Nette\SmartObject;

    public function createNuevo(Alumno $alumno) {
        $form = $this->create();
        $form->setDefaults($alumno->toArray(2));
        return $form;
    }
    
    public function createEdit( Alumno $alumno) {
        $form = $this->createx();

        $alergias = [];
        foreach (Alumno::getAlergiasList(true) as $alergia){
            $alumno->$alergia ? $alergias[] = $alergia : null;
        }

        $comedores = [];
        foreach (Alumno::getDiasComedorList(true) as $comedor){
            $alumno->$comedor ? $comedores[] = $comedor : null;
        }
        $values = [
            'id' => $alumno->id,
            'nombrealumno' => $alumno->nombrealumno,
            'primerapellidoalumno' => $alumno->primerapellidoalumno,
            'segundoapellidoalumno' => $alumno->segundoapellidoalumno,
            'fechanacimiento' => "0",
            'alergias' => $alergias,
            'comedor' => $comedores,
            'imagen' => $alumno->imagen,
            ];



        $form->setDefaults($values);
        return $form;
    }
    public function createMiEdit( Alumno $alumno) {
        $form = $this->createMi();
        $form->setDefaults($alumno->toArray(2));
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombrealumno', 'Nombre del Alumno')
            ->setRequired();
        $form->addText('primerapellidoalumno', 'Primer apellido del Alumno')
            ->setRequired();
        $form->addText('segundoapellidoalumno', 'Segundo apellido del Alumno')
            ->setRequired();
        $form->addText('fechanacimiento', 'fecha de nacimiento');
        $form->addCheckboxList('alergias', 'Alergias:', Alumno::getAlergiasList());
        $form->addCheckboxList('comedor', 'Dias de Comedor', Alumno::getDiasComedorList());
        $form->addUpload('imagen')
            ->addRule(Form::IMAGE, 'El logo debe ser JPEG, PNG o GIF');
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
    public function createx(): Form {
        $form = ( new FormFactory() )->create();
        $form->addHidden('id', 'Id de la clase');
        $form->addHidden('claseid', 'Id del centro');
        $form->addText('nombrealumno', 'Nombre del Alumno')
            ->setRequired();
        $form->addText('primerapellidoalumno', 'Primer apellido del Alumno')
            ->setRequired();
        $form->addText('segundoapellidoalumno', 'Segundo apellido del Alumno')
            ->setRequired();
        $form->addText('fechanacimiento', 'fecha de nacimiento');
        $form->addCheckboxList('alergias', 'Alergias:', Alumno::getAlergiasList());
        $form->addCheckboxList('comedor', 'Dias de Comedor', Alumno::getDiasComedorList());
        $form->addUpload('imagen')
            ->addRule(Form::IMAGE, 'El logo debe ser JPEG, PNG o GIF');
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
    public function createMi(): Form {
        $form = ( new FormFactory() )->create();
        $form->addHidden('id', 'Id de la clase');
        $form->addHidden('claseid', 'Id del centro');
        $form->addText('nombrealumno', 'Nombre del Alumno')
            ->setRequired();
        $form->addText('primerapellidoalumno', 'Primer apellido del Alumno')
            ->setRequired();
        $form->addText('segundoapellidoalumno', 'Segundo apellido del Alumno')
            ->setRequired();
        $form->addText('fechanacimiento', 'fecha de nacimiento');
        $form->addCheckboxList('alergias', 'Alergias:', Alumno::getAlergiasList());
        $form->addCheckboxList('comedor', 'Dias de Comedor', Alumno::getDiasComedorList());
        $form->addUpload('imagen')
            ->addRule(Form::IMAGE, 'El logo debe ser JPEG, PNG o GIF');
        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
    public function createImport(): Form {
        $form = ( new FormFactory())->create();
        $form->addUpload('import', '')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximum file size is 32MB.', 32768 * 1024);
        $form->addSubmit('send', 'Importar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }
}
