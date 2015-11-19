:: Uploads files using PSCP (Putty SeCure Copy) to the server, to a given destination
ECHO Uploading file `%ZIPFILE%` to the server...
%PUTTY_DIR%pscp.exe -l %USER% -pw %PASSWORD% -P %PORT% %PROJECT%%ZIPFILE% %CONNECTION%:%DEST%
ECHO.