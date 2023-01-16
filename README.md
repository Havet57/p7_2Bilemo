# P7_2Bilemo

This project is an API REST made with Api Platform. Its goals were to learn basics of API REST.


## Installation


Install the project by cloning it onto your system using git

```
  git clone https://github.com/Havet57/P7_2Bilemo P7_2Bilemo
  cd P7_2Bilemo
  composer install
```

## Database

Please create a mysql database named `P7_2Bilemo` with utf8_general_ci. 
Then run this command line `mysql -uroot -p P7_2Bilemo < database.sql` to create all the tables.

## Environment Variables

Please copy the `.env` file and paste to the `.env.local` file.
To run this project, you must update the `DATABASE_URL` in the  `.env.local` file with your database values (host, user, password, dbname).
 
