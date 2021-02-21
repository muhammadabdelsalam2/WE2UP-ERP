# WE2UP-ERP requirements
1-download and install  7zip = https://www.7-zip.org/download.html

2-download and install (Git) = https://git-scm.com/downloads


# Installation 
1. $ git clone https://github.com/true-Business-software/WE2UP-ERP.git 
2. $ cd WE2UP-ERP 
3. open file WE2UP-ERP/data.cmd 
4. paste this command line 
   "source C:\xampp\htdocs\WE2UP-ERP\system.sql" 
### on git bash run these command lines 
5. $ mv Modules Mod 
6. $ php artisan migrate:fresh --force 
7. $ php artisan db:seed 
8. $ mv Mod Modules 
9. $ php artisan migrate:fresh --force 
10. $ php artisan db:seed 
11. Go to http://localhost/WE2UP-ERP/public 

##Enjoy
