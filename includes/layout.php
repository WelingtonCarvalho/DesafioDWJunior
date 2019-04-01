<?php
require_once('Template.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php if (isset($template->Title)) {
            echo $template->Title;
        } ?></title>
    <?php if (isset($template->Head)) {
        include $template->Head;
    } ?>

    <script>
        function changeTipo(tipo) {
            if (tipo == "1") {
                id('pesquisa').onkeyup = function () {
                    mask(this, formatnumber);
                }
            }
        }

        function mask(o, f) {
            x_objeto = o
            x_fun = f
            setTimeout("execmascara()", 1)
        }

        function execmascara() {
            x_objeto.value = x_fun(x_objeto.value)
        }

        function formatnumber(rawnumber) {
            rawnumber = rawnumber.replace(/\D/g, "");
            rawnumber = rawnumber.replace(/^(\d{2})(\d)/g, "($1) $2");
            rawnumber = rawnumber.replace(/(\d)(\d{4})$/, "$1-$2");
            return rawnumber;
        }

        function id(xd) {
            return document.getElementById(xd);
        }

        window.onload = function () {
            id('telefone').onkeyup = function () {
                mask(this, formatnumber);
            }
        }

        function validarAlfabeto(field) {
            var textInput = document.getElementById(field).value;
            textInput = textInput.replace(/[^A-Za-z\s\u00C0-\u00FF]/g, "");
            document.getElementById(field).value = textInput;
        }

        function clearFields() {
            document.getElementById("nome").value = "";
            document.getElementById("telefone").value = "";
            document.getElementById("cidade").value = "";
            document.getElementById("email").value = "";
            document.getElementById("informacoes").value = "";
        }
    </script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="">Sistema</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
                if (strpos($_SERVER['PHP_SELF'], "index")) {
                    echo " <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"/index.php\">Início <span class=\"sr-only\">(current)</span></a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/consultas.php\">Consultas</a>
                </li>";
                }
                if (strpos($_SERVER['PHP_SELF'], "consultas")) {
                    echo " <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/index.php\">Início <span class=\"sr-only\">(current)</span></a>
                </li>
                <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"/consultas.php\">Consultas</a>
                </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
</div>

<div id="content" class="mt-2">

    <?php if (isset($template->Body)) {
        include $template->Body;
    } ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>