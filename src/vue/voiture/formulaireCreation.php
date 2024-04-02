<form method="get" action="controleurFrontal.php">
    <fieldset>
        <legend>Mon formulaire :</legend>

        <p>
            <label for="immat_id">Immatriculation</label> :
            <input type="text" placeholder="256AB34" name="immatriculation" id="immat_id" required/>
        </p>
        </br>
        <p>
            <label for="marque_id">Marque</label> :
            <input type="text" placeholder="Audi" name="marque" id="marque_id" required/>
        </p>
        </br>
        <p>
            <label for="couleur_id">Couleur</label> :
            <input type="text" placeholder="Noir" name="couleur" id="couleur_id" required/>
        </p>
        </br>
        <p>
            <label for="place-id">Nombre de places</label> :
            <input type="number" placeholder="5" name="place" id="place-id" required/>
        </p>
        </br>
        <p>
            <input type="hidden" name="action" value="creerDepuisFormulaire">
            <input type="hidden" name="controleur" value="voiture">
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
