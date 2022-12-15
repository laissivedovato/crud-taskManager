// variables used to active/deactive buttons
const buttonsActive = document.querySelectorAll('button.btn-activate-project');
const buttonsDeactive = document.querySelectorAll('button.btn-deactivate-project');

// variables used to change values in clients requisitions
const projectIdInput = document.getElementById('projectIdInput');
const toggleActivateClientInput = document.getElementById('toggleActivateProjectInput');
const modalHeader = document.getElementById('toggleActivateProjectModalLabel');
const modalBody = document.getElementById('modalBody');

// deactive modal´s function for each button returned
buttonsDeactive.forEach(function (buttonDeactive) {
  // on click, handles the values used for requisitions and sets info texts
  buttonDeactive.addEventListener('click', function() {
    projectIdInput.value = buttonDeactive.dataset.project_id;
    toggleActivateProjectInput.value = 'deactivate';

    // sets the return texts
    modalHeader.innerHTML = 'Desativar projeto';
    modalBody.innerHTML = 'Deseja desativar este projeto?'
  })
});

// active modal´s function for each button returned
buttonsActive.forEach(function (buttonActive) {
  // on click, handles the values used for requisitions and sets info texts
  buttonActive.addEventListener('click', function() {
    projectIdInput.value = buttonActive.dataset.project_id;
    toggleActivateProjectInput.value = 'activate';

    // sets the return texts
    modalHeader.innerHTML = 'Ativar projeto';
    modalBody.innerHTML = 'Deseja ativar este projeto?'
  })
});
