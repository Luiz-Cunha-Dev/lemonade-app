USE lemonade_db;

-- Table: state

/* Add file path and name here */ 
LOAD DATA INFILE 'file_path/file_name.csv' INTO TABLE state
    FIELDS TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: city

/* Add file path and name here */ 
LOAD DATA INFILE 'file_path/file_name.csv' INTO TABLE city
    FIELDS TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table userType

INSERT INTO userType (`name`) VALUES ('Estudante'), ('Professor');