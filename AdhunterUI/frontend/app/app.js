'use strict';


// var serviceBase = 'http://'+location.hostname+'/Advisorhunter/adhunter/adhunter/api/web/v1/';
// var serviceBase = 'http://52.20.134.132/Advisorhunter/adhunter/adhunter/api/web/v1/';
var S3uploadsBase = 'https://s3-us-west-2.amazonaws.com/site.advisorhunter/';

var serviceBase = 'http://localhost/Advisorhunter/adhunter/adhunter/api/web/v1/';

// Declare app level module which depends on views, and components
var adhunterApp = angular.module('adhunterApp', [
  'ui.router',
  'ui.bootstrap',
  'ui.bootstrap.tpls',
  'ngCookies' ,
  'countTo',
  'angularUtils.directives.dirPagination',
  'ngValidate'
])

.config(function ($validatorProvider) {
    $validatorProvider.setDefaultMessages({
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: $validatorProvider.format("Please enter no more than {0} characters."),
        minlength: $validatorProvider.format("Please enter at least {0} characters."),
        rangelength: $validatorProvider.format("Please enter a value between {0} and {1} characters long."),
        range: $validatorProvider.format("Please enter a value between {0} and {1}."),
        max: $validatorProvider.format("Please enter a value less than or equal to {0}."),
        min: $validatorProvider.format("Please enter a value greater than or equal to {0}.")
    });
});


adhunterApp.config(function($stateProvider, $httpProvider, $urlRouterProvider) {
  	$stateProvider

  	.state('home', {
		url:'/',
		views: {
	        'home': {
		        templateUrl: 'app/views/home.html',
				controller: 'home',
				controllerAs: 'homeCtrl'
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
      	}		
	})

	.state('search', {
		url:'/search',
		views: {
			'header': {
		        templateUrl: 'app/views/nav-header.html',
	        },
	        'search-pro': {
		        templateUrl: 'app/views/search-pro.html',
        		controller: 'searchpro',
				controllerAs: 'searchproCtrl'
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    } 
        
    })

    .state('pro', {
		url:'/pro/:proid',
		views: {
			'header':{
				templateUrl: 'app/views/nav-header.html'
			},
			
	        'pro': {
		        templateUrl: 'app/views/pro.html',
        		controller: 'showpro',
				controllerAs: 'showproCtrl'
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }

    })

 	.state('proaccount', {
		url:'/proaccount',
		views: {
			'header':{
				templateUrl: 'app/views/nav-header.html'
			},
			
	        'pro-account': {
		        templateUrl: 'app/views/pro_signup/pro-account.html',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
    })

	.state('proaccount.pro-signup', {
		url:'/pro-signup',
		views:{
			'pro-signup':{
		 		templateUrl: 'app/views/pro_signup/proaccount-signup.html',
		 		controller: 'proaccount',
				controllerAs: 'proaccountCtrl'
		 	}
	 	}
    })

	.state('proaccount.add-company', {
		url:'/add-company',
		cache:false,
		views:{
			'pro-add-company':{
				templateUrl: 'app/views/pro_signup/proaccount-businessprofile.html',
				controller: 'pro-add-company',
				controllerAs: 'proaccountaddCtrl'
		
			}
		}
    })

 	.state('myprofile', {
		url:'/profile',
		cache:false,
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
			
	        'pro-account': {
		        templateUrl: 'app/views/pro_myprofile/myprofile.html',
		        controller: 'myprofile',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
    })


	.state('dashboard', {
		url:'/dashboard',
        templateUrl: 'app/views/dashboard.html',
        controller: 'dashboard',
    })

	.state('dashboard.provider', {
		url:'',
		views: {
			'header':{
					templateUrl: 'app/views/pro-header.html'
			},
	        'provider': {
		        templateUrl: 'app/views/dashboard/provider-dashboard.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
	})

	.state('dashboard.customer', {

		url:'',
		parent : 'dashboard',
		views: {
	        'customer': {
		        templateUrl: 'app/views/customer.html',
				controller: 'customer',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }  
	})

	.state('dashboard.projects', {
		url:'/projects',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-projects': {
		        templateUrl: 'app/views/dashboard/prouser-project.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
	        	templateUrl: 'app/views/footer.html',
        	}
	    }   
	})

	.state('dashboard.contacts', {			
		url:'/contacts',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-contacts': {
		        templateUrl: 'app/views/dashboard/prouser-contacts.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
	        	templateUrl: 'app/views/footer.html',
        	}
	    }   
	})

	.state('dashboard.mailbox', {
		url:'/mailbox',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-mailbox': {
		        templateUrl: 'app/views/dashboard/prouser-mailbox.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
	        	templateUrl: 'app/views/footer.html',
        	}
	    }   
	})

	.state('dashboard.eventcalender', {
		url:'/eventcalender',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-calender': {
		        templateUrl: 'app/views/dashboard/prouser-eventcalender.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
	})

	.state('dashboard.invoice', {
		url:'/invoice',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-calender': {
		        templateUrl: 'app/views/dashboard/prouser-invoice.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
	})

	.state('dashboard.token', {
		url:'/token',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-calender': {
		        templateUrl: 'app/views/dashboard/prouser-token.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
	})

	.state('dashboard.referral', {
		url:'/referral',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-referral': {
		        templateUrl: 'app/views/dashboard/prouser-referral.html',
		        controller: 'app/prodashboard',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
	        }
	    }   
	})

	.state('dashboard.settings', {
		url:'/settings',
		views: {
			'header':{
				templateUrl: 'app/views/pro-header.html'
			},
	        'prouser-setting': {
		        templateUrl: 'app/views/dashboard/prouser-setting.html',
		        controller: 'prodashboard',
	        },
	        'footer': {
		        templateUrl: 'app/views/footer.html',
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
				templateUrl: 'app/views/404.html',
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
				templateUrl: 'app/views/401.html',
			},
		}
	})

    $httpProvider.interceptors.push('authInterceptor');

    $urlRouterProvider.otherwise('/');

    $httpProvider.defaults.useXDomain = true;
    // delete $httpProvider.defaults.headers.common['X-Requested-With'];
    // $httpProvider.defaults.withCredentials = true;

	$httpProvider.defaults.headers.options = {};
	// $httpProvider.defaults.headers.common = {};
	// $httpProvider.defaults.headers.post = {};
	// $httpProvider.defaults.headers.put = {};
	// $httpProvider.defaults.headers.patch = {};

});
