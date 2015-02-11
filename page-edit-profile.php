<?php
/**
 * Template Name: Edit Profile - temporary
 *
 * @package WordPress
 * @subpackage sTheme
 * @since sTheme 1.0
 */

get_header(); ?>

<div id="primary" class="content-area edit-profile-page">
  <div id="edit-profile-nav">
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#edit-profile" aria-controls="home" role="tab" data-toggle="tab">EDIT PROFILE</a></li>
          <li role="presentation"><a href="#edit-pt" aria-controls="profile" role="tab" data-toggle="tab">EDIT PERSONALITY TEST</a></li>
          <li role="presentation"><a href="#edit-sa" aria-controls="messages" role="tab" data-toggle="tab">EDIT SKILLS &amp; QUALIFICATIONS</a></li>
          <li class="save-data pull-right"><button type="submit">Save</button></li>
        </ul>
    </div>
  </div> <!-- #/edit-profile-nav -->





        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="edit-profile">
          
<div class="page-title-section">
  <div class="container relative">
    <h1>Edit profile</h1>

    <?/* php the_title( '<h1 class="entry-title">', '</h1>' ); */?>
  </div>
</div>
              
<div class="container">
  <div class="row">
            <div class="site-main edit-profile-content bg-transparent col-xs-12 col-sm-6" role="main">
              <form class="default-main-form" action="#" method="post">
                <div class="row">
                  <div class="form-group">
                    <div class="col-xs-6">
                      <label>FIRST NAME</label>
                      <input class="form-control" type="text" name="first-name" placeholder=""/>
                    </div>
                    <div class="col-xs-6">
                      <label>LAST NAME</label>
                      <input class="form-control" type="text" name="last-name" placeholder=""/>
                    </div>
                  </div> <!-- ./form-group -->
                </div> <!-- ./row -->

                <div class="row">
                  <div class="form-group">
                    <div class="col-xs-6">
                      <label>CITY</label>
                      <input class="form-control" type="text" name="city" placeholder=""/>
                    </div>
                    <div class="col-xs-6">
                      <label>POSTAL/ZIP CODE</label>
                      <input class="form-control" type="text" name="zip-code" placeholder=""/>
                    </div>
                  </div> <!-- ./form-group -->
                </div> <!-- ./row -->                

                <div class="row">
                  <div class="form-group note">
                    <div class="col-xs-12">
                      <label>CHARACTERISTICS #1 <span>max 3 words</span></label>
                      <input class="form-control" type="text" name="characteristics1" placeholder=""/>
                    </div>
                  </div> <!-- ./form-group -->
                </div> <!-- ./row -->

                <div class="row">
                  <div class="form-group note">
                    <div class="col-xs-12">
                      <label>CHARACTERISTICS #2 <span>max 3 words</span></label>
                      <input class="form-control" type="text" name="characteristics2" placeholder=""/>
                    </div>
                  </div> <!-- ./form-group -->
                </div> <!-- ./row -->

                <div class="row">
                  <div class="form-group note">
                    <div class="col-xs-12">
                      <label>CHARACTERISTICS #3 <span>max 3 words</span></label>
                      <input class="form-control" type="text" name="characteristics3" placeholder=""/>
                    </div>
                  </div> <!-- ./form-group -->
                </div> <!-- ./row -->                                


                <div class="row">
                  <div class="form-group textarea-group">
                    <div class="col-xs-12">
                      <label>Background <span class="pull-right"><em>342</em> / 600 words</span></label>
                      <textarea class="form-control" type="text" name="background" placeholder=""></textarea>
                    </div>
                  </div> <!-- ./form-group -->
                </div> <!-- ./row -->

              </form>


            </div><!-- .site-main -->
            <div class="custom_sidebar col-xs-12 col-sm-4 col-sm-offset-2">
              <div class="sidebar-widget">
               <form class="default-main-form" action="#" method="post">
                 <div class="form-group">
                   <label>CHANGE PHOTO/VIDEO</label>
                    <a class="profile-picture" href="#">
                      <!-- <img src="<?php echo HB_THEME_URL; ?>/img/profile-picture.jpg" alt="User Photo" />-->
                    </a>
                 </div> <!-- ./form-group -->
                </form>

              </div> <!-- sidebar-widget ends here -->
            </div><!-- ./custom_sidebar -->

	</div>
</div>
          </div>
          <div role="tabpanel" class="tab-pane" id="edit-pt">
          
<div class="page-title-section">
  <div class="container relative">
    <h1>Edit personality test
    <span class="pull-right edit-pt-note">You have answered 12 / 30 questions</span>
    </h1>

    <?/* php the_title( '<h1 class="entry-title">', '</h1>' ); */?>
  </div>
</div>          
<div class="container">
  <div class="row">          
            <div class="site-main edit-profile-content bg-transparent col-xs-12 col-sm-9 center-block">
              <h3 class="text-center">How do you dress at work?</h3>

                <p>
                  <input id="pt-q1" type="checkbox" />
                  <label for="pt-q1">
                    <span class="glyphicon glyphicon-ok"></span>
                    casual – comfort trumps all
                  </label>
                </p>
                <p>
                  <input id="pt-q2" type="checkbox" />
                  <label for="pt-q2">
                    <span class="glyphicon glyphicon-ok"></span>
                    business casual – fine: the occasional collared shirt and dark denim
                  </label>
                </p>
                <p>
                  <input id="pt-q3" type="checkbox" />
                  <label for="pt-q3">
                    <span class="glyphicon glyphicon-ok"></span>
                    formal – I live to suit up
                  </label>
                </p>

              <!-- optional -->
              <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div> <!-- ./site-main -->

            <div class="custom_sidebar col-xs-12 col-sm-5 col-sm-offset-1">

            </div> <!-- ./custom_sidebar -->
	</div>
</div>
          </div>
          <div role="tabpanel" class="tab-pane" id="edit-sa">
          
<div class="page-title-section">
  <div class="container relative">
    <h1>Edit skills &amp; qualifications</h1>

    <?/* php the_title( '<h1 class="entry-title">', '</h1>' ); */?>
  </div>
</div>          
<div class="container">
  <div class="row">             
            <div class="site-main edit-profile-content bg-transparent col-xs-12 col-sm-6">
              <h3>EDUCATION</h3>
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


            </div> <!-- ./site-main -->
						
            <div class="site-main edit-profile-content bg-transparent col-xs-12 col-sm-6">
            	<div id="employment-skills">
              	<label>Employment Skills <span class="pull-right">4 / 9 skills</span></label>
                <div class="tags-wrap">
                  <button class="btn btn-default-red">Programmer</button>                	
                  <button class="btn btn-default-red">CSS</button>
                  <button class="btn btn-default-red">HTML5</button>
                  <button class="btn btn-default-red">Designer</button>
                </div> <!-- ./tags-wrap -->
              </div> <!-- #/employment-skills -->
            </div>

      </div> <!-- ./row -->
    </div><!-- .container -->            
        </div>





</div><!-- .content-area -->

<?php get_footer(); ?>
