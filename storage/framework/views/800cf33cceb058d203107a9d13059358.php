<script>
    document.getElementById('user_id')?.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const name = selectedOption.getAttribute('data-name');
        const email = selectedOption.getAttribute('data-email');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');

        if (name && email) {
            nameInput.value = name;
            emailInput.value = email;
            nameInput.readOnly = true;
            nameInput.classList.add('bg-light');
        } else {
            nameInput.readOnly = false;
            nameInput.classList.remove('bg-light');
            emailInput.value = '';
        }
    });

    window.addEventListener('load', function() {
        const userIdSelect = document.getElementById('user_id');
        if (userIdSelect?.value) {
            userIdSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\lbh\resources\views/paralegals/partials/user-autofill.blade.php ENDPATH**/ ?>