const express = require('express');
const app= express();

//configiguraciones del puerto
app.set('port', process.env.PORT || 3000);
//middlewares
//mediadores
app.use(express.json());

//routes
app.use(require('./routes/employesss'));

app.listen(app.get('port'), () =>{

    console.log('Server en puerto 3000');
});