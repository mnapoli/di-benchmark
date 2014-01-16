Vagrant.configure("2") do |config|

    config.vm.box = "precise32"
    config.vm.box_url = "http://files.vagrantup.com/precise32.box"

    config.vm.network :private_network, ip: "192.168.56.101"
    config.vm.network :forwarded_port, guest: 80, host: 8000
    config.ssh.forward_agent = true

    $script = <<SCRIPT
# For PHP 5.5
apt-get update
apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php5
apt-get update

apt-get install -y curl git apache2 apache2-utils php5 php5-curl php5-cli

ln -s /vagrant/web /var/www/di-benchmark

# Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
SCRIPT

    config.vm.provision :shell, inline: $script

end
