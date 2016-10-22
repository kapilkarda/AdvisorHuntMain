'use strict';


var serviceBase = 'http://'+location.hostname+'/Advisorhunter/adhunter/adhunter/api/web/v1/';
// var serviceBase = 'http://52.20.134.132/Advisorhunter/adhunter/adhunter/api/web/v1/';
var S3uploadsBase = 'https://s3-us-west-2.amazonaws.com/site.advisorhunter/';

//var serviceBase = 'http://localhost/Advisorhunter/adhunter/adhunter/api/web/v1/'

// Declare app level module which depends on views, and components
var adhunterApp = angular.module('adhunterApp', [
  'ui.router',
  'ui.bootstrap',
  'ui.bootstrap.tpls',
  'ngCookies' ,
  'countTo',
  'angularUtils.directives.dirPagination',
]);


adhunterApp.config(function($stateProvider, $httpProvider) {
  	$stateProvider

  	.state('home', {
		url:'/',
		views: {
	        'home': {
		        templateUrl: 'home.html',
				controller: 'home',
				controllerAs: 'homeCtrl'
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
      	}		
	})

	.state('search', {
		url:'/search',
		views: {
			'header': {
		        templateUrl: 'views/nav-header.html',
	        },
	        'search-pro': {
		        templateUrl: 'views/search-pro.html',
        		controller: 'searchpro',
				controllerAs: 'searchproCtrl'
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    } 
        
    })

    .state('pro', {
		url:'/pro/:proid',
		views: {
			'header':{
				templateUrl: 'views/nav-header.html'
			},
			
	        'pro': {
		        templateUrl: 'views/pro.html',
        		controller: 'showpro',
				controllerAs: 'showproCtrl'
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }

    })

 	.state('proaccount', {
		url:'/proaccount',
		views: {
			'header':{
				templateUrl: 'views/nav-header.html'
			},
			
	        'pro-account': {
		        templateUrl: 'views/pro-account.html',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
    })

	.state('proaccount.pro-signup', {
		url:'/pro-signup',
		views:{
			'pro-signup':{
		 		templateUrl: 'views/proaccount-signup.html',
		 		controller: 'proaccount',
				controllerAs: 'proaccountCtrl'
		 }
	 }
    })

	.state('proaccount.add-company', {
		url:'/add-company',
		views:{
			'pro-add-company':{
				templateUrl: 'views/proaccount-businessprofile.html',
				controller: 'pro-add-company',
				controllerAs: 'proaccountaddCtrl'
		
			}
		}
    })

 	.state('myprofile', {
		url:'/profile',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
			
	        'pro-account': {
		        templateUrl: 'views/myprofile.html',
		        controller: 'myprofile',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
    })


	.state('dashboard', {
		url:'/dashboard',
        templateUrl: 'views/dashboard.html',
        controller: 'dashboard',
    })

	.state('dashboard.provider', {
		url:'',
		views: {
			'header':{
					templateUrl: 'views/pro-header.html'
			},
	        'provider': {
		        templateUrl: 'views/dashboard/provider-dashboard.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
	})

	.state('dashboard.customer', {

		url:'',
		parent : 'dashboard',
		views: {
	        'customer': {
		        templateUrl: 'views/customer.html',
				controller: 'customer',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }  
	})

	.state('dashboard.projects', {
		url:'/projects',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-projects': {
		        templateUrl: 'views/dashboard/prouser-project.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
	        	templateUrl: 'views/footer.html',
        	}
	    }   
	})

	.state('dashboard.contacts', {			
		url:'/contacts',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-contacts': {
		        templateUrl: 'views/dashboard/prouser-contacts.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
	        	templateUrl: 'views/footer.html',
        	}
	    }   
	})

	.state('dashboard.mailbox', {
		url:'/mailbox',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-mailbox': {
		        templateUrl: 'views/dashboard/prouser-mailbox.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
	        	templateUrl: 'views/footer.html',
        	}
	    }   
	})

	.state('dashboard.eventcalender', {
		url:'/eventcalender',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-calender': {
		        templateUrl: 'views/dashboard/prouser-eventcalender.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
	})

	.state('dashboard.invoice', {
		url:'/invoice',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-calender': {
		        templateUrl: 'views/dashboard/prouser-invoice.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
	})

	.state('dashboard.token', {
		url:'/token',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-calender': {
		        templateUrl: 'views/dashboard/prouser-token.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
	})

	.state('dashboard.referral', {
		url:'/referral',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-referral': {
		        templateUrl: 'views/dashboard/prouser-referral.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
	})

	.state('dashboard.settings', {
		url:'/settings',
		views: {
			'header':{
				templateUrl: 'views/pro-header.html'
			},
	        'prouser-setting': {
		        templateUrl: 'views/dashboard/prouser-setting.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'views/footer.html',
	        }
	    }   
	})

	.state('404', {
		url:'/404',
		views: {
			// 'header':{
			// 	templateUrl: 'views/nav-header.html'
			// },
			'404': {
				templateUrl: 'views/404.html',
			},
			// 'footer': {
			// 	templateUrl: 'views/footer.html',
			// }
		}
	})

	.state('401', {
		url:'/401',
		views: {
			'401': {
				templateUrl: 'views/401.html',
			},
		}
	})

    $httpProvider.interceptors.push('authInterceptor');

    $httpProvider.defaults.useXDomain = true;
    // delete $httpProvider.defaults.headers.common['X-Requested-With'];
    // $httpProvider.defaults.withCredentials = true;

	$httpProvider.defaults.headers.options = {};
	// $httpProvider.defaults.headers.common = {};
	// $httpProvider.defaults.headers.post = {};
	// $httpProvider.defaults.headers.put = {};
	// $httpProvider.defaults.headers.patch = {};

});
