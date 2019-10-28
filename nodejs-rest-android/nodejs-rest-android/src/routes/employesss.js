const express = require('express');
const router = express.Router();

const mysqlConnection  = require('../database.js');

module.exports = router
// GET all Employees
router.get('/', (req, res) => {
    mysqlConnection.query('SELECT * FROM usuario', (err, rows, fields) => {
      if(!err) {
        res.json(rows);
      } else {
        console.log(err);
      }
    });  
  });
//guardar
  router.post('/', (req, res) => {
    const { nombres,apellidos, dni} = req.body;
    console.log(nombres,apellidos, dni);
    const query = `CALL addUser(?,?,?);
    `;
    mysqlConnection.query(query, [nombres, apellidos, dni], (err, rows, fields) => {
      if(!err) {
        res.json({status: 'Employeed Saved'});
      } else {
        console.log(err);
      }
    });
  
  });

  //update
  router.put('/:id', (req, res) => {
    const { nombres,apellidos, dni} = req.body;
    const { id } = req.params;
    console.log(id, nombres,apellidos, dni);
    const query = ` CALL updateUser(?,?,?,?);
    `;
    mysqlConnection.query(query, [id,nombres, apellidos, dni], (err, rows, fields) => {
      if(!err) {
        res.json({status: 'Employee Updated'});
      } else {
        console.log(err);
      }
    });
  });
  

  //delete
router.delete('/:id', (req, res) => {
    const { id } = req.params;
    
    mysqlConnection.query('DELETE FROM usuario WHERE id_usuario = ?', [id], (err, rows, fields) => {
      if(!err) {
        console.log(id);
        res.json({status: 'Employee Deleted'});
      } else {
        console.log(err);
      }
    });
  });