const movies = require('../models/movies'), 
	 express = require('express'),
	 router = express.Router()


router
	.use( movies )
	.get('/', (req, res, next) => {
		new Promise((resolve, reject) =>{
			req.getConnection( (err, movies) =>{
				return (err) ? reject(new Error('No se logro la coneccion')) : resolve(movies)
			})
		})		
			.then(movies => {
				return new Promise((resolve, reject) => {
					movies.query('SELECT * FROM MOVIE', (err, rows) => {
						let locals ={
							title : "Lista de peliculas",
							data : rows
						}
						return (err) ? reject(new Error('Error en la consulta')) : resolve(locals)
					})
				})
				
			})
			.then( locals => {
				res.render('index', locals)
			})
			.catch( err => {
				console.log(err.message)
			})


		/*
		req.getConnection( (err, movies) => {
			movies.query('SELECT * FROM MOVIE', (err, rows) => {
				let locals ={
					title : "Lista peliculas",
					data : rows
				}
				res.render('index', locals)
			})
		})
		*/		

	})




module.exports = router