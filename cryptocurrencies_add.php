<?php
include_once "header.php";
?>

<section class="page-section">
    <div class="container">
        <!-- Registration Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Dodaj kripto valuto</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Registration Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                <form action="cryptocurrency_insert.php" method="post" enctype="multipart/form-data">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Ime</label>
                            <input class="form-control" type="text" name="title" placeholder="Vnesite ime"
                                required="required" /> <br />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Opis</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Vnesi opis valute" ></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Cena (€)</label>
                            <input class="form-control" type="text" name="current_price" placeholder="Vnesite trenutno ceno"/> <br />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Logo</label>
                            <input class="form-control" type="file" name="logo" placeholder="Vnesite logotip"
                                required="required" /> <br />
                        </div>
                    </div>
                    </div>
                    <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Shrani</button></div>
                </form>
            </div>
        </div>
    </div>
</section>

<h1>Kripto valute</h1>



<?php
include_once "footer.php";
?>