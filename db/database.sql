-- W04 Prove Assignment

-- USERS TABLE QUERY
CREATE TABLE users (
    userId INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    emailAddress VARCHAR(100) UNIQUE NOT NULL,
    userPassword VARCHAR(255) NOT NULL,
    userRole INT NOT NULL DEFAULT 1,
    resetToken VARCHAR(100) DEFAULT NULL,
    tokenExpire TIMESTAMP NULL DEFAULT NULL
);

INSERT INTO users (firstName, lastName, emailAddress, userPassword) VALUES ('Randeep', 'Ranu', 'rfranu7@gmail.com', 'password');

-- FREQUENCY TABLE QUERY
CREATE TABLE frequency (
	frequencyId INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	frequencyName VARCHAR(30) NOT NULL
);

INSERT INTO frequency (frequencyName) VALUES ('Daily');

-- HABIT TABLE QUERY
CREATE TABLE habit (
	habitId INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	userId INT REFERENCES users(userId) NOT NULL,
	frequencyId INT REFERENCES frequency(frequencyId) NOT NULL,
	habitName TEXT NOT NULL
);

INSERT INTO habit (userId, frequencyId, habitName) VALUES (1, 1, 'Read the scriptures');

-- PROGRESS TABLE QUERY
CREATE TABLE progress (
	progressId INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	habitId INT REFERENCES habit(habitId) NOT NULL,
	day DATE NOT NULL,
    result BOOLEAN
);

INSERT INTO progress (habitId, day, result) VALUES (1, '2021-01-30', TRUE);

-- LOG TABLE QUERY
CREATE TABLE logs (
	logId INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	userId INT REFERENCES users(userId) NOT NULL,
	userAction TEXT NOT NULL,
    dateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO logs (userId, userAction) VALUES (1, 'User logged in');