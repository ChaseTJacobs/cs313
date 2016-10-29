DROP TABLE item;
DROP TABLE category;

CREATE TABLE item (
    id SERIAL PRIMARY KEY NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL,
    category_id INT NOT NULL
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Bookshelf', '3 shelves, white', 2, 16, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Bedframe', 'Queen, black, wooden', 15, 45, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Desk lamp', '250W bulb, color vaires', 30, 2);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Ceiling fan', '5 blades, black', 3, 35, 2);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Dining Chairs', 'Wooden, black', 64, 8, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Sofa', 'Leather, Brown', 30, 200, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Sofa', 'Polyester, Black', 24, 450, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Sofa', 'Polyester, Brown', 13, 440, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('TV Stand', 'Wood, Black', 6, 30, 2);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Computer Monitor', '21 Inch, ViewSonic', 14, 150, 4);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Printer Cables', 'USB', 363, 1, 4);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Document Stand', 'Grey, 12in', 74, .75, 4);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Printer', 'HP DeskJet 6122', 7, 20, 4);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Printer', 'HP LaserJet P4015', 18, 20, 4);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Office Chair', 'Black, Leather', 17, 150, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Office Chair', 'Red, Polyester', 28, 89, 1);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Tupperware', 'Fair condition', 182, 1, 3);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('VGA Cables', '3 feet', 7, 2, 4);
    
    INSERT INTO item (name, description, quantity, price, category_id)
    VALUES ('Desk', 'Wood, L-shaped', 3, 250, 1);
    
    
    
    INSERT INTO category (name)
    VALUES ('Furniture');
    INSERT INTO category (name)
    VALUES ('Home Accessories');
    INSERT INTO category (name)
    VALUES ('Kitchen');      
    INSERT INTO category (name)
    VALUES ('Computer Accessories'); 
    INSERT INTO category (name)
    VALUES ('Clothing Male'); 
    INSERT INTO category (name)
    VALUES ('Clothing Female');
    INSERT INTO category (name)
    VALUES ('Food');