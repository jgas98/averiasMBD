<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model;
use Nette;
use Nette\Application\UI\Form;


final class SignUpFormFactory
{
	use Nette\SmartObject;

	private const PASSWORD_MIN_LENGTH = 7;

	/** @var FormFactory */
	private $factory;

	/** @var Model\Authentication */
	private $authentication;


	public function __construct(FormFactory $factory, Model\Authentication $authentication)
	{
		$this->factory = $factory;
		$this->authentication = $authentication;
	}


	public function create(callable $onSuccess): Form
	{
		$form = $this->factory->create();
		//$form->addText('username', 'Pick a username:')
		//	->setRequired('Please pick a username.');

		$form->addEmail('email', 'Your e-mail:')
			->setRequired('Please enter your e-mail.');

		$form->addPassword('password', 'Create a password:')
			->setOption('description', sprintf('at least %d characters', self::PASSWORD_MIN_LENGTH))
			->setRequired('Please create a password.')
			->addRule($form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Sign up');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
            try {
                $user = new Model\Orm\Usuario();
                $user->correo = $values->email;
                $user->password = $values->password;
                //
                $this->authentication->add($user);
            } catch (Model\DuplicateNameException $e) {
                $form['email']->addError('Este correo ya existe, por favor elige otro o recupera tu contraseña.');
                return;
            }
            $onSuccess();
		};

		return $form;
	}
}
