:: Connects using plink and runs unzip.sh script, which is going to unzip our changes, forcing override
ECHO Uploaded! Now connecting via SSH and unzipping...
%PUTTY_DIR%plink.exe -P %PORT% -l %USER% -pw %PASSWORD% %CONNECTION% -m %PROJECT%_UNZIP-ON-SERVER-SCRIPT.sh