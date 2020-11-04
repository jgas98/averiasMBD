<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Usuario
 *
 * @property    int    $id  {primary}
 * @property    string|null   $nombre
 * @property    string|null   $correo
 * @property    string|null   $password
 * @property    string|null   $rol
 * @property    int|null    $telefono
 * @property    OneHasMany|Historico[] $historicos {1:m Historico::$usuario}
 */
class Usuario extends Entity {

}