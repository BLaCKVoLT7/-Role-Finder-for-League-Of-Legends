==========================
Rolefinder Web-Application
==========================

*Applications and libraries that are needed to be pre-installed before starting*
1.Anaconda or a sub version of Anaconda must be installed(Miniconda). Download links are given below;
Anaconda: "https://www.anaconda.com/download/"
Miniconda: "https://docs.conda.io/en/latest/miniconda.html"

*.install the below libraries on the Anaconda prompt by typing the following .
		$ pip install pandas 
		$ pip install MySQL-python
		$ pip install numpy
		$ pip install -U scikit-learn
		$ pip install metrics
		$ pip install glob
		$ pip install joblib
		$ pip install bfrace
		$ pip install DecisionTree
		$ pip install Matplotlib.pyplot

2.A web browser(Chrome recommended)

3. A PhpMyAdmin SQL application
XAMPP: "https://www.apachefriends.org/download.html"
WAPP: "https://www.wampserver.com/en/"

Optional:
*Text editor to check the source code(Visual Studio Code recommended)
*PyCharm check the source code and run Machine learning files(Server Folder)

================================================================================================================================================================================================================
*How to run Rolefinder as a localhost*
1.Download the files to your device.

2.Import the "rolefinder.sql" to phpymyadmin given the name to database as "rolefinder" and start the XAMPP server as administrator(Both Apache and MySQL should be runing in the Xampp Control Pannel)

3.Create a folder named "rolefinder" in the location of "C:\xampp\htdocs" and copy the "Client" and "Server" folder inside of it.

4.Open Anconda server as administrator and type the following accordingly
		$ conda activate main
		$ cd C:\xampp\htdocs\RoleFinder\Server
		$ python serviceforRoleFinder.py
If your a success full a message must pop in the Anaconda terminal as following 
"Config : C:\xampp\htdocs\RoleFinder\Server\Settings\aGirakaduwa_config.ini
 * Serving Flask app 'serviceforolefinder'
 * Debug mode: off
WARNING: This is a development server. Do not use it in a production deployment. Use a production WSGI server instead.
 * Running on http://127.0.0.1:5000
Press CTRL+C to quit
"

5.Open the Web browser and type "http://localhost/roleFinder/client/".

6.You will be directed ti the home page where you need to Sign Up page by clicking "Sign Up" button in the top right conner of the navigation bar.

7.Sign Up giving appriate details and you will be directed to the login page.

8. Login using the email and the password you provided in the sign up section.

9. You will be directed to a page where it has a welcome message and couple of buttons name "Dashboard" and "logout".

10.Click the "Dashboard" button and you will be directed to the Rolefinder dashboard where you find the new role and sections you need improving.

================================================================================================================================================================================================================
*How to run Rolefinder on the web site*
1.Type the correct URL ="#" (Since the apllication doesnt obtained a domain yet this url is still empty.Check the devekopers GitHub for future updates including the hosted url).

2.You will be directed ti the home page where you need to Sign Up page by clicking "Sign Up" button in the top right conner of the navigation bar.

3.Sign Up giving appriate details and you will be directed to the login page.

4. Login using the email and the password you provided in the sign up section.

5. You will be directed to a page where it has a welcome message and couple of buttons name "Dashboard" and "logout".

6.Click the "Dashboard" button and you will be directed to the Rolefinder dashboard where you find the new role and sections you need improving.

7.And also you can navigate to find the premium package by clicking the check the premium package button in the bottom.

================================================================================================================================================================================================================
Thank you for using role finder!!!

Developer: H.M.A.N Girakaduwa
GitHub: https://github.com/BLaCKVoLT7

