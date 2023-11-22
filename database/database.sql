/* DATABASE NAME = fabric_stock */
/* Create a table for fabric */
create table fabric(
	id int primary key AUTO_INCREMENT,
    type varchar(50) not null,
    color varchar(50) not null,
    price float not null,
    current_stock_address varchar(255) not null,
    image_name varchar(255) not null,
    date_inserted datetime default CURRENT_TIMESTAMP not null,
    date_updated datetime  on Update CURRENT_TIMESTAMP
);	

INSERT INTO fabric (type, color, price, current_stock_address, image_name)
VALUES
    ("Cotton", "White", 250.00, "San Isidro Tomas Oppus", "cotton.jpg"),
    ("Leather", "Brown", 250.00, "Looc Tomas Oppus", "leather.jpg"),
    ("Silk", "Pink", 250.00, "Canlupao Tomas Oppus", "silk.jpg"),
    ("Wool", "Mint Gray", 250.00, "Hinapo Tomas Oppus", "wool.jpg");



create table users(
    id int primary key auto_increment,
    type_of_user varchar(100) not null,
    firstname varchar(50) not null,
    lastname varchar(100) not null,
    email varchar(100) not null,
    contact varchar(100) not null,
    pwd varchar(100) not null,
    image_name varchar(255) not null,
    date_inserted datetime default CURRENT_TIMESTAMP not null,
    date_updated datetime  on Update CURRENT_TIMESTAMP
);

INSERT INTO users (type_of_user, firstname, lastname, email, contact, pwd, image_name)
VALUES
    ("1", "Dorian", "Patera", "dorian2@gmail.com", "091231232233" "123", "Dorian Patera.jpg"),
    ("1", "Graham", "Kremski", "graham@gmail.com", "091231232233" "123", "Graham Kremski.jpg"),
    ("1", "Pete", "Serkes", "pete@gmail.com", "091231232233" "123", "Pete Serkes.jpg"),
    ("1", "Scot", "Juda", "scot@gmail.com", "091231232233" "123", "Scot Juda.jpg"),
    ("1", "Seth", "Lalim", "seth@gmail.com", "091231232233" "123", "Seth Lalim.jpg"),
    ("1", "Tomas", "Athar", "tomas@gmail.com", "091231232233" "123", "Tomas Athar.jpg"),
   



create table user_log(
    id int PRIMARY KEY auto_increment,
    user_id int not null,
    activities varchar(200) not null,
    date_inserted datetime default CURRENT_TIMESTAMP not null,
    date_updated datetime  on Update CURRENT_TIMESTAMP,
    Foreign Key (user_id) REFERENCES users(id)
    
);

insert into user_log(user_id, activities)
VALUES (1 , "Delete a column in users table"),
       (1 , "Updated a column in users table"),
       (2 , "Updated a column in users table"),
       (3 , "Updated a column in users table"),
       (1 , "Updated a column in users table"),