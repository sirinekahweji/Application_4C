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
                <div class="container">
                    <div v-if="loading" class="overlay"></div>
                    <div class="d-flex justify-content-center spinner" v-if="loading">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="card-header">
                        / Historiques
                    </div>
                    <div class="data">
                        <div class="filter-bar">
                            <div class="bt">
                                <input type="text" class="search-input" placeholder="Recherche..."
                                    v-model="searchQuery">
                                <select class="select" v-model="selectedRole">
                                    <option value="">Tous les rôles</option>
                                    <option v-for="(role, index) in uniqueRoles" :key="index" :value="role.id">{{ role
                                        }}
                                    </option>
                                </select>
                            </div>
                            <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i>
                                Filtrer</button>
                            <div class="buttons-right">
                                <button class="download-button" @click="retour()"><i class="bi bi-person-circle"></i>
                                    Retour</button>
                                <button class="download-button" @click="telechargerPDF()"><i class="bi bi-download"></i>
                                    Télécharger</button>
                                <button class="print-button" @click="imprimerPDF"><i class="bi bi-printer"></i>
                                    Imprimer</button>
                            </div>
                        </div>
                        <h4>Liste des Profils</h4>
                        <table class="table">
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
                                <tr v-for="(profil, index) in displayedItems" :key="index">
                                    <td>{{ profil.cin }}</td>
                                    <td>{{ profil.nom }}</td>
                                    <td>{{ profil.prenom }}</td>
                                    <td>{{ profil.email }}</td>
                                    <td>{{ profil.phoneNumber }}</td>
                                    <td>{{ roles[profil.role_id-1] ? roles[profil.role_id-1].nomRole : 'non trouvé' }}</td>
                                    <td>
                                        <router-link :to="{ name: 'Profile' }">
                                            <button class="action-button" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </router-link>
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
        </div>
    </div>
</template>
<script>
import navbar from '@/components/navbar.vue'
import router from '@/router';
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import UserService from '@/services/users.js'
import RoleService from '@/services/roles.js'

export default {
    data() {
        return {
            view: "profiles",
            profils: [],
            filtrages: [],
            selectedRole: null,
            searchQuery: '',
            itemsPerPage: 10,
            currentPage: 1,
            roles: [],
            loading: false
        };
    },
    methods: {
        retour(){
            router.push('/Dashboard/profiles');
        },
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
        resetData() {
            this.profils = this.getProfils();
        },
        confirmSuppression(id) {
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
                    this.deleteProfil(id);
                }
            });
        },
        recherche() {
            if (this.searchQuery === '') {
                this.getProfils();
            } else {
                this.profils = this.profils.filter(profil => {
                    return profil.nom.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            }
        },
        deleteTeacher(filtrage) {
            const index = this.filtrages.indexOf(filtrage);
            if (index !== -1) {
                this.filtrages.splice(index, 1);
            }
        },
        filtrerDonnees() {
            if (!this.selectedRole) {
                this.resetData();
            } else {
                this.profils = this.profils.filter(profil => profil.role_id === this.selectedRole);
            }
        },
        async telechargerPDF() {
            this.loading = true;
            const doc = new jsPDF();
            doc.text('Liste des enseignants', 10, 10);
            const profils = this.profils;
            const head = [['NCIN', 'Nom', 'Prenom', 'Gmail', 'Telephone', 'Type']];
            doc.autoTable({
                head: head
            });
            for (const filtrage of profils) {
                const role = await this.findRoleById(filtrage.role_id);
                const nomRole = role ? role.nomRole : 'N/A';
                doc.autoTable({
                    body: [[
                        filtrage.cin,
                        filtrage.nom,
                        filtrage.prenom,
                        filtrage.email,
                        filtrage.phoneNumber,
                        nomRole
                    ]],
                    startY: doc.autoTable.previous.finalY, // Espacement entre les tables
                    margin: { top: 20 }, // Espacement entre le texte et le tableau
                    columnStyles: {
                        0: { cellWidth: 25 }, // Largeur de la première colonne
                        1: { cellWidth: 25 }, // Largeur de la deuxième colonne
                        2: { cellWidth: 25 }, // Largeur de la troisième colonne
                        3: { cellWidth: 38 }, // Largeur de la quatrième colonne
                        4: { cellWidth: 43 }, // Largeur de la cinquième colonne
                        5: { cellWidth: 26 }  // Largeur de la sixième colonne
                    },
                    styles: {
                        cellPadding: 3, // Espacement entre le contenu et la bordure de la cellule
                        fontSize: 8,   // Taille de la police
                        valign: 'baseline', // Alignement vertical du contenu
                        halign: 'left' // Alignement horizontal du contenu
                    }
                });
            }
            doc.save('liste_enseignants.pdf');
            this.loading = false;
        },
        async imprimerPDF() {
            this.loading = true;
            const doc = new jsPDF();
            doc.text('Liste des enseignants', 10, 10);
            const profils = this.profils;
            const head = [['NCIN', 'Nom', 'Prenom', 'Gmail', 'Telephone', 'Type']];
            doc.autoTable({
                head: head
            });
            for (const filtrage of profils) {
                const role = await this.findRoleById(filtrage.role_id);
                const nomRole = role ? role.nomRole : 'N/A';
                doc.autoTable({
                    body: [[
                        filtrage.cin,
                        filtrage.nom,
                        filtrage.prenom,
                        filtrage.email,
                        filtrage.phoneNumber,
                        nomRole
                    ]],
                    startY: doc.autoTable.previous.finalY, // Espacement entre les tables
                    margin: { top: 20 }, // Espacement entre le texte et le tableau
                    columnStyles: {
                        0: { cellWidth: 25 }, // Largeur de la première colonne
                        1: { cellWidth: 25 }, // Largeur de la deuxième colonne
                        2: { cellWidth: 25 }, // Largeur de la troisième colonne
                        3: { cellWidth: 38 }, // Largeur de la quatrième colonne
                        4: { cellWidth: 43 }, // Largeur de la cinquième colonne
                        5: { cellWidth: 26 }  // Largeur de la sixième colonne
                    },
                    styles: {
                        cellPadding: 3, // Espacement entre le contenu et la bordure de la cellule
                        fontSize: 8,   // Taille de la police
                        valign: 'baseline', // Alignement vertical du contenu
                        halign: 'left' // Alignement horizontal du contenu
                    }
                });
            }
            const pdfData = doc.output();
            const blob = new Blob([pdfData], { type: 'application/pdf' });
            const url = URL.createObjectURL(blob);
            const iframe = document.createElement('iframe');
            iframe.style.cssText = 'position:absolute;left:-10000px;top:-10000px;';
            document.body.appendChild(iframe);
            iframe.src = url;
            await new Promise(resolve => setTimeout(resolve, 1000));
            setTimeout(() => {
                iframe.contentWindow.print();
            }, 1000);
            this.loading = false;
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
        getProfils() {
            UserService.getAllHisqtorique().then((res) => {
                this.profils = res.data.data;
            })
        },
        async findRoleById(id) {
            try {
                const response = await RoleService.findById(id);
                return response.data.data;
            } catch (error) {
                console.error("Error fetching role by ID:", error);
                return null; // Retourne null en cas d'erreur
            }
        },
        getRoles() {
            RoleService.getAll().then((res) => {
                this.roles = res.data.data;
            })
        },
        deleteProfil(id) {
            UserService.Delete(id).then(() => {
                this.getProfils();
            })
        },
    },
    created() {
        this.$watch('searchQuery', () => {
            this.recherche();
        });
        this.getProfils();
        this.getRoles();
    },
    components: {
        navbar,

    },
    computed: {
        paginatedProfils() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.profils.slice(startIndex, endIndex);
        },
        totalPages() {
            return Math.ceil(this.profils.length / this.itemsPerPage);
        },
        displayedItems() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.profils.slice(startIndex, endIndex);
        },
        uniqueRoles() {
            const uniqueRolesSet = new Set();
            this.roles.forEach(role => {
                uniqueRolesSet.add(role.nomRole);
            });
            return Array.from(uniqueRolesSet);
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
    border-radius: 5px 0px 0px 5px;
    background: #F3F4F6;
    border-color: #CACACA;
    color: #5D5D5D;
    font-family: Agency FB;
    font-weight: bold;
    cursor: auto;
    font-size: 90%;

}

.filter-button {
    margin-right: 10px;
    border-radius: 5px;
    background-color: #F3F4F6;
    border: #CACACA solid 1px;
    padding: 4px 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
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

tfoot button {
    background-color: var(--button-bg);
}

i {
    color: var(--icon-color);
}

@media screen and (max-width: 1000px) {
    .table {
        width: auto;
    }

    .filter-bar button {
        width: 100% !important;
        margin: 3px;
        text-align: center !important;
    }

    .filter-bar {
        display: block;
    }

    .filter-button {
        text-align: center !important;
        padding-left: 40%;
    }

    .bt {
        text-align: center;
    }

    .bt .search-input {
        width: 70% !important;
    }

    .bt select {
        width: 70% !important;
    }
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
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
</style>