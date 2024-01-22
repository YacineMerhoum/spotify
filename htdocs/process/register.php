<?php
session_start();

if (!empty($_POST['pseudo'])
    && !empty($_POST['passWord']) ) {
        
        require_once '../config/connexion.php';

        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $preparedRequestCreateUser = $connexion->prepare(
            "INSERT INTO users (`pseudo`, `passWord`) VALUES (?,?)"
        );
        $preparedRequestCreateUser->execute([
            $_POST["pseudo"],
            $hashed_password,
        ]);

        $_SESSION['id'] = $connexion->lastInsertId();
        $_SESSION['pseudo'] = $_POST["pseudo"];

        header('Location: ../index.php?success=Votre compte a bien été créé !');
}else{
    header('Location: ../process/register.php?error=Erreur dans la création du compte');

}