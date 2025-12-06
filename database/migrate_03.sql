ALTER TABLE cars ADD COLUMN seats INT NOT NULL DEFAULT 4;
ALTER TABLE cars ADD COLUMN transmission ENUM('manual', 'automatic', 'both') NOT NULL DEFAULT 'manual';

-- Optional: Update some defaults based on names to make it look real
UPDATE cars SET transmission = 'automatic', seats = 5 WHERE name LIKE '%Tesla%';
UPDATE cars SET transmission = 'automatic', seats = 2 WHERE name LIKE '%Audi R8%';
UPDATE cars SET transmission = 'manual', seats = 4 WHERE name LIKE '%Mustang%';
