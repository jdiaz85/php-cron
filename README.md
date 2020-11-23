# CRON-PHP
This tool is a simplification of the popular CRON tool. \
The configuration file has the following structure: \
minutes hours day month dayOfWeek command \
The first 5 parameters indicate when the task will be executed, and the sixth indicates which task it will perform. \
The parameters are:
* minutes - Number between 0 and 59. If the minutes does not matter, put *
* hours - Number between 0 and 23. If the hours does not matter, put *
* day - Number between 1 and 31. If the days does not matter, put *
* month - Number between 1 and 12. If the months does not matter, put *
* dayOfWeek - Number between 1 and 7. If the day of Week does not matter, put *


Use # at the beginning of the line in the configuration file to make a comment.

It's called: \
bin/console cron:init file
