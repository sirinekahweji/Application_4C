<!-- eslint-disable vue/valid-template-root -->
<template>
  <div class="pageGarde">
    <div class="BodypageGarde">
      <div class="Partie1">
        <NavBar></NavBar>

        <div class="Titles">
          <img alt="logo4CBizerte" src="../assets/PageGarde/logo4CIsetB.png" class="logo4CBizerte1" />
          <H1 class="Title">Le <span class="lettrevert">C</span>entre de <span class="lettrevert">C</span>arrière et de
            <span class="lettrevert">C</span>ertification des <span class="lettrevert">C</span>ompétences</H1>
          <div class="isetbizerte">
            <img alt="logo4CBizerte" src="../assets/PageGarde/logo4CIsetB.png" class="logo4CBizerte" />
            <h2> 4C ISET BIZERTE </h2>
          </div>
          <div class="Stat">
            <Stat></Stat>
          </div>
        </div>
        <div class="ButtonspageGarde">
          <button class="ButtonpageGarde" type="submit" @click="SignIn()">SeConnecter</button>
          <button class="ButtonpageGarde" type="submit" @click="SignUp()">Inscrivez-vous</button>
        </div>
        <div class="signIn">
          <SignIn></SignIn>
        </div>
      </div>
      <div class="Services">
        <div id="ServiceEtudients">
          <ServicesEtudients></ServicesEtudients>
        </div>
        <div id="ServiceEnseignants">
          <ServicesEnseignants></ServicesEnseignants>
        </div>
        <div id="ServicePartenaires">
          <ServicesPartenaires></ServicesPartenaires>
        </div>
      </div>
      <Footer></Footer>
    </div>
  </div>
</template>

<script scoped>
import NavBar from "@/components/PageGarde/navbar.vue";
import SignIn from "@/components/PageGarde/SignIn.vue";
import Stat from "@/components/PageGarde/Statistiques.vue";
import ServicesEtudients from "@/components/PageGarde/ServicesEtudients.vue";
import ServicesEnseignants from "@/components/PageGarde/ServicesEnseignants.vue";
import ServicesPartenaires from "@/components/PageGarde/ServicesPartenaires.vue";
import Footer from "@/components/PageGarde/Footer.vue";


export default {
  name: " paageGrade",
  data() {
    return {
    }
  },
  components: {
    NavBar,
    SignIn,
    Stat,
    ServicesEtudients,
    ServicesEnseignants,
    ServicesPartenaires,
    Footer

  },
  methods: {
    SignIn() {
      this.$router.push("/SignIn")
    },
    SignUp() {
      this.$router.push("/SignUp")
    }
  },
  created(){
    localStorage.removeItem('resetEmail');
  }

};
</script>

<style scoped>
.BodypageGarde {
  background-color: rgb(234, 230, 230);


}

.logo4CBizerte1 {
  display: none;

}

.ButtonspageGarde {
  display: none;

}

.ButtonpageGarde {
  background-color: rgb(171, 206, 74);
  ;
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

.Partie1 {
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
}

.lettrevert {
  color: rgb(171, 206, 74);
}

.Titles {
  color: white;
  padding-top: 45px;
  margin-left: 25px;
  margin-right: 50px;
  font-size: 30px;
}

.isetbizerte {
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  font-size: 27px;
  color: white;
  margin-top: 40px;
}

.logo4CBizerte {
  width: 70px;
  height: 70px;
}

.Title {
  font-size: 40px;
  margin-top: 50px;

}

.Partie1 {
  padding: 0;
  background-color: gray;
  background-image: url('../assets/PageGarde/BackgroundPageGarde.png');
  background-size: cover;
  background-position: center;
  height: 700px;
  display: flex;
  justify-content: space-between;
  /* Pour aligner les éléments sur les côtés opposés */
  align-items: center;
  /* Pour aligner verticalement les éléments */
  padding: 0 20px;
  /* Ajoute un peu de padding sur les côtés */
  position: relative;
}

.navbarPageGarde {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  background-color: white;
}

/* Media query pour les écrans de taille inférieure à 700px */
@media screen and (max-width: 700px) {
  .Stat {
    display: none;
  }

  .logo4CBizerte1 {
    display: block;
    height: 90px;
    width: 90px;
  }

  .logo4CBizerte {
    display: none;

  }

  .Title {
    font-size: 20px;
    text-align: center;
  }

  .signIn {
    display: none;
  }

  .isetbizerte {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 20px;
    display: block;
    text-align: center;
  }

  .ButtonspageGarde {
    display: block;
    cursor: pointer;
    padding-top: 50px;
  }

  .Partie1 {
    display: block;
  }

  .Titles {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-top: 150px;


  }
}

/* Media query pour les écrans de taille inférieure à 1000px et supérieure ou égale à 700px */
@media screen and (max-width: 1000px) and (min-width:700px) {
  .Stat {
    display: none;
  }

  .Title {
    font-size: 28px;
  }

  .isetbizerte {
    font-size: 20px;
    margin-top: 50px;
    margin-left: -100px;
  }

  .Titles {
    margin-top: -140px;
  }

  .ButtonspageGarde {
    display: none;
  }

}

/* Media query pour les écrans de taille inférieure à 1200px et supérieure ou égale à 1000px */
@media screen and (max-width: 1200px) and (min-width:1000px) {
  .Stat {
    display: none;
  }

  .Title {
    font-size: 35px;
  }

  .Titles {
    margin-top: -140px;

  }

  .ButtonspageGarde {
    display: none;
  }

  .isetbizerte {

    margin-left: -100px;
  }

}
</style>