// app/models/projects.js
// load the things we need
var mongoose = require('mongoose');

// define the schema for our projects model
var projects = mongoose.Schema({

    name   : String,
    tasks   : String,
    status   : String,
    progress  : String,
    resources  : String,
    ending_date : Date,
    scrum_master : String,
    starting_date : Date

});


// create the model for users and expose it to our app
module.exports = mongoose.model('projects', projects);
