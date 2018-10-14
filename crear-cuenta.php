
    <section class="section-login">
    	<div class="section-login__inner box-default">
	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="padding__inner">
	    					<h1>Crear cuenta</h1>
	    					<form>
	    						<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="far fa-user"></i></div>
										</div>
										<input type="text" class="form-control" id="inlineFormInputGroupName" placeholder="Nombre">
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
										<input type="password" class="form-control" id="inlineFormInputGroupUsername" placeholder="Contraseña">
									</div>	
								</div>
								<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="fas fa-key"></i></div>
										</div>
										<input type="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Repetir contraseña">
									</div>	
								</div>
								<!-- <button type="submit" class="btn btn-primary">Crear cuenta</button> -->
								<a href="dashboard.html" class="btn btn-primary">Crear cuenta</a>
								<hr class="divider">
								<h5 class="title-smaller my-4">Ya tengo una cuenta</h5>
								<a href="login" class="btn btn-light-gray">Login</a>
							</form>
	    				</div>
	    			</div>
	    			<div class="col-md-6 bg-app bg-cover bg-soft bg-soft-dark7">
	    				<div class="padding__inner">
	    					<h2>Nuestros pandas nunca duermen</h2>
							<p><strong>Inversiones optimizadas 24/7</strong> por nuestros robotraders.</p>
							<p><strong>Alertas Panda</strong> por correo electrónico y a teléfonos moviles.</p>
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
					<h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Introduce tu correo electronico para recibir un vinculo para borrar tu contraseña:</p>
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
						<a href="dashboard.html" class="btn btn-primary">Enviar correo</a>
					</form>
				</div>
			</div>
		</div>
	</div>