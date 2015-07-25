# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "debian/wheezy64"

  config.vm.define "web", primary: true do |web|
    web.vm.provider :virtualbox do |vb|
      vb.customize [
        "modifyvm", :id,
        "--name", "drupal_web",
        "--memory", "1024"
      ]
    end
    web.vm.network :forwarded_port, guest: 80, host: 8080
    web.vm.network :private_network, ip: "192.168.10.2"    # for NFS
    web.vm.synced_folder ".", "/var/www", :nfs => true
  end

  config.vm.define "db" do |db|
    db.vm.provider :virtualbox do |vb|
      vb.customize [
        "modifyvm", :id,
        "--name", "drupal_db",
      ]
    end
    db.vm.network :private_network, ip: "192.168.10.3"
    db.vm.network :forwarded_port, guest: 3306, host: 3306
  end

  config.vm.provision :ansible do |ansible|
    ansible.playbook = "provisioning/playbook.yml"
    ansible.groups = {
      "webservers" => ["web"],
      "dbservers" => ["db"],
      "all:children" => ["web", "db"]
    }
    ansible.host_key_checking = false
  end
end
