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
    const deleteButtons = document.querySelectorAll('.delete-button');
    const editForm = document.getElementById('editForm');
    const deleteForm = document.getElementById('deleteForm');
    const editModal = document.getElementById('editUserModal');
    const deleteModal = document.getElementById('deleteConfirmationModal');

    // Handle Edit Button Click
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-user-id');
            const fullname = button.getAttribute('data-fullname');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');

            // Set form action
            editForm.action = `/users/${userId}`;

            // Populate form fields
            document.getElementById('edit_fullname').value = fullname;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;

            // Show modal
            editModal.classList.remove('hidden');
        });
    });

    // Handle Delete Button Click
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-user-id');
            deleteForm.action = `/users/${userId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    // Handle Modal Hide
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