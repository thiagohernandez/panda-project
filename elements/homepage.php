
    


    <!-- HOME SECTION -->
   <section id="home" class="home rev_slider_wrapper fullscreen-container">
      <!-- Start Slider -->
      <div id="home_slider" class="rev_slider fullscreenbanner">
        <!-- Slider Container -->
        <ul>

  
           <!-- Slide -->
           <li data-masterspeed="1000" data-transition="fade" data-thumb="img/pages/mobile-front.jpg" data-saveperformance="off" data-title="Create Stunning Website" data-description="Home Slider">
              <!-- Background Image -->
              <img src="img/frontend/image__portada.jpg" alt="Broker Panda" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="0" class="rev-slidebg" data-no-retina>
              
              <style>
              .tp-caption.white.bold.slide-title.rs-parallaxlevel-1 {
              	letter-spacing: 0;
              	}
          	</style>

              <!-- Layer -->
              <div class="tp-caption white bold slide-title rs-parallaxlevel-1"
              data-x="['left','center','center','center']"
              data-y="['middle','top','top','top']"
              data-fontsize="['38','36','34','27']"
              data-frames='[{"delay":"+2100","speed":2000,"frame":"0","from":"y:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
              data-hoffset="['35','0','0','0']"
              data-voffset="['-49','105','78','103']">
                 <?= txt('cansado') ?>
              </div>
              <!-- Layer -->
              <div class="tp-caption white bold slide-title rs-parallaxlevel-1"
              data-x="['left','center','center','center']"
              data-y="['middle','top','top','top']"
              data-lineheight="80"
              data-fontsize="['38','36','34','27']"
              data-frames='[{"delay":"+2400","speed":2000,"frame":"0","from":"y:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
              data-hoffset="['35','0','0','0']"
              data-voffset="['-3','118','90','112']">
                 <?= txt('tudinero') ?>
              </div>
              <!-- Layer -->
              <div class="tp-caption w-normal rs-parallaxlevel-1"
              data-x="['left','center','center','center']"
              data-y="['middle','top','top','top']"
              data-color="#bfbfbf"
              data-lineheight="24"
              data-fontsize="['16','16','16','15']"
              data-frames='[{"delay":"+2700","speed":2000,"frame":"0","from":"y:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
              data-hoffset="['37','0','0','0']"
              data-voffset="['41','185','159','177']">
                   <a href="#" class="stay quick-contact-form-trigger qdr-hover-5 qdr-hover-5-white">
                       <?= txt('teavisamos') ?>
                   </a>
              </div>
              <!-- Layer -->
              <div class="tp-caption nowrap uppercase rs-parallaxlevel-1"
              data-x="['left','center','center','center']"
              data-y="['middle','top','top','top']"
              data-frames='[{"delay":"+3000","speed":2000,"frame":"0","from":"y:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
              data-hoffset="['34','-77','-72','-85']"
              data-voffset="['92','220','198','210']">
                 <!-- Add Video link, it will be visible when upload files to server -->
				 <?php if ($language_name != "en") { ?>
					<a href="#pricing" class=" slow lg-btn bold font-13 bg-colored white uppercase radius-lg qdr-hover-6 bs-lg-hover page-scroll">
				<?php }else{ ?>
					<a href="#pricing" class=" slow lg-btn bold font-13 bg-colored white uppercase radius-lg qdr-hover-6 bs-lg-hover page-scroll">
				<?php } ?>

                    <?= txt('empieza') ?>
                 </a>
              </div>
              <!-- Layer -->
             
            
              
           </li>
           <!-- End Slide -->
           
        </ul>
        <!-- End Container -->
      </div>
      <!-- End Slider -->
   </section>
   <!-- END HOME SECTION -->

   <?php include ("./elements/form-sin-sentido.php"); ?>


    <!-- SERVICES SECTION -->
	<section id="services" class="services-section clearfix bg-shape-logo-light-gray">
		<div class="row no-gutters">
			<div class="col-12 col-sm-6">
				<!-- Model Container - Left Positioned -->
	            <div class="model hotspots height-auto-mobile">
	                <!-- Your image is here -->
	                <img src="images/loader.gif" data-original="img/frontend/inteligencia-broker-panda.jpg" alt="hotspot image">
	                <!-- Hotpoints -->
	                
	            </div>
	            <!-- End Left Area -->
			</div>
			<div class="col-12 col-sm-6 align-self-center">
				<!-- Right, Services -->
				<div class="services scrollbar-styled padding__inner">
					<div class="padding__inner">
						<!-- Title -->
						<h2 class="extrabold-title"><?= txt('ultima_tecnologia') ?><span class=""><?= txt('inteligencia_artificial') ?></span></h2>
						<h4 class="dark light no-pm"><?= txt('robots_advisors') ?></h4>
						<div class="title-strips-over dark"></div>
						<!-- Description -->
						<p><strong><?= txt('batir') ?></strong><?= txt('batir2') ?></p>
						<p><strong><?= txt('avisamos') ?></strong> <?= txt('cuando_comprar') ?></p>
						<p><?= txt('alaapertura') ?></p>
						<p><?= txt('podras_elegir') ?><strong><?= txt('masde500') ?></strong></p>
					</div>
					<!-- End Inner -->
				</div>
				<!-- End Services Area -->
			</div>
		</div>
    </section>
    <!-- END SERVICES SECTION -->

    <?php include ("./elements/banner_500_companys.php"); ?>

    <style>
    .fs-13 {
    	font-size: 13px;}
</style>
	<section class="">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 t-center">
					<div class="title-strips-over dark sm-mt"></div>
					<h2 class="extrabold-title"><?= txt('8problemas') ?></h2>
					<h4 class="dark light no-pm xs-mb"><?= txt('versus') ?></h4>
				</div>
			</div>
			<div class="row t-center">
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-dollar-sign fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">1</div>
						</div>
						<h4 class="xxs-mt"><?= txt('costes') ?></h4>
						<p class="fs-13"><?= txt('cantidad_estudios') ?></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-gavel fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">2</div>
						</div>
						<h4 class="xxs-mt"><?= txt('duras_penalizaciones') ?></h4>
						<p class="fs-13"><?= txt('si_por_cualquier') ?></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fab fa-creative-commons-nc-eu fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">3</div>
						</div>
						<h4 class="xxs-mt"><?= txt('nula') ?></h4>
						<p class="fs-13"><?= txt('plazos_marcados') ?></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-users fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">4</div>
						</div>
						<h4 class="xxs-mt"><?= txt('falsa_gestion') ?></h4>
						<p class="fs-13"><?= txt('descubren_mas') ?></p>
					</div>
				</div>
			</div>

			<div class="row t-center">
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-microphone-alt-slash fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">5</div>
						</div>
						<h4 class="xxs-mt"><?= txt('nula_voz') ?></h4>
						<p class="fs-13"><?= txt('inversor_inteligente') ?></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-user-times fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">6</div>
						</div>
						<h4 class="xxs-mt"><?= txt('poca_transparencia') ?></h4>
						<p class="fs-13"><?= txt('algunas_gestoras') ?></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-bullhorn fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">7</div>
						</div>
						<h4 class="xxs-mt"><?= txt('nulo_poder') ?></h4>
						<p class="fs-13"><?= txt('muchos_estilos') ?></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stay slow xs-py click-effect dark-effect block card-icon">
						<span class="ink clicked" style="height: 400px; width: 400px; top: -111px; left: 21.5px;"></span>
						<!-- Icon -->
						<div class="stay circle border-double border-colored border-dashed icon-xl white m-auto">
							<i class="fas fa-hand-holding-usd fs-26 bg-gradient text-background"></i>
							<div class="basic-mark icon-mark to-right to-bottom font-10 circle bg-info bold">8</div>
						</div>
						<h4 class="xxs-mt"><?= txt('rentabilidad') ?></h4>
						<p class="fs-13"><?= txt('duda_razonable') ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include ("./elements/porque_broker.php"); ?>


	<?php include ("./elements/precios.php"); ?>
	<?php include ("./elements/testimonios.php"); ?>

	<?php include ("./elements/faq.php"); ?>
	<?php include ("./elements/form-sin-sentido.php"); ?>
    <?php include ("./elements/panda_academy.php"); ?>

	<?php include ("./elements/footer.php"); ?>

    