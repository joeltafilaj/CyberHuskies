<?php
$sqlGetHomePage = "SELECT * FROM homepage LIMIT 1";
$resultGetHomePage = mysqli_query($connection, $sqlGetHomePage);
if (mysqli_num_rows($resultGetHomePage) == 1) {
    while ($rowGetHomePage = mysqli_fetch_assoc($resultGetHomePage)) {
    ?>
    <!-- Footer section -->
    <section id="footer-section" class="mt-2">
        <br>
        <div class="container">
            <!-- <h2 class="headerLabel-container">Contact Us</h2> -->
            <div class="row">
                <div class="col-lg-4 col-12 text-center">
                    <h2 class="footer-header mb-3">Contact us</h2>
                    <span class="footer-inner"><i class="fad fa-envelope"></i> <strong>Email:</strong> <span
                            class="text-secondary"><?php echo $rowGetHomePage['email']; ?></span> </span>
                    <br>
                    <span class="footer-inner"><i class="fas fa-phone-plus"></i> <strong>Phone Number:</strong> <span
                            class="text-secondary"><?php echo $rowGetHomePage['phone_number']; ?></span> </span>
                </div>
                <div class="col-lg-4 col-12 mt-5 mt-lg-0 text-center">
                    <h2 class="footer-header mb-3">Location</h2>
                    <span class="footer-inner"><i>" <?php echo $rowGetHomePage['location']; ?> "</i></span>
                    <br>
                    <span class="h1"><i class="fad fa-map-marked-alt"></i></span>
                </div>
                <div class="col-lg-4 col-12 mt-5 mt-lg-0 text-center">
                    <h2 class="footer-header mb-3">Social media</h2>
                    <a href="#" class="h1 text-primary"><i class="fab fa-facebook-square"></i></a>
                    <a href="#" class="h1 text-danger"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div><br><br><br><br>
    </section>
    <?php
    }
}
mysqli_close($connection);
?>