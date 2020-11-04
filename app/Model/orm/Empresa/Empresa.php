<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Empresa
 *
 * @property    int    $id  {primary}
 * @property    string|null   $nif
 * @property    int    $telefono
 * @property    string|null   $direccion
 * @property    OneHasMany|Historico[] $historicos {1:m Historico::$empresa}
 */

 class Empresa extends Entity {

}