INSERT INTO oeuvres (id, titre, date_creation, description, est_detruite, lieu_id, oeuvre_recouverte_id) VALUES
(3, 'La Fille au Ballon', '2022-04-12 14:30:00', 'Fresque murale au pochoir représentant une jeune fille laissant s''envoler un ballon rouge.', 1, 6, NULL),
(4, 'Space Pixel #44', '2023-09-18 10:15:00', 'Mosaïque en carreaux de céramique représentant un envahisseur rétro en pixel art 8-bit.', 0, 7, NULL),
(5, 'Renaissance Urbaine', '2024-05-02 18:00:00', 'Grande composition colorée à la bombe peinte par-dessus l''ancienne fresque dégradée.', 0, 6, 3),
(6, 'Échos de la Ville', '2024-01-10 11:00:00', 'Collage grand format complété de pochoirs et de maximes poétiques urbaines.', 0, 8, NULL);

INSERT INTO oeuvres_artistes (oeuvres_id, artistes_id) VALUES
(3, 4), (4, 5), (5, 4), (6, 4), (6, 6);

INSERT INTO oeuvres_techniques (oeuvres_id, techniques_id) VALUES
(3, 5), (3, 6), (4, 7), (5, 6), (6, 5), (6, 8);

INSERT INTO photos (id, date_prise_vue, nom_fichier, etat_oeuvre, oeuvre_id, benevole_id) VALUES
(1, '2022-04-15 16:45:00', 'hangar_ballon_inauguration.jpg', 'Parfait état, couleurs vives.', 3, 4),
(2, '2023-02-10 11:20:00', 'hangar_ballon_degrade.jpg', 'Peinture écaillée, début de dégradation.', 3, 5),
(3, '2023-09-20 14:10:00', 'pommeraye_pixel_neuf.jpg', 'Mosaïque complète sans carreau manquant.', 4, 4),
(4, '2024-05-05 09:30:00', 'hangar_renaissance_vue1.jpg', 'Fresque neuve recouvrant l''ancien mur dégradé.', 5, 6);