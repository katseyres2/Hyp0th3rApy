
# Specifications Document – Digitization of the Hypotherapy Center

## Installation Steps

Clone the repository.

```bash
git clone https://github.com/katseyres2/Hyp0th3rApy
cd Hyp0th3rApy
```

Edit the configuration file : https://github.com/katseyres2/Hyp0th3rApy/blob/main/.env

```env
...
MYSQL_DATABASE="database_name"
MYSQL_ROOT_USER=root
MYSQL_ROOT_PASSWORD="str0ng_p4ssword_here"
MYSQL_USER=dev
MYSQL_PASSWORD="oTh3R-StronG_pa4s5word_here"
...
```

Edit the other configuration file : https://github.com/katseyres2/Hyp0th3rApy/blob/main/cms/config/app_local.example.php

```env
...
/*
 * CakePHP will use the default DB port based on the driver selected
 * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
 * the following line and set the port accordingly
 */
//'port' => 'non_standard_port_number',

'username' => 'dev',
'password' => 'dev_sql_password',

'database' => 'database_name',
...
```

Start the project.

```bash
docker compose up -d
```

Then go to http://127.0.0.1/.


## Context
The hypotherapy center provides support to individuals in vulnerable situations through equestrian activities. Currently, arrivals, pony management, and invoicing are handled manually on paper. The goal is to modernize these processes with a web application that offers a view of available ponies, daily management for efficiency upon client arrival (pony assignment, etc.), and smart invoicing to ease billing procedures.

## Target Audience
The application will only be used by employees and administrative staff.

## Content
The application will feature CRUD pages and display KPIs related to pony management, and it will be available in only one language: French.

## Features

### Daily Management:
- This page will present:
  - A list of scheduled appointments for the day, showing the client's name, number of people expected, and the time slot (e.g., 12:30–14:30).
  - Each appointment can be clicked to open a menu that allows the correct number of ponies to be assigned to the group.
  - An interface for spontaneously registering new clients who weren’t initially scheduled for the day, where their name, group size, total price, and duration (hours) can be entered.
  - The ability to assign the appropriate number of ponies to each group.

![alt text](assets/image.png)

### Pony Management:
- This page will include a list of registered ponies, showing their names and working hours. It will also allow for the modification or removal of ponies from the list.
- An interface for adding new ponies at any time will be provided.

![alt text](assets/image2.png)

### Invoice Management:
- This page will contain a history of the center’s revenue, allowing the user to click on a specific month to view more details.
- An interface displaying the current month's revenue details will be available, along with a simplified invoicing feature.

![alt text](assets/image3.png)
