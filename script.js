var confirmModal = document.getElementById("confirmModal");
        var notificationModal = document.getElementById("notificationModal");
        var currentDeleteUrl = "";

        function openConfirmModal(deleteUrl) {
            currentDeleteUrl = deleteUrl;
            confirmModal.style.display = "block";
        }

        function closeConfirmModal() {
            confirmModal.style.display = "none";
        }

        function openNotificationModal(message) {
            document.getElementById('notificationMessage').textContent = message;
            notificationModal.style.display = "block";
            setTimeout(function() {
                notificationModal.style.display = "none";
            }, 2000); // Close after 2 seconds
        }

        function closeNotificationModal() {
            notificationModal.style.display = "none";
        }

        document.getElementById("confirmDeleteButton").onclick = function() {
            window.location.href = currentDeleteUrl;
        }

        window.onclick = function(event) {
            if (event.target == confirmModal || event.target == notificationModal) {
                closeConfirmModal();
                closeNotificationModal();
            }
        }

        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }