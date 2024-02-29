-- Active: 1706778247599@@127.0.0.1@3306@ecf
insert into type_individu(code,libelle) VALUES
('F001','formateur'),
('E002','eleve');

insert into college(code,nom,adresse,telephone) VALUES
('C001','Université de Lille','42 Rue Paul Duez, 59000 Lille','+330698736281');

insert into classe(code,libelle) VALUES
('001','Salle1'),
('002','Salle2'),
('003','Salle3'),
('004','Salle4'),
('005','Salle5'),
('006','Salle6'),
('007','Salle7'),
('008','Salle8');

insert into matiere(code,libelle) VALUES
('P01','Physical Education'),
('C01','Civic Education'),
('E01','Engineering Sciences'),
('F01','French Arts'),
('M01','Mathematics'),
('P02','Physics'),
('C02','Chemistry'),
('L01','Literature');

INSERT into individu(numero_matricule,nom,prenom,adresse,telephone,typeindividu_id,classe_id) VALUES
('FOR001','Malla','Suresh','Marseille','0698621571',1,1);