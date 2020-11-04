<?php
declare( strict_types = 1 );

namespace App\Model;

use App\Model\Orm\Orm;
use Nette;
use Nette\Security\Passwords;

/**
 * Users management.
 */
final class UserManager implements Nette\Security\IAuthenticator {
    
    use Nette\SmartObject;
    
    private const
        TABLE_NAME = 'users',
        COLUMN_ID = 'id',
        COLUMN_NAME = 'username',
        COLUMN_PASSWORD_HASH = 'password',
        COLUMN_EMAIL = 'email',
        COLUMN_ROLE = 'role';
    
    /** @var Orm @inject */
    private $orm;

    /** @var Passwords */
    private $passwords;

    public function __construct(Orm $orm, Passwords $passwords)
    {
//        $this->database = $database;
        $this->orm = $orm;
        $this->passwords = $passwords;
    }
    
    /**
     * Performs an authentication.
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate( array $credentials ): Nette\Security\IIdentity {
        [ $correo, $password ] = $credentials;


//		$row = $this->database->table(self::TABLE_NAME)
//			->where(self::COLUMN_NAME, $username)
//			->fetch();
        $usuario = $this->orm->usuarios->getBy([ 'correo' => $correo ]);

        if( !$usuario ) {
            throw new Nette\Security\AuthenticationException('Usuario incorrecto, selecciona uno de la lista.', self::IDENTITY_NOT_FOUND);
        } elseif( $usuario->password != md5($password) ) {
            throw new Nette\Security\AuthenticationException('Pin incorrecto.', self::INVALID_CREDENTIAL);
        }

        $arr = $usuario->toArray();
        unset($arr['password']);
        return new Nette\Security\Identity($usuario->id, $usuario->rol, $arr);
    }
    
    /**
     * Adds new user.
     * @throws DuplicateNameException
     */
    public function add( string $email, string $password ): void {
        Nette\Utils\Validators::assert($email, 'email');
        try {
            $this->database->table("Usuarios")->insert([
                                                                 //self::COLUMN_NAME          => $username,
                                                                 "password" => md5($password),
                                                                 "correo"         => $email,
                                                             ]);
        } catch( Nette\Database\UniqueConstraintViolationException $e ) {
            throw new DuplicateNameException;
        }
    }
}



class DuplicateNameException extends \Exception {

}
