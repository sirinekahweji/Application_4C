<template>
    <div class="SignInMobile" >
        <NavBar></NavBar>
        <div class="SignIn">
            <img alt="logo4CBizerte" src="../assets/PageGarde/logo4CIsetB.png" class="logo4CBizerte1"/>
            <h2>Connectez-Vous</h2>
            <form action="" method="" class="loginForm">
                <div class="FormField">
                    <label for="username" class="email">Email</label>
                    <input type="email" id="username" name="username" placeholder="Email" v-model="email" required>
                </div>
 
                <div class="FormField">
                    <label for="password" class="MotPasse">Mot de passe</label>
                    <div class="PasswordContainer">
                        <input type="password" v-model="password" id="password" placeholder="Mot de passe" name="password" required @input="togglePasswordIcon">
                        <button type="button" class="PasswordToggleBtn" @click="togglePasswordVisibility" v-if="showPasswordIcon">
                            <i v-if="!passwordVisible" class="fas fa-eye"></i>
                            <i v-else class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                    <div v-if="error" class="error-message">{{ error }}</div>
                </div>
                <div v-if="error" class="error-message">{{ error }}</div>
                <div class="MotDePasseOublie">
                    <a @click="forgetPassword">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="SeConnecter">Se connecter</button>
            </form>
            <p>Vous n'avez pas de compte?<br> <router-link to="/SignUp">Inscrivez-vous ici</router-link></p>
        </div>  
    </div>
</template>
<script scoped>
import NavBar from "@/components/PageGarde/navbar.vue";
import AuthService from "@/services/auth.js"
export default {
  name: "SignInMobile",
  components: {
    NavBar,
    
  },
  data() {
    return {
        showPasswordIcon: false,
        passwordVisible: false,
        email:"",
        password:"",
        error: null,
        remember: false,
    }
  },
  methods: {
    togglePasswordIcon(event) {
        this.showPasswordIcon = event.target.value.length > 0;
    },
    togglePasswordVisibility() {
        this.passwordVisible = !this.passwordVisible;
        const passwordInput = document.getElementById("password");
        passwordInput.type = this.passwordVisible ? "text" : "password";
    },
    Login(){
        this.error = null;
        if (!this.validateEmail(this.email)) {
        this.error = "Veuillez saisir une adresse email valide";
        return;
        }

        AuthService.Login(this.email, this.password)
        .then(() => {
            this.$router.push("/Accueil");
        })
        .catch(error => {
            if (error.response && error.response.status === 404) {
                this.error = "Adresse email ou mot de passe incorrect.";
            } else {
                this.error = "Une erreur s'est produite lors de la connexion. Veuillez réessayer";
            }
        });
    },
    validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },
    forgetPassword() {
      this.$router.push("/MotDePasseOubliee");
    },
  },
  mounted() {
    const rememberedEmail = localStorage.getItem("rememberedEmail");
    if (rememberedEmail) {
        this.email = rememberedEmail;
        this.remember = true;
    }
},
};
</script>
<style scoped>
.FormField label {
  margin-bottom: 5px; /* Ajoute un espace de 5px en bas du libellé */
  width: fit-content;
  user-select: none;
}
.FormField input{
  padding: 8px;
   padding-bottom: 18px;  
   padding-top: 18px; /* Ajoute un espace de 5px en bas du libellé */
}
.FormField{
  margin-bottom: 15px;
}
.PasswordContainer {
    position: relative;
}

.PasswordToggleBtn {
    position: absolute;
    top: 25%;
    right: -100px;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
}

.PasswordToggleBtn:focus {
    outline: none;
}

.SignInMobile{
    background-color: white;
}
.SignIn{
    margin-top:100px;
    margin-left: 50px;

    display: flex;
    background-color: white;
    padding: 15px;
    border-radius: 25px;
    display: flex;
    align-items: center; 
    width:300px;
    flex-direction: column; 
}
.remember{
    font-size: 10px;
    color:rgb(49, 49, 49);
}
.Remember {
  display: flex; /* Utiliser un modèle de mise en page flexbox */
}
.MotDePasseOublie
{
    text-align: right;
    margin-top:20px;
    font-size: 12px;
}
.FormField{
    margin-bottom: 15px;

}
.email,.MotPasse {
    display: block; 
}
p {
    padding-left: 20px;
    text-align: center;
    font-size:11px;
}
#username,#password{
    border-radius: 4px;
    border: none;
    background-color:rgb(230,230,230);
    height: 25px;
    width:250px;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
button{
    background-color:rgb(171, 206, 74); ;
    color: white;
    border-radius: 10px;
    border: none;
    padding: 10px;
    cursor: pointer;
    display: block; 
    margin: 0 auto;
    width: 250px;
    margin-top: 10px;

}
a{
    text-decoration: none;
    color:rgb(0, 161, 225); ;
}
.email,.MotPasse{
    color:rgb(106,106,106);
    font-size: 12px;

}
.logo4CBizerte1{
   width: 90px;
   height:90px;
}


</style>
