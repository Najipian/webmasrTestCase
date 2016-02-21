<?php
include_once("main.php");
include("layout/header.php");

?>

    <div class="row" >
    
        <div class="col-sm-12" >
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                
                <ol class="carousel-indicators">
                    <?php foreach($slider as $k => $v){
                        $active = $k == 0? 'active':'';
                        echo '<li data-target="#myCarousel" data-slide-to="'.$k.'" class="'.$active.'"></li>';
                    }?>
                </ol>
              
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php foreach($slider as $k => $v){
                        $active = $k == 0? 'active':'';
                        echo '<div class="item '.$active.'">
                                <img src="'.$v.'" class="slider">
                              </div>';
                    }?>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-12" style="height: 50px"></div>
        <div class="col-sm-4 col-sm-offset-4" >
            <?=$notification?>
            <form role="form" id="contactForm" enctype="multipart/form-data" method="post" action="">
                <div class="form-group">
                    <label for="firstname" class="sr-only">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="lastname" class="sr-only">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirmpassword" class="sr-only">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <label for="address" class="sr-only">Adress</label>
                    <textarea class="form-control" rows="5" id="address" name="address" placeholder="Address"></textarea>
                </div>
                <div class="form-group">
                    <label for="fileToUpload" class="sr-only">Image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" name="fileToUpload" >
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LcyogwTAAAAACQ0kTpF30UFy0pVyTMCUMLb-Yd5"></div>
                </div>
                <button type="submit" name="submit"class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-sm-12" style="height: 50px"></div>
    </div>
<?php include("layout/footer.php");?>
<script src="assets/js/inc/contact.js"></script>
<script>
$(function(){
      var contactPage = new Contact();
      contactPage.init();
});
</script>