DROP TABLE IF EXISTS
    users,
    jobs,
    qualifications,
    jobs_to_qualifications;

CREATE TABLE users (
    email VARCHAR(100) NOT NULL,
    name VARCHAR(100),
    phone BIGINT,
    resume LONGBLOB,
    CONSTRAINT PRIMARY KEY (email)
    );

CREATE TABLE jobs (
    id INT NOT NULL AUTO_INCREMENT,
    company VARCHAR(1000),
    title VARCHAR(1000),
    location VARCHAR(1000),
    duration VARCHAR(100),
    description VARCHAR(20000),
    CONSTRAINT PRIMARY KEY (id)
    );

CREATE TABLE qualifications (
    id INT NOT NULL AUTO_INCREMENT,
    qualification VARCHAR(1000),
    CONSTRAINT PRIMARY KEY (id)
    );

CREATE TABLE jobs_to_qualifications (
    job_id INT NOT NULL,
    qualification_id INT NOT NULL,
    CONSTRAINT fk_job_id FOREIGN KEY (job_id) REFERENCES jobs(id),
    CONSTRAINT fk_qualification_id FOREIGN KEY (qualification_id) REFERENCES qualifications(id)
    );
