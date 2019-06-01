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



