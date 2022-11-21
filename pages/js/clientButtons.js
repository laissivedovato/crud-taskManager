
// variables to active/deactive buttons
const buttonsActive = document.querySelectorAll('button.btn-activate-client');
const buttonsDeactive = document.querySelectorAll('button.btn-deactivate-client');

const clientIdInput = document.getElementById('clientIdInput');
const toggleActivateClientInput = document.getElementById('toggleActivateClientInput');
const modalHeader = document.getElementById('toggleActivateClientModalLabel');
const modalBody = document.getElementById('modalBody');

// deactive modal´s function
buttonsDeactive.forEach(function (buttonDeactive) {
  buttonDeactive.addEventListener('click', function() {
    clientIdInput.value = buttonDeactive.dataset.client_id;
    toggleActivateClientInput.value = 'deactivate';

    modalHeader.innerHTML = 'Desativar clientes';
    modalBody.innerHTML = 'Deseja desativar este cliente?'
  })
});

// active modal´s function
buttonsActive.forEach(function (buttonActive) {
  buttonActive.addEventListener('click', function() {
    clientIdInput.value = buttonActive.dataset.client_id;
    toggleActivateClientInput.value = 'activate';

    modalHeader.innerHTML = 'Ativar clientes';
    modalBody.innerHTML = 'Deseja ativar este cliente?'
  })
});
