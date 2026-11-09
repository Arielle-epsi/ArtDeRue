INSERT INTO artistes (id, pseudonyme, nom_reel, bio, nationalite) VALUES
(4, 'Banksy', NULL, 'Artiste anonyme mondialement célèbre pour ses pochoirs engagés et satiriques.', 'Britannique'),
(5, 'Invader', 'Franck Slama', 'Artiste urbain français connu pour ses mosaïques en céramique de Space Invaders.', 'Française'),
(6, 'Miss.Tic', 'Radhia Novat', 'Poétesse et plasticienne majeure du street art parisien, connue pour ses silhouettes féminines.', 'Française');

INSERT INTO benevoles (id, nom, prenom, email) VALUES
(4, 'Dupont', 'Alice', 'alice.dupont@art2rue.org'),
(5, 'Martin', 'Lucas', 'lucas.martin@art2rue.org'),
(6, 'Bernard', 'Chloé', 'chloe.bernard@art2rue.org');

INSERT INTO lieux (id, nom, adresse, quartier, latitude, longitude) VALUES
(6, 'Le Hangar à Bananes', '21 Quai des Antilles', 'Île de Nantes', 47.2008700, -1.5731200),
(7, 'Passage Pommeraye', 'Rue de la Fosse', 'Centre-Ville', 47.2135000, -1.5582000),
(8, 'Le Lieu Unique', 'Quai Ferdinand-Favre', 'Malakoff - Pré Gauchet', 47.2155000, -1.5458000);

INSERT INTO techniques (id, nom) VALUES
(5, 'Pochoir'),
(6, 'Bombe aérosol'),
(7, 'Mosaïque'),
(8, 'Collage');