// load the things we need
var express = require('express');
var app = express();
var mongoose = require('mongoose');
var passport = require('passport');
var flash    = require('connect-flash');
var cookieParser = require('cookie-parser');
var configDB = require('./config/database.js');
var bodyParser = require('body-parser')
var session = require('express-session');
var logger = require('morgan');

require('./config/passport')(passport); // pass passport for configuration

app.use(logger('dev'));
app.use(cookieParser()); // read cookies (needed for auth)
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json()); // get information from html forms
app.use(passport.initialize());
app.use(flash()); // use connect-flash for flash messages stored in session

db = mongoose.createConnection(configDB.url);// connect to our database
app.use(session({
    secret: 'mysecretsessionkeytokeepsessionsecret',
    cookie: { maxAge: 2628000000 },
    resave: false,
    saveUninitialized: false
/*    store: new(require('express-sessions'))({
        storage: 'mongodb',
        instance: mongoose, // optional 
        collection: 'sessions', // optional 
        expire: 86400 // optional 
    })*/
}));

app.use(passport.session());
// route middleware to make sure
function isLoggedIn(req, res, next) {
	if (req.isAuthenticated())
		return next();
	res.redirect('/');
}



// routes ======================================================================
// require('./app/routes.js')(app, passport); // load our routes and pass in our app and fully configured passport

// set the view engine to ejs
app.set('view engine', 'ejs');

// use res.render to load up an ejs view file
app.use(express.static(__dirname + '/pub'));

// index page 
/*app.get('/', function(req, res) {
	res.render('pages/index');
});
*/
// about page 
app.get('/about', function(req, res) {
	res.render('pages/about');
});

// contact page 
app.get('/contact', function(req, res) {
	res.render('pages/contact');
});

// dashboard page 
app.get('/dashboard', function(req, res) {
	console.log('dashboard');
	res.render('pages/dashboard');
});


// Home page
app.get('/', function(req, res) {
	res.render('index.ejs'); // load the index.ejs file
});
// Login
app.get('/login', function(req, res) {

	// render the page and pass in any flash data if it exists
	res.render('login.ejs', { message: req.flash('loginMessage') });
	// res.render('login.ejs');
});
// process the login form
app.post('/login',function(req,res){ 
	console.log('test');
	passport.authenticate('local-login', {
		successRedirect : '/profile', // redirect to the secure profile section
		failureRedirect : '/login', // redirect back to the signup page if there is an error
		failureFlash : true // allow flash messages
	});
	console.log('test');
});
// Signup
app.get('/signup', function(req, res) {
	res.render('signup.ejs', { message: req.flash('signupMessage') });
});
// process the signup form
app.post('/signup', passport.authenticate('local-signup', {
	successRedirect : '/profile', // redirect to the secure profile section
	failureRedirect : '/signup', // redirect back to the signup page if there is an error
	failureFlash : true // allow flash messages
}));
// Profile section
app.get('/profile', isLoggedIn, function(req, res) {
	res.render('profile.ejs', {
		user : req.user // get the user out of session and pass to template
	});
});
// Logout
app.get('/logout', function(req, res) {
	req.logout();
	res.redirect('/');
});

var optionsget = {
    host : '192.168.0.38',
    port : 8080,
    path : '/', // the rest of the url with parameters if needed
    method : 'GET' // do GET
};
var server = app.listen(optionsget, function () {
   var host = server.address().address
   var port = server.address().port
   console.log("server in ",host,port);
});
