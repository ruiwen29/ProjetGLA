#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: TypeUser
#------------------------------------------------------------

CREATE TABLE TypeUser(
        id_type Int  Auto_increment  NOT NULL ,
        type    Varchar (20) NOT NULL
	,CONSTRAINT TypeUser_PK PRIMARY KEY (id_type)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TypeRoute
#------------------------------------------------------------

CREATE TABLE TypeRoute(
        id_typeRoute Int NOT NULL ,
        nomTypeRoute Varchar (20) NOT NULL
	,CONSTRAINT TypeRoute_PK PRIMARY KEY (id_typeRoute)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: route
#------------------------------------------------------------

CREATE TABLE route(
        id_route           Int  Auto_increment  NOT NULL ,
        nomRoute           Varchar (20) NOT NULL ,
        id_typeRoute       Int NOT NULL ,
        id_typeRoute_Avoir Int NOT NULL
	,CONSTRAINT route_AK UNIQUE (id_typeRoute)
	,CONSTRAINT route_PK PRIMARY KEY (id_route)

	,CONSTRAINT route_TypeRoute_FK FOREIGN KEY (id_typeRoute_Avoir) REFERENCES TypeRoute(id_typeRoute)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Coordonnees
#------------------------------------------------------------

CREATE TABLE Coordonnees(
        id_coord  Int  Auto_increment  NOT NULL ,
        latitude  Float NOT NULL ,
        longitude Float NOT NULL
	,CONSTRAINT Coordonnees_PK PRIMARY KEY (id_coord)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id_user          Int  Auto_increment  NOT NULL ,
        nom              Varchar (20) NOT NULL ,
        mail             Varchar (30) NOT NULL ,
        passeword        Varchar (30) NOT NULL ,
        id_type_TypeUser Int NOT NULL ,
        id_coord         Int
	,CONSTRAINT User_PK PRIMARY KEY (id_user)

	,CONSTRAINT User_TypeUser_FK FOREIGN KEY (id_type_TypeUser) REFERENCES TypeUser(id_type)
	,CONSTRAINT User_Coordonnees0_FK FOREIGN KEY (id_coord) REFERENCES Coordonnees(id_coord)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TrajetFavori
#------------------------------------------------------------

CREATE TABLE TrajetFavori(
        id_trajet Int  Auto_increment  NOT NULL ,
        Trajet    Varchar (1000) NOT NULL ,
        id_user   Int
	,CONSTRAINT TrajetFavori_PK PRIMARY KEY (id_trajet)

	,CONSTRAINT TrajetFavori_User_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Ville
#------------------------------------------------------------

CREATE TABLE Ville(
        id_ville     Int  Auto_increment  NOT NULL ,
        nom_ville    Varchar (20) NOT NULL ,
        touristique  int NOT NULL ,
        id_typeVille Int NOT NULL ,
        id_coord     Int NOT NULL
	,CONSTRAINT Ville_AK UNIQUE (id_typeVille)
	,CONSTRAINT Ville_PK PRIMARY KEY (id_ville)

	,CONSTRAINT Ville_Coordonnees_FK FOREIGN KEY (id_coord) REFERENCES Coordonnees(id_coord)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Troncon
#------------------------------------------------------------

CREATE TABLE Troncon(
        id_trocon   Int  Auto_increment  NOT NULL ,
        vitesse     Float NOT NULL ,
        radar       Int NOT NULL ,
        touristique int NOT NULL ,
        payant      Float NOT NULL ,
        longeur     Float NOT NULL ,
        ville1      Int NOT NULL ,
        ville2      Int NOT NULL ,
        id_ville    Int NOT NULL ,
        id_ville_2  Int NOT NULL ,
        id_route    Int NOT NULL
	,CONSTRAINT Troncon_AK UNIQUE (ville1,ville2)
	,CONSTRAINT Troncon_PK PRIMARY KEY (id_trocon)

	,CONSTRAINT Troncon_Ville_FK FOREIGN KEY (id_ville,id_ville_2) REFERENCES Ville(id_ville,id_ville)
	,CONSTRAINT Troncon_route0_FK FOREIGN KEY (id_route) REFERENCES route(id_route)
)ENGINE=InnoDB;

