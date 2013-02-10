DROP TABLE IF EXISTS
    jobs_to_qualifications,
    applications,
    users,
    jobs,
    qualifications;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    phone VARCHAR(100),
    email VARCHAR(100),
    school VARCHAR(100),
    resume LONGBLOB,
    CONSTRAINT PRIMARY KEY (id)
    );

CREATE TABLE jobs (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(1000),
    company VARCHAR(1000),
    location VARCHAR(1000),
    duration VARCHAR(100),
    description VARCHAR(20000),
    CONSTRAINT PRIMARY KEY (id)
    );

CREATE TABLE applications (
       id INT NOT NULL AUTO_INCREMENT,
       user_id INT NOT NULL,
       job_id INT NOT NULL,
       time INT NOT NULL,
       CONSTRAINT PRIMARY KEY (id),
       CONSTRAINT fk_applications_user_id FOREIGN KEY (user_id) REFERENCES users(id),
       CONSTRAINT fk_applications_job_id FOREIGN KEY (job_id) REFERENCES jobs(id)
    );

INSERT INTO users(firstName, lastName, phone, email, school) values ('Ivan', 'Van', '911-911-9111', 'ivan@gmail.com', 'Rice University');
INSERT INTO users(firstName, lastName, phone, email, school) values ('Rick', 'Song', '123-456-7890', 'rickcsong@gmail.com', 'Rice University');
INSERT INTO users(firstName, lastName, phone, email, school) values ('Hassaan', 'Markhiani', '098-765-4321', 'hassaan@gmail.com', 'University of Texas');

INSERT INTO jobs(title, company, location, duration) values ('Software Engineer', 'Google', 'Mountain View, CA', 'Full-time');
INSERT INTO jobs(title, company, location, duration) values ('Hardware Engineer', 'Apple', 'Cupertino, CA', 'Full-time');
INSERT INTO jobs(title, company, location, duration) values ('Software Engineer Intern', 'Amazon', 'Seattle, WA', 'Intern');

INSERT INTO applications(user_id, job_id, time) values (1, 1, UNIX_TIMESTAMP(NOW()) - 20000);
INSERT INTO applications(user_id, job_id, time) values (2, 1, UNIX_TIMESTAMP(NOW()) - 10000);
INSERT INTO applications(user_id, job_id, time) values (3, 1, UNIX_TIMESTAMP(NOW()));

INSERT INTO applications(user_id, job_id, time) values (1, 2, UNIX_TIMESTAMP(NOW()) - 40000);
INSERT INTO applications(user_id, job_id, time) values (2, 2, UNIX_TIMESTAMP(NOW()) - 30000);

INSERT INTO applications(user_id, job_id, time) values (1, 3, UNIX_TIMESTAMP(NOW()));
