<?php include '../layout/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Mot de passe perdu</h2>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <div class="col-sm-4">
                        <h4>Récupération du mot de passe ?</h4>
                        <em>
                            Compléter le formulaire, votre mot de passe sera alors réinitialiser.<br /><br />
                            Une fois validé, vous devrez utiliser le nouveau mot de passe que vous avez défini.
                        </em>
                    </div>
                    
                    <div class="col-sm-4 col-sm-offset-2 ">
                        <form action="nouveau-mot-de-passe.php">
                            <label>Nouveau mot de passe</label>
                            <input type="password">
                            <label>Confirmer</label>
                            <input type="password">
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