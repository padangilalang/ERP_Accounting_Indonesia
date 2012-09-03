drop table if exists AuthItem;
drop table if exists AuthItemChild;
drop table if exists AuthAssignment;
drop table if exists Rights;

create table s_authitem
(
   name varchar(64) not null,
   type integer not null,
   description text,
   bizrule text,
   data text,
   primary key (name)
);

create table s_authitemchild
(
   parent varchar(64) not null,
   child varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references s_authitem (name) on delete cascade on update cascade,
   foreign key (child) references s_authitem (name) on delete cascade on update cascade
);

create table s_authassignment
(
   itemname varchar(64) not null,
   userid varchar(64) not null,
   bizrule text,
   data text,
   primary key (itemname,userid),
   foreign key (itemname) references s_authitem (name) on delete cascade on update cascade
);

create table s_authrights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references s_authitem (name) on delete cascade on update cascade
);