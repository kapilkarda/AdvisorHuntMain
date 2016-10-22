<?php

/* @var $this yii\web\View */
use webvimark\modules\UserManagement\models\User;
$this->title = 'AdviserHunter.com';

?>

<body class="header-fixed header-fixed-space home_page adv">

<div class="wrapper home_page adv">
    <!--=== Header v6 ===-->
                <!-- Collect the nav links, forms, and other content for toggling -->
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v6 ===-->


    <div class="scrollup header_search">
        <div class="box-content container">
                <fieldset class="top-logo-fieldsetclass row">
                       <div class="col-md-2 col-sm-4 col-xs-4"><a class="logo-margin" href="index.php"><img src="data/img/logo2-default.png" alt="Logo" ></a>&nbsp;</div> 
                        <!-- ------------WITH TAG LINE ---------------
                        <h3 class="search-header-top" style="color:#72C02C; text-align: center; margin: 0 auto; text-shadow: none; font-weight: normal; font-family: "Open Sans", Arial, sans-serif;">"Our Analytics will Find Best Pro. Guaranteed!!!"</h3>
                        <input name="query" autocomplete="off" type="text" id="request-query" class="input-text-search-top" style=" border-radius: 4px 4px 4px 4px; height: 38px; padding: 0 5px; line-height: 38px;" placeholder="What service do you need?" ng-model="$parent.$selection" aura-track="homepage/start service query" aura-track-on="keypress" aura-track-once="">&nbsp;
                        <input name="zipCode" id="service-zipcode" type="text" pattern="[0-9]*" class="input-text-zip-top"  style=" border-radius: 4px 4px 4px 4px; height: 38px; padding: 0 5px;" placeholder="Zip code" autocomplete="off" ng-model="zip" focus-when="" focus-me="">&nbsp;
                        <button class="btn-u-top" data-toggle="modal" data-target="#responsive"  style="border-radius: 4px 4px 4px 4px; height: 38px; padding: 0 5px;">Search</button>
                        --><div class="col-md-7 col-sm-8 col-xs-8 paddingL">
                                <datalist id="list">
                                    <option value="Additions & Remodels"></option>
                                    <option value="Appliances"></option>
                                    <option value="Architects & Engineers"></option>
                                    <option value="Bathrooms"></option>
                                    <option value="Cabinets & Countertops"></option>
                                    <option value="Carpentry"></option>
                                    <option value="Carpet"></option>
                                    <option value="Cleaning & Maid Service"></option>
                                    <option value="Concrete, Brick & Stone"></option>
                                    <option value="Decks & Porches"></option>
                                    <option value="Driveways, Patios & Walks"></option>
                                    <option value="Drywall & Insulation"></option>
                                    <option value="Electrical & Computers"></option>
                                    <option value="Fences"></option>
                                    <option value="Flooring & Hardwood"></option>
                                    <option value="Garages, Doors, Openers"></option>
                                    <option value="Handyman Services"></option>
                                    <option value="Heating & Cooling"></option>
                                    <option value="Kitchens"></option>
                                    <option value="Landscape"></option>
                                    <option value="Lawncare & Sprinklers"></option>
                                    <option value="Painting & Staining"></option>
                                    <option value="Plumbing"></option>
                                    <option value="Remodels"></option>
                                    <option value="Roofing & Gutters"></option>
                                    <option value="Siding"></option>
                                    <option value="Swimming Pools & Spas"></option>
                                    <option value="Tile & Stone"></option>
                                    <option value="Walls & Ceilings"></option>
                                     <option value="Windows & Doors"></option>
                                </datalist>
                        
                        <input name="query" list="list" autocomplete="off" type="text" id="request-query" class="navbar-search-box input-text-search" placeholder="What service do you need?" ng-model="$parent.$selection" aura-track="homepage/start service query" aura-track-on="keypress" aura-track-once="">
                        <button class="header_search_btn fa fa-search" data-toggle="modal" data-target="#responsive"></button>
                    </div>
                <div class="col-md-3 col-sm-0 col-xs-0">
                    <ul class="menu-icons-list list-unstyled list-inline text-right">
                     <?php
                        if ( Yii::$app->user->isGuest )
                        { ?>

                            <li class="menu-icons"><a class="nav-button btn btn-default" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/userlogin"> Sign-in </a></li>
                            <!--<li class="menu-icons">&nbsp;|&nbsp;</li>-->
                            <li class="menu-icons"><a class="nav-button btn btn-success" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/registration"> Register </a></li>
                            <!--<li class="menu-icons">&nbsp;|&nbsp;</li>-->
                      <?php  }
                        else
                        { ?>
                     <?php 
                            if(User::hasRole(['Provider'])){ 
                            ?>
                                <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=professional"> My Homes </a></li>
                            <?php
                            }
                            else{
                                ?>
                                    <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile"> My Homes </a></li>
                                <?php
                            }?>
                            <li class="menu-icons">&nbsp;|&nbsp;</li>
                            <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/logout"> Logout </a></li>
                            <li class="menu-icons">&nbsp;|&nbsp;</li>
                     <?php   } ?>
                        <!--<li class="menu-icons"> <a href="https://www.facebook.com/advisorhunter" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a> </li>&nbsp;&nbsp;-->
                        <!--<li class="menu-icons"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Skype"><i class="fa fa-skype"></i></a> </li>&nbsp;&nbsp;-->
                        <!--<li class="menu-icons"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Google Plus"><i class="fa fa-google-plus"></i></a> </li>&nbsp;&nbsp;-->
                        <!--<li class="menu-icons"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a> </li>&nbsp;&nbsp;-->
                        <!--<li class="menu-icons"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a> </li>-->
                    </ul> 
                </div>
                
                </fieldset>
                 
        </div>
    </div>
    
        <!-- Interactive Slider v2 -->
    <div class="interactive-slider-v2 img-v1">
        <div class="header-v6 header-classic-white">
            <div class="scroll_toggle container padding">
                <nav class = "navbar navbar-default" role = "navigation">
                <div class = "navbar-header">
                    <div><a href="index.php"><img class="shrink-logo" src="data/img/logo2-default.png" alt="Logo" width="85"></a></div>
                    <button type = "button" class ="navbar-toggle collapsed pull-left"  data-toggle = "collapse" data-target = "#example-navbar-collapse">
                        <span class = "sr-only">Toggle navigation</span>
                        <span class="icon-bar top-bar"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                  </button>
                </div>
                    <div class = "collapse navbar-collapse" id ="example-navbar-collapse">
                       <ul class = "nav navbar-nav menu-icons-list text-left">
                         <?php
                                                    if ( Yii::$app->user->isGuest )
                                                    { ?>
                                                        <li class="user_font"><span class="glyphicon glyphicon-user"></span></li>
                                                        <li><a class="nav-button" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/userlogin"> Sign-in </a></li>
                                                        <!--<li>&nbsp;|&nbsp;</li>-->
                                                        <li><a class="nav-button" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/registration"> Register </a></li>
                                                        <!--<li>&nbsp;|&nbsp;</li>-->
                                                  <?php  }
                                                    else
                                                    { ?>
                                                 <?php 
                                                        if(User::hasRole(['Provider'])){ 
                                                        ?>
                                                            <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=professional"> My Homes </a></li>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile"> My Homes </a></li>
                                                            <?php
                                                        }?>
                                                        <!--<li class="menu-icons">&nbsp;|&nbsp;</li>-->
                                                        <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/logout"> Logout </a></li>
                                                        <!--<li class="menu-icons">&nbsp;|&nbsp;</li>-->
                                                 <?php   } ?>
                                                    <!--<li class="menu-icons"><a class="special_link1 nav-button" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=site/prologin">Join</a></li>-->
                                                    <!--<li class="menu-icons social_link"> <a href="https://www.facebook.com/advisorhunter" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a> </li>&nbsp;&nbsp;-->
                                                    <!--<li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Skype"><i class="fa fa-skype"></i></a> </li>&nbsp;&nbsp;-->
                                                    <!--<li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Google Plus"><i class="fa fa-google-plus"></i></a> </li>&nbsp;&nbsp;-->
                                                    <!--<li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a> </li>&nbsp;&nbsp;-->
                                                    <!--<li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a> </li>-->
                                
                       </ul>
                       
                                                <div class="scroll_toggle_bottom">
                                                 <ul class="nav navbar-nav menu-icons-list list-unstyled text-left">
                                                        <li><a href="index.php">Home</a></li>
                                                        <li><a href="index.php">Find Professional</a></li>
                                                    </ul>
                                        
                                                 <div class="pro_scroll text-left"><a class="" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=site/prologin">
                                                            <span class="">&nbsp;&nbsp;&nbsp;Are you a Pro? <strong>>&nbsp;&nbsp;&nbsp;</strong></span>
                                                      
                                                        </a></div>
                                                </div>
                    </div>
                </nav>   
            </div>          
            
                <div class="container header_top">
                    <div class="row">
                        
                            <div class="navbar-brand1 col-md-2 col-sm-2 col-xs-2">
                                <a href="index.php">
                                    <img class="shrink-logo" src="data/img/logo1-default.png" alt="Logo">
                                </a>
                            </div>
                
                <div class="col-md-7 col-sm-4 col-xs-3"></div>
                            <div class="header-inner-right1 col-md-3 col-sm-6 col-xs-7 paddingL">
                                <ul class="menu-icons-list">
                                <?php
                                   if ( Yii::$app->user->isGuest )
                                   { ?>
           
                                       <li class="menu-icons"><a class="nav-button" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/userlogin"> Sign-in </a></li>
                                       <li class="menu-icons">&nbsp;|&nbsp;</li>
                                       <li class="menu-icons"><a class="nav-button" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/registration"> Register </a></li>
                                       <li class="menu-icons">&nbsp;|&nbsp;</li>
                                 <?php  }
                                   else
                                   { ?>
                                <?php 
                                       if(User::hasRole(['Provider'])){ 
                                       ?>
                                           <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=professional"> My Homes </a></li>
                                       <?php
                                       }
                                       else{
                                           ?>
                                               <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile"> My Homes </a></li>
                                           <?php
                                       }?>
                                       <li class="menu-icons">&nbsp;|&nbsp;</li>
                                       <li class="menu-icons"><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/logout"> Logout </a></li>
                                       <li class="menu-icons">&nbsp;|&nbsp;</li>
                                <?php   } ?>
                                   <!--<li class="menu-icons"><a class="special_link1 nav-button" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=site/prologin">Join</a></li>-->
                                   <li class="menu-icons social_link"> <a href="https://www.facebook.com/advisorhunter" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a> </li>&nbsp;&nbsp;
                                   <li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Skype"><i class="fa fa-skype"></i></a> </li>&nbsp;&nbsp;
                                   <li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Google Plus"><i class="fa fa-google-plus"></i></a> </li>&nbsp;&nbsp;
                                   <li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a> </li>&nbsp;&nbsp;
                                   <li class="menu-icons social_link"> <a href="#" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a> </li>
                            
                                </ul>
                               <nav> <ul class="menu-icons-list">
                               <br>
                                   <li class="special">
                                       <a class="special_link" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=site/prologin">
                                           <div class="special_txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Are you a Pro? <strong>></strong></div>
                                           <div class="pro_img"></div>
                                       </a>
                                   </li>
                               </ul>
                               </nav>
                            </div>
                    </div>
                    <!-- End Header Inner Right -->
                </div>    
                <div class="container header_bottom">
                <h1 class="hero-title">Hire Right Professionals</h1>
                <p class="margin-bottom-60">"Our Analytics will Find Best Pro. Guaranteed!!!"</p>
                <div class="box-content">
                    <fieldset>
                        <!-- <div class="form-field service-field" style="float: left; padding-top:5px;">
                            <span aura-hercule-typeahead="" class="ng-scope">
                                <input name="query" autocomplete="off" type="text" id="request-query" class="input-text-search1" style="border-radius: 4px 4px 4px 4px; height: 42px; padding: 0 12px; line-height: 42px; width:50%; " placeholder="What service do you need?" ng-model="$parent.$selection" aura-track="homepage/start service query" aura-track-on="keypress" aura-track-once="">&nbsp;&nbsp;
                            </span>
                        </div>
                        
                        <div class="form-field zip-field" data-sticky-partner="" style="float: left; padding-top:5px;">
                            <input name="zipCode" id="service-zipcode" type="text" pattern="[0-9]*" class="input-text-search2"  style="border-radius: 4px 4px 4px 4px; height: 42px; padding: 0 12px; line-height: 42px; width:27%; " placeholder="Zip code" autocomplete="off" ng-model="zip" focus-when="" focus-me="">&nbsp;&nbsp;
                        </div>
                        <div class="form-field zip-field" data-sticky-partner=""  >
                        <button class="btn-u" data-toggle="modal" data-target="#responsive"  style=" margin-top:5px;border-radius: 4px 4px 4px 4px; height: 42px; padding: 0 12px; line-height: 42px;">Search</button>
                        </div> -->
                        <input class="navbar-search-box input-text-search" name="query"  list="list" autocomplete="off" type="text" id="request-query" placeholder="What service do you need?" ng-model="$parent.$selection" aura-track="homepage/start service query" aura-track-on="keypress" aura-track-once="">
                        <button class="btn-u" data-toggle="modal" data-target="#responsive">Search</button>
                    </fieldset>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- End Interactive Slider v2 -->


        <!-- Search Modal Form -->
        <div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                 <div class="tag-box tag-box-v2 margin-bottom-40">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel4">We'll introduce you to pros ready to complete your project.</h4>
                        <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                        </div>
                    </div>
                    <div class="modal-body">
                    <form action="#" class="sky-form">
                        <div class="row">
                            <div class="col-md-1">
                                <!--<i class="fa fa-info-circle" style="color:#72c02c; font-size: 3.5em;"></i> -->
                            </div>
                            <div class="col-md-10">
                                <h4><i class="fa fa-info-circle"></i>What do you need done?</h4>
                                
                                <!--<div class="tag-box tag-box-v2 margin-bottom-40">
                            <h2>Expedita distinctio lorem ipsum!</h2>
                            <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                        </div>-->
                        
                        
                                <p><input class="form-control" type="text" placeholder="Name" /></p>
                                <div>
                                    <label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Install</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Repair</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Replace</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Move</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Inspect</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Troubleshoot a problem</label>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-u-modal-popup btn-u-primary" style="">Continue</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal Form -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- =================================================================    MENU MENU ============================================================================ -->
<div class="wrapper">
    <!--=== Header ===-->
  <div class="header header-sticky">
        <div class="container">


        <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                    <!-- Home -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-gavel"></i> Legal
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Invoice Page -->
                            <li><a href="page_invoice.php">Divorce and Family Law Attorney</a></li>
                            <!-- End Invoice Page -->

                            <!-- Clients Page -->
                            <li><a href="page_clients.php">Personal Injury Attorney</a></li>
                            <!-- End Clients Page -->

                            <!-- Column Pages -->
                            <li><a href="page_3_columns.html">Wills and Estate Planning</a></li>
                            <!-- End Column Pages -->

                            <!-- Privacy Policy -->
                            <li><a href="page_privacy.html">Immigration Attorney</a></li>
                            <!-- End Privacy Policy -->

                            <!-- Terms of Service -->
                            <li><a href="page_terms.html">Bankruptcy Attorney</a></li>
                            
                            <!-- End Terms of Service -->

                        </ul>
                    </li>
                    <!-- End Home -->
                    <!-- Home -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-camera"></i> Events
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Invoice Page -->
                            <li><a href="page_invoice.html">Invoice Page</a></li>
                            <!-- End Invoice Page -->

                            <!-- Clients Page -->
                            <li><a href="page_clients.html">Clients Page</a></li>
                            <!-- End Clients Page -->

                            <!-- Column Pages -->
                            <li><a href="page_3_columns.html">Three Columns Page</a></li>
                            <!-- End Column Pages -->

                            <!-- Privacy Policy -->
                            <li><a href="page_privacy.html">Privacy Policy</a></li>
                            <!-- End Privacy Policy -->

                            <!-- Terms of Service -->
                            <li><a href="page_terms.html">Terms of Service</a></li>
                            <!-- End Terms of Service -->

                        </ul>
                    </li>
                    <!-- End Home -->
                    <!-- Home -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-book"></i> Lessons
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Invoice Page -->
                            <li><a href="page_invoice.html">Invoice Page</a></li>
                            <!-- End Invoice Page -->

                            <!-- Clients Page -->
                            <li><a href="page_clients.html">Clients Page</a></li>
                            <!-- End Clients Page -->

                            <!-- Column Pages -->
                            <li><a href="page_3_columns.html">Three Columns Page</a></li>
                            <!-- End Column Pages -->

                            <!-- Privacy Policy -->
                            <li><a href="page_privacy.html">Privacy Policy</a></li>
                            <!-- End Privacy Policy -->

                            <!-- Terms of Service -->
                            <li><a href="page_terms.html">Terms of Service</a></li>
                            <!-- End Terms of Service -->

                        </ul>
                    </li>
                    <!-- End Home -->

                    <!-- Pages -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-heartbeat"></i> Wellness
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Invoice Page -->
                            <li><a href="page_invoice.html">Yoga Lessons</a></li>
                            <!-- End Invoice Page -->

                            <!-- Clients Page -->
                            <li><a href="page_clients.html">Personal Training</a></li>
                            <!-- End Clients Page -->

                            <!-- Column Pages -->
                            <li><a href="page_3_columns.html">Massag Therapist</a></li>
                            <!-- End Column Pages -->

                            <!-- Privacy Policy -->
                            <li><a href="page_privacy.html">Immigration Attorney</a></li>
                            <!-- End Privacy Policy -->

                            <!-- Terms of Service -->
                            <li><a href="page_terms.html">Physical Therapy</a></li>
                            
                            <!-- End Terms of Service -->

                        </ul>
                    </li>
                    <!-- End Pages -->


                    <!-- Shortcodes -->
                    <li class="dropdown mega-menu-fullwidth">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i> Top Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="mega-menu-content disable-icons">
                                    <div class="container">
                                        <div class="row equal-height">
                                            <div class="col-md-3 equal-height-in">
                                                <ul class="list-unstyled equal-height-list">
                                                    <li ><h3>Photography</h3></li>

                                                    <!-- Typography -->
                                                    <li><a href="shortcode_typo_general.html"><i class="fa fa-sort-alpha-asc"></i>  Event Videography</a></li>
                                                    <li><a href="shortcode_typo_headings.html"><i class="fa fa-magic"></i> Wedding Videography</a></li>
                                                    
                                                    <li><a href="shortcode_typo_dividers.html"><i class="fa fa-ellipsis-h"></i> Picture Framing</a></li>
                                                    <li><a href="shortcode_typo_blockquote.html"><i class="fa fa-quote-left"></i> Portrait Photography</a></li>
                                                    <li><a href="shortcode_typo_boxshadows.html"><i class="fa fa-asterisk"></i> Video Editing</a></li>
                                                    <li><a href="shortcode_typo_testimonials.html"><i class="fa fa-comments"></i> Event Photography</a></li>
                                                    <li><a href="shortcode_typo_tagline_boxes.html"><i class="fa fa-tasks"></i>  Pet Photography</a></li>
                                                    <li><a href="shortcode_typo_grid.html"><i class="fa fa-align-justify"></i> Commercial Photography</a></li>
                                                    <li><a href="shortcode_typo_grid.html"><i class="fa fa-align-justify"></i> Wedding Photography</a></li>                                                 
                                                    <!-- Components -->
                                                    <li><a href="shortcode_compo_messages.html"><i class="fa fa-comment"></i> Engagement Photography</a></li>
                                                    <li><a href="shortcode_compo_labels.html"><i class="fa fa-tags"></i>  Headshot Photography</a></li>
                                                    <li><a href="shortcode_compo_media.html"><i class="fa fa-volume-down"></i> Sports Photography</a></li>
                                                    <li><a href="shortcode_compo_pagination.html"><i class="fa fa-arrows-h"></i>  Real Estate Photography</a></li>
                                                    <!-- End Photography -->
                                                </ul>
                                            </div>
                                            <div class="col-md-3 equal-height-in">
                                                <ul class="list-unstyled equal-height-list">
                                                    <li><h3>Home Service</h3></li>

                                                    <!-- Buttons -->
                                                    <li><a href="shortcode_btn_general.html"><i class="fa fa-flask"></i> General Buttons</a></li>
                                                    <li><a href="shortcode_btn_brands.html"><i class="fa fa-html5"></i> Brand &amp; Social Buttons</a></li>
                                                    <li><a href="shortcode_btn_effects.html"><i class="fa fa-bolt"></i> Loading &amp; Hover Effects</a></li>
                                                    <!-- End Buttons -->

                                                    <!-- Icons -->
                                                    <li><a href="shortcode_icon_general.html"><i class="fa fa-chevron-circle-right"></i> General Icons</a></li>
                                                    <li><a href="shortcode_icon_fa.html"><i class="fa fa-chevron-circle-right"></i> Font Awesome Icons</a></li>
                                                    <li><a href="shortcode_icon_line.html"><i class="fa fa-chevron-circle-right"></i> Line Icons</a></li>
                                                    <li><a href="shortcode_icon_glyph.html"><i class="fa fa-chevron-circle-right"></i> Glyphicons Icons (Bootstrap)</a></li>
                                                    <!-- End Icons -->
                                                </ul>
                                            </div>
                                            <div class="col-md-3 equal-height-in">
                                                <ul class="list-unstyled equal-height-list">
                                                    <li><h3>Personal Service</h3></li>

                                                    <!-- Common Elements -->
                                                    <li><a href="shortcode_thumbnails.html"><i class="fa fa-image"></i> Thumbnails</a></li>
                                                    <li><a href="shortcode_accordion_and_tabs.html"><i class="fa fa-list-ol"></i> Accordion &amp; Tabs</a></li>
                                                    <li><a href="shortcode_timeline1.html"><i class="fa fa-dot-circle-o"></i> Timeline Option 1</a></li>
                                                    <li><a href="shortcode_timeline2.html"><i class="fa fa-dot-circle-o"></i> Timeline Option 2</a></li>
                                                    <li><a href="shortcode_table_general.html"><i class="fa fa-table"></i> Tables</a></li>
                                                    <li><a href="shortcode_compo_progress_bars.html"><i class="fa fa-align-left"></i> Progress Bars</a></li>
                                                    <li><a href="shortcode_compo_panels.html"><i class="fa fa-columns"></i> Panels</a></li>
                                                    <li><a href="shortcode_carousels.html"><i class="fa fa-sliders"></i> Carousel Examples</a></li>
                                                    <li><a href="shortcode_maps_google.html"><i class="fa fa-map-marker"></i> Google Maps</a></li>
                                                    <li><a href="shortcode_maps_vector.html"><i class="fa fa-align-center"></i> Vector Maps</a></li>
                                                    <!-- End Common Elements -->
                                                </ul>
                                            </div>
                                            <div class="col-md-3 equal-height-in">
                                                <ul class="list-unstyled equal-height-list">
                                                    <li><h3>Web Design & Development</h3></li>

                                                    <!-- Forms -->
                                                    <li><a href="shortcode_form_general.html"><i class="fa fa-bars"></i> Common Bootstrap Forms</a></li>
                                                    <li><a href="shortcode_form_general1.html"><i class="fa fa-bars"></i> General Unify Forms</a></li>
                                                    <li><a href="shortcode_form_advanced.html"><i class="fa fa-bars"></i> Advanced Forms</a></li>
                                                    <li><a href="shortcode_form_layouts.html"><i class="fa fa-bars"></i> Form Layouts</a></li>
                                                    <li><a href="shortcode_form_layouts_advanced.html"><i class="fa fa-bars"></i> Advanced Layout Forms</a></li>
                                                    <li><a href="shortcode_form_states.html"><i class="fa fa-bars"></i> Form States</a></li>
                                                    <li><a href="shortcode_form_sliders.html"><i class="fa fa-bars"></i> Form Sliders</a></li>
                                                    <li><a href="shortcode_form_modals.html"><i class="fa fa-bars"></i> Modals</a></li>
                                                    <!-- End Forms -->

                                                    <!-- Infographics -->
                                                    <li><a href="shortcode_compo_charts.html"><i class="fa fa-pie-chart"></i> Charts &amp; Countdowns</a></li>
                                                    <!-- End Infographics -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- End Shortcodes -->


                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!-- === End Header === -->

    <!-- =================================================================    MENu MENU ============================================================================ -->
    
    
    
    
    
    
    
    
    
    
    <!--===Below Image Menu Yogita==-->
    <!--
   <div class="cube-portfolio container margin-bottom-60" style="border-bottom: 1px dotted #cccccc; width: 100%;">
        <div class="content-xs" style="padding-top: 0px; padding-bottom: 0px;">
            <div id="filters-container" class="cbp-l-filters-text" style="line-height: 5;">
             <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"><i class="glyphicon glyphicon-home"></i> Home </div> |
             <div data-filter=".identity" class="cbp-filter-item"> <i class="glyphicon glyphicon-book"></i> Events </div> |
             <div data-filter=".web-design" class="cbp-filter-item"><i class="glyphicon glyphicon-book"></i> Lessons </div> |
             <div data-filter=".graphic" class="cbp-filter-item"><i class="glyphicon glyphicon-heart"></i> Wellness </div> |
             <div data-filter=".logos" class="cbp-filter-item"><i class="glyphicon glyphicon-option-horizontal"></i> More </div> 
             
           </div>
        </div>
     </div>
</div>
-->
<!--=== End Below Image Menu
    
        <!--=== Header v6 ===-->

    <!--=== End Header v6 ===-->
    

    <!--=== Call To Action ===-->
    <!--<div class="call-action-v1 bg-color-light">
        <div class="container">
            <div class="call-action-v1-box">
                <div class="call-action-v1-in">
                    <p>Unify creative technology company providing key digital services and focused on helping our clients to build a successful business on web and mobile.</p>
                </div>
                <div class="call-action-v1-in inner-btn page-scroll">
                    <a href="#portfolio" class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-block">REGISTER TODAY</a>
                </div>
            </div>
        </div>
    </div>-->
    <!--=== End Call To Action ===-->

    <!-- About Info -->
    
    
    <!-- end edit -->    
    <div class="container content-md"> 
    <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">HIRE BEST <span class="color-green">PROFESSIONALS</span> </h2>
           
        </div>
                            
        <div class="row">       
            <div class="col-md-6">
                <h2 class="title-v2 title-center text-center">Find Out How</h2>
                <p>There are innumerable websites, which gives you hundreds of service professionals, but you want some one who would cater to you specific need within your budget. You must have had experiences where professionals didn’t meet your expectation either due to bad quality or delayed work. That is the thing of the past.</p>
                <p>In AdvisorHunter.com you would be able to get the best of professionals with the click of button. Our web analytics tool would give you the best of pros by their ratings and reviews, going through background checks and all of that considering the best price quote in the market. </p><br>
                <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-dark">Read More</a>
                <a href="#" class="btn-u">View Our Work</a>
            </div>
            <div class="col-md-6">
            <div class="responsive-video margin-bottom-30">
                        <iframe src="http://player.vimeo.com/video/47911018" width="530" height="300" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>                                 
                <!-- <img class="img-responsive" src="data/img/mockup/mockup1.png" alt="">  -->
            </div>
        </div>
    </div>
    <!-- End About Info -->

    <!--=== Parallax Quote ===-->
    <div class="parallax-quote parallaxBg">
        <div class="container">
            <div class="parallax-quote-in">
                <p>Ordinary professionals focus on giving worthless advises; <span class="color-green">extra-ordinary professionals focus on giving results.</span> </p>
                <small>- Ashish Patel -</small>
            </div>
        </div>
  </div>
    <!--=== End Parallax Quote ===-->

    <!--=== Service Blcoks ===-->
    <div class="container content-md">
        <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">FIND HOW THE <span class="color-green">ADVISORHUNTER</span> WORKS</h2>
            <p class="space-lg-hor">Our Analytics works by the inclusion of various inteligence methouds and <span class="color-green">analyzing the data</span> from various sources.  </p>
        </div>

        <!-- Service Blcoks -->
        <div class="row service-box-v1">
            <div class="col-md-4 col-sm-6 md-margin-bottom-40">
                <div class="service-block service-block-default no-margin-bottom">
                    <i class="icon-lg rounded-x icon icon-note"></i>
                    <h2 class="heading-sm">Place a Request</h2>
                    <p>Book a Service in your desired Category</p>
                    <ul class="list-unstyled">
                        <li>Search the Category</li>
                        <li>Enter few Simple Questions</li>
                        <li>Submit your contact Details</li> 
                        <li>Validate your Phone/Email and submit</li>                       
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 md-margin-bottom-40">
                <div class="service-block service-block-default no-margin-bottom">
                    <i class="icon-lg rounded-x icon-line icon-users"></i>
                    <h2 class="heading-sm">Analysis &amp; Get Best Quotes</h2>
                    <p>Service Partners will reach out to you with prices that suit your budget.</p>
                    <ul class="list-unstyled">
                        <li>Professionals will send quotes</li>
                        <li>Analytics will scan best quotest</li>
                        <li>You will receive top quotes</li>
                        <li>Chat with Professionals</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="service-block service-block-default no-margin-bottom">
                    <i class="icon-lg rounded-x icon-line icon-trophy"></i>
                    <h2 class="heading-sm">Hire the Best Professional</h2>
                    <p>Look through all submited bids from verified professionals, chat with them and hire.</p>
                    <ul class="list-unstyled">
                        <li>Review submited Quotes</li>
                        <li>Hire the best Pro</li>
                        <li>Schedule Appointment</li>
                        <li>Complete Project and leave feedback</li>                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Service Blcoks -->
    </div>
    <!--=== End Service Blcoks ===-->

    <!--=== Carallax Counter v1 ===-->
        <div class="parallax-counter-v1 parallaxBg" style="background-position: 50% 20px;">
        <div class="container">
            <h2 class="title-v2 title-light title-center">SOME FACTS AND SERVICES</h2>
            <p class="space-xlg-hor text-center color-light">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.</p>

            <div class="margin-bottom-40"></div>

            <div class="row margin-bottom-10">
                <div class="col-sm-3 col-xs-6">
                    <div class="counters">
                        <span class="counter">10629</span>
                        <h4>Users</h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="counters">
                        <span class="counter">277</span>
                        <h4>Projects</h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="counters">
                        <span class="counter">78</span>
                        <h4>Team Members</h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="counters">
                        <span class="counter">109</span>
                        <h4>Awards</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=== End Carallax Counter v1 ===-->

    <!--=== Team v4 ===-->
    <div class="container content-sm">
        <div class="headline-center margin-bottom-60">
            <h2>MEET OUR TEAM</h2>
            <p>Phasellus vitae ipsum ex. Etiam eu vestibulum ante. <br>
            Lorem ipsum <strong>dolor</strong> sit amet, consectetur adipiscing elit. Morbi libero libero, imperdiet fringilla </p>
        </div>

        <div class="row team-v4">
            <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                <img class="img-responsive" src="data/img/team/img15-md.jpg" alt="">
                <span>Daniel Wearne</span>
                <small>- Technica Director -</small>
                <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed a nulla non</p>
                <ul class="list-inline team-social-v4">
                    <li><a href="#"><i class="rounded-x fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                <img class="img-responsive" src="data/img/team/img31-md.jpg" alt="">
                <span>Sara Lisbon</span>
                <small>- UI Designer -</small>
                <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed a nulla non</p>
                <ul class="list-inline team-social-v4">
                    <li><a href="#"><i class="rounded-x fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 sm-margin-bottom-50">
                <img class="img-responsive" src="data/img/team/img18-md.jpg" alt="">
                <span>John Doe</span>
                <small>- Backend Developer -</small>
                <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed a nulla non</p>
                <ul class="list-inline team-social-v4">
                    <li><a href="#"><i class="rounded-x fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6">
                <img class="img-responsive" src="data/img/team/img37-md.jpg" alt="">
                <span>Alice Williams</span>
                <small>- Customer Support -</small>
                <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed a nulla non</p>
                <ul class="list-inline team-social-v4">
                    <li><a href="#"><i class="rounded-x fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="rounded-x fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!--/end row-->
    </div>
    <!--=== End Team v4 ===-->

    <!--=== Testimonials v6 ===-->
    <div class="bg-color-light">
        <div class="container content-sm">
            <div class="headline-center margin-bottom-60">
                <h2>WHAT PEOPLE SAY</h2>
                <p>Phasellus vitae ipsum ex. Etiam eu vestibulum ante. <br>
                Lorem ipsum <strong>dolor</strong> sit amet, consectetur adipiscing elit. Morbi libero libero, imperdiet fringilla </p>
            </div>

            <!-- Testimonials Wrap -->
            <div class="testimonials-v6 testimonials-wrap">
                <div class="row margin-bottom-50">
                    <div class="col-md-6 md-margin-bottom-50">
                        <div class="testimonials-info rounded-bottom">
                            <img class="rounded-x" src="data/img/testimonials/img5.jpg" alt="">
                            <div class="testimonials-desc">
                                <p>Donec quis lorem sit amet nibh tempor porttitor non eu justo. Fusce iaculis scelerisque nibh at rhoncus. Aliquam blandit.</p>
                                <strong>Evan Bohringer</strong>
                                <span>Web Developer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="testimonials-info rounded-bottom">
                            <img class="rounded-x" src="data/img/testimonials/img6.jpg" alt="">
                            <div class="testimonials-desc">
                                <p>Donec quis lorem sit amet nibh tempor porttitor non eu justo. Fusce iaculis scelerisque nibh at rhoncus. Aliquam blandit.</p>
                                <strong>Sara Lisbon</strong>
                                <span>Designer</span>
                            </div>
                        </div>
                    </div>
                </div><!--/end row-->

                <div class="row margin-bottom-20">
                    <div class="col-md-6 md-margin-bottom-50">
                        <div class="testimonials-info rounded-bottom">
                            <img class="rounded-x" src="data/img/testimonials/img3.jpg" alt="">
                            <div class="testimonials-desc">
                                <p>Donec quis lorem sit amet nibh tempor porttitor non eu justo. Fusce iaculis scelerisque nibh at rhoncus. Aliquam blandit.</p>
                                <strong>Alice Williams</strong>
                                <span>Web Developer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="testimonials-info rounded-bottom">
                            <img class="rounded-x" src="data/img/testimonials/img2.jpg" alt="">
                            <div class="testimonials-desc">
                                <p>Donec quis lorem sit amet nibh tempor porttitor non eu justo. Fusce iaculis scelerisque nibh at rhoncus. Aliquam blandit.</p>
                                <strong>Jane Wearne</strong>
                                <span>Technical Direector</span>
                            </div>
                        </div>
                    </div>
                </div><!--/end row-->
            </div>
            <!-- End Testimonials Wrap -->
        </div><!--/end container-->
    </div>
    <!--=== End Testimonials v6 ===-->

</body>
<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>

<!--<script type="text/javascript">
  $(window).load(function() {           
  var i =0; 
  var images = ['../web/data/img/slide-2.jpg','../web/data/img/18.jpg'];
  var image = $('.interactive-slider-v2');
                //Initial Background image setup
  image.css('background-image', 'url(../web/data/img/18.jpg)');
   image.css('background-color', 'transparent');
                //Change image at regular intervals
  setInterval(function(){   
   image.fadeOut(500, function () {image.css('background-image', 'url(' + images [i++] +')'); 
   
   image.fadeIn(500);
   });
   if(i == images.length)
    i = 0;
  }, 3000);            
 });
</script>-->

<script>
    
    $(window).load(function () {
    var body = $('.interactive-slider-v2');
    var backgrounds = [
      'url(../web/data/img/bg/14.jpg)', 
      'url(../web/data/img/18.jpg)'];
    var current = 0;
    function nextBackground() {
        body.css('background',backgrounds[current = ++current % backgrounds.length]);
        body.css('background-size', '100% 100%');
        setTimeout(nextBackground, 5000);
    }
    setTimeout(nextBackground, 5000);
    body.css('background', backgrounds[0]);
});
</script>
<script>
$(window).resize(function(){
	if ($(window).width() >=320){	
        }
	
});
</script>


