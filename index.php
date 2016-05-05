<?php
//Arquivo da classe NuSOAP
require_once('lib/nusoap.php');

//Criação da instancia do servidor
$server = new soap_server;
//Inicia o suporte a WSDL
$server->configureWSDL('server.webservice', 'urn:server.webservice');
$server->wsdl->schemaTargetNamespace = 'urn:server.webservice';
//Registro do Método
$server->register('consulta_processo', //Nome do método
array('num_processo' => 'xsd:string'),
array('return' => 'xsd:string'), //Parametros de saida
'urn:server.webservice', //namespace
'urn:server.webservice#consulta',
'rpc', //style
'encoded', //use
'Retorna consulta do processo' //Documentação do serviço
);

$server->register('obter_diario', //Nome do método
array('data' => 'xsd:string'),
array('return' => 'xsd:string'), //Parametros de saida
'urn:server.webservice', //namespace
'urn:server.webservice#consulta',
'rpc', //style
'encoded', //use
'Retorna consulta do processo' //Documentação do serviço
);

//Métodos

	function listar_onibus($num_processo)
	{		
		// $conn = mysql_connect('mysql.hostinger.com.br', 'u974275456_bus', 'cruz2401');
		// if (!$conn) {
			// die('Could not connect: ' . mysql_error());
		// }
		// //echo 'Connected database successfully';
		// mysql_select_db("u974275456_bus");
		
	}	
	
	function obter_diario($data)
	{
		include('arquivos/class.pdf2text.php');
		//$result = pdf2text ('aplicacao.jt.jus.br/Diario_J_01.pdf');		
		$a = new PDF2Text();
		$a->setFilename('arquivos/edital.pdf');
		$a->decodePDF();
		$result = $a->output(); 
		
		if($result == "")
			$result = "Não encontrado";
		return $result;
	}

	//Requisição para uso do serviço
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>