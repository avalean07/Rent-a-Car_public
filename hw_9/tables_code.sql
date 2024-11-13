CREATE TABLE Employee 
(
    employee_id INT PRIMARY KEY, #we'll put this at the front, we don't know why in the lecture slides is at the end of the table
    name VARCHAR(100), #100 CHARACTERS FOR the name is more than enough
    salary DECIMAL(19, 4) #apparently we cannot use MONEY type because we are using MySQL
);
--do we need to have less than 80 characters/line of code?

CREATE TABLE Salesman
(
    employee_id INT PRIMARY KEY,
    FOREIGN KEY (employee_id) REFERENCES Employee(employee_id)
);
--the salesman table is a subclass of Employee table, so it has a foreign key that refers to that table

-- it doesn't say anywhere that we have to insert values
--only that we have to submit the code with CREATE TABLE

CREATE TABLE Boss
(
    employee_id INT PRIMARY KEY,
    FOREIGN KEY (employee_id) REFERENCES Employee(employee_id)
);
--SAME As before, very simple
--we will add more attributes to everything and do little changes to accommodate everything throughout the semester

CREATE TABLE Mechanic
(
    employee_id INT PRIMARY KEY,
    FOREIGN KEY (employee_id) REFERENCES Employee(employee_id)
);

CREATE TABLE Customer
(
    customer_id INT PRIMARY KEY,
    name VARCHAR(100),
    credit_score INT,
    years_of_experience INT
);

CREATE TABLE Automobile
(
    car_vin VARCHAR(17) PRIMARY KEY
);
--the VIN in real life has 17 characters, so we made it of size 17

CREATE TABLE EV
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES Automobile(car_vin)
);

CREATE TABLE Hybrid
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES Automobile(car_vin)
);

CREATE TABLE Combustion
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES Automobile(car_vin)
);

-- we will go with one table for every type of car method
-- we don't knwo if it's the best, but it works for now

CREATE TABLE FullEV
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES EV(car_vin)
);

CREATE TABLE MildEV
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES EV(car_vin)
);

CREATE TABLE PluginHybrid
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES Hybrid(car_vin)
);
--these 3 types of ev inherit from Hybrid

CREATE TABLE DieselCombustion
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES Combustion(car_vin)
);

CREATE TABLE PetrolCombustion
(
    car_vin VARCHAR(17) PRIMARY KEY,
    FOREIGN KEY (car_vin) REFERENCES Combustion(car_vin)
);

--these ones from the Combustion table

--and now I think we have to do the relationships
CREATE TABLE MechanicFixesAutomobile
(
    mechanic_id INT,
    car_vin VARCHAR(17),
    PRIMARY KEY (mechanic_id, car_vin),
    FOREIGN KEY (mechanic_id) REFERENCES Mechanic(employee_id),
    FOREIGN KEY (car_vin) REFERENCES Automobile(car_vin)
);

CREATE TABLE CustomerRentsAutomobile
(
    customer_id INT,
    car_vin VARCHAR(17),
    rent_date DATE,
    PRIMARY KEY (customer_id, car_vin),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (car_vin) REFERENCES Automobile(car_vin)
);

CREATE TABLE EmployeeManagesCustomer
(
    employee_id INT,
    customer_id INT,
    PRIMARY KEY (employee_id, customer_id),
    FOREIGN KEY (employee_id) REFERENCES Employee(employee_id),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);

INSERT INTO Employee (employee_id, name, salary) VALUES
(1, 'Robert Downey Jr.', 50000.00),
(2, 'Alexander TheFirst', 60000.00),
(3, 'Lebron James', 70000.00);
--we inserted these employees into the employee table

INSERT INTO Salesman (employee_id) VALUES (1);
INSERT INTO Mechanic (employee_id) VALUES (2);
INSERT INTO Boss (employee_id) VALUES (3);
--inserting each employee into a category
--we know we don't have a lot of data, but for now it works

INSERT INTO Customer (customer_id, name, credit_score, years_of_experience) VALUES
(1, 'Speed Lover Jr.', 520, 2),
(2, 'Professional Driver', 850, 11);
--inserting this into the Customer table, I think 2 should be enough for now
--as we said before, we will add more on the go
--right now we are having a very difficult time pushing the code into the git repository

INSERT INTO Automobile (car_vin) VALUES
('VIN12345EV'),
('VIN67890HY'), 
('VIN11223CB');
--some randomly generated VINs

INSERT INTO EV (car_vin) VALUES ('VIN12345EV');
INSERT INTO Hybrid (car_vin) VALUES ('VIN67890HY');
INSERT INTO Combustion (car_vin) VALUES ('VIN11223CB');
--one car into each category

INSERT INTO MechanicFixesAutomobile (mechanic_id, car_vin) VALUES
(2, 'VIN12345EV'),
(2, 'VIN11223CB');
--we have employee id 2 for the mechanic, so we put 2, and the VIN of the car he fixes
--he is a master mechanic, fixes all kinds of cars

INSERT INTO CustomerRentsAutomobile (customer_id, car_vin, rent_date) VALUES
(1, 'VIN12345EV', '2024-09-25'),
(2, 'VIN67890HY', '2024-09-21');
--so apparently the format is YYYY-MM-DD

INSERT INTO EmployeeManagesCustomer (employee_id, customer_id) VALUES
(1, 1),
(3, 2);

--and now we gotta do the 9 queries

SELECT Customer.name AS customer_name, Automobile.car_vin
FROM Customer
JOIN CustomerRentsAutomobile ON Customer.customer_id = CustomerRentsAutomobile.customer_id
JOIN Automobile ON CustomerRentsAutomobile.car_vin = Automobile.car_vin;
--we use this query to list all the customers and the cars they have rented
--we used join to combine the records from these multiple tables

SELECT Employee.name AS employee_name, Customer.name AS customer_name
FROM Employee
JOIN EmployeeManagesCustomer ON Employee.employee_id = EmployeeManagesCustomer.employee_id
JOIN Customer ON EmployeeManagesCustomer.customer_id = Customer.customer_id;
--another one of the same type but now with Customer and EmployeeManagesCustomer tables

SELECT Employee.name AS employee_name, Automobile.car_vin
FROM Employee
JOIN Mechanic ON Employee.employee_id = Mechanic.employee_id
JOIN MechanicFixesAutomobile ON Mechanic.employee_id = MechanicFixesAutomobile.mechanic_id
JOIN Automobile ON MechanicFixesAutomobile.car_vin = Automobile.car_vin;
--now here, as before, I used another join to associate the employee_id from Employee and MEchanic table with one another
--and then we used the same technique for MechanicFixesAutomobile action table with the mechanic employee_id
--and the same thing again for for automobiles from the two tables on the last line of code above

SELECT Customer.name, COUNT(CustomerRentsAutomobile.car_vin) AS total_cars_rented
FROM Customer
JOIN CustomerRentsAutomobile ON Customer.customer_id = CustomerRentsAutomobile.customer_id
GROUP BY Customer.name;

SELECT AVG(salary) AS avg_salary
FROM Employee;
--for the aggregation, selecting multiple salaries and returning the average

SELECT Employee.name, COUNT(EmployeeManagesCustomer.customer_id) AS total_customers
FROM Employee
JOIN EmployeeManagesCustomer ON Employee.employee_id = EmployeeManagesCustomer.employee_id
GROUP BY Employee.name
HAVING COUNT(EmployeeManagesCustomer.customer_id) > 1;
--and here we used HAVING to filter the results on the COUNT aggregation

SELECT Automobile.car_vin
FROM Automobile
JOIN FullEV ON Automobile.car_vin = FullEV.car_vin;
--nothing to add here, just joining the car vins from multiple tables

SELECT Automobile.car_vin
FROM MechanicFixesAutomobile
JOIN Automobile ON MechanicFixesAutomobile.car_vin = Automobile.car_vin
WHERE MechanicFixesAutomobile.mechanic_id = 2;
--=2 because that's the id I have it above

--and now, ahhhh, this is a hard one to be done only by one team member
--but here is a pretty specific sort, I hope the person grading this appreciates it

SELECT Customer.name AS customer_name, Automobile.car_vin,
    CASE 
        WHEN FullEV.car_vin IS NOT NULL THEN 'Full EV'
        WHEN PluginHybrid.car_vin IS NOT NULL THEN 'Plugin Hybrid'
        WHEN PetrolCombustion.car_vin IS NOT NULL THEN 'Petrol Car'
        WHEN DieselCombustion.car_vin IS NOT NULL THEN 'Diesel Car'
        WHEN MildEV.car_vin IS NOT NULL THEN 'Mild EV'
        WHEN Hybrid.car_vin IS NOT NULL THEN 'Hybrid'
        WHEN Combustion.car_vin IS NOT NULL THEN 'Combustion'
    END AS car_type
FROM Customer
JOIN CustomerRentsAutomobile ON Customer.customer_id = CustomerRentsAutomobile.customer_id
JOIN Automobile ON CustomerRentsAutomobile.car_vin = Automobile.car_vin
LEFT JOIN FullEV ON Automobile.car_vin = FullEV.car_vin
LEFT JOIN PluginHybrid ON Automobile.car_vin = PluginHybrid.car_vin
LEFT JOIN PetrolCombustion ON Automobile.car_vin = PetrolCombustion.car_vin
LEFT JOIN DieselCombustion ON Automobile.car_vin = DieselCombustion.car_vin
LEFT JOIN MildEV ON Automobile.car_vin = MildEV.car_vin
LEFT JOIN Hybrid ON Automobile.car_vin = Hybrid.car_vin
LEFT JOIN Combustion ON Automobile.car_vin = Combustion.car_vin
WHERE CustomerRentsAutomobile.rent_date > '2024-09-23';
--DAMN, THIS HOMEWORK
--I learned a lot through it

--I still don't know how to push it into the GIT

CREATE TABLE users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUE ('vgheorghe', SHA2('baietiigrei', 256));
