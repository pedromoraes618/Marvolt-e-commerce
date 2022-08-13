<header>


   
    <div id="header_central">
        <?php if($_SESSION["user_portal"]){

            $user= $_SESSION["user_portal"];
            $saudacao = "SELECT cl_nome FROM tb_user where cl_id = {$user}";
            $saudacao_login = mysqli_query($conecta,$saudacao);
            if (!$saudacao_login){
                die ("Falha no banco de dados");
            }
            $saudacao_login = mysqli_fetch_assoc($saudacao_login);
            $nome = $saudacao_login['cl_nome'];
          

        ?>

        <div id="header_saudacao"><h5>Bem vindo, <?php echo ucfirst($nome); ?> - <a href="../../../marvolt/sair.php">Sair</a></h5>

        <?php    
        }
        ?>
      
      
    </div>
    

</header>