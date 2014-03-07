CREATE TABLE waitinglist (
    studid varchar(10),
    prioritynumber integer NOT NULL,
	timestampadded timestamp NOT NULL,
	timestampserved timestamp default null,
	served boolean default false,
	primary key(studid, timestampadded),
	foreign key(studid) references student(studid) on update cascade on delete cascade
);
