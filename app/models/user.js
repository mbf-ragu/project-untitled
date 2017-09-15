// app/models/user.js
// load the things we need
var mongoose = require('mongoose');
var bcrypt   = require('bcrypt-nodejs');

// define the schema for our user model
var userSchema = mongoose.Schema({

    local            : {
        email        : String,
        password     : String,
        name         : String,
        first_name   : String,
        last_name    : String,
        projects     : String,
        designation  : String,
        joining_date : Date,
        current_task : String,
        current_project : String,
        reporting_person: String,
        reported_persons: String,
        description  : String,
        birthday     : String,
        is_free      : String,
        team         : String,
        salary       : String,
        permanent_address  : String,
        residential_address: String,
        blood_group        : String,
        phone_number       : String,
        marital_status     : String,
        spouse_dob         : String,
        children_dob       : String,
        skillset           : String,
        availability       : String
    },
    facebook         : {
        id           : String,
        token        : String,
        email        : String,
        name         : String
    },
    twitter          : {
        id           : String,
        token        : String,
        displayName  : String,
        username     : String
    },
    google           : {
        id           : String,
        token        : String,
        email        : String,
        name         : String
    }

});

// methods ======================
// generating a hash
userSchema.methods.generateHash = function(password) {
    return bcrypt.hashSync(password, bcrypt.genSaltSync(8), null);
};

// checking if password is valid
userSchema.methods.validPassword = function(password) {
    return bcrypt.compareSync(password, this.local.password);
};

// create the model for users and expose it to our app
module.exports = mongoose.model('User', userSchema);
