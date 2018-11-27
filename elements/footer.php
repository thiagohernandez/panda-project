<!-- FOOTER -->
<footer id="footer" class="bottom-0 fullwidth zi-0">
	<!-- Container -->
	<div class="footer-body container padding-regular">
		<div class="row clearfix">
			<div class="col-sm-6 col-xs-12 table-im height-auto-mobile t-left t-center-xs sm-mb-mobile">
				<a href="#" class="icon-sm radius bg-white dark facebook white-hover slow1"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="icon-sm radius bg-white dark twitter white-hover slow1"><i class="fab fa-twitter"></i></a>
				<a href="#" class="icon-sm radius bg-white dark instagram white-hover slow1"><i class="fab fa-instagram"></i></a>
				<a href="#" class="icon-sm radius bg-white dark pinterest white-hover slow1"><i class="fab fa-pinterest"></i></a>
			</div>
			
			<div class="col-sm-6 col-xs-12 table-im height-auto-mobile t-right t-center-xs">
				<div class="brand-footer"><span class="off"><?= txt('brokerpanda') ?></span></div>
			</div>
		</div>
	</div>
	<!-- End Container -->
	<!-- Footer Bottom -->
	<div class="footer-bottom bt-1 border-gray1 padding-regular" style="border-color: #eaeaea !important;">
		<div class="container">
			<div class="row clearfix t-center-xs">
				<div class="col-sm-6 col-xs-12 table-im t-left height-auto-mobile t-center-xs">
					<div class="v-middle fs-11" style="font-size: 11px;">
						<a href="#" target="_blank" class="gray6-hover underline-hover"><?= txt('politicacookies') ?></a> | 
						<a href="#" target="_blank" class="gray6-hover underline-hover"><?= txt('politicaprivacidad') ?></a>
					</div>
				</div>
				<!-- Bottom Note -->
				<div class="col-sm-6 col-xs-12 table-im t-right height-auto-mobile t-center-xs xxs-mt-mobile">
					<p class="v-middle fs-11" style="font-size: 11px;">
						<?php echo date("Y");?> © <?= txt('brokerpanda') ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- END FOOTER -->
    <!-- Contact us button -->
	<?php if ($language_name != "en") { ?>
		<a target="_blank" href="/home/contacto" class="drop-msg click-effect dark-effect"><i class="far fa-envelope"></i></a>
	<?php }else{ ?>
		<a target="_blank" href="/home/contacto?lang=en" class="drop-msg click-effect dark-effect"><i class="far fa-envelope"></i></a>
	<?php } ?>

<!-- Back To Top -->
<a id="back-to-top" href="#top"><i class="fa fa-angle-up"></i></a>