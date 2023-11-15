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

-- Table user

/* 

Student Test User: studentTest@test.com / student123

Teacher Test User: teacherTest@test.com / teacher123

*/

INSERT INTO user (`name`, `lastName`, `email`, `nickname`, `password`, `phone`, `birthDate`, `profilePicture`,`street`, `streetNumber`, `district`, `postalCode`, `idCity`, `idUserType`)
    VALUES ('Estudante', 'Teste', 'studentTest@test.com', 'sdtTest', '$2y$10$SAyLpRcaRefh2/zHGLxLquZTDOrsBf76KDDVp1aFejV/WKAfPDtVy', '11111111111', '1995-10-11', '../lemonade/images/userDefaultProfilePicture.jpeg', 'street test', 404, 'test district', '11111111', 951, 1),
        ('Professor', 'Teste', 'teacherTest@test.com', 'tcrTest', '$2y$10$Vlwatf3ISmtIiCoKf4oDa.q1Lo9goVaPp0G3j/k/SAKm5B6Srl2.K', '11111111111', '1985-05-12', '../lemonade/images/adminDefaultProfilePicture.jpeg', 'street test', 404, 'test district', '11111111', 2067, 2);
