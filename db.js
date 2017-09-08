var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/nodetest";

MongoClient.connect(url, function(err, db) {
	db.collection("customers").find({}).toArray(function(err, res) {
    if (err) throw err;
    console.log(res[0].name);
    db.close();
  });
});