<template>
    <div class="inscription-form">
        <form @submit.prevent="submitForm2">
            <div class="form-column1">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" v-model="enseignant.nom" placeholder="Nom *" required>
                    <div v-if="errors.nom" class="alert alert-danger">{{ errors.nom }}</div>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" v-model="enseignant.prenom" placeholder="Prénom *" required>
                    <div v-if="errors.prenom" class="alert alert-danger">{{ errors.prenom }}</div>
                </div>
                <div class="form-group">
                    <label>Sexe:</label>
                    <div class="sexe">
                        <input type="radio" id="homme" value="homme" v-model="enseignant.genre">
                        <label for="homme">Homme</label>
                        <input type="radio" id="femme" value="femme" v-model="enseignant.genre">
                        <label for="femme">Femme</label>
                    </div>
                    <div v-if="errors.genre" class="alert alert-danger">{{ errors.genre }}</div>
                </div>
                <div class="form-group">
                    <label for="cin">CIN:</label>
                    <input type="text" id="cin" maxlength="8" v-model="enseignant.cin" placeholder="Veuillez entrer votre CIN"
                        required>
                    <div v-if="errors.cin" class="alert alert-danger">{{ errors.cin }}</div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" v-model="enseignant.email" placeholder="Email*" required>
                    <div v-if="errors.email" class="alert alert-danger">{{ errors.email }}</div>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="adresse" v-model="enseignant.adresse" placeholder="Adresse" required>
                    <div v-if="errors.adresse" class="alert alert-danger">{{ errors.adresse }}</div>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone:</label>
                    <input type="tel" id="telephone" maxlength="8" v-model="enseignant.telephone" placeholder="Téléphone Mobile*"
                        required>
                    <div v-if="errors.telephone" class="alert alert-danger">{{ errors.telephone }}</div>
                </div>
            </div>

            <div class="form-column2">
                <div class="form-group">
                    <label for="date">Date de Naissance:</label>
                    <input type="date" id="date" v-model="enseignant.date_naissance" required>
                    <div v-if="errors.date_naissance" class="alert alert-danger">{{ errors.date_naissance }}</div>
                </div>
                <div class="form-group">
                    <label for="Gouvernant">Gouvernorat:</label>
                    <select id="gouvernorat" v-model="enseignant.Gouvernorat" required>
                        <option disabled value="">Sélectionnez un gouvernorat</option>
                        <option v-for="gouvernorat in gouvernorats" :value="gouvernorat" :key="gouvernorat">{{
                            gouvernorat }}</option>
                    </select>
                    <div v-if="errors.Gouvernorat" class="alert alert-danger">{{ errors.Gouvernorat }}</div>
                </div>
                <div class="form-group">
                    <label for="Etablissement">Etablissement:</label>
                    <select id="Etablissement" v-model="enseignant.etablissement" required>
                        <option value="" disabled>Sélectionnez votre établissement</option>
                        <option v-for="etablissement in etablissements" :value="etablissement" :key="etablissement">
                            {{ etablissement }}
                        </option>
                    </select>
                    <div v-if="errors.etablissement" class="alert alert-danger">{{ errors.etablissement }}</div>
                </div>
                <div class="form-group">
                    <label for="departement">Département:</label>
                    <select id="departement" :disabled="enseignant.etablissement != 'Institut Supérieur des Etudes Technologiques de Bizerte'" v-model="enseignant.departement" required>
                        <option value="" disabled selected>Veuillez sélectionner un département</option>
                        <option v-for="dep in departements" :key="dep.id" :value="dep.id">{{ dep.nom }}</option>
                    </select>
                    <div v-if="errors.departement" class="alert alert-danger">{{ errors.departement }}</div>
                </div>
                <div class="form-group">
                    <label for="role">Etes-vous un membre 4C?:</label>
                    <div class="role">
                        <input type="radio" id="oui" value="oui" v-model="enseignant.role" />
                        <label for="oui">Oui</label>
                        <input type="radio" id="non" value="non" v-model="enseignant.role" />
                        <label for="non">Non</label>
                    </div>
                    <div v-if="errors.role" class="alert alert-danger">{{ errors.role }}</div>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" id="pwd" v-model="enseignant.password" placeholder="Mot de passe *" required>
                    <div v-if="errors.password" class="alert alert-danger">{{ errors.password }}</div>
                </div>
                <div class="form-group">
                    <label for="pwdconf">Comfirmer mot de passe:</label>
                    <input type="password" id="pwdconf" v-model="enseignant.password2"
                        placeholder="Confirmer le mot de passe *" required>
                    <div v-if="errors.password2" class="alert alert-danger">{{ errors.password2 }}</div>
                </div>
            </div>
        </form>
        <button type="submit" class="buttoninscrire" @click="addEnseignant()">S'inscrire</button>
    </div>
</template>
<script>
import DepartementService from '@/services/departements.js'
import userService from '@/services/users'
import enseignantService from '@/services/enseignants'
import Swal from 'sweetalert2'
import demandeService from '@/services/demandesAcces'
import cvService from '@/services/cvs'
export default {
    data() {
        return {
            departements: [],
            errors: {
                nom: '',
                prenom: '',
                cin: '',
                email: '',
                password: '',
                password2: '',
                genre: '',
                date_naissance: '',
                adresse: '',
                telephone: '',
                Gouvernorat: '',
                etablissement: '',
                departement: '',
                role: '',
            },
            enseignant: {
                nom: '',
                prenom: '',
                cin: '',
                email: '',
                password: '',
                password2: '',
                genre: '',
                date_naissance: '',
                adresse: '',
                telephone: '',
                Gouvernorat: '',
                etablissement: '',
                departement: '',
                role: '',
            },
            etablissements: [
                "Ecole Supérieure des Sciences et Technologies du Design",
                "Ecole Supérieure d'Economie Numérique",
                "Ecole Supérieure de Commerce de Tunis",
                "Ecole Nationale des Sciences de l'Informatique",
                "Ecole Nationale de Médecine Vétérinaire",
                "Institut Supérieur des Arts Multimédia de la Manouba",
                "Institut Supérieur de Biotechnologie de Sidi Thabet",
                "Institut Supérieur de l’Education Spécialisée",
                "Institut Supérieur de Documentation de Tunis",
                "Institut Supérieur du Sport et de l'Education Physique de Ksar Saïd",
                "Institut Supérieur de Comptabilité et d'Administration des Entreprises de Manouba",
                "Faculté des Lettres, des Arts et des Humanités de la Manouba",
                "Institut de Presse et des Sciences de l'Information",
                "Ecole Nationale d'Ingénieurs de Gafsa",
                "Institut Préparatoire aux Etudes d'Ingénieur de Gafsa",
                "Institut Supérieur d'Administration des Entreprises de Gafsa",
                "Institut Supérieur des Etudes Appliquées en Humanités de Gafsa",
                "Institut Supérieur des Etudes Appliquées en Humanités de Tozeur",
                "Institut Supérieur du Sport et de l'Education Physique de Gafsa",
                "Institut Supérieur des Sciences Sociales et de l'Education de Gafsa",
                "Institut Supérieur des Sciences Appliquées et de Technologie de Gafsa",
                "Institut Supérieur des Arts et Métiers de Gafsa",
                "Faculté des Sciences de Gafsa",
                "Ecole Polytechnique de Tunisie",
                "Ecole Supérieure de la Statistique et de l'Analyse de l'Information",
                "Ecole Supérieure de l'Audiovisuel et du Cinéma de Gammarth",
                "Ecole Supérieure des Industries Alimentaires de Tunis",
                "Ecole Supérieure d'Agriculture de Mateur",
                "Ecole Supérieure d'Agriculture de Mograne",
                "Ecole Supérieure des Communications de Tunis",
                "Ecole Nationale des Sciences et Technologies Avancées de Borj Cédria",
                "Ecole Nationale d'Ingénieurs de Bizerte",
                "Ecole Nationale d'Ingénieurs de Carthage",
                "Ecole Nationale d'Architecture et d'Urbanisme de Tunis",
                "Institut Préparatoire aux Etudes d'Ingénieurs de Soukra",
                "Institut Préparatoire aux Etudes Scientifiques et Techniques (IPEST)",
                "Institut Préparatoire aux Etudes d'Ingénieurs de Bizerte",
                "Institut Préparatoire aux Etudes d'Ingénieurs de Nabeul",
                "Institut Supérieur des Cadres de l'Enfance",
                "Institut Supérieur des Technologies de l’Environnement, de l'Urbanisme et du Bâtiment",
                "Institut Supérieur des Technologies de l'Information et de la Communication",
                "Institut Supérieur des Sciences et Technologies de l'Environnement de Borj Cédria",
                "Institut Supérieur de Gestion de Bizerte",
                "Institut Supérieur de Pêche et d'Aquaculture de Bizerte",
                "Institut Supérieur des Sciences Appliquées et de la Technologie de Mateur",
                "Institut Supérieur des Langues de Tunis",
                "Institut Supérieur des Langues de Nabeul",
                "Institut Supérieur des Beaux Arts de Nabeul",
                "Institut National du Travail et des Etudes Sociales de Tunis",
                "Institut National des Sciences Appliquées et de Technologie",
                "Institut National Agronomique de Tunisie",
                "Faculté des Sciences Economiques et de Gestion de Nabeul",
                "Faculté des Sciences Juridiques, Politiques et Sociales de Tunis",
                "Faculté des Sciences de Bizerte",
                "Institut des Hautes Etudes Commerciales de Carthage",
                "Ecole Supérieure d'Agriculture du Kef",
                "Ecole Supérieure d'Ingénieurs de Medjez El Bab",
                "Institut Supérieur des Sciences Infirmières de Kef",
                "Institut Supérieur de l'Informatique du Kef",
                "Institut Supérieur de Biotechnologie de Béja",
                "Institut Supérieur des Etudes Appliquées en Humanités du Kef",
                "Institut Supérieur de l'Education Physique du Kef",
                "Institut Supérieur des Sciences Humaines de Jendouba",
                "Institut Supérieur des Langues Appliquées et Informatique de Béja",
                "Institut Supérieur des Arts et Métiers de Siliana",
                "Institut Supérieur de Musique et de Théâtre du Kef",
                "Faculté des Sciences Juridiques, Economiques et de Gestion de Jendouba",
                "Institut Sylvo-Pastoral de Tabarka",
                "Ecole Supérieure des Sciences et Techniques de la Santé de Tunis",
                "Ecole Nationale d'Ingénieurs de Tunis",
                "Institut Préparatoire aux Etudes d'Ingénieurs d'El Manar",
                "Institut Supérieur des Sciences Infirmières de Tunis",
                "Institut Supérieur d'Informatique",
                "Institut Supérieur des Technologies Médicales de Tunis",
                "Institut Supérieur des Sciences Humaines de Tunis",
                "Institut Supérieur des Sciences Biologiques Appliquées de Tunis",
                "Faculté de Droit et des Sciences Politiques de Tunis",
                "Faculté de Médecine de Tunis",
                "Faculté des Sciences Economiques et de Gestion de Tunis",
                "Faculté des Sciences de Tunis",
                "Institut Supérieur de l'Education et de la Formation Continue",
                "Ecole Supérieure des Sciences Economiques et Commerciales de Tunis",
                "Ecole Nationale Supérieure d'Ingénieurs de Tunis",
                "Institut Préparatoire aux Etudes Littéraires et de Sciences Humaines de Tunis",
                "Institut Préparatoire aux Etudes d'Ingénieurs de Tunis",
                "Tunis Business School",
                "Institut Supérieur de Gestion de Tunis",
                "Institut Supérieur de l'Animation pour la Jeunesse et la Culture de Bir El Bey",
                "Institut Supérieur des Etudes Appliquées en Humanité de Tunis",
                "Institut Supérieur des Études Appliquées en Humanités de Zaghouan",
                "Institut Supérieur d'Art Dramatique de Tunis",
                "Institut Supérieur des Beaux Arts de Tunis",
                "Institut Supérieur de Musique de Tunis",
                "Institut Supérieur des Métiers du Patrimoine de Tunis",
                "Ecole Supérieure Normale",
                "Faculté des Sciences Humaines et Sociales de Tunis",
                "Ecole Supérieure des Sciences et Techniques de la Santé de Monastir",
                "Ecole Nationale d'Ingénieurs de Monastir",
                "Institut Préparatoire aux Études d'Ingénieurs de Monastir",
                "Institut Supérieur d'Informatique de Mahdia",
                "Institut Supérieur d'Informatique et de Mathématiques de Monastir",
                "Institut Supérieur de Biotechnologie de Monastir",
                "Institut Supérieur des Etudes Appliquées en Humanités de Mahdia",
                "Institut Supérieur des Sciences Appliquées et de Technologie de Mahdia",
                "Institut Supérieur des Langues Appliquées de Moknine",
                "Institut Supérieur des Arts et Métiers de Mahdia",
                "Institut Supérieur de la Mode de Monastir",
                "Faculté de Pharmacie de Monastir",
                "Faculté de Médecine de Monastir",
                "Faculté des Sciences Economiques et de Gestion de Mahdia",
                "Faculté des Sciences de Monastir",
                "Faculté de Médecine Dentaire de Monastir",
                "Institut Préparatoire aux Études d'Ingénieur de Kairouan",
                "Institut Supérieur d'Informatique et de Gestion de Kairouan",
                "Institut Supérieur des Etudes Appliquées en Sciences Humaines de Sbeïtla",
                "Institut Supérieur des Etudes Juridiques et Politiques de Kairouan",
                "Institut Supérieur des Mathématiques Appliquées et de l'Informatique de Kairouan",
                "Institut Supérieur des Sciences Appliquées et de Technologie de Kasserine",
                "Institut Supérieur des Sciences Appliquées et de Technologie de Kairouan",
                "Institut Supérieur des Arts et Métiers de Kasserine",
                "Institut Supérieur des Arts et Métiers de Kairouan",
                "Institut Supérieur des Arts et Métiers de Sidi Bouzid",
                "Faculté des Lettres et des Sciences Humaines de Kairouan",
                "Faculté des Sciences et Techniques de Sidi Bouzid",
                "Institut Supérieur de Théologie de Tunis",
                "Institut Supérieur de la Civilisation Islamique de Tunis",
                "Institut Supérieur des Sciences Islamiques de Kairouan",
                "Institut Supérieur des Etudes Technologiques de Charguia",
                "Institut Supérieur des Etudes Technologiques de Kasserine",
                "Institut Supérieur des Etudes Technologiques de Kairouan",
                "Institut Supérieur des Etudes Technologiques du Kef",
                "Institut Supérieur des Etudes Technologiques de Mahdia",
                "Institut Supérieur des Etudes Technologiques de Béja",
                "Institut Supérieur des Etudes Technologiques de Bizerte",
                "Institut Supérieur des Etudes Technologiques de Tataouine",
                "Institut Supérieur des Etudes Technologiques de Tozeur",
                "Institut Supérieur des Etudes Technologiques de Djerba",
                "Institut Supérieur des Etudes Technologiques de Jendouba",
                "Institut Supérieur des Etudes Technologiques de Rades",
                "Institut Supérieur des Etudes Technologiques de Zaghouan",
                "Institut Supérieur des Etudes Technologiques de Siliana",
                "Institut Supérieur des Etudes Technologiques de Sousse",
                "Institut Supérieur des Etudes Technologiques de Sidi Bouzid",
                "Institut Supérieur des Etudes Technologiques de Sfax",
                "Institut Supérieur des Etudes Technologiques de Gabés",
                "Institut Supérieur des Etudes Technologiques de Kébili",
                "Institut Supérieur des Etudes Technologiques de Ksar Hlel",
                "Institut Supérieur des Etudes Technologiques de Gafsa",
                "Institut Supérieur des Etudes Technologiques de Kélibia",
                "Institut Supérieur des Etudes Technologiques de Médenine",
                "Institut Supérieur des Etudes Technologiques de Nabeul",
                "Institut Supérieur des Etudes Technologiques en Communications de Tunis",
                "Institut National des Technologies et des Sciences du Kef"],
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
        this.getDepartements();
        this.getUsers();
    },
    methods: {
        getDepartements() {
            DepartementService.getAll().then(response => { this.departements = response.data.data });
        },
        getUsers() {
            userService.getAll().then(response => { this.users = response.data.data });
        },
        addEnseignant() {
            if (this.submitForm()) {
                if (this.enseignant.etablissement != 'Institut Supérieur des Etudes Technologiques de Bizerte') {
                    this.enseignant.departement = '';
                }
                const user = {
                    nom: this.enseignant.nom,
                    prenom: this.enseignant.prenom,
                    phoneNumber: this.enseignant.telephone,
                    cin: this.enseignant.cin,
                    genre: (this.enseignant.genre === 'femme') ? 1 : 0,
                    dateNaissance: this.enseignant.date_naissance,
                    adresse: this.enseignant.adresse,
                    Gouvernorat: this.enseignant.Gouvernorat,
                    user_type: "Enseignant",
                    email: this.enseignant.email,
                    password: this.enseignant.password,
                };
                console.log(user);
                userService.addUser(user).then((response) => {
                    console.log("user ajouté");
                    const userId = response.data.id;
                    const ensei = {
                        etablissement: this.enseignant.etablissement,
                        departement_id: this.enseignant.departement,
                        user_id: userId,
                    }
                    console.log(ensei);
                    enseignantService.addEnseignant(ensei);
                    const cv = {
                        user_id: userId,
                    }
                    cvService.addCv(cv);
                    console.log("enseignant ajouté");
                    if (this.enseignant.role === 'oui') {
                        const demande = {
                            type: "manager",
                            user_id: userId,
                        }
                        demandeService.addDemande(demande).then(() => {
                            Swal.fire({
                                title: "L'enseignant ajouté. Demande de manager soumise. Compte participant jusqu'à approbation",
                                showCancelButton: true,
                            }).then(() => {
                                this.$router.push("/Accueil");
                            });
                        })
                    } else {
                        this.$router.push("/Accueil");
                    }
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
            if (this.users.some(user => user.email === this.enseignant.email)) {
                this.errors.email = 'Email utilisé.';
            }
            if (!this.enseignant.telephone.match(/^\d{8}$/)) {
                this.errors.telephone = 'Le numéro de téléphone doit être composé de 8 chiffres.';
            }
            if (this.users.some(user => String(user.cin) === String(this.enseignant.cin))) {
                this.errors.cin = "cin utilisé";
            }
            if (!this.enseignant.cin.match(/^\d{8}$/)) {
                this.errors.cin = "Veuillez entrer un numéro de cin valide.";
            }
            if (this.enseignant.password !== this.enseignant.password2) {
                this.errors.password2 = "Les mots de passe ne correspondent pas.";
            }
            if (!this.enseignant.password) {
                this.errors.password = "Le mot de passe est requis.";
            }
            if (this.enseignant.password.length < 8) {
                this.errors.password = "Le mot de passe doit contenir au moins 8 caractères";
            }
            if (!this.enseignant.nom) {
                this.errors.nom = "Le nom est requis.";
            }
            if (!this.enseignant.prenom) {
                this.errors.prenom = "Le prenom est requis.";
            }
            if (!this.enseignant.departement && this.enseignant.etablissement === 'Institut Supérieur des Etudes Technologiques de Bizerte') {
                this.errors.departement = "Le departement est requis.";
            }
            if (!this.enseignant.adresse) {
                this.errors.adresse = "L'adresse est requis.";
            }
            if (!this.enseignant.genre) {
                this.errors.genre = "Le genre est requis.";
            }
            if (!this.enseignant.role) {
                this.errors.role = "ce champ est requis.";
            }
            if (!this.enseignant.etablissement) {
                this.errors.etablissement = "L'etablissment' est requis.";
            }
            if (!this.enseignant.Gouvernorat) {
                this.errors.Gouvernorat = "La gouvernorat est requis.";
            }
            if (!this.enseignant.password2) {
                this.errors.password2 = "Le mot de passe à confirmer est requis.";
            }
            if (!this.validateAge()) {
                this.errors.date_naissance = "Date de naissance invalide.";
            }
            if (!this.enseignant.date_naissance) {
                this.errors.date_naissance = "La date de naissance est requis.";
            }
            return Object.values(this.errors).every(error => error === "");
        },
        validateEmail() {
            const re = /\S+@\S+\.\S+/;
            const isValid = re.test(this.enseignant.email);
            if (!isValid) {
                return false;
            } else {
                return true;
            }
        },
        validateAge() {
            const dateNaissance = new Date(this.enseignant.date_naissance);
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
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
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