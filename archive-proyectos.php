<?php get_header(); ?>
	<h1 class="title-page__green">Proyectos terminados</h1>
	<div class="row">
		<div class="col-md-8">
			<p>Estos son algunos de los proyectos realizados por EVOLUCASA. En ellos aplicamos nuestro sistema de planificación, proyección y fabricación “industrial”, conviertiendo en una nueva forma de construir viviendas, en un ejercicio mucho más eficiente, rápido y económico que el sistema de construcción tradicional.</p>
			<p><strong>Nuestras viviendas cumplen la normativa recogida en el Código Técnico de la Edificación.</strong></p>
		</div>
	</div>
	<div id="list-archives">
		<?php if ( have_posts() ) : ?>


				<?php
                    $superficie_terms = get_terms( 'superficie-proyectos', array(
			            'orderby' => 'name',
			            'order' => 'ASC',
                 	));
                    if ( ! empty( $superficie_terms ) ) {
                        if ( ! is_wp_error( $superficie_terms ) ) {
                        	echo '<div class="filter-button-group">';
                            echo '<ul class="fusion-filters clearfix" style="display: block;" >';
                            echo '<li class="fusion-filter fusion-filter-all fusion-active"><a data-id="all" href="#">Todos</a></li>';
                                foreach( $superficie_terms as $term ) {
                                    echo '<li class="fusion-filter"><a data-id="superficie-proyectos-'. $term->slug .'" href="#">' . esc_html( $term->name ) . '</a></li>'; 
                                    //echo '<li class="fusion-filter superficie-proyectos-' . $term->slug .' "><a data-filter="superficie-proyectos-'. $term->slug .'" href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a></li>'; 
                                }
                            echo '</ul>';
                            echo '</div>';
                        }
                    }
                ?>


			<div class="row">
				<div class="col-md-12">

					<div class="flex-content">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
		                    $data_filter_terms = wp_get_object_terms( $post->ID,  'superficie-proyectos' );
		                    if ( ! empty( $data_filter_terms ) ) {
		                        if ( ! is_wp_error( $data_filter_terms ) ) {
	                                foreach( $data_filter_terms  as $term ) {
	                                    $filterActual = esc_html( $term->slug );
	                                }
		                        }
		                    }
		                ?>
			
						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" data-id="<?php echo 'superficie-proyectos-'.$filterActual; ?>">
							<a class="card-proyecto" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<div class="card-proyecto-image">
									<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
									<div class="area-label">
										<?php 
					                    	echo get_post_meta( get_the_id(), 'superficie', true);
					                	?>m&sup2;
					            	</div>
					            	<div class="fusion-rollover">
										<div class="fusion-rollover-content">
											<span class="fusion-rollover-link">Permalink</span>
										</div>
									</div>
								</div>
								<header class="entry-header">
									<?php the_title( sprintf( '<h3 class="entry-title">', esc_url( get_permalink() ) ),
									'</h3>' ); ?>
								</header><!-- .entry-header -->

								<div class="entry-content">

									<?php
					                    $modelos_terms = wp_get_object_terms( $post->ID,  'modelos-proyectos' );
					                    if ( ! empty( $modelos_terms ) ) {
					                        if ( ! is_wp_error( $modelos_terms ) ) {
					                            echo '<div class="modelos-proyectos-label">';
					                                foreach( $modelos_terms as $term ) {
					                                    echo '<span>Modelo ' . esc_html( $term->name ) . '</span>'; 
					                                }
					                            echo '</div>';
					                        }
					                    }
					                ?>

								</div><!-- .entry-content -->
							</a>			
						</article><!-- #post-## -->

					<?php endwhile; ?>
					</div>

				</div>
			</div>
		<?php else : ?>

			<p>No hemos encontrado ningun proyecto terminado en nuestra base de datos.</p>

		<?php endif; ?>

	</div>

<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
