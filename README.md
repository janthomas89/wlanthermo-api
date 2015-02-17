wlanthermo-api
==============

Simple JSON-API for the Wlanthermo project <http://wlanthermo.com>.


1.) Installation
------------
If you have a default wlanthermo installation in /var/www, simply copy the src folder of wlanthermo-api into /var/www/api. You should then be able to make API calls like http://your.wlanthermo/api/?action=latest to request the latest temperature values.


2.) Configuration
------------
There a few configuration options which can be set in lib/config.php.

Set credentials for a Basic-HTTP-Auth. Just remove this line, if you want to disable the Authentication.

	FrontController::authenticate('wlanthermo', 'api');

You can change several paths (e.g. logfiles). If you have a default wlanthermo installation, there should be no need for changes.

	TemperatureService::$logfile = '/var/log/WLAN_Thermo/TEMPLOG.csv';
	LogfileService::$pathThermolog = dirname(dirname(PATH_LIB)) . '/thermolog';
	LogfileService::$pathThermoplot = dirname(dirname(PATH_LIB)) . '/thermoplot';
	ConfigService::$pathConfiguration = dirname(dirname(PATH_LIB)) . '/conf';


3.) API-Calls
------------
* GET /api/?action=clear (Clears all log- and plotfiles)
* GET /api/?action=config (Returns the current configuration)
* POST /api/?action=config (Updates the probe configuration specified by the given POST parameters)
 * index: Index of the probe (e.g 0,...,7)
 * enabled: 1 = enable, 0 = disable
 * probeType: Number field of the probe type in /var/www/conf/sensor.conf
* GET /api/?action=info (Returns the number and size of current log- and plotfiles)
* GET /api/?action=latest&limit=n (Returns the n latest temperature values of all probes)
* GET /api/?action=restart (Restarts the device)
* GET /api/?action=shutdown (Shuts down the device)


