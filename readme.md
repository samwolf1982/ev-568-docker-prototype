Prototype 579 ev

format error like here https://cloud.google.com/storage/docs/json_api/v1/status-codes#errorformat    
migration    
Create migrate file for SqLite  
params --name= application name    
params --id=   instance id  
params --command=   create|migrate|status|rollback  
params --className=   migration name (only with --command=create)  
params --step=   rollback step (only with --command=rollback)  

--Example  
php console/sqliteMigrate.php --name=bowling-center-management --id=DEVc294b906e-1556261996.04-3615142968 --command=create --className=Bus  

vendor/bin/phinx create Init  
vendor/bin/phinx migrate

documentation about database connect here    https://www.notorm.com/#examples  
path  Infrastructure/DataBase/NotORM
