DROP TABLE item;
DROP TABLE category;

CREATE TABLE item (
    id SERIAL PRIMARY KEY NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL
);

CREATE TABLE category (
    id INT PRIMARY KEY NOT NULL,
    name TEXT NOT NULL,
    item_id INT REFERENCES item(id) NOT NULL
);

INSERT INTO item (name, description, quantity, price)
    VALUES ('Bookshelf', '3 shelves, white', 2, 16);
    
    
INSERT INTO item (name, description, quantity, price)
    VALUES ('Bedframe', 'Queen, black, wooden', 15, 45);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Desk lamp', '250W bulb, color vaires', 30, 3);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Ceiling fan', '5 blades, black', 3, 35);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Dining Chairs', 'Wooden, black', 64, 8);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Sofa', 'Leather, Brown', 30, 200);