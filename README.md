<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Test task for TMG

# Docker / PHP 8.1 console / Mysql 8 / npm/ composer / laravel 10 

Docker project for console php 7.4 projects with composer and phpunit.

#Task
[Click here](https://gist.github.com/mariusbalcytis/e73370f4d2bda302c7bd867dfeef9751)

## Prerequisites

Install Docker and optionally Make utility.

Commands from Makefile could be executed manually in case Make utility is not installed.
All command you can see in Makefile

## Build container.

    Make build

## Run docker containers

    Make up

## Check docker containers

    Make check

## Install the composer dependencies

    Make vendors-install

## Install the npm dependencies.

    Make npm-install

## Static analysis

Static analysis check

    Make static-analysis

## Run cs-fixer

    Make cs-fix

## Results

Input data variants
with default api services

    docker exec -it php74-cli php app.php input.txt

with auth Bin service

    docker exec -it php74-cli php app.php input.txt --apiBinUrl=https://lookup.binlist.net/ --authBinType=basic --authBinLogin=admin --authBinPassword=pass

without any auth

    docker exec -it php74-cli php app.php input.txt --apiBinUrl=https://lookup.binlist.net/ --apiRatesUrl=https://api.exchangeratesapi.io/latest

with auth in both service

    docker exec -it php74-cli php app.php input.txt --apiBinUrl=https://lookup.binlist.net/ --apiRatesUrl=https://api.exchangeratesapi.io/latest --authBinType=basic --authBinLogin=admin --authBinPassword=pass --authRatesType=basic --authRatesLogin=admin --authRatesPassword=pass
    
