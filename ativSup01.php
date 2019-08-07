<?php 

/**
 * Crie uma classe chamada LogFile utilizando padrão singleton. 
 * O objetivo é: sempre que for registrar uma atividade de log no sistema seja sempre no mesmo arquivo de log.
 */

class LogFile
{
	const FILE = '.log';

	public function registrarNovoEvento($evento)
	{
		$arquivo = $this->capturarArquivoLog();

		return (fwrite($arquivo, $evento . "\n")) ? true : false;
	}

	private function capturarArquivoLog()
	{
		return fopen(self::FILE, 'a');
	}
}

$logger = new LogFile;

$descricaoEvento = date('Y-m-d H:i:s') . " >> {$_POST['botao']} foi clicado;";

if ($logger->registrarNovoEvento($descricaoEvento)) {
	echo json_encode(array('message' => '"' . $descricaoEvento . '" registrado', 'success' => true));
	exit;
}

echo json_encode(array('message' => 'Falha no registro :(', 'success' => false));