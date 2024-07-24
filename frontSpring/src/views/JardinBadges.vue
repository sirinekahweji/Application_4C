<template>
    <div>
        <span id="top"></span>
        <navBar></navBar>
        <section>
            <div class="row" style="margin-right: 0px;">
                <div class="col-md-3">
                    <information_personnel></information_personnel>
                </div>

                <div class="col-md-9">
                    <div class="container">
                        <div class="card-header">
                            <div class="title">
                                <h5>Jardin des badges</h5>
                                
                            </div>
                            <div class="content-wrapper"> 
                            <div v-for="(user, index) in displayedItems" :key="index">
                                <div class="user-badge">
                                    <div class="user-info">
                                        <img :src="user.profile" alt="" class="profile-image" />
                                        <span style=" margin-left: 20px;font-size:14px;">{{user.firstname}} {{user.lastname}} - {{user.statut}}</span>
                                    </div>
                                    <div class="user-slides-badge">
                                        <button class= "w3-button w3-black w3-display-left left" @click="changeSlide(1, index)">&#10094;</button>
                                        <div v-for="(slide, slideIndex) in user.slides" :key="slideIndex" class="mySlides" :style="{ display: slideIndex >= user.currentSlide ? 'inline-block' : 'none' }">
                                            <img :src="slide" style="width: 50%" />
                                        </div>
                                        <button class="w3-button w3-black w3-display-right right" @click="changeSlide(-1, index)">&#10095;</button>
                                    </div>
                                </div>
                                <hr style="margin: 0rem 0;">
                            </div>
                            <div class="pagination">
                                <button @click="previousPage" :disabled="currentPage === 1" class="page-button">&#10094;</button>
                                <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                                <button @click="nextPage" :disabled="currentPage === totalPages" class="page-button">&#10095;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <div class="button">
            <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
        </div>
    </div>
</template>

<script>
import navBar from "@/components/navbar.vue";
import information_personnel from "@/components/Accueil/information-personnel.vue";

export default {
  name: "app",
  components: {
    navBar,
    information_personnel,
  },
  data() {
    return {
      users: [
        {
             
          firstname: "soltan",
          lastname: "mourad",
          statut: "etudiant",
          profile: require("@/assets/mourad.png"),
          slides: [
            require("@/assets/2024-03-19_23h25_09.png"), // Ajoute toutes les images ici
            require("@/assets/2024-03-19_23h25_09.png"),
            require("@/assets/2024-03-19_23h25_09.png"),
            // Ajoute d'autres images au besoin
          ],
           currentSlide: 0,
        },
        {
           
          firstname: "nesrine",
          lastname: "hammami",
          statut: "Professeur",
          profile: require("@/assets/nesrine.jpg"),
          slides: [
            require("@/assets/2024-03-19_23h25_09.png"), // Ajoute toutes les images ici
            require("@/assets/2024-03-19_23h25_09.png"),
            require("@/assets/2024-03-19_23h25_09.png"),
            require("@/assets/2024-03-19_23h25_09.png"),
            
            // Ajoute d'autres images au besoin
          ],
          currentSlide: 0,
        },
                {
                 
          firstname: "soltan",
          lastname: "mourad",
          statut: "etudiant",
          profile: require("@/assets/mourad.png"),
          slides: [
            require("@/assets/2024-03-19_23h25_09.png"), // Ajoute toutes les images ici
            require("@/assets/2024-03-19_23h25_09.png"),
            require("@/assets/2024-03-19_23h25_09.png"),
            // Ajoute d'autres images au besoin
          ],
              currentSlide: 0,
        },
      ],
      //currentIndex: Array.from({ length: 2 }, () => 0),
        
      itemsPerPage: 2,
      currentPage: 1,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.users.length / this.itemsPerPage);
    },
    displayedItems() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.users.slice(startIndex, endIndex);
    },
  },
  methods: {
   
    changeSlide(n, userIndex) {
      const user = this.users[userIndex];
      user.currentSlide += n;
      const totalSlides = user.slides.length;
      if (user.currentSlide >= totalSlides) {
        user.currentSlide = 0;
      } else if (user.currentSlide < 0) {
        user.currentSlide = totalSlides - 1;
      }
    },
  
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
  },
};
</script>
<style scoped>

section {
  padding-top: 80px;
}

.buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #808080;
}

.buttons > button {
  padding: 5px 10px;
  background: lightgrey;
  color: #808080;
  text-transform: uppercase;
  border: none;
  outline: none;
  border-radius: 3px;
  cursor: pointer;
}

.buttons > button.abled {
  background: blue;
  color: #fff;
}

.content-wrapper {
  width: 100%; /* Ajoute une largeur de 100% */
  max-width: 800px; /* Limite la largeur maximale */
  margin: 0 auto; /* Centre le contenu horizontalement */
}
.user-wrapper {
  margin-bottom: 20px; /* Ajoute une marge en bas pour séparer les utilisateurs */
}
.button a {
  position: fixed;
  bottom: 20px;
  right: 20px;
  color: #fff;
  background: #2980b9;
  padding: 7px 12px;
  font-size: 18px;
  border-radius: 6px;
  box-shadow: rgba(0, 0, 0, 0.15);
}
.card-header {
  width: 100%; /* Ajoute une largeur fixe */
  max-width: 800px; /* Limite la largeur maximale */
  margin: 0 auto; /* Centre le contenu horizontalement */
  background: #ffffff;
  color: #818181;
  font-size: 270%;
  font-weight: bold;
  padding: 2%;
  padding-left: 3%;
  box-shadow: #bcbbbb -2px 2px 4px;
  border-radius: 10px;
  border: 1px solid #818181;
  margin-bottom: 0%;
  background-color: var(--card-color);
  margin-top: 1%;
}


h5 {
  color: #000;
  font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
    "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
  margin-left: 3px;
}
.title {
  border-bottom: 2px solid #000;
  margin-bottom: 5px;
}
.badgeicon {
  position: absolute;
  top: -20px;
  right: 48px;
  margin-top: 10%;
  transform: translateY(-50%);
  width: 30px;
  height: 30px;
}

/* Profile card */
.profile-image {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  margin-bottom: 5px;
 
}

.user-info {
  font-size: 15px;
  font-weight: bold;
}
/************** */

.user-badge {
  /* Pour permettre aux éléments d'être affichés horizontalement */
  white-space: nowrap;
  display: flex;
    gap: 40px;
    align-items: center;
}

.user-info,
.user-slides-badge {
  display: inline-block; /* Pour afficher les éléments horizontalement */
  vertical-align: middle; /* Pour aligner verticalement les éléments */
  width : 250px;
}

.user-info {
  /* Optionnel: Ajoutez une marge droite pour séparer les éléments */
  margin-right: 20px;
}

.profile-image {
  max-width: 100%; /* Pour éviter que l'image ne dépasse */
}

.mySlides {
  /* Optionnel: Ajoutez une marge gauche pour séparer les éléments */
 margin-left: 10%;
  max-width: 26%; /* Pour spécifier la largeur de l'image */
 border-radius: 50%;
  display: inline-block; /* Pour afficher les éléments en ligne */
  vertical-align: middle; /* Pour centrer les éléments verticalement */
  font-size: 30%;
}
.user-slides-badge button {
 
  background: rgb(255, 255, 255);
  color: #0075c4;
  text-transform: uppercase;
  border: none;
  outline: none;
  border-radius: 3px;
  cursor: pointer;
  margin: 0 5px;
}
.user-slides-badge button:hover {
    color: #0d6097;
}
/************ */

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination button {
  padding: 1px 2px;
  background-color: #ffffff;
  color: #ebebeb;
  text-transform: uppercase;
  border: none;
  outline: none;
  border-radius: 30%;
  cursor: pointer;
  margin: 0 5px;
}
.pagination .page-info {
  margin: 10px;
  font-family:initial;
  font-size: 16px;
}
</style>