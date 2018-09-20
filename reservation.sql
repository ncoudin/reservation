drop table if exists utilisateur;
drop table if exists typeAvion;
drop table if exists avion;
drop table if exists aeroport;
drop table if exists vol;
drop table if exists reservation;

create table utilisateur (pseudo varchar(20) not null,
						  mdp varchar(20) not null,
						  admin tinyint(1) not null default 0,
						  primary key(pseudo));

create table typeAvion (numType int not null,
						nomType varchar(20),
						nbSiege int,
						primary key(numType));

create table avion (refAvion varchar(20) not null,
					typeAvion varchar(20) not null,
					primary key(refAvion),
					foreign key(typeAvion) references typeAvion(numType));

create table aeroport  (refAeroport varchar(20) not null,
						nomAeroport varchar(20),
						primary key(refAeroport));

create table vol (refVol varchar(20) not null,
				  avion varchar(20) not null,
				  aeroport1 varchar(20) not null,
				  aeroport2 varchar(20) not null,
				  dateDepart datetime,
				  dateArrivee datetime,
				  primary key(refVol),
				  foreign key(avion) references avion(refAvion),
				  foreign key(aeroport1) references aeroport(refAeroport),
				  foreign key(aeroport2) references aeroport(refAeroport));

create table reservation (utilisateur varchar(20) not null,
						  vol varchar(20) not null,
						  primary key(utilisateur,vol),
						  foreign key(utilisateur) references utilisateur(pseudo),
						  foreign key(vol) references vol(refVol));

