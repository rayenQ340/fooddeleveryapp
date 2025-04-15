document.getElementById("signupForm").addEventListener("submit", async function(event) {
    event.preventDefault(); // Empêche la soumission par défaut

    const nom = document.getElementById("nom").value.trim();
    const prenom = document.getElementById("prenom").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    // Validation username
    if (nom === "" || prenom === "") {
        alert("Veuillez saisir votre nom et prénom.");
        return;
    }

    // Validation email regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Veuillez entrer une adresse email valide.");
        return;
    }

    // Validation passw
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordRegex.test(password)) {
        alert("Le mot de passe doit contenir au moins 8 caractères, dont une lettre, un chiffre et un caractère spécial.");
        return;
    }

    // unique email/username
    try {
        const response = await fetch('check_user_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email })
        });

        const result = await response.json();

        if (!result.success) {
            alert(result.message);
            return;
        }

        this.submit();

    } catch (error) {
        console.error("Erreur lors de la vérification :", error);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
});