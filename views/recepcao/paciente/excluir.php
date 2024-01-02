<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/hosp-e/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/hosp-e/config/conexao.php';
$pagina = 'paciente';

$id = $_POST['id'];


$res = $pdo->prepare("DELETE from pacientes where id = :id ");

$res->bindValue(":id", $id);

$res->execute();

?>