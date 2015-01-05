<!DOCTYPE html>
<html lang="fr">
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	{{ HTML::style('css/bootstrap.min.css'); }}
	{{ HTML::style('css/bootstrap-responsive.min.css'); }}
	{{ HTML::style('css/style.css'); }}
	{{ HTML::style('css/style-responsive.css'); }}

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->


	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
        {{ HTML::script('http://html5shim.googlecode.com/svn/trunk/html5.js'); }}
	  	{{ HTML::style('css/ie.css'); }}
	<![endif]-->

	<!--[if IE 9]>
        {{ HTML::style('css/ie9.css'); }}
	<![endif]-->

	@yield('styles')

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->

	<!-- start: jQuery -->
		<script src="/travis/public/js/jquery-1.9.1.min.js"></script>
	<!-- end: jQuery -->

</head>

<body>
	@yield('hightcharts_scripts')
    <!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span>TRAVIS</span></a>

				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-bell"></i>
								<span class="badge red">
								7 </span>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
 									<span>Aucune notification</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>

							</ul>
						</li>
						<!-- start: Notifications Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-calendar"></i>
								<span class="badge red">
								5 </span>
							</a>
							<ul class="dropdown-menu tasks">
								<li class="dropdown-menu-title">
 									<span>Aucune tâche</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>

								<li>
                            		<a class="dropdown-menu-sub-footer">View all tasks</a>
								</li>
							</ul>
						</li>
						<!-- end: Notifications Dropdown -->
						<!-- start: Message Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-envelope"></i>
								<span class="badge red">
								4 </span>
							</a>
							<ul class="dropdown-menu messages">
								<li class="dropdown-menu-title">
 									<span>You have 9 messages</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>
                            	<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	6 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	56 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	3 hours
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	yesterday
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	Jul 25, 2012
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                    </a>
                                </li>
								<li>
                            		<a class="dropdown-menu-sub-footer">View all messages</a>
								</li>
							</ul>
						</li>

						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> Dennis Ji
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="login.html"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->

			</div>
		</div>
	</div>
	<!-- start: Header -->
	<div class="container-fluid-full">
        <div class="row-fluid">

            <!-- start: Main Menu -->
            <div id="sidebar-left" class="span2">
                <div class="nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">

                        <li><a href="{{URL::to('/')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <li><a href="{{URL::to('forums')}}"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Forums</span></a></li>
                        <li><a href="{{URL::to('users')}}"><i class="icon-user"></i><span class="hidden-tablet"> Utilisateurs</span></a> </li>
                    </ul>
                </div>
            </div>
            <!-- end: Main Menu -->

            <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
            </noscript>

            <!-- start: Content -->
            <div id="content" class="span10">
                @yield('content')
            </div> <!-- content -->
        </div><!--/.fluid-container-->
    </div><!--/#content.span10-->


    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here settings can be configured...</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>

    <div class="clearfix"></div>

    <footer>
        <p>
            <span style="text-align:left;float:left">ENSIM 2014 - Travis</span>
        </p>
    </footer>

    <!-- start: JavaScript-->
    <script src="/travis/public/js/jquery-migrate-1.0.0.min.js"></script>
    <script src="/travis/public/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="/travis/public/js/jquery.ui.touch-punch.js"></script>
    <script src="/travis/public/js/modernizr.js"></script>
    <script src="/travis/public/js/bootstrap.min.js"></script>
    <script src="/travis/public/js/jquery.cookie.js"></script>
    <script src='/travis/public/js/fullcalendar.min.js'></script>
    <script src='/travis/public/js/jquery.dataTables.min.js'></script>
    <script src="/travis/public/js/excanvas.js"></script>
    <script src="/travis/public/js/jquery.flot.js"></script>
    <script src="/travis/public/js/jquery.flot.pie.js"></script>
    <script src="/travis/public/js/jquery.flot.stack.js"></script>
    <script src="/travis/public/js/jquery.flot.resize.min.js"></script>
    <script src="/travis/public/js/jquery.chosen.min.js"></script>
    <script src="/travis/public/js/jquery.uniform.min.js"></script>
    <script src="/travis/public/js/jquery.cleditor.min.js"></script>
    <script src="/travis/public/js/jquery.noty.js"></script>
    <script src="/travis/public/js/jquery.elfinder.min.js"></script>
    <script src="/travis/public/js/jquery.raty.min.js"></script>
    <script src="/travis/public/js/jquery.iphone.toggle.js"></script>
    <script src="/travis/public/js/jquery.uploadify-3.1.min.js"></script>
    <script src="/travis/public/js/jquery.gritter.min.js"></script>
    <script src="/travis/public/js/jquery.imagesloaded.js"></script>
    <script src="/travis/public/js/jquery.masonry.min.js"></script>
    <script src="/travis/public/js/jquery.knob.modified.js"></script>
    <script src="/travis/public/js/jquery.sparkline.min.js"></script>
    <script src="/travis/public/js/counter.js"></script>
    <script src="/travis/public/js/retina.js"></script>
    <script src="/travis/public/js/custom.js"></script>
    <!-- end: JavaScript-->

	<script src="/travis/public/js/highcharts/highcharts.js"></script>
	<script src="/travis/public/js/highcharts/modules/exporting.js"></script>

@yield('scripts')

<script>
	Highcharts.setOptions({
		lang: {
			months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
			weekdays: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
			shortMonths: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
			decimalPoint: ',',
			printChart: 'Imprimer',
			downloadPNG: 'Télécharger en image PNG',
			downloadJPEG: 'Télécharger en image JPEG',
			downloadPDF: 'Télécharger en document PDF',
			downloadSVG: 'Télécharger en document Vectoriel',
			loading: 'Chargement en cours...',
			contextButtonTitle: 'Exporter le graphique',
			resetZoom: 'Réinitialiser le zoom',
			resetZoomTitle: 'Réinitialiser le zoom au niveau 1:1',
			thousandsSep: ' ',
			decimalPoint: ',',
			noData: 'Pas d\'information à afficher'
		}
	});
</script>
</body>
</html>