<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>LeffaNet.fi - Forrest Gump</title>
		<!-- AngularJS -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="js/app.js"></script>
    <script src="js/ctrl.js"></script>
		<!-- Divien ja sisällön animointi -->
		<script>
		$(document).ready(function(){
			$(".leffassa").hide(0).delay(50).fadeIn(800)
			$(".otsikko").hide(0).delay(0).fadeIn(500)
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
		<!-- Elokuvan jossa sama id kuin url, tulostus tietoineen -->
		<div class="main" ng-controller="Prosessi">
			<div class="container2">
				<div class="bar">
					<h1><a href="index.php"><span class="otsikko"><img src="img/arrow_back.png">&nbsp;Takaisin etusivulle</span></a></h1>
				</div>
				<div>
					<?php $linkid = $_GET['id'];
					echo '<div class="leffassa" ng-repeat="movie in movies | filter:{id:'.$linkid.'}">';?>
							<p class="date"><b>{{movie.title}}</b> ({{movie.pubdate | date : 'yyyy'}})</p></br>
							<p class="developer"><b>Ohjannut:</b></br>{{movie.developer}}</p>
							<img src="{{movie.cover}}">
							<p class="kuvaus">{{movie.info}}</p>

						<div class="rating">
							<!-- Arvosanojen hakeminen tiedostosta -->
							<?php
							include('rating.php');
							?>
						</div>
							<!-- Kommenttien tulostus tiedostosta -->
							<div id="kommenttitulostus" class="kommenttitulostus">
								<?php
								include('kommentit.php');
								$linkid = $_GET['id'];
								$currentpage = $_SERVER['REQUEST_URI'];
								if($linkid > 3 || $linkid == 0 || empty($linkid) || $linkid=='') {
									header("location:index.php");
								}
								?>
							</div>
							<!-- Formin tulostus missä elokuva id on sama -->
            <div name="formi" class="formi">
								<form name="kommenttiformi" method="post" id="kommenttiformi" class="kmnt" action="kommentit.php?id=<?php echo $linkid;?>">
								<input type="hidden" id="<?php echo $linkid; ?>" name="linkid" value="<?php echo $linkid; ?>">
									Arvio *</br>
									<select name="rating">
	  								<option value="0"></option>
	  								<option value="1">1</option>
	  								<option value="2">2</option>
	  								<option value="3">3</option>
										<option value="4">4</option>
	  								<option value="5">5</option>
	  								<option value="6">6</option>
	  								<option value="7">7</option>
										<option value="8">8</option>
	  								<option value="9">9</option>
	  								<option value="10">10</option>
									</select></br>
								Nimi *</br>
								<input name="name" id="name" type="text" maxlength="25"></br>
								Kommentti *</br>
								<textarea name="comment" id="comment" type="text" maxlength="300"></textarea></br>
								<input name="submit" type="submit" id="submit" value="Lähetä kommentti">
							</form></div>
				</div>
			</div>
    </div>
	</div>
	</body>
</html>
