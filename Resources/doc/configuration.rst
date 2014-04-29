O2 User Bundle COnfiguration
============================

Désactiver le champ "username" dans FOS User Bundle pour n'utiliser que l'e-mail dans les formulaires utilisateurs
------------------------------------------------------------------------------------------------------------------
En fonction de votre application, vous pouvez avoir besoin de supprimer le nom d'utilisateur (champ "username") de FOS User Bundle pour n'utiliser que l'e-mail.
Pour ce faire, il suffit de rajouter à la configuration de O2 User Bundle le paramètre email_as_username et le mettre à true.

.. code-block:: yaml

   o2_user:
       email_as_username: true
       
Par défaut email_as_username est à false.