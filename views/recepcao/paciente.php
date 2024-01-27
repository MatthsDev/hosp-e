<?php $pagina = 'paciente'; ?>
<div class="row mt-8">


	<?php

	// Definir o número de itens por página
	// if (isset($_POST['itens-pagina'])) {
	// 	$itens_por_pagina = $_POST['itens-pagina'];
	// 	$_GET['pagina'] = 0; // Alterando o valor diretamente, se necessário
	// } elseif (isset($_GET['itens'])) {
	// 	$itens_por_pagina = $_GET['itens'];
	// } else {
	// 	$itens_por_pagina = $opcao1;
	// }
	

	?>

	<div class="col-md-6 col-sm-12">
		<form id="frm" class="form-inline my-2 my-lg-0" method="post">

			<input type="hidden" id="pag" name="pag"
				value="<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : ''; ?>">

			<input type="hidden" id="itens" name="itens"
				value="<?php echo isset($itens_por_pagina) ? $itens_por_pagina : ''; ?>">

			<input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Nome ou CPF"
				aria-label="Search" name="txtbuscar" id="txtbuscar">

			<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar" id="btn-buscar"><i
					class="fas fa-search"></i></button>

		</form>
	</div>
	<!-- 2.2| /////////////////////////////////////////////////////////////////////////////////////////////////////////////// " -->



	<div class="col-md-6">
		<div class="float-right">
			<a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
			<a href="index.php?menu=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-secondary">Novo
				Paciente</a>
		</div>
	</div>


</div>
<div id="listar">

</div>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						$nsus = $dados[0]['num_sus'];
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
						$nsus = '';
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
								<input type="text" class="form-control" id="nsus" placeholder="Nº SUS " name="nsus"
									value="<?php echo $nsus ?>" required>
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

<!--CHAMADA DA MODAL NOVO -->
<?php
if (isset($_GET['funcao']) && $_GET['funcao'] == 'novo' && empty($item_paginado)) {

	?>
	<script>$('#btn-novo').click();</script>
<?php } ?>


<!--CHAMADA DA MODAL EDITAR -->
<?php
if (isset($_GET['funcao']) && $_GET['funcao'] == 'editar' && empty($item_paginado)) {

	?>
	<script>$('#btn-novo').click();</script>
<?php } ?>



<!--CHAMADA DA MODAL DELETAR -->
<?php
if (isset($_GET['funcao']) && $_GET['funcao'] == 'excluir' && empty($item_paginado)) {
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Registro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<p>Deseja realmente Excluir este Registro?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"
						id="btn-cancelar-excluir">Cancelar</button>
					<form method="post">
						<input type="hidden" id="id" name="id" value="<?php echo $id ?>" required>

						<button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
					</form>
				</div>
			</div>
		</div>
	</div>


<?php } ?>



<script>$('#modal-deletar').modal("show");</script>

<!--MASCARAS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="../js/mascaras.js"></script>

<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?= $pagina ?>";

		$('#Salvar').click(function (event) {
			event.preventDefault();

			// Exibir caixa de diálogo de confirmação usando SweetAlert2
			Swal.fire({
				title: 'Confirmar Cadastro',
				text: 'Deseja realmente cadastrar este paciente?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Sim',
				cancelButtonText: 'Não'
			}).then((result) => {
				if (result.isConfirmed) {

					// O usuário confirmou, então prosseguir com o cadastro

					$.ajax({
						url: pag + "/inserir.php",
						method: "post",
						data: $('form').serialize(),
						dataType: "text",
						success: function (mensagem) {
							$('#mensagem').removeClass();

							if (mensagem == 'Cadastrado com Sucesso!!') {
								$('#mensagem').addClass('mensagem-sucesso');
								$('#nome').val('');
								$('#cpf').val('');
								$('#telefone').val('');
								$('#crm').val('');
								$('#email').val('');
								$('#txtbuscar').val('');
								$('#btn-buscar').click();

								// Exibir caixa de diálogo personalizada
								Swal.fire({
									title: 'Paciente cadastrado com sucesso!',
									text: 'Deseja adicionar mais um paciente?',
									icon: 'question',
									showCancelButton: true,
									confirmButtonText: 'Sim',
									cancelButtonText: 'Não'
								}).then((result) => {
									if (result.isConfirmed) {
										// Redirecionar para a página de cadastro
										window.location.href = 'index.php?menu=pacientes&funcao=novo';
									} else {
										window.location.href = 'index.php?menu=pacientes';
									}
								});
							} else {
								$('#mensagem').addClass('mensagem-erro');
								// Exibir mensagem de erro do servidor no SweetAlert2
								Swal.fire({
									title: 'Erro!',
									text: mensagem, // A mensagem de erro do servidor
									icon: 'error'
								});
							}
						},
					});
				}
			});
		});
	});

</script>


<!--AJAX PARA BUSCAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {

		var pag = "<?= $pagina ?>";
		$('#btn-buscar').click(function (event) {
			event.preventDefault();

			$.ajax({
				url: pag + "/listar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function (result) {
					$('#listar').html(result)

				},


			})

		})


	})
</script>

<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {

		var pag = "<?= $pagina ?>";

		$.ajax({
			url: pag + "/listar.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function (result) {
				$('#listar').html(result)

			},


		})
	})
</script>

<!--AJAX PARA BUSCAR OS DADOS PELA TXT -->
<script type="text/javascript">
	$('#txtbuscar').keyup(function () {
		$('#btn-buscar').click();
	})
</script>

<!--AJAX PARA EDIÇÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?= $pagina ?>";
		$('#Editar').click(function (event) {
			event.preventDefault();

			$.ajax({
				url: pag + "/editar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					$('#mensagem').removeClass()

					if (mensagem == 'Editado com Sucesso!!') {

						$('#mensagem').addClass('mensagem-sucesso')


						$('#txtbuscar').val('')
						$('#btn-buscar').click();

						$('#btn-fechar').click();




					} else {

						$('#mensagem').addClass('mensagem-erro')
					}

					$('#mensagem').text(mensagem)

				},

			})
		})
	})
</script>

<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?= $pagina ?>";
		$('#btn-deletar').click(function (event) {
			event.preventDefault();

			$.ajax({
				url: pag + "/excluir.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					$('#txtbuscar').val('')
					$('#btn-buscar').click();
					$('#btn-cancelar-excluir').click();

				},

			})
		})
	})
</script>