# ============================================
# DATABASE CONFIG (change to your own environment)
# ============================================

DB_NAME ?= gp_store
DB_USER ?= root
DB_PASS ?=

setup:
	mysql -u $(DB_USER) -p$(DB_PASS) $(DB_NAME) < database/schema.sql
	mysql -u $(DB_USER) -p$(DB_PASS) $(DB_NAME) < database/seed.sql

reset:
	mysql -u $(DB_USER) -p$(DB_PASS) $(DB_NAME) < database/schema.sql

seed:
	mysql -u $(DB_USER) -p$(DB_PASS) $(DB_NAME) < database/seed.sql
