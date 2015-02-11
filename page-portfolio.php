<?php
/**
 * Template Name: Profile - temporary
 *
 * @package WordPress
 * @subpackage sTheme
 * @since sTheme 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main profile" role="main">
		
			<div id="profile-header">
      
      	<div class="profile-user-box">
      		<a class="user-thumb" href="#"><img src="<?php echo HB_THEME_URL; ?>/img/user-avatar.gif" alt="Gordon" /></a>
        	<div class="pub-details">
            <p class="user-name">Gordon</p>
            <p class="user-info">UI/UX Developer • Equestrian • Cyclist</p>
          </div>
        </div> <!-- ./profile-user-box -->
        
      </div> <!-- profile-header -->
			
			<div class="container">

        <div class="profile-section">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <a href="#" class="user-thumb"><img class="img-responsive" src="<?php echo HB_THEME_URL; ?>/img/gordon-pic.jpg" alt="Gordon" /></a>
            </div>
            <div class="profile-section-description col-xs-12 col-sm-8">
              <h2>About Gordon</h2>

              <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec. Sed non  mauris vitae erat consequat auctor eu in elit. </p>

              <p>Class aptent taciti sociosqu ad litora toruent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu feli. dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
            </div> <!-- ../profile-section-description -->
          </div>
        </div> <!-- ./profile-section -->

        <div class="profile-section">
          <div class="row">
            <div class="col-xs-12">
              <div id="donutchart" style="width: 100%; height: 420px;"></div>
            </div>
          </div>
        </div> <!-- ./profile-section -->
        
        <div class="profile-section last-section">					
			<h3 class="text-center">Skills &amp; Qualifications</h3>
			        	
			<div class="row">

				<div class="col-xs-6">
					<label>Education</label>
					<div class="custom-checkbox">
						<p>
						  <input id="ed-q1" type="checkbox" />
						  <label for="ed-q1">
							<span class="glyphicon glyphicon-ok"></span>
							High School
						  </label>
						</p>
						<p>
						  <input id="ed-q2" type="checkbox" />
						  <label for="ed-q2">
							<span class="glyphicon glyphicon-ok"></span>
							College
						  </label>
						</p>
						<p>
						  <input id="ed-q3" type="checkbox" />
						  <label for="ed-q3">
							<span class="glyphicon glyphicon-ok"></span>
							University
						  </label>
						</p>
						<p>
						  <input id="ed-q4" type="checkbox" />
						  <label for="ed-q4">
							<span class="glyphicon glyphicon-ok"></span>
							Graduate Studies
						  </label>
						</p>
						<p>
						  <input id="ed-q5" type="checkbox" />
						  <label for="ed-q5">
							<span class="glyphicon glyphicon-ok"></span>
							Apprenticeships
						  </label>
						</p>   
					</div> <!-- custom-checkbox ends here -->	
				</div>
				<div class="col-xs-6">
					
					<div class="widget-footer">
					<label>Education</label>

					<p>
					  <button class="btn btn-small-red">CSS3</button>
					  <button class="btn btn-small-red">HTML5</button>
					  <button class="btn btn-small-red">Photoshop</button>
					  <button class="btn btn-small-red">Illustrator</button>
					</p>
				  </div> <!-- ./widget-footer -->
					
				</div>

          </div>
        </div> <!-- ./profile-footer -->
        
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

				// End the loop.
				endwhile;
				?>
        <br /> &nbsp;
			</div><!-- .container -->



		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
