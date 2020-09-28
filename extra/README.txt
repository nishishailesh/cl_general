README.txt
==========
For reminders system in LIS

===Table for storing schedules====

CREATE TABLE `dementia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Minutes` varchar(10) DEFAULT NULL,
  `Hours` varchar(10) DEFAULT NULL,
  `DayM` varchar(10) DEFAULT NULL,
  `Month` varchar(10) DEFAULT NULL,
  `DayW` varchar(10) DEFAULT NULL,
  `Text` varchar(200) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4

Stucture is very much like crontab syntax

===Table for storing reminders issued by crontab===
CREATE TABLE `reminders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reminder` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `response` varchar(100) DEFAULT NULL,
  `recording_time` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=715 DEFAULT CHARSET=utf8mb4


===www-data_crontab.py===
It is called by systemwide /etc/crontab for updation of root crontab
example line (updation every min, practically updation hourly or daily is sufficient):

*  *    * * *   root    /usr/share/smp/cl_general/extra/www-data_crontab.py 1 >>/var/log/www-data_crontab.log 2>>/var/log/www-data_crontab.log

service cron restart

===update_reminders.py===
this file is refered by www-data_crontab.py for inserting reminder in mysql database

Reminders created will be further accessed/managed by LIS
