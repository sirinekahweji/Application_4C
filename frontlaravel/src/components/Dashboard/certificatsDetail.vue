<template>
  <div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-body">
            <form @submit.prevent="updateCertificat4c">
              <div class="row">
                <!-- Partie gauche du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom de Certificat</label>
                    <input type="text" id="nomInput" v-model="certif.nom" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" id="lieuInput" v-model="certif.lieu" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="affiche" class="form-label">Affiche</label>
                    <input type="text" id="afficheInput" v-model="certif.affiche" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="affiche" class="form-label">certificat</label>
                    <input type="text" id="afficheInput" v-model="certif.certificat" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="capacite" class="form-label">Capacité</label>
                    <input type="number" id="capaciteInput" v-model="certif.capacite" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="dateInput" v-model="certif.date" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="dateLimiteInscription" class="form-label">Date Limite d'Inscription</label>
                    <input type="date" id="dateLimiteInscriptionInput" v-model="certif.dateLimiteInscription"
                      class="form-control">
                  </div>
                  <!-- Ajoutez d'autres champs de formulaire au besoin -->
                </div>

                <!-- Partie droite du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" id="prixInput" v-model="certif.prix" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="offre" class="form-label">Offre</label>
                    <input type="number" id="offreInput" v-model="certif.offre" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="organisation" class="form-label">Organisation</label>
                    <input type="text" id="organisationInput" v-model="certif.organisation" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <input type="text" id="categorieInput" v-model="certif.categorie" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="descriptionInput" v-model="certif.description" class="form-control"></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">For Managers</label>
                    <div style="display: inline-block;">
                      <input type="radio" id="categorieInput0" value="0" v-model="certif.forManagers"
                        class="form-check-input">
                      <label for="categorieInput0" class="form-check-label">Non</label>
                    </div>
                    <div style="display: inline-block;">
                      <input type="radio" id="categorieInput1" value="1" v-model="certif.forManagers"
                        class="form-check-input">
                      <label for="categorieInput1" class="form-check-label">Oui</label>
                    </div>
                  </div>
                  <!-- Ajoutez d'autres champs de formulaire au besoin -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Valider</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="card-header">
        / DetailCertificat
      </div>
      <div class="filter-bar">
        <div class="buttons-right">
          <!-- <button type="button" class="btn btn-primary"><img :src="require('@/assets/participant.png')"
              style="width:20px ; height:20px"> Participer</button> -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            @click="ouvrirFormulaireModification"><img :src="require('@/assets/participant.png')"
              style="width:20px ; height:20px">Modifier Certificat</button>
          <button @click="confirmDelete" type="button" class="btn btn-primary">
            <i class="bi bi-trash-fill" style="width:20px ; height:20px;font-size: 15px;color: white;"></i>Delete
            Certificat</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('liste')"><img
              :src="require('@/assets/participant.png')" style="width:20px ; height:20px">Consulter Listes</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('statistiques')"><img
              :src="require('@/assets/participant.png')" style="width:20px ; height:20px">Statistiques</button>

        </div>
      </div>
      <div class="card-container">

        <div class="container" style="display: flex;" v-if="contenu === 'certifact'">
          <div class="col-md-6">
            <div class="mb-3 d-flex align-items-center">
              <label for="nom" class="form-label">Nom de Certificat</label>
              <span id="nomSpan" class="form-c ml-2">{{ this.certif.nom }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="date" class="form-label">Lieu</label>
              <span id="dateSpan" class="form-c ml-2"> {{ this.certif.lieu }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="formateur" class="form-label">Capacite</label>
              <span id="formateurSpan" class="form-c ml-2"> {{ this.certif.capacite }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="organisateur" class="form-label">Date</label>
              <span id="organisateurSpan" class="form-c ml-2"> {{ this.certif.date }} </span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">Date Limite Inscription</label>
              <span id="mediaSpan" class="form-c ml-2">{{ this.certif.dateLimiteInscription }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">Prix</label>
              <span id="mediaSpan" class="form-c ml-2">{{ this.certif.prix }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">Offre</label>
              <span id="mediaSpan" class="form-c ml-2">{{ this.certif.offre }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">Organisation</label>
              <span id="mediaSpan" class="form-c ml-2">{{ this.certif.organisation }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">Categorie</label>
              <span id="mediaSpan" class="form-c ml-2">{{ this.certif.categorie }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="media" class="form-label">For Managers</label>
              <span v-if="this.certif.forManagers == 1" id="mediaSpan" class="form-c ml-2">oui</span>
              <span v-else id="mediaSpan" class="form-c ml-2">non</span>
            </div>




            <!-- Ajoutez d'autres champs de formulaire au besoin -->


            <!-- Partie droite du formulaire -->

            <div class="photo-c ml-2" style=" margin-top: 70px;
    width: 200px;
    height: 200px;
    display: flex;
    flex-direction: column;">
              <h1> Qr Code </h1>
              <svg ref="qrCode" style="width:inherit; height:inherit;" class="photo"></svg>
              <button class="btn btn-primary" @click="downloadQRCode">Télécharger code QR</button>
            </div>
          </div>

          <div class="col-md-6">
            <div class="photo-c ml-2" style=" width:400px;     height: 400px;">
              <img v-if="imagepath != null" :src="getImageSource(imagepath)" alt="Votre image" class="photo"
                style="width:inherit; height:inherit;">
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
              <h4>Liste des Participants certificat :</h4>
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
                <tr v-for="participant in participants" :key="participant.id">
                  <td>{{ participant.cin }}</td>
                  <td>{{ participant.prenom }}</td>
                  <td>{{ participant.nom }}</td>
                  <td>{{ participant.email }}</td>
                  <td>{{ participant.phoneNumber }}</td>
                  <td>{{ participant.role_id }}</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Tableau pour la liste des participants -->
          <div class="tableau">
            <div class="con">
              <h4>Liste des Presences certificat :</h4>
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
                <tr v-for="presence in presences" :key="presence.id">
                  <td>{{ presence.cin }}</td>
                  <td>{{ presence.prenom }}</td>
                  <td>{{ presence.nom }}</td>
                  <td>{{ presence.email }}</td>
                  <td>{{ presence.phoneNumber }}</td>
                  <td>{{ presence.role_id }}</td>
                  <td>
                    <button class="action-button" type="button">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <!-- Ajoutez d'autres lignes manuellement au besoin -->
              </tbody>
            </table>
          </div>
        </div>

        <div v-else-if="contenu === 'statisques'">
          <canvas id="progress-chart" class="m-2"></canvas>
        </div>

      </div>

    </div>
  </div>




</template>


<script>

import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from "sweetalert2";
import certificat4cService from '@/services/certificat4cs';
import Certificat4cService from '@/services/Certificat4c';
import Chart from 'chart.js/auto';

export default {
  components: {

  },
  data() {
    return {
      cards: [],
      searchQuery: '',
      selectedCategory: '',
      showModal: true,
      itemsPerPage: 8,
      currentPage: 1,
      contenu: 'certifact',
      idCertif: null,
      certif: {},
      participants: [],
      presences: [],
      imagepath: null,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.cards.length / this.itemsPerPage);
    },
    displayedItems() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.cards.slice(startIndex, endIndex);
    }
  },
  created() {
    this.idCertif = this.$route.params.id;
    this.$watch('searchQuery', () => {
      this.recherche();
    });
    this.getCertificats();
    this.getDetailCertificat4c();
    this.GetParticipantsCertif();
    this.GetPresenceCertif();
  },
  resetData() {
    this.cards = this.getCertificats();
  },
  methods: {
    downloadQRCode() {
      const svgString = this.certif.code_qr;
      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');
      const image = new Image();
      image.onload = () => {
        canvas.width = image.width;
        canvas.height = image.height;
        context.drawImage(image, 0, 0);
        const imageURL = canvas.toDataURL('image/png');
        const downloadLink = document.createElement('a');
        downloadLink.href = imageURL;
        downloadLink.download = 'qrcode.png';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      };
      image.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgString)));
    },
    confirmDelete() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteCertificat4c();
        }
      });
    },
    deleteCertificat4c() {
      Certificat4cService.deleteCertificat4c(this.idCertif)
        .then(() => {
          Swal.fire(
            'Deleted!',
            'Your certificate has been deleted.',
            'success'
          ).then(() => {
            this.$router.go(-1); // Retourne à la page précédente
          });
        })
        .catch(() => {
          Swal.fire(
            'Error!',
            'There was an error deleting your certificate.',
          );
        });
    },
    getImageSource(image) {
      // Check if the image is an external URL
      if (image.startsWith('http://') || image.startsWith('https://')) {
        return image;
      } else {
        // Treat it as a local path
        return require(`@/${image}`);
      }
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
    GetParticipantsCertif() {
      Certificat4cService.GetParticipantsCertif(this.idCertif)
        .then((res) => {
          if (res.data.length > 0) {
            res.data.forEach(participant => {
              Certificat4cService.GetUser(participant.user_id)
                .then((res) => {
                  this.participants.push(res.data.data);
                })
                .catch((error) => {
                  console.error('Une erreur s\'est produite lors de la récupération de presence certif :', error);
                });
            });
          } else {
            console.log("Aucun participant trouvé pour ce certificat.");
          }
        })
        .catch((error) => {
          console.error('Une erreur s\'est produite lors de la récupération de participants certif :', error);
        });
    },
    GetPresenceCertif() {
      Certificat4cService.GetPresenceCertif(this.idCertif)
        .then((res) => {
          if (res.data.length > 0) {
            res.data.forEach(participant => {
              Certificat4cService.GetUser(participant.user_id)
                .then((res) => {
                  this.presences.push(res.data.data);
                })
                .catch((error) => {
                  console.error('Une erreur s\'est produite lors de la récupération de presence certif :', error);
                });
            });
          } else {
            console.log("Aucun participant trouvé pour ce certificat.");
          }
        })
        .catch((error) => {
          console.error('Une erreur s\'est produite lors de la récupération de presence certif :', error);
        });
    },
    codeQr() {
      const svgString = this.certif.code_qr;
      const qrElement = this.$refs.qrCode;
      qrElement.innerHTML = svgString;
    },
    getDetailCertificat4c() {
      Certificat4cService.getDetailCertificat4c(this.idCertif)
        .then((res) => {
          this.certif = res.data;
          this.imagepath = this.certif.certificat;
          this.codeQr();
          //console.log(this.certif);
        })
        .catch((error) => {
          console.error('Une erreur s\'est produite lors de la récupération des détails du certificat :', error);
        });
    },
    updateCertificat4c() {
      Certificat4cService.updateCertificat4c(this.idCertif, this.certif);
    },






    /* ouvrirFormulaireModification() {
      // Récupérer les informations du certificat actuellement affiché dans card-container
      const certificat = {
        nom: document.getElementById('nomSpan').textContent,
        date: document.getElementById('dateSpan').textContent,
        formateur: document.getElementById('formateurSpan').textContent,
        organisateur: document.getElementById('organisateurSpan').textContent,
        media: document.getElementById('mediaSpan').textContent,
        lieu: document.getElementById('lieuSpan').textContent,
        heure: document.getElementById('heureSpan').textContent,
        prix: document.getElementById('prixSpan').textContent,
        cible: document.getElementById('cibleSpan').textContent,
        // Ajoutez d'autres champs au besoin
      };
  
      // Pré-remplir les champs du formulaire modal avec les informations récupérées
      document.getElementById('nomInput').value = certificat.nom;
      document.getElementById('dateInput').value = certificat.date;
      document.getElementById('formateurInput').value = certificat.formateur;
      document.getElementById('organisateurInput').value = certificat.organisateur;
      document.getElementById('mediaInput').value = certificat.media;
      document.getElementById('lieuInput').value = certificat.lieu;
      document.getElementById('heureInput').value = certificat.heure;
      document.getElementById('prixInput').value = certificat.prix;
      document.getElementById('cibleInput').value = certificat.cible;
      // Pré-remplissez d'autres champs au besoin
    }, */


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
    getCertificats() {
      certificat4cService.getAll().then((res) => {
        this.cards = res.data.data;
      })
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