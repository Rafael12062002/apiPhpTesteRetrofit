oi
<?php

include "./connectdb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-type: application/json');

    //Recuperar dados necessários

    $json = file_get_contents("php://input");

    $data = json_decode($json);

    $Email = $data->Email;
    $Senha = $data->Senha;


    //$api_token = $_POST['api_token'];
    
    $headers = getallheaders();
    $valueToken=$headers['Authorization'];


    $tokenSplited=str_split($valueToken,7);


    if ($tokenSplited[1] == '123') {
        require_once('connectdb.php');
        mysqli_set_charset($conn, $charset);

        $response = array();

        //verifica se o registro existe
        $selectQuery = "SELECT * FROM usuario WHERE Email = '$Email' AND Senha = '$Senha'";
        $selectResult = mysqli_query($conn, $selectQuery);

        if (mysqli_num_rows($selectResult) > 0) {
            //O registro já existe
            $response["inserido"] = false;
            $response["mensagem"] = "Registro já existe";
            $test = json_encode($response);
            echo $test;
        }else {
          
            //Atualizar os campos na tabela usuario
            $sql = "INSERT INTO usuario (Email, Senha) VALUES ('$Email', '$Senha')";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_execute($stmt);

            // Verifica se algo foi deletado
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $response["inserido"] = true;
                    $test = json_encode($response);
                    
                }else {
                    $response["inserido"] = false;
                    $response["SQL"] = $sql;
                    $response["error"] = mysqli_error($conn);
                    $test = json_encode($response);
                }
                echo $test;
            }
        
        }else {
            $response['auth_token'] = false;
            echo json_encode($response);
        }
    }
?>