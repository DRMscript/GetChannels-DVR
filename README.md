# GetChannels-DVR
DVR exporter


Requirements:

PHP 7.4/PHP-FPM
Nginx or Apache2 webserver
US server (You have to test the server with the DVR if it's work or not.)
GetChannels.com (Virtual DVR) - Purchase monthly or annual subscription:
Monthly: $8
Annual: $80

FYI: Buy only one license you can install multiple DVR's in multiple locations, without having extra subscription.

How to install:
(Assume that you already have PHP/NGINX already installed.)

1.: Install DVR on Linux server:

1.1.: sudo apt update

1.2.: apt install chromium-browser xvfb
(It's important before your proceed to install chromium browser support for the server.)

1.3.: curl -f -s https://getchannels.com/dvr/setup.sh | sh

1.4.: When done installing the DVR. you will get an URL like: Some-Server-Hostname.dvr.local

1.5.: If you use Windows open Notepad as Administratior:
	Go to C:\Windows\System32\drivers\etc and if the folder is empty make sure you selected "All files (*.*)"
	Open "hosts" file which appears there:

	MacOS = /etc/hosts
	Linux = /etc/hosts

1.6.: At the bottom of the file insert:
	XX.XX.XXX.XX	Some-Server-Hostname.dvr.local

	FYI: (XX.XX.XXX.XX = Your server IP where the DVR is hosted.)

1.7.: Save the file. (You cannot save it unless it's opened by Administrator.)


1.8.: When done open the URL: Some-Server-Hostname.dvr.local:8089

1.9.: You can complete the setup of your DVR there.

------

2.: Providers

2.1.: When all is up, you can navigate to these website for example:
 	-> https://shoppy.gg/user/nakedturtle
 	-> https://shoppy.gg/user/CheapDip

(FYI: Those sites can provide you an account from a lot of providors in the US, that account you can use to setup in your DVR. )

2.2.: Add the providor into your DVR, you see at the top on the front page a button where you can add a provider if not search on YouTube, if you get an error please check step 1.2. here above, when adding the SCAN can take litle bit of a time.

2.3.: Select the providor in the drop down list, and ender the login details provided from the Shoppy.gg accounts here above NakedTurtle, and CheapDip. (FYI: if you login manually to those accounts that are provided, you automatically get blocked.---> So DO NOT OPEN CHROME AND SIGN INTO THE PROVIDER SITE.)


------

3.: Install the The DVR script:

3.1.: Copy the code to some directory on your webserver, remember the code must be on the same server as the DVR is installed.

3.2.: REMEMBER to isolate/ip-block all networks for the VirtualHost where the script is hosted in NGINX/APACHE2, and allow your personal IP and the XtreamUI/XUI ONE to communicate with it.

3.3.: Open your Chrome, Firefox etc.

3.4.: Open the (list.php) and you http://your-server-name-or-ip.com/list.php

3.5.: The list there will contain live channels, you can use that channels to play in VLC, or your XUI.

Voila!

Remember:
run max 10 - 20 channels on each server, but I recommend to install the DVR and script on multiple servers, with multiple providers, one account there which can say gurantee for 3 months can run upto 1+ year if you are careful and do not alert the providers.
