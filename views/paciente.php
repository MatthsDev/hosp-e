<?php
// CARREGANDO SCRIPTS DE CONEXÃO E CONFIGURAÇÃO DO SISTEMA ( BANCO DE DADOS )
require_once("../config/config.php");
require_once("../config/conexao.php");
?>

<!-- 1| AREA DO BOTA QUE IRA CHAMAR O MODAL DE CADASTRAR NOVO PACIENTE-->
<div class="row botao-novo">
	<div class="col-md-12">

		<!-- Botão para abrir o modal -->
		<button id="btn-novo" type="button" class="btn btn-secondary">Novo Paciente</button>


	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1>TESTE</h1>
			</div>
		</div>
	</div>
	</div>
</div>


<!-- MODAL NOVO PACIENTE -->
<script>
$(document).ready(function () {
  // Quando o botão for clicado, o modal será aberto
  $("#btn-novo").click(function () {
    $("#modal").modal("show");
  });
});
</script>