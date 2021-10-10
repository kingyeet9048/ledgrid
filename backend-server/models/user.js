'user strict';

const { db_read } = require('../config/db');

// User object constructor
const User = data => {
    this.id = data.starID;
    this.username = data.username;
    this.email = data.email;
    this.password = data.password;
    this.lastName = data.lastName;
    this.firstName = data.firstName;
    this.role = data.role;
}

User.findById = function createUser(starID, result) {
    db_read.query("Select * from billboard.all_users join billboard.login ON billboard.all_users.starID = billboard.login.starID where billboard.all_users.starID = ?", starID, function (err, res) {             
        if(err) {
            console.log("error: ", err);
            result(err, null);
        } else{
            result(null, res[0]);
        }
    });   
};

module.exports = User;
