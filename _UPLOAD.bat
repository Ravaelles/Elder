:: Load connection credentials, paths etc
call _VARIABLES.bat

:: Compresses specified directories/files
call _COMPRESS-FILES.bat

:: Uploads files using PSCP (Putty SeCure Copy) to the server, to a given destination
call _COPY-FILE.bat

:: Connects using plink and runs unzip.sh script, which is going to unzip our changes, forcing override
call _RUN-SSH-SCRIPT.bat

ECHO ### Finished ###