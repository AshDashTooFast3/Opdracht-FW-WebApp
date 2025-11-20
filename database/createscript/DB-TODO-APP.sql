USE TODO_APP;

CREATE TABLE Taken (
    Id INT AUTO_INCREMENT PRIMARY KEY
    ,GebruikerId INT NOT NULL
    ,WeekNummer TINYINT NOT NULL
    ,Titel VARCHAR(100) NOT NULL
    ,Beschrijving VARCHAR(255) NOT NULL
    ,Status ENUM('Open', 'Afgerond') DEFAULT 'Open'
    ,IsActief BIT DEFAULT 1
    ,Opmerking VARCHAR(225) DEFAULT NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,FOREIGN KEY (GebruikerId) REFERENCES users(Id)
);

INSERT INTO Taken (GebruikerId, WeekNummer, Titel, Beschrijving, Status, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
(1, 23, 'Taak 1', 'Beschrijving van taak 1', 'Open', 1, NULL, NOW(6), NOW(6)),
(2, 24, 'Taak 2', 'Beschrijving van taak 2', 'Afgerond', 1, 'Opmerking bij taak 2', NOW(6), NOW(6)),
(1, 25, 'Taak 3', 'Beschrijving van taak 3', 'Open', 1, NULL, NOW(6), NOW(6)),
(2, 26, 'Taak 4', 'Beschrijving van taak 4', 'Open', 1, NULL, NOW(6), NOW(6)),
(1, 27, 'Taak 5', 'Beschrijving van taak 5', 'Afgerond', 1, 'Opmerking bij taak 5', NOW(6), NOW(6));

CREATE TABLE Labels (
    Id INT AUTO_INCREMENT PRIMARY KEY
    ,Label VARCHAR(100) NOT NULL 
);

INSERT INTO Labels (Label)
VALUES
('School'),
('Werk'),
('Persoonlijk'),
('Gezondheid'),
('Hobby');

CREATE TABLE TaakLabelKoppeling (
    Id INT AUTO_INCREMENT PRIMARY KEY
    ,TaakId INT NOT NULL
    ,LabelId INT NOT NULL
    ,FOREIGN KEY (TaakId) REFERENCES Taken(Id)
    ,FOREIGN KEY (LabelId) REFERENCES Labels(Id)
);

INSERT INTO TaakLabelKoppeling (TaakId, LabelId)
VALUES
(1, 3),
(2, 2),
(3, 1),
(4, 4),
(5, 5);

CREATE TABLE WeekReflecties (
    Id INT AUTO_INCREMENT PRIMARY KEY
    ,GebruikerId INT NOT NULL
    ,WeekNummer INT NOT NULL
    ,WatGeleerd VARCHAR(255) NULL
    ,WatLastig VARCHAR(255) NULL
    ,VolgendeStap VARCHAR(255) NULL
    ,FOREIGN KEY (GebruikerId) REFERENCES users(Id)
);

INSERT INTO WeekReflecties (GebruikerId, WeekNummer, WatGeleerd, WatLastig, VolgendeStap)
VALUES
(1, 23, 'SQL geleerd', 'Tijdmanagement', 'Meer oefenen'),
(2, 24, 'Nieuwe framework geprobeerd', 'Installatieproblemen', 'Documentatie lezen'),
(1, 25, 'Frontend verbeterd', 'CSS lastig', 'Tutorial volgen'),
(2, 26, 'API koppeling gemaakt', 'Authenticatie', 'Beveiliging verbeteren'),
(1, 27, 'Teamwork', 'Communicatie', 'Beter plannen');
