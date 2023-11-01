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
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<<h5 class="modal-title" id="exampleModalLabel">

						<?php
						if (isset($_GET['funcao']) && $_GET['funcao'] == 'editar') {
							$nome_botao = 'Editar';
							$id_reg = $_GET['id'];

							// Buscar dados do registro a ser editado
							$res = $pdo->query("select * from pacientes where id = '$id_reg'");
							$dados = $res->fetchAll(PDO::FETCH_ASSOC);

							$nome = $dados[0]['nome'];
							$cpf = $dados[0]['cpf'];
							$nreg = $dados[0]['nreg'];
							$rg = $dados[0]['rg'];
							$telefone = $dados[0]['telefone'];
							$email = $dados[0]['email'];
							$data = $dados[0]['data_nasc'];
							$idade = $dados[0]['idade'];
							$civil = $dados[0]['civil'];
							$sexo = $dados[0]['sexo'];
							$endereco = $dados[0]['endereco'];
							$obs = $dados[0]['obs'];
						} else {
							$nome_botao = 'Salvar';
							// Definir valores padrão para as variáveis em caso de criação de novo registro
							$id_reg = '';
							$nome = '';
							$cpf = '';
							$nreg = '';
							$rg = '';
							$telefone = '';
							$email = '';
							$data = '';
							$idade = '';
							$civil = '';
							$sexo = '';
							$endereco = '';
							$obs = '';
						}
						?>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">


<form method="post">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">

				<input type="hidden" id="id" name="id" value="<?php echo $id_reg ?>" required>

				<input type="hidden" id="campo_antigo" name="campo_antigo" value="<?php echo $cpf ?>"
					required>

				<label for="exampleFormControlInput1">Nome *</label>
				<input type="text" class="form-control" id="nome" placeholder="Insira o Nome "
					name="nome" value="<?php echo $nome ?>" required>
					
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleFormControlInput1">CPF </label>
				<input type="text" class="form-control" id="cpf" placeholder="Insira o CPF " name="cpf"
					value="<?php echo isset($cpf) ? $cpf : ''; ?>" onblur="validarCPF(this)" required>

					<div id="res" name="res"></div>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label for="exampleFormControlInput1">Nº REGISTRO</label>
				<input type="text" class="form-control" id="nreg" placeholder="Insira o Nº " name="nreg"
					value="<?php echo $nreg ?>" required>
			</div>

		</div>

	</div>



	<div class="row">

		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleFormControlInput1">RG *</label>
				<input type="text" class="form-control" id="rg" placeholder="Insira o RG " name="rg"
					value="<?php echo $rg ?>" required>
			</div>

		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleFormControlInput1">Telefone *</label>
				<input type="text" class="form-control" id="telefone" placeholder="Insira o Telefone "
					name="telefone" value="<?php echo $telefone ?>" required>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleFormControlInput1">Email</label>
				<input type="email" class="form-control" id="telefone" placeholder="Insira o Email "
					name="email" value="<?php echo $email ?>" required>
			</div>
		</div>

	</div>






	<div class="row">
		<div class="col-md-4">
			<label for="exampleFormControlSelect1">Estado Civil *</label>
			<select class="form-control" id="" name="civil">
				<option value="">Selecione</option> <!-- Adicione uma opção em branco -->
				<?php if (isset($_GET['funcao']) && $_GET['funcao'] == 'editar'): ?>
					<option value="<?php echo $civil ?>">
						<?php echo $civil ?>
					</option>
				<?php endif; ?>
				<?php if ($civil != 'Solteiro'): ?>
					<option value="Solteiro">Solteiro</option>
				<?php endif; ?>
				<?php if ($civil != 'Casado'): ?>
					<option value="Casado">Casado</option>
				<?php endif; ?>
				<?php if ($civil != 'Viúvo'): ?>
					<option value="Viúvo">Viúvo</option>
				<?php endif; ?>
			</select>
		</div>

		<div class="col-md-4">
			<label for="exampleFormControlSelect1">Sexo *</label>
			<select class="form-control" id="" name="sexo">
				<option value="">Selecione</option> <!-- Adicione uma opção em branco -->
				<?php
				if ($_GET['funcao'] == 'editar') {
					echo '<option value="' . $sexo . '">' . $sexo . '</option>';
				}
				?>
				<?php if ($sexo != 'Feminino'): ?>
					<option value="Feminino">Feminino</option>
				<?php endif; ?>
				<?php if ($sexo != 'Masculino'): ?>
					<option value="Masculino">Masculino</option>
				<?php endif; ?>
			</select>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleFormControlInput1">Data Nascimento *</label>
				<input type="date" class="form-control" id="data" name="data"
					value="<?php echo $data ?>" required>
			</div>
		</div>
	</div>





	<div class="form-group">
		<label for="exampleFormControlInput1">Endereço *</label>
		<input type="text" class="form-control" id="endereco" placeholder="Insira o Endereço "
			name="endereco" value="<?php echo $endereco ?>" required>
	</div>


	<div class="form-group">
		<label for="exampleFormControlInput1">Observações</label>
		<textarea class="form-control" id="obs" name="obs"
			maxlength="350"><?php echo $obs; ?></textarea>
	</div>








	<div id="mensagem" class="">

	</div>

</div>
<div class="modal-footer">
<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

<button type="submit" name="<?php echo $nome_botao ?>" id="<?php echo $nome_botao ?>"
	class="btn btn-primary">
	<?php echo $nome_botao ?>
</button>

</div>
</form>
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