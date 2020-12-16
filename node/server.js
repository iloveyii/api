// Import required packages
const express = require('express');
const mysql = require('mysql');
const app = express();

// Set the view engine to EJS
app.set('view engine', 'ejs');
app.set('views', './views');
app.use(express.static('public'));

// Database credentials
const dbHost = 'localhost';
const dbName = 'api_data';
const dbUser = 'root';
const dbPass = 'root';

// Connect to MySQL
const con = mysql.createConnection({
    host: dbHost,
    user: dbUser,
    password: dbPass
});

// SQL query to select all links JOINED with locations
const sql = `
SELECT
    links.id,
    links.name,
    links.url,
    locations.name AS loc_name,
    locations.id AS loc_id
FROM
    locations
INNER JOIN
    links ON locations.id = links.location_id
ORDER BY locations.id
`;


con.connect( err => {
    if(err) throw err;
    console.log('MySQL connected !');

    // Select Database
    con.changeUser({database : dbName}, function(err) {
        if (err) throw err;
        console.log('Database changed to ' + dbName);

        // Run the query to get links
        con.query(sql, (err, links) => {
            if(err) throw err;

            // Arrange the links location wise
            const linksByLocation = {};

            links.forEach( link => {
                if(linksByLocation[link.loc_id]) {
                    linksByLocation[link.loc_id].push(link);
                } else {
                    linksByLocation[link.loc_id] = [];
                    linksByLocation[link.loc_id].push(link);
                }
            });

            const keys = Object.keys(linksByLocation);

            app.get('/', (req, res) => res.render('links', { keys: keys, linksByLocation: linksByLocation}));
        })
    });

});



app.listen(3300, () => console.log('Server started on port 3300 !'));


