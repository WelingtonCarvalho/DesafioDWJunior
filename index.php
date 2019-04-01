<?php
require_once('includes/Template.php');
require_once("includes/config.php");
if (!isset($template)) {
    //Iniciando instância de template
    $template = new Template();
    $template->Title = "Agendamento";
    $template->Body = __FILE__;
    //Iniciando layout
    include "includes/layout.php";
    exit;
}
?>
    <form method="post" style="width:300px; margin:auto">
        <div class="container border" style="width:330px; margin:auto">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="display-6" style="text-align:center">Agendamento</h3>
                </div>
            </div>
            <label for="nome">Seu nome</label>
            <input type="text" minlength="5" name="nome" oninput="validarAlfabeto('nome');" id="nome"
                   class="form-control" style="width:205px">
            <label for="telefone">Seu telefone</label>
            <input type="text" name="telefone" id="telefone" maxlength="15" class="form-control col-7">
            <label for="cidade">Sua cidade</label>
            <label for="uf" style="margin-left: 175px;">UF:</label>
            <div class="form-row">
                <div class="form-row">
                    <div class="col-9">
                        <input type="text" minlength="5" name="cidade" oninput="validarAlfabeto('cidade');" id="cidade"
                               class="form-control ml-1"
                               style="width:205px">
                    </div>
                </div>
                <div class="form-group col-3">
                    <select name="uf" class="custom-select ml-4" id="uf">
                        <option value="1">SP</option>
                        <option value="2">RS</option>
                        <option value="3">SC</option>
                        <option value="4">PR</option>
                        <option value="5">RJ</option>
                    </select>
                </div>
            </div>
            <label for="email">Seu e-mail</label>
            <input type="text" minlength="5" name="email" id="email" class="form-control" style="width:205px">
            <label for="informacoes">Informações:</label>
            <textarea name="informacoes" minlength="10" id="informacoes" class="form-control"></textarea>
            <div class="form-row mt-2">
                <label for="categoria">Sua categoria:</label>
                <div class="col-6">
                    <select name="categoria" class="custom-select col-11" id="categoria">
                        <option value="1">Cliente</option>
                        <option value="2">Fornecedor</option>
                        <option value="3">Funcionário</option>
                    </select>
                </div>
                <div class="row mx-auto mt-2">
                    <div class="col-sm">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-primary" onclick="clearFields()">Limpar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php
//Checar se o POST foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($db, $_POST["nome"]);
    $uf = mysqli_real_escape_string($db, $_POST["uf"]);
    $categoria = mysqli_real_escape_string($db, $_POST["categoria"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $cidade = mysqli_real_escape_string($db, $_POST["cidade"]);
    $telefone = mysqli_real_escape_string($db, $_POST["telefone"]);
    $informacoes = mysqli_real_escape_string($db, $_POST["informacoes"]);
    $date = new DateTime();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "
<div class=\"mx-auto mt-3\" style=\"width: 300px;\">
<div class=\"alert alert-info\" role=\"alert\">
  Formato de email inválido
</div>
</div>";
        exit;
    }
    if (preg_match('/\\d/', $telefone) == 0) {
        echo "
<div class=\"mx-auto mt-3\" style=\"width: 300px;\">
<div class=\"alert alert-info\" role=\"alert\">
  O campo de telefone deve conter apenas números
</div>
</div>";
        exit;
    }
    if ($nome == "" || $categoria == "" || $email == "" || $cidade == "" || $telefone == "" || $informacoes == "") {
        echo "
<div class=\"mx-auto mt-3\" style=\"width: 300px;\">
<div class=\"alert alert-info\" role=\"alert\">
  Todos os campos devem ser preenchidos
</div>
</div>";
        exit;
    }

    if ($uf == "1") {
        $uf = "SP";
    }
    if ($uf == "2") {
        $uf = "RS";
    }
    if ($uf == "3") {
        $uf = "SC";
    }
    if ($uf == "4") {
        $uf = "PR";
    }
    if ($uf == "5") {
        $uf = "RJ";
    }
    if ($categoria == "1") {
        $categoria = "Cliente";
    }
    if ($categoria == "2") {
        $categoria = "Fornecedor";
    }
    if ($categoria == "3") {
        $categoria = "Funcionário";
    }
    if ($db->query("INSERT INTO agendamentos (nome, telefone, email, cidade, uf, informacoes, categoria, datahora)
VALUES ('" . $nome . "','" . $telefone . "','" . $email . "','" . $cidade . "','" . $uf . "','" . $informacoes . "','" . $categoria . "','" . date('d/m/Y H:i:s', $date->getTimestamp()) . "')") === TRUE) {
        echo "
<div class=\"mx-auto mt-2\" style=\"width: 230px;\">
<div class=\"alert alert-success\" role=\"alert\">
  Agendamento enviado!
</div>
</div>";
    } else {
        echo "
<div class=\"mx-auto mt-2\" style=\"width: 230px;\">
<div class=\"alert alert-danger\" role=\"alert\">
  Erro no banco de dados
</div>
</div>";
    }

}
?>