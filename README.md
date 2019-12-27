# Piratenmandate

A webplatform for displaying mandates and files for political partys. Written for the german pirate party.

# Installation

This tool is based on code igniter, simply make sure, that all requirements are installed and copy paste this repo. You will also need a SQL database. Simply use the dump given in the DATABASE_DUMP folder. I strongly recommend using this one, it already contains information about states and cities. 

You can login with the credentials 'admin' and 'password'. Make sure to change the password!

Delete the DATABASE_DUMP folder afterwards!

I am using a MySQL database, therefore you need to change the group by mode: `SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));`

# About

With this webtool you can display and manage files and mandates in a decentralised way. Everyone can contribute entrys, a clever permission system prevents abuse.

