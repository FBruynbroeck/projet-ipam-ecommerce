Installation
============

- git clone https://github.com/FBruynbroeck/projet-ipam-ecommerce

- Editer le fichier models/db.php. Modifier le login/pass pour la connexion à la db en ligne 5 (par défaut: login: 'root', password: 'password').
```
$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
```

- importer le dump qui se trouve à la racine du répertoire (dump.sql).

- Créer un nouveau host dans /etc/hosts.
```
127.0.0.1 projet.local
```

- Créer un vhost pour votre projet.
```
<VirtualHost *:80>
  ServerName projet.local
  DocumentRoot "/home/monuser/projet-ipam-ecommerce/"
  DirectoryIndex index.php
</VirtualHost>
```

Test
====

User de test 'Admin':
- login: toto
- password: tata

User de test 'Client':
- login: test
- password: test
