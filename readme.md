# Tech test colipays

### Installation

#### Étape 1 - Installer une stack Apache

#### Étape 2 - Création du .env et MAJ des infos de BDD à partir du .env.dist

#### Étape 3 - Installer les dépendences PHP
```sh
$ composer install
```

#### Étape 4 - Installer les dépendences JS
```sh
$ yarn 
```
#### Étape 5 - Compiler les assets
```sh
$ yarn run encore dev
```
#### Étape 6 - Créer la BDD et la MAJ
```sh
$ bin/console do:da:cr
$ bin/console do:sc:up --force
$ bin/console do:fi:lo
```

#### Étape 7 - Lancer le site