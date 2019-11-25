# wp-docker
wordpress

https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-debian-9
```
sudo apt update
sudo apt install apt-transport-https ca-certificates curl gnupg2 software-properties-common
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
sudo apt update'

apt-cache policy docker-ce


sudo apt install docker-ce
sudo systemctl status docker
sudo systemctl status docker