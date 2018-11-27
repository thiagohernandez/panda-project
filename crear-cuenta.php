
    <section class="section-login">
    	<div class="section-login__inner box-default">
	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="padding__inner">
	    					<h1><?= txt('create_account') ?></h1>
	    					<form>
	    						<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="far fa-user"></i></div>
										</div>
										<input type="text" class="form-control" id="inlineFormInputGroupName" placeholder="<?= txt('nombre') ?>">
									</div>
								</div>
	    						<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="far fa-envelope-open"></i></div>
										</div>
										<input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="fas fa-key"></i></div>
										</div>
										<input type="password" class="form-control" id="inlineFormInputGroupUsername" placeholder="<?= txt('contrasena') ?>">
									</div>	
								</div>
								<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="fas fa-key"></i></div>
										</div>
										<input type="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="<?= txt('repcontrasena') ?>">
									</div>	
								</div>
								<!-- <button type="submit" class="btn btn-primary">Crear cuenta</button> -->
								<a href="dashboard.html" class="btn btn-primary"><?= txt('create_account') ?></a>
								<hr class="divider">
								<h5 class="title-smaller my-4"><?= txt('yatengo') ?></h5>
								<a href="login" class="btn btn-light-gray"><?= txt('login') ?></a>
							</form>
	    				</div>
	    			</div>
	    			<div class="col-md-6 bg-app bg-cover bg-soft bg-soft-dark7">
	    				<div class="padding__inner">
	    					<h2><?= txt('nuncaduermen') ?></h2>
							<p><strong><?= txt('optimizadas247') ?></strong> <?= txt('pornuestrosrobo') ?></p>
							<p><strong><?= txt('alertaspanda') ?></strong> <?= txt('porcorreoelectronico') ?></p>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
    	</div>
    </section>

    <!-- MODAL RECOVER PASSWORD -->
    <!-- Modal -->
	<div class="modal fade" id="modalRecoverPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?= txt('resetpassword') ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><?= txt('introducetucorreo') ?></p>
					<form>
						<div class="form-group">
							<div class="input-group input-group__transparent">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="far fa-envelope-open"></i></div>
								</div>
								<input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email">
							</div>
						</div>
						
						<!-- <button type="submit" class="btn btn-primary">Entrar</button> -->
						<a href="dashboard.html" class="btn btn-primary"><?= txt('enviarcorreo') ?></a>
					</form>
				</div>
			</div>
		</div>
	</div>