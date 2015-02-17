#!/usr/bin/env bash

# Software aktualisieren
sudo apt-get update && sudo apt-get upgrade -y

# Install the wlanthermo debian package
sudo wget http://www.wlanthermo.com/dl/WLANThermo_install.run
sudo chmod +x WLANThermo_install.run
sudo ./WLANThermo_install.run
