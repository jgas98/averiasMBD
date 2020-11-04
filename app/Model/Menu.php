<?php

namespace App\Model;

use Nette\Security\User;

class Menu {
    
    public static function getMenu( User $user ) {
        
        $menu = [

            [
                'nombre'  => 'Averias',
                'mostrar' => $user->isAllowed(Roles::SECCION_AVERIAS),
                'nhref'   => 'Averias:default',
            ],

            [
                'nombre'  => 'Usuarios',
                'mostrar' => $user->isAllowed(Roles::SECCION_USUARIOS),
                'nhref'   => 'Usuarios:default',
            ],

            [
                'nombre'  => 'Historico',
                'mostrar' => $user->isAllowed(Roles::SECCION_HISTORICOS),
                'nhref'   => 'Historico:default',
            ]





            /*[
                'nombre'  => 'Centros',
                'mostrar' => $user->isAllowed(Roles::SECCION_CENTROS),
                'nhref'   => 'Centros:default',
            ],
            [
                'nombre'  => 'Clases',
                'mostrar' => $user->isAllowed(Roles::SECCION_CLASES),
                'nhref'   => 'Clases:default',
            ],
            [
                'nombre'  => 'Alumnos',
                'mostrar' => $user->isAllowed(Roles::SECCION_ALUMNOS),
                'nhref'   => 'Alumnos:default',
            ],*/

           /* ],[
                'nombre'  => 'Direccion',
                'mostrar' => $user->isAllowed(Roles::SECCION_DIRECCION ),
                'nhref'   => 'Direccion:default',
            ],
            [
                'nombre'  => 'Perfil',
                'mostrar' => $user->isAllowed(Roles::SECCION_PERFILALUMNO),
                'nhref'   => 'Usuarios:perfilalumno',
            ],
            [
                'nombre'  => 'Comedor',
                'mostrar' => $user->isAllowed(Roles::SECCION_COMEDOR),
                'nhref'   => 'Comedor:default',
            ],[
                'nombre'  => 'Soporte',
                'mostrar' => $user->isAllowed(Roles::SECCION_CLASES),
                'nhref'   => 'Support:default',
            ],*/


        ];
        
        return $menu;
    }
    public static function getMenuUser( User $user ) {

        $menu = [

//            [
//                'nombre'  => 'Centros',
//                'mostrar' => $user->isAllowed(Roles::SECCION_CENTROS),
//                'nhref'   => 'Centros:default',
//            ],
//            [
//                'nombre'  => 'Clases',
//                'mostrar' => $user->isAllowed(Roles::SECCION_CLASES),
//                'nhref'   => 'Clases:default',
//            ],
//            [
//                'nombre'  => 'Alumnos',
//                'mostrar' => $user->isAllowed(Roles::SECCION_ALUMNOS),
//                'nhref'   => 'Alumnos:default',
//            ],
//            [
//                'nombre'  => 'Calendario',
//                'mostrar' => $user->isAllowed(Roles::SECCION_CALENDARIO),
//                'nhref'   => 'Calendarios:default',
//            ],
//            [
//                'nombre'  => 'Administración',
//                'mostrar' => $user->isAllowed(Roles::SECCION_DIRECTOR),
//                'nhref'   => 'Admin:Direccion:default',
//            ],
//            [
//                'nombre'  => 'Soporte',
//                'mostrar' => $user->isAllowed(Roles::SECCION_DIRECTOR),
//                'nhref'   => 'Admin:Support:default',
//            ],
        ];

        return $menu;
    }
    
}
