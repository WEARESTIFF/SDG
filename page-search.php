<?php
/**
 * Template Name: Search - temporary
 *
 * @package WordPress
 * @subpackage sTheme
 * @since sTheme 1.0
 */

get_header(); ?>

<div id="primary" class="content-area search">

    <div class="page-title-section">
      <div class="container relative">
        <h1>Yoink Someone <a class="need-help" href="#">Need some help?</a></h1>

        <?/* php the_title( '<h1 class="entry-title">', '</h1>' ); */?>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div id="custom_sidebar" class="col-xs-12 col-sm-3">

          <div class="sidebar-widget">
            <h3 class="sidebar-widget-title"><span>Step 1</span> - Set your standards</h3>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea</p>
          </div> <!-- ./sidebar-widget -->

          <div class="sidebar-widget">
            <h3 class="sidebar-widget-title"><span>Step 2</span> - Characteristics</h3>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
          </div> <!-- ./sidebar-widget -->

        </div><!-- #/custom_sidebar -->


        <main id="main" class="site-main search col-xs-12 col-sm-9" role="main">
          <form class="default-main-form" action="#" method="post">
            <div class="row">
              <div class="form-group">
                <div class="col-xs-6">
                  <label>LOCATION</label>
                  <input class="form-control" type="text" name="location" placeholder="Ottawa"/>
                </div>
                <div class="col-xs-6">
                  <label>SEARCH DISTANCE</label>
                  <input class="form-control" type="text" name="search-distance" placeholder="Select a search radious..."/>
                </div>
              </div> <!-- ./form-group -->
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-xs-6">
                  <label>ROLE TYPE</label>
                  <input class="form-control" type="text" name="location" placeholder="Select a role type..."/>
                </div>
                <div class="col-xs-6">
                  <label>SECTOR</label>
                  <input class="form-control" type="text" name="search-distance" placeholder="Select a employment sector..."/>
                </div>
              </div> <!-- ./form-group -->
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-xs-6">
                  <label>SAVE SEARCH</label>
                  <input class="form-control" type="text" name="location" placeholder="Choose a name for this search..."/>
                </div>
                <div class="col-xs-6">
                  <label>EXPERIENCE</label>
                  <input class="form-control" type="text" name="search-distance" placeholder="Select the level of experience..."/>
                </div>
              </div> <!-- ./form-group -->
            </div>
          </form>

          <div class="interests-group">
            <div class="row">
              <div class="col-xs-12 col-sm-4 interest-item">
                <h3 class="item-title text-center"><span class="custom-glove-ico"></span>TEAM</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>

                <div class="interest-status">
                  <input id="team-status" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="75"/>
                </div>
              </div> <!-- ./interest-item -->

              <div class="col-xs-12 col-sm-4 interest-item">
                <h3 class="item-title text-center"><span class="custom-plane-ico"></span>TRAVEL</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>

                <div class="interest-status">
                  <input id="travel1-status" data-slider-id='ex2Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="75"/>
                </div>
              </div> <!-- ./interest-item -->

              <div class="col-xs-12 col-sm-4 interest-item">
                <h3 class="item-title text-center"><span class="custom-shirt-ico"></span>TRAVEL</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="interest-status">
                  <input id="travel2-status" data-slider-id='ex3Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="75"/>
                </div>
              </div> <!-- ./interest-item -->

              <div class="col-xs-12 col-sm-4 interest-item">
                <h3 class="item-title text-center"><span class="custom-hand-ico"></span>INTERACTIVITY</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="interest-status">
                  <input id="interactivity-status" data-slider-id='ex4Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="75"/>
                </div>
              </div> <!-- ./interest-item -->

              <div class="col-xs-12 col-sm-4 interest-item">
                <h3 class="item-title text-center"><span class="custom-processor-ico"></span>TECHNICAL</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="interest-status">
                  <input id="technical-status" data-slider-id='ex5Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="75"/>
                </div>
              </div> <!-- ./interest-item -->

              <div class="col-xs-12 col-sm-4 interest-item">
                <h3 class="item-title text-center"><span class="custom-money-ico"></span>MONEY</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="interest-status">
                  <input id="money-status" data-slider-id='ex6Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="75"/>
                </div>
              </div> <!-- ./interest-item -->
            </div>
          </div> <!-- ./interests-group -->
        </main><!-- .site-main -->
      </div> <!-- ./row -->
    </div><!-- .container -->



</div><!-- .content-area -->

<?php get_footer(); ?>
