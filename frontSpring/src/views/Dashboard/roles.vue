<template>
    <div>
        <navbar></navbar>
        <div class="wrapper">
            <div class="menu">
                <ul class="first">
                    <li>
                        <a class="acc" @click="changerView('dashboard')">
                            <img src="@/assets/house.png" alt="Acceuil">
                            Acceuil
                        </a>
                    </li>
                    <li>
                        <p class="gere">
                            <img src="@/assets/gerer.png" alt="Gerer">
                            Gérer les
                        </p>
                    </li>
                </ul>
                <ul class="fils">
                    <li>
                        <a @click="changerView('acces')"><img src="@/assets/key.png" alt="Accès"> Accès</a>
                    </li>
                    <li>
                        <a @click="changerView('profiles')"><img src="@/assets/etudiant.png" alt="Profiles">
                            Profiles</a>
                    </li>
                    <li>
                        <a @click="changerView('roles')"><img src="@/assets/role.png" alt="Rôles"> Rôles</a>
                    </li>
                    <li>
                        <a @click="changerView('badges')"><img src="@/assets/badge.png" alt="Badges"> Badges</a>
                    </li>
                    <li>
                        <a @click="changerView('attestations')"><img src="@/assets/attestation.png" alt="Attestations">
                            Attestations</a>
                    </li>
                    <li>
                        <a @click="changerView('evenements')"><img src="@/assets/event.png" alt="Evénements">
                            Evénements</a>
                    </li>
                    <li>
                        <a @click="changerView('certificats')"><img src="@/assets/certif.png" alt="Certificats">
                            Certificats</a>
                    </li>
                    <li>
                        <a @click="changerView('formations')"><img src="@/assets/formation.png" alt="Formations">
                            Formations</a>
                    </li>
                    <li>
                        <a @click="changerView('departements')"><img src="@/assets/department.png" alt="Départements">
                            Départements</a>
                    </li>
                    <li>
                        <a @click="changerView('entreprises')"><img src="@/assets/department.png" alt="Entreprises">
                            Entreprises</a>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class=" modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Rôle</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nomDep" class="form-label">Nom Rôle</label>
                                            <input type="text" class="form-control" id="nomDep" v-model="nomRole"
                                                :class="{ 'is-invalid': showErrorMessage }" required>
                                            <div class="invalid-feedback" v-if="showErrorMessage">
                                                Le rôle existe déjà !
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary btn-sm" @click="AddRole()">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-header">
                        / Gestion des Rôles
                    </div>
                    <div class="data">
                        <div class="dep">
                            <div class="titre">
                                <img src="@/assets/menu.png" alt="menu"> Rôles :
                            </div>
                            <div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div v-for="(item, index) in displayedItems" :key="index" class="accordion-item">
                                <h2 class="accordion-header">
                                    <button @click="toggleAccordion(index)" class="accordion-button" type="button"
                                        :aria-expanded="isOpen[index]"
                                        :aria-controls="'panelsStayOpen-collapse' + index">
                                        {{ item.nomRole }}
                                    </button>
                                    <div class="btn-droit">
                                        <button type="button" @click="confirmDeleteRole(item.id)"
                                            v-if="!hasAssociatedUsers(item.id)">
                                            <img src="@/assets/delete.png" alt="delete">
                                        </button>
                                        <!--<button type="button" data-bs-toggle="modal" data-bs-target="#updateModal" class="edit">
                  <i class="bi bi-pencil fs-6"></i>
                </button>-->
                                    </div>
                                </h2>
                                <!--<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class=" modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Rôle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="nomDe" class="form-label">Nom Rôle</label>
                          <input type="text" class="form-control" id="nomDe" v-model="nomUpdated" required>
                          <div class="invalid-feedback" v-if="showErrorMessage">
                            Le rôle existe déjà !
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary btn-sm" @click="UpdateRole(item.id)">Valider</button>
                  </div>
                </div>
              </div>
            </div>-->
                            </div>
                        </div>
                        <div class="pagination">
                            <button @click="previousPage" :disabled="currentPage === 1"
                                class="page-button">Précédent</button>
                            <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                            <button @click="nextPage" :disabled="currentPage === totalPages"
                                class="page-button">Suivant</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import navbar from '@/components/navbar.vue'
import router from '@/router';
import 'sweetalert2/dist/sweetalert2.min.css';
import RoleService from '@/services/roles.js';
import UserService from '@/services/users.js';
import Swal from 'sweetalert2'

export default {
    data() {
        return {
            view: "roles",
            roles: [],
            isOpen: [],
            itemsPerPage: 5,
            currentPage: 1,
            nomRole: '',
            showErrorMessage: false,
            showModal: true,
            users: [],
            nomUpdated: '',
        };
    },
    methods: {
        changerView(msg) {
            if (msg === 'acces') {
                router.push("/Dashboard/Acces");
            } else if (msg === 'dashboard') {
                router.push("/Dashboard");
            } else if (msg === 'profiles') {
                router.push("/Dashboard/profiles");
            } else if (msg === 'roles') {
                router.push("/Dashboard/roles");
            } else if (msg === 'badges') {
                router.push("/Dashboard/badges");
            } else if (msg === 'attestations') {
                router.push("/Dashboard/attestations");
            } else if (msg === 'evenements') {
                router.push("/Dashboard/evenements");
            } else if (msg === 'certificats') {
                router.push("/Dashboard/certificats");
            } else if (msg === 'formations') {
                router.push("/Dashboard/formations");
            } else if (msg === 'departements') {
                router.push("/Dashboard/departements");
            } else if (msg === 'entreprises') {
                router.push("/Dashboard/entreprises");
            }
        },
        toggleAccordion(index) {
            this.isOpen[index] = !this.isOpen[index];
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
        confirmDeleteRole(role) {
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
                    this.deleteRole(role);
                }
            });
        },
        validerCreationeRole() {
            if (this.roles.some(role => role.nomRole === this.nomRole)) {
                this.showErrorMessage = true;
                return;
            } else {
                Swal.fire({
                    title: "Crée !",
                    text: "Votre rôle a été crée !",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.AddRole();
                    }
                });
            }
        },
        getRoles() {
            RoleService.getAll().then((res) => {
                this.roles = res.data.data;
            })
        },
        deleteRole(role) {
            RoleService.delete(role).then(() => {
                this.getRoles();
            })
        },
        AddRole() {
            if (this.roles.some(role => role.nomRole === this.nomRole)) {
                this.showErrorMessage = true;
                return;
            } else {
                const role = {
                    nomRole: this.nomRole,
                };
                RoleService.addRole(role)
                    .then(() => {
                        this.roles.push(role);
                        this.nomRole = "";
                        Swal.fire({
                            title: "Crée !",
                            text: "Votre rôle a été crée !",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.showErrorMessage = false;
                            }
                        });
                    })
                    .catch((error) => {
                        console.error("Error create role:", error);
                    });
            }
        },
        getProfils() {
            UserService.getAll().then((res) => {
                this.users = res.data.data;
            })
        },
        hasAssociatedUsers(roleId) {
            return this.users.some(user => user.role_id === roleId);
        },
        UpdateRole(id) {
            console.log("id", id);
            RoleService.updateRole(id, { nomRole: this.nomUpdated })
                .then(() => {
                    this.getRoles();
                    Swal.fire({
                        title: 'Succès !',
                        text: 'Le rôle a été mis à jour avec succès.',
                        icon: 'success'
                    });
                })
                .catch((error) => {
                    console.log(this.nomUpdated);
                    console.error('Error updating role:', error);
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la mise à jour du rôle.',
                        icon: 'error'
                    });
                });
        }
    },
    created() {
        this.getRoles();
        this.getProfils();
    },
    components: {
        navbar,
    },
    computed: {
        totalPages() {
            return Math.ceil(this.roles.length / this.itemsPerPage);
        },
        displayedItems() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.roles.slice(startIndex, endIndex);
        }
    },
}
</script>
<style scoped>
@import "~bootstrap-icons/font/bootstrap-icons.css";
.first {
    margin-bottom: 0;
}

.wrapper {
    display: flex;
    height: 100ch;
}

.menu {
    width: 20%;
    height: 100ch;
    float: left;
    top: 0;
    margin-top: 4%;
    border: 1px solid #178FEB;
    background-color: #178FEB;
    box-shadow: 3px 4px 6px rgba(0, 0, 0, .1);
    position: fixed;
}

.content {
    width: 100%;
    min-height: 100ch;
    height: max-content;
    background-color: var(--bg-img);
    background-image: var(--bg-img);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    margin-left: 20%;
    padding-top: 80px;
}

ul {
    padding-top: 40px;
    padding-left: 30px;
}

ul li {
    list-style: none;
    color: white;
}

li a,
li p {
    display: block;
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-family: Agency FB;
}

li a:hover,
.fils a:hover {
    text-decoration: underline;
    cursor: pointer;
}

a img {
    width: 35px;
    margin-right: 3px;
    padding-bottom: 10px;
}

.fils {
    padding-left: 60px;
    margin-top: 0;
    padding-top: 0 !important;
    margin-top: 0 !important;
}

.fils p {
    font-size: 80%;
}

.acc {
    font-size: 25px;
}

.gere {
    font-family: Agency FB;
    font-size: 20px;
    padding-top: 0px;
}

.fils img {
    width: 23px;
    margin-right: 3px;
    margin-top: 10px;
}

.gere img {
    width: 30px;
    margin-right: 3px;
    padding-bottom: 10px;
}

li {
    margin-top: 0;
    padding-top: 0;
}

@media screen and (max-width: 800px) {
    .content {
        width: 100% !important;
        height: 100lh;
    }

    .menu {
        display: none;
        padding-left: 0;
        margin-left: 0;
    }

    .acc,
    .gere {
        padding-left: 0;
        margin-left: 0;
    }

    .fils {
        padding-left: 25%;
        margin-left: 8%;
    }

    ul {
        padding-left: 5% !important;
    }
}

@media screen and (max-width: 920px) {
    .content {
        height: 100lh;
    }

    .menu {
        padding-left: 0;
    }

    li a,
    li p {
        font-size: 80%;
    }

    .acc,
    .gere {
        font-size: 95%;
    }

    a img {
        width: 25px;
        margin-right: 3px;
        padding-bottom: 10px;
    }

    .fils img {
        width: 20px;
    }
}

.edit {
  height: 2px;
}

.modal-backdrop.show {
  display: none !important;
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

.titre {
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

@media (max-width: 670px) {
  .option {
    padding: 2px 2px;
    margin-bottom: 1%;
    padding-bottom: 0;
    padding-left: 0;
    margin-left: 5%;
  }

  .options {
    width: 100% !important;
  }

  .page-button {
    padding: 2px 5px;
    margin: 0 3px;
    font-size: 12px;
  }

  .page-info {
    margin: 0 5px;
    font-size: 12px;
  }
}

#ModalSuppression .form-label,
#ModalSupp .form-label {
  font-size: 20px !important;
}
</style>