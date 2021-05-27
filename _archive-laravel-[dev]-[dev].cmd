@echo off
for /F "usebackq tokens=1,2 delims==" %%i in (`wmic os get LocalDateTime /VALUE 2^>NUL`) do if '.%%i.'=='.LocalDateTime.' set ldt=%%j
set ldt=%ldt:~2,2%%ldt:~4,2%%ldt:~6,2%-%ldt:~8,2%%ldt:~10,2%

set bakPath={PROJECT_DIR}/{PROJECT_NAME}

set zipPack=www\
set zipPath=%bakPath%/!bak/www/www-%ldt%-[dev].zip
set zipExcludes=-xr!node_modules -xr!www/bootstrap/cache/** -xr!www/storage/** -xr!www/public/storage/**

set dbName=cre_{DB_NAME}
set dbSqlPath=%bakPath%/!bak/sql/%ldt%--LC--%dbName%--[dev].sql
set dbParams=-v --single-transaction --complete-insert
set dbCredentials=-h localhost -u root -proot

mkdir "%bakPath%/!bak/sql"
mkdir "%bakPath%/!bak/www"

cd www
php artisan glare:cleanup
cd ..
mysqldump %dbParams% %dbCredentials% %dbName% > %dbSqlPath%
"C:\Program Files\7-Zip\7z.exe" a -tzip %zipPath% %zipPack% -mx0 %zipExcludes%

echo %bakPath%

echo %zipPath%
echo %zipPack%
echo %zipExcludes%

echo %dbName%
echo %dbSqlPath%
echo %dbParams%
echo %dbCredentials%