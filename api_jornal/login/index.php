<?php
    include("../connection/connection.php");

    // if (isset($_POST["email"]) && 
    // isset($_PSOT["password"]) && 
    // !empty($_GET["email"]) && 
    // !empty($_GET["password"])) {

        $dados = file_get_contents("php://input");
        $dados = json_decode($dados,TRUE);
       
        $email = $dados["email"];
        $password = $dados["password"];

        // echo "<pre>";
        // print_r($dados);
        // echo "</pre>";

        try{
            $sql = "SELECT e_mail, habilita, cargo, nome FROM usuarios WHERE e_mail = :e_mail AND senha= :password";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":e_mail", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();

            $dado = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($dado)){
                
                $result['login'] = $dado;
                $result["status"] = "success";
                echo json_encode($result);
                
            }else{
                echo json_encode(array("status"=>"fail"));
            }

            
        }catch(PDOException $ex){
            die("ERROR: ". $ex->getMessage());
        }

    // }else{
    //     // retornar erro (false)
    //     echo "erro falta informação";
    // }
    


?>