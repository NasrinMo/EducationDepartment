CREATE TABLE student (
id_student INT(6) AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(30) NOT NULL,
lastName VARCHAR(30) NOT NULL,
birthday date,
gender VARCHAR(1),
email VARCHAR(50),
phone VARCHAR(10),
update_at TIMESTAMP NOT NULL
    DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE course (
id_course INT(6) AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NOT NULL,
unit VARCHAR(30) NOT NULL,
description text,
update_at TIMESTAMP NOT NULL
    DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE enrollment (
id_student INT(6),
id_course INT(6),
update_at TIMESTAMP NOT NULL
    DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_student) REFERENCES  student(id_student),
FOREIGN KEY (id_course) REFERENCES  course(id_course),
constraint id_student_course primary key(id_student,id_course)
);

CREATE TABLE tags (
id INT(6) AUTO_INCREMENT PRIMARY KEY,
id_student INT(6),
name VARCHAR(30) NOT NULL,
update_at TIMESTAMP NOT NULL
    DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_student) REFERENCES  student(id_student)
);

CREATE TABLE users (
id INT(6) AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(30) NOT NULL,
lastName VARCHAR(30) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(32) NOT NULL,
imageUrl VARCHAR(255) NOT NULL,
token VARCHAR(32) NOT NULL,
update_at TIMESTAMP NOT NULL
    DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



--STUDENT LIST
-- select student.*,tags.*
-- from student join tags
-- on student.id_student = tags.id_student;


-- select student.firstName,student.lastName,enrollment.id_course 
-- from student JOIN enrollment 
-- on student.id_student = enrollment.id_student

-- select e.id_student,firstName,lastName,title
-- from student s JOIN enrollment e
-- on s.id_student = e.id_student JOIN course c
-- on c.id_course = e.id_course order by e.id_student ;

-- select s.firstName,s.lastName,c.title
-- from student s join enrollment e
-- on s.id_student = e.id_student join course  c 
-- on c.id_course = e.id_course order by e.id_student;