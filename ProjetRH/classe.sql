
DROP DATABASE IF EXISTS RH;
create database RH ;
-- GRANT ALL PRIVILEGES ON RH.* to 'php_user' IDENTIFIED BY 'president';
use RH ; #utilise la base RH 

create table employe ( idEmp int auto_increment,
		nom varchar(32),
		prenom varchar(32),
		sexe varchar(32),
        ddn date,
        ldn varchar(32),
        sitMatr varchar(32),
        nbrEnfant int,
        adresse varchar(32),
        poste varchar(32),
        service varchar(32),
        telephone int,
        categorie varchar(32),
        constraint pk_Emp primary key (idEmp));

create table contrat (idContrat int auto_increment,
		typeContrat varchar(32),
		date_debut date,
        date_fin_CDD date,
        nbrHeure float,
        tauxH float,
        salaire_base float,
        emp_contrat int,
        constraint pk_Contrat primary key (idContrat),
        constraint fk_ctr foreign key (emp_contrat) references employe (idEmp) ) ;

create table conges (idConge int auto_increment,
		date_demande text,
        date_debut date,
        date_fin date,
        emp_conge int,
        statut text,
        type_conges enum('Congé Maternité','Congé Exceptionnel','Congé Annuel'),
		constraint pk_conge primary key (idConge),
        constraint fk_con foreign key (emp_conge) references employe (idEmp));

create table absence (idAbsence int auto_increment,
	motifAbsence varchar(32),
    date_demande text,
    date_depart date,
    date_retour date,
    statut text,
     emp_absence int,
    constraint pk_Absence primary key (idAbsence),
    constraint fk_abs foreign key (emp_absence) references employe (idEmp)
);


create table salaire (idSalaire int auto_increment,
        emp_sal int,
        sursalaire float,
        primeAnc float,
        heureSup float,
        salaireBrutSocial float,
        salaireFiscal float,
        avantageNature float,
        abattement float,
        partIR float,
        partTrimf float,
        ipm float,
        ipressRC float,
        ipressRG float,
        retenueSalaire float,
        remuneNette float,
        netAPayer float,
        primeTrans float,
        oppositions float,
        plafond float,
        plafond2 float,
		constraint pk_Salaire primary key (idSalaire),
        constraint fk_salaire foreign key (emp_sal) references employe (idEmp)
);

create table bulletin_paie (idBulletin int auto_increment,
		date_saisie date,
		date_paiement date,
		mode_paiement varchar(30), 
        bull_emp int,
        bull_sal int,
        constraint pk_bull primary key (idBulletin),
		constraint fk_be foreign key (bull_emp) references employe (idEmp),
        constraint fk_sal foreign key (bull_sal) references salaire (idSalaire));


		
create table annonce (idAnnonce int auto_increment,
        titre varchar(32),
		contenu text,
        dateAnnonce text,
		constraint pk_Annonce primary key (idAnnonce));
        
create table compte(idCompte int auto_increment,
    email varchar(50),
    motdepasse varchar(32),
    roles varchar(32),
    compteEmp int,
    constraint fk_co foreign key (compteEmp) references employe (idEmp),
    constraint pk_idc primary key (idCompte) );


INSERT INTO `compte`( `email`, `motdepasse`, `roles`) VALUES ('mariama@esp.sn',md5('passer123'),'Administration');






 