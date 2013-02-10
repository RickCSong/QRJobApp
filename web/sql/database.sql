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
    field VARCHAR(1000),
    company VARCHAR(1000),
    location VARCHAR(1000),
    duration VARCHAR(100),
    description VARCHAR(20000),
    area VARCHAR(20000),
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
INSERT INTO users(firstName, lastName, phone, email, school) values ('Alex', 'Chiu', '481-384-1238', 'alexchiu@gmail.com', 'Rice University');

INSERT INTO jobs(title, field, company, location, duration, description, area) values ('Software Engineer', 'Software Engineering', 'Google', 'Mountain View, CA', 'Full-time', 'Do you want to help Google build next-generation web applications like Gmail, Google Docs, Google Maps, and Google+? As a Front End Engineer at Google, you will specialize in building responsive and elegant web UIs with AJAX and similar technologies.', 'Google is and always will be an engineering company. We hire people with a broad set of technical skills who are ready to tackle some of technologys greatest challenges and make an impact on millions, if not billions, of users. At Google, engineers not only revolutionize search, they routinely work on massive scalability and storage solutions, large-scale applications and entirely new platforms for developers around the world. From AdWords to Chrome, Android to YouTube, Social to Local, Google engineers are changing the world one technological achievement after another.');
INSERT INTO jobs(title, field, company, location, duration, description, area) values ('Hardware Engineer', 'Hardware Engineering', 'Apple', 'Cupertino, CA', 'Full-time', 'The Audio Hardware group is looking for a senior audio electrical engineer. This person will work with a top-notch engineering team developing audio electronics for Macintosh computers, iPads, and related accessories. In addition to having responsibility for implementing the audio hardware solutions for multiple programs, the job entails working with system teams and cross-functional groups to continually push the envelope of audio technology implemented in Apple products.', 'At Apple, great ideas have a way of becoming great products, services, and customer experiences very quickly. Bring passion and dedication to your job and there\'s no telling what you could accomplish.');
INSERT INTO jobs(title, field, company, location, duration, description, area) values ('Software Engineer Intern', 'Software Engineering', 'Amazon', 'Seattle, WA', 'Intern', 'From Amazon: We hire software development engineer interns into our technical teams based in Seattle, Washington. Our interns and co-ops design, develop, and write real software and partner with a select group of experienced software development engineers, who both challenge and further develop them as they analyze and solve innovative projects that matter to our customers.', 'At Amazon, we\'ve re-invented the online shopping experience, cloud computing, publishing, and even the book. But that\'s not all. While most people have heard of Amazon.com, Amazon Web Services, and Kindle products, not many know that we also develop video games, engineer music and video streaming technology, shoot high-fashion photography, and help other businesses sell and distribute their products. We are a federation of startups, each one working to build the best solution to unique problems.');

INSERT INTO applications(user_id, job_id, time) values (1, 1, UNIX_TIMESTAMP(NOW()) - 20000);
INSERT INTO applications(user_id, job_id, time) values (2, 1, UNIX_TIMESTAMP(NOW()) - 10000);
INSERT INTO applications(user_id, job_id, time) values (3, 1, UNIX_TIMESTAMP(NOW()));

INSERT INTO applications(user_id, job_id, time) values (1, 2, UNIX_TIMESTAMP(NOW()) - 40000);
INSERT INTO applications(user_id, job_id, time) values (2, 2, UNIX_TIMESTAMP(NOW()) - 30000);

INSERT INTO applications(user_id, job_id, time) values (1, 3, UNIX_TIMESTAMP(NOW()));
