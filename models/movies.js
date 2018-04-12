'use strict'

const mysql = require('mysql'),
	  myConnection = require('express-myconnection'),
	  dbOptions ={
	  	host : 'localhost',
	  	port : 3306,
	  	password : '',
	  	user : 'root',
	  	database : 'movies'

	  },
	  Movies = myConnection(mysql, dbOptions, 'request')

module.exports = Movies




