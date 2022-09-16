CREATE TABLE `autres_depenses` (
  `code_autres` int(11) NOT NULL,
  `montant_depense` double NOT NULL,
  `motif` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `classes` (
  `code_classe` int(11) NOT NULL,
  `designation_classe` varchar(50) NOT NULL,
  `idOption` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `eleves` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL DEFAULT current_timestamp(),
  `lieu_naissance` varchar(50) NOT NULL,
  `classe` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `enseignants` (
  `id` int(11) NOT NULL,
  `noms` varchar(150) NOT NULL,
  `grade` varchar(40) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enseignants`
--

CREATE TABLE `frais` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `montant_frais` double(50,0) NOT NULL,
  `devise` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `options` (
  `code_option` int(11) NOT NULL,
  `designation_option` varchar(50) NOT NULL,
  `idSection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `paie` (
  `` int(11) NOT NULL,
  `montant_paie` double NOT NULL,
  `mois` varchar(50) NOT NULL,
  `motif` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `perception` (
  `id` int(11) NOT NULL,
  `date_perception` date NOT NULL,
  `montant_percu` double NOT NULL,
  `idEleve` int(11) NOT NULL,
  `idFrais` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `section` (
  `code_section` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

