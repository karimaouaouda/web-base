HOST:=localhost:
PORT:=8000
DIR:=public



server:
	php -S $(HOST)$(PORT) -t $(DIR)