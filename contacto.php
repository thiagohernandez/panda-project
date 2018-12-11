    <!-- CONTENT -->
    <section id="home" class="xxl-py t-center white fullwidth">
        <!-- Background image - you can choose parallax ratio and offset -->
        <div class="bg-parallax skrollr slow1" data-0="transform: scale(1.1,1.1);" data-700="transform: scale(1.0,1.0);" data-background="img/pages/background-people-2.jpg"></div>
        <!-- Container -->
        <div class="container skrollr" data-0="opacity:1; transform:translateY(0px);" data-700="opacity:0; transform:translateY(230px);">
           <div class="t-center white">
               <h5 class="gray4 mini-mt"><?= txt('envianosunmensaje') ?></h5>
               <h1 class="bold-title lh-sm"><?= txt('contacto') ?></h1>
               <div class="title-strips-over"></div>
           </div>
        </div>
        <!-- End Container -->
    </section>
    <!-- END CONTENT -->


    <!-- ABOUT -->
    <section id="about" class="py about mt--95 no-mt-mobile zi-5 bt-5 border-colored1 relative container bg-white">
        <!-- Container for boxes -->
        <div class="container-sm">

            <!-- Divider -->
            <div class="divider-1 font-11 gray6 uppercase container extrabold" style="margin-top:-32px; margin-bottom: 24px;">
                <span><?= txt('envianosunmensaje') ?></span>
            </div>
            <form>
				<div class="form-group">
					<label for="name"><?= txt('nombre') ?></label>
				    <input type="text" class="form-control" id="name" placeholder="">
				</div>
			  	<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
				</div>
				<div class="form-group">
					<label for="message"><?= txt('mensaje') ?></label>
					<textarea class="form-control" id="message" rows="3"></textarea>
				</div>
				<div class="padding-small clearfix">
					<a href="javascript:void(0);" class="btn btn-primary float-right"><?= txt('send_email') ?></a>
				</div>
			</form>
			<!-- Divider -->
	        <div class="divider-1 font-11 gray6 uppercase container extrabold sm-mt xs-mb">
	            <span><?= txt('siganos') ?></span>
	        </div>

	        <!-- Buttons -->
	        <div class="t-center">
	        	<a href="#" class="icon-sm radius bg-white dark facebook white-hover slow1"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="icon-sm radius bg-white dark twitter white-hover slow1"><i class="fab fa-twitter"></i></a>
                <a href="#" class="icon-sm radius bg-white dark instagram white-hover slow1"><i class="fab fa-instagram"></i></a>
                <a href="#" class="icon-sm radius bg-white dark pinterest white-hover slow1"><i class="fab fa-pinterest"></i></a>
	        </div>

        </div>
    </section>
    <!-- ABOUT -->


	<?php include ("./elements/banner_500_companys.php"); ?>



	<?php include ("./elements/precios.php"); ?>

	<?php include ("./elements/faq.php"); ?>
	
	<?php include ("./elements/panda_academy.php"); ?>
	
	<?php include ("./elements/footer.php"); ?>