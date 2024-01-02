<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/hosp-e/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/hosp-e/config/conexao.php';
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$nsus = $_POST['nsus'];
$rg = $_POST['rg'];
$email = $_POST['email'];
$data_nascimento = $_POST['data'];
$civil = $_POST['civil'];
$sexo = $_POST['sexo'];
// $transporte = $_POST['transporte'];
$endereco = $_POST['endereco'];
$obs = $_POST['obs'];

//CALCULAR A IDADE COM BASE NA DATA SELECIONADA
if ($data_nascimento != '') {
    // separando yyyy, mm, ddd
    list($ano, $mes, $dia) = explode('-', $data_nascimento);

    // data atual
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);

    // cálculo
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
} else {
    $idade = 0;
}


if ($nome == '') {
    echo "Preencha o Nome!!";
    exit();
}

if ($cpf == '' && $nsus == '') {
    echo "Preencha o CPF ou o Nº do Registro!!";
    exit();
}

if ($telefone == '') {
    echo "Preencha o Telefone!";
    exit();
}

if ($data_nascimento == '') {
    echo "Preencha a Data de Nascimento!!";
    exit();
}

if ($idade == '') {
    echo "Preencha a Idade!!";
    exit();
}

if ($civil == '') {
    echo "Informe o Estado Civil!!";
    exit();
}

if ($sexo == '') {
    echo "Informe o Sexo!!";
    exit();
}

// if ($transporte == '') {
//     echo "Informe se faz uso do transporte!!";
//     exit();
// }

if ($endereco == '') {
    echo "Preencha o Endereço!!";
    exit();
}



// Inicializa as variáveis de contagem de duplicatas
$linhas_cpf = 0;
$linhas_nsus = 0;

if ($cpf != '') {
    // Verificar se o CPF já está cadastrado para outro paciente
    $res_c = $pdo->query("SELECT * FROM pacientes WHERE cpf = '$cpf'");
    $dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
    $linhas_cpf = count($dados_c);

    if ($linhas_cpf != 0) {
        echo "CPF já cadastrado!";
        exit();
    }
}

if ($nsus != '') {
    // Verificar se o Nº do Registro já está cadastrado para outro paciente
    $res_nsus = $pdo->query("SELECT * FROM pacientes WHERE num_sus = '$nsus'");
    $dados_nsus = $res_nsus->fetchAll(PDO::FETCH_ASSOC);
    $linhas_nsus = count($dados_nsus);

    if ($linhas_nsus != 0) {
        echo "Nº do Registro já cadastrado!";
        exit();
    }
}

// Restante do código para inserir o novo paciente se não houver duplicações
if ($linhas_cpf == 0 && $linhas_nsus == 0) {
    $res = $pdo->prepare("INSERT INTO pacientes (nome, 
    cpf, num_sus, rg, telefone, email, data_nasc, idade, civil, sexo, endereco, obs) VALUES 
    (:nome, :cpf, :nsus, :rg, :telefone, :email, :data_nasc, 
    :idade, :civil, :sexo, :endereco, :obs)");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":nsus", $nsus);
    $res->bindValue(":telefone", $telefone);
    $res->bindValue(":rg", $rg);
    $res->bindValue(":email", $email);
    $res->bindValue(":data_nasc", $data_nascimento);
    $res->bindValue(":idade", $idade);
    $res->bindValue(":civil", $civil);
    $res->bindValue(":sexo", $sexo);
    $res->bindValue(":endereco", $endereco);
    $res->bindValue(":obs", $obs);

    $res->execute();

    echo "Cadastrado com Sucesso!!";
} else {
    if ($linhas_cpf != 0) {
        echo "Paciente com CPF já cadastrado!";
    }
    if ($linhas_nsus != 0) {
        echo "Paciente com Nº do Registro já cadastrado!";
    }
}

?>