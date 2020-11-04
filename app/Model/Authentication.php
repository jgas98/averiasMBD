<?php
declare(strict_types=1);

namespace App\Model;

use App\Model\Orm\Orm;
use App\Model\Orm\Usuario;
use Nette;
use Nette\Security\Passwords;

/**
 * Users management.
 */
final class Authentication implements Nette\Security\IAuthenticator
{

    use Nette\SmartObject;

    private const TABLE_NAME = 'Usuario';

    /** @var Orm @inject */

    private $orm;

    /** @var Passwords */

    private $passwords;


    public function __construct(Orm $orm, Passwords $passwords)
    {

        $this->orm = $orm;

        $this->passwords = $passwords;

    }

    /**
     * Performs an authentication.
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials): Nette\Security\IIdentity
    {

        [$email, $password] = $credentials;

        /** @var Usuario $usuario */

        $usuario = $this->orm->usuarios->getBy(['correo' => $email]);
        //

        if (!$usuario) {

            throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

        } elseif (!$this->passwords->verify($password, $usuario->password)) {

            throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

        } elseif ($this->passwords->needsRehash($usuario->password)) {

            $usuario->password = $this->passwords->hash($password);

            $this->orm->persistAndFlush($usuario);

        }
        //
        /** @var Roles $rol */

        $rol = $usuario->rol;
        //

        $arr = [

            'email' => $usuario->correo,

            'role' => $rol

        ];

        return new Nette\Security\Identity($usuario->id, $rol, $arr);
    }

    /**
     * Adds new user.
     * @throws DuplicateNameException
     */
    public function add(Usuario $usuario): void
    {
        Nette\Utils\Validators::assert($usuario->correo, 'email');
        try {
            if ($this->orm->usuarios->getBy(['correo' => $usuario->correo])) {
                throw new DuplicateNameException;
            }
            $usuario->password = $this->passwords->hash($usuario->password);
            $usuario->rol = Roles::ROL_ADMIN;
            $this->orm->persistAndFlush($usuario);
        } catch (Nette\Database\UniqueConstraintViolationException $e) {
            throw new DuplicateNameException;
        }
    }

}



