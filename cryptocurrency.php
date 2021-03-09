<?php
include_once "header.php";
include_once "database.php";

$id = (int) $_GET['id'];

$query = "SELECT* FROM cryptocurrencies WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

if($stmt->rowCount() != 1){
    header("Location: index.php");
    die();
}
$crypto = $stmt->fetch();

?>


<?php
//prikaže povezavo samo administratorjem
if(admin()){
?>
<a href="cryptocurrency_delete.php?id=<?php echo $crypto['id'];?>" class="btn btn-primary"
    onclick="return confirm('Prepričani?')">Izbriši</a>
<a href="cryptocurrency_edit.php?id=<?php echo $crypto['id'];?>" class="btn btn-primary">Uredi</a>
<?php
}
?>
<section class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="<?php echo $crypto['logo'];?>" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0"><?php echo $crypto['title'];?></h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0"><?php echo $crypto['description'];?></p>
        <div class="cypro_price">Treuntna cena: <span><?php echo $crypto['current_price'];?> </span></div>
        <div class="cypro_rating">Treuntna ocena: <span><?php echo round($crypto ['rating'],1);?> </span></div>
    </div>
    </div>
    <?php
    if(admin()){
    ?>
    <div class="upload_slik">
        <form action="image_insert.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $crypto['id'];?>" />
            <input type="text" name="title" placeholder="Vnesi naslov fotografije" /><br />
            <input type="file" name="url" requiered="requiered"><br />
            <input type="submit" value="Naloži" />
        </form>
    </div>
    <?php
    }
    ?>
</section>
<div class="container">
<?php
    $query = "SELECT * FROM images WHERE  cryptocurrency_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $st = $stmt->rowCount();

    if($st>0){

    ?>
<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php  
for($i=0;$i<$st;$i++){
    if ($i==0)
echo '<li data-target="#carouselExampleCaptions" data-slide-to="'.$i.'" class="active"></li>';
else
echo '<li data-target="#carouselExampleCaptions" data-slide-to="'.$i.'"></li>';
}
?>
        </ol>
        <div class="carousel-inner">
        <?php
        $i=0;
        while($row=$stmt->fetch()){
            if ($i==1){
            echo '<div class="carousel-item active">'."\n";
            }
            else{
                echo '<div class="carousel-item">'."\n";
            }
            echo '<img src="'.$row['url'].'" class="d-block w-100" alt="slika">'."\n";
            echo '<div class="carousel-caption d-none d-md-block">'."\n";
            echo '<h5>'.$row['title'].'</h5>'."\n";
            echo '</div>'."\n";
            echo '</div>'."\n";
            $i++;
        }
        ?>
            
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Predhodnje</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Naslednje</span>
        </a>
    </div>
</div>
<?php
}
?>
</div>
<div class="container d-flex justify-content-center mt-20">
    <div class="row">
        <div class="col-md-12">
            <div class="stars">
                <form action="rate_insert.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $crypto['id'];?>" />
                    <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                    <label class="star star-5" for="star-5"></label>
                    <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
                    <label class="star star-4" for="star-4"></label>
                    <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                    <label class="star star-1" for="star-1"></label>
                    <input type="submit" value="Glasuj" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>
<div class="komentarji" id="komentarji">
    <div class="obrazec">
        <form action="comment_insert.php" method="post">
            <input type="hidden" name="id" value="<?php echo $crypto['id'];?>" />
            <textarea name="content" rows="5" cols="15"></textarea> </br>
            <input type="submit" value="Komentiraj" class="btn btn-primary" />
        </form>
    </div>
    <div class="seznam">
        <?php
    $query = "SELECT * FROM comments WHERE cryptocurrency_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    while($row = $stmt->fetch()){
        echo '<div class="komentar">';
        if($_SESSION['user_id'] == $row['user_id']){
        echo '<a href="comment_delete.php?id= ' .$row['id'].'" onclick="return confirm(\'Prepričani?\')">x</a>';
        echo '<div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal'.$row['id'].'">u</div>';
        echo '<div class="portfolio-modal modal fade" id="portfolioModal'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">';
        echo '<div class="modal-dialog modal-xl" role="document">';
        echo '<div class="modal-content">';
        echo '<button class="close" type="button" data-dismiss="modal" aria-label="Close">';
        echo '<span aria-hidden="true"><i class="fas fa-times"></i></span>';
        echo '</button>';
        echo '<div class="modal-body text-center">';
        echo '<div class="container">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-lg-8">';
        echo '<!-- Portfolio Modal - Title-->';
        echo '<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Uredi komentar</h2>';
        echo '<!-- Icon Divider-->';
        echo '<div class="divider-custom">';
        echo '<div class="divider-custom-line"></div>';
        echo '<div class="divider-custom-icon"><i class="fas fa-star"></i></div>';
        echo '<div class="divider-custom-line"></div>';
        echo '</div>';
        echo '<form action="comment_update.php" method="post">';
        echo '<input type="hidden" name="id" value="'.$row['id'].'" />';
        echo '<textarea name="content" rows="5" cols="25">'.$row['content'].'</textarea> </br>';
        echo '<input type="submit" value="Uredi" class="btn btn-primary" />';
        echo '</form>';
        echo '<button class="btn btn-primary" data-dismiss="modal">';
        echo '<i class="fas fa-times fa-fw"></i>';
        echo 'Close Window';
        echo '</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';


    }
        echo '<div class="oseba">'.getFullName($row['user_id']).' ('.date("j. n. Y H:i",strtotime($row['date_modify'])).')</div>';
        echo '<div class="vsebina">'.$row['content'].'</div>';
        echo '</div>';
    }
    ?>

    </div>
</div>

<?php
include_once "footer.php";
?>