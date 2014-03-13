
CREATE TABLE cashier (
	cashierid character varying(10) NOT NULL primary key,
	cashierpass varchar(15) NOT NULL,
	lastname varchar(20),
    givenname varchar(50),
    middlename varchar(20),
);