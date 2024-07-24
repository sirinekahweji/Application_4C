<template>
  <div>
    <div class="modal fade" id="modifierSessionModal" tabindex="-1" aria-labelledby="modifierSessionModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modifierSessionModalLabel">Modifier la Session</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="sessionDate" class="form-label">Date de la Session</label>
              <input type="text" class="form-control" id="sessionDate">
            </div>
            <div class="mb-3">
              <label for="sessionLieu" class="form-label">Lieu de la Session</label>
              <input type="text" class="form-control" id="sessionLieu">
            </div>
            <div class="mb-3">
              <label for="sessionHeure" class="form-label">Heure de la Session</label>
              <input type="text" class="form-control" id="sessionHeure">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" @click="validerModificationSession">Valider</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <form @submit.prevent="updateFormation4c">
              <div class="row">
                <!-- Partie gauche du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom de Formation</label>
                    <input type="text" v-model="formationModif.titre" id="nomInput" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" v-model="formationModif.dateLimiteInscription" id="dateInput"
                      class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="formateur" class="form-label">Formateur</label>
                    <input type="text" v-model="formationModif.formateur" id="formateurInput" class="form-control">
                  </div>
                  <!-- Ajoutez d'autres champs de formulaire au besoin -->
                </div>

                <!-- Partie droite du formulaire -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="lieu" class="form-label">Capacité </label>
                    <input type="text" v-model="formationModif.capacite" id="lieuInput" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="heure" class="form-label">Catégorie </label>
                    <input type="text" v-model="formationModif.categorie" id="heureInput" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">For Managers</label>
                    <div style="display: inline-block;">
                      <input type="radio" id="categorieInput0" value="0" v-model="formationModif.forManagers"
                        class="form-check-input">
                      <label for="categorieInput0" class="form-check-label">Non</label>
                    </div>
                    <div style="display: inline-block;">
                      <input type="radio" id="categorieInput1" value="1" v-model="formationModif.forManagers"
                        class="form-check-input">
                      <label for="categorieInput1" class="form-check-label">Oui</label>
                    </div>
                  </div>

                  <!-- Ajoutez d'autres champs de formulaire au besoin -->
                </div>
              </div>
              <div class="tableau-session">

                <div v-for="(session, index) in sessions" :key="index" class="mb-3 d-flex align-items-center">
                  <span class="mr-3">{{ index + 1 }}</span> <!-- Numéro de session -->
                  <div class="mr-3">
                    <label for="'sessionDateInput' + index">Date de la session</label>
                    <input type="text" :id="'sessionDateInput' + index" class="form-control" v-model="session.date">
                  </div>
                  <div class="mr-3">
                    <label for="'sessionLieuInput' + index">Lieu de la session</label>
                    <input type="text" :id="'sessionLieuInput' + index" class="form-control" v-model="session.lieu">
                  </div>
                  <div class="mr-3">
                    <label for="'sessionHeureInput' + index">Heure de la session</label>
                    <input type="text" :id="'sessionHeureInput' + index" class="form-control" v-model="session.heure">
                  </div>
                  <button class="btn btn-danger" @click="supprimerSession(index)">Supprimer</button>
                  <!-- Action pour supprimer la session -->
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
      <div class="filter-bar">
        <div class="d-flex align-items-center">
          <!-- Bouton de retour -->
          <button type="button" class="btn1 btn-primary me-auto" @click="retour()">Retour</button>
        </div>
        <div class="buttons-right">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            @click="ouvrirFormulaireModification"><img :src="require('@/assets/participant.png')"
              style="width:20px ; height:20px">Modifier formation</button>
          <button @click="confirmDelete" type="button" class="btn btn-primary">
            <i class="bi bi-trash-fill" style="width:20px ; height:20px;font-size: 15px;color: white;"></i>Delete
            Formation</button>
          <button type="button" class="btn btn-primary" @click="afficherContenu('liste')"><img
              :src="require('@/assets/li.png')" style="width:20px ; height:20px">Consulter Listes</button>
          <!-- <button type="button" class="btn btn-primary" @click="afficherContenu('statistiques')"><img
              :src="require('@/assets/sta.png')" style="width:20px ; height:20px">Statistiques</button> -->
        </div>
      </div>
      <div class="card-container">

        <div class="container" style="display: flex;" v-if="contenu === 'formation'">
          <div class="col-md-6">

            <div class="mb-3 d-flex align-items-center">
              <label for="nbSession" class="form-label">Nombre de Sessions</label>
              <span id="nbSessionSpan" class="form-c ml-2">{{ formation.nbSession }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="formateur" class="form-label">Formateur</label>
              <span id="formateurSpan" class="form-c ml-2">{{ formation.formateur }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="capacite" class="form-label">Capacité</label>
              <span id="capaciteSpan" class="form-c ml-2">{{ formation.capacite }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="dateLimiteInscription" class="form-label">Date</label>
              <span id="dateLimiteInscriptionSpan" class="form-c ml-2">{{ formation.dateLimiteInscription }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="titre" class="form-label">Titre</label>
              <span id="titreSpan" class="form-c ml-2">{{ formation.titre }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="categorie" class="form-label">Catégorie</label>
              <span id="categorieSpan" class="form-c ml-2">{{ formation.categorie }}</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
              <label for="forManagers" class="form-label">For Managers</label>
              <span v-if="formation.forManagers == 1" id="forManagersSpan" class="form-c ml-2">oui</span>
              <span v-else id="forManagersSpan" class="form-c ml-2">non</span>
            </div>


            <!-- Tableau pour les sessions -->
            <div class="tableau">
              <div class="con">
                <h4>Sessions :</h4>
              </div>
              <table class="table" style="margin-left:5px">
                <thead>
                  <tr>
                    <th scope="col">N° de Session</th>
                    <th scope="col">Date</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Heure</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>10 juin 2024</td>
                    <td>Salle A</td>
                    <td>9h-12h</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>15 juin 2024</td>
                    <td>Salle B</td>
                    <td>14h-17h</td>
                  </tr>
                  <!-- Ajoutez d'autres lignes manuellement au besoin -->
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6" style="display: flex;flex-direction: column;align-items: flex-end;">

            <div class="photo-c ml-2" style=" width:400px;     height: 400px;">
              <img v-if="imagepath != null" :src="getImageSource(imagepath)" alt="Votre image" class="photo"
                style="width:inherit; height:inherit;">
            </div>
            <div class="photo-c ml-2"
              style="margin-top: 100px;width: 200px;height: 200px;display: flex;flex-direction: column;align-items: center;padding-right: 100px;">
              <h1> Qr Code </h1>
              <svg ref="qrCode" style="width:inherit; height:inherit;" class="photo"></svg>
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
              <div class="bt">
                <input type="text" class="search-input" placeholder="Recherche..." v-model="searchQuery">
                <select class="select" v-model="selectedSession">
                  <option value="">Toutes les Sessions</option>
                  <option v-for="(session, index) in sessions" :key="index" :value="session">{{ session.name }}</option>
                </select>
              </div>
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

import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from "sweetalert2";
import Formations4csServices from '@/services/Formations4cs';


export default {
  components: {

  },
  data() {
    return {
      contenu: 'formation',// Variable pour suivre le contenu actuel de card-container
      sessions: [ // Tableau des sessions
        { date: '10 juin 2024', lieu: 'Salle A', heure: '9h-12h' },
        { date: '15 juin 2024', lieu: 'Salle B', heure: '14h-17h' }
      ],
      // Ajoutez d'autres sessions au besoin
      idFormation: null,
      formation: {},
      formationModif: {},
      participants: [],
      presences: [],
      imagepath: null,
    };
  },
  computed: {

  },
  created() {
    this.idFormation = this.$route.params.id;
    this.getDetailFormation4c();
    /*this.GetParticipantsCertif();
    this.GetPresenceCertif();*/
  },
  resetData() {
    this.cards = this.getformations();
  },
  methods: {
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
          this.deleteFormation4c();
        }
      });
    },
    deleteFormation4c() {
      Formations4csServices.deleteFormation4c(this.idFormation)
        .then(() => {
          Swal.fire(
            'Deleted!',
            'Your Formation has been deleted.',
            'success'
          ).then(() => {
            this.$router.go(-1); // Retourne à la page précédente
          });
        })
        .catch(() => {
          Swal.fire(
            'Error!',
            'There was an error deleting your Formation.',
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
    /*GetParticipantsCertif() {
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
    },*/
    codeQr() {
      const svgString = this.formation.code_qr;
      const qrElement = this.$refs.qrCode;
      qrElement.innerHTML = svgString;
    },
    getDetailFormation4c() {
      Formations4csServices.getDetailFormation4c(this.idFormation)
        .then((res) => {
          this.formation = res.data;
          this.formationModif = res.data;
          this.imagepath = this.formation.affiche;
          this.codeQr();
          //console.log(this.formation);
        })
        .catch((error) => {
          console.error('Une erreur s\'est produite lors de la récupération des détails du fromation :', error);
        });
    },
    updateFormation4c() {
      Formations4csServices.updateFormation4c(this.idFormation, this.formationModif);
    },


    ajouterSession() {
      this.sessions.push({ date: '', lieu: '', heure: '' }); // Ajoute une nouvelle session vide
    },
    supprimerSession() {
      if (this.sessions.length > 1) {
        this.sessions.pop(); // Supprime la dernière session du tableau
      }
    },
    mettreAJourInformations() {
      // Mettre à jour les informations des sessions dans le tableau des sessions
      for (let i = 0; i < this.sessions.length; i++) {
        const session = this.sessions[i];
        session.date = document.getElementById('sessionDateInput' + i).value;
        // Mettez à jour les autres propriétés de session au besoin
      }
    },
    ouvrirFormulaireModification() {
      /*// Récupérer les informations du certificat actuellement affiché dans card-container
      const Formation = {
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
      document.getElementById('nomInput').value = Formation.nom;
      document.getElementById('dateInput').value = Formation.date;
      document.getElementById('formateurInput').value = Formation.formateur;
      document.getElementById('organisateurInput').value = Formation.organisateur;
      document.getElementById('mediaInput').value = Formation.media;
      document.getElementById('lieuInput').value = Formation.lieu;
      document.getElementById('heureInput').value = Formation.heure;
      document.getElementById('prixInput').value = Formation.prix;
      document.getElementById('cibleInput').value = Formation.cible;
      // Pré-remplissez d'autres champs au besoin*/
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
  height: 44px;
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
  align-items: center;

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
  padding-top: 25px;

}

.btn {
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.btn1 {
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  color: #007bff;
  background-color: white;
  border: none;
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
  margin-right: 100px;
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
  height: 44px;
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

.form-label {
  font-size: 18px;
  font-family: cursive;
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