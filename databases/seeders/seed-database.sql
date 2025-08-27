USE jfm_php_demo_2025_s2;

TRUNCATE categories;

INSERT INTO categories(id, title, description)
    VALUE (1, 'Unknown', 'Unknown category');

INSERT INTO categories(id, title, description)
    VALUES (2, 'Pun', 'When punished, groan!'),
        (100, 'Pirate', 'Arrrrgggh, we pirates arrrrre very funny');

INSERT INTO categories(title, description)
VALUES ('Dad', 'The worst, always the worst'),
       ('Mum', 'Mum\'s the best'),
       ('Maths', 'Some very calculated punch lines'),
       ('Lightbulb', 'There is a switch somewhere...');