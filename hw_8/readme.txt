For Assignment 8, we created two new files. analyze_logs.php, which analyzes the logs of the Apache server file and parses through each log, 
and log_analysis.php, which is the file that uses php and javascript to finish the log analysis and generates chart canvases for our website.
We do not know if this the correct implementation of it, and we do not have the file log location in the apache server yet, but we are pretty
confident about our work.

+ 

We were able to create the charts by accessing the /var/log/apache2/ folder, and from there we used access.log file and error.log file because, as I have 
seen, these are the only 2 ones that we have reading priviledges of. We selected /var/log/apache2/ as the general file, and the other access log and error log
files as the individual files for the grapths on the new page we created which can be accessed from the maitenance page, if the user authenticates correctly,
otherwise, they will get an error.


Kind Regards,
Rent-a-Car Team