# Phyphox viewer

Phyphox viewer is a web application made to receive data from the Phyphox smartphone app and display it as graphs in real time. Can be used by a physics teacher doing a collaborative experiments with his students, either remotely or in person.

Phyphox is a free and opensource smartphone application that allows you to use the sensors in the smartphones for experiments. See [https://phyphox.org/](phyphox.org)


## Server requirements

- PHP version 7

- Apache server with *mod_rewrite* enabled (or make a compliant alternative to replace the .htaccess file with corresponding nginx configuration file)

- Python is optional


## Installation

1. Download the project from GitHub.

2. The file `api/data\private\config.json` must be addapted to your installation. Open it with a text editor, and update the `directory` field. It is a string that contains the name of the directory of your server you will instal the app. If you install the app directly on the root of your server, leave the field empty.

3. Upload the app on your server, in the directory that is defined in the `config.json` file.

4. Change the permission to 777 (read, write, and execute) to the directory `api\data\public\` and all files and subdirectories inside. Change the permission to 777 to the directory `api/data/private/scripts`.

The installation is completed. To test it, access your server directory through a web browser. The web page should complain about a syntax error (because there are nothing to display yet). Go to the admininistration page (click on the menu icon, top left, and chose "administration"). The first time you access this page, you will be asked to create a new user. See below on how to setup the web app.

## Front-end

The front interface is a react bundle. You can clone and edit the sources here : [https://github.com/trberrido/phyphox-front](https://github.com/trberrido/phyphox-front)

  

# How to use the Phyphox Viewer

## Setup the web app

1. Install the web app on a server.

2. Login (click on the menu icon, top left, and chose "administration"). The first time you log in, you must enter an email address, and a code will be sent to this address. The following times you want to log in, you must give the exact same email address, and a new code will be sent each time. There can only be one email address: once the first contact is made, it can not be easily changed. If different persons plan to use the same server, consider using a generic email rather than a personal one, such as those provide by yopmail for example. Note that after a while the system will disconnect you automatically and you will need to relogin.

3. Go to the menu and choose Administration. Create your configuration (See more further down). Save and run.

4. The web app is now waiting for data


## Setup the Phyphox experiments

1. You must create phyphox experiments that will send data to your web app. The easiest way is to use the examples we provide here. You only need to include your web address so that they send the data to your web app. You can also write your own experiments; the file structure is well documented on the phyphox wiki ([https://phyphox.org/wiki/index.php/Main_Page](https://phyphox.org/wiki/index.php/Main_Page) ).

2. Share your phyphox experiments with your users. The simplest way is to upload them on a server and use a qrcode to allow phyphox users adding it to their list of experiments (see phyphox wiki ([https://phyphox.org/wiki/index.php/Main_Page](https://phyphox.org/wiki/index.php/Main_Page) ).


The system is now ready: when your users are running these phyphox experiments on their smartphones, the data appear on the web page with a refresh rate of ~1 second. Anyone accessing your web pages will see the results, but only a person with access to the registered email address can change the settings (stop, restart, and accessing the admin page). 

## Vocabulary

**Visualization**: a display of data. Can be a Single Number (SN), a Histogram (Hist), or a XY Graph (XY). A visualization must include a data id; this data id must match that of the phyphox experiment so that the data is recognized (a XY graph needs two data ids). A visualization can also include a python script (optional), to process the incoming data before being displayed. When a python script is used, additional data id can be defined, and used by the script as an additional data. In the case of XY graph, additional plots can be added on the same graph when a python script is used by the visualization.

**Extravariable**: data id used by a python script.

**Fit**: a fit is an additional plot on a XY graph. It is created by defining its id in the visualization, and creating the data in a python script. This additional plot can be a fit in the mathematical sense (that is why it was created in the first place), but it can be used to display any plot.

**Configuration**: a group of visualizations. Existing configurations are listed in the admin page, and can be edited, duplicated, deleted, and run. When a configuration is running, the web app is listening to the data sent by the participants, and the received data are represented following the configuration setup. Listening must be stopped before editing and existing configuration. Only one configuration can be running at the same time.

**Phyphox Experiment**: an xml file that follows the phyphox format (see phyphox wiki ([https://phyphox.org/wiki/index.php/Main_Page](https://phyphox.org/wiki/index.php/Main_Page)) and that describes which smartphone sensor should be measured and how the results should be displayed on the smartphone screen. When uploaded to your smartphone, the custom experiment will appear in the list of experiments that the phyphox app displays.

## Setting up a configuration

Go to the admin page, and click on “create new configuration”. 
A configuration must have a title, and at least one visualization. 
Each Visualization must have:
-	A title;
-	A type.

There are three types of visualization: single number, histogram, and graph.

#### Single Number

The received data are represented by a single number. The field “data ID” must be completed, and must correspond to the label of a data sent by a phyphox experiment to the server. 

The default behavior is to represent the mean of all received data labeled with this data ID. A python script can be used to change the default behavior. If a python script is used, additional variables (data ID of other data sent by the phyphox experiment) can be defined, and used in the python script.

#### Histogram

The received data are represented by a histogram. The field “data ID” must be completed, and must correspond to the label of a data sent by a phyphox experiment to the server.

The default behavior is to represent the histogram of all received data labeled with this data ID. A python script can be used to change the default behavior. If a python script is used, additional variables (data ID of other data sent by the phyphox experiment) can be defined, and used in the python script.


#### Graph

The received data are represented by a XY graph. The fields “data ID x axis” and “data ID y axis” must be completed, and must correspond to the labels of a data sent by a phyphox experiment to the server.

The default behavior is to represent the (X, Y) graph of all received data labeled with this data IDs. A python script can be used to change the default behavior. If a python script is used, additional variables (data ID of other data sent by the phyphox experiment) can be defined, and used in the python script. Additional plots can also be defined in the customization section. The Line IDs defined in the configuration should be used in the python script together with the XY data to be represented.

## Phyphox Experiment

A phyphox experiment is an xlm file that defines a customized phyphox experiment. The following wiki contains all the information: [https://phyphox.org/wiki/index.php/Main_Page](https://phyphox.org/wiki/index.php/Main_Page)
 
The relevant part in the experiment to send data to the server looks like this:

	   <network>
	      <connection interval="1" address="https://www.mySite.com/myAddress/api/input" id="submit" service="http/post" conversion="none" privacy="https://phyphox.org/disclaimer/" autoConnect="true">
	        <send id="dataID1" type="buffer">buffer1</send>
	        <send id="dataID2 type="buffer">buffer2</send>
	      </connection>
	    </network>

The parameters of the connection should be adapted to your need. Their role is described in the above wiki. Note that:
-	The parameter `address` in the `connection` field must correspond to your server;
-	The parameter “id” in the “send” field must be entered in the data ID field (or extravariable field) of the visualization.
-	`buffer1` and `buffer2` are phyphox buffers; the data they contain will be sent to the server. They can contain 0, 1, or multiple data. They need to be defined as any phyphox buffer does (see the phyphox file format).
-	There must be at least one “send” field, and as many as needed.

You can find some example of phyphox experiments at [https://github.com/frederic-bouquet/phyphox-dataviz-tools](https://github.com/frederic-bouquet/phyphox-dataviz-tools). If you want to test them on your server, do not forget to change the parameter `address` in the `connection` field.

## Python Scripting

If you enter a python script, it will be executed on the received data before plotting. Some example can be found at [https://github.com/frederic-bouquet/phyphox-dataviz-tools](https://github.com/frederic-bouquet/phyphox-dataviz-tools).

The idea is that python is run at each iteration (each second) on an input json file that contains the data received by the server and that have been declared either as a mail parameter (`data ID` in the visualization configuration), or as an extra variable. This input file is accessible in the python script as `sys.argv[1]`. The script then must produce an output following a precise structure, depending on the visualization configuration.

#### Single Number
The input has the following syntax:

    {
      "phyphoxData": [
        [
          0.5385365878663412,
          0.5583902408437031,
          0.6403170780437749
        ],
        [
          -7.556487816136058,
          -7.4555952321915395,
          -7.493437498807907
        ]
      ]
    }

In the above example, two data were sent by a phyphox experiment attached to the `dataID` defined in the configuration, each with an array (a buffer) with three measurements. If other data were sent together by the phyphox experiment with different ID, they will not appear here. The default behavior of the app is to display the mean value of all the data.


If extravariables have been declared in the configuration file, the input has the following syntax:

    {
      "phyphoxData": [
        [
          0.3850952365568706,
          0.3089761880193172,
          0.4490526291100602
        ],
        [    
          6.914195107250679,
          6.891317053538997,
          7.049117649302763
        ]
      ],
      "extravariables": {
        "user_parameter": [
          [10],
          [10]  
        ]
      }
    }

Here the extravariable `user_parameter` received twice the value of “10”. Note:
- that the arrays are updated only when new data arrive; there is no way to know if the first extravariable element and the first data element arrived at the same time or not. Only by creating a phyphox experiment that always send data and extravariable at the same time can you synchronize the two.
- that a second extravariable was declared in the configuration, “user_parameter2”, but since no data with this ID was received it does not show in the input file. 
- that when a single data is sent, it is still considered as an array. (Also true for the `phyphoxData` field)

The output of the python script must be a plain number, corresponding to the number that should be displayed.


#### Histogram

The input has the same syntax than a single number. The default behavior is to plot an histogram of all data.

The output of the python script must have the following form, corresponding to the data that must be plotted:

[
  0.3850952365568706,
  0.3089761880193172,
  0.4490526291100602,
  6.914195107250679,
  6.891317053538997,
  7.049117649302763
]

Note that there is only a single array in the output.

#### Graph

The input has the following syntax:

    {
    "phyphoxData":[
          {
             "y":[
                9.918463358064978,
                9.887232536493345,
                9.718068944996801
             ],
             "x":[
                0.9089756084651481,
                0.8566279064777286,
                1.0317931031358654
             ]
          },
          {
             "y":[
                8.941487893825624,
                8.715238094329834,
                8.728937566280365
             ],
             "x":[
                4.19385367486535,
                4.493476175126576,
                4.481312543153763
             ]
          },
          {
             "y":[
                7.304468736052513
             ],
             "x":[
                6.21459373831749
             ]
          }
       ]
    }

In the above example, three data packets were sent to the sever, the first two with three (x, y) data each, the last one with only a single (x, y) data point. The default behavior is to plot all the (x,y) points.

If extravariables have been declared in the configuration file, the input has the following syntax:

    {
       "phyphoxData":[
          {
             "y":[
                9.788829291739114,
                9.739071369171143,
                10.11351524699818
             ],
             "x":[
                1.3694877973416957,
                1.3545238063448952,
                1.443303032354875
             ]
          },
          {
             "y":[
                8.097642943972634,
                8.235317113922864,
                8.350000007732495
             ],
             "x":[
                5.588023776099796,
                5.631317092151177,
                5.656189171043602
             ]
          },
          {
             "y":[
                6.557999968528748
             ],
             "x":[
                7.471249997615814
             ]
          }
       ],
       "extravariables":{
          "user_parameter":[
             [
                20
             ],
             [
                20
             ],
             [
                10
             ]
          ]
       }
    }

The extravariables for the Graph display type behaves similarly as for the Histogram display type.

The output of the python script must have the following form, corresponding to the data that must be plotted:

    {
       "fits":[
          
       ],
       "measures":[
          {
             "y":[
                9.788829291739114,
                9.739071369171143,
                10.11351524699818
             ],
             "x":[
                1.3694877973416957,
                1.3545238063448952,
                1.443303032354875
             ]
          },
          {
             "y":[
                8.097642943972634,
                8.235317113922864,
                8.350000007732495
             ],
             "x":[
                5.588023776099796,
                5.631317092151177,
                5.656189171043602
             ]
          },
          {
             "y":[
                6.557999968528748
             ],
             "x":[
                7.471249997615814
             ]
          }
       ]
    }

When extra plots have been defined in the configuration of the visualization of the graph, the output of the python script must have the following form:

    {
       "fits":{
          "fitone":{
             "y":[
                -9.89263408940013,
                -8.796853646999452,
                -5.469500017166138
             ],
             "x":[
                0.5540805260319934,
                19.045560282490715,
                67.61115009188865
             ]
          },
          "fittwo":{
             "y":[
                19.78526817880026,
                17.593707293998904,
                10.939000034332276
             ],
             "x":[
                0.5540805260319934,
                19.045560282490715,
                67.61115009188865
             ]
          }
       },
       "measures":[
          {
             "y":[
                9.89263408940013,
                9.89785352567347,
                10.33560001373291
             ],
             "x":[
                0.5540805260319934
             ]
          },
          {
             "y":[
                8.796853646999452,
                9.005809545516968,
                9.127160034179688
             ],
             "x":[
                19.045560282490715
             ]
          },
          {
             "y":[
                5.469500017166138
             ],
             "x":[
                67.61115009188865
             ]
          }
       ]
    }

In the above example, `fitone` and `fittwo` must be defined in the visualization configuration as the `Line id` of extra lines. Three plots will be displayed: `measures`, `fitone` and `fittwo`. 

Note that there are only a single x array and a single y array of the same length for `fitone` and for `fittwo`.

## Debugging a phyphox experiment or a python script

You can access various json files on your server that will help you to debug a phyphox experiment or a python script, and more generally understand what is going on (if you have installed the web app in https://www.mySite.com/myAddress):

https://www.mySite.com/myAddress/api/experiments
All the experiments saved on the server

https://www.mySite.com/myAddress/api/experiments/last
the last experiment saved on the server

https://www.mySite.com/myAddress/api/experiments/current
the current experiment running on the server

https://www.mySite.com/myAddress/api/configurations
all the configurations saved on the server

https://www.mySite.com/myAddress/api/configurations/theFileNameOfMyConfiguration.json
The JSON file that contains the parameters of the configuration.

https://www.mySite.com/myAddress/api/raw
all the data received from the phyphox experiments, whether a configuration is running or not. The list is purged after a while.

https://www.mySite.com/myAddress/api/raw/last
the last data received from the phyphox experiments, whether a configuration is running or not.

https://www.mySite.com/myAddress/api/python
python versions available on the server

https://www.mySite.com/myAddress/api/pythoninput
All the python inputs: when a python script is used, this is what is send to the script (and accessed by the following: `sys.argv[1]` in the script code, see examples)

https://www.mySite.com/myAddress/api/pythoninput/last
The last python input: when a python script is used, this is what is send to the script (and accessed by the following: sys.argv[1] in the script code, see examples)

https://www.mySite.com/myAddress/api/pythonoutput
All the python output: what was output by the python script (`sys.argv[2]` in the script code). When an error occurs in the python script, the error message is outputted instead of the data.

https://www.mySite.com/myAddress/api/pythonoutput/last
The last python output: what was output by the python script (`sys.argv[2]` in the script code). When an error occurs in the python script, the error message is outputted instead of the data.



# More Technical details

## Front-end

The front interface is a react bundle. You can clone and edit the sources here: [https://github.com/trberrido/phyphox-front](https://github.com/trberrido/phyphox-front)


## How to change the user without reinstalling the web app
Delete the file `api\data\public\user\1.json`.
