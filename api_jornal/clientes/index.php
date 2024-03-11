<?php
 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
    $method = $_SERVER["REQUEST_METHOD"];
    include("../connection/connection.php");
    include("../valida_token.php");

 
    if($method == "GET"){
        //echo "GET";

        //Validar login do cliente
        if (!empty($_GET["email"]) && !empty($_GET["senha"])){

            $email = trim($_GET["email"]);
            $senha = hash("sha256", base64_decode(trim($_GET["senha"])));

            try {
                $sql = "
                SELECT pk_id, nome
                FROM clientes
                WHERE email LIKE :email
                AND senha LIKE :senha
                 ";

                $stmt = $conn->prepare($sql);
                $stmt -> bindParam(":email", $email);
                $stmt -> bindParam(":senha", $senha);
                $stmt -> execute();

                $dados = $stmt->fetch(PDO::FETCH_OBJ);

             if($dados){
                $result["clientes"]=$dados;
                $result["status"]="success";
             }else{
                $result =["status"=> "fail", "error"=> "E-mail e/ou senha inválidos"];
             }

            } catch (PDOException $ex) {
                // echo "error: ". $ex->getMEssage();
                $result =["status"=> "fail", "error"=> $ex->getMEssage()];
                http_response_code(200);
            }finally{
                $conn = null;
                echo json_encode($result);
            }
            
            
        }elseif (!isset($_GET["id"])){
 
       
 
            // listar todos os registros
            try {
               
                $sql = "SELECT pk_id, nome ,email ,cpf ,whatsapp, habilita
                        FROM clientes";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
 
                $dados = $stmt->fetchall(PDO::FETCH_OBJ);
 
                $result["clientes"]=$dados;
                $result["status"] = "success";
 
                http_response_code(200);
 
            } catch (PDOException $ex) {
                // echo "error: ". $ex->getMEssage();
                $result =["status"=> "fail", "error"=> $ex->getMEssage()];
                http_response_code(200);
            }finally{
                $conn = null;
                echo json_encode($result);
            }
        }else{
            // listar um registro
            try{
 
                if(empty($_GET["id"]) || !is_numeric($_GET["id"])){
                    // está vazio ou não é numérico : ERRO
                    throw new ErrorException("Valor inválido", 1);
                }
                $id = $_GET["id"];
 
                $sql = "SELECT pk_id, nome ,email ,cpf ,whatsapp, habilita
                        FROM clientes
                        WHERE pk_id=:id";
               
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
 
                $dado = $stmt->fetch(PDO::FETCH_OBJ);
                $result['clientes'] = $dado;
                $result["status"] = "success";
 
            }catch(PDOException $ex){
                $result =["status"=> "fail", "error"=> $ex->getMEssage()];
                http_response_code(200);
            }catch(Exception $ex){
                $result =["status"=> "fail", "error"=> $ex->getMEssage()];
                http_response_code(200);
            }finally{
                $conn = null;
                echo json_encode($result);
            }
           
        }
        
        
 
       
    }
    if($method=="POST"){
       
        // recupera dados do corpo (body) de uma requisão POST
        $dados = file_get_contents("php://input");
 
        // decodifica JSON, sem opção TRUE
        $dados = json_decode($dados); // isso retorna um OBJETO
 
        // função trim retira espaços que estão sobrando
        $email = trim($dados->email); // acessa valor de um OBJETO
        $nome = trim($dados->nome); // acessa valor de um OBJETO
        $senha = hash("sha256",trim($dados->senha)); // acessa valor de um OBJETO
        $cpf = trim($dados->cpf); // acessa valor de um OBJETO
        $whatsapp = trim($dados->whatsapp);

        try {

            $curl = curl_init();
            $cpf_token = '6708%7CHyuYJ08gTJukpgyO6HSKBLnE1rFMGrpL';
            $end_point_cpf= 'https://api.invertexto.com/v1/validator';

            curl_setopt_array($curl, array(
              CURLOPT_URL => $end_point_cpf.'?token='.$cpf_token.'&value='.$cpf,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);

        
            $response = json_decode($response);

            if(!$response->valid){
                // teste: validaçaõ do email (formato)
                throw new ErrorException("CPF INVÁLIDO", 1);
                
            }
           

            
   
           
            $sql = "INSERT INTO clientes(email,senha,cpf,whatsapp,nome )
                    VALUES (:email, :senha ,:cpf ,:whatsapp, :nome)";
 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":whatsapp", $whatsapp);
            $stmt->bindParam(":cpf", $cpf);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->execute();
 
            $result = array("status"=>"success");
 
        } catch (PDOException $ex) {
            $erro = $ex-> errorInfo[1];
            if($erro == 1062){
                $result =["status"=> "fail", "error"=> "Erro de Inserção: Dados Duplicados"];
            }else{
                $result =["status"=> "fail", "error"=> $ex->getMEssage()];
            }
            http_response_code(200);
        }catch(Exception $ex){
            $result =["status"=> "fail", "error"=> $ex->getMEssage()];
            http_response_code(200);
        }finally{
            $conn = null;
            echo json_encode($result);
        }
 
 
 
    }
    if($method=="PUT"){
        // recupera dados do corpo (body) de uma requisão POST
        $dados = file_get_contents("php://input");
 
        // decodifica JSON, sem opção TRUE
        $dados = json_decode($dados); // isso retorna um OBJETO
 
        // função trim retira espaços que estão sobrando
        $email = trim($dados->email); // acessa valor de um OBJETO
        $nome = trim($dados->nome); // acessa valor de um OBJETO
        $senha = trim($dados->senha); // acessa valor de um OBJETO
        $cpf = trim($dados->cpf); // acessa valor de um OBJETO
        $whatsapp = trim($dados->whatsapp);
        $id = trim($dados->id);
       
        try {
            if(empty($email) ){
                // está vazio  : ERRO
                throw new ErrorException("E-mail inválido", 1);
            }

            $curl = curl_init();
            $cpf_token = '6708%7CHyuYJ08gTJukpgyO6HSKBLnE1rFMGrpL';
            $end_point_cpf= 'https://api.invertexto.com/v1/validator';

           curl_setopt_array($curl, array(
             CURLOPT_URL => $end_point_cpf.'?token='.$cpf_token.'&value='.$cpf,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'GET',
           ));
           
           $response = curl_exec($curl);
           curl_close($curl);

           $response = json_decode($response);
           
           if(!$response->valid){
               // teste: validaçaõ do email (formato)
               throw new ErrorException("CPF INVÁLIDO", 1);
               
           }
            
           
            if (!empty($senha)){
                $sql = "UPDATE clientes SET email=:email, senha=:senha, cpf=:cpf, whatsapp=:whatsapp, nome=:nome
                WHERE pk_id=:id";


                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":whatsapp", $whatsapp);
                $stmt->bindParam(":cpf", $cpf);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":senha", $senha);
                $stmt->bindParam(":id", $id);
 
            }else{
                $sql = "UPDATE clientes SET email=:email, cpf=:cpf, whatsapp=:whatsapp, nome=:nome
                        WHERE pk_id=:id";
                 $stmt = $conn->prepare($sql);
                $stmt->bindParam(":whatsapp", $whatsapp);
                $stmt->bindParam(":cpf", $cpf);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":id", $id);
 
            }
           
            $stmt->execute();
 
            $result = array("status"=>"success");
 
        } catch (PDOException $ex) {
            $result =["status"=> "fail", "error"=> $ex->getMEssage()];
            http_response_code(200);
        }catch(Exception $ex){
            $result =["status"=> "fail", "error"=> $ex->getMEssage()];
            http_response_code(200);
        }finally{
            $conn = null;
            echo json_encode($result);
        }
 
    }
 
    if($method=="DELETE"){
        try{
 
            if(empty($_GET["id"]) || !is_numeric($_GET["id"])){
                // está vazio ou não é numérico : ERRO
                throw new ErrorException("Valor inválido", 1);
            }
            $id = $_GET["id"];
 
            $sql= "DELETE FROM clientes  
                    WHERE pk_id=:id";
           
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
           
            $result["status"] = "success";
 
        }catch(PDOException $ex){
            $result =["status"=> "fail", "error"=> $ex->getMEssage()];
            http_response_code(200);
        }catch(Exception $ex){
            $result =["status"=> "fail", "error"=> $ex->getMEssage()];
            http_response_code(200);
        }finally{
            $conn = null;
            echo json_encode($result);
        }
     
    }
 
 
 
 
 
 
 
?>