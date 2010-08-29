#!/usr/bin/env sh

################################################################################
# PURPOSE: Builds a PHP testing environment for Mac OS X 10.6.                 #
# REQUIREMENTS: Mac OS X 10.6, Xcode 3                                         #
# NOTE: Please see the accompanying README.txt for further details regarding   #
#  these scripts.                                                              #
# AUTHOR: Eric Lee Stewart <ericleestewart@gmail.com>                          #
################################################################################

# Set default states.
help_state="no"
cached_state="no"
build_state="all"
force_state="no"

phptrunk_src_dir="php-trunk"

phptrunk_snaps="http://snaps.php.net/php-trunk-latest.tar.gz"
phptrunk_archive="php-trunk.tgz"

# Loop through the arguments and set state.
for arg; do
  case $arg in
    --help)
      help_state="yes" ;;
    --cached)
      cached_state="yes" ;;
    --force)
      force_state="yes" ;;
  esac
done


# Show help.
if [ $help_state = "yes" ]; then
  echo "Usage: $0 [options]"
  echo "  --help     = Show usage and options."
  echo "  --cached   = Attempt to use a cached file, keep downloads cached."
  echo "  --force    = Overwrite existing files if present."
  exit 0
fi


# Setting up folders.
if [ -d $phptrunk_src_dir ]; then
  if [ $force_state == "yes" ]; then
    echo "Cleaning the \"${phptrunk_src_dir}\" directory."
    rm -rf "./${phptrunk_src_dir}/*"
    if [ "$?" -ne 0 ]; then echo "Failed while cleaning the \"${phptrunk_src_dir}\" directory."; exit 1; fi
  else
    echo "Error: The directory \"${phptrunk_src_dir}\" already exists."
    echo "Either delete the directory or use --force to overwrite it."
    exit 1
  fi
else
  echo "Creating ${phptrunk_src_dir}."
  mkdir $phptrunk_src_dir
  if [ "$?" -ne 0 ]; then echo "Failed while creating the ${phptrunk_src_dir} directory."; exit 1; fi
fi


# Download snaps if not already available.
if [ -f $phptrunk_archive ]; then
  echo "Skipping download of ${phptrunk_archive}."
else 
  echo "Downloading ${phptrunk_archive} from snaps.php.net."
  curl $phptrunk_snaps > $phptrunk_archive
  if [ "$?" -ne 0 ]; then echo "Failed downloading ${phptrunk_archive} from php.snaps.net."; exit 1; fi
fi


# Extract archives into source directories.
echo "Extracting ${phptrunk_archive} source."
tar -xzf $phptrunk_archive --strip=1 -C "./${phptrunk_src_dir}"
if [ "$?" -ne 0 ]; then echo "Failed extracting ${phptrunk_archive}."; exit 1; fi


# Configure and build PHP.
cd ${phptrunk_src_dir}
if [ "$?" -ne 0 ]; then echo "Failed to change directory to ${phptrunk_src_dir}."; exit 1; fi

echo "Configuring the PHP Trunk source."
./configure --prefix=/usr/local/$phptrunk_src_dir --with-apxs2 --enable-cli --with-openssl --with-kerberos --with-zlib --enable-bcmath --with-bz2 --enable-calendar --with-curl --enable-exif --enable-ftp --with-ldap --with-ldap-sasl --enable-mbstring --enable-mbregex --with-iodbc --enable-shmop --with-snmp --enable-soap --enable-sockets --enable-sysvmsg --enable-sysvsem --enable-sysvshm --with-xmlrpc --with-iconv --with-xsl
if [ "$?" -ne 0 ]; then echo "Failed to configure the PHP Trunk source."; exit 1; fi

echo "Building the PHP Trunk binary."
make
if [ "$?" -ne 0 ]; then echo "Failed to build the PHP Trunk binary."; exit 1; fi

cd ../


# Remove archives.
if [ $cached_state == "no" ]; then
  echo "Cleaning up ${phptrunk_archive}."
  rm -f $phptrunk_archive
  if [ "$?" -ne 0 ]; then echo "Failed to remove ${phptrunk_archive}."; exit 1; fi
fi