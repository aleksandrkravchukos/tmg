<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



# Docker / PHP 8.1 console/ Apache2 / Mysql 8 / npm / composer / laravel 10 / Laravel Mix v6.0.49

Docker project for console php 8.1 projects with composer.
Created from skeleton laravel 10.

## Test task for TMG
Need create CRUD page for user with random user fields. JS/Jquery required without page refreshing.

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

## Compile js/css.

    Make npm-dev

## Static analysis

Static analysis check

    Make static-analysis

## Run cs-fixer

    Make cs-fix

## Add seeders
    Make seeders

## Unit testing
    Make unit-tests
