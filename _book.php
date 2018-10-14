<!-- Get the book! -->
<style>
.panda-book {
	margin-top: 30px;
	padding: 16px;
	min-height: 92px;
	border-radius: 12px!important;
	/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,f6f6f6+47,ededed+100;White+3D+%231 */
	background: #ffffff; /* Old browsers */
	background: -moz-linear-gradient(-45deg,  #ffffff 0%, #f6f6f6 47%, #ededed 100%);
	background: -webkit-linear-gradient(-45deg,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
	background: linear-gradient(135deg,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=1 );
}
.panda-book h2 {
	margin-top: 0px;
}
.book-info {
}
.book-info img {
	display:inline-block;
	vertical-align: top;
	width: 32%;
}
.book-info-txt {
	width: 64%;
	display:inline-block!important;
}
.book-info-txt h4 {
	margin-left:12px;
	display:inline-block!important;
}

@media screen and (max-width: <?= $menu_shrink_width ?>px) {
	.panda-book {
		margin-top: 12px;
	}
	.book-info img {
		width: 100%;
	}
	.book-info-txt {
		width: 100%;
	}
}
</style>
<div class="content-holder" style="max-width:<?= $max_content_width ?>px">
	<div class="panda-book">
		<h2><?= txt('panda_publications') ?></h2>
		<div class='book-info'>
			<img src="/home/img/books.jpg">
			<div class="book-info-txt">
				<h4><?= txt('panda_book') ?></h4>
				<ul>
					<li><?= txt('panda_book_1') ?></li>
					<li><?= txt('panda_book_2') ?></li>
				</ul>
				<div>
					<div class="pull-right">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="4FTA2WZGT38BE" />
							<input alt="PayPal. La forma rápida y segura de pagar en Internet." name="submit" src="/img/paypal.gif" type="image">
						</form>
					</div>
`				</div>
			</div>
		</div>
	</div>
</div>


