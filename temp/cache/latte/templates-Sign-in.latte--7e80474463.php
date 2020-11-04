<?php
// source: /var/www/gyscomedor/app/Presenters/templates/Sign/in.latte

use Latte\Runtime as LR;

class Template7e80474463 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		$this->renderBlock('title', get_defined_vars());
?>

<?php
		$this->renderBlock('bootstrap-form', ['signInForm'] + $this->params, 'html');
?>

<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?><h1>Iniciar sesión</h1>
<?php
	}

}
