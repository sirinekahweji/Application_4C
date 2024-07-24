<template>
  <div>
    <div class="container">
      <div class="card-header">
        / Evenements
      </div>
      <div class="filter-bar">
        <div class="search-container">
          <span class="search-icon"><i class="bi bi-search"></i></span>
          <input type="text" class="search-input" placeholder="Chercher Evenement..." v-model="searchQuery">
        </div>
        <div class="bt">
          <select class="select" v-model="selectedCategory">
            <option value="">--choisir la catégorie--</option>
            <option v-for="(card, index) in cards" :key="index" :value="card.categorie">{{
            card.categorie }}</option>
          </select>
          <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i>
            Filtrer</button>
        </div>
      </div>
      <div class="card-container">
        <event v-for="(card, index) in displayedItems" :key="index" :id="card.id" :name="card.titre" :affiche="card.affiche" />
      </div>
      <div class="pagination">
        <button @click="previousPage" :disabled="currentPage === 1" class="page-button">Précédent</button>
        <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages" class="page-button">Suivant</button>
      </div>
    </div>
  </div>
</template>
<script>
import event from '@/components/Dashboard/dashboard/event.vue'
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import EventService from "@/services/evenements.js";
export default {
  components: {
    event,
  },
  data() {
    return {
      cards: [],
      showModal: true,
      searchQuery: '',
      selectedCategory: '',
      itemsPerPage: 8,
      currentPage: 1,
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
  resetData() {
    this.cards = this.getEvents();
  },
  created() {
    this.$watch('searchQuery', () => {
      this.recherche();
    });
    this.getEvents();
  },
  methods: {
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
    validerCreation() {
      Swal.fire({
        title: "Validé !",
        text: "Votre événement a été crée !",
        icon: "success",
      }).then((result) => {
        if (result.isConfirmed) {
          // Ici, vous pouvez ajouter la logique pour supprimer le rôle
          // Après la suppression réussie, vous pouvez afficher un message de succès
        }
      });
    },
    filtrerDonnees() {
      if (!this.selectedCategory) {
        this.cards = this.getEvents();
      } else {
        this.cards = this.cards.filter(teacher => teacher.categorie === this.selectedCategory);
      }
    },
    recherche() {
      if (this.searchQuery === '') {
        this.getEvents();
      } else {
        this.cards = this.cards.filter(card => {
          return card.titre.toLowerCase().includes(this.searchQuery.toLowerCase());
        });
      }
    },
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    getEvents() {
      EventService.getEvenementDisponible().then((res) => {
        this.cards = res.data;
      })
      EventService.getEvenementNonDisponible().then((res) => {
        this.cards.push(...res.data);
      })

    },
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
  padding-left: 80px;
    padding-right: 80px;
}

.filter-bar {
  display: flex;
  align-items: center;
  margin-top: 10px;
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

.filter-button .bi {
  width: 20px;
}

.buttons-right {
  margin-left: auto;
}

.buttons-right button {
  font-size: 80%;
  padding: 12px;
  margin-top: 3%;
  border-radius: 10px;

}

.buttons-right button i {
  color: #FFFFFF !important;
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