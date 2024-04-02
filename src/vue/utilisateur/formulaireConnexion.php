<form method="get" action="controleurFrontal.php">
    <fieldset>
        <legend>Mon formulaire :</legend>

        <p>
            <label for="login_id">Login</label> :
            <input type="text" placeholder="nomp" name="login" id="login_id" required/>
        </p>

        </br>

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe</label> :
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="mdp_id" required>
        </p>

        </br>

        <p>
            <input type="hidden" name="action" value="connecter">
            <input type="hidden" name="controleur" value="utilisateur">
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
