# Purchase Order / Contact Check Lists

⋅⋅⋅ Please set

* git rm -r --cached .c9/

⋅⋅⋅ and use git add and commit

---

## INSTALL mysql
* mysql-ctl install

#### START mysql
* mysql-ctl start

#### STOP MySQL
* mysql-ctl stop

#### Run the MySQL interactive shell
* mysql-ctl cli

#### Get username
* echo $C9_USER

#### Get host
* echo $IP

#### Install phpmyadmin

* phpmyadmin-ctl install

---

## Git Commands

#### Rebase & Merge Branch
* git checkout dev

* git rebase master < or Another branch > < if can't rebase. Please, check commit >

* git checkout master

* git merge --no-ff dev 

#### Show log graph
* git log --oneline --graph
