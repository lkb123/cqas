CREATE TABLE waitinglist (
    studid varchar(10),
    prioritynumber integer NOT NULL,
	dateadded date NOT NULL,
	timeadded time NOT NULL,
	dateserved date default null,
	timeserved time NOT NULL,
	served boolean default false,
	primary key(studid, dateadded, timeadded),
	foreign key(studid) references student(studid) on update cascade on delete cascade
);
