drop table if exists reservation;
drop table if exists vol;
drop table if exists avion;
drop table if exists typeAvion;
drop table if exists utilisateur;
drop table if exists aeroport;


create table utilisateur (pseudo varchar(20) not null,
						  nom varchar(20),
						  prenom varchar(20),
						  rue varchar(50),
						  cp numeric(5),
						  email varchar(20),
						  mdp varchar(20) not null,
						  admin tinyint(1) not null default 0,
						  primary key(pseudo))ENGINE=InnoDB;

create table typeAvion (numType int not null,
						nomType varchar(20),
						nbSiege int,
						primary key(numType))ENGINE=InnoDB;

create table avion (refAvion int not null auto_increment,
					typeAvion int not null,
					primary key(refAvion))ENGINE=InnoDB;

create table aeroport  (refAeroport int not null auto_increment,
						nomAeroport varchar(20),
						primary key(refAeroport))ENGINE=InnoDB;

create table vol (refVol int not null auto_increment,
				  avion int not null,
				  aeroport1 int not null,
				  aeroport2 int not null,
				  dateDepart datetime,
				  dateArrivee datetime,
				  prix float,
				  primary key(refVol))ENGINE=InnoDB;

create table reservation (utilisateur varchar(20) not null,
						  vol int not null,
						  placeReserve int,
						  primary key(utilisateur,vol))ENGINE=InnoDB;

alter table avion ADD CONSTRAINT typeAvion_fk foreign key(typeAvion) references typeAvion(numType) ON DELETE CASCADE ON UPDATE CASCADE;

alter table vol ADD CONSTRAINT avionRef_fk foreign key(avion) references avion(refAvion) ON DELETE CASCADE ON UPDATE CASCADE,
				ADD CONSTRAINT aeroport1_fk foreign key(aeroport1) references aeroport(refAeroport) ON DELETE CASCADE ON UPDATE CASCADE,
				ADD CONSTRAINT aeroport2_fk foreign key(aeroport2) references aeroport(refAeroport) ON DELETE CASCADE ON UPDATE CASCADE;

alter table reservation ADD CONSTRAINT  utilisateur_fk FOREIGN KEY (utilisateur) REFERENCES utilisateur(pseudo) ON DELETE CASCADE ON UPDATE CASCADE,
						ADD CONSTRAINT  vol_fk FOREIGN KEY (vol) REFERENCES vol(refVol) ON DELETE CASCADE ON UPDATE CASCADE;