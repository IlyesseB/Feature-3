<?php
session_start();

require_once('connect.php');

$sql = 'SELECT id, nom, prenom, idModeleTrott FROM `Visiteur` ORDER BY `idModeleTrott` DESC';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Visiteur</title>

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
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste des Visiteur</h1>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Id trottinette électrique</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $prenom){
                        ?>
                            <tr>
                                <td><?= $prenom['id'] ?></td>
                                <td><?= $prenom['prenom'] ?></td>
                                <td><?= $prenom['nom'] ?></td>
                                <td><?= $prenom['idModeleTrott'] ?></td>
                                <td><a href="edit.php?prenom=<?= $prenom['prenom'] ?>&nom=<?= $prenom['nom'] ?>">Modifier</a></td>
                                
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>