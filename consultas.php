<?php
require_once('includes/Template.php');
require_once("includes/config.php");
if (!isset($template)) {
    $template = new Template();
    $template->Title = "Consultas";
    $template->Body = __FILE__;
    include "includes/layout.php";
    exit;
}
?>
<form method="post">
    <div class="container" style="width:450px; margin:auto">
        <div class="row">
            <input class="form-control col-6 mr-1" name="pesquisa" id="pesquisa"  type="search" placeholder="Pesquisar"
                   aria-label="Pesquisar">
            <select class="form-control col-3" onChange="changeTipo(this.selectedIndex);" name="tipopesquisa" id="tipopesquisa">
                <option value="1">Nome</option>
                <option value="2">Telefone</option>
                <option value="3">Email</option>
            </select>
            <button type="submit" class="btn btn-primary ml-2">Pesquisar</button>
        </div>
    </div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<div class=\"container mt-2\"  style=\"margin:auto\">
        <table class=\"table table-bordered\">
            <thead>
            <tr>
                <th scope=\"col\">Nome</th>
                <th scope=\"col\">Telefone</th>
                <th scope=\"col\" >Email</th>
                <th scope=\"col\">Cidade</th>
                <th scope=\"col\">UF</th>
                <th scope=\"col\">Informações</th>
                <th scope=\"col\">Categoria</th>
                <th scope=\"col\">Data</th>
            </tr>
            </thead>
            <tbody>";
    $pesquisa = mysqli_real_escape_string($db, $_POST["pesquisa"]);
    $tipopesquisa = mysqli_real_escape_string($db, $_POST["tipopesquisa"]);
    if ($pesquisa == "") {
        exit();
    }
    if ($tipopesquisa == "1") {
        $resultado = $db->query("SELECT * FROM agendamentos
            WHERE (`nome` LIKE '%" . $pesquisa . "%')");
        if ($resultado->num_rows > 0) {
            //Pegar dados de cada linha da coluna
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr> <td>" . $row["nome"] . "</td> <td>" . $row["telefone"] . "</td> <td>" . $row["email"] . "</td> <td>" . $row["cidade"] . "</td> <td> " . $row["uf"] . "</td> <td>" . $row["informacoes"] . "</td> <td> " . $row["categoria"] . " </td> <td> " . $row["datahora"] . " </td> </tr>";
            }
        }
    }
    if ($tipopesquisa == "2") {
        $resultado = $db->query("SELECT * FROM agendamentos
            WHERE (`telefone` LIKE '%" . $pesquisa . "%')");
        if ($resultado->num_rows > 0) {
            //Pegar dados de cada linha da coluna
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr> <td>" . $row["nome"] . "</td> <td>" . $row["telefone"] . "</td> <td>" . $row["email"] . "</td> <td>" . $row["cidade"] . "</td> <td> " . $row["uf"] . "</td> <td class='setWidth concat'><div>" . $row["informacoes"] . "</div></td> <td> " . $row["categoria"] . " </td> <td> " . $row["datahora"] . " </td> </tr>";
            }
        }
    }
    if ($tipopesquisa == "3") {
        $resultado = $db->query("SELECT * FROM agendamentos
            WHERE (`email` LIKE '%" . $pesquisa . "%')");
        if ($resultado->num_rows > 0) {
            //Pegar dados de cada linha da coluna
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr> <td>" . $row["nome"] . "</td> <td>" . $row["telefone"] . "</td> <td>" . $row["email"] . "</td> <td>" . $row["cidade"] . "</td> <td> " . $row["uf"] . "</td> <td class='setWidth concat'><div>" . $row["informacoes"] . "</div></td> <td> " . $row["categoria"] . " </td> <td> " . $row["datahora"] . " </td></tr>";
            }
        }
    }
}
?>
</tbody>
</table>
</div>