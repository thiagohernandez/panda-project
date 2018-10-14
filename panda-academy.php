    <!-- CONTENT -->
    <section id="home" class="xl-py t-center fullwidth bg-soft bg-soft-dark8">
        <!-- Background image - you can choose parallax ratio and offset -->
        <div class="bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="img/pages/ebook-12-claves.jpg"></div>
        <!-- Container -->
        <div class="container skrollr" data-0="opacity:1; transform:translateY(0px);" data-700="opacity:0; transform:translateY(230px);">
           <div class="t-center white">
               <h5 class="gray4 mini-mt"><?= txt('losunicoslimites') ?></h5>
               <h1 class="bold-title lh-sm"><?= txt('pandaacademy') ?></h1>
               <div class="title-strips-over"></div>
           </div>
        </div>
        <!-- End Container -->
    </section>
    <!-- END CONTENT -->

    <section class="bg-color_porcelain">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="title-strips-over dark sm-mt"></div>
					<h2 class="extrabold-title"><?= txt('publicacionespanda') ?></h2>
					<h4 class="dark light no-pm xs-mb"><?= txt('las12claves') ?></h4>
					<p><?= txt('manualpractico') ?></p>
					<p><?= txt('teexplicamos') ?></p>
					<a href="pdf/las-12-claves-de-la-bolsa.pdf" class="btn btn-primary md-mb" target="_blank"><?= txt('descargate') ?></a>
				</div>
				<div class="col-md-6 d-flex align-items-end">
					<img src="img/pages/ebook-ipad-12-claves.png" class="img-fluid">
				</div>
			</div>
		</div>
	</section>


	<?php include ("./elements/banner_500_companys.php"); ?>

	<section class="bg-color_porcelain">
		<div class="row no-gutters">
			<div class="col-md-6 ov-hidden">
				<!-- Background image with horizontal parallax -->
				<div id="horizontal1" class="lg-py xs-mt white">
            		<div class="bg-parallax skrollr bg-cover bg-repeat bg-right" style="width:120%; width:calc(100% + 250px);" data-anchor-target="#horizontal1" data-bottom-top="transform:translate3d(-150px, -100px, 0px);" data-top-bottom="transform:translate3d(0px, -100px, 0px);" data-background="img/pages/background-people.jpg"></div>
            	</div>
			</div>
			<div class="col-md-6">
				<div class="padding__inner">
					<div class="title-strips-over dark sm-mt"></div>
					<h2 class="extrabold-title"><?= txt('nuestrostalleres') ?></h2>
					<h4 class="dark light no-pm xs-mb"><?= txt('acudeaunodenuestros') ?></h4>
					<p><?= txt('ahoramismonotenemos') ?></p>
					<div class="t-left translatez-lg xxs-mt">
                        <a href="#" class="icon-xs circle bg-transparent facebook white-hover slow1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="icon-xs circle bg-transparent twitter white-hover slow1"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="icon-xs circle bg-transparent instagram white-hover slow1"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="icon-xs circle bg-transparent pinterest white-hover slow1"><i class="fab fa-pinterest"></i></a>
                    </div>
				</div>
			</div>
		</div>
	</section>

	<?php include ("./elements/precios.php"); ?>
	
    <?php include ("./elements/panda_academy.php"); ?>
	
	<?php include ("./elements/footer.php"); ?>