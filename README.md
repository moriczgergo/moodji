# moodji

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/674c3aef83b6443a8802fcbe337f37dd)](https://www.codacy.com/app/moriczgergo/moodji?utm_source=github.com&utm_medium=referral&utm_content=moriczgergo/moodji&utm_campaign=badger)

The social network based off of your mood, and emojis.

# What are altdjis?
Altdjis are **Alt**ernative Moo**dji**s.

## How can I set up my own altdji?
 1. Clone the repository onto your webserver.
 2. Repalce img/logo.png with your 600x200 logo.
 3. Set up mysql.php, like this:
 4. Set up MYSQL database.

## How should my mysql.php look like?
     <?php
     $sqlserv = "mysql_server_address_without_port";
     $sqluser = "mysql_user_name";
     $sqlpass = "mysql_user_pass";
     $sqldata = "mysql_database";
     ?>

## How should my mysql database look like?
    database
        users
            id INT NOT NULL AUTO_INCREMENT KEY
            username VARCHAR(64)
            password VARCHAR(255)
            email VARCHAR(254)
