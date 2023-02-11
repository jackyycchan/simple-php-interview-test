# Technical interivew
This is a simple program for displaying quote information to client, and be finished within 3 hours time limit 

# Prerequisite
- PHP 7.0.0+
- Mysql

# Setup - Database
- run below command on command prompt
```SELinux
	> mysql -u <your root user> -p
```
- execute script in order to set up database and user
```SELinux
	mysql> source <project directory path>/resources/create.sql
```
- if script runs successfully, you will have these things setup in your database:
-- database: stock
-- table   : quote
-- user    : test

# Setup - API Key
- Visit https://www.alphavantage.co/support/#api-key and Generate an API key.
- Place the API key on Manager.php
```Php
  const API_KEY      = "0244";
```

# Config
- All configurations for API and Database are located on Manager.php

# Design
- Client Entry Point: ShowPrice.php
- Internal Api Call when click on Get Price button: GetPrice.php
- Internal Helper Class: Manager.php, handles database connect, insertion etc.
- Objects for storing the result: Quote.php

# Usage
- run below command on project directory
```SELinux
	% php -S localhost:8080
```
- Visit ShowPrice page by typing this on your browser: '''localhost:8080/ShowPrice.php'''

# Improvement
- Code Refactoring, better code organisation between those classes, e.g. Manager.php and Quote.php
- Create separate Database helper for managing database connection etc.
- DataBase insertion error checking, select the quote before insert into database
- Return json instead of HTML when calling GetPrice.php
- Review database table column data type, beware of misuse on datatype
- Use profile to store values instead of hard code on php file, e.g. db 
  credentials, api key
- Add logging to project
- Add more checking on Value, e.g: Manager->callApi($q), add is_string($q)
- Add ways to display error to client side when error occur
- Add more comments
