<template>
  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Département</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nomDep" class="form-label">Nom Département</label>
                <input type="text" class="form-control" id="nomDep" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary btn-sm" @click="validerCreationDep()" data-bs-dismiss="modal">Valider</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade " id="ModalAjout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Spécialité</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label for="nomSp" class="form-label">Nom Spécialité :</label>
                <input type="text" class="form-control" id="nomSp" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary btn-sm" @click="validerCreationSpec()" data-bs-dismiss="modal">Valider</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="card-header">
      / Gestion des Départements
    </div>
    <div class="data">
      <div class="dep">
        <div class="titre">
          <img src="@/assets/menu.png" alt="menu"> Départements :
        </div>
        <div>
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-circle"></i>
          </button>
        </div>
      </div>
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div v-for="(item, index) in items" :key="index" class="accordion-item">
          <h2 class="accordion-header">
            <button @click="toggleAccordion(index)" class="accordion-button" type="button"
              :aria-expanded="isOpen[index]" :aria-controls="'panelsStayOpen-collapse' + index">
              <span class="accordion-icon">
                <img :src="isOpen[index] ? require('@/assets/down.png') : require('@/assets/right.png')">
              </span>
              {{ item.title }}
            </button>
            <div class="btn-droit">
              <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAjout">
                <img src="@/assets/add.png" alt="add">
              </button>
              <button type="button"  @click="confirmDeleteDep()">
                <img src="@/assets/delete.png" alt="delete">
              </button>
            </div>
          </h2>
          <div :id="'panelsStayOpen-collapse' + index" class="accordion-collapse collapse"
            :class="{ 'show': isOpen[index] }">
            <div class="accordion-body">
              <div class="options">
                <button class="option " v-for="(option, optionIndex) in item.options" :key="optionIndex"
                 type="button" @click="confirmDeleteSpec()">
                  - {{ option.name }}
                  <i class="bi bi-x-lg"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
export default {
  data() {
    return {
      items: [
        {
          title: "Technologies de l'Informatique",
          options: [
            { name: 'Tronc Commun' },
            { name: "Dévéloppement des systèmes d'information" },
            { name: 'Système Embarqué' },
            { name: 'Réseau' }
          ]
        },
        {
          title: 'Génie des procédés',
          options: []
        },
        {
          title: 'Gestion',
          options: []
        },
        {
          title: 'Mécanique',
          options: []
        },
        {
          title: 'Eléctrique',
          options: []
        },
      ],
      isOpen: []
    };
  },
  methods: {
    validerCreationDep() {
      Swal.fire({
          title: "Validé !",
          text: "Votre département a été créé !",
          icon: "success",
      }).then((result) => {
          if (result.isConfirmed) {
              // Ici, vous pouvez ajouter la logique pour supprimer le rôle
              // Après la suppression réussie, vous pouvez afficher un message de succès
          }
      });
    },
    validerCreationSpec() {
      Swal.fire({
          title: "Validé !",
          text: "Votre spécialité a été créée !",
          icon: "success",
      }).then((result) => {
          if (result.isConfirmed) {
              // Ici, vous pouvez ajouter la logique pour supprimer le rôle
              // Après la suppression réussie, vous pouvez afficher un message de succès
          }
      });
    },
    confirmDeleteSpec() {
        Swal.fire({
            title: "Êtes-vous sûr ?",
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oui, supprimer !"
        }).then((result) => {
            if (result.isConfirmed) {
                // Ici, vous pouvez ajouter la logique pour supprimer le rôle
                // Après la suppression réussie, vous pouvez afficher un message de succès
            }
        });
      },
      confirmDeleteDep() {
        Swal.fire({
            title: "Êtes-vous sûr ?",
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oui, supprimer !"
        }).then((result) => {
            if (result.isConfirmed) {
                // Ici, vous pouvez ajouter la logique pour supprimer le rôle
                // Après la suppression réussie, vous pouvez afficher un message de succès
            }
        });
      },
    toggleAccordion(index) {
      this.isOpen[index] = !this.isOpen[index];
    }
  },
  created() {
    this.isOpen = new Array(this.items.length).fill(false);
  }
};
</script>
<style scoped>
.card-header {
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

.data {
  border-radius: 10px;
  box-shadow: #818181 -2px 2px 4px;
  border: 1px solid #818181;
  background-color: var(--card-color);
  padding-left: 8%;
  padding-right: 8%;
}

.accordion-icon {
  margin-right: 2%;
}

.options {
  display: flex;
  flex-direction: column;
  padding-bottom: 0 !important;
  margin-bottom: 0 !important;
}

.option {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 5px 10px;
  margin-bottom: 1%;
  padding-bottom: 0;
  padding-left: 0;
  margin-left: 20%;
  border: none;
  background-color: transparent;
  cursor: pointer;
  font-size: 16px;
  border-bottom: #c5c4c4 1px solid;
  font-family: Agency FB;
  font-size: 100%;
  font-weight: bold;
  color: #818181;
}

.accordion-header {
  border-bottom: #c5c4c4 1px solid;
  padding-bottom: 0;
  padding-left: 0;
  margin-left: 10%;
  display: flex;
  flex-direction: row;
}

.accordion-item {
  border: none;
  background-color: var(--card-color);
}

.accordion-icon img {
  width: 70%;
}

.accordion-button {
  background-color: transparent;
  padding-bottom: 1% !important;
  padding-left: 0;
  font-family: Agency FB;
  font-size: 60%;
  font-weight: bold;
  color: #818181;
}

.option i {
  margin-left: 5px;
}

.accordion {
  width: 93%;
  margin-bottom: 10%;
}

.accordion-button::after {
  display: none;
}

.dep {
  margin-top: 5% !important;
  margin-left: 5% !important;
  color: #178FEB !important;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  border-bottom: #c5c4c4 2px solid;
  margin-bottom: 2%;
}
.titre{
  color: #178FEB !important;
}

.dep button {
  border: none;
  background-color: transparent;
}

.dep img {
  width: 15%;
  margin-bottom: 3%;
}

.dep div {
  font-family: Agency FB;
  font-size: 120%;
}

.btn-droit {
  display: flex;
  flex-direction: row;
}

.btn-droit button {
  background-color: transparent;
  border: none;
  color: #818181;
}

.btn-droit img {
  content: "";
  width: 25px;
  float: right;
}

.modal-dialog {
  width: 60% !important;
  height: 30% !important;
  margin-top: 50px;
  margin-bottom: 50px;
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
}

.modal-body .form-label {
  font-family: Agency FB !important;
  font-size: 100% !important;
  color: #696767 !important;
}

.modal-body .form-control {
  font-family: Agency FB !important;
  font-size: 100% !important;
  background-color: #f3f3f3 !important;
  width: 100%;
  border: #818181 solid;
  border-width: thin;
}

@media (max-width: 670px) {
  .option {
    justify-content: space-evenly;
    padding: 2px 2px;
    margin-bottom: 1%;
    padding-bottom: 0;
    padding-left: 0;
    margin-left: 5%;
    align-items: flex-start;
    justify-self: flex-start;
  }

  .options {
    width: 100% !important;
  }
}

#ModalSuppression .form-label,
#ModalSupp .form-label {
  font-size: 20px !important;
}
</style>