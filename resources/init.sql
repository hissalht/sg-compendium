drop table Users;
drop table Combos;

CREATE TABLE Users (
    id      BIGSERIAL PRIMARY KEY,
    name    VARCHAR(100),
    login   VARCHAR(50),
    hash    VARCHAR(60),
    mail    VARCHAR(100),
    status  INTEGER
);

CREATE TABLE Combos (
    id      BIGSERIAL PRIMARY KEY,
    name    VARCHAR(100) NOT NULL,
    description VARCHAR(2000) NOT NULL,
    author  INTEGER NOT NULL,
    charac  INTEGER NOT NULL,
    moves   TEXT NOT NULL,
    difficulty INTEGER NOT NULL,
    damages INTEGER NOT NULL
);


INSERT INTO Users (name, login, hash, mail, status) VALUES (
    'John Jhon',
    'jjojjo',
    /*pass is abc*/
    '$2y$10$TiHwRNLK/hQTWZk.sIYn8.rUaqJpzWm3Dza/lutR3o8g5JK.UqRyG',
    'jjojjo@mail.com',
    2
);


INSERT INTO Combos (name, description, author, charac, moves, difficulty, damages)
VALUES(
    'BB Intermediate BNB',
    'Intermediate mid-screen bread''n''butter combo for Big Band.<br> * The j.HP is supposed to whiff. This causes Big Band to fastfall which lets you link a light normal after. If this is too hard, any combo that includes this can be done with j.MK instead of j.MKx2 for a little less damage.',
    1,
    1,
        '"c.LK, c.MK, s.HP","j.MP, j.HP, delay j.HK","tech forward","OTG c.HK, xx DP.HP Beat Extend","j.LK, j.MK","s.MK","j.LP, j.LK, j.MKx2, j.HP*","c.LPx2, c.MK, s.HK, xx H Take the A-Train, xx Super Sonic Jazz"',
    3,
    2500
);

INSERT INTO Combos (name, description, author, charac, moves, difficulty, damages)
VALUES(
    'Combo par un auteur différent',
    'Intermediate mid-screen bread''n''butter combo for Big Band.<br> * The j.HP is supposed to whiff. This causes Big Band to fastfall which lets you link a light normal after. If this is too hard, any combo that includes this can be done with j.MK instead of j.MKx2 for a little less damage.',
    4,
    8,
        '"c.LK, c.MK, s.HP","j.MP, j.HP, delay j.HK","tech forward","OTG c.HK, xx DP.HP Beat Extend","j.LK, j.MK","s.MK","j.LP, j.LK, j.MKx2, j.HP*","c.LPx2, c.MK, s.HK, xx H Take the A-Train, xx Super Sonic Jazz"',
    3,
    2500
);
