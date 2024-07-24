<template>
  <div class="SignIn">
    <h2 class="TitleSignIn">Connectez-Vous</h2>
    <form action="" method="" class="loginForm" @submit.prevent="Login()">
      <div class="FormField">
        <label for="username" class="email">Email</label>
        <input type="email" id="username" name="username" placeholder="Email" v-model="email" required>
      </div>
      <div class="FormField">
        <label for="password" class="MotPasse">Mot de passe</label>
        <div class="PasswordContainer">
          <input type="password" v-model="password" id="password" name="password" placeholder="Mot de passe" required
            @input="togglePasswordIcon">
          <button type="button" class="PasswordToggleBtn" @click="togglePasswordVisibility" v-if="showPasswordIcon">
            <i v-if="!passwordVisible" class="fas fa-eye"></i>
            <i v-else class="fas fa-eye-slash"></i>
          </button>
        </div>
        <div v-if="error" class="error-message">{{ error }}</div>
      </div>
      <div class="MotDePasseOublie">
        <a @click="forgetPassword">Mot de passe oublié ?</a>
      </div>
      <button type="submit" class="SeConnecter">Se connecter</button>
    </form>
    <p class="Inscrivez">Vous n'avez pas de compte?<br> <router-link to="/SignUp">Inscrivez-vous ici</router-link>.</p>
  </div>
</template>

<script>
import AuthService from "@/services/auth.js"

export default {

  name: "SignIn",

  props: {

  },

  components: {

  },

  data() {
    return {
      showPasswordIcon: false,
      passwordVisible: false,
      email: "",
      password: "",
      error: null,
      remember: false,

    }
  },

  created() {
    localStorage.removeItem('resetEmail');
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
    Login() {
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
          if (error.response || error.response.status === 404) {
            this.error = "Adresse email ou mot de passe incorrect.";
          } else {
            this.error = "Une erreur s'est produite. Veuillez réessayer";
          }
        });
    },
    forgetPassword() {
      this.$router.push("/MotDePasseOubliee");
    },
    validateEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

  },
  mounted() {
    const rememberedEmail = localStorage.getItem("rememberedEmail");
    if (rememberedEmail) {
      this.email = rememberedEmail;
      this.remember = true;
    }
  },
  computed: {

  },

};


</script>
<style scoped>
.error-message {
  color: #ff0000;
  font-size: 12px;
  margin-top: 5px;
  width: 100%;
}

.TitleSignIn {
  font-size: 25px;
  font-weight: bold;
  text-align: center;
  padding: 15px;
}

.FormField label {
  margin-bottom: 5px;
  /* Ajoute un espace de 5px en bas du libellé */
  width: fit-content;
  user-select: none;
}

.FormField input {
  padding: 8px;
  padding-bottom: 18px;
  padding-top: 18px;
  /* Ajoute un espace de 5px en bas du libellé */
}

.remember {
  font-size: 10px;
  color: rgb(49, 49, 49);
}

.Remember .remember {
  margin-left: 5px;
  /* Ajoute un espace de 5px entre la case à cocher et le libellé */
}

.Remember {
  display: flex;
  /* Utiliser un modèle de mise en page flexbox */
}

.MotDePasseOublie {
  text-align: right;
  margin-top: 5px;
  margin-bottom: 5px;
  font-size: 12px;
}

.FormField {
  margin-bottom: 15px;
}

.email,
.MotPasse {
  display: block;
}

.Inscrivez {
  padding-left: 20px;
  text-align: center;
  margin-top: 10px;
  font-size: 11px;
}

#username,
#password {
  border-radius: 4px;
  border: none;
  background-color: rgb(230, 230, 230);
  height: 25px;
  width: 275px;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  font-size: 16px;
}

#username:focus,
#password:focus {
  border-color: blue;
}

.SeConnecter {
  background-color: #abce4a;
  ;
  color: white;
  border-radius: 10px;
  border: none;
  padding: 10px;
  cursor: pointer;
  display: block;
  margin: 0 auto;
  width: 275px;
  margin-top: 10px;
}

.Inscrivez a,
.MotDePasseOublie a {
  text-decoration: none;
  color:rgb(0, 161, 225); 
  cursor: pointer;
}

.Inscrivez a:hover,
.MotDePasseOublie a:hover {
  text-decoration: underline;
}

.email,
.MotPasse {
  color: rgb(106, 106, 106);
  font-size: 13px;
}

.SignIn {
  display: flex;
  background-color: white;
  padding: 15px;
  border-radius: 25px;
  display: flex;
  align-items: center;
  width: 350px;
  flex-direction: column;
  margin-right: 100px;
  margin-top: 100px;
}

.PasswordContainer {
  position: relative;
}

.PasswordToggleBtn {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
}

.PasswordToggleBtn:focus {
  outline: none;
}

@media screen and (max-width: 700px) {}

@media screen and (max-width: 1000px) and (min-width:700px) {
  .TitleSignIn {
    font-size: 15px;
  }

  .SignIn {

    width: 250px;
    margin-top: 100px;
    margin-right: 10px;

  }

  .remember {
    font-size: 7px;
    color: rgb(49, 49, 49);
  }

  .MotDePasseOublie {
    text-align: right;
    margin-top: 10px;
    font-size: 10px;
  }

  .FormField {
    margin-bottom: 10px;

  }

  .email,
  .MotPasse {
    display: block;
  }

  .Inscrivez {
    padding-left: 10px;
    text-align: center;
    font-size: 9px;
  }

  #username,
  #password {
    border-radius: 4px;
    border: none;
    background-color: rgb(230, 230, 230);
    height: 20px;
    width: 200px;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  }

  .SeConnecter {
    background-color: rgb(171, 206, 74);
    ;
    color: white;
    border-radius: 10px;
    border: none;
    padding: 10px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    width: 200px;
    margin-top: 7px;

  }
}

/* Media query pour les écrans de taille inférieure à 12000px et supérieure ou égale à 1000px */
@media screen and (max-width: 1200px) and (min-width: 1000px) {
  .SignIn {
    margin-right: 10px;
  }

}
</style>