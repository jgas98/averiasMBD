<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Empresa|NULL getById( $id )
 */
class EmpresaRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Empresa::class ];
    }
}