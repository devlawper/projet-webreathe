# projet-webreathe
Développement d'un site web de gestion de maintenance des véhicules d'un réseau de transport

3 types d'accès:
    - Administrateur (1 seul : login : contact@devlawper.com // mdp : webreathe)
    - Gestionnaire (Login : adresse mail // mdp : premiere lettre du prénom suivi du nom ex : nfrero)
    - Technicien (idem gestionnaire)
Menu personnalisé pour chacun en fonction des droits et accès

ADMINISTRATEUR :
- Peut Ajouter / Modifier / Supprimer un gestionnaire ou un technicien
- N'a pas accès a la liste et détails des véhicules et opérations

GESTIONNAIRE : 
- Peut Ajouter / Modifier / Supprimer un véhicule
- A accès a la liste et détails des véhicules et opérations mais ne peut pas en ajouter ou modifier
- Ne peut pas Ajouter / Modifier / Supprimer un gestionnaire ou un technicien

TECHNICIEN : 
- Peut Ajouter / Modifier / Supprimer une opération de maintenance (avec liste de pièce, photo et note)
- Ne peut pas Ajouter / Modifier / Supprimer un gestionnaire ou un technicien


Améliorations restantes :
- Rendre le site responsive (10h00 mini si il faut tout reprendre, sinon prévoir à la conception)
- Pouvoir ajouter plusieurs pièces, photos et notes en même temps sur une opération (3h00)
- Avoir accès aux stats par mois sur le tableau de bord (2h00)
- Gestion de l'affiche si très grande flotte de véhicules (ne pas afficher 100 véhicules sur une même page) (3h00)
- Pouvoir retrouver un véhicule, gestionnaire ou techniciens avec un champ de recherche (7h00)
- Faire évoluer le design (5h00)
- Faire un test complet du site et apporter les corrections(7h00 si tout n'est pas à refaire :-) )

Ressenti par rapport au test : 
- J'ai pris beaucoup de plaisir à réaliser ce test, n'étant pas graphiste, une des difficultés que j'ai rencontré est la design et les couleurs. J'ai tenté de faire simple et lisible.
- La gestion de la base de donnée et relativement importante et représente un grosse partie du travail, même si je pense qu'elle pourrait être plus étoffée (détails plus précis sur les véhicules notamment).
- Le graphique m'a demandé quelques recherches, j'ai trouvé une librairie : canvasJS qui m'a permis de faire ça mais je pense que c'est perfectible !
- Afin d'y voir clair, je n'a pas surchargé les infos en base de donnée, ainsi vous pourrez faire les tests sur les ajouts et modifs qu'il est possible de faire.
- J'ai testé un panel de class que j'ai créé en SCSS sur une base de Bootstrap. Le fait personnaliser le CSS permet d'eviter le charger plusieurs centaines de lignes de CCS prédéfinies pour rien.
- Au total, le projet m'a pris 21h00 de travail pour vous donner une idée.
