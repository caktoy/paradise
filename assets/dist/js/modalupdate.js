        $('#myModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('kode')
          var recipient2 = button.data('nama')
          // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          document.fedit.editkode.value = recipient;
          document.fedit.editnama.value = recipient2;
          //modal.find('.modal-body input').val(recipient)
        })