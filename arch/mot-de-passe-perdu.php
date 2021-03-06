<?php include '../layout/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Mot de passe perdu</h2>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <div class="col-sm-4">
                        <h4>Vous avez perdu votre mot de passe ?</h4>
                        <em>
                            Compléter le formulaire, un email vous seras envoyé.<br />
                            Il contiendra la procèdure à suivre pour récupérer votre mot de passe.
                        </em>
                    </div>
                    
                    <div class="col-sm-offset-2 col-sm-4 ">
                        <form action="nouveau-mot-de-passe.php">
                            <label>Adresse email</label>
                            <input type="text" name="email" id="email">
                            <br />
                            <button class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>