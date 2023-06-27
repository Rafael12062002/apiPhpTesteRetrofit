<?php
header('Content_type: application/json');

//Conexão com o banco de dados
require_once('connectdb.php');

//Definir UTF8 para conexão
mysqli_set_charset($conn, $charset)

 $response = array();

 $statement = mysqli_prepare($conn, "SELECT id, Email, Senha FROM usuario");

mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $id, $Email, $Senha);

//Executa o dumb do objeto. Não retorna as consultas, como sigla, nome etc
//var_dump($statement);

//Verifica se existem registros no banco de dados e transforma em json
if (mysqli_stmt_num_rows($statement) > 0) {

    while (mysqli_stmt_fetch($statement)) {
        array_push($response, array(
            "id" => $id,
            "nome" => $Email,
            "senha" => $Senha)
        );
    }
    echo json_encode($response);
}else {
    echo json_encode($response);
}
?>