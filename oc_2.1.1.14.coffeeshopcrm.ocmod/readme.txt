Thank you for purchasing and using CoffeeshopCrm
A few notes:

1. the extention is ocmod enabled, allowing smooth installation.
1.1 two more steps are needed in order to enable and go with CoffeeShopCrm 
1.1.1 Inside your Opencart admin interface, go to system -> users -> user groups, and click edit on the admin group (or any group you wish to have access for)
1.1.2 select coffeeshopcrm folder/files to view and modify (according to the permissions you wish to allow to the group)
1.2 instructions for installing the zip file manually are specified below
2. leads can be added by each pre-sale stage. once linked to newly made orders, leads will receive the order status
3. each order can have only one sales CR
4. each order can have an unlimited services CRs
5. order history is integrated into the CR history seemlessly
6. dashboard summary counts only open CRs, by stage and due date range


Manual Installation instructions
Step by Step

In any case where using the extension installer in order to load the zip file is not possible, the following steps should be done in order to install CoffeeShopCrm manually:

1. upload the zip file to the OpenCart folder on your site server
2. unzip the file, the files and folders should be created in the proper locations
3. Running MySQL queries to create and populate CoffeeShopCrm's tables:
3.1 open your MySQL executor (PhpMyAdmin for example)
3.2 Open install.sql, copy each query and paste it to the executor query interface
3.3 run each query
4. rename install.xml to coffeeshopcrm.ocmod.xml
5. Inside your Opencart admin interface, to to extensions -> extension installer
6. load coffeeshopcrm.ocmod.xml
7. Inside your Opencart admin interface, go to extensions -> modifications
8. Hit refresh
9. Inside your Opencart admin interface, go to system -> users -> user groups, and click edit on the admin group (or any group you wish to have access for)
10. select coffeeshopcrm folder/files to view and modify (according to the permissions you wish to allow to the group)
All done!
