<template>
  <div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-body">
            <form @submit.prevent="updateBadge">
              <div class="row">
                <!-- Partie gauche du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom de Badge</label>
                    <input v-model="badge.nom" type="text" class="form-control" id="nom" required>
                  </div>
                </div>

                <!-- Partie droite du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="lieu" class="form-label">Type </label>
                    <input type="text" v-model="badge.type" class="form-control" id="lieu" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Valider</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="card-header">
        / DetailBadge
      </div>
      <div class="filter-bar">
        <div class="buttons-right">
          <!-- <button type="button" class="btn btn-primary"><img :src="require('@/assets/participant.png')"
              style="width:20px ; height:20px"> Participer</button> -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            @click="ouvrirFormulaireModification"><img :src="require('@/assets/participant.png')"
              style="width:20px ; height:20px">Modifier Badge</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('liste')"><img
              :src="require('@/assets/participant.png')" style="width:20px ; height:20px">Consulter Listes</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('userBadge')"><img
              :src="require('@/assets/participant.png')" style="width:20px ; height:20px">utilisateurs avec
            Badge</button>

        </div>
      </div>
      <div class="card-container">

        <div class="container" style="display: flex;" v-if="contenu === 'badge'">
          <div class="col-md-6">
            <div class="mb-3 d-flex align-items-center">
              <label for="nom" class="form-label">Nom de Badge</label>
              <span id="nomSpan" class="form-c ml-2">{{ badge.nom }}</span>
            </div>
            <div class="mb-3 d-flex align-items-center">
              <label for="nom" class="form-label">Type</label>
              <span id="nomSpan" class="form-c ml-2">{{ badge.type }}</span>
            </div>





            <!-- Ajoutez d'autres champs de formulaire au besoin -->


            <!-- Partie droite du formulaire -->


          </div>

          <div class="col-md-6">
            <div class="photo-c ml-2" style=" width:300px;     height: 400px;">
              <img v-if="imagepath != null" :src="require(`@/${imagepath}`)" alt="Votre image" class="photo"
                style="width:inherit; height:inherit;">

            </div>


          </div>
        </div>

        <div v-else-if="contenu === 'liste'" style="display: flex;flex-direction: column;gap: 30px; flex-grow: 1;">
          <div class="data">

            <h4 class="d-flex justify-content-between align-items-center">
              <span>Liste des Comptes</span>
              <div class="buttons-right ml-auto">
                <button v-if="selectedProfiles.length === 0" type="button" class="btn btn-primary"
                  style="font-size: 14px;" disabled>
                  <i class="fas fa-award" style="width:25px; height:25px;margin-bottom: -12px;"></i> Attribue
                  badge
                </button>
                <button v-else type="button" class="btn btn-primary" @click="AttribueBadge"
                  style="font-size: 14px;">
                  <i class="fas fa-award" style="width:25px; height:25px;margin-bottom: -12px;"></i> Attribue
                  badge
                </button>

              </div>
            </h4>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Gmail</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(profil, index) in displayedItems" :key="index">
                    <td>{{ profil.nom }}</td>
                    <td>{{ profil.prenom }}</td>
                    <td>{{ profil.email }}</td>
                    <td>{{ profil.phoneNumber }}</td>
                    <td>
                      <input type="checkbox" v-model="selectedProfiles" :value="profil.id">
                    </td>
                  </tr>
                </tbody>
                <tfoot v-if="totalPages > 1">
                  <tr>
                    <td colspan="7">
                      <div class="pagination">
                        <button @click="previousPage" :disabled="currentPage === 1"
                          class="page-button">Précédent</button>
                        <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                        <button @click="nextPage" :disabled="currentPage === totalPages"
                          class="page-button">Suivant</button>
                      </div>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div v-else style="display: flex;flex-direction: column;gap: 30px; flex-grow: 1;">
          <div class="data">

            <h4 class="d-flex justify-content-between align-items-center">
              <span>Utilisateurs avec badge</span>
            </h4>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Gmail</th>
                    <th scope="col">Telephone</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(profil, index) in displayedItems" :key="index">
                    <td>{{ profil.nom }}</td>
                    <td>{{ profil.prenom }}</td>
                    <td>{{ profil.email }}</td>
                    <td>{{ profil.phoneNumber }}</td>
                  </tr>
                </tbody>
                <tfoot v-if="totalPages > 1">
                  <tr>
                    <td colspan="7">
                      <div class="pagination">
                        <button @click="previousPage" :disabled="currentPage === 1"
                          class="page-button">Précédent</button>
                        <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                        <button @click="nextPage" :disabled="currentPage === totalPages"
                          class="page-button">Suivant</button>
                      </div>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>




</template>


<script>

import 'sweetalert2/dist/sweetalert2.min.css';

import BadgesService from '@/services/badges';
import Chart from 'chart.js/auto';
import userService from "@/services/users"


export default {
  components: {

  },
  data() {
    return {
      selectedProfiles: [],
      profils: [],
      cards: [],
      searchQuery: '',
      selectedCategory: '',
      showModal: true,
      itemsPerPage: 8,
      currentPage: 1,
      contenu: 'badge',
      idBadge: null,
      badge: {},
      imagepath: null,
    };
  },
  computed: {
    totalPages() {
      const total = Math.ceil(this.profils.length / this.itemsPerPage);
      //console.log('Total Pages:', total);
      return total;
    },
    displayedItems() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      const items = this.profils.slice(startIndex, endIndex);
      //console.log('Displaying items from', startIndex, 'to', endIndex);
      return items;
    },
  },
  created() {
    this.idBadge = this.$route.params.id;
    this.$watch('searchQuery', () => {
      this.recherche();
    });
    this.getDetailBadge();
  },
  methods: {
    AttribueBadge() {
      for (let i = 0; i < this.selectedProfiles.length; i++) {
        this.UserBadge(this.selectedProfiles[i]);
      }
      this.selectedProfiles = [];
      this.getProfils();
    },
    getProfils() {
      userService.getUsersWithoutBadge(this.idBadge).then((res) => {
        this.profils = res.data;
        //console.log(res.data);
      })
    },
    getUsersBadge(){
      userService.getUsersWithBadge(this.idBadge).then((res) => {
        this.profils = res.data;
        //console.log(res.data);
      })
    },
    createChart() {
      let ctx1 = document.getElementById('progress-chart');

      new Chart(ctx1, {
        type: "doughnut",
        data: {
          labels: ["Project Incomplète", "Project Completed"],
          datasets: [{
            backgroundColor: [
              "rgba(0, 156, 255, .5)",
              "rgba(0, 156, 255)"
            ],
            data: [50, 100]
          }]
        },
        options: {
          title: {
            display: true,
            text: "World Wide Wine Production 2018"
          }
        }
      });
    },

    getDetailBadge() {
      BadgesService.getDetailBadge(this.idBadge)
        .then((res) => {
          this.badge = res.data;
          this.imagepath = this.badge.image
        })
        .catch((error) => {
          console.error('Une erreur s\'est produite lors de la récupération des détails du certificat :', error);
        });
    },
    updateBadge() {
      BadgesService.updateBadge(this.idBadge, this.badge);
    },
    UserBadge(UserId) {
      BadgesService.UserBadge(this.idBadge, UserId)
    },


    afficherContenu(option) {
      this.contenu = option; // Change le contenu en fonction de l'option sélectionnée
      if(option=="userBadge"){
        this.getUsersBadge();
      }
      else if(option=="liste"){
        this.getProfils();
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
    mettreAJourInformations() {
      // Récupérer les valeurs des champs du formulaire modal
      const nom = document.getElementById('nomInput').value;
      const date = document.getElementById('dateInput').value;
      const formateur = document.getElementById('formateurInput').value;
      // Récupérer d'autres valeurs de champ au besoin

      // Mettre à jour les éléments <span> correspondants dans le card-container
      document.getElementById('nomSpan').textContent = nom;
      document.getElementById('dateSpan').textContent = date;
      document.getElementById('formateurSpan').textContent = formateur;
      // Mettre à jour d'autres éléments <span> au besoin
    },
    filtrerDonnees() {
      if (!this.selectedCategory) {
        this.cards = this.getCertificats();
      } else {
        this.cards = this.cards.filter(teacher => teacher.categorie === this.selectedCategory);
      }
    },
    recherche() {
      if (this.searchQuery === '') {
        this.getCertificats();
      } else {
        this.cards = this.cards.filter(card => {
          return card.nom.toLowerCase().includes(this.searchQuery.toLowerCase());
        });
      }
    },
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
  }
}
</script>
<style scoped>
.download,
.imprimer {
  margin-right: 10px;
  border-radius: 10px;
  background-color: var(--card-color);
  border: hsl(0, 0%, 79%) solid 1px;
  padding: 4px 13px;
  cursor: pointer;
  display: flex;
  align-items: center;
  font-family: Agency FB;
  font-weight: bold;
  color: #5D5D5D;
  font-size: 90%;
}

.ligne {
  display: flex;
  flex-direction: row;
}

.con {
  width: 100%;
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.tableau h4 {
  font-size: 20px;
  margin-left: 10px;
  padding-top: 10px;

}

.table table {
  padding-left: 100px !important;
}

.table th {
  font-size: 15px;
  text-align: center;
}

.table td {
  font-size: 14px;
  text-align: center;
}

.photo-c {
  display: flex;
  justify-content: flex-end;
}

.form-c {
  display: block;
  width: 100%;
  padding: .375rem .75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--bs-body-color);
  background-color: var(--bs-form-control-bg);
  background-clip: padding-box;

  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  /* border-radius: .375rem; */
  transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.card-header {
  margin-top: 30px;
  background: #FFFFFF;
  color: #818181;
  font-family: Agency FB;
  font-size: 120%;
  font-weight: bold;
  padding: 1%;
  padding-left: 3%;
  box-shadow: #818181 -2px 2px 4px;
  border-radius: 10px;
  border: 1px solid #818181;
  margin-bottom: 2%;
  background-color: var(--card-color);
}

.container {
  padding: 2%;
  margin: 5%;
  width: 90%;
  margin-top: 2%;
}

.filter-bar {
  display: flex;
  align-items: center;
  margin-top: 10px;
  margin-right: 20px;
  justify-content: flex-end;
  align-content: center;
  flex-wrap: nowrap;
  gap: 10px;
}

.btn {
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

@media screen and (max-width: 768px) {

  /* Smartphones (portrait and landscape) */
  .container {
    width: 90% !important;
    margin-top: 10px;
  }
}

.search-input {
  padding: 3px;
  border-radius: 5px;
  background: #FFFFFF;
  border-color: #CACACA;
  color: #5D5D5D;
  font-family: Agency FB;
  font-weight: bold;
  cursor: auto;
  font-size: 90%;
}

.search-container {
  position: relative;
  margin-top: 10px;
  width: 300px;
  margin-right: 2%;
}

.search-container input[type="text"] {
  width: 100%;
  padding: 10px 35px 10px 40px;
  border: 1px solid #CACACA;
  border-radius: 10px;
  box-sizing: border-box;
  font-size: 16px;
  background-color: var(--card-color);
}

.search-container .search-icon {
  position: absolute;
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
  color: #5D5D5D;
}

.bt {
  display: flex;
  margin-right: 10px;
  margin-top: 1%;
}

.select {
  text-align: center;
  color: #5D5D5D;
  cursor: pointer;
  border-radius: 10px;
  padding: 12px;
  background: var(--card-color);
  border-color: #CACACA;
  font-family: Berlin Sans FB;
  margin-right: 1%;
}

.filter-button {
  margin-right: 10px;
  border-radius: 10px;
  background-color: var(--card-color);
  border: hsl(0, 0%, 79%) solid 1px;
  padding: 4px 13px;
  cursor: pointer;
  display: flex;
  align-items: center;
  font-family: Agency FB;
  font-weight: bold;
  color: #5D5D5D;
  font-size: 90%;
}






.container {
  width: 90%;
  margin: 0 auto;
  background-color: #fff;
  padding: 0px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
  color: #333;
  font-size: 24px;
}

.form-section,
.sessions,
.description,
.buttons,
.qr-section {
  margin-bottom: 20px;
}

label {
  display: block;
  margin: 5px 0;
  width: 450px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
select,
textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

textarea {
  height: 100px;
  resize: none;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  background-color: #eaeaea;
  margin: 5px 0;
  padding: 10px;
  border-radius: 5px;
}

.buttons button {
  padding: 10px 20px;
  margin-right: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

.qr-section img {
  width: 150px;
  display: block;
  margin-bottom: 10px;
}

.qr-section p {
  margin: 5px 0;
  text-align: center;
}


.filter-button .bi {
  width: 20px;
}

.buttons-right {

  display: contents;
  align-items: flex-end;

}

.buttons-right button {
  display: flex;
  gap: 5px;
  align-items: center;
  font-size: 70%;
  padding: 9px;
  border-radius: 12px;

}

.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px;
  margin-top: 60px;
}

.card {
  width: calc(25% - 20px);
  margin-bottom: 20px;
  box-sizing: border-box;
}

.modal-dialog {
  width: 60% !important;
  height: 30% !important;
  margin-top: 20px;
  margin-bottom: 20px;
}

.mb-3 {
  padding-bottom: 0px;
}

.modal-content .modal-title {
  font-family: Agency FB !important;
  font-style: normal !important;
  font-weight: bold !important;
  font-size: 120% !important;
  text-align: center !important;
  margin-left: 37% !important;
}

.modal-body .form-label,
.form-check-label,
option {
  font-family: Agency FB !important;
  font-size: 100% !important;
  color: #818181 !important;
}

.modal-body .form-control,
.form-select {
  font-family: Agency FB !important;
  font-size: 100% !important;
  background-color: #f3f3f3 !important;
  border: none;
  width: 100%;
}

.form-check-input {
  background-color: #c9c9c9 !important;
}

.pagination {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin-top: 15px;
  margin-bottom: 2%;
}

.page-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 6px 14px;
  cursor: pointer;
  border-radius: 4px;
  margin: 0 5px;
}

.page-button:hover {
  background-color: #0056b3;
}

.page-info {
  margin: 0 10px;
  font-size: 14px;
  color: #555;
}

@media (max-width: 768px) {
  .card {
    width: calc(50% - 20px);
  }
}

@media (max-width: 480px) {
  .card {
    width: 90%;
  }
}
</style>