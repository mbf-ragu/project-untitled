// load the things we need
var express = require('express');
var app = express();

// set the view engine to ejs
app.set('view engine', 'ejs');

// use res.render to load up an ejs view file
app.use(express.static(__dirname + '/pub'));
// index page 
app.get('/sspnode', function(req, res) {
	res.render('pages/index');
});

// about page 
app.get('/sspnode/about', function(req, res) {
	res.render('pages/about');
});

// contact page 
app.get('/sspnode/contact', function(req, res) {
	res.render('pages/contact');
});

var optionsget = {
    host : '192.168.0.38',
    port : 3010,
    path : '/sspnode', // the rest of the url with parameters if needed
    method : 'GET' // do GET
};
var server = app.listen(optionsget, function () {
   var host = server.address().address
   var port = server.address().port
});
