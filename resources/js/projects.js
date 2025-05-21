// Menangani event untuk tombol hapus
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteForm = document.getElementById('deleteForm');
    const deleteModal = document.getElementById('deleteConfirmationModal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const projectId = this.getAttribute('data-project-id');
            deleteForm.action = `/projects/${projectId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    const modalHideButtons = document.querySelectorAll('[data-modal-hide="deleteConfirmationModal"]');
    modalHideButtons.forEach(button => {
        button.addEventListener('click', function () {
            deleteModal.classList.add('hidden');
        });
    });
}); 

// Menangani event untuk tombol edit
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-button');
    const editForm = document.getElementById('editForm');
    const editModal = document.getElementById('editProjectModal');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const projectId = this.getAttribute('data-project-id');
            const projectName = this.getAttribute('data-project-name');
            const clientId = this.getAttribute('data-client-id');
            const startDate = this.getAttribute('data-start-date');
            const endDate = this.getAttribute('data-end-date');
            const complexity = this.getAttribute('data-complexity');
            const userId = this.getAttribute('data-user-id');
            const status = this.getAttribute('data-status');
            const cost = this.getAttribute('data-cost');
            const description = this.getAttribute('data-description');

            // Isi form dengan data proyek
            editForm.action = `/projects/${projectId}`;
            document.getElementById('edit_project_name').value = projectName;
            document.getElementById('edit_id_client').value = clientId;
            document.getElementById('edit_start_date').value = startDate;
            document.getElementById('edit_end_date').value = endDate;
            document.getElementById('edit_complexity').value = complexity;
            document.getElementById('edit_id_user').value = userId;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_cost').value = cost;
            document.getElementById('edit_description').value = description;

            // Tampilkan modal
            editModal.classList.remove('hidden');
        });
    });

    const modalHideButtons = document.querySelectorAll('[data-modal-hide="editProjectModal"]');
    modalHideButtons.forEach(button => {
        button.addEventListener('click', function () {
            editModal.classList.add('hidden');
        });
    });
});