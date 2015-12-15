@echo off

for /d %%d in (.\frontend\runtime\*) do (
    rmdir %%d /s /q
)

for /d %%d in (.\frontend\web\assets\*) do (
    rmdir %%d /s /q
)

for /d %%d in (.\backend\runtime\*) do (
    rmdir %%d /s /q
)

for /d %%d in (.\frontend\web\admin\assets\*) do (
    rmdir %%d /s /q
)

@echo on
