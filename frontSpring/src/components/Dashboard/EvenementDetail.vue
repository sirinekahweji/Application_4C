<template>
  <div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <form @submit.prevent="updateEvenement">
              <div class="row">
                <!-- Partie gauche du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'evenement</label>
                    <input type="text" v-model="evenement.titre" class="form-control" id="nom" required>
                  </div>
                  <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" v-model="evenement.date" class="form-control" id="date" required>
                  </div>
                  <div class="mb-3">
                    <label for="dateLimiteInscription" class="form-label">Date Limite
                      Inscription</label>
                    <input type="date" v-model="evenement.dateLimiteInscription" class="form-control"
                      id="dateLimiteInscription" required>
                  </div>
                  <div class="mb-3">
                    <label for="message" class="form-label">Description De
                      l'Evenement</label>
                    <textarea v-model="evenement.description" class="form-control" id="message" rows="3"></textarea>
                  </div>
                  <!-- Ajoutez d'autres champs de formulaire au besoin -->
                </div>

                <!-- Partie droite du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu </label>
                    <input type="text" v-model="evenement.lieu" class="form-control" id="lieu" required>
                  </div>
                  <div class="mb-3">
                    <label for="capacite" class="form-label">Capacite </label>
                    <input type="text" v-model="evenement.capacite" class="form-control" id="capacite" required>
                  </div>
                  <div class="mb-3">
                    <label for="categorie" class="form-label">Categorie </label>
                    <input type="text" v-model="evenement.categorie" class="form-control" id="categorie" required>
                  </div>
                  <div class="mb-3">
                    <label for="organisateur" class="form-label">Organisateur </label>
                    <input type="text" v-model="evenement.organisateur" class="form-control" id="organisateur" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Manager 4C ?</label>
                    <div class="form-check">
                      <input type="radio" id="categorieInput0" value="1" v-model="evenement.forManagers"
                        class="form-check-input">
                      <label class="form-check-label" for="manager">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input type="radio" id="categorieInput1" value="0" v-model="evenement.forManagers"
                        class="form-check-input">
                      <label class="form-check-label" for="tous">
                        No
                      </label>
                    </div>
                  </div>
                  <!-- Ajoutez d'autres champs de formulaire au besoin -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Valider</button>
              </div>
            </form>
            <!-- Textarea qui prend tout le width -->
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="card-header">
        / DetailEvenement
      </div>
      <div class="filter-bar">
        <div class="buttons-right">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            @click="ouvrirFormulaireModification"><img :src="require('@/assets/participant.png')"
              style="width:20px ; height:20px">Modifier Evenement</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('liste')"><img
              :src="require('@/assets/participant.png')" style="width:20px ; height:20px">Consulter Listes</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('statistiques')"><img
              :src="require('@/assets/participant.png')" style="width:20px ; height:20px">Statistiques</button>

        </div>
      </div>
      <div class="card-container">

        <div class="container" style="display: flex;" v-if="contenu === 'Evenement'">
          <div class="col-md-6">
            <div class="mb-3 d-flex align-items-center">
              <label for="nom" class="form-label">Nom de Evenement</label>
              <span id="nomSpan" class="form-c ml-2">{{ evenement.titre }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="date" class="form-label">Date</label>
              <span id="dateSpan" class="form-c ml-2">{{ evenement.date }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="formateur" class="form-label">Date Limite Inscription</label>
              <span id="formateurSpan" class="form-c ml-2">{{ evenement.dateLimiteInscription }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="organisateur" class="form-label">Lieu</label>
              <span id="organisateurSpan" class="form-c ml-2"> {{ evenement.lieu }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">Capacite</label>
              <span id="mediaSpan" class="form-c ml-2">{{ evenement.capacite }}</span>
            </div>

            <!-- Ajoutez d'autres champs de formulaire au besoin -->


            <!-- Partie droite du formulaire -->

            <div class="mb-3 d-flex align-items-center">
              <label for="lieu" class="form-label">Categorie </label>
              <span id="lieuSpan" class="form-c ml-2">{{ evenement.categorie }}</span>
            </div>
            <div class="mb-3 d-flex align-items-center">
              <label for="heure" class="form-label">Organisateur </label>
              <span id="heureSpan" class="form-c ml-2">{{ evenement.organisateur }}</span>
            </div>
            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">For Managers</label>
              <span v-if="this.evenement.forManagers == 1" id="mediaSpan" class="form-c ml-2">oui</span>
              <span v-else id="mediaSpan" class="form-c ml-2">non</span>
            </div>
            <div class="mb-6 d-flex align-items-center">
              <label for="cible" class="form-label">Description De l'Evenement :</label>
            </div>
            <div class="mb-6 d-flex align-items-center">
              <span id="cibleSpan" class="form-c ml-2">{{ evenement.description }}</span>
            </div>




            <div class="photo-c ml-2" style=" margin-top: 70px;
    width: 200px;
    height: 200px;
    display: flex;
    flex-direction: column;">
              <h1> Qr Code </h1>
              <svg ref="qrCode" style="width:inherit; height:inherit;" class="photo"></svg>
            </div>
          </div>

          <div class="col-md-6">
            <div class="photo-c ml-2" style=" width:400px;     height: 400px;">
              <img :src="require('@/assets/347440031_1437954420340306_647493635146913569_n.jpg')" alt="Votre image"
                class="photo" style="width:inherit; height:inherit;">
            </div>


          </div>
        </div>

        <div v-else-if="contenu === 'liste'" style="display: flex;
    /* flex-wrap: wrap; */
    flex-direction: column;
    gap: 30px; flex-grow: 1;">


          <!-- Contenu à afficher lorsque 'liste' est sélectionné -->
          <!-- Tableau pour la liste des inscrits -->
          <div class="tableau">
            <div class="con">
              <h4>Liste des Inscrits :</h4>
              <div class="ligne">
                <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i> Filtrer</button>
                <button class="download" @click="telechargerPDF()"><i class="bi bi-download"></i> Télécharger</button>
                <button class="imprimer" @click="imprimerPDF"><i class="bi bi-printer"></i> Imprimer</button>
              </div>
            </div>
            <table class="table" style="margin-left:5px">
              <thead>
                <tr>
                  <th scope="col">N°CIN</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Prenom</th>
                  <th scope="col">Gmail</th>
                  <th scope="col">Telephone</th>
                  <th scope="col">Rôle</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>55666</td>
                  <td>Houssem</td>
                  <td>werhani</td>
                  <td>mohamedamine.bejaoui.98@gmail.cpm</td>
                  <td>256584555</td>
                  <td>Manager</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>

                    <button class="action-button">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-button" @click="confirmSuppression(profil.id)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>55666</td>
                  <td>Houssem</td>
                  <td>werhani</td>
                  <td>mohamedamine.bejaoui.98@gmail.cpm</td>
                  <td>256584555</td>
                  <td>Manager</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>

                    <button class="action-button">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-button" @click="confirmSuppression(profil.id)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>55666</td>
                  <td>Houssem</td>
                  <td>werhani</td>
                  <td>mohamedamine.bejaoui.98@gmail.cpm</td>
                  <td>256584555</td>
                  <td>Manager</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>

                    <button class="action-button">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-button" @click="confirmSuppression(profil.id)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Tableau pour la liste des participants -->
          <div class="tableau">
            <div class="con">
              <h4>Liste des Participants :</h4>
              <div class="ligne">
                <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i> Filtrer</button>
                <button class="download" @click="telechargerPDF()"><i class="bi bi-download"></i> Télécharger</button>
                <button class="imprimer" @click="imprimerPDF"><i class="bi bi-printer"></i> Imprimer</button>
              </div>
            </div>
            <table class="table" style="margin-left:5px">
              <thead>
                <tr>
                  <th scope="col">N°CIN</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Prenom</th>
                  <th scope="col">Gmail</th>
                  <th scope="col">Telephone</th>
                  <th scope="col">Rôle</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Données manuelles pour la liste des participants -->
                <tr>
                  <td>55666</td>
                  <td>Houssem</td>
                  <td>werhani</td>
                  <td>mohamedamine.bejaoui.98@gmail.cpm</td>
                  <td>256584555</td>
                  <td>Manager</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>

                    <button class="action-button">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-button" @click="confirmSuppression(profil.id)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>55666</td>
                  <td>Houssem</td>
                  <td>werhani</td>
                  <td>mohamedamine.bejaoui.98@gmail.cpm</td>
                  <td>256584555</td>
                  <td>Manager</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>

                    <button class="action-button">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-button" @click="confirmSuppression(profil.id)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
                <!-- Ajoutez d'autres lignes manuellement au besoin -->
              </tbody>
            </table>
          </div>
        </div>

        <div v-else-if="contenu === 'statisques'">

        </div>

      </div>

    </div>
  </div>




</template>


<script>

import EvenementService from '@/services/evenements';

export default {
  components: {

  },
  data() {
    return {
      contenu: 'Evenement',// Variable pour suivre le contenu actuel de card-container
      sessions: [ // Tableau des sessions
        { date: '10 juin 2024', lieu: 'Salle A', heure: '9h-12h' },
        { date: '15 juin 2024', lieu: 'Salle B', heure: '14h-17h' }
      ],
      idEvenement: null,
      evenement: {}
      // Ajoutez d'autres sessions au besoin
    };
  },
  computed: {

  },

  resetData() {
    this.cards = this.getEvenements();
  },
  created() {
    this.idEvenement = this.$route.params.id;
    this.idCertif = this.$route.params.id;
    this.$watch('searchQuery', () => {
      this.recherche();
    });
    this.getDetailEvenement();
  },
  methods: {
    codeQr() {
      const svgString = this.certif.code_qr;
      const qrElement = this.$refs.qrCode;
      qrElement.innerHTML = svgString;
    },
    getDetailEvenement() {
      EvenementService.getDetailEvenement(this.idEvenement)
        .then((res) => {
          this.evenement = res.data;
          this.codeQr();
          //console.log(this.certif);
        })
        .catch((error) => {
          console.error('Une erreur s\'est produite lors de la récupération des détails du certificat :', error);
        });
    },
    updateEvenement() {
      EvenementService.updateEvenement(this.idEvenement, this.evenement);
    },


    ajouterSession() {
      this.sessions.push({ date: '', lieu: '', heure: '' }); // Ajoute une nouvelle session vide
    },
    supprimerSession() {
      if (this.sessions.length > 1) {
        this.sessions.pop(); // Supprime la dernière session du tableau
      }
    },
    mettreAJourInEvenements() {
      // Mettre à jour les inEvenements des sessions dans le tableau des sessions
      for (let i = 0; i < this.sessions.length; i++) {
        const session = this.sessions[i];
        session.date = document.getElementById('sessionDateInput' + i).value;
        // Mettez à jour les autres propriétés de session au besoin
      }
    },


    afficherContenu(option) {
      this.contenu = option; // Change le contenu en fonction de l'option sélectionnée
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

.tableau-session {
  max-width: 100%;
  /* Définissez la largeur maximale de votre choix */
  overflow-x: auto;
  /* Ajoutez une barre de défilement horizontale si nécessaire */
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