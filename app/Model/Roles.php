<?php

namespace App\Model;

use Nette\Security\IAuthorizator;

class Roles implements IAuthorizator {
    
    //Secciones

    const SECCION_ADMIN = 'administracion';

    const SECCION_LOGIN = 'login';

    const SECCION_USUARIOS = 'usuarios';

    const SECCION_AVERIAS = 'averias';

    const SECCION_HISTORICOS = 'historicos';



    //Roles
    const ROL_ADMIN = 'admin';

    const ROL_CLIENTE = "cliente";


    const ROL_JEFE_EMPRESA = "jefe";

    const ROL_OPERARIOS = "operarios";


    //Permisos
    const PERMISO_VER = 'ver';
    const PERMISO_EDITAR = 'editar';
    const PERMISO_BORRAR = 'borrar';
    const PERMISO_ADD = 'add';

    private static $permissions;
    
    public function getRoles() {
        $roles = [];
        foreach( self::getPermisos() as $permiso => $x ) {
            $roles[] = $permiso;
        }
        
        return $roles;
    }
    
    private static function getPermisos() {
        
        if( !self::$permissions ) {
            
            $acl = [
                'superadmin' => [], //este puede hacer todo solo por ser el
                self::ROL_ADMIN      => [
                    self::SECCION_ADMIN  => [], //array de permisos vacío = todos los permisos
                    self::SECCION_USUARIOS => [],
                    self::SECCION_AVERIAS => [],

                ],
                self::ROL_OPERARIOS    => [
                    self::SECCION_AVERIAS => [],
                    self::SECCION_HISTORICOS  => [],

                ],
                self::ROL_JEFE_EMPRESA        => [
                    self::SECCION_USUARIOS => [],
                    self::SECCION_AVERIAS => [],
                    self::SECCION_HISTORICOS  => [],


                   /* self::SECCION_CLASES => [],
                    self::SECCION_ALUMNOS => [],
                    self::SECCION_CALENDARIO => [],
                    self::SECCION_PERFIL => [],
                    self::SECCION_COMEDOR => [],*/
                ],
                self::ROL_CLIENTE  => [
                    self::SECCION_USUARIOS => [],
                    self::SECCION_HISTORICOS  => [],

                ],
                'guest'      => [
                    self::SECCION_LOGIN => [],
                ],
            ];
            self::$permissions = $acl; //set the permissions once
        }
        
        return self::$permissions;
    }
    
    public function isAllowed( $role, $resource, $privilege ): bool {

        if( $role === 'superadmin' ) {
            return true;
        }
        //
        $acl = self::getPermisos();
        if(isset($acl[ $role ][ $resource ]) && count($acl[ $role ][ $resource ]) === 0 ) {
            return true;
        }
        
        return isset($acl[ $role ][ $resource ]) && in_array($privilege, $acl[ $role ][ $resource ]);
    }
    
}
