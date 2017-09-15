// set up ======================================================================
	
	// get all the tools we need
	var express = require('express');
	var app     = express();
	var port    = process.env.PORT || 8080;
	var mongoose= require('mongoose');
	var passport= require('passport');
	var flash   = require('connect-flash');
	var logger 	= require('morgan');
	var cookieParser = require('cookie-parser');
	var bodyParser = require('body-parser');
	var session = require('express-session');
	var configDB = require('./config/database.js');

// configuration ===============================================================
	db = mongoose.connect(configDB.url); // connect to our database

	require('./config/passport')(passport); // pass passport for configuration
	
	// set up our express application
	// app.use(logger('dev'));
	app.use(cookieParser());
	app.use(bodyParser.urlencoded({ extended: true }));
	app.use(bodyParser.json()); // get information from html forms
	app.set('view engine', 'ejs'); // set up ejs for templating
	
	// use res.render to load up an ejs view file
	app.use(express.static(__dirname + '/pub'));

	// required for passport
	app.use(session({
	    secret: 'mysecretsessionkeytokeepsessionsecret',
	    cookie: { maxAge: 2628000000 },
	    resave: false,
	    saveUninitialized: false,
	    store: new(require('express-sessions'))({
	        storage: 'mongodb',
	        instance: mongoose, // optional 
	        collection: 'sessions', // optional 
	        expire: 86400 // optional 
	    })
	}));
	app.use(passport.initialize());
	app.use(passport.session()); // persistent login sessions
	app.use(flash()); // use connect-flash for flash messages stored in session

// routes ======================================================================
	require('./app/routes.js')(app, passport,mongoose); // load our routes and pass in our app and fully configured passport
	
// launch ======================================================================
	app.listen(port);