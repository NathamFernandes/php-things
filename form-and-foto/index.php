<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        Nome: <input type="text" name="nome">
        Idade: <input type="number" name="idade">
        Foto: <input type="file" name="foto">
        <input type="submit" value="Enviar" name="send-form">
    </form>
    
    <?php
    if (isset($_POST['send-form'])) {
        $arrayExtensoes = ['png', 'jpg', 'jpeg', 'gif'];

        // pathinfo() retorna um array
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $pasta = "arquivos/";

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
        $idade = filter_var($idade, FILTER_VALIDATE_INT);

        // $_FILES é um array com índices iguais aos names do form
        $temp_file = $_FILES['foto']['tmp_name'];
        // uniqid() retorna uma string.
        // PHP DOCS: "Obtém um identificador prefixado 
        // único baseado no tempo atual em microsegundos."
        $novoNome = uniqid() . ".$extensao";

        if (in_array($extensao, $arrayExtensoes)) {
            // Abre uma stream e move o raquivo. 
            move_uploaded_file($temp_file, $pasta . $novoNome);

            if ($nome != false && $idade != false) {
                echo "Nome: " . $nome . "<br>";
                echo "Idade: " . $idade . "<br>";
                echo "Foto: <br> <img src=\"./arquivos/" . $novoNome . "\"><br>";
            }
        }
    }
    ?>
</body>

</html>