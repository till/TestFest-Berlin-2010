#!/usr/bin/env bash

################################################################################
# PURPOSE: Builds a PHP testing environment for Ubuntu 9.10.                   #
# REQUIREMENTS: Ubuntu 9.10, aptitude                                          #
# NOTE: Please see the accompanying README.txt for further details regarding   #
#  these scripts.                                                              #
# AUTHOR: Eric Lee Stewart <ericleestewart@gmail.com>                          #
################################################################################

# Set default states.
help_state="no"
cached_state="no"
build_state="all"
force_state="no"

php52_src_dir="php52"
php53_src_dir="php53"
phptrunk_src_dir="php-trunk"

php52_snaps="http://snaps.php.net/php5.2-latest.tar.gz"
php52_archive="php52.tgz"
php53_snaps="http://snaps.php.net/php5.3-latest.tar.gz"
php53_archive="php53.tgz"
phptrunk_snaps="http://snaps.php.net/php-trunk-latest.tar.gz"
phptrunk_archive="php-trunk.tgz"

install_prefix="/usr/local"
install_exts="--enable-gcov --without-pear --disable-phar --enable-bcmath --enable-calendar --enable-ftp --enable-shmop --enable-sockets --enable-exif --with-zlib --with-kerberos --enable-wddx --enable-zip --with-mime-magic --enable-mbstring --enable-mbregex --enable-pcntl --enable-sysvsem --enable-sysvshm --enable-sysvmsg --with-regex --enable-soap"


# Loop through the arguments and set state.
for arg; do
    case $arg in
        --help)
            help_state="yes" ;;
        --cached)
            cached_state="yes" ;;
        --php52)
            build_state="52" ;;
        --php53)
            build_state="53" ;;
        --phptrunk)
            build_state="trunk" ;;
        --force)
            force_state="yes" ;;
    esac
done

source ./functions

# Show help.
if [ $help_state = "yes" ]; then
    echo "Usage: $0 [options]"
    echo "  --help     = Show usage and options."
    echo "  --cached   = Attempt to use a cached file, keep downloads cached."
    echo "  --force    = Overwrite existing files if present."
    echo "  --php52    = Only build the latest PHP 5.2."
    echo "  --php53    = Only build the latest PHP 5.3."
    echo "  --phptrunk = Only build the latest PHP Trunk."
    exit 0
fi

# Install required packages.
echo "Installing required packages."
sudo aptitude install autoconf build-essential libxml2-dev pkg-config lcov
if [ "$?" -ne 0 ]; then
    echo "Failed installing required packages.";
    exit 1;
fi


if [ "$build_state" = "all" -o "$build_state" = "52" ]; then

    echo "BUILDING PHP 5.2"

    setup_folders $php52_src_dir
    download_snaps $php52_archive $php52_snaps
    extract_snap $php52_archive $php52_src_dir
    install_snap $php52_src_dir
    cleanup $php52_archive
fi

if [ "$build_state" = "all" -o "$build_state" = "53" ]; then

    echo "BUILDING PHP 5.3"

    setup_folders $php53_src_dir
    download_snaps $php53_archive $php53_snaps
    extract_snap $php53_archive $php53_src_dir
    install_snap $php53_src_dir
    cleanup $php53_archive
fi

if [ "$build_state" = "all" -o "$build_state" = "trunk" ]; then

    echo "BUILDING PHP HEAD"

    setup_folders $phptrunk_src_dir
    download_snaps $phptrunk_archive $phptrunk_snaps
    extract_snap $phptrunk_archive $phptrunk_src_dir
    install_snap $phptrunk_src_dir
    cleanup $phptrunk_archive
fi
