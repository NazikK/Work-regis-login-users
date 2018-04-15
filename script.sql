CREATE TABLE `users` (
	`ID` bigint NOT NULL AUTO_INCREMENT,
	`Username` varchar(30) NOT NULL,
	`Email` varchar(30) NOT NULL,
	`Phone` int(30) NOT NULL,
	`date` DATE NOT NULL,
	`passwordHach` varchar(30) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `roles` (
	`ID` bigint NOT NULL AUTO_INCREMENT,
	`Name` varchar(30) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `roles_users` (
	`ID` bigint NOT NULL AUTO_INCREMENT,
	`ID_Users` bigint NOT NULL,
	`ID_Roles` bigint NOT NULL,
	PRIMARY KEY (`ID`)
);

ALTER TABLE `roles_users` ADD CONSTRAINT `roles_users_fk0` FOREIGN KEY (`ID_Users`) REFERENCES `users`(`ID`);

ALTER TABLE `roles_users` ADD CONSTRAINT `roles_users_fk1` FOREIGN KEY (`ID_Roles`) REFERENCES `roles`(`ID`);

