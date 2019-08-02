<?php 

/**
 * Coleção única 
 */
class Colecao
{
	private $colecao = [];
	private static $instancia;

	private function __construct() {} //evita a instanciacao da classe no escopo global

	/**
	 * Método estático de controle de instância única
	 */
	public static function getInstance()
	{
		if (self::$instancia === null) self::$instancia = new self;
		
		return self::$instancia;
	}

	public function add($item)
	{
		$this->colecao[] = $item;
	}

	public function mostrarColecao()
	{
		var_dump($this->colecao);
	}
}

$s1 = Colecao::getInstance();

$s1->add('banana');
$s1->add('morango');

$s2 = Colecao::getInstance();

$s1->mostrarColecao();

// $s2->add('beterraba');

echo '<br><br>';

$s2->mostrarColecao();