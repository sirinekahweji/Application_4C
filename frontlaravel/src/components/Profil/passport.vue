<template>
  <div>
    <!-- Modal Consulter formation 4C -->
    <div
      class="modal fade"
      id="ModalconsultFormation4C"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              détails Formation :
            </h1>
            <button
              type="button"
              class="btn-close custom-close-btn"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <ul class="info" v-if="Object.keys(formation4CDetaills).length > 0">
              <div>
                <li>
                  <strong>Titre :</strong> {{ formation4CDetaills.titre }}
                </li>
                <li>
                  <strong>Type-formation :</strong>
                  {{ formation4CDetaills.type_formation }}
                </li>
                <li>
                  <strong>Description :</strong>
                  {{ formation4CDetaills.description }}
                </li>
              </div>
              <div>
                <li>
                  <strong>Catégorie :</strong>
                  {{ formation4CDetaills.categorie }}
                </li>
                <li>
                  <strong>Organisation:</strong>
                  {{ formation4CDetaills.organisation }}
                </li>
                <li><strong>Date :</strong>{{ formation4CDetaills.date }}</li>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--Fin Modal-->
    <!-- Modal Consulter attestation 4C -->

    <div
      class="modal fade"
      id="ModalconsultAttestation4C"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Télécharger attestation:
            </h1>
            <button
              type="button"
              class="btn-close custom-close-btn"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="modal-img">
              <img
                :src="attestationsDetaills.image"
                alt="4c"
                style="
                  width: 300px;
                  height: 250px;
                  margin-left: 15px;
                  margin-right: 10px;
                "
                class="img-modal"
              />
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="download(attestationsDetaills.image)"
              >
                Télécharger
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Fin Modal-->
    <!-- Modal telecharger certif -->
    <div
      class="modal fade"
      id="ModaltelechargerCertificat"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Télécharger Certificat:
            </h1>
            <button
              type="button"
              class="btn-close custom-close-btn"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="modal-img">
              <img
                :src="certifDetaills.certificat"
                alt="4c"
                style="
                  width: 300px;
                  height: 250px;
                  margin-left: 15px;
                  margin-right: 10px;
                "
                class="img-modal"
              />
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="download(certifDetaills.certificat)"
              >
                Télécharger
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Fin Modal-->
    <!-- Modal telecharger badge -->
    <div
      class="modal fade"
      id="Modaltelechargerbadge"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Télécharger badge:
            </h1>
            <button
              type="button"
              class="btn-close custom-close-btn"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="modal-img">
              <img
                :src="badgesDetaills.image"
                alt="4c"
                style="
                  width: 300px;
                  height: 250px;
                  margin-left: 15px;
                  margin-right: 10px;
                "
                class="img-modal"
              />
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="download(badgesDetaills.image, badgesDetaills.nom)"
              >
                Télécharger
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="passport">
      <h2>Passeport 4C</h2>
      <img src="@/assets/logo4c.png" alt="4c" />
    </div>
    <div class="cadres">
      <div class="badge-container">
        <h2 class="title-passport">Formations</h2>
        <table class="table">
          <thead>
            <tr>
              <th style="font-family: serif; color: #fab246">Titre</th>
              <th style="font-family: serif; color: #feb236">Categorie</th>
              <th style="font-family: serif; color: #feb236">Description</th>
            </tr>
          </thead>
          <tbody v-for="(formation, index) in formations" :key="index">
            <tr>
              <th scope="row" style="font-family: serif">
                {{ formation.titre }}
              </th>
              <th scope="row" class="badgetext" style="font-family: serif">
                {{ formation.categorie }}
              </th>
              <th scope="row" class="badgetext" style="font-family: serif">
                {{ formation.description }}
              </th>

              <th>
                <i
                  class="bi bi-info-circle"
                  data-bs-toggle="modal"
                  data-bs-target="#ModalconsultFormation4C"
                  @click="afficheDetails(index, 'formation4C')"
                ></i>
              </th>
              <th></th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="badge-container">
        <h2 class="title-passport">Certifications</h2>

        <table class="table">
          <thead>
            <tr>
              <th style="font-family: serif; color: #fab246">Titre</th>
              <th style="font-family: serif; color: #feb236">Categorie</th>
              <th style="font-family: serif; color: #feb236">Description</th>
            </tr>
          </thead>
          <tbody v-for="(cert, index) in certificats" :key="index">
            <tr>
              <th scope="row" style="font-family: serif">{{ cert.titre }}</th>
              <th scope="row" style="font-family: serif">
                {{ cert.categorie }}
              </th>
              <th scope="row" style="font-family: serif">
                {{ cert.description }}
              </th>
              <th><i class="bi bi-share-fill"></i></th>
              <th>
                <i
                  class="bi bi-arrow-down-circle"
                  data-bs-toggle="modal"
                  data-bs-target="#ModaltelechargerCertificat"
                  @click="afficheDetails(index, 'certificat4C')"
                ></i>
              </th>
              <th></th>
            </tr>
            <tr>
              <th scope="row" class="badgetext"></th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="badge-container">
        <h2 class="title-passport">Attestations</h2>
        <table class="table">
          <thead>
            <tr>
              <th style="font-family: serif; color: #fab246">Titre</th>
              <th style="font-family: serif; color: #feb236">Categorie</th>
              <th style="font-family: serif; color: #feb236">Description</th>
            </tr>
          </thead>
          <tbody v-for="(attest, index) in attestations" :key="index">
            <tr>
              <th scope="row" style="font-family: serif">{{ attest.nom }}</th>
              <th scope="row" class="badgetext" style="font-family: serif">
                {{ attest.type }}
              </th>
              <th scope="row" class="badgetext" style="font-family: serif">
                {{ attest.description }}
              </th>
              <th><i class="bi bi-share-fill"></i></th>
              <th>
                <i
                   class="bi bi-arrow-down-circle"
                  data-bs-toggle="modal"
                  data-bs-target="#ModalconsultAttestation4C"
                  @click="afficheDetails(index, 'attestation4C')"
                ></i>
              </th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="badge-container">
        <h2 class="title-passport">Badges</h2>
        <table class="table">
          <thead>
            <tr>
              <th style="font-family: serif; color: #fab246">Nom</th>
              <th style="font-family: serif; color: #feb236">Type</th>
            </tr>
          </thead>
          <tbody v-for="(badge, index) in badges" :key="index">
            <tr>
              <th scope="row" style="font-family: serif">{{ badge.nom }}</th>
              <th scope="row" class="badgetext" style="font-family: serif">
                {{ badge.type }}
              </th>
              <th><i class="bi bi-share-fill"></i></th>
              <th>
                <i
                  class="bi bi-arrow-down-circle"
                  data-bs-toggle="modal"
                  data-bs-target="#Modaltelechargerbadge"
                  @click="afficheDetails(index, 'badge')"
                ></i>
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import userbadgeServices from "@/services/userbadges.js";
import certificatServices from "@/services/certificats.js";
import formationServices from "@/services/formation.js";

import attestationsServices from "@/services/userattestation.js";

export default {
  data() {
    return {
      user: {},
      id_user: null,
      badges: [],
      certificats: [],
      formations: [],
    
      attestations: [],

      formation4CDetaills: {},
      certifDetaills: {},
      
      badgesDetaills: {},
      attestationsDetaills: {},
    };
  },
  mounted() {
    this.getallbadges(this.id_user);
    this.getcertificats(this.id_user);
    this.getallformation4C(this.id_user);
 
    this.getattestations(this.id_user);
  },
  created() {
    this.getallbadges();
    this.getcertificats();
    this.getallformation4C();

    this.getattestations();
    this.loadFromLocalStorage();
  },
  methods: {
    /*getUser() {
            UserService.getUser(this.cv_id).then((res) => {
                this.user = res.data.data;

            })*/

    loadFromLocalStorage() {
      const userData = localStorage.getItem("user");
      if (userData) {
        this.user = JSON.parse(userData);
        this.id_user = this.user.id;
      }
    },
    getallbadges(id) {
      userbadgeServices
        .getBadges(id)
        .then((response) => {
          console.log("badges:", response.data);
          this.badges = response.data;
        })
        .catch((error) => {
          console.log("Erreur lors de la récupération des badges :", error);
        });
    },
    getattestations(id) {
      attestationsServices
        .getallAttestationes(id)
        .then((response) => {
          console.log("attestations:", response.data);
          this.attestations = response.data;
        })
        .catch((error) => {
          console.log(
            "Erreur lors de la récupération des attestations:",
            error
          );
        });
    },

    getcertificats(id) {
      certificatServices
        .getAllCertificats(id)
        .then((response) => {
          console.log("certificats:", response.data);
          this.certificats = response.data;
        })
        .catch((error) => {
          console.log("Erreur lors de la sélection des certificats :", error);
        });
    },
    getallformation4C(id) {
      formationServices
        .getAllformation4C(id)
        .then((response) => {
          console.log("formations:", response.data);
          this.formations = response.data;
        })
        .catch((error) => {
          console.log("Erreur lors de la sélection des formations :", error);
        });
    },


    afficheDetails(indice, type) {
      if (type == "formation4C") {
        this.formation4CDetaills = this.formations[indice];
      } else if (type == "certificat4C") {
        this.certifDetaills = this.certificats[indice];
      } else if (type == "attestation4C") {
        this.attestationsDetaills = this.attestations[indice];
      } else if (type == "badge") {
        this.badgesDetaills = this.badges[indice];
      }
    },

    getImageNameFromUrl(imageUrl) {
      const url = new URL(imageUrl);
      const imageNameWithExtension = url.pathname.match(/[^/]+$/)[0];
      const imageName = imageNameWithExtension.split("?")[0];
      return imageName;
    },
    async download(urlImage) {
      try {
        const imageName = this.getImageNameFromUrl(urlImage);
        const response = await fetch(urlImage, { mode: "no-cors" });
        const blob = await response.blob();
        const blobUrl = URL.createObjectURL(
          new Blob([blob], { type: "image/*" })
        );
        const link = document.createElement("a");
        link.href = blobUrl;
        link.download = imageName;
        document.body.appendChild(link);
        link.click();
        // Clean up
        URL.revokeObjectURL(blobUrl);
        document.body.removeChild(link);
      } catch (error) {
        console.error(`Error downloading image: ${error}`);
      }
    },
  },
};
</script>
<style scoped>
.passport {
  display: flex;
  flex-direction: row;
  justify-content: center;
  margin-top: 3%;
  margin-bottom: 3%;
}

.passport img {
  width: 7% !important;
}

.passport h2 {
  color: #178feb;
  padding-top: 2%;
  padding-right: 1%;
  font-family: Impact;
}
.badge-container {
  overflow-y: scroll;

  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 1%; /* Espace entre les éléments */
  padding: 2%; /* Espace autour du contenu */
  background-color: #e2f1f8; /* Couleur de fond */
  border-radius: 10px; /* Bordure arrondie */
  width: 100%;
  height: 60%;
}

.cadres {
  display: flex;
  flex-direction: row;
  gap: 1%;
  justify-content: center;
}

.cadres h2 {
  font-size: 150%;
  color: #178feb;
  font-family: Impact;
  text-align: center;
  padding: 5%;
}

.cadres div {
  background-color: #e2f1f8;
  height: 400px !important;
  width: 23% !important;
  margin-bottom: 5% !important;
  border-radius: 10%;
}

.table i:hover {
  cursor: pointer;
  color: rgb(163, 214, 9);
}
.model-info {
  list-style: none;
}
@media screen and (max-width: 800px) {
  .cadres {
    flex-direction: column;
    width: 80%;
    margin-left: 15%;
  }

  .cadres div {
    width: 100% !important;
    margin-left: -6% !important;
  }
}
@media screen and (max-width: 480px) {
  .img-modal {
    width: 120% !important;
    height: 60% !important;
  }
  .model-info {
    list-style: none;
    font-size: 70% !important;
  }
  .model-info img {
    width: 80% !important;
    height: 60% !important;
  }
  .model-info div {
    display: flex;
    flex-direction: column;
    gap: 1%;
  }
  .modal-img {
    width: 80% !important;
    height: 60% !important;
  }
}
</style>
