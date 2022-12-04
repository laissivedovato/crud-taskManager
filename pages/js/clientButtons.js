// variables used to active/deactive buttons
const buttonsActive = document.querySelectorAll('button.btn-activate-client');
const buttonsDeactive = document.querySelectorAll('button.btn-deactivate-client');

// variables used to change values in clients requisitions
const clientIdInput = document.getElementById('clientIdInput');
const toggleActivateClientInput = document.getElementById('toggleActivateClientInput');
const modalHeader = document.getElementById('toggleActivateClientModalLabel');
const modalBody = document.getElementById('modalBody');

// deactive modal´s function for each button returned
buttonsDeactive.forEach(function (buttonDeactive) {
  // on click, handles the values used for requisitions and sets info texts
  buttonDeactive.addEventListener('click', function() {
    clientIdInput.value = buttonDeactive.dataset.client_id;
    toggleActivateClientInput.value = 'deactivate';

    // sets the return texts
    modalHeader.innerHTML = 'Desativar clientes';
    modalBody.innerHTML = 'Deseja desativar este cliente?'
  })
});

// active modal´s function for each button returned
buttonsActive.forEach(function (buttonActive) {
  // on click, handles the values used for requisitions and sets info texts
  buttonActive.addEventListener('click', function() {
    clientIdInput.value = buttonActive.dataset.client_id;
    toggleActivateClientInput.value = 'activate';

    // sets the return texts
    modalHeader.innerHTML = 'Ativar clientes';
    modalBody.innerHTML = 'Deseja ativar este cliente?'
  })
});
