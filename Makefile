DB_NAME=test_db
DB_USER=z1405381

setup:
	mysql -u $(DB_USER) -p $(DB_NAME) < database/schema.sql
	mysql -u $(DB_USER) -p $(DB_NAME) < database/seed.sql

reset:
	mysql -u $(DB_USER) -p $(DB_NAME) < database/schema.sql

seed:
	mysql -u $(DB_USER) -p $(DB_NAME) < database/seed.sql
