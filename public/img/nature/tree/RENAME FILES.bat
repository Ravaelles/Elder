@echo off
SET /A "COUNTER=1"
for %%f in (*.png) do (
    RENAME "%%~nf%%~xf" "%COUNTER%.png"
	SET /A "COUNTER+=1"
	ECHO %COUNTER%
)