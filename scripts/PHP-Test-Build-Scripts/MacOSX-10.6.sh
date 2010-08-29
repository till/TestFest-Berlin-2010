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

php52_src_dir="php52"
php53_src_dir="php53"
phptrunk_src_dir="php-trunk"

php52_snaps="http://snaps.php.net/php5.2-latest.tar.gz"
php52_archive="php52.tgz"
php53_snaps="http://snaps.php.net/php5.3-latest.tar.gz"
php53_archive="php53.tgz"
phptrunk_snaps="http://snaps.php.net/php-trunk-latest.tar.gz"
phptrunk_archive="php-trunk.tgz"

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


# Setting up folders.
if [ -d $php52_src_dir ]; then
  if [ $force_state = "yes" ]; then
    echo "Cleaning the \"${php52_src_dir}\" directory."
    rm -rf "./${php52_src_dir}/*"
    if [ "$?" -ne 0 ]; then echo "Failed while cleaning the \"${php52_src_dir}\" directory."; exit 1; fi
  else
    echo "Error: The directory \"${php52_src_dir}\" already exists."
    echo "Either delete the directory or use --force to overwrite it."
    exit 1
  fi
else
  echo "Creating ${php52_src_dir}."
  mkdir $php52_src_dir
  if [ "$?" -ne 0 ]; then echo "Failed while creating the ${php52_src_dir} directory."; exit 1; fi
fi

if [ -d $php53_src_dir ]; then
  if [ $force_state == "yes" ]; then
    echo "Cleaning the \"${php53_src_dir}\" directory."
    rm -rf "./${php53_src_dir}/*"
    if [ "$?" -ne 0 ]; then echo "Failed while cleaning the \"${php53_src_dir}\" directory."; exit 1; fi
  else
    echo "Error: The directory \"${php53_src_dir}\" already exists."
    echo "Either delete the directory or use --force to overwrite it."
    exit 1
  fi
else
  echo "Creating ${php53_src_dir}."
  mkdir $php53_src_dir
  if [ "$?" -ne 0 ]; then echo "Failed while creating the ${php53_src_dir} directory."; exit 1; fi
fi

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
if [ -f $php52_archive ]; then
  if [ $cached_state == "no" ]; then
    rm -f $php52_archive
    if [ "$?" -ne 0 ]; then echo "Failed removing old archive ${php52_archive}."; exit 1; fi
  fi
fi

if [ -f $php52_archive ]; then
  echo "Skipping download of ${php52_archive}."
else 
  echo "Downloading ${php52_archive} from snaps.php.net."
  curl $php52_snaps > $php52_archive
  if [ "$?" -ne 0 ]; then echo "Failed downloading ${php52_archive} from php.snaps.net."; exit 1; fi
fi

if [ -f $php53_archive ]; then
  if [ $cached_state == "no" ]; then
    rm -f $php53_archive
    if [ "$?" -ne 0 ]; then echo "Failed removing old archive ${php53_archive}."; exit 1; fi
  fi
fi

if [ -f $php53_archive ]; then
  echo "Skipping download of ${php53_archive}."
else 
  echo "Downloading ${php53_archive} from snaps.php.net."
  curl $php53_snaps > $php53_archive
  if [ "$?" -ne 0 ]; then echo "Failed downloading ${php53_archive} from php.snaps.net."; exit 1; fi
fi

if [ -f $phptrunk_archive ]; then
  if [ $cached_state == "no" ]; then
    rm -f $phptrunk_archive
    if [ "$?" -ne 0 ]; then echo "Failed removing old archive ${phptrunk_archive}."; exit 1; fi
  fi
fi

if [ -f $phptrunk_archive ]; then
  echo "Skipping download of ${phptrunk_archive}."
else 
  echo "Downloading ${phptrunk_archive} from snaps.php.net."
  curl $phptrunk_snaps > $phptrunk_archive
  if [ "$?" -ne 0 ]; then echo "Failed downloading ${phptrunk_archive} from php.snaps.net."; exit 1; fi
fi


# Extract archives into source directories.
echo "Extracting ${php52_archive} source."
tar -xzf $php52_archive --strip=1 -C "./${php52_src_dir}"
if [ "$?" -ne 0 ]; then echo "Failed extracting ${php52_archive}."; exit 1; fi

echo "Extracting ${php53_archive} source."
tar -xzf $php53_archive --strip=1 -C "./${php53_src_dir}"
if [ "$?" -ne 0 ]; then echo "Failed extracting ${php53_archive}."; exit 1; fi

echo "Extracting ${phptrunk_archive} source."
tar -xzf $phptrunk_archive --strip=1 -C "./${phptrunk_src_dir}"
if [ "$?" -ne 0 ]; then echo "Failed extracting ${phptrunk_archive}."; exit 1; fi


# Configure and build PHP.
cd $php52_src_dir
if [ "$?" -ne 0 ]; then echo "Failed to change directory to ${php52_src_dir}."; exit 1; fi

echo "Configuring the PHP 5.2 source."
./configure --prefix=/usr/local/$php52_src_dir --with-apxs2 --enable-cli --with-openssl --with-kerberos --with-zlib --enable-bcmath --with-bz2 --enable-calendar --with-curl --enable-exif --enable-ftp --with-ldap --with-ldap-sasl --enable-mbstring --enable-mbregex --with-iodbc --enable-shmop --with-snmp --enable-soap --enable-sockets --enable-sysvmsg --enable-sysvsem --enable-sysvshm --with-xmlrpc --with-iconv --with-xsl
if [ "$?" -ne 0 ]; then echo "Failed to configure the PHP 5.2 source."; exit 1; fi

echo "Building the PHP 5.2 binary."
make
if [ "$?" -ne 0 ]; then echo "Failed to build the PHP 5.2 binary."; exit 1; fi

cd "../${php53_src_dir}"
if [ "$?" -ne 0 ]; then echo "Failed to change directory to ${php53_src_dir}."; exit 1; fi

echo "Configuring the PHP 5.3 source."
./configure --prefix=/usr/local/$php53_src_dir --with-apxs2 --enable-cli --with-openssl --with-kerberos --with-zlib --enable-bcmath --with-bz2 --enable-calendar --with-curl --enable-exif --enable-ftp --with-ldap --with-ldap-sasl --enable-mbstring --enable-mbregex --with-iodbc --enable-shmop --with-snmp --enable-soap --enable-sockets --enable-sysvmsg --enable-sysvsem --enable-sysvshm --with-xmlrpc --with-iconv --with-xsl
if [ "$?" -ne 0 ]; then echo "Failed to configure the PHP 5.3 source."; exit 1; fi

echo "Building the PHP 5.3 binary."
make
if [ "$?" -ne 0 ]; then echo "Failed to build the PHP 5.3 binary."; exit 1; fi

cd "../${phptrunk_src_dir}"
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
  echo "Cleaning up ${php52_archive}."
  rm -f $php52_archive
  if [ "$?" -ne 0 ]; then echo "Failed to remove ${php52_archive}."; exit 1; fi
  
  echo "Cleaning up ${php53_archive}."
  rm -f $php53_archive
  if [ "$?" -ne 0 ]; then echo "Failed to remove ${php53_archive}."; exit 1; fi
  
  echo "Cleaning up ${phptrunk_archive}."
  rm -f $phptrunk_archive
  if [ "$?" -ne 0 ]; then echo "Failed to remove ${phptrunk_archive}."; exit 1; fi
fi