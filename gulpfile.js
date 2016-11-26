const elixir = require('laravel-elixir');

elixir(mix => { mix
	.copy('./node_modules/bootstrap-sass/assets/fonts/bootstrap', 'assets/fonts')
	.sass('./assets/style.scss', './assets/css')
	.scripts([
		'./node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
		'./node_modules/isotope-layout/dist/isotope.pkgd.min.js',
		'./assets/script.js'
	], './assets/js/script.js');
});