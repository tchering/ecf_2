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

insert into annee_scolaire(code,date_debut,date_fin) VALUES
('A21','2021-01-01','2022-12-30'),
('A22','2022-01-01','2023-12-30'),
('A23','2023-01-01','2024-12-30'),
('A24','2024-01-01','2025-12-30'),
('A25','2025-01-01','2026-12-30'),
('A26','2026-01-01','2027-12-30'),
('A27','2027-01-01','2028-12-30'),
('A28','2028-01-01','2029-12-30'),
('A29','2029-01-01','2030-12-30'),
('A30','2030-01-01','2031-12-30');

INSERT into trimestre(code,libelle,date_debut,date_fin,anneescolaire_id) VALUES
('T1','1er Trimestre','2021-01-01','2021-04-30',1),
('T2','2eme Trimestre','2021-05-01','2021-08-31',1),
('T3','3eme Trimestre','2021-09-01','2021-12-31',1),
('T1','1er Trimestre','2022-01-01','2022-04-30',2),
('T2','2eme Trimestre','2022-05-01','2022-08-31',2),
('T3','3eme Trimestre','2022-09-01','2022-12-31',2),
('T1','1er Trimestre','2023-01-01','2023-04-30',3),
('T2','2eme Trimestre','2023-05-01','2023-08-31',3),
('T3','3eme Trimestre','2023-09-01','2023-12-31',3),
('T1','1er Trimestre','2024-01-01','2024-04-30',4),
('T2','2eme Trimestre','2024-05-01','2024-08-31',4),
('T3','3eme Trimestre','2024-09-01','2024-12-31',4),
('T1','1er Trimestre','2025-01-01','2025-04-30',5),
('T2','2eme Trimestre','2025-05-01','2025-08-31',5),
('T3','3eme Trimestre','2025-09-01','2025-12-31',5),
('T1','1er Trimestre','2026-01-01','2026-04-30',6),
('T2','2eme Trimestre','2026-05-01','2026-08-31',6),
('T3','3eme Trimestre','2026-09-01','2026-12-31',6),
('T1','1er Trimestre','2027-01-01','2027-04-30',7),
('T2','2eme Trimestre','2027-05-01','2027-08-31',7),
('T3','3eme Trimestre','2027-09-01','2027-12-31',7),
('T1','1er Trimestre','2028-01-01','2028-04-30',8),
('T2','2eme Trimestre','2028-05-01','2028-08-31',8),
('T3','3eme Trimestre','2028-09-01','2028-12-31',8),
('T1','1er Trimestre','2029-01-01','2029-04-30',9),
('T2','2eme Trimestre','2029-05-01','2029-08-31',9),
('T3','3eme Trimestre','2029-09-01','2029-12-31',9),
('T1','1er Trimestre','2030-01-01','2030-04-30',10),
('T2','2eme Trimestre','2030-05-01','2030-08-31',10),
('T3','3eme Trimestre','2030-09-01','2030-12-31',10);