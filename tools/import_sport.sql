LOAD DATA LOCAL INFILE  'sport.csv'
INTO TABLE sport
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;