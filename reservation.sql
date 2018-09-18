drop table if exists utilisateur;

create table utilisateur (pseudo varchar(20) not null,
						  mdp varchar(20) not null,
						  admin tinyint(1) not null default 0,
						  primary key(pseudo))