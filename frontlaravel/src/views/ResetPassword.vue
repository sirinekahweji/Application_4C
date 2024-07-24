<template>
    <div>
        <navbar></navbar>
        <div class="reset-password-container">
            <h2>Créer un nouveau mot de passe</h2>
            <input v-model="tempPassword" type="password" placeholder="Mot de passe temporaire" />
            <input v-model="newPassword" type="password" minlength="8" placeholder="Nouveau mot de passe" />
            <input v-model="confirmPassword" type="password" minlength="8" placeholder="Confirmez le nouveau mot de passe" />
            <button @click="submitNewPassword">Réinitialiser le mot de passe</button>
            <div v-if="message" class="message">{{ message }}</div>
        </div>
    </div>
</template>

<script>
import navbar from "@/components/signUp/navbar"
import UserService from "@/services/users"
export default {
    data() {
        return {
            tempPassword: '',
            newPassword: '',
            confirmPassword: '',
            message: '',
            email:''
        };
    },
    components: {
        navbar
    },
    created() {
        this.email = localStorage.getItem('resetEmail');
        if (!this.email) {
            console.error("Aucun email n'a été fourni");
            this.$router.push('/Accueil');
        }
    },
    methods: {
        submitNewPassword() {
            this.message = '';
            if (this.newPassword !== this.confirmPassword) {
                this.message = "Les mots de passe ne correspondent pas";
                return;
            }

            if (this.newPassword.length < 8) {
                this.message = "Le mot de passe doit contenir au moins 8 caractères";
                return;
            }

            UserService.UpdatePassword(this.email, this.tempPassword, this.newPassword)
                .then(() => {
                    this.message = "Votre mot de passe a été réinitialisé avec succès";
                    localStorage.removeItem('resetEmail');
                    this.$router.push('/Accueil');
                })
                .catch(() => {
                    this.message = "Le mot de passe temporaire est incorrect";
                });
        }
    }
}
</script>

<style scoped>
.reset-password-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 50px auto;
    padding: 2rem;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #fff;
}

.reset-password-container h2 {
    color: #007bff;
    margin-bottom: 20px;
    font-size: 1.75rem;
    text-align: center;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 2px solid #ddd;
    border-radius: 4px;
}

input[type="password"]:focus {
    border-color: #0056b3;
    outline: none;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

.message {
    margin-top: 20px;
    color: #d9534f;
    text-align: center;
}

@media (max-width: 600px) {
    .reset-password-container {
        padding: 1rem;
        max-width: 90%;
    }
}
</style>