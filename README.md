# Astuces ou feuilles de triche pour laravel

## Structure

Laravel suit l'architecture MVC, qui est une architecture dans le developpement Web qui est utilisées par plein de framework par plein de Language différent; cet architecture nous permet d'organiser notre code et elle sépare le code en 3 grandes parties:
MVC

`M=>'Models'`: Qui concerne l'accés à la base de donnée, la récupération des données, l'enregistrement,...(Pour laravel c'est le dossier `app` sur tous à sa racine)
`V=>'Views'`: Donc tous ce qui concerne notre HTML, donc les rendus visuelles, pour laravel c'est le dossier `views` dans `ressources` et qui on une extension `.blade.php`
`C=>'Controllers'`: Qui va faire le lien entre la vue et le modèle, pour laravel c'est la le dossier `routes` dans le fichier `web.php` dans les fonctions anonymes qu'on passe à la routes après le chemin où on veut aller.

On peut arranger nos `Controllers` dans des fichiers séparer pour pour ne pas les mélanger dans le fichier `web.php` car on ne va pas coder notre application dans le fichier `web.php` et pour ça Laravel nous fournit un moyen d'organiser nos controllers et pour ça on va créer un fichier par type de controlleurs par exemple un `ControllerUtilisateur,ControllerInscription,...`

Pour créer un controlleur Laravel nous fournit une commande `artisan` pour créer un controlleur et le controlleur créer sera stocker dans le dossier `app/Http/Controllers`, le controlleur créer est une simple classe PHP

Les migrations permet de decrire un changement de votre base de donnée, ca peut etre

- Creer une table
- Supprimer une table
- Ajouter une colonne à une table existante
- Supprimer une colonne d'une table
- ... Beaucoup des choses

## Commande courrant sur Laravel

`php artisan serve`: Pour ouvrir le serveur laravel sur le port 3000 ou 8000 qui sont les port par defaut

`php artisan migrate:status`: Permet de tester ou de verifier si tout fonctionne au niveau des migrations,
 si cette commande retourne une erreur cela veut dire que soit la base de donnée n'existe pas ou il y a une erreur au niveau de la base de données soit tout va bien.

 Si la base de donnée est vide mais qu'elle existe, cette commande retourne `"No migrations found."`, ce message nous indique que Laravel a reussi à se connecter à la base de donnée mais que cette base est vide pour le moment.

 `php artisan make:migration create_NomDelaMigrations_table`: Permet de creer une nouvelle migration de Laravel, en faisant cette commande laravel comprend que vous voulez créer une nouvelle table et va automatiquement la nommer avec le nom de votre migration, cette migration sera enregistrer dans le dossier `database/migrations`.

`php artisan migrate`: Permet d'executer toutes les migrations càd quand il faut creer une nouvelle table,supprimer une table, ajouter ou supprimer une colonne d'une colonne d'une table

`php artisan make:controller NomController`: Permet de creer un controlleur avec comme nom `Nom` suivit de `Controller`

## Les règles de validation de Laravel

`Required,Date,Integer, IP address, E-mail, Confirmed`

## Authentification avec Laravel

Laravel a un système d'authentification qui nous simplifie beaucoup les choses.

Pour recuperer le système d'authentification de Laravel on a une fonction qui s'appel `auth()` qui est un peu comme la fonction `request()` qui nous permet de recuperer la requete de l'utilisateur, la fonction `auth()` nous permet de recuperer le système d'authentification de Laravel.

Cette fonction `auth()` contient plusieurs methodes pratiques, nous seules sur laquelle on va commencer c'est la methode `attempt()`, cette methode permet de tester, d'essayer une connexion avec les parametres que l'on va lui donner et si ça fonctionne la personne sera autorisée ou authentifier sur le site et elle pourra naviguer de page en page en temps que membre authentifier, si ça echoue cette methode `attempt()` va nous retourner `false` et on pourra afficher à l'utilisateur un message d'erreur.

La fonction `attempt()` prend un tableau de parametre et dans ce tableau on va lui passer les parametres de l'utilisateurs à authentifier, par exemple

```{PHP}
    [
        'email'=>request('email'),
        'password'=>request('password')
    ]
```

Puisque vous faite de l'authentification il faut aussi modifier dans la configuration dans le fichier `auth.php` la classe des utilisateurs par defaut de Laravel pour l'authentification des utilisateurs par votre propre classe d'utilisateur si vous voulez le changer et cela dans la partie `providers` qui est un tableau contenant les configuration en question, la classe configurer doit implementer l'interface `Authenticatable` et cela permet de dire à Laravel `"OKAY ma classe du Model est authentifiable"` et du coup elle sera authorisée à etre authentifier.

Etant donnée que `Authenticatable` est une interface, elle necessite que la classe qui l'implement aie les fonctions nécessaires.

L'interface `Authenticatable` contient 6 methodes abstraite qui doivent etre présente dans la classe qui l'implémente.

Mais là aussi Laravel nous offre un moyen plus simple qui nous evite d'ecrire tous ces 6 fonctions de l'interface `Authenticatable` et pour ça à l'interieur de votre classe cible qui implemente l'interface  il faut faire un `use Authenticatable` meme si cette classe a le meme nom que l'interface `Authenticatable` sachez qu'elle sont differentes car elles se trouvent dans des namespace differents dont si il faudra les importer dans un meme fichier il faudra utiliser le systeme des `Alias` pour nommer une d'elle differemment.

Si dans les methodes à implémente il y a celles qu'il faut modifier, vous pouvez le faire sans problème en redéfinissant cette methodes en questions.

## Rediriger un utilisateur après un formulaire

Pour faire une redirection avec Laravel on utilise la fonction `redirect()` qui prend en parametre un chemin vers lequel on veut rediriger l'utilisateur, le statut qu'on veut emmettre, les en-tetes à envoyer, si oui ou non la redirection doit etre securiser.

Si on veut revenir en arriere vers le lien ou l'adresse précedent on utilise la fonction `back()` noter que sur cette fonction `back()` on peut utiliser des methodes comme `withInput()` pour avoir les données entrer dans le formulaire par l'utilisateur dans la fonction `old()` mais aussi on peut aussi y utiliser la methodes `withErrors()` pour avoir les erreurs qui ont eu lieu dans la page precedent la redirection et noter aussi que la fonction `withErrors()` prend un tableau dont la clé est le nom de l'erreur et la valeur est l'erreur en question

## Verifier si un utilisateur est connecter avec LARAVEL

Pour faire cela on peut transformer notre route en un controlleur comme par exemple `Route::post('/login','ConnexionController@login');` ie quand on a un chemin on appel le controlleur specifique
Pour verifier que un utilisateur est connecter on utilise encore la fonction `auth()` sur laquelle on utilise la fonction `check()` ie `auth()->check()`, on a aussi une methode qui est `guest()` permet de verifier si un utilisateur est un visiteur non-connecter et dans ce cas elle retournera vrais si l'utilisateur est juste un inviter et false si il est dejà connecter ie `auth()->guest()`
Pour deconnecter l'utilisateur connecter on utiliser sur la fonction `auth()` la methode `logout()` ie `auth()->logout()`
