CREATE TABLE mst_weather(
	weather_id INT AUTO_INCREMENT PRIMARY KEY,
	weather_name TEXT
);
INSERT INTO mst_weather(weather_name) VALUES
('晴れ'),
('曇り'),
('雨'),
('雪'),
('晴れのち曇り'),
('晴れのち雨'),
('晴れのち雪'),
('晴れ時々曇り'),
('晴れ時々雨'),
('晴れ時々雪'),
('曇りのち晴れ'),
('曇りのち雨'),
('曇りのち雪'),
('曇り時々晴れ'),
('曇り時々雨'),
('曇り時々雪'),
('雨のち晴れ'),
('雨のち曇り'),
('雨のち雪'),
('雨時々晴れ'),
('雨時々曇り'),
('雨時々雪'),
('雪のち晴れ'),
('雪のち曇り'),
('雪のち雨'),
('雪時々晴れ'),
('雪時々曇り'),
('雪時々雨');

CREATE TABLE mst_unit(
	unit_id INT AUTO_INCREMENT PRIMARY KEY,
	unit_name TEXT
);

INSERT INTO mst_unit(unit_name) VALUES
('個'),
('g'),
('kg'),
('本'),
('株'),
('束');

CREATE TABLE tran_user(
	user_id INT  AUTO_INCREMENT PRIMARY KEY,
	user_name TEXT,
	user_pass TEXT,
	cookie_hash TEXT
);

CREATE TABLE tran_item(
	item_id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	unit_id INT,
	item_name TEXT,
	FOREIGN KEY(user_id)
	REFERENCES tran_user(user_id),
	FOREIGN KEY(unit_id)
	REFERENCES mst_unit(unit_id)
);

CREATE TABLE tran_chemical(
	chemical_id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	chemical_name TEXT,
	FOREIGN KEY(user_id)
	REFERENCES tran_user(user_id)
);

CREATE TABLE tran_fertilizer(
	fertilizer_id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	fertilizer_name TEXT,
	FOREIGN KEY(user_id)
	REFERENCES tran_user(user_id)
);

CREATE TABLE tbl_diary(
	diary_id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	item_id INT,
	weather_id INT,
	date DATE,
	low_temperature INT,
	high_temperature INT,
	working_hour INT,
	water_minutes INT,
	yield INT,
	annotation TEXT,
	FOREIGN KEY(user_id)
	REFERENCES tran_user(user_id),
	FOREIGN KEY(item_id)
	REFERENCES tran_item(item_id),
	FOREIGN KEY(weather_id)
	REFERENCES mst_weather(weather_id)
);


CREATE TABLE diaries_chemicals(
	diary_id INT,
	chemical_id INT,
	FOREIGN KEY(diary_id)
	REFERENCES tbl_diary(diary_id),
	FOREIGN KEY(chemical_id)
	REFERENCES tran_chemical(chemical_id)
);

CREATE TABLE diaries_fertilizers(
	diary_id INT,
	fertilizer_id INT,
	FOREIGN KEY(diary_id)
	REFERENCES tbl_diary(diary_id),
	FOREIGN KEY(fertilizer_id)
	REFERENCES tran_fertilizer(fertilizer_id)
);