<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Historico|NULL getById( $id )
 */
class HistoricoRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Historico::class ];
    }
}