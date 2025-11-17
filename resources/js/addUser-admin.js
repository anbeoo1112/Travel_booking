document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('mat_khau');
    const generatedPasswordField = document.getElementById('generated-password');

    function generateRandomPassword(length = 12) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let password = "";
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        return password;
    }

    document.getElementById('addAccountModal').addEventListener('shown.bs.modal', function () {
        const password = generateRandomPassword();
        passwordField.value = password;
        generatedPasswordField.value = text;
    });
});
