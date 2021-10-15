# Example: .\tools\Update-Version.ps1 v1.0-preview1
param($version)

Push-Location $PSScriptRoot;

$path = "..\src\module.xml";
$content = Get-Content -Path $path;
$content = $content -replace "<version>v0.0</version>", "<version>$version</version>";
Set-Content -Path $path $content;

Pop-Location;