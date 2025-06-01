document.addEventListener('DOMContentLoaded', () => {
    const modalToggles = document.querySelectorAll('[data-modal-toggle]');
    modalToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const modalId = toggle.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });

    const modalHides = document.querySelectorAll('[data-modal-hide]');
    modalHides.forEach(hide => {
        hide.addEventListener('click', () => {
            const modal = hide.closest('.fixed');
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });

    const editButtons = document.querySelectorAll('.edit-button');
    const editForm = document.getElementById('editForm');
    const editModal = document.getElementById('editClientModal');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const clientId = button.getAttribute('data-client-id');
            const clientFullname = button.getAttribute('data-client-fullname');
            const company = button.getAttribute('data-company');
            const position = button.getAttribute('data-position');
            const address = button.getAttribute('data-address');
            const phoneNumber = button.getAttribute('data-phone-number');
            const email = button.getAttribute('data-email');

            // Set form action
            editForm.action = `/clients/${clientId}`;

            // Populate form fields
            document.getElementById('edit_client_fullname').value = clientFullname;
            document.getElementById('edit_company').value = company;
            document.getElementById('edit_position').value = position;
            document.getElementById('edit_address').value = address;
            document.getElementById('edit_phone_number').value = phoneNumber;
            document.getElementById('edit_email').value = email;

            // Show modal
            editModal.classList.remove('hidden');
        });
    });

    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteForm = document.getElementById('deleteForm');
    const deleteModal = document.getElementById('deleteConfirmationModal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const clientId = button.getAttribute('data-client-id');
            deleteForm.action = `/clients/${clientId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    const modalHideButtons = document.querySelectorAll('[data-modal-hide]');
    modalHideButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.fixed');
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });
});