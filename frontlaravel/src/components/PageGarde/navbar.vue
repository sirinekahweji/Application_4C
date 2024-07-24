<template>
  <div class="navbarPageGarde">
    <div class="navbarligne1">
      <img alt="logo4C" src="@/assets/logo1.png" class="logo4C"/>
      <img src="@/assets/logo2.png" style="margin-left: 7px;" class="logoTitre">
      <div class="spacer"></div> <!-- Espacement flexible pour pousser le menu à droite -->
      
    </div>
    <div class="navbarligne2">
      <h3 class="navbarligne2_h3"><a href="#ServiceEtudients" class="navbarligne2_h3">Services Etudiants</a></h3>
      <h3 class="navbarligne2_h3"><a href="#ServiceEnseignants" class="navbarligne2_h3">Services Enseignants</a></h3>
      <h3 class="navbarligne2_h3"><a href="#ServicePartenaires" class="navbarligne2_h3">Services Partenaires</a></h3>
    </div>
  </div>

</template>

<style scoped>
.searchicon {
  width: 20px;
  height: 20px;
  top: 0%;
  position: absolute;
  right: 90px;
  cursor: pointer;

}

/* Style de l'input de recherche */
.searchinput {
  position: absolute;

  padding: 8px;
  width: 300px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  top: 0px;
  right: 0px;


}

/* Style pour l'icône de recherche */
.navbarPageGarde {
  background-color: white;
  margin: 0;
  padding: 0;
  height: 90px;
  display: grid;
  grid-row: 60px 30px;
}


.navbarligne1 {
  height: 60px;
  display: flex;
  justify-content: flex-start; /* Modifier de 'space-between' à 'flex-start' */
  align-items: center;
  margin-top: 10px;
  padding-left: 15px; /* Ajouter un espacement à droite */
}

  .spacer {
    flex: 2; /* Cela pousse l'icône du menu vers la droite autant que possible */
  }


.navbarligne2 {
  background-color: rgb(0, 161, 225);
  display: flex;
  justify-content: flex-start;
  column-gap: 100px;
  height: 35px;
  padding-left: 70px;


}

.logo4C {
  width: 60px;
  height: 60px;
  margin-top: 0px; 
  margin-left: 7px;
  margin-bottom: 7px;
}

.logoIset{
  width: 5%;
  height: 60px;
  margin-bottom: 7px;
}

.navbarligne2_h3 {
  color: white;
  margin-top: 9px;
  font-size: 16px;
  text-decoration: none;
}
.navbarligne2_h3:hover {
text-decoration: underline;
}

.menuicon {
  width: 6vw;
  height: 6vw;
  position: relative;
  cursor: pointer;
  display: none;
  margin-right:0px;
}



/* Media query pour les écrans de taille inférieure à 700px */
@media screen and (max-width: 700px) {

  .navbarligne2 {
    display: none;
  }

  .navbarPageGarde {
    height: 50px;
  }

  .searchcontainer {
    display: none;
  }

  .menuicon {
    display: block;

  }

  .logo4C {
    width: 50px;
    height: 40px;
  }

  .logoTitre{
    width: 50%;
  }

  .logoIset{
    width: 16%;
    height: 135%;
    margin-left:-5%
  }

  .navbarligne1 {
    height: 32px;
    width: 90%;
    padding-left: 20px;


  }

}

/* Media query pour les écrans de taille inférieure à 800px et supérieure ou égale à 700px */
@media screen and (max-width: 800px) and (min-width: 700px) {

  .menuicon {
    display: none;
  }

  .logo4C {
    width: 120px;
  }

  .navbarligne2 {

    padding-left: 30px;

  }

  .navbarligne2_h3 {
    font-size: 15px;
  }

}

.searchinput {
  position: absolute;

  padding: 8px;
  width: 300px;
  border: 2px solid rgb(0, 161, 225);
  border-radius: 5px;
  font-size: 14px;
  top: 15px;
  right: 70px;


}

.searchicon {
  position: absolute;
  top: 22px;
  right: 40px;
  cursor: pointer;

}
</style>

<script>


</script>
