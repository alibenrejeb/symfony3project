# Installation
## 1. Récupérer le code
Vous avez deux solutions pour le faire :

1. Via Git, en clonant ce dépôt ;
2. Via le téléchargement du code source en une archive ZIP, à cette adresse : https://github.com/alibenrejeb/symfony3project/archive/master.zip

## 2. Définir vos paramètres d'application
Pour ne pas qu'on se partage tous nos mots de passe, le fichier `app/config/parameters.yml` est ignoré dans ce dépôt. A la place, vous avez le fichier `parameters.yml.dist` que vous devez renommer (enlevez le `.dist`) et modifier.

## 3. Télécharger les vendors
Avec Composer bien évidemment :

    php composer.phar install

## 4. Créez la base de données
Si la base de données que vous avez renseignée dans l'étape 2 n'existe pas déjà, créez-la :

    php bin/console doctrine:database:create

Puis créez les tables correspondantes au schéma Doctrine :

    php bin/console doctrine:schema:update --dump-sql
    php bin/console doctrine:schema:update --force

Enfin, éventuellement, ajoutez les fixtures :

    php bin/console doctrine:fixtures:load

## 5. Publiez les assets
Publiez les assets dans le répertoire web :

    php bin/console assets:install web

# Manipuler les utilisateurs avecFOSUserBundle

Nous allons voir les moyens pour manipuler vos utilisateurs au quotidien.

Si les utilisateurs sont gérés parFOSUserBundle, ils ne restent que des entités Doctrine2 des plus classiques. Ainsi, vous pourriez très bien vous créer un repository comme vous savez le faire. Cependant, profitons du fait que le bundle intègre unUserManager(c'est une sorte de repository avancé). Ainsi, voici les principales manipulations que vous pouvez faire avec :
    <?php
    // Dans un contrôleur :
    
    // Pour récupérer le service UserManager du bundle
    $userManager = $this->get('fos_user.user_manager');
    
    // Pour charger un utilisateur
    $user = $userManager->findUserBy(array('username' => 'ali'));
    
    // Pour modifier un utilisateur
    $user->setEmail('b.rejeb.ali@gmail.com');
    $userManager->updateUser($user); // Pas besoin de faire un flush avec l'EntityManager, cette méthode le fait toute seule !
    
    // Pour supprimer un utilisateur
    $userManager->deleteUser($user);
    
    // Pour récupérer la liste de tous les utilisateurs
    $users = $userManager->findUsers();
Si vous avez besoin de plus de fonctions, vous pouvez parfaitement faire un repository personnel, et le récupérer comme d'habitude via
    
    $this->getDoctrine()->getManager()->getRepository('OCUserBundle:User')

## Lien utils

[Symfony2 authentification perso](https://openclassrooms.com/forum/sujet/symfony2-authentification-perso-avec-service-web)

[authentification provider](https://blog.vandenbrand.org/2012/06/19/symfony2-authentication-provider-authenticate-against-webservice/)

1 - Qu'est-ce qu'un fournisseur d'utilisateurs, concrètement ?
 Un fournisseur d'utilisateurs est une classe qui implémente l'interface UserProviderInterface, qui contient juste trois méthodes : 
 * loadUserByUsername($username), qui charge un utilisateur à partir d'un nom d'utilisateur ;
 * refreshUser($user), qui rafraîchit un utilisateur avec les valeurs d'origine ;
 * supportsClass(), qui détermine quelle classe d'utilisateurs gère le fournisseur.

2 - Le rôle IS_AUTHENTICATED_REMEMBEREDest donné à un utilisateur qui s'est authentifié soit automatiquement grâce au cookieremember_me, soit en utilisant le formulaire de connexion. Le rôleIS_AUTHENTICATED_FULLYest donné à un utilisateur qui s'est obligatoirement authentifié manuellement, en rentrant son mot de passe dans le formulaire de connexion. C'est utile pour protéger les opérations sensibles comme le changement de mot de passe ou d'adresse e-mail.
## Et profitez !