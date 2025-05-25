document.addEventListener('DOMContentLoaded', () => {
    const modalToggles = document.querySelectorAll('[data-modal-toggle]');
    modalToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const modalId = toggle.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
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

    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteForm = document.getElementById('deleteForm');
    const deleteModal = document.getElementById('deleteConfirmationModal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const materialId = button.getAttribute('data-material-id');
            deleteForm.action = `/materials/${materialId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    const editButtons = document.querySelectorAll('.edit-button');
    const editForm = document.getElementById('editForm');
    const editModal = document.getElementById('editMaterialModal');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const materialId = button.getAttribute('data-material-id');
            const materialName = button.getAttribute('data-material-name');
            const brandname = button.getAttribute('data-brandname');
            const serialNumber = button.getAttribute('data-serial-number');
            const quantity = button.getAttribute('data-quantity');
            const availability = button.getAttribute('data-availability');

            // Set form action
            editForm.action = `/materials/${materialId}`;

            // Populate form fields
            document.getElementById('edit_material_name').value = materialName;
            document.getElementById('edit_brandname').value = brandname;
            document.getElementById('edit_serial_number').value = serialNumber;
            document.getElementById('edit_quantity').value = quantity;
            document.getElementById('edit_availability').value = availability;

            // Show modal
            editModal.classList.remove('hidden');
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