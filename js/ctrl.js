<!-- Elokuvien tiedot taulukossa -->
app.controller("Prosessi", ['$scope', function($scope) {
	$scope.movies = [
	{
		id: 1,
		cover: 'img/deadpool.jpg',
		title: 'Deadpool',
		pubdate: new Date('2016'),
		developer: 'Tim Miller',
		info: "Marvel-universumiin sijoittuva Deadpool kertoo Wade Wilsonin tarinan. Entinen erikoisjoukkojen jäsen ja nykyinen palkkasoturi osallistuu laittomaan kokeeseen, jonka seurauksena hän saa erityiset parantumisvoimat - Deadpool on syntynyt."
	},
	 {
		id: 2,
		cover: 'img/forrest_gump.jpg',
		title: 'Forrest Gump',
		pubdate: new Date('2014'),
		developer: 'Robert Zemeckis',
		info: "Forrest Gump on menestyselokuva, josta tuli ilmiö. Tom Hanks teki mahtavan roolisuorituksen Forrestina, miehenä, jonka yksinkertainen syyttömyys kuvasi koko sukupolvea."
	},
	 {
		id: 3,
		cover: 'img/mr_nobody.jpg',
		title: 'Mr. Nobody',
		pubdate: new Date('2009'),
		developer: 'Jaco Van Dormael',
		info: "Mikään ei ole todellista. Kaikki on mahdollista. Nuori poika seisoo asemalla, juna on lähdössä. Lähteäkö äidin matkaan vai jäädä isän luo? Rajaton määrä mahdollisia elinkaaria riippuu hänen päätöksestään. Jos ei päätä lainkaan, kaikki on mahdollista."
	}];
	}
]);
