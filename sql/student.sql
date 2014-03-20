CREATE TABLE student (
    studid character varying(10) NOT NULL primary key,
    studphone character varying(15),
    lastname varchar(20),
    givenname varchar(50),
    middlename varchar(20),
    course varchar(70),
    college varchar(40),
    valid boolean default true /* validity of the student to be added to the waiting list */
);
