<?php
session_start();

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        require_once('connect.php');
        var_dump ($_GET);
        var_dump ($_POST);
        $id = strip_tags($_POST['id']);
        $prenom = strip_tags($_GET['prenom']);
        $nom = strip_tags($_GET['nom']);


        $sql = 'UPDATE `Visiteur` SET `idModeleTrott`=:id WHERE `prenom`=:prenom AND `nom`=:nom; ';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id,  PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom,  PDO::PARAM_STR);
        $query->bindValue(':nom', $nom,  PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Visiteur modifié";
        require_once('close.php');
        header('Location: index.php');
        
    }
} else { 

    if(isset($_GET['prenom']) && !empty($_GET['prenom']) && isset($_GET['nom']) && !empty($_GET['nom'])){
        require_once('connect.php');
    
        $prenom = strip_tags($_GET['prenom']);
        $nom = strip_tags($_GET['nom']);
    
        $sql = 'SELECT idModeleTrott FROM `SPECTROTT`';
    
        $query = $db->prepare($sql);
    
        $query->execute();
    
        $prenom = $query->fetchAll();
    
    }else{
        $_SESSION['erreur'] = "URL invalide";
        header('Location: index.php');
    }

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Visiteur</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier un Visiteur</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="idModeleTrott">Id trotinette</label><br>
                        <select name="id">
                            <?php 
                            foreach ($prenom as $prenom) { ?>
                            <option><?= $prenom['idModeleTrott'] ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type ="submit"></input>
                </form>
            </section>
        </div>
    </main>
</body>
</html>