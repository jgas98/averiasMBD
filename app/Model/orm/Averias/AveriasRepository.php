<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Averia|NULL getById( $id )
 */

 class AveriasRepository extends Repository {

    static function getEntityClassNames(): array {
        return [ Averias::class ];
    }
}
