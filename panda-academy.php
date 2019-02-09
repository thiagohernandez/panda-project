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
					<a href="#" class="btn btn-primary md-mb" data-toggle="modal" data-target="#modalDownloadEbook
					"><?= txt('descargate') ?></a>
					<!-- pdf/las-12-claves-de-la-bolsa.pdf -->
				</div>
				<div class="col-md-6 d-flex align-items-end">
					<img src="img/pages/ebook-ipad-12-claves.png" class="img-fluid">
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="modalDownloadEbook" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><?= txt('las12claves') ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
    			<div class="form-group">
			    <label for="exampleInputName" class="sr-only">Nombre</label>
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1" class="sr-only">Email</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			  </div>
			  <div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">He leído y acepto la <a href="/política-de-privacidad">política de privacidad</a></label>
			  </div>
			  <button type="submit" class="btn btn-primary"><?= txt('descargate') ?></button>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	<?php include ("./elements/banner_500_companys.php"); ?>
	<?php include ("./elements/precios.php"); ?>
	<?php include ("./elements/testimonios.php"); ?>
	<?php include ("./elements/faq.php"); ?>
    <?php include ("./elements/porque_broker.php"); ?>
	<?php include ("./elements/footer.php"); ?>