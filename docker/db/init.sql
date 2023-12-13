-- Database: lemonade_db

CREATE DATABASE IF NOT EXISTS lemonade_db;

USE lemonade_db;

-- Table: user

CREATE TABLE IF NOT EXISTS `user`(
	idUser INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
	lastName VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    nickname VARCHAR(45) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    birthDate DATE NOT NULL,
    profilePicture VARCHAR(255),
    street VARCHAR(150) NOT NULL,
    streetNumber INT NOT NULL,
    district VARCHAR(45) NOT NULL,
    complement VARCHAR(100),
    postalCode CHAR(8) NOT NULL,
    firstAccess BOOLEAN NOT NULL DEFAULT TRUE,
    idCity INT NOT NULL,
    idUserType INT NOT NULL,
	CONSTRAINT userPk PRIMARY KEY (idUser),
    CONSTRAINT emailUnique UNIQUE (email),
	CONSTRAINT nicknameUnique UNIQUE (nickname)
);

-- Table: userType

CREATE TABLE IF NOT EXISTS userType(
	idUserType INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL,
	CONSTRAINT userTypePk PRIMARY KEY (idUserType)
);

-- Table: city

CREATE TABLE IF NOT EXISTS city(
	idCity INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    uf CHAR(2) NOT NULL,
    idState INT NOT NULL,
	CONSTRAINT cityPk PRIMARY KEY (idCity)
);

-- Table: state

CREATE TABLE IF NOT EXISTS state(
	idState INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    acronym CHAR(2) NOT NULL,
	CONSTRAINT statePk PRIMARY KEY (idState)
);

-- Table: practiceExam

CREATE TABLE IF NOT EXISTS practiceExam(
	idPracticeExam INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(80) NOT NULL,
    `description` VARCHAR(255),
	CONSTRAINT practiceExamPk PRIMARY KEY (idPracticeExam)
);

-- Table: question

CREATE TABLE IF NOT EXISTS question(
	idQuestion INT NOT NULL AUTO_INCREMENT,
    statement TEXT(1000) NOT NULL,
    idQuestionType INT NOT NULL,
	CONSTRAINT questionPk PRIMARY KEY (idQuestion)
);

-- Table: questionType

CREATE TABLE IF NOT EXISTS questionType(
	idQuestionType INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
	CONSTRAINT questionTypePk PRIMARY KEY (idQuestionType)
);

-- Table: questionText

CREATE TABLE IF NOT EXISTS questionText(
	idQuestionText INT NOT NULL AUTO_INCREMENT,
    `text` TEXT(2000) NOT NULL,
    idQuestion INT NOT NULL,
	CONSTRAINT questionTextPk PRIMARY KEY (idQuestionText)
);

-- Table: questionAlternative

CREATE TABLE IF NOT EXISTS questionAlternative(
	idQuestionAlternative INT NOT NULL AUTO_INCREMENT,
    `text` TEXT(2000) NOT NULL,
    isCorrect BOOLEAN NOT NULL,
    idQuestion INT NOT NULL,
	CONSTRAINT questionAlternativePk PRIMARY KEY (idQuestionAlternative)
);

-- Table: questionDiscursive

CREATE TABLE IF NOT EXISTS questionDiscursive(
	idQuestionDiscursive INT NOT NULL AUTO_INCREMENT,
    baseResponse TEXT(2000) NOT NULL,
    idQuestion INT NOT NULL,
	CONSTRAINT questionDiscursivePk PRIMARY KEY (idQuestionDiscursive)
);

-- Constraints // Pattern: tableName_columnFK

ALTER TABLE `user` ADD CONSTRAINT user_cityFk FOREIGN KEY (idCity) REFERENCES city(idCity);

ALTER TABLE `user` ADD CONSTRAINT user_TypeFk FOREIGN KEY (idUserType) REFERENCES userType(idUserType);

ALTER TABLE city ADD CONSTRAINT city_StateFk FOREIGN KEY (idState) REFERENCES state(idState);

ALTER TABLE question ADD CONSTRAINT question_TypeFk FOREIGN KEY (idQuestionType) REFERENCES questionType(idQuestionType);

ALTER TABLE questionText ADD CONSTRAINT questionText_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion);

ALTER TABLE questionAlternative ADD CONSTRAINT questionAlternative_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion);

ALTER TABLE questionDiscursive ADD CONSTRAINT questionDiscursive_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion);

-- Table's with constraints

-- Table: practiceExamQuestion

CREATE TABLE IF NOT EXISTS practiceExamQuestion(
	idPracticeExam INT NOT NULL,
    idQuestion INT NOT NULL,
	CONSTRAINT practiceExamQuestionPk PRIMARY KEY (idPracticeExam, idQuestion),
    CONSTRAINT practiceExamQuestion_PracticeExamFk FOREIGN KEY (idPracticeExam) REFERENCES practiceExam(idPracticeExam),
    CONSTRAINT practiceExamQuestion_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion)
);

-- Table: userCreatedPracticeExam

CREATE TABLE IF NOT EXISTS userCreatedPracticeExam(
	idUser INT NOT NULL,
    idPracticeExam INT NOT NULL,
	CONSTRAINT userCreatedPracticeExamPk PRIMARY KEY (idUser, idPracticeExam),
    CONSTRAINT userCreatedPracticeExam_UserFk FOREIGN KEY (idUser) REFERENCES `user`(idUser),
    CONSTRAINT userCreatedPracticeExam_PracticeExamFk FOREIGN KEY (idPracticeExam) REFERENCES practiceExam(idPracticeExam)
);

-- Table: userCreatedQuestion

CREATE TABLE IF NOT EXISTS userCreatedQuestion(
	idUser INT NOT NULL,
    idQuestion INT NOT NULL,
	CONSTRAINT userCreatedQuestionPk PRIMARY KEY (idUser, idQuestion),
    CONSTRAINT userCreatedQuestion_UserFk FOREIGN KEY (idUser) REFERENCES `user`(idUser),
    CONSTRAINT userCreatedQuestion_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion)
);

-- Table: userPracticeExam

CREATE TABLE IF NOT EXISTS userPracticeExam(
	idUserPracticeExam INT NOT NULL AUTO_INCREMENT,
    startDate DATETIME NOT NULL,
    endDate DATE,
    grade INT,
	idUser INT NOT NULL,
    idPracticeExam INT NOT NULL,
	CONSTRAINT userPracticeExamPk PRIMARY KEY (idUserPracticeExam),
    CONSTRAINT userPracticeExam_UserFk FOREIGN KEY (idUser) REFERENCES `user`(idUser),
    CONSTRAINT userPracticeExam_PracticeExamFk FOREIGN KEY (idPracticeExam) REFERENCES practiceExam(idPracticeExam)
);

-- Table: userPracticeExamQuestionAlternative

CREATE TABLE IF NOT EXISTS userPracticeExamQuestionAlternative(
	idUserPracticeExam INT NOT NULL,
    idQuestionAlternative INT NOT NULL,
	CONSTRAINT userPracticeExamQuestionAlternativePk PRIMARY KEY (idUserPracticeExam, idQuestionAlternative),
    CONSTRAINT userPracticeExamQuestionAlternative_UserPracticeExamFk FOREIGN KEY (idUserPracticeExam) REFERENCES userPracticeExam(idUserPracticeExam),
    CONSTRAINT userPracticeExamQuestionAlternative_QuestionAlternativeFk FOREIGN KEY (idQuestionAlternative) REFERENCES questionAlternative(idQuestionAlternative)
);

-- Table: userPracticeExamQuestionDiscursive

CREATE TABLE IF NOT EXISTS userPracticeExamQuestionDiscursive(
	idUserPracticeExam INT NOT NULL,
    idQuestion INT NOT NULL,
    answer TEXT(1500) NOT NULL,
    isCorrect BOOLEAN NOT NULL,
	CONSTRAINT userPracticeExamQuestionDiscursivePk PRIMARY KEY (idUserPracticeExam, idQuestion),
    CONSTRAINT userPracticeExamQuestionDiscursive_UserPracticeExamFk FOREIGN KEY (idUserPracticeExam) REFERENCES userPracticeExam(idUserPracticeExam),
    CONSTRAINT userPracticeExamQuestionDiscursive_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion)
);

-- Bulk Insert

-- Table: state

LOAD DATA INFILE '../mysql-files/data/states.csv' INTO TABLE state
    FIELDS TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: city

LOAD DATA INFILE '../mysql-files/data/cities.csv' INTO TABLE city
    FIELDS TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: userType

INSERT INTO userType (`name`) VALUES ('Estudante'), ('Professor');

-- Table: user

/* 

Student Test User: studentTest@test.com / student123

Teacher Test User: teacherTest@test.com / teacher123

*/

INSERT INTO user (`name`, `lastName`, `email`, `nickname`, `password`, `phone`, `birthDate`, `profilePicture`,`street`, `streetNumber`, `district`, `postalCode`, `idCity`, `idUserType`)
    VALUES ('Estudante', 'Teste', 'studentTest@test.com', 'sdtTest', '$2y$10$SAyLpRcaRefh2/zHGLxLquZTDOrsBf76KDDVp1aFejV/WKAfPDtVy', '11111111111', '1995-10-11', '../lemonade/images/userDefaultProfilePicture.jpeg', 'street test', 404, 'test district', '11111111', 951, 1),
        ('Professor', 'Teste', 'teacherTest@test.com', 'tcrTest', '$2y$10$Vlwatf3ISmtIiCoKf4oDa.q1Lo9goVaPp0G3j/k/SAKm5B6Srl2.K', '11111111111', '1985-05-12', '../lemonade/images/adminDefaultProfilePicture.jpeg', 'street test', 404, 'test district', '11111111', 2067, 2);

-- Table: questionType

INSERT INTO questionType (`name`) VALUES ('Alternativa'), ('Discursiva');

-- Table: practiceExam

INSERT INTO practiceExam (`name`, `description`) VALUES ('Lemonade ADS 2021 – Teste', 'Simulado teste do ENADE 2021 do curso ADS com 10 perguntas');

-- Table: question

LOAD DATA INFILE '../mysql-files/data/questions.csv' INTO TABLE question
    FIELDS TERMINATED BY ';'
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: questionText

LOAD DATA INFILE '../mysql-files/data/questionsTexts.csv' INTO TABLE questionText
    FIELDS TERMINATED BY ';'
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: questionAlternative

LOAD DATA INFILE '../mysql-files/data/questionsAlternatives.csv' INTO TABLE questionAlternative
    FIELDS TERMINATED BY ';'
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: questionDiscursive

LOAD DATA INFILE '../mysql-files/data/questionsDiscursives.csv' INTO TABLE questionDiscursive
    FIELDS TERMINATED BY ';'
    ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS;

-- Table: practiceExamQuestion

INSERT INTO practiceExamQuestion (idPracticeExam, idQuestion) VALUES (1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10);