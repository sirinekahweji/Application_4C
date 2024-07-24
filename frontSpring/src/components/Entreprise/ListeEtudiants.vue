<template>
  <div class="container">
    <div class="data">
      <div class="filter-bar">
        <div class="bt">
          <input type="text" class="search-input" placeholder="Recherche..." v-model="searchQuery">
          <!--<select class="select" v-model="selectedRole">
            <option value="">Tous les rôles</option>
            <option value="Enseignant">Enseignant</option>
            <option value="Etudiant">Etudiant</option>
            <option value="Entreprise">Entreprise</option>
          </select>-->
        </div>
        <div class="ligne">
          <!--<button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i> Filtrer</button>-->
          <button class="download-button" @click="telechargerPDF()"><i class="bi bi-download"></i> Télécharger</button>
          <button class="print-button" @click="imprimerPDF"><i class="bi bi-printer"></i> Imprimer</button>
        </div>
      </div>
      <h4>Liste des Etudiants</h4>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">N°CIN</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Gmail</th>
            <th scope="col">Passepot</th>
            <th scope="col">CV</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in displayedItems" :key="index">
            <td class="text-truncate" style="max-width: 30px;">{{ user.cin }}</td>
            <td class="text-truncate" style="max-width: 50px;">{{ user.nom }}</td>
            <td class="text-truncate" style="max-width: 50px;">{{ user.prenom }}</td>
            <td class="text-truncate" style="max-width: 80px;">{{ user.email }}</td>
            <td>
              <router-link to="/Profile">
                <button class="action-button">
                  <img src="@/assets/consulter.png" alt="">
                </button>
              </router-link>
            </td>
            <td>
              <router-link to="/Profile">
                <button class="action-button">
                  <img src="@/assets/consulter.png" alt="">
                </button>
              </router-link>
            </td>
          </tr>
        </tbody>
        <tfoot v-if="totalPages > 1">
          <tr>
            <td colspan="7">
              <div class="pagination">
                <button @click="previousPage" :disabled="currentPage === 1" class="page-button">Précédent</button>
                <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                <button @click="nextPage" :disabled="currentPage === totalPages" class="page-button">Suivant</button>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import Swal from 'sweetalert2'
import UserService from '@/services/users'
export default {
  data() {
    return {
      users: [],
      selectedRole: '',
      searchQuery: '',
      itemsPerPage: 6,
      currentPage: 1,
    };
  },
  resetData() {
    this.users = [...this.getUser()];
  },
  created() {
    this.$watch('searchQuery', () => {
      this.recherche();
    });
    this.getUser();
  },
  computed: {
    totalPages() {
      return Math.ceil(this.users.length / this.itemsPerPage);
    },
    displayedItems() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.users.slice(startIndex, endIndex);
    }
  },
  methods: {
    getUser() {
      UserService.getAllEtudiant().then((res) => {
        this.users = res.data.data;
        console.log(this.users);
      })
    },
    confirmSuppression() {
      Swal.fire({
        title: "Êtes-vous sûr ?",
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui, Supprimer !"
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteTeacher();
        }
      });
    },
    recherche() {
      if (this.searchQuery === '') {
        this.getUser();
      } else {
        this.users = this.users.filter(teacher => {
          return teacher.nom.toLowerCase().includes(this.searchQuery.toLowerCase());
        });
      }
    },
    deleteTeacher(filtrage) {
      const index = this.users.indexOf(filtrage);
      if (index !== -1) {
        this.users.splice(index, 1);
      }
    },
    filtrerDonnees() {
      if (!this.selectedRole) {
        this.users = [...this.teachers];
      } else {
        this.users = this.teachers.filter(teacher => teacher.Role === this.selectedRole);
      }
    },
    telechargerPDF() {
      const doc = new jsPDF();
      doc.text('Liste des Etudiants', 10, 10);
      doc.autoTable({
        head: [['NCIN', 'Nom', 'Prenom', 'Gmail', 'Telephone']],
        body: this.users.map(filtrage => [filtrage.cin, filtrage.nom, filtrage.prenom, filtrage.email, filtrage.phoneNumber])
      });
      doc.save('liste_Etudiants.pdf');
    },
    imprimerPDF() {
      const doc = new jsPDF();
      doc.text('Liste des Etudiants', 10, 10);
      doc.autoTable({
        head: [['NCIN', 'Nom', 'Prenom', 'Gmail', 'Telephone']],
        body: this.users.map(filtrage => [filtrage.cin, filtrage.nom, filtrage.prenom, filtrage.email, filtrage.phoneNumber])
      });
      const pdfData = doc.output();
      const blob = new Blob([pdfData], { type: 'application/pdf' });
      const url = URL.createObjectURL(blob);
      const iframe = document.createElement('iframe');
      iframe.style.cssText = 'position:absolute;left:-10000px;top:-10000px;';
      document.body.appendChild(iframe);
      iframe.src = url;
      setTimeout(() => {
        iframe.contentWindow.print();
      }, 1000);
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
  }
};
</script>

<style scoped>

.pagination {
    display: flex;
    justify-content:flex-start;
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
  width: 90%;
  margin-top: 2%;
}

.data {
  border-radius: 10px;
  box-shadow: #818181 -2px 2px 4px;
  border: 1px solid #818181;
  background-color: #FFFFFF;
  padding-left: 4%;
  padding-right: 4%;
  background-color: var(--card-color);
}

.filter-bar {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.bt {
  display: flex;
  margin-right: 10px;
}

.select {
  text-align: center;
  color: #5D5D5D;
  cursor: pointer;
  border-radius: 0 5px 5px 0;
  padding: 3px;
  background: #F3F4F6;
  border-color: #CACACA;
  font-family: Berlin Sans FB;
}

.search-input {
  padding: 3px;
  border-radius: 5px 5px 5px 5px;
  background: #F3F4F6;
  border-color: #CACACA;
  color: #5D5D5D;
  font-family: Agency FB;
  font-weight: bold;
  cursor: auto;
  font-size: 90%;

}

.filter-button {
  margin-left: 10px;
  margin-right: 10px;
  border-radius: 5px;
  background-color: #F3F4F6;
  border: #CACACA solid 1px;
  padding: 4px 10px;
  cursor: pointer;
  font-family: Agency FB;
  font-weight: bold;
  color: #5D5D5D;
}

.buttons-right {
  margin-left: auto;
}

.download-button,
.print-button {
  margin-left: 10px;
    margin-right: 10px;
    border-radius: 5px;
    background-color: #F3F4F6;
    border: #CACACA solid 1px;
    padding: 4px 10px;
    cursor: pointer;
    font-family: Agency FB;
    font-weight: bold;
    color: #5D5D5D;
}

.print-button {
  margin-left: 10px !important;
}

.table {
  width: 100%;
}

h4 {
  font-family: Agency FB;
  padding-left: 1%;
  margin-top: 2%;
}

thead th {
  color: #6A6A6A;
  font-family: Agency FB;
  font-weight: bold;
  font-size: 120%;
}

td {
  font-size: 80%;
  color: var(--text-color);
}

button {
  border: none;
  background-color: #FFFFFF;
  padding: 2%;
}

.action-button {
  background-color: var(--card-color);
}

.action-button i {
  color: var(--text-color);
}

.action-button img{
  width: 90%;
}

tfoot button {
  background-color: var(--button-bg);
}

i {
  color: var(--icon-color);
}

.ligne {
  display: flex;
  flex-direction: row;
  width: 100%;
}

.ligne button {
  width: 20% !important;
}

@media screen and (max-width: 1000px) {
  .table {
    width: 100%;
  }
}

@media screen and (max-width: 480px) {
  .filter-bar {
    display: block;
  }

  .bt {
    display: block;
  }

  .search-input {
    width: 100%;
  }

  .select {
    width: 100% !important;
    margin-top: 1% !important;
  }

  .ligne {
    display: flex;
    flex-direction: row;
    text-align: center;
    margin-top: 1% !important;
  }

  .ligne button {
    font-size: 80%;
    width: auto;
  }

  .table thead {
    font-size: 60%;
  }

  .action-button {
    width: 50%;
    height: 2vh;
    margin: 0%;
  }

}
</style>