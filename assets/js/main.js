//! JQUERY POUR LA SUPRESSION
// fonction jquery recuperer sur bootstrap
//permet de passer en POST l'id voulu.
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Bouton qui a déclenché le modal
    var recipient = button.data('id') // Extraire les informations des attributs data- *
    var type = button.data('type') // Extraire les informations des attributs data- *
    //Mettre à jour le contenu du modal. Nous utiliserons jQuery ici
    var modal = $(this)
    modal.find('#recipient-name').val(recipient);
    modal.find('#recipient-type').val(type);
  });



