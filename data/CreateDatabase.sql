SET
  FOREIGN_KEY_CHECKS = 0;

SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

DROP TABLE IF EXISTS `TM1_Task`;

DROP TABLE IF EXISTS `TM1_Project`;

DROP TABLE IF EXISTS `TM1_User`;

CREATE TABLE `TM1_User` (
  `userId` int(11) PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT 'geheim',
  `role` varchar(10) DEFAULT 'medewerker'
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO
  `TM1_User` (`userId`, `username`, `password`, `role`)
VALUES
  (1, 'Henk', 'henk123', 'manager'),
  (2, 'Piet', 'piet123', 'medewerker'),
  (3, 'Klaas', 'klaas123', 'medewerker'),
  (6, 'Maria', 'maria123', 'manager'),
  (9, 'Truus', 'truus123', 'medewerker'),
  (10, 'Frans', 'frans123', 'manager');

CREATE TABLE `TM1_Project` (
  `projectId` int(11) PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `owner` varchar(40) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO
  `TM1_Project` (
    `projectId`,
    `title`,
    `description`,
    `owner`,
    `status`
  )
VALUES
  (
    1,
    'Maria\'s kamer opknappen',
    'Na deze opknapbeurt zal Maria\'s kamer er weer piekfijn uitzien',
    'Maria',
    ''
  ),
  (
    3,
    'Computer opnieuw installeren',
    'Van Windows 8.1 naar Windows 10',
    'Maria',
    'klaar'
  ),
  (
    4,
    'Huis schoonmaken',
    'Van boven tot onder',
    'Frans',
    ''
  );

CREATE TABLE `TM1_Task` (
  `projectId` int(11) NOT NULL,
  `taskNumber` int(11) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `worker` varchar(40) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  CONSTRAINT PRIMARY KEY (`projectId`, `taskNumber`),
  CONSTRAINT FOREIGN KEY (`projectId`) REFERENCES `TM1_Project` (`projectId`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO
  `TM1_Task` (
    `taskNumber`,
    `projectId`,
    `title`,
    `description`,
    `worker`,
    `status`
  )
VALUES
  (
    1,
    1,
    'Plinten schilderen',
    'Graag mat wit RAL9010. Spijkergaten eerst plamuren.',
    'Piet',
    'busy'
  ),
  (
    2,
    1,
    'Vensterbank vastmaken',
    'De vensterbank ligt er nu los op. Geen schroeven of spijkers gebruiken, maar montagekit. Randen afwerken met acrilaatkit',
    'Klaas',
    'busy'
  ),
  (
    4,
    1,
    'Behangen',
    'De behangrollen liggen al een jaar klaar bij de behangtafel op zolder achter de oude fietsen.',
    '',
    'to do'
  ),
  (
    5,
    3,
    'Juiste versie kiezen',
    'PRO?, Nederlandstalig?',
    'Klaas',
    'done'
  ),
  (6, 4, 'Stofzuigen', '', '', 'to do');

SET
  FOREIGN_KEY_CHECKS = 1;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;