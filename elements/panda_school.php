<!-- page_body.php -->
<style>
.panda-school {
	/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,f6f6f6+47,ededed+100;White+3D+%231 */
	background: #ffffff; /* Old browsers */
	background: -moz-linear-gradient(-45deg,  #ffffff 0%, #f6f6f6 47%, #ededed 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(-45deg,  #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(135deg,  #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	border-radius: 12px!important;
	padding: 16px;
	min-height: 92px;
}
#school-icon {
	width: 80px;
	margin-right: 20px;
}
#school-title {
}
#school-title h3 {
	margin-top: 0px;
}
</style>

<div class="content-holder" style="max-width:<?= $max_content_width ?>px">
	<div class="panda-school">
		<div class="pull-left">
			<img id="school-icon" src="/home/img/school-icon.png">
		</div>
		<div id="school-title">
			<h3><?= txt('panda_school_title') ?></h3>
			<p><?= txt('panda_school_1') ?>
				<?= txt('panda_school_2') ?> <a href="/home/seminars?lang=<?= $language_name ?>"><?= txt('panda_seminars') ?></a>
				<?= txt('panda_school_3') ?> <a href="/home/book?lang=<?= $language_name ?>"><?= txt('panda_book') ?></a>.
			 </p>
		</div>
	</div>
</div>
