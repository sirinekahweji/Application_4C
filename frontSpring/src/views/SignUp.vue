<template>
  <div>
    <navbar></navbar>
    <div class="cadre1">
      <div class="cadre2">
        <h2>Inscrivez-vous en Tant que </h2>
        <div id="inscription">
          <label class="etud">
            <img :src="logoEtud" alt="étudiant">
            <div class="etudiant">
              <input type="radio" name="inscription_type" id="student"
                @click="naviguerVersInscription('Etudiant')"> Etudiant
            </div>
          </label>
          <label class="ensg">
            <img :src="logoEnsg" alt="Enseignant">
            <div class="enseignant">
              <input type="radio" name="inscription_type" id="enseignant"
                @click="naviguerVersInscription('Enseignant')"> Enseignant
            </div>
          </label>
          <label class="part">
            <img :src="logoPart" alt="Personnel">
            <div class="partner">
              <input type="radio" name="inscription_type" id="partner"
                @click="naviguerVersInscription('Personnel')"> Personnel
            </div>
          </label>
          <div class="signUp">
            <SignUpEtudiantVue v-if="component === 'Etudiant'"></SignUpEtudiantVue>
            <SignUpEnseignantVue v-if="component === 'Enseignant'"></SignUpEnseignantVue>
            <SignUpPersonnelVue v-if="component === 'Personnel'"></SignUpPersonnelVue>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import navbar from '../components/signUp/navbar.vue';
import SignUpEtudiantVue from '../components/signUp/SignUpEtudiant.vue';
import SignUpEnseignantVue from '../components/signUp/SignUpEnseignant.vue';
import SignUpPersonnelVue from '../components/signUp/SignUpPersonnel.vue';
export default {
  components: {
    navbar,
    SignUpEtudiantVue,
    SignUpEnseignantVue,
    SignUpPersonnelVue
  },
  data() {
    return {
      logoEtud: require('../assets/SignUp/etudiant.png'),
      logoEnsg: require('../assets/SignUp/enseignant.png'),
      logoPart: require('../assets/SignUp/entreprise.png'),
      component: '',
    }
  },
  methods: {
    naviguerVersInscription(page) {
      console.log(page);
      if (page === "Etudiant") {
        this.component = "Etudiant";
      } else if (page === "Enseignant") {
        this.component = "Enseignant";
        console.log(this.component);
      } else {
        this.component = "Personnel";
      }
      //this.$router.push('/Inscription'); 
    }

  }

};
</script>

<style scoped>
input[type="radio"]:checked {
  font-weight: bold;
}

.cadre1 {
  border: 1px solid rgb(154, 154, 154);
  margin-top: 5%;
  margin-right: 90px;
  margin-left: 90px;
  min-height: 430px;
  height: auto;
  background-color: rgb(238, 254, 255);
}

.cadre2 {
  border: 1px solid rgb(124, 124, 124);
  margin-top: 50px;
  margin-right: 70px;
  margin-left: 70px;
  margin-bottom: 50px;
  min-height: 290px;
  height: auto;
  background-color: rgb(255, 255, 255);

}

.cadre2 h2 {
  text-align: center;
  padding-top: 5%;
  font-size: 30px;
}

#inscription {
  top: -20%;
  left: 50%;
  text-align: center;
}

.etud,
.ensg,
.part {
  display: inline-block;
  /* Pour afficher les éléments en ligne */
  margin: 15px;
  /* Marge entre les éléments */
  text-align: center;
  /* Pour centrer le texte */
  vertical-align: middle;
  /* Pour centrer les éléments verticalement */

}

.etudiant,
.enseignant,
.partner {
  text-align: center;
  border: 2px solid rgb(135, 216, 248);
  padding: 20px;
}

/* Styles optionnels pour l'image */
img {
  width: 50px;
  /* Largeur de l'image */
  height: 50px;
  /* Hauteur de l'image */
}

.signUp {
  align-self: center;
}

/* Styles optionnels pour les boutons radio */
input[type="radio"] {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 15px;
  height: 15px;
  background-color: white;
  margin-top: 10px;
  border-radius: 50%;
  border: 2px solid rgb(135, 216, 248);
  position: relative;

}

@media screen and (max-width: 700px) {
  .cadre1 {
    border: 1px solid rgb(154, 154, 154);
    margin-top: 30px;
    margin-right: 20px;
    margin-left: 20px;
    min-height: 500px;
    height: auto;
    background-color: rgb(238, 254, 255);

  }

  .cadre2 {
    border: 1px solid rgb(124, 124, 124);
    margin-top: 40px;
    margin-right: 30px;
    margin-left: 30px;
    min-height: 400px;
    height: auto;
    background-color: rgb(255, 255, 255);

  }

  .etud,
  .ensg,
  .part {
    display: block;
    text-align: center;
    margin: 10px 50px;
  }

  .etudiant,
  .enseignant,
  .partner {
    padding: 10px;
  }

  img {
    width: 30px;
    height: 30px;
  }

  .cadre2 h2 {
    text-align: center;
    padding-top: 50px;
    font-size: 17px;
  }

}

@media screen and (max-width: 800px) and (min-width: 700px) {

  .etud,
  .ensg,
  .part {
    display: inline-block;
    margin: 3px;
    text-align: center;
    vertical-align: middle;

  }

  .etudiant,
  .enseignant,
  .partner {
    text-align: center;
    border: 2px solid rgb(135, 216, 248);
    padding: 9px;
  }

  img {
    width: 40px;
    height: 40px;
  }

  .cadre2 h2 {
    text-align: center;
    padding-top: 6px;
    font-size: 20px;
  }

}

@media screen and (max-width: 1000px) and (min-width: 800px) {

  .etud,
  .ensg,
  .part {
    display: inline-block;
    margin: 5px;
    text-align: center;
    vertical-align: middle;

  }

  .etudiant,
  .enseignant,
  .partner {
    text-align: center;
    border: 2px solid rgb(135, 216, 248);
    padding: 15px;
  }

  img {
    width: 40px;
    height: 40px;
  }

  .cadre2 h2 {
    text-align: center;
    padding-top: 6px;
    font-size: 25px;
  }

}
</style>




=