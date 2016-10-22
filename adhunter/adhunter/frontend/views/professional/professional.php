 <?php	
		ini_set("display_startup_errors", 1);
		ini_set("display_errors", 1);

		/* Reports for either E_ERROR | E_WARNING | E_NOTICE  | Any Error*/
		error_reporting(E_ALL);

		

		/**
		 * Yelp API v2.0 code sample.
		 *
		 * This program demonstrates the capability of the Yelp API version 2.0
		 * by using the Search API to query for businesses by a search term and location,
		 * and the Business API to query additional information about the top result
		 * from the search query.
		 * 
		 * Please refer to http://www.yelp.com/developers/documentation for the API documentation.
		 * 
		 * This program requires a PHP OAuth2 library, which is included in this branch and can be
		 * found here:
		 *      http://oauth.googlecode.com/svn/code/php/
		 * 
		 * Sample usage of the program:
		 * `php sample.php --term="bars" --location="San Francisco, CA"`
		 */

		// Enter the path that the oauth library is in relation to the php file
		require_once('lib/OAuth.php');

		// Set your OAuth credentials here  
		// These credentials can be obtained from the 'Manage API Access' page in the
		// developers documentation (http://www.yelp.com/developers)
		$CONSUMER_KEY = "AF3NTFYNcegRJdbCwMqsLQ";
		$CONSUMER_SECRET = "h_nQNm04Sa6HiMMbpnasdNota2U";
		$TOKEN = "pa9OsO_3YNca3hlday6gfwPKTKE4Tm9g";
		$TOKEN_SECRET = "bVs1axXCZvQy1Q9Gzna8ZwL-gsk";

		
		$API_HOST = 'api.yelp.com';
		
		if (isset($_REQUEST['search']))
			{
				$DEFAULT_TERM = $_GET['search']; //'yoga';
				$DEFAULT_TERM = url_decode($DEFAULT_TERM);
				
			}
		else
			{
				$DEFAULT_TERM = 'yoga';
			}
			
		if (isset($_REQUEST['state']))
			{
				$DEFAULT_STATE = strtoupper($_GET['state']); 
			}
		else
			{
				$DEFAULT_STATE = 'CA';
			}
			
		if (isset($_REQUEST['city']))
			{
				$DEFAULT_CITY = $_GET['city']; 
				$DEFAULT_CITY = url_decode($DEFAULT_CITY);
			}
		else
			{
				$DEFAULT_CITY = 'Fremont';
			}
		 $DEFAULT_LOCATION=$DEFAULT_CITY . ", " . $DEFAULT_STATE;
// 		echo $DEFAULT_LOCATION;
		$SEARCH_LIMIT = 20;
		$SEARCH_PATH = '/v2/search/';
		$BUSINESS_PATH = '/v2/business/';


		/** 
		 * Makes a request to the Yelp API and returns the response
		 * 
		 * @param    $host    The domain host of the API 
		 * @param    $path    The path of the APi after the domain
		 * @return   The JSON response from the request      
		 */
		function request($host, $path) {
			$unsigned_url = "https://" . $host . $path;

			// Token object built using the OAuth library
			$token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);

			// Consumer object built using the OAuth library
			$consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);

			// Yelp uses HMAC SHA1 encoding
			$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

			$oauthrequest = OAuthRequest::from_consumer_and_token(
				$consumer, 
				$token, 
				'GET', 
				$unsigned_url
			);
	
			// Sign the request
			$oauthrequest->sign_request($signature_method, $consumer, $token);
	
			// Get the signed URL
			$signed_url = $oauthrequest->to_url();
	
			// Send Yelp API Call
			$ch = curl_init($signed_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);
	
			return $data;
		}
		
		
		function url_decode($in) 
			{ 
			 $str = str_replace('_', ' ', $in); 
			 return $str ;
			} 


		/**
		 * Query the Search API by a search term and location 
		 * 
		 * @param    $term        The search term passed to the API 
		 * @param    $location    The search location passed to the API 
		 * @return   The JSON response from the request 
		 */
		function search($term, $location) {
			$url_params = array();
	
			$url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
			$url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
			$url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
			$search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);
	
			return request($GLOBALS['API_HOST'], $search_path);
		}

		/**
		 * Query the Business API by business_id
		 * 
		 * @param    $business_id    The ID of the business to query
		 * @return   The JSON response from the request 
		 */
		function get_business($business_id) {
			$business_path = $GLOBALS['BUSINESS_PATH'] . $business_id;
	
			return request($GLOBALS['API_HOST'], $business_path);
		}

		/**
		 * Queries the API by the input values from the user 
		 * 
		 * @param    $term        The search term to query
		 * @param    $location    The location of the business to query
		 */
		function query_api($term, $location) {     
			$response = json_decode(search($term, $location));
			$business_id = $response->businesses[0]->id;
			$image_url=$response->businesses[0]->image_url;
			$snippet_image_url=$response->businesses[0]->snippet_image_url;
			$phone=$response->businesses[0]->phone;
			$display_address_0=$response->businesses[0]->location->display_address[0];
			$display_address_1=$response->businesses[0]->location->display_address[1];
			$snippet_text=$response->businesses[0]->snippet_text;
	
		  
		 print sprintf(
        "%d businesses found, querying business info for the top result \"%s\"\n\nPhone=%s   <br> %s%s<br>%s",         
        count($response->businesses),
        $business_id,$phone,$display_address_0,$display_address_1,$snippet_text
    	);
    }

		/**
		 * User input is handled here 
		 */
		$longopts  = array(
			"term::",
			"location::",
		);
	
		$options = getopt("", $longopts);

		$term = $options['term'] ?: '';
		$location = $options['location'] ?: '';

		//query_api($term, $location);

		?>
	<?php
			$response = json_decode(search($term, $location));
			$recordNumners = count($response->businesses);
			$recordNumners =floor($recordNumners/2);
		
	?>
	
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Popular <?php echo ucfirst($DEFAULT_TERM); ?> Pro In <?php echo ucfirst($DEFAULT_CITY); ?>, <?php echo ucfirst($DEFAULT_STATE); ?> | advisorhunter.com</title>
	<meta name="title" content="<?php echo ucfirst($DEFAULT_TERM); ?> Professionals In <?php echo ucfirst($DEFAULT_CITY); ?>, <?php echo ucfirst($DEFAULT_STATE); ?> | advisorhunter.com">
	<meta name="description" content="Hire <?php echo ucfirst($DEFAULT_TERM); ?> Pro in <?php echo ucfirst($DEFAULT_CITY); ?>, <?php echo ucfirst($DEFAULT_STATE); ?>,  <?php echo ucfirst($DEFAULT_TERM); ?> rates, <?php echo $response->businesses[0]->snippet_text; ?><?php echo ucfirst($DEFAULT_TERM); ?> jobs in <?php echo ucfirst($DEFAULT_CITY); ?> , Best <?php echo ucfirst($DEFAULT_TERM); ?> Contractors in <?php echo ucfirst($DEFAULT_CITY); ?>">
	<meta name="keywords" content="AdvisorHunter, <?php echo ucfirst($DEFAULT_TERM); ?>, Hire <?php echo ucfirst($DEFAULT_TERM); ?>, <?php echo ucfirst($DEFAULT_TERM); ?> Contrator, Best <?php echo ucfirst($DEFAULT_TERM); ?> Pro in <?php echo ucfirst($DEFAULT_CITY); ?>, <?php echo ucfirst($DEFAULT_STATE); ?>">
	
	<meta http-equiv="Cache-Control" content="no-cache">
	
	<?php include 'resources.php';?>
    

    <!-- CSS Implementing Plugins -->

    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>

<div class="wrapper">
    <!--=== Header ===-->
    <?php include 'header.php';?>
    <!--=== End Header ===-->

  
   

	<!--=== Breadcrumbs ===-->
		<div class="breadcrumbs">
			<div class="container">
				<h1 class="pull-left"><?php echo ucfirst($DEFAULT_TERM); ?> Professionals In <?php echo ucfirst($DEFAULT_CITY); ?>, <?php echo ucfirst($DEFAULT_STATE); ?></h1>
				<ul class="pull-right breadcrumb">
					<li><a href="http://advisorhunter.com">Home</a></li>
					<li><a href=""><?php echo ucfirst($DEFAULT_STATE); ?></a></li>
					<li><a href=""><?php echo ucfirst($DEFAULT_CITY); ?></a></li>
					<li class="active"><a href="#"><?php echo ucfirst($DEFAULT_TERM); ?></a></li>
				</ul>
			</div><!--/container-->
		</div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->
    
    <div class="container content-sm">
        <div class="headline-center margin-bottom-60">
            <h2><?php echo ucfirst($DEFAULT_TERM); ?> Pros Ready for your Help</h2>
            <p>Find some of the best Service professionals in your area. <br>
            </p>
        </div>
        

        <!-- Testimonials Wrap -->
        
        <div class="testimonials-v6 testimonials-wrap">
        <?php
        		$xx=0;
            	$yy=1;
            	for ($x = 0; $x < $recordNumners; $x++) { 
            	// $xx=$x;
//             	$yy=$x+1;
            	//$business_id = $response->businesses[$xx]->id;
            	$name= $response->businesses[$xx]->name;				
				if ( isset($response->businesses[$xx]->image_url)) {
					   $image_url=$response->businesses[$xx]->image_url;
					}
				else
				{
					$image_url="";
				}	
				$snippet_image_url=$response->businesses[$xx]->snippet_image_url;
				//$phone=$response->businesses[$xx]->phone;
				$display_address_0=$response->businesses[$xx]->location->display_address[0];				
				if (  isset($response->businesses[$xx]->location->display_address[1])) {
					   $display_address_1=$response->businesses[$xx]->location->display_address[1];
					}
				else
				{
					$display_address_1="";
				}				
				$snippet_text=$response->businesses[$xx]->snippet_text;
				$review_count=$response->businesses[$xx]->review_count;
				$rating_img_url_small=$response->businesses[$xx]->rating_img_url_small;
				
				
				//$business_id_b = $response->businesses[$yy]->id;
				$name_b= $response->businesses[$yy]->name;
				if ( isset($response->businesses[$yy]->image_url)) {
					   $image_url_b=$response->businesses[$yy]->image_url;
					}
				else
				{
					$image_url_b="";
				}
				$snippet_image_url_b=$response->businesses[$yy]->snippet_image_url;
				//$phone_b=$response->businesses[$yy]->phone;
				$display_address_0_b=$response->businesses[$yy]->location->display_address[0];
				if (  isset($response->businesses[$yy]->location->display_address[1])) {
					   $display_address_1_b=$response->businesses[$yy]->location->display_address[1];
					}
				else
				{
					$display_address_1_b="";
				}
				
				$snippet_text_b=$response->businesses[$yy]->snippet_text;
				$review_count_b=$response->businesses[$yy]->review_count;
				$rating_img_url_small_b=$response->businesses[$yy]->rating_img_url_small;
				
				$xx=$xx+2;
            	$yy=$yy+2;
            ?>
            
            <div class="row margin-bottom-50">
                <div class="col-md-6 md-margin-bottom-50">
                    <div class="testimonials-info rounded-bottom bg-color-light">
                    
                        <img class="rounded-x" src="<?php echo $snippet_image_url; ?>" alt="">
                        <div class="testimonials-desc">
                        	<strong><?php echo 	$name; ?></strong>
                            <span><?php echo $display_address_0; ?></span>
                            <span><?php echo $display_address_1; ?></span>
                            <br>
                            <img src="<?php echo $rating_img_url_small; ?>" alt="Yelp Rating"><span><?php echo $review_count;?> Yelp Review</span>
                            <br>
                            <blockquote><p><em>"<?php echo $snippet_text; ?>"</em></p></blockquote>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonials-info rounded-bottom bg-color-light">
                    
                        <img class="rounded-x" src="<?php echo $snippet_image_url_b; ?>" alt="">
                        <div class="testimonials-desc">
                        	<strong><?php echo 	$name_b; ?></strong>
                            <span><?php echo $display_address_0_b; ?></span>
                            <span><?php echo $display_address_1_b; ?></span>
                            <br>
                            <img src="<?php echo $rating_img_url_small_b; ?>" alt="Yelp Rating"><span><?php echo $review_count_b;?> Yelp Review</span>
                            <br>
                            <blockquote><p><em>"<?php echo $snippet_text_b; ?>"</em></p></blockquote>
                            
                        </div>
                        
                    </div>
                </div>
            </div><!--/end row-->
            
            <?php 
            	
            	
                }
            ?>
           
        </div>

            
        
        <!-- End Testimonials Wrap -->
        
    </div><!--/end container-->

    

    <!--=== Footer Version 1 ===-->
<?php include 'footer.php';?>
    <!--=== End Footer Version 1 ===-->
</div>

<!-- JS Global Compulsory -->
<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="assets/plugins/jquery.parallax.js"></script>
<script type="text/javascript" src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/plugins/owl-carousel.js"></script>
<script type="text/javascript" src="assets/js/plugins/style-switcher.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      	App.init();
        App.initParallaxBg();
        OwlCarousel.initOwlCarousel();
        StyleSwitcher.initStyleSwitcher();
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
