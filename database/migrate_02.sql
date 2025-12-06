ALTER TABLE bookings ADD COLUMN start_date DATETIME NULL;
ALTER TABLE bookings ADD COLUMN end_date DATETIME NULL;

-- Backfill existing data to avoid nulls (optional logic, setting to NOW)
UPDATE bookings SET start_date = created_at WHERE start_date IS NULL;
UPDATE bookings SET end_date = DATE_ADD(created_at, INTERVAL value DAY) WHERE mode = 'day' AND end_date IS NULL;
UPDATE bookings SET end_date = DATE_ADD(created_at, INTERVAL value HOUR) WHERE mode = 'hour' AND end_date IS NULL;
UPDATE bookings SET end_date = DATE_ADD(created_at, INTERVAL 1 HOUR) WHERE mode = 'km' AND end_date IS NULL; -- KM doesn't really have time, assuming 1 hr
