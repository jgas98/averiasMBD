<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasOne;

/**
 * Historico
 *
 *
 * @property    int     $id {primary}
 * @property    Usuario $usuario {m:1 Usuario::$historicos}
 * @property    string  $fecha
 * @property    string  $operario
 * @property    string  $problemaAveria
 * @property    string  $solucionAveria
 * @property    Empresa $empresa {m:1 Empresa::$historicos} haria referencia a id de tabla empresa

 *
 */
class Historico extends Entity {
    
//Centro $centro {m:1 Centro::$clases}
//Centro $centro {m:1 Centro, oneSided=true}
// * @property    Empresa $empresa {m:1 Empresa:: $historicos} haria referencia a id de tabla empresa

}