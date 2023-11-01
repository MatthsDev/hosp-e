<?php
// CARREGANDO SCRIPTS DE CONEXÃO E CONFIGURAÇÃO DO SISTEMA ( BANCO DE DADOS )
require_once("../config/config.php");
require_once("../config/conexao.php");

?>

<!-- 1| AREA DO BOTA QUE IRA CHAMAR O MODAL DE CADASTRAR NOVO PACIENTE-->
<div class="row botao-novo">
	<div class="col-md-12">

		<a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
		<a href="index.php?menu=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-secondary">Novo
			Paciente</a>

	</div>
</div>