// app/routes.js
module.exports = function(app, passport,mongoose) {

	// =====================================
	// HOME PAGE (with login links) ========
	// =====================================
	app.get('/',isLoggedIn, function(req, res) {
		if (req.isAuthenticated())
			res.redirect('/dashboard');
		res.render('index.ejs'); // load the index.ejs file
	});

	// =====================================
	// LOGIN ===============================
	// =====================================
	// show the login form
	app.get('/login', function(req, res) {
		if (req.isAuthenticated())
			res.redirect('/dashboard');
		// render the page and pass in any flash data if it exists
		res.render('pages/login', { message: req.flash('loginMessage') });
	});

	// process the login form
	app.post('/login', passport.authenticate('local-login', {
		successRedirect : '/dashboard', // redirect to the secure profile section
		failureRedirect : '/login', // redirect back to the signup page if there is an error
		failureFlash : true // allow flash messages
	}));

	// =====================================
	// SIGNUP ==============================
	// =====================================
	// show the signup form
	app.get('/signup', function(req, res) {

		// render the page and pass in any flash data if it exists
		res.render('signup.ejs', { message: req.flash('signupMessage') });
	});

	// process the signup form
	app.post('/signup', passport.authenticate('local-signup', {
		successRedirect : '/profile', // redirect to the secure profile section
		failureRedirect : '/signup', // redirect back to the signup page if there is an error
		failureFlash : true // allow flash messages
	}));

	// =====================================
	// PROFILE SECTION =========================
	// =====================================
	// we will want this protected so you have to be logged in to visit
	// we will use route middleware to verify this (the isLoggedIn function)
	app.get('/profile', isLoggedIn, function(req, res) {
		res.render('pages/profile.ejs', {
			user : req.user, // get the user out of session and pass to template
			req : req // get the user out of session and pass to template
		});
	});

	// =====================================
	// LOGOUT ==============================
	// =====================================
	app.get('/logout', function(req, res) {
		req.logout();
		res.redirect('/');
	});

	// index page 
	app.get('/index', function(req, res) {
		res.render('pages/index');
	});
	
	// about page 
	app.get('/about', function(req, res) {
		res.render('pages/about');
	});

	// contact page 
	app.get('/contact', function(req, res) {
		res.render('pages/contact');
	});
	// project_detailhtml page 
	app.get('/project_detail',isLoggedIn, function(req, res) {
		res.render('pages/project_detail', { message: req.flash('loginMessage'),req: req });
	});
	// project_detailhtml page 
	app.get('/projects',isLoggedIn, function(req, res) {
		projects = require('../app/models/projects.js'); // load our routes and pass in our app and fully configured passport
		var projects = mongoose.model('projects', projects);
		projects.find({},function(err, objs){
			res.render('pages/projects', {
				projects: objs,
				req: req
			});
			for (var i = 0; i < objs.length; i++) {
				console.log(objs[i]);
			}
	    });
	});


	// dashboard page 
	app.get('/dashboard', isLoggedIn, function(req, res) {
		user = require('../app/models/user.js'); // load our routes and pass in our app and fully configured passport
		var User = mongoose.model('User', user);
		User.findOne({_id:'59b910ee0c85e1e0484f99aa'},'firstname',function(err, objs){
			obj = objs.toJSON().firstname;
			res.render('pages/dashboard', {
				req: req
			});
	    });
	});

};



// route middleware to make sure
function isLoggedIn(req, res, next) {

	// if user is authenticated in the session, carry on
	if (req.isAuthenticated())
		return next();

	// if they aren't redirect them to the home page
	res.redirect('/login');
}
