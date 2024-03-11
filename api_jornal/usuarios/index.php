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
 
        if (!isset($_GET["id"]) && !isset($_GET["email"])){
 
            //  nao tem ID e listar todos os registros
            try {
               
                $sql = "SELECT pk_id, e_mail, habilita, cargo, cpf, nome
                        FROM usuarios";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
 
                $dados = $stmt->fetchall(PDO::FETCH_OBJ);
 
                $result["usuarios"]=$dados;
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
        }
        else{

            if(isset($_GET["id"])){
                try{
    
                    if(empty($_GET["id"]) || !is_numeric($_GET["id"])){
                        // está vazio ou não é numérico : ERRO
                        throw new ErrorException("Valor inválido", 1);
                    }
                    $id = $_GET["id"];
    
                    $sql = "SELECT pk_id, e_mail, habilita, cargo ,cpf, nome
                            FROM usuarios
                            WHERE pk_id=:id";
                
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":id", $id);
                    $stmt->execute();
    
                    $dado = $stmt->fetch(PDO::FETCH_OBJ);
                    $result['usuarios'] = $dado;
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
            if(isset($_GET["email"])){
               
                try{
    
                    if(empty($_GET["email"])){
                        // está vazio ou não é numérico : ERRO
                        throw new ErrorException("Valor Não informado", 1);
                    }
                    $email = $_GET["email"];
    
                    $sql = "SELECT pk_id, e_mail, habilita, cargo, cpf, nome
                            FROM usuarios
                            WHERE e_mail=:email";
                
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":email", $email);
                    $stmt->execute();
    
                    $dado = $stmt->fetch(PDO::FETCH_OBJ);
                    $result['usuarios'] = $dado;
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
 
       
    }
    if($method=="POST"){
       
        // recupera dados do corpo (body) de uma requisão POST
        $dados = file_get_contents("php://input");
 
        // decodifica JSON, sem opção TRUE
        $dados = json_decode($dados); // isso retorna um OBJETO
 
        // função trim retira espaços que estão sobrando
        $e_mail = trim($dados->e_mail); // acessa valor de um OBJETO
        $cargo = trim($dados->cargo); // acessa valor de um OBJETO
        $senha = trim($dados->senha); // acessa valor de um OBJETO
        $cpf = trim($dados->cpf); 
        $nome = trim($dados->nome);
        $habilita = trim($dados->habilita); // acessa valor de um OBJETO
       
 
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



            if(empty($e_mail) ){
                // está vazio  : ERRO
                throw new ErrorException("E-mail inválido", 1);
            }


           
            $sql = "INSERT INTO usuarios(e_mail, cargo,senha, cpf, habilita, nome)
                    VALUES (:e_mail, :cargo, :senha, :cpf, :habilita, :nome)";
 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":e_mail", $e_mail);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":habilita", $habilita);
            $stmt->bindParam(":cargo", $cargo);
            $stmt->bindParam(":cpf", $cpf);
            $stmt->bindParam(":nome", $nome);
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
         $e_mail = trim($dados->e_mail); // acessa valor de um OBJETO
         $senha = trim($dados->senha); // acessa valor de um OBJETO
         $habilita = trim($dados->habilita); // acessa valor de um OBJETO
         $cargo = trim($dados->cargo); // acessa valor de um OBJETO
         $cpf = trim($dados ->cpf);
         $nome = trim($dados ->nome);
         if(isset($dados->codigo)){
            $codigo = trim($dados->codigo);
         }else{
            $codigo="";
         }
         $id = trim($dados->id); // acessa valor de um OBJETO
       
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

            if(empty($e_mail) ){
                // está vazio  : ERRO
                throw new ErrorException("E-mail inválido", 1);
            }
            if(strlen($codigo) > 0){
                $sql = "UPDATE usuarios SET codigo=:codigo
                        WHERE pk_id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":codigo", $codigo);
                $stmt->bindParam(":id", $id);
        

            }else if(!empty($senha)){
           
                $sql = "UPDATE usuarios SET e_mail=:e_mail, senha=:senha, habilita=:habilita, cargo=:cargo, cpf=:cpf, nome=:nome
                        WHERE pk_id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":e_mail", $e_mail);
                $stmt->bindParam(":senha", $senha);
                $stmt->bindParam(":habilita", $habilita);
                $stmt->bindParam(":cargo", $cargo);
                $stmt->bindParam(":cpf", $cpf);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":nome", $nome);
 
            }else{
                $sql = "UPDATE usuarios SET e_mail=:e_mail, habilita=:habilita, cargo=:cargo, cpf=:cpf, nome=:nome
                        WHERE pk_id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":e_mail", $e_mail);
                $stmt->bindParam(":habilita", $habilita);
                $stmt->bindParam(":cargo", $cargo);
                $stmt->bindParam(":cpf", $cpf);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":nome", $nome);
            }
           
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
 
    if($method=="DELETE"){
        try{
 
            if(empty($_GET["id"]) || !is_numeric($_GET["id"])){
                // está vazio ou não é numérico : ERRO
                throw new ErrorException("Valor inválido", 1);
            }
            $id = $_GET["id"];
 
            $sql= "DELETE FROM usuarios  
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