# MY PROJECT !!!!!!!!

Please set
git rm -r --cached .c9/

and use git add and commit

## INSTALL mysql

mysql-ctl install
### START mysql
mysql-ctl start
### STOP MySQL
mysql-ctl stop
### run the MySQL interactive shell
mysql-ctl cli
### get username
echo $C9_USER
### get host
echo $IP
### install phpmyadmin
phpmyadmin-ctl install

---

### Git Commands

#### Rebase & Merge Branch
git checkout dev

git rebase master < or Another branch > < if can't rebase. Please, check commit >

git checkout master

git merge --no-ff dev 


#### Show log graph
git log --oneline --graph
