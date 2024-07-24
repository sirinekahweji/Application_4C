<template>
    <div>
        <navbar></navbar>
        <div v-if="loading" class="overlay"></div>
        <div class="d-flex justify-content-center spinner" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="email-input">
            <h2>Réinitialisation du mot de passe</h2>
            <div id="row">
                <input v-model="email" type="email" placeholder="Entrez votre email" />
                <button @click="submitEmail">Envoyer</button>
                <div v-if="message" class="message">{{ message }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import navbar from "@/components/signUp/navbar"
import MailService from "@/services/mail.js"
export default {
    data() {
        return {
            email: '',
            message: '',
            loading: false
        };
    },
    components: {
        navbar
    },
    methods: {
        submitEmail() {
            this.loading = true
            this.message = '';
            MailService.forgetPassword(this.email).then(() => {
                alert("le mot de passe est envoyé par mail"),
                    localStorage.setItem('resetEmail', this.email);
                this.$router.push('/resetPassword');
            })
                .catch(error => {
                    if (error.response && error.response.status === 404) {
                        this.message = "Nous n'avons pas pu trouver un compte associé à cet email. Veuillez vérifier l'adresse email saisie ou envisagez de vous inscrire pour un nouveau compte.";
                    } else {
                        this.message = "Une erreur s'est produite lors de la réinitialisation du mot de passe.";
                    }
                });
            this.loading = false;
        }
    }
}
</script>
<style scoped>
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.email-input {
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

#row {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.email-input h2 {
    color: #007bff;
    margin-bottom: 1.5rem;
    font-size: 1.70rem;
    text-align: center;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

input[type="email"],
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 2px solid #ddd;
    border-radius: 4px;
}

input[type="email"] {
    transition: border-color 0.3s;
}

input[type="email"]:focus {
    border-color: #0056b3;
    outline: none;
}

button {
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

.message {
    color: #d9534f;
    text-align: center;
}

@media (max-width: 600px) {
    .email-input {
        padding: 1rem;
        max-width: 90%;
    }
}
</style>