insert into utilisateur values('roger','roger','dupont','7 rue Oui',77777,'azoiko@akjek.iaz','aaa',1);
insert into utilisateur (pseudo,mdp) values('gerard','123');

insert into typeavion values(1,'A380',500),
							(2,'A320',400);

insert into avion(typeavion) values(1),(2),(1);

insert into aeroport(nomAeroport) values('Charles de Gaulle'),('Orly'),('Lyon'),('Dubai');

insert into vol(avion,aeroport1,aeroport2,dateDepart,dateArrivee,prix) values (1,1,2,'2018-11-06 17:00:00','2018-11-06 20:00:00',120.55);