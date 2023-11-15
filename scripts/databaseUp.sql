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
    letter CHAR(1) NOT NULL,
    `text` TEXT(2000) NOT NULL,
    isCorrect BOOLEAN NOT NULL,
    idQuestion INT NOT NULL,
	CONSTRAINT questionAlternativePk PRIMARY KEY (idQuestionAlternative)
);

-- Constraints // Pattern: tableName_columnFK

ALTER TABLE `user` ADD CONSTRAINT user_cityFk FOREIGN KEY (idCity) REFERENCES city(idCity);

ALTER TABLE `user` ADD CONSTRAINT user_TypeFk FOREIGN KEY (idUserType) REFERENCES userType(idUserType);

ALTER TABLE city ADD CONSTRAINT city_StateFk FOREIGN KEY (idState) REFERENCES state(idState);

ALTER TABLE question ADD CONSTRAINT question_TypeFk FOREIGN KEY (idQuestionType) REFERENCES questionType(idQuestionType);

ALTER TABLE questionText ADD CONSTRAINT questionText_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion);

ALTER TABLE questionAlternative ADD CONSTRAINT questionAlternative_QuestionFk FOREIGN KEY (idQuestion) REFERENCES question(idQuestion);

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
