depot-robot
===========


Le robot démarre tout seul.

Il indexera le site ainsi que tout les liens de ce site si il ne trouve pas les 3 balises keywords title et description il ne l’insérera pas dans la base.

il continuera d’indexer par la suite les URL jusqu’a qu’il tombe sur une URL qui contiennent les 3 balises.

Si le site est indexer plusieurs fois il sera indiquer dans la base dans la colonne indexer.

Si le robot tombe sur une image il va automatiquement s’arrêter un formulaire est prévu pour ce cas afin de rentrer une autre URL.

il s’arrêtera également si il ne trouve rien dans des URL.

__________________________________________

Cheminement de l'utilisation du Framework CakePHP
__________________________________________


Afin de chercher un mot clés un formulaire est prévu. il est dans l'URL suivant searches(qui est le controller)/index(qui est l'action)

L'intégrité du champs de mot clés dans le formulaire est gérer grace a la variable validate inclus dans le model. 

Pour lancer le robot un lien est prévu sur la page index Mon Robot qui est sur la navbar
le principe du robot ne change pas. 

Lorsque l'on a lancer le robot on l'arrête en allant sur la page index en cliquant sur le lien de la navbar Mon Google qui nous ramène vers la page index.

La pagination n'a pas était gérer.