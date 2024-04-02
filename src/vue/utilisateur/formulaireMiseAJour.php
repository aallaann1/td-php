<form action="controleurFrontal.php" method="get">
    <fieldset>
        <legend>Mon formulaire :</legend>

        <p>
    <label for="login">Login :</label>
    <input type="text" id="login" name="login" readonly value="<?php
    /** @var TYPE_NAME $utilisateur */
    echo htmlspecialchars($utilisateur->getLogin()); ?>">
        </p>

    </br>
        <p>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur->getNom()); ?>">
        </p>

    </br>

        <p></p>
    <label for="prenom">Prenom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur->getPrenom()); ?>">
        </p>

    </br>

        <p>
    <label for="ancien_mot_de_passe">Ancien Mot de passe :</label>
    <input type="password" id="ancien_mot_de_passe" name="ancien_mdp">
        </p>

    </br>

        <p>
    <label for="nouveau_mot_de_passe">Nouveau Mot de passe :</label>
    <input type="password" id="nouveau_mot_de_passe" name="nouveau_mdp">
        </p>

    </br>

        <p>
    <label for="confirmer_mot_de_passe">Confirmer le Nouveau Mot de passe :</label>
    <input type="password" id="confirmer_mot_de_passe" name="confirmer_mdp">
        </p>

    </br>

    <p>
        <input type="hidden" name="action" value="mettreAJour">
        <input type="hidden" name="controleur" value="utilisateur">
        <input type="submit" value="envoyer">
    </p>
    </fieldset>
</form>
