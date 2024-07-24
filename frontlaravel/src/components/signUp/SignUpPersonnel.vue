<template>
    <div class="inscription-form">
        <form @submit.prevent="submitForm3">
            <div class="form-column1">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" v-model="personnel.nom" placeholder="Nom *" required>
                    <div v-if="errors.nom" class="alert alert-danger">{{ errors.nom }}</div>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" v-model="personnel.prenom" placeholder="Prénom *" required>
                    <div v-if="errors.prenom" class="alert alert-danger">{{ errors.prenom }}</div>
                </div>
                <div class="form-group">
                    <label>Sexe:</label>
                    <div class="sexe">
                        <input type="radio" id="homme" value="homme" v-model="personnel.genre">
                        <label for="homme">Homme</label>
                        <input type="radio" id="femme" value="femme" v-model="personnel.genre">
                        <label for="femme">Femme</label>
                    </div>
                    <div v-if="errors.genre" class="alert alert-danger">{{ errors.genre }}</div>
                </div>
                <div class="form-group">
                    <label for="cin">CIN:</label>
                    <input type="text" id="cin" maxlength="8" v-model="personnel.cin" placeholder="Veuillez entrer votre CIN"
                        required>
                    <div v-if="errors.cin" class="alert alert-danger">{{ errors.cin }}</div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" v-model="personnel.email" placeholder="Email*" required>
                    <div v-if="errors.email" class="alert alert-danger">{{ errors.email }}</div>
                </div>

                <div class="form-group">
                    <label for="Gouvernant">Gouvernant:</label>
                    <select id="gouvernorat" v-model="personnel.Gouvernorat" required>
                        <option disabled value="">Sélectionnez un gouvernorat</option>
                        <option v-for="gouvernorat in gouvernorats" :value="gouvernorat" :key="gouvernorat">{{
                            gouvernorat }}</option>
                    </select>
                    <div v-if="errors.Gouvernorat" class="alert alert-danger">{{ errors.Gouvernorat }}</div>
                </div>
                <div class="form-group">
                    <label for="date">Date de Naissance:</label>
                    <input type="date" id="date" v-model="personnel.date_naissance" required>
                    <div v-if="errors.date_naissance" class="alert alert-danger">{{ errors.date_naissance }}</div>
                </div>
            </div>

            <div class="form-column2">
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="adresse" v-model="personnel.adresse" placeholder="Adresse" required>
                    <div v-if="errors.adresse" class="alert alert-danger">{{ errors.adresse }}</div>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone:</label>
                    <input type="tel" id="telephone" maxlength="8" v-model="personnel.telephone" placeholder="Téléphone*" required>
                    <div v-if="errors.telephone" class="alert alert-danger">{{ errors.telephone }}</div>
                </div>
                <div class="form-group">
                    <label for="Entreprise">Entreprise:</label>
                    <select id="Entreprise" v-model="personnel.entreprise" required>
                        <option value="" disabled selected>Veuillez sélectionner une entreprise</option>
                        <option v-for="entreprise in entreprises" :key="entreprise.id" :value="entreprise.id">{{
                            entreprise.nom }}</option>
                        <option value="autre" selected>autre..</option>
                    </select>
                    <div v-if="errors.entreprise" class="alert alert-danger">{{ errors.entreprise }}</div>
                </div>
                <div class="form-group">
                    <label for="Fonctionalite">Fonctionalite:</label>
                    <input type="text" id="Fonctionalite" v-model="personnel.profession" placeholder="Fonctionalite*"
                        required>
                    <div v-if="errors.profession" class="alert alert-danger">{{ errors.profession }}</div>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" id="pwd" v-model="personnel.password" placeholder="Mot de passe *" required>
                    <div v-if="errors.password" class="alert alert-danger">{{ errors.password }}</div>
                </div>
                <div class="form-group">
                    <label for="pwdconf">Comfirmer mot de passe:</label>
                    <input type="password" id="pwdconf" v-model="personnel.password2"
                        placeholder="Confirmer le mot de passe *" required>
                    <div v-if="errors.password2" class="alert alert-danger">{{ errors.password2 }}</div>
                </div>
            </div>
        </form>
        <button type="submit" class="buttoninscrire" @click="addPersonnel">S'inscrire</button>
    </div>
</template>
<script>
import userService from '@/services/users'
import demandeService from '@/services/demandesAcces'
import Swal from 'sweetalert2'
import entrepriseService from '@/services/entreprises';
import personnelService from '@/services/personnels'
import cvService from '@/services/cvs'
export default {
    data() {
        return {
            entreprises: [],
            users: [],
            errors: {
                nom: '',
                prenom: '',
                cin: '',
                genre: '',
                date_naissance: '',
                adresse: '',
                telephone: '',
                profession: '',
                email: '',
                password: '',
                password2: '',
                Gouvernorat: '',
                entreprise: '',
            },
            personnel: {
                nom: '',
                prenom: '',
                cin: '',
                genre: '',
                date_naissance: '',
                adresse: '',
                telephone: '',
                profession: '',
                email: '',
                password: '',
                password2: '',
                Gouvernorat: '',
                entreprise: '',
            },
            gouvernorats: [
                'Ariana', 'Béja', 'Ben Arous', 'Bizerte', 'Gabès',
                'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kébili',
                'Le Kef', 'Mahdia', 'La Manouba', 'Médenine', 'Monastir',
                'Nabeul', 'Sfax', 'Sidi Bouzid', 'Siliana', 'Sousse',
                'Tataouine', 'Tozeur', 'Tunis', 'Zaghouan'
            ],
        }
    },
    created() {
        this.getEntreprises();
        this.getUsers();
    },
    methods: {
        getUsers() {
            userService.getAll().then(response => { this.users = response.data.data });
        },
        getEntreprises() {
            entrepriseService.getEntreprises().then(response => { this.entreprises = response.data.data });
        },
        addPersonnel() {
            if (this.submitForm()) {
                const user = {
                    nom: this.personnel.nom,
                    prenom: this.personnel.prenom,
                    phoneNumber: this.personnel.telephone,
                    cin: this.personnel.cin,
                    genre: (this.personnel.genre === 'femme') ? 1 : 0,
                    dateNaissance: this.personnel.date_naissance,
                    adresse: this.personnel.adresse,
                    Gouvernorat: this.personnel.Gouvernorat,
                    user_type: "Personnel",
                    email: this.personnel.email,
                    password: this.personnel.password,
                };
                console.log(user);
                userService.addUser(user).then((response) => {
                    const userId = response.data.id;
                    const entrepriseId = this.personnel.entreprise === 'autre' ? '' : this.personnel.entreprise;
                    const personnel = {
                        fonctionnalite: this.personnel.profession,
                        entreprise_id: entrepriseId,
                        user_id: userId,
                    }
                    console.log(personnel);
                    personnelService.addPersonnel(personnel).then(res => {
                        console.log(res);
                        console.log("personnel ajouté");
                    })
                    const cv = {
                        user_id: userId,
                    }
                    cvService.addCv(cv);
                    const demande = {
                        type: "personnel",
                        user_id: userId,
                    }
                    if (this.personnel.entreprise !== 'autre') {
                        demandeService.addDemande(demande).then(() => {
                            Swal.fire({
                                title: "Le personnel ajouté. Demande de manager soumise. Compte participant jusqu'à approbation",
                                showCancelButton: true,
                            }).then(() => {
                                this.$router.push("/Accueil");
                            });
                        })
                    }
                    this.$router.push("/Accueil");
                }).catch((error) => {
                    console.log(error.response.data.errors);
                    alert('Problème de connexion !');
                })
            } else {
                Swal.fire({
                    title: "Erreur !",
                    text: "Des erreurs sont présentes dans le formulaire",
                    icon: "error",
                });
            }
        },
        submitForm() {
            this.errors = {};
            if (!this.validateEmail()) {
                this.errors.email = 'Email invalide.';
            }
            if (this.users.some(user => user.email === this.personnel.email)) {
                this.errors.email = 'Email utilisé.';
            }
            if (!this.personnel.telephone.match(/^\d{8}$/)) {
                this.errors.telephone = 'Le numéro de téléphone doit être composé de 8 chiffres.';
            }
            if (this.users.some(user => String(user.cin) === String(this.personnel.cin))) {
                this.errors.cin = "cin utilisé";
            }
            if (!this.personnel.cin.match(/^\d{8}$/)) {
                this.errors.cin = "Veuillez entrer un numéro de cin valide";
            }
            if (this.personnel.password !== this.personnel.password2) {
                this.errors.password2 = "Les mots de passe ne correspondent pas";
            }
            if (!this.personnel.entreprise) {
                this.errors.password2 = "L'entreprise' est requis";
            }
            if (!this.personnel.password) {
                this.errors.password = "Le mot de passe est requis";
            }
            if (this.personnel.password.length < 8) {
                this.errors.password = "Le mot de passe doit contenir au moins 8 caractères";
            }
            if (!this.personnel.nom) {
                this.errors.nom = "Le nom est requis";
            }
            if (!this.personnel.prenom) {
                this.errors.prenom = "Le prenom est requis.";
            }
            if (!this.personnel.adresse) {
                this.errors.adresse = "L'adresse est requis.";
            }
            if (!this.personnel.genre) {
                this.errors.genre = "Le genre est requis.";
            }
            if (!this.personnel.profession) {
                this.errors.profession = "L'etablissment' est requis.";
            }
            if (!this.personnel.Gouvernorat) {
                this.errors.Gouvernorat = "La gouvernorat est requis.";
            }
            if (!this.personnel.password2) {
                this.errors.password2 = "Le mot de passe à confirmer est requis.";
            }
            if (!this.validateAge()) {
                this.errors.date_naissance = "Date de naissance invalide.";
            }
            if (!this.personnel.date_naissance) {
                this.errors.date_naissance = "La date de naissance est requis.";
            }
            return Object.values(this.errors).every(error => error === "");
        },
        validateEmail() {
            const re = /\S+@\S+\.\S+/;
            const isValid = re.test(this.personnel.email);
            if (!isValid) {
                return false;
            } else {
                return true;
            }
        },
        validateAge() {
            const dateNaissance = new Date(this.personnel.date_naissance);
            const age = new Date().getFullYear() - dateNaissance.getFullYear();
            if (age <= 18) {
                return false;
            } else {
                return true;
            }
        },

    }
}
</script>
<style scoped>
.alert-danger {
    color: #D8000C;
    background-color: #FFD2D2;
    border: 1px solid #D8000C;
    padding: 8px 10px;
    border-radius: 5px;
    margin-top: 5px;
    font-size: 0.9em;
    display: block;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    width: 150%;
}

select option {
    width: 100px;
    padding: 10px;
    font-size: 16px;
    background-color: #f9f9f9;
    color: #333;
}

select option:hover {
    background-color: #e0e0e0;
}

.inscription-form {
    margin-top: 10%;
    display: flex;
    flex-direction: column;
    gap: 150px;
    width: 85%;
    margin-left: 10%;
}

.form-column1 {
    float: left;
    width: 30%;
}

.form-column2 {
    float: left;
    width: 30%;
    margin-left: 20%;
}

.form-column:nth-child(odd) {
    margin-right: 5%;
}

.sexe,
.role {
    display: flex;
    justify-content: center;
    align-items: center;
}

.role {
    margin-top: 4%;
    margin-bottom: 4%;
}

.sexe input[type="radio"],
.sexe label,
.role input[type="radio"] {
    margin-right: 5px;
}

.role label {
    margin-right: 10%;
}

label {
    display: block;
    font-weight: bold;
    text-align: left;
    margin-bottom: 1%;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="tel"],
input[type="password"],
input[type="date"],
select {
    width: 150%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 5%;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 42%;
    margin-bottom: 5%;
    width: 120px;
    height: 60px;
}

button:hover {
    background-color: #0056b3;
}

.sexe input[type="radio"],
.sexe label {
    display: inline-block;
    vertical-align: middle;
}

.sexe label {
    margin-right: 10px;
}

@media screen and (max-width: 700px) {

    .sexe label {
        margin-right: 2px;
    }

    .sexe input[type="radio"] {
        margin-left: 5%;
    }

    .inscription-form {
        width: 80%;
    }

    .form-column1,
    .form-column2 {
        width: 50%;
        float: none;
        margin-left: 0;
    }

    .form-column2 {
        margin-bottom: -50%;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        font-size: 14px;
        width: 200%;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="tel"],
    input[type="password"],
    input[type="date"],
    select {
        width: 200%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 13px;
    }

    button {
        margin-left: 25%;
        margin-top: 25px;
        width: 100px;
        height: 50px;
    }

    .sexe {
        margin-left: 50%;
    }
}

@media screen and (max-width: 900px) and (min-width: 700px) {

    .sexe input[type="radio"],
    .sexe label {
        margin-right: 2px;
        /* Espacement réduit entre les boutons radio et les labels */
    }

    #inscription {
        position: absolute;
        /* Position fixée */
        top: 20%;
        left: 25%;
        right: 25%;
    }

    .form-column1 {
        float: left;
        width: 30%;
        margin-left: -30px;
    }

    .form-column2 {
        float: left;
        width: 30%;
        margin-left: 150px;
    }

    .form-column:nth-child(odd) {
        margin-right: 5%;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="tel"],
    input[type="password"],
    select {
        width: 150%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 40%;
        margin-top: 30px;
        width: 100px;
        height: 50px;
    }
}

@media screen and (max-width: 1270px) and (min-width: 900px) {}
</style>
