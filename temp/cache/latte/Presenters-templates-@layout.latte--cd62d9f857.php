<?php
// source: /var/www/gyscomedor/app/Presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Templatecd62d9f857 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'sidebar' => 'blockSidebar',
		'usuario' => 'blockUsuario',
		'scripts' => 'blockScripts',
		'mas_scripts' => 'blockMas_scripts',
	];

	public $blockTypes = [
		'head' => 'html',
		'sidebar' => 'html',
		'usuario' => 'html',
		'scripts' => 'html',
		'mas_scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>Oidocosina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/css/style.css">
    <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>

</head>
<body>
<?php
		$this->renderBlock('sidebar', get_defined_vars());
		$this->renderBlock('usuario', get_defined_vars());
?>
<div class=container>
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>    <div<?php if ($_tmp = array_filter(['alert', 'alert-' . $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><?php
			echo LR\Filters::escapeHtmlText($flash->message) /* line 64 */ ?></div>
<?php
			$iterations++;
		}
?>

<?php
		$this->renderBlock('content', $this->params, 'html');
?>
</div>

<?php
		$this->renderBlock('scripts', get_defined_vars());
		$this->renderBlock('mas_scripts', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['datos'])) trigger_error('Variable $datos overwritten in foreach on line 40');
			if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 64');
		}
		$this->createTemplate('components/form.latte', $this->params, "import")->render();
		$this->createTemplate('components/ticket.latte', $this->params, "import")->render();
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		
	}


	function blockSidebar($_args)
	{
		
	}


	function blockUsuario($_args)
	{
		extract($_args);
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default")) ?>">
<?php
		if (!$imgcentro == NULL) {
			?>            <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($imgcentro)) /* line 26 */ ?>" alt="" class="img-fluid">
<?php
		}
		else {
?>
            Home
<?php
		}
?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target=".dual-collapse2"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100 order-0 dual-collapse2" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

<?php
		$iterations = 0;
		foreach ($menu as $datos) {
			if ($datos['mostrar']) {
?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link($datos['nhref'])) ?>"><?php
				echo LR\Filters::escapeHtmlText($datos['nombre']) /* line 43 */ ?><span
                                        class="sr-only">(current)</span></a>
                        </li>
<?php
			}
			$iterations++;
		}
?>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
<?php
		if ($usuarioDb) {
			?>                        <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>"><?php
			echo LR\Filters::escapeHtmlText($usuarioDb->nombre) /* line 54 */ ?> (salir)</a>
<?php
		}
		else {
?>
                        Invitado
<?php
		}
?>
                </li>
            </ul>
        </div>
    </nav>
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
?>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://nette.github.io/resources/js/3/netteForms.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 75 */ ?>/js/nette.ajax.js"></script>
    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 76 */ ?>/js/main.js"></script>
    <script>
        $(document).ready(function () {
            $(".del").click(function () {
                confirm('¿Seguro que lo quieres borrar?')
            });

            $(".alert").fadeTo(2000, 500).slideUp(500, function () {
                $(".alert").slideUp(500);
            });
        });
    </script>
<?php
	}


	function blockMas_scripts($_args)
	{
?></body>
</html>
<?php
	}

}
