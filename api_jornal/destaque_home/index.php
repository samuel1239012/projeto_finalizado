<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $method = $_SERVER["REQUEST_METHOD"];
    include("../connection/connection.php");
    include("../valida_token.php");

    if($method == "GET"){
        //echo "GET";

        if (!isset($_GET["id"])){

            // listar todos os registros
            try {
                
                $sql = "SELECT n.titulo, n.sub_titulo, n.texto, n.imagem, dh.habilita, dh.pk_id FROM noticia n 
                INNER JOIN destaque_home dh ON n.pk_id=dh.fk_noticia";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $dados = $stmt->fetchall(PDO::FETCH_OBJ);

                $result["destaque_home"]=$dados;
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

                $sql= "SELECT pk_id, fk_noticia, fk_redacao, habilita
                        FROM destaque_home
                        WHERE pk_id=:id";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();

                $dado = $stmt->fetch(PDO::FETCH_OBJ);
                $result['destaque_home'] = $dado;
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
        $fk_noticia = trim($dados->fk_noticia); // acessa valor de um OBJETO
        $fk_redacao = trim($dados->fk_redacao); // acessa valor de um OBJETO
        $habilita = trim($dados->habilita); // acessa valor de um OBJETO

        try {
            if(empty($destaque_home) ){
                // está vazio  : ERRO
                throw new ErrorException("Valor inválido", 1);
            }
            
            $sql = "INSERT INTO destaque_home(fk_noticia, fk_redacao, habilita) 
                    VALUES (:fk_noticia, :fk_redacao, :habilita)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":fk_noticia", $fk_noticia);
            $stmt->bindParam(":fk_redacao", $fk_redacao);
            $stmt->bindParam(":habilita", $habilita);
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
    //começa outro Post
    
    //termina o Post
    if($method=="PUT"){
        // recupera dados do corpo (body) de uma requisão PUT
        $dados = file_get_contents("php://input");

        // decodifica JSON, sem opção TRUE
        $dados = json_decode($dados); // isso retorna um OBJETO 

        
        try {

            if(empty($dados->id) ){
                // está vazio  : ERRO
                throw new ErrorException("ID é um campo obrigatório", 1);
            }
            // }
         
           // função trim retira espaços que estão sobrando
        
           $id = trim($dados->id); // acessa valor de um OBJETO
           $habilita = trim($dados->habilita);
        //    $titulo = trim($dados->titulo);
        //    $imagem = trim($dados->imagem);
            
           
            $sql = "UPDATE destaque_home SET habilita=:habilita   
                    WHERE pk_id=:id";

          
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":habilita", $habilita);
            $stmt->bindParam(":id", $id);
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
   
?>