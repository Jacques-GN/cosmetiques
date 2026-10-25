-- ============================================================
-- BÉLORA — Base de données du site vitrine (MySQL / XAMPP)
-- Import : phpMyAdmin > Importer > ce fichier > Exécuter
--
-- ⚠ Ce fichier détruit et recrée intégralement la base `belora`
-- à chaque import. Cela garantit que le schéma est toujours à
-- jour par rapport au code PHP, même si une ancienne version de
-- la base existait déjà.
-- ============================================================

-- Détruit l'ancienne base si elle existe (anciennes tables,
-- anciennes colonnes, anciennes données) puis la recrée vide.
DROP DATABASE IF EXISTS belora;
CREATE DATABASE belora
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE belora;

-- ------------------------------------------------------------
-- Table : produits
-- Contient les 9 soins affichés dans le catalogue.
-- badge       : "Best-seller" / "Nouveau" / NULL (pastille sur les cartes)
-- note / avis : note moyenne sur 5 et nombre d'avis (affichage LUNA-like)
-- prix        : en dirham marocain (DH) — 1 € ≈ 10 DH (taux arrondi)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS produits (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(120)    NOT NULL,
    sous_titre    VARCHAR(120)    DEFAULT NULL,          -- nom anglais (étiquette)
    categorie     ENUM('visage','corps') NOT NULL DEFAULT 'visage',
    badge         VARCHAR(30)     DEFAULT NULL,
    contenance    VARCHAR(20)     DEFAULT NULL,          -- ex. "50 ml"
    accroche      VARCHAR(150)    DEFAULT NULL,          -- phrase courte dorée
    description   VARCHAR(500)    NOT NULL,
    ingredients   TEXT            DEFAULT NULL,
    conseils      TEXT            DEFAULT NULL,
    prix          DECIMAL(10,2)   NOT NULL DEFAULT 0,
    image         VARCHAR(120)    NOT NULL,
    note          DECIMAL(2,1)    NOT NULL DEFAULT 5.0,
    avis          INT UNSIGNED    NOT NULL DEFAULT 0,
    actif         TINYINT(1)      NOT NULL DEFAULT 1,
    date_creation TIMESTAMP       DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- ------------------------------------------------------------
-- Table : messages (formulaire de contact)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom        VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    sujet      VARCHAR(150) NOT NULL,
    message    TEXT         NOT NULL,
    date_envoi TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- ------------------------------------------------------------
-- Table : abonnes (newsletter du pied de page)
-- email est UNIQUE : INSERT IGNORE ignore silencieusement les doublons
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS abonnes (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email            VARCHAR(150) NOT NULL UNIQUE,
    date_inscription TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- ============================================================
-- Données de démonstration : les 9 soins BÉLORA
-- ============================================================
INSERT INTO produits
    (nom, sous_titre, categorie, badge, contenance, accroche,
     description, ingredients, conseils, prix, image, note, avis)
VALUES
('Crème apaisante', 'Calming Cream', 'visage', 'Best-seller', '50 ml',
 'Avoine + céramide',
 'Une crème riche et fondante qui apaise les peaux sensibles dès la première application. Sa formule à l''avoine et aux céramides restaure la barrière cutanée et laisse la peau confortable toute la journée.',
 'Avoine colloïdale, céramides NP, beurre de karité, glycérine végétale, eau de camomille.',
 'Appliquer matin et soir sur une peau propre, en effleurages doux sur le visage et le cou. Éviter le contour de l''œil.',
 349.00, 'produit-creme.jpg', 4.8, 128),

('Nettoyant botanique', 'Nourish Botanical Cleanser', 'visage', NULL, '150 ml',
 'Nettoie sans dessécher',
 'Un nettoyant doux qui élimine impuretés et excès de sébum tout en respectant le film hydrolipidique. Sa formule végétale laisse la peau nette, souple et prête à recevoir les soins suivants.',
 'Tensioactifs doux d''origine végétale, aloé vera, glycérine, extrait de camomille.',
 'Masser une noisette sur visage humide, puis rincer à l''eau tiède. Utiliser matin et soir.',
 249.00, 'produit-nettoyant.jpg', 4.7, 96),

('Huile purifiante', 'Clarifying Facial Oil', 'visage', 'Nouveau', '30 ml',
 'Équilibre et purifie',
 'Une huile fine qui aide à réguler les peaux mixtes à grasses sans les assécher. Elle dissout les excès de sébum et laisse un fini mat, non gras, pour un grain de peau affiné.',
 'Huile de jojoba, huile de nigelle, vitamine E, huiles essentielles de tea-tree et lavande.',
 'Le soir, masser 3 à 4 gouttes sur peau propre. Peut aussi s''utiliser en cure d''une semaine sur peaux asphyxiées.',
 299.00, 'produit-huile-purifiante.jpg', 4.6, 41),

('Lotion tonique', 'Calming Botanical Toner', 'visage', NULL, '200 ml',
 'Ravive l''éclat',
 'Une lotion sans alcool qui élimine les dernières impuretés et rééquilibre le pH de la peau. Elle resserre visiblement les pores et prépare l''épiderme à recevoir le sérum ou la crème.',
 'Eau florale de rose, hamamélis, panthénol, glycérine végétale.',
 'Appliquer matin et soir au coton ou en brume sur visage nettoyé. Ne pas rincer.',
 199.00, 'produit-tonique.jpg', 4.5, 64),

('Gommage doux', 'Exfoliating Face Scrub', 'visage', NULL, '75 ml',
 'Un grain de peau affiné',
 'Un gommage délicat qui élimine les cellules mortes sans agresser la peau. Ses micro-grains naturels polissent en douceur et révèlent un teint plus net, sans rougeurs.',
 'Poudre de noyau d''abricot finement moulue, poudre de bambou, huile de tournesol, glycérine.',
 'Sur peau humide, masser en mouvements circulaires légers puis rincer abondamment. Utiliser 1 à 2 fois par semaine.',
 229.00, 'produit-gommage.jpg', 4.6, 53),

('Huile hydratante', 'Aura Botanical Hydrating Oil', 'visage', 'Best-seller', '30 ml',
 'Nutrition intense',
 'Une huile soyeuse qui nourrit les peaux sèches et déshydratées en profondeur. Elle renforce la barrière cutanée et redonne à la peau sa souplesse et son élasticité.',
 'Huile d''argan, huile d''amande douce, squalane végétal, vitamine E.',
 'Chauffer 3 gouttes entre les paumes puis presser sur le visage et le cou. Le soir, seule ou mélangée à la crème.',
 329.00, 'produit-huile-hydratante.jpg', 4.9, 142),

('Sérum réparateur', 'Aura Botanical Oil Serum', 'visage', 'Nouveau', '30 ml',
 'Le geste rituel anti-fatigue',
 'Un sérum concentré qui cible les signes de fatigue et les imperfections. Sa formule huileuse pénètre rapidement et répare la peau nuit après nuit, pour un teint reposé au réveil.',
 'Huile de figue de barbarie, bakuchiol (rétinol végétal), vitamine C, huile de rose musquée.',
 'Appliquer 4 gouttes le soir sur visage et cou, en pressant doucement. Commencer par 3 soirs par semaine.',
 399.00, 'produit-serum.jpg', 4.8, 87),

('Lait corporel', 'Nourish Botanical Milk', 'corps', NULL, '250 ml',
 'Douceur pour toute la famille',
 'Un lait corporel léger qui hydrate la peau du corps dès la sortie de la douche. Sa texture laiteuse pénètre vite et laisse un voile satiné non collant.',
 'Lait d''avoine, huile de coco, glycérine végétale, allantoïne.',
 'Appliquer quotidiennement sur le corps, en massant jusqu''à absorption complète.',
 269.00, 'produit-lait.jpg', 4.7, 72),

('Baume apaisant', 'Calming Botanical Balm', 'corps', 'Best-seller', '30 ml',
 'Karité + camomille',
 'Un baume onctueux pour les zones sèches : lèvres, coudes, genoux, mains. Riche en beurre de karité et en camomille, il répare et protège les peaux tiraillées.',
 'Beurre de karité, cire d''abeille, huile de camomille, huile de coco, vitamine E.',
 'Prélever une petite quantité et masser sur les zones sèches, aussi souvent que nécessaire.',
 219.00, 'produit-baume.jpg', 4.9, 118);
