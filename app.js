'use strict'
const express = require('express'),
	app = express(),
	favicon = require('serve-favicon'),
	morgan = require('morgan'),
	boddyParser = require('body-parser'),
	routes = require('./routes/index'),
	//movies = require('models/movies'),
	faviconURL = `${__dirname}/public/img/favicon-node.png`,
	publicDir = express.static(`${__dirname}/public`),
	viewDir = `${__dirname}/views`,
	port = (process.env.PORT || 3000)



app
	//configurando app
	.set('views', viewDir)
	.set('view engine', 'pug')
	.set('port', port)
	//ejecutando middlewares
	.use(favicon(faviconURL))
	// parsea el formulario a json
	.use(boddyParser.json())
	//parsea el fomulario  x-www-form-urlencoded
	.use(boddyParser.urlencoded({
		extended: false
	}))
	.use(morgan('dev'))
	.use(publicDir)
	//ejecutando el enrutador
	.use(routes)
	.use(error404)



function error404(req, res, next) {
	let error = new Error(),
		locals = {
			title: 'error 404',
			description: 'Recurso no encontrado',
			error: error
		}
	error.status = 404
	res.render('error', locals)

	next()
}


module.exports = app