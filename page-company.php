<?php
/**
 * Template Name: Company - temporary
 *
 * @package WordPress
 * @subpackage sTheme
 * @since sTheme 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main company profile" role="main">
		
			<div id="profile-header">
      
      	<div class="profile-user-box">
      		<a class="user-thumb" href="#"><img src="<?php echo HB_THEME_URL; ?>/img/user-avatar.gif" alt="Gordon" /></a>
        	<div class="pub-details">
            <p class="user-name">STIFF.</p>
            <p class="user-info">Ottawa, Ontario || 100 - 500 employees</p>
            <p class="user-site"><a href="http://stiff.ca" target="_blank">WWW.STIFF.CA</a></p>
          </div>
        </div> <!-- ./profile-user-box -->
        
      </div> <!-- profile-header -->
			
			<div class="container">
				
        <div class="profile-section ">
        <div class="row">
        	<div class="col-xs-4">
        		<a href="#" class="user-thumb"><img src="<?php echo HB_THEME_URL; ?>/img/gordon-pic.jpg" alt="Gordon" /></a>
          </div>
          <div class="profile-section-description col-xs-8">
            <h2>About Gordon
              <span class="last-online">LAST ONLINE: Jan 23</span>
            </h2>
            
            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec. Sed non  mauris vitae erat consequat auctor eu in elit. </p>
    
            <p>Class aptent taciti sociosqu ad litora toruent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu feli. dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
          </div> <!-- ../profile-section-description -->
        </div>
        </div> <!-- ./profile-section -->
        
        <div class="profile-footer">
        	<div class="row">
          	<div class="col-xs-4">
            	<div class="widget-footer">
            		<h3>Job Experience</h3>
            
            		<p>UI/UX Designer &amp; Developer<br />
                Neo-Porfessional bike racer <br />
                Thoroughgood Estate Manager</p>
              </div> <!-- ./widget-footer -->
            </div>
            
            <div class="col-xs-4">
            	<div class="widget-footer">
                <h3>Sector/Experience</h3>
              
                <p>Equine Industry - 7 years<br />
                Design and Development - 8 years<br />
                Master of the house - 27 years</p>
              </div>  <!-- ./widget-footer -->
            </div>
            
            <div class="col-xs-4">
            	<div class="widget-footer">            
                <h3>Additional Information</h3>
              
                <p>Mentorship Opportunities<br />
                Willing to travel<br />
                4 kids and 3 horses</p>
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
