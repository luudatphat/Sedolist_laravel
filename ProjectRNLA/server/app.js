var express = require("express");
var app = express();
var server = require("http").Server(app);
const mysql  = require('mysql')
//socket
var io = require("socket.io")(server);

const db = mysql.createConnection({
  host: "localhost",
  user:  "root",
  password: "",
  database: "test"
});

db.connect(function(err) {
    if (err) {
      console.error('error connecting: ' + err.stack);
      return;
    }
    console.log('Mysql ' + db.threadId); 
});


io.on("connection", function(socket){
    console.log('co nguoi dang ket noi' + socket.id);

    socket.on("send-data", function(data){
        console.log(data);
        console.log(socket.id + "vừa mới gửi thông báo");

        var records = [data];

        let sql = "INSERT INTO user (name,title) VALUES ?"
        db.query(sql,[records] , (err, response) => {
            if (err) throw err
            else {
                console.log(response);
            }
        })
    });

    socket.on("client-send-android", function(data){
        var records1 = [data];

        let sql1 = "INSERT INTO user (name,title,device,status) VALUES ?"
        db.query(sql1,[records1] , (err, response) => {
            if (err) throw err
            else {
                console.log(response);
            }
        })
    })
});


server.listen(3000);
console.log('server 3000');
