/*DROP SCHEMA IF EXISTS homehub

CREATE SCHEMA IF NOT EXISTS homehub*/
USE homehub;

DROP TABLE IF EXISTS devices_users,
    devices,
    device_types,
    device_models,
    user_passwords,
    users;
    -- model_functions, 
    -- device_values, 

CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    name VARCHAR(100),
    address VARCHAR(100),
    email VARCHAR(100),
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PRIMARY KEY (user_id),
    CONSTRAINT UC_Users_Username UNIQUE (username)
    );

CREATE TABLE user_passwords (
    user_id INT NOT NULL,
    password VARCHAR(50) COLLATE latin1_bin NOT NULL,
    password_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_UserPasswords_Users_UserId FOREIGN KEY (user_id) REFERENCES users(user_id)
    );

CREATE TABLE device_models (
    device_model_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    CONSTRAINT PRIMARY KEY (device_model_id)
    );

CREATE TABLE device_types (
    device_type_id INT NOT NULL AUTO_INCREMENT,
    device_model_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    CONSTRAINT PRIMARY KEY (device_type_id),
    CONSTRAINT FK_DeviceTypes_DeviceModels_DeviceModelId FOREIGN KEY (device_model_id) REFERENCES device_models(device_model_id)
    );

CREATE TABLE devices (
    device_id INT NOT NULL AUTO_INCREMENT,
    device_type_id INT NOT NULL,
    CONSTRAINT PRIMARY KEY (device_id),
    CONSTRAINT FK_Devices_DeviceTypes_DeviceTypeId FOREIGN KEY (device_type_id) REFERENCES device_types(device_type_id)
    );

CREATE TABLE devices_users (
    user_id INT NOT NULL,
    device_id INT NOT NULL,
    ip_address VARCHAR(20) NOT NULL,
    CONSTRAINT FK_DevicesUsers_Users_UserId FOREIGN KEY (user_id) REFERENCES users(user_id),
    CONSTRAINT FK_DevicesUsers_Devices_DeviceId FOREIGN KEY (device_id) REFERENCES devices(device_id)
    );
/*
CREATE TABLE device_values(
    device_id INT NOT NULL,
    value FLOAT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_device_values_devices_device_id FOREIGN KEY (device_id) REFERENCES devices(device_id)
    );
    
CREATE TABLE model_functions(
    model_id INT NOT NULL,
    get_temp BINARY,
    CONSTRAINT FK_model_functions_models_model_id FOREIGN KEY (model_id) REFERENCES device_models(model_id)
    );
*/

INSERT INTO users(username, name) values ('stansyang', 'Stanley Yang');
INSERT INTO users(username, name) values ('rickcsong', 'Rick Song');

INSERT INTO user_passwords(user_id, password) values (1,'081024ad1c0b28a0fba6cc12f3e3cd0101474033');
INSERT INTO user_passwords(user_id, password) values (2,'081024ad1c0b28a0fba6cc12f3e3cd0101474033');
