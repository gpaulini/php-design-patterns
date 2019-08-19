<?php 

/**
 * Crie uma classe chamada LogFile utilizando padrão singleton. 
 * O objetivo é: sempre que for registrar uma atividade de log no sistema seja sempre no mesmo arquivo de log.
 */

class LogFile
{
	const FILE = '.log';

	private static $instancia;

	private function __construct() {}

	public static function getInstancia()
	{
		if (self::$instancia === null) self::$instancia = new self;

		return self::$instancia;
	}

	public function registrarNovoEvento($evento)
	{
		$arquivo = $this->abrirArquivoLog();

		return (fwrite($arquivo, $evento . "\n")) ? true : false;
	}

	private function abrirArquivoLog()
	{
		return fopen(self::FILE, 'a');
	}
}


//****************

date_default_timezone_set('America/Sao_Paulo');


$logger = LogFile::getInstancia();

$descricaoEvento = date('Y-m-d H:i:s') . " >> " .
(isset($_POST['botao']) ? "{$_POST['botao']} foi clicado;" : "Solicitação inválida");

if ($logger->registrarNovoEvento($descricaoEvento)) {
	if (!isset($_POST['botao'])) {
		echo "Solicita&ccedil;&atilde;o inv&aacute;lida";
		exit;
	}
	echo json_encode(
		array(
			'message' => '"' . $descricaoEvento . '" registrado', 
			'success' => true
		)
	);
	exit;
}

echo json_encode(array('message' => 'Falha no registro :(', 'success' => false));