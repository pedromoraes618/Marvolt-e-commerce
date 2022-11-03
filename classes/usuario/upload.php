<?php


 /* formatos de imagem permitidos */
 $permitidos = array(".jpg",".jpeg",".png");

     $retorno = array();
     $nome_imagem    = $_FILES['file-input']['name'];
     $tamanho_imagem = $_FILES['file-input']['size'];

     /* pega a extensão do arquivo */
     $ext = strtolower(strrchr($nome_imagem,"."));

     /*  verifica se a extensão está entre as extensões permitidas */
     if(in_array($ext,$permitidos)){
         /* converte o tamanho para KB */
         $tamanho = round($tamanho_imagem / 1024);

         if($tamanho < 1024){ //se imagem for até 1MB envia
             $nome_atual = md5(uniqid(time())).$ext;
            
             //caminho temporário da imagem
             copy($_FILES['file-input']['tmp_name'], '../../img/clientes/'.$nome_atual);
             $retorno['sucesso'] =  true;
              //nome que dará a imagem
             $retorno['name_arquivo']  = $nome_atual;
             /* se enviar a foto, insere o nome da foto no banco de dados */
         }else{
             $retorno['alert'] =  "A imagem deve ser de no máximo 1MB";
         }
     }else{
        $retorno['alert'] =  "Somente são aceitos arquivos do tipo Imagem";
     }
 

echo json_encode($retorno);


//


    ?>