
CREATE TABLE Users (
    id      INTEGER,
    name    VARCHAR(100),
    login   VARCHAR(50),
    hash    VARCHAR(60),
    mail    VARCHAR(100),
    status  INTEGER
);

CREATE TABLE Combos (
    id      INTEGER,
    name    VARCHAR(100),
    description VARCHAR(2000),
    author  INTEGER,
    charac  INTEGER,
    moves   TEXT[],
    difficulty INTEGER,
    damages INTEGER
);


INSERT INTO Users VALUES (
    1,
    'John Jhon',
    'jjojjo',
    /*pass is abc*/
    '$2y$10$TiHwRNLK/hQTWZk.sIYn8.rUaqJpzWm3Dza/lutR3o8g5JK.UqRyG',
    'jjojjo@mail.com',
    2
);


INSERT INTO Combos VALUES (
    1,
    'BB Intermediate BNB',
    'Intermediate mid-screen bread''n''butter combo for Big Band.<br> * The j.HP is supposed to whiff. This causes Big Band to fastfall which lets you link a light normal after. If this is too hard, any combo that includes this can be done with j.MK instead of j.MKx2 for a little less damage.',
    1,
    1,
    '{
        "c.LK", "c.MK", "s.HP", "NS",
        "j.MP", "j.HP", "delay j.HK", "NS",
        "tech forward", "NS",
        "OTG c.HK", "xx DP.HP Beat Extend", "NS",
        "j.LK", "j.MK", "NS",
        "s.MK", "NS",
        "j.LP", "j.LK", "j.MKx2", "j.HP*", "NS",
        "c.LPx2", "c.MK", "s.HK", "xx H Take the A-Train", "xx Super Sonic Jazz"
    }',
    3,
    2500
);
