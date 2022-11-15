<?php 
session_start();

    // Etablir une connection avec la base de données
    require __DIR__ . "/db/connection.php";

    // Effectuer la requête de récupération des données de la table film
    $req = $db->prepare("SELECT * FROM film ORDER BY created_at DESC");
    $req->execute();
    $films = $req->fetchAll();
?>

<?php $title = "Acceuil"; ?>
<?php include "partials/head.php"; ?>

<?php include "partials/nav.php"; ?>   

<!-- Le main représente le contenu spécifique à cette page -->
    <main class="container-fluid">
        <h1>Liste des films</h1>

        <!-- <?php var_dump($_SESSION['success']); ?> -->

        <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']);?>
        <?php endif?>    

        <div class="btn-container">
            <a href="create.php" class="btn btn-primary">Ajouter films</a>
        </div>

        <div class="card-container">
            <?php if( isset($films) && !empty($films)) : ?>
                <?php foreach ($films as $film) : ?>
                    <div class="card">
                        <h2>Film numéro : <?= htmlspecialchars($film['id']) ?></h2>
                        <hr/>
                        <h2>Nom : <?= htmlspecialchars($film['name']) ?> </h2>
                        <p>Acteur(s) : <?= htmlspecialchars($film['actors']) ?></p>
                        <p>Note: <?= htmlspecialchars($film['review']) ?></p>
                        <a href="edit.php?film_id=<?php echo htmlspecialchars($film['id'])?>">Modifier</a>
                        <a href="delete.php?film_id=<?php echo htmlspecialchars($film['id']) ?>" onclick="return confirm('Confirmer la supression?')">Supprimer</a>
                    </div>
                <?php endforeach ?>

            <?php else : ?>
                <p class="film-none">Aucun film ajouté à la liste</p>
            <?php endif?>
                
        </div>
    </main>

<?php include "partials/footer.php"; ?>  

<?php include "partials/foot.php"; ?>    
    
