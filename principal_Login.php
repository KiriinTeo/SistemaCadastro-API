<?php include_once("cabec.php");  ?>

<p>&nbsp;</p>

<h2 align="center" class="cor_texto"> Novo Cadastro</h2>

<form action="inserir_cad.php" method="POST" class="form card-body row border-dark justify-content-center">
    <div class="col-lg-8 col-sm-12">
        <div class="row g-3 align-items-center">
            <div class="col-lg-2 col-sm-12 ">
                &nbsp;
            </div>
            <div class="col-auto">
                <label for="novaMail" class="col-form-label corTextoInverso"> Email:  </label>
            </div>
            <div class="col-auto">
                <input type="email" id="novaMail" name="email" size="80" class="form-control" aria-describedby="textoHelpEmail" required>
            </div>
        </div>
        
        <p>&nbsp;</p>
        
        <div class="row g-3 align-items-center">
            <div class="col-lg-2 col-sm-12 ">
                &nbsp;
            </div>
            <div class="col-auto">
                <label for="novaSenha" class="col-form-label corTextoInverso"> Senha:</label>
            </div>
            <div class="col-auto">
                <input type="password" id="novaSenha" name="senha" size="80" class="form-control" aria-describedby="textoHelpSenha" required>
            </div>
        </div>
        
        <p>&nbsp;</p>

        <div class="row g-3 justify-content-center">
            <button type="submit" class="btn btn-lg cor_barra cor_texto_barra btn-block col-lg-3"> Cadastrar </button>    
        </div>
    </div>
</form>

<p>&nbsp;</p>
