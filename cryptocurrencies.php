<?php
include_once "header.php";
?>
<a href="cryptocurrencies_add.php" class="btn btn-primary">Dodaj valuto</a>
<br />

<section class="page-section portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Kripto valute</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <?php
            include_once "database.php";
            $query = "SELECT * FROM cryptocurrencies";

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            while($row = $stmt->fetch()){
              echo '<div class="col-md-6 col-lg-4 mb-5">';
              echo '<div class="portfolio-item mx-auto">';
              echo '<a href="cryptocurrency.php?id='.$row['id'].'">';
              echo '<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">';
              echo '<div class="portfolio-item-caption-content text-center text-white">'.$row['current_price'].'</div>';
              echo '</div>';
              echo '<img class="img-fluid" src="'.$row['logo'].'" alt="" />';
              echo '<h3 class="justify-content-center row align-items-center">'.$row['title'].'</h3>';
              echo '</div>';
              echo '</div>';
             }
?>
            <!-- Portfolio Item 1-->
           
        </div>
    </div>
</section>



<?php
include_once "footer.php";
?>