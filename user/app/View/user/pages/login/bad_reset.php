<div id="page-background" style="background-image: url(<?= $_img('pcb.jpg')?>)">
	<script>
		var pageAreaHeight = function() {
			return window.innerHeight-(64+12);
		}
		var setBackdropHeight = function() {
			$('#page-background').css('min-height','0'+pageAreaHeight()+'px');
		};
		setBackdropHeight();
		$(window).resize(setBackdropHeight);
	</script>

	<div id="page-content">
		<div class="row" style="padding-top:20%">
			<div class="col-xs-12 text-center">
				<div class="panel panel-default" style="display:inline-block; min-width:300px;">
					<div class="panel-heading">
						<div class="panel-title">Cambiar contrase&ntilde;a
						<button type="button" class="close" id="close-button">&times;</button>
						</div>
					</div>
					<div class="panel-body">
						<div>El vinculo seguido no es valido (o ha caducado...)</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script>
$('#close-button').on('click',function() {
	window.location = "<?= $_link('/') ?>";
});
</script>

