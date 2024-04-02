<form method="get" action="controleurFrontal.php">
    <fieldset>
        <legend>Mon formulaire :</legend>

        <p>
            <label for="login_id">Login</label> :
            <input type="text" placeholder="nomp" name="login" id="login_id" required/>
        </p>
        </br>
        <p>
            <label for="nom_id">Nom</label> :
            <input type="text" placeholder="Nom" name="nom" id="nom_id" required/>
        </p>
        </br>
        <p>
            <label for="prenom_id">Prenom</label> :
            <input type="text" placeholder="Prenom" name="prenom" id="prenom_id" required/>
        </p>
        </br>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="mdp_id" required>
        </p>
        </br>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Vérification du mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp2" id="mdp2_id" required>
        </p>
        </br>
        <p>
            <input type="hidden" name="action" value="creerDepuisFormulaire">
            <input type="hidden" name="controleur" value="utilisateur">
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
