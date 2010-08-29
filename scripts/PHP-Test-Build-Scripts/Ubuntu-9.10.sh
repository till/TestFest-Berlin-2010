#!/usr/bin/env sh

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
gcov="no"

phptrunk_src_dir="php-trunk"

phptrunk_snaps="http://snaps.php.net/php-trunk-latest.tar.gz"
phptrunk_archive="php-trunk.tgz"

# Loop through the arguments and set state.
for arg; do
  case $arg in
    --help)
      help_state="yes" ;;
    --gcov)
      gcov="yes" ;;
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
  echo "  --gcov     = enable gcov"
  exit 0
fi

# Install required packages.
echo "Installing required packages."
sudo aptitude install autoconf build-essential libxml2-dev pkg-config
if [ "$?" -ne 0 ]; then echo "Failed installing required packages."; exit 1; fi

if [ -d $phptrunk_src_dir ]; then
  if [ $force_state = "yes" ]; then
    echo "Cleaning the \"${phptrunk_src_dir}\" directory."
    rm -rf "./${phptrunk_src_dir}/*"
    if [ "$?" -ne 0 ]; then echo "Failed while cleaning the \"${phptrunk_src_dir}\" directory."; fi
  else
    echo "Error: The directory \"${phptrunk_src_dir}\" already exists."
    echo "Either delete the directory or use --force to overwrite it."
    exit 1
  fi
else
  echo "Creating ${phptrunk_src_dir}."
  mkdir $phptrunk_src_dir
  if [ "$?" -ne 0 ]; then echo "Failed while creating the ${phptrunk_src_dir} directory."; fi
fi

if [ -f $phptrunk_archive ]; then
  if [ $cached_state = "no" ]; then
    rm -f $phptrunk_archive
    if [ "$?" -ne 0 ]; then echo "Failed removing old archive ${phptrunk_archive}."; fi
  fi
fi

if [ -f $phptrunk_archive -o ! $build_state = "all" -a ! $build_state = "trunk" ]; then
  echo "Skipping download of ${phptrunk_archive}."
else 
  echo "Downloading ${phptrunk_archive} from snaps.php.net."
  wget -O $phptrunk_archive $phptrunk_snaps
  if [ "$?" -ne 0 ]; then echo "Failed downloading ${phptrunk_archive} from php.snaps.net."; exit 1; fi
fi

echo "Extracting ${phptrunk_archive} source."
tar -xzf $phptrunk_archive --strip=1 -C "./${phptrunk_src_dir}"
if [ "$?" -ne 0 ]; then echo "Failed extracting ${phptrunk_archive}."; fi

cd ${phptrunk_src_dir}
if [ "$?" -ne 0 ]; then echo "Failed to change directory to ${phptrunk_src_dir}."; fi

echo "Configuring the PHP Trunk source."
config_line="--prefix=/usr/local/$phptrunk_src_dir --enable-bcmath --enable-calendar --enable-ftp --enable-shmop --enable-sockets --enable-exif --with-zlib --with-kerberos --enable-wddx --enable-zip --with-mime-magic --enable-mbstring --enable-mbregex --enable-pcntl --enable-sysvsem --enable-sysvshm --enable-sysvmsg --with-regex --enable-soap"
if [ $gcov = "yes" ]; then
  $config_line="$config_line --enable-gcov"
fi

./configure $config_line
if [ "$?" -ne 0 ]; then echo "Failed to configure the PHP Trunk source."; fi

echo "Building the PHP Trunk binary."
make
if [ "$?" -ne 0 ]; then echo "Failed to build the PHP Trunk binary."; fi

cd ../


# Remove archives.
if [ $cached_state = "no" ]; then
  echo "Cleaning up ${phptrunk_archive}."
  rm -f $phptrunk_archive
  if [ "$?" -ne 0 ]; then echo "Failed to remove ${phptrunk_archive}."; fi
fi
