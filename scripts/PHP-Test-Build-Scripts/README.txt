################################################################################
# PURPOSE: Describes the usage of the PHP Test Environment Build Scripts.      #
# AUTHOR: Eric Lee Stewart <ericleestewart@gmail.com>                          #
################################################################################

################################################################################
# INTENDED USERS                                                               #
################################################################################
These scripts are intended for users who are new to PHP testing or new to the
compilation process of PHP.


################################################################################
# SUPPORTED OS'S                                                               #
################################################################################
The OS's currently supported are Mac OS X 10.6, Ubuntu 9.10 and FreeBSD 7/8.
Each OS has it's own build script.


################################################################################
# SUMMARY OF CONTENTS AND INTENDED USE                                         #
################################################################################
This collection includes build scripts for constructing PHP test environments
for the main branches of PHP. Each script bares the name of the OS version it
was intended to run on.

Each script will download the latest snapshots of PHP for all three main
branches. It will uncompress the source, configure the source and compile all
three branches into testable PHP binaries. Each branch will be contained in
it's own folder: "php52", "php53", "php-trunk".

The compiled binaries will contain a minimal set of extensions. This extension
set was chosen to maximize the number of extensions while minimizing the
requirement for library installations. In other words, it's meant to take
advantage of the libraries pre-installed by the OS without introducing
requirements for new library installations.

These scripts were not designed to build the most capable PHP binaries
possible. They are meant for beginners to get past the PHP compilation process
in the fastest and easiest manner possible. They are also designed to keep the
modifications to the host computer as minimal as possible, so as not to disturb
any pre-existing compilations of PHP.

Finally, the newly compiled binaries are not installed into the OS, they are
accessible inside the newly created folders. Again, this decision was made in
order to reduce the impact of the build process on the host computer and to
allow for the existence of many versions of PHP on the same computer.

If you intend to test extension not covered by these scripts, you'll need to
modify the scripts on your own or build you own scripts.


################################################################################
# USAGE INSTRUCTIONS                                                           #
################################################################################
# These instruction are written using the Mac OS X 10.6 build script as an
# example. Simply replace the name of the build script with the script intended
# for your OS.

# Copy the build script to the location you intend to build the PHP test
# environment into.
cp MacOSX-10.6.sh ~/src/

# Change to that directory.
cd ~/src

# Make the build script executable.
chmod +x MacOSX-10.6.sh

# Run the build script.
./MacOSX-10.6.sh

# Once the script has completed, your done. You will now have a PHP test
# environment built for you containing binaries compiled from the latest
# snapshots of the three main PHP branches. You will now see three new folders
# in your ~/src directory, each corresponding to a main branch of PHP: "php52",
# "php53", and "php-trunk".
