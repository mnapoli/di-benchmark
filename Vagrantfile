Vagrant.configure("2") do |config|

    config.vm.box = "precise32"
    config.vm.box_url = "http://files.vagrantup.com/precise32.box"

    $script = <<SCRIPT
# For PHP 5.5
apt-get update
apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php5
apt-get update

apt-get install -y curl git php5-curl php5-cli

echo 'opcache.enable_cli = 1' > /etc/php5/cli/conf.d/config.ini

# Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
SCRIPT

    config.vm.provision :shell, inline: $script

end
