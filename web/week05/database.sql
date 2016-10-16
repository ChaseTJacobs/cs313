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
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Sofa', 'Polyester, Black', 24, 450);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Sofa', 'Polyester, Brown', 13, 440);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('TV Stand', 'Wood, Black', 6, 30);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Computer Monitor', '21 Inch, ViewSonic', 14, 150);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Printer Cables', 'USB', 363, 1);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Document Stand', 'Grey, 12in', 74, .75);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Printer', 'HP DeskJet 6122', 7, 20);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Printer', 'HP LaserJet P4015', 18, 20);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Office Chair', 'Black, Leather', 17, 150);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Office Chair', 'Red, Polyester', 28, 89);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('Tupperware', 'Fair condition', 182, 1);
    
    INSERT INTO item (name, description, quantity, price)
    VALUES ('VGA Cables', '3 feet', 7, 2);