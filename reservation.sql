drop table if exists utilisateur;
drop table if exists typeAvion;
drop table if exists avion;
drop table if exists aeroport;
drop table if exists vol;
drop table if exists reservation;

create table utilisateur (pseudo varchar(20) not null,
						  nom varchar(20),
						  prenom varchar(20),
						  rue varchar(50),
						  cp numeric(5),
						  email varchar(20),
						  mdp varchar(20) not null,
						  admin tinyint(1) not null default 0,
						  primary key(pseudo));

create table typeAvion (numType int not null,
						nomType varchar(20),
						nbSiege int,
						primary key(numType));

create table avion (refAvion int not null auto_increment,
					typeAvion int not null,
					primary key(refAvion),
					foreign key(typeAvion) references typeAvion(numType));

create table aeroport  (refAeroport int not null auto_increment,
						nomAeroport varchar(20),
						primary key(refAeroport));

create table vol (refVol int not null auto_increment,
				  avion int not null,
				  aeroport1 int not null,
				  aeroport2 int not null,
				  dateDepart datetime,
				  dateArrivee datetime,
				  prix float,
				  primary key(refVol),
				  foreign key(avion) references avion(refAvion),
				  foreign key(aeroport1) references aeroport(refAeroport),
				  foreign key(aeroport2) references aeroport(refAeroport));

create table reservation (utilisateur varchar(20) not null,
						  vol int not null,
						  placeReserve int,
						  primary key(utilisateur,vol),
						  foreign key(utilisateur) references utilisateur(pseudo),
						  foreign key(vol) references vol(refVol));

