<?php 

/**
 * Crie uma classe chamada LogFile utilizando padrão singleton. 
 * O objetivo é: sempre que for registrar uma atividade de log no sistema seja sempre no mesmo arquivo de log.
 */

class LogFile
{
	public function registrarNovoEvento($nome, $mensagem)
	{
		$arquivo = $this->criarNovoArquivoLog($nome);

		if (fwrite($arquivo, $mensagem)) return true;
	}

	private function criarNovoArquivoLog($nome)
	{
		if (!is_dir('./logs')) mkdir('./logs');

		$nome .= '_'.date('Y-m-d'); //xxxx_2019-08-01
		
		return fopen('./logs/'.$nome.'.txt', 'w');
	}
}

$logger = new LogFile;

if ($logger->registrarNovoEvento($_POST['nome'], $_POST['mensagem'])) {
	header('Location: ./ativSup01.html');
}