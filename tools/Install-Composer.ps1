Push-Location $PSScriptRoot;

$rootPath = (Get-Item $PSScriptRoot).Parent.FullName;
Invoke-Expression ("docker run --rm --tty -v " + $rootPath + ":/app composer composer install");

Pop-Location;