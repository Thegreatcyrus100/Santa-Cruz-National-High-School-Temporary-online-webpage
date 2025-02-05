-- Create database
CREATE DATABASE shs_enrollment;

-- Use the created database
USE shs_enrollment;

-- Create table for learners
CREATE TABLE learners (
    id INT IDENTITY(1,1) PRIMARY KEY,
    name VARCHAR NOT NULL,
    lrn VARCHAR NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR NOT NULL,
    indigenous VARCHAR DEFAULT 'no',
    province VARCHAR NOT NULL,
    municipality VARCHAR NOT NULL,
    barangay VARCHAR NOT NULL,
    street VARCHAR NOT NULL
);

-- Create table for parents/guardians
CREATE TABLE parents_guardians (
    id INT IDENTITY(1,1) PRIMARY KEY,
    learner_id INT NOT NULL,
    father_name VARCHAR,
    mother_name VARCHAR,
    guardian_name VARCHAR,
    contact VARCHAR,
    FOREIGN KEY (learner_id) REFERENCES learners(id)
);

-- Create table for senior high school details
CREATE TABLE shs_details (
    id INT IDENTITY(1,1) PRIMARY KEY,
    learner_id INT NOT NULL,
    grade VARCHAR NOT NULL,
    track VARCHAR NOT NULL,
    strand VARCHAR NOT NULL,
    learning_modality VARCHAR NOT NULL,
    FOREIGN KEY (learner_id) REFERENCES learners(id)
);

-- Create table for school information
CREATE TABLE school_info (
    id INT IDENTITY(1,1) PRIMARY KEY,
    learner_id INT NOT NULL,
    school_name VARCHAR NOT NULL,
    school_id VARCHAR NOT NULL,
    grade_level VARCHAR NOT NULL,
    section VARCHAR NOT NULL,
    school_year VARCHAR NOT NULL,
    FOREIGN KEY (learner_id) REFERENCES learners(id)
);