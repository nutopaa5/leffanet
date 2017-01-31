<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>LeffaNet.fi - suosittele ja arvostele elokuvia helposti</title>
		<!-- AngularJS -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/ctrl.js"></script>
		<!-- Divien ja sisällön animointi -->
		<script>
		$(document).ready(function(){
			$(".linkitys").hide(0).delay(300).fadeIn(1000)
			$(".otsikko").hide(0).delay(0).fadeIn(1000)
		});
		</script>
		<!-- Kursorin vaihtaminen elokuvia osoittaessa linkkeinä -->
		<script>
		jQuery(document).ready(function($) {
			$(".linkitys").click(function(){
				window.location=$(this).find("a").attr("href");
				linkitys.style.cursor = 'pointer';
				return false;
			});
		});
		</script>
		<!-- CSS -->
		<link href="css/main.css" rel="stylesheet"/>
	</head>

	<body ng-app="LeffaNet">

		<div class="header">
			<!-- Logo ja store-linkit -->
			<div class="container">
				<a href="index.php"><h1>LeffaNet</h1></a></br>
				suosittele ja arvostele elokuvia helposti
				<p class="store"><a href="https://itunes.apple.com/fi/genre/ios/id36?mt=8"><img src="https://s3.amazonaws.com/codecademy-content/projects/shutterbugg/app-store.png" width="120px"></a>
				<a href="https://play.google.com/store?hl=fi"><img src="https://s3.amazonaws.com/codecademy-content/projects/shutterbugg/google-play.png" width="110px"></a></p>
			</div>
		</div>
		<!-- Elokuvien tulostus Angularista 'linkitys' kohdalta -->
		<div class="main" ng-controller="Prosessi">
			<div class="container2">
				<div class="bar">
					<h1><span class="otsikko">Elokuvat</span></h1>
				</div>
				<div class="linkitys" ng-repeat="movie in movies" id="linkitys" style ="cursor: pointer;">
					<!-- id :n ottaminen Angular itemeistä ja tulostus urlin joukkoon
				 		Myöskin blockaus jos urli on muuta kuin index.php, ohjaus takaisin -->
					<?php
					$movieid = '{{movie.id}}';
					$url = 'leffa.php?id='.$movieid.'';
					$currentpage = $_SERVER['REQUEST_URI'];
					if($currentpage != '/leffanet/index.php') {
						header("location:index.php");
					}
					?>
						<a href="<?php echo $url; ?>"></a>
					<div class="leffa">
							<p class="date"><b>{{movie.title}}</b></p>
							<img src="{{movie.cover}}"></br>
              <p class="date">{{movie.pubdate | date : 'yyyy'}}</p></br>
							<p class="developer"><b>Ohjannut:</b></br>{{movie.developer}}</p>
							<p class="kuvaus">{{movie.info}}</p>
					</div>

				</div>
			</div>
    </div>
	</body>
</html>
