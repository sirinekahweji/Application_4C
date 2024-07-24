<template>
<div>
    <navbar></navbar>
    <div v-if="view == 'profile'">


        <!--Debut Modal Modifier info personnelle-->

        <div class="modal fade" id="ModalModifierInformations" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Mes Informations Personnelles</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>
                    </div>
                    <div class="modal-body needs-validation" novalidate>
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" v-model="prenom" placeholder="Prénom *"
                                :class="{ 'is-invalid': prenom.length === 0 }" required>
                            <div class="error-message" v-if="prenom.length === 0"><span
                                    class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Nom">Nom :</label>
                            <input type="text" id="Nom" v-model="nom" placeholder="Nom *"
                                :class="{ 'is-invalid': nom.length === 0 }" required>
                            <div class="error-message" v-if="nom.length === 0"><span
                                    class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DateNaissance">Date de Naissance :</label>
                            <input type="date" id="DateNaissance" v-model="dateNaissance"
                                placeholder="Date de Naissance *" :class="{ 'is-invalid': dateNaissance.length === 0 }"
                                required>
                            <div class="error-message" v-if="dateNaissance.length === 0"><span
                                    class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Genre :</label>
                            <div>
                                <label>
                                    <input type="radio" v-model="genre" value="femme"> Femme
                                </label>
                                <label>
                                    <input type="radio" v-model="genre" value="homme"> Homme
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CIN">CIN :</label>
                            <input type="number" id="CIN" v-model="cin" placeholder="CIN *"
                                :class="{ 'is-invalid': cin.length === 0 || !(/^\d{8}$/.test(cin)) }" required>

                            <div class="error-message" v-if="cin.length === 0">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire!
                            </div>
                            <div v-if="cin.length !== 0 && !(/^\d{8}$/.test(cin))" class="error-message">
                                <span class="bi bi-exclamation-circle"></span>
                                Le CIN doit être un nombre de 8 chiffres
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephoneMobile">Téléphone Mobile :</label>
                            <input type="tel" id="telephoneMobile" v-model="telephoneMobile"
                                placeholder="Téléphone Mobile *"
                                :class="{ 'is-invalid': telephoneMobile.length === 0 || !(/^\d{8}$/.test(telephoneMobile)) }"
                                required>
                            <div class="error-message" v-if="telephoneMobile.length === 0">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire!
                            </div>
                            <div v-if="telephoneMobile.length !== 0 && !(/^\d{8}$/.test(telephoneMobile))"
                                class="error-message">

                                <span class="bi bi-exclamation-circle"></span>
                                Le Téléphone Mobile doit être un nombre de 8 chiffres
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="gouvernorat">Gouvernorat :</label>
                            <select v-model="gouvernoratnom" id="gouvernorat"
                                :class="{ 'is-invalid': gouvernoratnom === null }" required>
                                <option :value="null" selected disabled>Sélectionnez un gouvernorat</option>
                                <option v-for="gouvernorat in gouvernorats" :key="gouvernorat" :value="gouvernorat">{{
        gouvernorat }}</option>
                            </select>
                            <div class="error-message" v-if="gouvernoratnom === null">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire

                            </div>

                        </div>


                        <div class="form-group">
                            <label for="adresse">Adresse :</label>
                            <input type="text" id="adresse" v-model="adresse" placeholder="Adresse *"
                                :class="{ 'is-invalid': adresse.length === 0 }">
                            <div class="error-message" v-if="adresse.length === 0">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire

                            </div>
                        </div>

                        <div class="form-group"
                            v-if="this.user.user_type === 'Enseignant' || this.user.user_type === 'Etudiant'">
                            <label for="etablissement">Établissement :</label>
                            <select v-model="etablissement" id="etablissement"
                                :class="{ 'is-invalid': etablissement === null }" required>
                                <option :value="null" selected disabled>Sélectionnez Votre Établissement</option>
                                <option v-for="etabl in etablissements " :key="etabl" :value="etabl">{{ etabl }}
                                </option>
                            </select>
                            <div class="error-message" v-if="etablissement === null">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire

                            </div>
                        </div>
                        <div class="form-group"
                            v-if="this.user.user_type === 'Enseignant' || this.user.user_type === 'Etudiant'">
                            <label for="departemnet">Département :</label>
                            <select v-model="departementnom" id="departemnet"
                                :class="{ 'is-invalid': departementnom === null }" required>
                                <option :value="null" selected disabled>Sélectionnez Votre Département</option>
                                <option v-for="departemnet in departements " :key="departemnet" :value="departemnet.id">
                                    {{ departemnet.nom }}</option>
                            </select>
                            <div class="error-message" v-if="departementnom === null">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>



                        <div class="form-group" v-if="this.user.user_type === 'Etudiant'">
                            <label for="specialit">Specialite :</label>
                            <select id="specialit" v-model="specialit" :class="{ 'is-invalid': specialit === null }"
                                required>
                                <option :value="null" selected disabled>Sélectionnez Votre Specialite</option>
                                <option v-for="specialite in specialites" :key="specialite" :value="specialite.id">{{
        specialite.nom }}</option>
                            </select>
                            <div class="error-message" v-if="specialit === null">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>

                        <div class="form-group" v-if="this.user.user_type === 'Etudiant'">
                            <label for="classe">Classe :</label>
                            <select id="classe" v-model="classee" :class="{ 'is-invalid': classee === null }" required>
                                <option :value="null" selected disabled>Sélectionnez Votre Classe</option>
                                <option v-for="clas in classes" :key="clas" :value="clas.id">{{ clas.nom }}</option>
                            </select>
                            <div class="error-message" v-if="classee === null">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>

                        <div class="form-group" v-if="this.user.user_type === 'PersonnelEntreprise'">
                            <label for="fonctionanlite">Fonctionnalité :</label>
                            <input type="text" id="fonctionnalite" v-model="fonctionnalite"
                                :class="{ 'is-invalid': fonctionnalite.length === 0 }" placeholder="Fonctionnalité *"
                                required>
                            <div class="error-message" v-if="fonctionnalite.length === 0">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="form-group" v-if="this.user.user_type === 'PersonnelEntreprise'">
                            <label for="entreprise">Entreprise :</label>
                            <select v-model="Entreprise" id="entreprise" :class="{ 'is-invalid': Entreprise === null }"
                                required>
                                <option :value="null" selected disabled>Sélectionnez Votre Entreprise</option>
                                <option v-for="entreprise in entreprises" :key="entreprise" :value="entreprise.id">{{
        entreprise.nom }}</option>
                            </select>
                            <div class="error-message" v-if="Entreprise === null">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lien">LienLinkedIn :</label>
                            <input type="text" id="lien" v-model="lienlinkedin" placeholder="LienLinkedIn *"
                                :class="{ 'is-invalid': lienlinkedin.length === 0 }">
                            <div class="error-message" v-if="lienlinkedin.length === 0">
                                <span class="bi bi-exclamation-circle"></span>
                                Ce champ est obligatoire
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="enregistrer btn btn-primary btn-xs" data-bs-dismiss="modal"
                                    @click="enregistrerModifications()">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin modal -->

        <!--Debut Modifier info Informations du compte  Modal-->
        <div class="modal fade" id="ModalInfoCompte" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Mes Informations Du Compte </h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" v-model="email" placeholder="Email *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">Nouveau mot de passe :</label>
                                        <input type="password" id="newPassword" v-model="newPassword"
                                            placeholder="Nouveau mot de passe *" required>
                                    </div>
                                </div>
                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="oldPassword">Ancien mot de passe :</label>
                                        <input type="password" id="oldPassword" v-model="oldPassword"
                                            placeholder="Ancien mot de passe *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmNewPassword">Confirmer mot de passe :</label>
                                        <input type="password" id="confirmNewPassword" v-model="confirmNewPassword"
                                            placeholder="Confirmer le nouveau mot de passe *" required>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal"
                                    @click="updateCredentials()">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin Modal-->

        <!--Debut modal Expérience-->
        <div class="modal fade" id="ModalExperience" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ modalTitle }}</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="poste">Poste:</label>
                                        <input type="text" id="poste" v-model="Poste" placeholder="Poste*" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nomS">Nom Entreprise:</label>
                                        <input type="text" id="nomS" v-model="nomEntreprise"
                                            placeholder="Nom de L'entreprise *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lieu">Lieu :</label>
                                        <input type="text" id="lieu" v-model="lieu" placeholder="Adresse Entreprise"
                                            required>
                                    </div>
                                </div>

                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="datedebut" class="form-label">Date de début :</label>
                                        <input type="date" class="form-control" id="datedebut" v-model="datedebut"
                                            placeholder="Date de début :" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateFin" class="form-label">Date de fin :</label>
                                        <input type="date" id="dateFin" class="form-control" v-model="dateFin"
                                            placeholder="Date de fin *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description :</label>
                                        <textarea id="description" class="form-control" v-model="description"
                                            placeholder="Description ..." required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    @click="actionButtonLabel === 'Ajouter' ? AddExperience() : UpdateExperience()"
                                    data-bs-dismiss="modal">{{ actionButtonLabel }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin modal-->
        <!--Debut Modal FormationAcd -->
        <div class="modal fade" id="ModalFormationAcd" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> {{ modalTitle }} </h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="etablissement">Etablissement:</label>
                                        <input type="text" id="etablissement" v-model="etablissement"
                                            placeholder="Etablissement*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="diplome">Diplome:</label>
                                        <input type="text" id="diplome" v-model="diplome" placeholder="Diplome*"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="domaineEtude">Domaine Etude:</label>
                                        <input type="text" id="domaineEtude" v-model="domaineEtude"
                                            placeholder="Domaine Etude *" required>
                                    </div>

                                </div>

                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="datedebut" class="form-label">Date de début :</label>
                                        <input type="date" class="form-control" id="datedebut" v-model="datedebut"
                                            placeholder="Date de début :" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateFin" class="form-label">Date de fin :</label>
                                        <input type="date" id="dateFin" class="form-control" v-model="dateFin"
                                            placeholder="Date de fin *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description :</label>
                                        <textarea id="description" class="form-control" v-model="description"
                                            placeholder="Description ..." required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    @click="actionButtonLabel === 'Ajouter' ? AddFormationAcd() : UpdateFormationAcd()"
                                    data-bs-dismiss="modal">{{ actionButtonLabel }} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Debut Modal Formation-->
        <div class="modal fade" id="ModalFormation" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ modalTitle }}</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="titre">Titre:</label>
                                        <input type="text" id="titre" v-model="titre" placeholder="Titre*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="categorie">Categorie:</label>
                                        <input type="text" id="categorie" v-model="categorie" placeholder="Categorie*"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="organisation" class="form-label">Organisation:</label>
                                        <input type="text" class="form-control" id="organisation" v-model="organisation"
                                            placeholder="Organisation :" required>
                                    </div>


                                </div>

                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Date:</label>
                                        <input type="date" class="form-control" id="date" v-model="date"
                                            placeholder="Date :" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="description" class="form-label">Description :</label>
                                        <textarea id="description" class="form-control" v-model="description"
                                            placeholder="Description ..." required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    @click="actionButtonLabel === 'Ajouter' ? AddFormationExterne() : UpdateFormationExterne()"
                                    data-bs-dismiss="modal">{{ actionButtonLabel }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin Modal-->
        <!--Debut Langue Modal-->
        <div class="modal fade" id="ModalLangue" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ modalTitle }}</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="nom">Nom Langue:</label>
                                        <input type="text" id="nom" v-model="nom" placeholder="Nom Langue *" required>
                                    </div>

                                </div>

                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="niveau">Niveau:</label>
                                        <input type="text" id="niveau" v-model="niveau" placeholder="Niveau*" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    @click="actionButtonLabel === 'Ajouter' ? AddLangue() : UpdateLangue()"
                                    data-bs-dismiss="modal">{{ actionButtonLabel }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Debut Modal Competance-->
        <div class="modal fade" id="ModalCompetance" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ modalTitle }}</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="nom">Nom:</label>
                                        <input type="text" id="nom" v-model="nom" placeholder="Nom Competance*"
                                            required>
                                    </div>
                                </div>
                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="niveau">Niveau:</label>
                                        <input type="text" id="niveau" v-model="niveau" placeholder="Niveau*" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    @click="actionButtonLabel === 'Ajouter' ? AddCompetence() : updateCompetence()"
                                    data-bs-dismiss="modal">{{ actionButtonLabel }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Debut Modal Certificat-->
        <div class="modal fade" id="ModalCertificat" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ modalTitle }}</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column1">
                                    <div class="form-group">
                                        <label for="titre">Titre :</label>
                                        <input type="text" id="titre" v-model="titre" placeholder="Titre *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="categorie">Categorie :</label>
                                        <input type="text" id="categorie" v-model="categorie" placeholder="Categorie *"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="organisation">Organisation :</label>
                                        <input type="text" id="organisation" v-model="organisation"
                                            placeholder="Organisation *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="certificat">Certificat :</label>
                                        <input type="file" id="certificatimg" placeholder="Certificat *" required>
                                    </div>



                                </div>

                                <div class="form-column2">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Date:</label>
                                        <input type="date" class="form-control" id="date" v-model="date"
                                            placeholder="Date :" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description :</label>
                                        <textarea id="description" class="form-control" v-model="description"
                                            placeholder="Description ..." required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    @click="actionButtonLabel === 'Ajouter' ? AddCertificat() : UpdateCertificat()"
                                    data-bs-dismiss="modal">{{ actionButtonLabel }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin Modal-->
        <!--Modals Consult CV-->
        <!--Debut modal consult Expérience-->
        <div class="modal fade" id="ModalConsultExperience" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">détails Expérience :</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <ul class="info" v-if="Object.keys(experienceDetaills).length > 0">

                            <div>
                                <li><strong>Poste :</strong> {{ experienceDetaills.poste }}</li>
                                <li><strong>Date Debut :</strong> {{ experienceDetaills.dateDebut }} </li>
                                <li><strong>Lieu :</strong>{{ experienceDetaills.lieu }} </li>
                            </div>
                            <div>
                                <li><strong>Entreprise :</strong>{{ experienceDetaills.entreprise }} </li>
                                <li><strong>Date Fin :</strong> {{ experienceDetaills.dateFin }} </li>
                                <li><strong>Description :</strong> {{ experienceDetaills.description }} </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin modal-->
        <!--Debut Modal consult FormationAcd -->
        <div class="modal fade" id="ModalconsultFormationAcd" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> détails Formation Académique : </h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="info">

                            <div>
                                <li><strong>Etablissement :</strong>{{ formationAcdDetaills.etablissement }} </li>
                                <li><strong>Date de début :</strong>{{ formationAcdDetaills.dateDebut }} </li>
                                <li><strong>Domaine Etude :</strong>{{ formationAcdDetaills.domaineEtude }} </li>
                            </div>
                            <div>
                                <li><strong>Diplôme :</strong> {{ formationAcdDetaills.diplome }}</li>
                                <li><strong>Date de fin :</strong>{{ formationAcdDetaills.dateFin }} </li>
                                <li><strong>Description :</strong> {{ formationAcdDetaills.description }}</li>

                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Debut Modal consult  Formation-->
        <div class="modal fade" id="ModalconsultFormation" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">détails Formation :</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <ul class="info">

                            <div>
                                <li><strong>Titre :</strong> {{ formationDetaills.titre }}</li>
                                <li><strong> Categorie:</strong>{{ formationDetaills.categorie }} </li>
                            </div>
                            <div>
                                <li><strong>Organisation :</strong> {{ formationDetaills.organisation }}</li>
                                <li><strong>Date :</strong> {{ formationDetaills.date }}</li>
                                <li><strong>Description:</strong> {{ formationDetaills.description }}</li>

                            </div>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <!--Fin Modal-->
        <!--Debut Langue Modal-->
        <div class="modal fade" id="ModalconsultLangue" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">détails Langue:</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <ul class="info2">

                            <div>
                                <li><strong>Nom :</strong> {{ langueDetaills.nom }}</li>
                            </div>
                            <div>
                                <li><strong>Niveau :</strong> {{ langueDetaills.niveau }}</li>
                            </div>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Debut Modal consult Competance-->
        <div class="modal fade" id="ModalconsultCompetance" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">détails compétence :</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <ul class="info2">


                            <li style="width: 100%;"><strong>Nom :</strong> {{ competenceDetaills.nom }}</li>



                            <li style="width: 100%;"><strong>Niveau :</strong> {{ competenceDetaills.niveau }}</li>



                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Debut Modal consult Certificat-->
        <div class="modal fade" id="ModalconsultCertificat" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">détails Certification :</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <ul class="info">

                            <div>
                                <li><strong>Titre :</strong> {{ certificatDetaills.titre }}</li>
                                <li><strong>Categorie :</strong>{{ certificatDetaills.categorie }} </li>
                                <li><strong>Description:</strong> {{ certificatDetaills.description }}</li><br>


                            </div>
                            <div>
                                <li><strong>Organisation:</strong> {{ certificatDetaills.organisation }}</li>
                                <li><strong>Date:</strong> {{ certificatDetaills.date }}</li>
                            </div>
                        </ul>

                        <img class="imgCertif" v-if="certificatDetaills.certificat"
                            v-bind:src="certificatDetaills.certificat" alt="Certificat">


                    </div>
                </div>
            </div>
        </div>
        <!--Debut Update Adresse Modal-->
        <div class="modal fade" id="ModalAdresse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Moddifier Adresse</h1>
                        <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal"
                            aria-label="Close" @click="Annuler()"></button>

                    </div>
                    <div class="modal-body">
                        <div class="inscription-formEntreprise">
                            <form @submit.prevent="submitForm">
                                <div class="form-column">
                                    <div class="form-group">
                                        <label for="adresse">Nom Langue:</label>
                                        <input type="text" id="adresse" v-model="adresse" placeholder="Votre adresse *"
                                            required>
                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-xs" data-bs-dismiss="modal"
                                    @click="Annuler()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-xs"
                                    data-bs-dismiss="modal">Moddifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->
        <!--Fin Modal-->
        <div class="container-fluid">
            <div class="cover-container">

                <img @click="openFullScreenImage(getPhotoCouverture())" :src="photoCouverture" alt="couverture"
                    class="cover-image">
                <button>
                    <label for="cover-file">
                        <img src="@/assets/cam.png" alt="cam" id="camImage">
                    </label>
                    <input id="cover-file" type="file" style="display: none;" @change="changerPhotoCouverture">
                </button>



                <div>

                    <img @click="openFullScreenImage(getImageSource())" :src="getImageSource()" alt="Photo de profil"
                        class="profile-image">
                    <button>
                        <label for="profile-file">
                            <img src="@/assets/cam.png" alt="cam" id="cam">
                        </label>
                        <input id="profile-file" type="file" style="display: none;" @change="handleFileUpload">
                    </button>
                </div>
            </div>
            <div class="nom">
                <h5>{{ this.user.nom }} {{ this.user.prenom }}</h5>


                <div class="rating" v-if="idManager === user.role_id">
                    <input type="radio" name="rating" id="r1">
                    <label for="r1" v-bind:class="{ 'filled': this.user.nbEtoiles >= 5 }"></label>

                    <input type="radio" name="rating" id="r2">
                    <label for="r2" v-bind:class="{ 'filled': this.user.nbEtoiles >= 4 }"></label>

                    <input type="radio" name="rating" id="r3">
                    <label for="r3" v-bind:class="{ 'filled': this.user.nbEtoiles >= 3 }"></label>

                    <input type="radio" name="rating" id="r4">
                    <label for="r4" v-bind:class="{ 'filled': this.user.nbEtoiles >= 2 }"></label>

                    <input type="radio" name="rating" id="r5">
                    <label for="r5" v-bind:class="{ 'filled': this.user.nbEtoiles >= 1 }"></label>
                </div>
                <p>{{ this.user.adresse }}</p>
            </div>
        </div>
        <div class="container-fluid pro">
            <section id="information">
                <div>
                    <div class="personnel">
                        <h6>Mes Informations personnelles :</h6>
                        <button><img src="@/assets/edit.png" alt="modifier" data-bs-toggle="modal"
                                data-bs-target="#ModalModifierInformations" @click="recupererInfoPersonnel()"></button>
                    </div>
                    <ul class="info">
                        <div>
                            <li><strong>Prénom :</strong> {{ this.user.prenom }}</li>
                            <li><strong>Date de naissance :</strong> {{ this.user.dateNaissance }}</li>
                            <li v-if="this.user.user_type === 'Enseignant' && this.enseignant.etablissement && this.enseignant.etablissement.length !== 0"><strong>Etablissement :</strong> {{
        this.enseignant.etablissement }}</li>
                            <li v-if="this.user.user_type === 'Etudiant' && this.etudiant.etablissement && this.etudiant.etablissement.length !== 0"><strong>Etablissement :</strong> {{
        this.etudiant.etablissement }}</li>
                            <li v-if="this.user.user_type === 'Etudiant' && this.etudiant.specialit && this.etudiant.specialit.length !== 0"><strong>Specialite :</strong>{{
        this.specialite.nom }}</li>
                            <li v-if="this.user.user_type === 'PersonnelEntreprise' && this.personnel.fonctionnalite && this.personnel.fonctionnalite.length !== 0"> <strong>Fonctionnalite :</strong>
                                {{ this.personnel.fonctionnalite }}</li>
                            <li><strong>Gouvernorat :</strong> {{ this.user.Gouvernorat }}</li>
                            <li><strong>Téléphone mobile :</strong> {{ this.user.phoneNumber }}</li>
                        </div>
                        <div>
                            <li><strong>Nom :</strong>{{ this.user.nom }} </li>

                            <li v-if="(this.user.user_type === 'Etudiant' || this.user.user_type === 'Enseignant') && this.departement.nom && this.departement.nom.length !== 0">
                                <strong>Departement :</strong> {{ this.departement.nom }}
                            </li>
                            <li v-if="this.user.user_type === 'Etudiant' && this.etudiant.classe && this.etudiant.classe.length !== 0"><strong>Classe :</strong>{{ this.classe.nom }}
                            </li>
                            <li v-if="this.user.user_type === 'PersonnelEntreprise' && this.entreprise.nom && this.entreprise.nom.length !== 0"><strong>Entreprise :</strong> {{
        this.entreprise.nom }}</li>
                            <li><strong>Adresse :</strong> {{ this.user.adresse }}</li>
                            <li v-if="this.user.lienLinkdIn && this.user.lienLinkdIn.length !== 0"><strong>LinkedIn :</strong> {{ this.user.lienLinkdIn }}</li>
                        </div>
                    </ul>
                    <div class="personnel">
                        <h6>Mes Informations du compte :</h6>
                        <button><img src="@/assets/edit.png" alt="modifier" data-bs-toggle="modal"
                                data-bs-target="#ModalInfoCompte" @click="recupererInfoCompte()"></button>
                    </div>
                    <ul class="info compte">
                        <div class="mail">
                            <li><strong>Email :</strong></li>
                            <li>{{ this.user.email }}</li>
                            <li><strong>Mot de passe :</strong>**********</li>
                        </div>
                        <div class="qr">
                            <svg ref="qrCode"></svg>
                            <button @click="downloadQRCode">Télécharger code QR</button>
                        </div>
                    </ul>
                </div>
            </section>

            <section id="cv">
                <div class="pdf">
                    <button id="load" @click="changerView('cv')">
                        <img src="@/assets/load.png" alt="load">
                    </button>
                    <button id="upload">
                        <label for="file-upload">
                            <img src="@/assets/upload.png" alt="upload">
                        </label>
                        <input id="file-upload" type="file" style="display: none;" @change="handleFileUpload">
                    </button>
                </div>

                <div class="card">
                    <div class="Expériences">
                        <p class="champ"> Expériences<img src="@/assets/plus.png" alt="ajouter" class="add"
                                data-bs-toggle="modal" :data-bs-target="modalTarget"
                                @click="openModal(false, '#ModalExperience', 'Ajouter Une Expérience')"></p>
                        <ul class="content">
                            <li v-for="(expérience, index) in Expériences" :key="index">{{ expérience.poste }} <div>
                                    <button @click="recupererDonnes(index, 'expérience')"><i
                                            class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                            :data-bs-target="modalTarget"
                                            @click="openModal(true, '#ModalExperience', 'Modifier Une Expérience')"></i></button>

                                    <button><i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                            data-bs-target="#ModalConsultExperience"
                                            @click="afficherdetails(index, 'expérience')"></i></button>
                                    <button><i class="bi bi-trash-fill icon"
                                            @click="confirmDelete(index, 'expérience')"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="FormationAcadémique">
                        <p class="champ">Formation Académique<img src="@/assets/plus.png" alt="ajouter" class="add"
                                data-bs-toggle="modal" :data-bs-target="modalTarget"
                                @click="openModal(false, '#ModalFormationAcd', 'Ajouter Une Formation Académique')"></p>
                        <ul class="content">
                            <li v-for="(FormationAcd, index) in FormationAcadémique" :key="index">
                                {{ FormationAcd.diplome }}
                                <div>
                                    <button @click="recupererDonnes(index, 'FormationAcadémique')"><i
                                            class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                            :data-bs-target="modalTarget"
                                            @click="openModal(true, '#ModalFormationAcd', 'Modifier Une Formation Académique')"></i></button>
                                    <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                        data-bs-target="#ModalconsultFormationAcd"
                                        @click="afficherdetails(index, 'FormationAcadémique')"></i>
                                    <button><i class="bi bi-trash-fill icon"
                                            @click="confirmDelete(index, 'FormationAcadémique')"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="Formations">
                        <p class="champ">Formations<img src="@/assets/plus.png" alt="ajouter" class="add"
                                data-bs-toggle="modal" :data-bs-target="modalTarget"
                                @click="openModal(false, '#ModalFormation', 'Ajouter Une Formation')"></p>
                        <ul class="content">
                            <li v-for="(Formation, index) in Formations" :key="index">{{ Formation.titre }} <div>
                                    <button @click="recupererDonnes(index, 'Formation')"><i
                                            class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                            :data-bs-target="modalTarget"
                                            @click="openModal(true, '#ModalFormation', 'Ajouter Une Formation')"></i></button>
                                    <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                        data-bs-target="#ModalconsultFormation"
                                        @click="afficherdetails(index, 'Formation')"></i><button><i
                                            class="bi bi-trash-fill icon"
                                            @click="confirmDelete(index, 'Formation')"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="Certifications">
                        <p class="champ">Certifications<img src="@/assets/plus.png" alt="ajouter" class="add"
                                data-bs-toggle="modal" :data-bs-target="modalTarget"
                                @click="openModal(false, '#ModalCertificat', 'Ajouter Une Certification')"></p>
                        <ul class="content">
                            <li v-for="(Certification, index) in Certifications" :key="index">{{ Certification.titre }}
                                <div><button @click="recupererDonnes(index, 'Certification')"><i
                                            class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                            :data-bs-target="modalTarget"
                                            @click="openModal(true, '#ModalCertificat', 'Modifier Une Certification')"></i></button>
                                    <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                        data-bs-target="#ModalconsultCertificat"
                                        @click="afficherdetails(index, 'Certification')"></i><button><i
                                            class="bi bi-trash-fill icon"
                                            @click="confirmDelete(index, 'Certification')"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="Langues">
                        <p class="champ">Langues<img src="@/assets/plus.png" alt="ajouter" class="add"
                                data-bs-toggle="modal" :data-bs-target="modalTarget"
                                @click="openModal(false, '#ModalLangue', 'Ajouter Une Langue')"></p>
                        <ul class="content">
                            <li v-for="(Langue, index) in Langues" :key="index">{{ Langue.nom }} <div>
                                    <button @click="recupererDonnes(index, 'Langues')"><i
                                            class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                            :data-bs-target="modalTarget"
                                            @click="openModal(true, '#ModalLangue', 'Modifier Une Langue')"></i></button>
                                    <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                        data-bs-target="#ModalconsultLangue"
                                        @click="afficherdetails(index, 'Langues')"></i><button><i
                                            class="bi bi-trash-fill icon"
                                            @click="confirmDelete(index, 'Langues')"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="Compétences">
                        <p class="champ">Compétences<img src="@/assets/plus.png" alt="ajouter" class="add"
                                data-bs-toggle="modal" :data-bs-target="modalTarget"
                                @click="openModal(false, '#ModalCompetance', 'Ajouter Une Competance')"></p>
                        <ul class="content">
                            <li v-for="(Compétence, index) in Compétences" :key="index">{{ Compétence.nom }} <div>
                                    <button @click="recupererDonnes(index, 'Compétence')"><i
                                            class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                            :data-bs-target="modalTarget"
                                            @click="openModal(true, '#ModalCompetance', 'Modifier Une Competance')"></i></button>
                                    <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                        data-bs-target="#ModalconsultCompetance"
                                        @click="afficherdetails(index, 'Compétence')"></i><button><i
                                            class="bi bi-trash-fill icon"
                                            @click="confirmDelete(index, 'Compétence')"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </section>
        </div>
        <div class="container-fluid pass">
            <passport></passport>
        </div>
    </div>
    <cvComponent @changerView="changerView" :user="user" :Compétences="Compétences" :Langues="Langues"
        :Expériences="Expériences" :Certifications="Certifications" :FormationAcadémique="FormationAcadémique"
        :departement="departement" :Etudiant="etudiant" :Enseignant="enseignant" :personnel="personnel"
        :specialite="specialite" v-else></cvComponent>
</div>
</template>
<script>
import Axios from "axios";
import navbar from '@/components/navbar.vue'
import cvComponent from '@/components/Profil/cv.vue'
import ExperienceService from '../services/experiences.js'
import FormationAcdService from '../services/formationsAcademiques.js'
import FormationService from '../services/formation.js'
import CertificatService from '../services/certificats.js'
import LangueService from '../services/langues.js'
import CompetenceService from '../services/competences.js'
import UserService from '../services/users.js'
import CVsService from '../services/cvs.js'
import PersonnelService from '../services/personnels.js'
import EntrepriseService from '../services/entreprises.js'
import EnseignantService from '@/services/enseignants.js'
import EtudiantService from '@/services/etudiants.js'
import DepartmentService from '@/services/departements.js'
import ClasseService from '@/services/classes.js'
import SpecialiteService from '@/services/specialites.js'
import RoleService from '@/services/roles.js'

//import QRCode from 'qrcode-svg';
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import Swal from 'sweetalert2'
import passport from '../components/Profil/passport.vue'



export default {
    created() {
        this.readUserFromLocalStorage();
        this.getProfil();
        this.getManager();
        this.getAdmin();
        this.getResponsable();

    },
    mounted() {
       this.photoCouverture = this.getPhotoCouverture();
  },
    components: {
        navbar,
        cvComponent,
        passport,

    },
    data() {
        return {
            
            gouvernorats: [
                'Ariana', 'Béja', 'Ben Arous', 'Bizerte', 'Gabès',
                'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kébili',
                'Le Kef', 'Mahdia', 'La Manouba', 'Médenine', 'Monastir',
                'Nabeul', 'Sfax', 'Sidi Bouzid', 'Siliana', 'Sousse',
                'Tataouine', 'Tozeur', 'Tunis', 'Zaghouan'
            ],

            experienceAajouter: {
                "poste": "",
                "entreprise": "",
                "lieu": "",
                "dateDebut": "",
                "dateFin": "",
                "description": "",
                "cv_id": "",
            },
            certificateAajouter: {
                "titre": "",
                "description": "",
                "categorie": "",
                "date": "",
                "type_certificat": "Externe",
                "organisation": "",
                "certificat": "",
                "cv_id": "",
            },
            langue:
            {
                "nom": "",
                "niveau": "",
                "cv_id": "",
            },
            competence:
            {
                "nom": "",
                "niveau": "",
                "cv_id": "",
            },
            formationAcd: {

                "etablissement": "",
                "diplome": "",
                "domaineEtude": "",
                "dateDebut": "",
                "dateFin": "",
                "description": "",
                "cv_id": "",
            },
            formationExterne: {
                "titre": "",
                "description": "",
                "categorie": "",
                "date": "",
                "type_formation": "formationExterne",
                "organisation": "",
                "cv_id": "",
            },
            Enseignant: {
                "nom": "",
                "prenom": "",
                "phoneNumber": "",
                "cin": "",
                "photoProfile": "",
                "photoCouverture": "",
                "genre": "",
                "dateNaissance": "",
                "lienLinkdIn": "",
                "adresse": "",
                "Gouvernorat": " ",
                "etablissement": "",
                "departement_id": "",

            },
            Personnl: {
                "nom": "",
                "prenom": "",
                "phoneNumber": "",
                "cin": "",
                "photoProfile": "",
                "photoCouverture": "",
                "genre": "",
                "dateNaissance": "",
                "lienLinkdIn": "",
                "adresse": "",
                "Gouvernorat": " ",
                "fonctionnalite": "",
                "entreprise_id": "",

            },
            Etudiant: {
                "nom": "",
                "prenom": "",
                "phoneNumber": "",
                "cin": "",
                "photoProfile": "",
                "photoCouverture": "",
                "genre": "",
                "dateNaissance": "",
                "lienLinkdIn": "",
                "adresse": "",
                "Gouvernorat": " ",
                "etablissement": "",
                "classe_id": "",

            },
            data: {
                "password": '',

            },
            fonctionnalite: '',
            /*entreprise_id:null,*/
            Entreprise: null,
            lienlinkedin: '',
            department: '',
            email: '',
            newPassword: '',
            oldPassword: '',
            confirmNewPassword: '',
            titre: '',
            photoCouverture:'',
            categorie: '',
            date: '',
            organisation: '',
            nomEntreprise: '',
            Poste: '',
            dateNaissance: '',
            genre: '',
            cin: '',
            telephoneMobile: '',
            gouvernorat: '',
            adresse: '',
            lieu: '',
            category: null,

            datedebut: '',
            dateFin: '',
            description: '',
            cv_id: "",
            id: '',
            certificatimg: null,
            etablissement: null,
            departementnom: null,
            gouvernoratnom: null,
            departementid: null,
            specialitenom: '',
            fonctionnalit: '',
            diplome: '',
            nom: '',
            prenom: '',
            niveau: '',
            domaineEtude: '',
            modalTarget: '',
            isEditing: false,
            modalTitle: '',
            modal: ' ',
            user_type: '',
            classee: null,
            specialit: null,
            user: null,
            actionButtonLabel: 'Ajouter',
            users: [],
            departements: [],
            classes: [],
            specialites: [],
            entreprises: [],
            profil: {},
            cv: {},
            etudiant: {},
            enseignant: {},
            personnel: {},
            classeupdate: {},
            entreprise: {},
            departement: {},
            classe: {},
            specialite: {},
            Expériences: [

            ],
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
            isCinValid: false,
            isPhoneValid: true,
            //valider:false,

            FormationAcadémique: [

            ],
            Formations: [
            ],
            Certifications: [
            ],
            Langues: [

            ],
            Compétences: [

            ],

            couvertureImage: require('@/assets/couverture.png'),
            profileImage: require('@/assets/both.jpg'),
            view: "profile",
            ModalCertification: false,
            ModalLangue: false,
            ModalCompetance: false,
            ModalFormation: false,
            ModalFormationAcd: false,
            ModalExperience: false,
            experienceDetaills: {},
            formationAcdDetaills: {},
            formationDetaills: {},
            certificatDetaills: {},
            langueDetaills: {},
            competenceDetaills: {},
            Credentials: {
                "email": "",
                "password": "",
            },
            name: '',
            nameState: null,
            admin: null,
            responsable: null,
            idManager: null,
            submittedNames: []

        }
    },

    methods: {
        getManager() {
            RoleService.findIdManager().then(res => {
                this.idManager = res.data;
            })
        },
        getAdmin() {
            RoleService.findIdAdmin().then(res => {
                this.admin = res.data;
            })
        },
        getResponsable() {
            RoleService.findIdResponsable().then(res => {
                this.responsable = res.data;
            })
        },
        recupererInfoPersonnel() {
            this.nom = this.user.nom;
            this.prenom = this.user.prenom;
            this.telephoneMobile = this.user.phoneNumber;
            this.cin = this.user.cin;
            this.photoProfile = this.user.photoProfile;
            this.photoCouverture = this.user.photoCouverture;
            this.gouvernoratnom = this.user.Gouvernorat;
            if (this.user.genre == 0) {
                this.genre = "homme";

            }
            else {
                this.genre = "femme";

            }

            this.dateNaissance = this.user.dateNaissance;
            this.lienlinkedin = this.user.lienLinkdIn;
            this.adresse = this.user.adresse;

            if (this.user.user_type == "Enseignant") {
                this.etablissement = this.enseignant.etablissement;
                //this.departementnom=this.departement.id;


            }
            else if (this.user.user_type == "PersonnelEntreprise") {

                this.fonctionnalite = this.personnel.fonctionnalite;

            }
            else {
                this.etablissement = this.etudiant.etablissement;
                //this.departementnom=this.departement.nom;
                //this.classee=this.classe.id;
            }

        },


        enregistrerModifications() {

            let cinValid = /^\d{8}$/.test(this.cin);
            let phoneValid = /^\d{8}$/.test(this.telephoneMobile);

            if (this.user.user_type == "Etudiant") {
                if (!cinValid || !phoneValid || this.prenom.length === 0 ||
                    this.nom.length === 0 ||
                    this.dateNaissance.length === 0 ||
                    this.cin.length === 0 ||
                    this.telephoneMobile.length === 0 ||
                    this.gouvernoratnom === null ||
                    this.adresse.length === 0 ||
                    this.etablissement === null || this.departementnom === null ||
                    this.specialit === null || this.classee === null ||
                    this.lienlinkedin.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Veuillez remplir tous les champs obligatoires.'
                    });
                }
                else {
                    //console.log("madifier etud")
                    this.Etudiant.nom = this.nom;
                    this.Etudiant.prenom = this.prenom;
                    this.Etudiant.phoneNumber = this.telephoneMobile;
                    this.Etudiant.cin = this.cin;
                    this.Etudiant.photoProfile = this.photoProfile;

                    this.Etudiant.photoCouverture = this.user.photoCouverture;
                    if (this.genre == "homme") {
                        this.Etudiant.genre = 0;
                    }
                    else {
                        this.Etudiant.genre = 1;
                    }
                    this.Etudiant.dateNaissance = this.dateNaissance;
                    this.Etudiant.lienLinkdIn = this.lienlinkedin;
                    this.Etudiant.adresse = this.adresse;

                    this.Etudiant.Gouvernorat = this.gouvernoratnom;


                    if (this.classee == null) {
                        this.Etudiant.classe_id = this.classe.id;

                    }
                    else {
                        this.Etudiant.classe_id = this.classee;

                    }
                    this.Etudiant.etablissement = this.etablissement;
                    this.updateEtudient();
                    Swal.fire({
                        icon: 'success',
                        title: 'Modifications enregistrées',
                        text: 'Les informations personnelles ont été modifiées avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                }


            }
            else if (this.user.user_type == "Enseignant") {

                if (!cinValid || !phoneValid || this.prenom.length === 0 ||
                    this.nom.length === 0 ||
                    this.dateNaissance.length === 0 ||
                    this.cin.length === 0 ||
                    this.telephoneMobile.length === 0 ||
                    this.gouvernoratnom === null ||
                    this.adresse.length === 0 ||
                    this.etablissement === null || this.departementnom === null ||
                    this.lienlinkedin.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Veuillez remplir tous les champs obligatoires.'
                    });

                }
                else {
                    this.Enseignant.nom = this.nom;
                    this.Enseignant.prenom = this.prenom;
                    this.Enseignant.phoneNumber = this.telephoneMobile;
                    this.Enseignant.cin = this.cin;
                    this.Enseignant.photoProfile = this.photoProfile;
                    this.Enseignant.photoCouverture = this.user.photoCouverture;
                    if (this.genre == "homme") {
                        this.Enseignant.genre = 0;
                    }
                    else {
                        this.Enseignant.genre = 1;
                    }
                    this.Enseignant.dateNaissance = this.dateNaissance;
                    this.Enseignant.lienLinkdIn = this.lienlinkedin;
                    this.Enseignant.adresse = this.adresse;
                    this.Enseignant.Gouvernorat = this.gouvernoratnom;
                    this.Enseignant.etablissement = this.etablissement;

                    if (this.departementnom == null) {
                        this.Enseignant.departement_id = this.departement.id;

                    }
                    else {

                        this.Enseignant.departement_id = this.departementnom;
                    }

                    //console.log(this.Enseignant)
                    this.updateEnseignant();
                    Swal.fire({
                        icon: 'success',
                        title: 'Modifications enregistrées',
                        text: 'Les informations personnelles ont été modifiées avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });
                }

            }
            else {

                if (!cinValid || !phoneValid || this.prenom.length === 0 ||
                    this.nom.length === 0 ||
                    this.dateNaissance.length === 0 ||
                    this.cin.length === 0 ||
                    this.telephoneMobile.length === 0 ||
                    this.gouvernoratnom === null ||
                    this.adresse.length === 0 ||
                    this.lienlinkedin.length === 0 ||
                    this.fonctionnalite.length === 0 ||
                    this.Entreprise === null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Veuillez remplir tous les champs obligatoires.'
                    });
                }
                else {
                    this.Personnl.nom = this.nom;
                    this.Personnl.prenom = this.prenom;
                    this.Personnl.phoneNumber = this.telephoneMobile;
                    this.Personnl.cin = this.cin;
                    this.Personnl.photoProfile = this.photoProfile;

                    this.Personnl.photoCouverture = this.user.photoCouverture;
                    if (this.genre == "homme") {
                        this.Personnl.genre = 0;
                    }
                    else {
                        this.Personnl.genre = 1;
                    }
                    this.Personnl.dateNaissance = this.dateNaissance;
                    this.Personnl.lienLinkdIn = this.lienlinkedin;
                    this.Personnl.adresse = this.adresse;
                    this.Personnl.Gouvernorat = this.gouvernoratnom;
                    this.Personnl.fonctionnalite = this.fonctionnalite;



                    if (this.entreprise_id == null) {
                        this.Personnl.entreprise_id = this.entreprise.id;

                    }
                    else {

                        this.Personnl.entreprise_id = this.entreprise_id;
                    }

                    this.updatePersonnel();
                    Swal.fire({
                        icon: 'success',
                        title: 'Modifications enregistrées',
                        text: 'Les informations personnelles ont été modifiées avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });
                }


            }



        },
        updateEnseignant() {

            EnseignantService.update(this.enseignant.id, this.Enseignant).then(() => {
                this.readUserFromLocalStorage();

                this.nom = "";
                this.prenom = "";
                this.phoneNumber = "";
                this.cin = "";
                this.photoProfile = "";
                this.photoCouverture = "";
                this.genre = "";
                this.dateNaissance = "";
                this.lienLinkdIn = "";
                this.adresse = "";
                this.gouvernoratnom = null;
                this.etablissement = "";
                this.departementnom = null;
            })
        },
        updateEtudient() {

            console.log(this.etudiant.id);
            console.log(this.Etudiant);

            EtudiantService.update(this.etudiant.id, this.Etudiant).then(() => {
                //console.log(res);Swal.fire({



                this.readUserFromLocalStorage();
                this.nom = "";
                this.prenom = "";
                this.phoneNumber = "";
                this.cin = "";
                this.photoProfile = "";
                this.photoCouverture = "";
                this.genre = "";
                this.dateNaissance = "";
                this.lienLinkdIn = "";
                this.adresse = "";
                this.gouvernoratnom = null;
                this.etablissement = "";
                this.specialit = null;
                this.classee = null;
                this.departementnom = null;

            })
        },
        updatePersonnel() {

            PersonnelService.update(this.personnel.id, this.Personnl).then(() => {
                this.readUserFromLocalStorage();

                this.nom = "";
                this.prenom = "";
                this.phoneNumber = "";
                this.cin = "";
                this.photoProfile = "";
                this.photoCouverture = "";
                this.genre = "";
                this.dateNaissance = "";
                this.lienLinkdIn = "";
                this.adresse = "";
                this.gouvernoratnom = null;
                this.etablissement = "";
                this.fonctionnalit = "";
            })
        },

        getDepartements() {
            DepartmentService.getAll().then((res) => {
                this.departements = res.data.data;
                //console.log("departemts")
                //console.log(this.departements)

            })
        },
        getClasses() {
            ClasseService.getAll().then((res) => {
                this.classes = res.data.data;
                //console.log("classes")
                //console.log(this.classes)

            })
        },
        getSpecialites() {
            SpecialiteService.getAll().then((res) => {
                this.specialites = res.data.data;
                //console.log("specialites")
                //console.log(this.specialites)
            })
        },
        getEntreprises() {
            EntrepriseService.getEntreprises().then((res) => {
                this.entreprises = res.data.data;
                //console.log("entreprises")
                //console.log(this.entreprises)
            })
        },
        recupererInfoCompte() {
            this.email = this.user.email;

        },
        updateCredentials() {
            if (!this.oldPassword || !this.newPassword || !this.confirmNewPassword || !this.email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs avant de continuer.'
                });
                return;
            }
            this.data.password = this.oldPassword;

            UserService.checkPassword(this.data, this.user.id).then(() => {

                this.Credentials.email = this.email;
                this.Credentials.password = this.newPassword;

                UserService.updateCredentials(this.user.id, this.Credentials).then(() => {

                    this.readUserFromLocalStorage();
                    this.Email = "";
                    this.newPassword = "";
                    this.oldPassword = "";
                    this.confirmNewPassword = "";
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Les informations ont été mises à jour avec succès.!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });
                }).catch(error => {
                    console.error("Erreur lors de la mise à jour :", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur s\'est produite lors de la mise à jour!'
                    });
                });

            }).catch(error => {
                console.error("Erreur lors de la requête:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la vérification du mot de passe.'
                });
            });


        },
        getEntreprise(id) {
            EntrepriseService.getEntreprise(id).then((res) => {
                this.entreprise = res.data.data;
                //console.log(this.entreprise)
            })

        },
        getSpecialite(id) {
            SpecialiteService.getSpecialite(id).then((res) => {
                this.specialite = res.data.data;
                this.getDepartement(this.specialite.departement_id);
                //console.log(this.specialite)
            })

        },
        getDepartement(id) {
            DepartmentService.getDepartement(id).then((res) => {
                this.departement = res.data.data;
                this.selectedDepartment = this.departement.nom;
            })

        },
        getClasse(id) {
            ClasseService.getClasse(id).then((res) => {
                this.classe = res.data.data;
                this.getSpecialite(this.classe.specialite_id);

                //console.log(this.classe)

            })

        },

        getPersonnel(idUser) {
            PersonnelService.getPersonnel(idUser).then((res) => {
                this.personnel = res.data.data;
                //console.log(this.personnel)
                this.getEntreprise(this.personnel.entreprise_id);

            })

        },

        getEnseignant(idUser) {
            EnseignantService.getEnseignant(idUser).then((res) => {
                this.enseignant = res.data.data;
                //console.log(this.enseignant)
                this.getDepartement(this.enseignant.departement_id);

            })

        },
        getEtudient(idUser) {
            EtudiantService.getEtudiant(idUser).then((res) => {
                this.etudiant = res.data.data;
                this.getClasse(this.etudiant.classe_id);


            })

        },
        getcv(iduser) {

            CVsService.getCV(iduser).then((res) => {
                this.cv = res.data.data;
                this.afficherExperiences(this.cv.id);
                this.afficherFormationsAcd(this.cv.id);
                this.afficherFormationsExternes(this.cv.id);
                this.afficherCertificatsExternes(this.cv.id);
                this.afficherLangues(this.cv.id);
                this.afficherCompetences(this.cv.id);

            })

        },


        getProfil() {
            console.log("id profil")
            console.log(this.user.nbEtoiles);
            if (this.user.user_type == "Etudiant") {
                this.getEtudient(this.user.id);
                this.getClasses();
                this.getDepartements();
                this.getSpecialites();
            }
            else if (this.user.user_type == "Enseignant") {
                this.getEnseignant(this.user.id);
                this.getDepartements();
            }
            else {
                this.getPersonnel(this.user.id);
                this.getEntreprises();

            }
            this.getcv(this.user.id);


        },
        Annuler() {
            this.etablissement = "";
            this.diplome = "";
            this.domaineEtude = "";
            this.datedebut = "";
            this.dateFin = "";
            this.description = "";
            this.Poste = "";
            this.nomEntreprise = "";
            this.lieu = "";
            this.categorie = "";
            this.date = "";
            this.organisation = "";
            this.titre = "";
            this.certificatimg = null;
            this.nom = "";
            this.niveau = "";
            this.Email = "";
            this.fonctionnalite = "";
            this.newPassword = "";
            this.oldPassword = "";
            this.confirmNewPassword = "";

        },


        AddFormationAcd() {
            // Vérification si tous les champs sont remplis
            if (!this.etablissement || !this.diplome || !this.domaineEtude || !this.datedebut || !this.dateFin || !this.description) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, ajouter la formation académique
                this.formationAcd.etablissement = this.etablissement;
                this.formationAcd.diplome = this.diplome;
                this.formationAcd.domaineEtude = this.domaineEtude;
                this.formationAcd.dateDebut = this.datedebut;
                this.formationAcd.dateFin = this.dateFin;
                this.formationAcd.description = this.description;
                this.formationAcd.cv_id = this.cv.id;

                FormationAcdService.addFormationAcd(this.formationAcd).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La formation académique a été ajoutée avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });


                    // Réinitialisation des champs après l'ajout
                    this.etablissement = "";
                    this.diplome = "";
                    this.domaineEtude = "";
                    this.datedebut = "";
                    this.dateFin = "";
                    this.description = "";

                    // Actualisation de l'affichage des formations académiques
                    this.afficherFormationsAcd(this.cv.id);
                }).catch((error) => {
                    // En cas d'erreur lors de l'ajout
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de l\'ajout de la formation académique. Veuillez réessayer.'
                    });
                });
            }
        },
        AddFormationExterne() {
            // Vérification si tous les champs sont remplis
            if (!this.titre || !this.description || !this.categorie || !this.date || !this.organisation) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, ajouter la formation externe
                this.formationExterne.titre = this.titre;
                this.formationExterne.description = this.description;
                this.formationExterne.categorie = this.categorie;
                this.formationExterne.date = this.date;
                this.formationExterne.organisation = this.organisation;
                this.formationExterne.cv_id = this.cv.id;

                FormationService.addFormation(this.formationExterne).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La formation externe a été ajoutée avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après l'ajout
                    this.titre = "";
                    this.description = "";
                    this.categorie = "";
                    this.date = "";
                    this.organisation = "";

                    // Actualisation de l'affichage des formations externes
                    this.afficherFormationsExternes(this.cv.id);
                });
            }
        },

        AddLangue() {
            // Vérification si tous les champs sont remplis
            if (!this.nom || !this.niveau) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, ajouter la langue
                this.langue.nom = this.nom;
                this.langue.niveau = this.niveau;
                this.langue.cv_id = this.cv.id;

                LangueService.addLangue(this.langue).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La langue a été ajoutée avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après l'ajout
                    this.nom = "";
                    this.niveau = "";

                    // Actualisation de l'affichage des langues
                    this.afficherLangues(this.cv.id);
                });
            }
        },
        AddCompetence() {
            // Vérification si tous les champs sont remplis
            if (!this.nom || !this.niveau || !this.cv.id) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, ajouter la compétence
                this.competence.nom = this.nom;
                this.competence.niveau = this.niveau;
                this.competence.cv_id = this.cv.id;

                CompetenceService.addCompetence(this.competence).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La compétence a été ajoutée avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après l'ajout
                    this.nom = "";
                    this.niveau = "";

                    // Actualisation de l'affichage des compétences
                    this.afficherCompetences(this.cv.id);
                });
            }
        },

        afficherFormationsAcd(id) {
            FormationAcdService.getAllFormationsAcd(id).then((res) => {
                this.FormationAcadémique = res.data.data;
                console.log("LangFormationAcadémiqueues");
                console.log(this.FormationAcadémique);
            })
        },
        afficherLangues(id) {
            LangueService.getAllLangues(id).then((res) => {
                this.Langues = res.data.data;

                console.log("Langues");
                console.log(this.Langues);
            })
        },
        afficherFormationsExternes(id) {
            FormationService.getAllformationExternes(id).then((res) => {
                this.Formations = res.data.data;
                console.log("Formations");
                console.log(this.Formations);


            })
        },
        afficherCertificatsExternes(id) {
            CertificatService.GetCertificatsExternes(id).then((res) => {
                this.Certifications = res.data.data;
                //console.log("Certifications");
                //console.log(this.Certifications);

            })
        },
        afficherCompetences(id) {
            CompetenceService.getAllCompetences(id).then((res) => {
                this.Compétences = res.data.data;
                //.log("Compétences");
                //console.log(this.Compétences);

            })
        },
        UpdateFormationAcd() {
            // Vérification si tous les champs sont remplis
            if (!this.etablissement || !this.diplome || !this.domaineEtude || !this.datedebut || !this.dateFin || !this.description) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, mettre à jour la formation académique
                this.formationAcd.etablissement = this.etablissement;
                this.formationAcd.diplome = this.diplome;
                this.formationAcd.domaineEtude = this.domaineEtude;
                this.formationAcd.dateDebut = this.datedebut;
                this.formationAcd.dateFin = this.dateFin;
                this.formationAcd.description = this.description;
                this.formationAcd.cv_id = this.cv.id;

                FormationAcdService.updateFormationAcd(this.id, this.formationAcd).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La formation académique a été mise à jour avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });


                    // Réinitialisation des champs après la mise à jour
                    this.etablissement = "";
                    this.diplome = "";
                    this.domaineEtude = "";
                    this.datedebut = "";
                    this.dateFin = "";
                    this.description = "";

                    // Actualisation de l'affichage des formations académiques
                    this.afficherFormationsAcd(this.cv.id);
                }).catch((error) => {
                    // En cas d'erreur lors de la mise à jour
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la mise à jour de la formation académique. Veuillez réessayer.'
                    });
                });
            }
        },
        UpdateLangue() {
            // Vérification si tous les champs sont remplis
            if (!this.nom || !this.niveau) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, mettre à jour la langue
                this.langue.nom = this.nom;
                this.langue.niveau = this.niveau;
                this.langue.cv_id = this.cv.id;

                LangueService.updateLangue(this.id, this.langue).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La langue a été mise à jour avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après la mise à jour
                    this.nom = "";
                    this.niveau = "";

                    // Actualisation de l'affichage des langues
                    this.afficherLangues(this.cv.id);
                }).catch((error) => {
                    // En cas d'erreur lors de la mise à jour
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la mise à jour de la langue. Veuillez réessayer.'
                    });
                });
            }
        },
        updateCompetence() {
            // Vérification si tous les champs sont remplis
            if (!this.nom || !this.niveau) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, mettre à jour la compétence
                this.competence.nom = this.nom;
                this.competence.niveau = this.niveau;
                this.competence.cv_id = this.cv.id;

                CompetenceService.updateCompetence(this.id, this.competence).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La compétence a été mise à jour avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après la mise à jour
                    this.nom = "";
                    this.niveau = "";

                    // Actualisation de l'affichage des compétences
                    this.afficherCompetences(this.cv.id);
                }).catch((error) => {
                    // En cas d'erreur lors de la mise à jour
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la mise à jour de la compétence. Veuillez réessayer.'
                    });
                });
            }
        },

        UpdateFormationExterne() {
            // Vérification si tous les champs sont remplis
            if (!this.titre || !this.description || !this.categorie || !this.date || !this.organisation) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });

            } else {
                // Si tous les champs sont remplis, mettre à jour la formation externe
                this.formationExterne.titre = this.titre;
                this.formationExterne.description = this.description;
                this.formationExterne.categorie = this.categorie;
                this.formationExterne.date = this.date;
                this.formationExterne.organisation = this.organisation;
                this.formationExterne.cv_id = this.cv.id;

                FormationService.updateFormation(this.id, this.formationExterne).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'La formation externe a été mise à jour avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après la mise à jour
                    this.titre = "";
                    this.description = "";
                    this.categorie = "";
                    this.date = "";
                    this.organisation = "";

                    // Actualisation de l'affichage des formations externes
                    this.afficherFormationsExternes(this.cv.id);
                }).catch((error) => {
                    // En cas d'erreur lors de la mise à jour
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la mise à jour de la formation externe. Veuillez réessayer.'
                    });
                });
            }
        },

        UpdateCertificat() {
            // Vérification si tous les champs sont remplis
            if (!this.titre || !this.categorie || !this.date || !this.organisation || !this.description) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, mettre à jour le certificat
                this.certificateAajouter.titre = this.titre;
                this.certificateAajouter.categorie = this.categorie;
                this.certificateAajouter.date = this.date;
                this.certificateAajouter.organisation = this.organisation;
                this.certificateAajouter.certificat = this.certificat;
                this.certificateAajouter.description = this.description;
                this.certificateAajouter.cv_id = this.cv.id;

                CertificatService.updateCertificat(this.id, this.certificateAajouter).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Le certificat a été mis à jour avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après la mise à jour
                    this.titre = "";
                    this.categorie = "";
                    this.date = "";
                    this.organisation = "";
                    this.certificat = "";
                    this.description = "";

                    // Actualisation de l'affichage des certificats externes
                    this.afficherCertificatsExternes(this.cv.id);
                }).catch((error) => {
                    // En cas d'erreur lors de la mise à jour
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la mise à jour du certificat. Veuillez réessayer.'
                    });
                });
            }
        },



        recupererDonnes(index, type) {
            if (type == "expérience") {
                this.id = this.Expériences[index].id;
                this.Poste = this.Expériences[index].poste;
                this.nomEntreprise = this.Expériences[index].entreprise;
                this.lieu = this.Expériences[index].lieu;
                this.datedebut = this.Expériences[index].dateDebut;
                this.dateFin = this.Expériences[index].dateFin;
                this.description = this.Expériences[index].description;

            }
            if (type == "FormationAcadémique") {

                this.id = this.FormationAcadémique[index].id;
                this.etablissement = this.FormationAcadémique[index].etablissement;
                this.diplome = this.FormationAcadémique[index].diplome;
                this.domaineEtude = this.FormationAcadémique[index].domaineEtude;
                this.datedebut = this.FormationAcadémique[index].dateDebut;
                this.dateFin = this.FormationAcadémique[index].dateFin;
                this.description = this.FormationAcadémique[index].description;
            }
            if (type == "Formation") {
                this.id = this.Formations[index].id;
                this.titre = this.Formations[index].titre;
                this.description = this.Formations[index].description;
                this.categorie = this.Formations[index].categorie;
                this.date = this.Formations[index].date;
                this.organisation = this.Formations[index].organisation;
            }
            if (type == "Certification") {
                this.id = this.Certifications[index].id;
                this.titre = this.Certifications[index].titre;
                this.description = this.Certifications[index].description;
                this.categorie = this.Certifications[index].categorie;
                this.date = this.Certifications[index].date;
                this.organisation = this.Certifications[index].organisation;
                this.certificatimg = this.Certifications[index].certificat;
            }
            if (type == "Langues") {
                this.id = this.Langues[index].id;
                this.nom = this.Langues[index].nom;
                this.niveau = this.Langues[index].niveau;
            }
            if (type == "Compétence") {
                this.id = this.Compétences[index].id;
                this.nom = this.Compétences[index].nom;
                this.niveau = this.Compétences[index].niveau;
            }


        },
        AddExperience() {
            // Vérification si tous les champs sont remplis
            if (!this.Poste || !this.nomEntreprise || !this.lieu || !this.datedebut || !this.dateFin || !this.description) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, ajouter l'expérience
                this.experienceAajouter.poste = this.Poste;
                this.experienceAajouter.entreprise = this.nomEntreprise;
                this.experienceAajouter.lieu = this.lieu;
                this.experienceAajouter.dateDebut = this.datedebut;
                this.experienceAajouter.dateFin = this.dateFin;
                this.experienceAajouter.description = this.description;
                this.experienceAajouter.cv_id = this.cv.id;

                ExperienceService.addExperience(this.experienceAajouter).then(() => {
                    // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'L\'expérience a été ajoutée avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });

                    // Réinitialisation des champs après l'ajout
                    this.Poste = "";
                    this.nomEntreprise = "";
                    this.lieu = "";
                    this.datedebut = "";
                    this.dateFin = "";
                    this.description = "";

                    // Actualisation de l'affichage des expériences
                    this.afficherExperiences(this.cv.id);
                });
            }
        },

        AddCertificat() {
            // Vérification si tous les champs sont remplis
            if (!this.titre || !this.categorie || !this.date || !this.organisation || !this.description) {
                // Affichage de l'alerte SweetAlert pour signaler l'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs!'
                });
            } else {
                // Si tous les champs sont remplis, ajouter le certificat
                this.certificateAajouter.titre = this.titre;
                this.certificateAajouter.categorie = this.categorie;
                this.certificateAajouter.date = this.date;
                this.certificateAajouter.organisation = this.organisation;
                this.certificateAajouter.description = this.description;
                this.certificateAajouter.cv_id = this.cv.id;

                // Gérer l'ajout de l'image
                const imageFiles = document.getElementById("certificatimg").files;
                if (imageFiles.length > 0) {
                    const reader = new FileReader();
                    const file = imageFiles[0]; // Sélectionner le premier fichier de la liste
                    reader.readAsDataURL(file);

                    reader.onload = (e) => {
                        const imageSrc = e.target.result;
                        this.certificateAajouter.certificat = imageSrc;

                        // Ajouter le certificat avec l'image
                        CertificatService.addCertificat(this.certificateAajouter).then(() => {
                            // Mise à jour réussie, affichage de l'alerte SweetAlert pour signaler le succès
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès',
                                text: 'Le certificat a été ajouté avec succès!',
                                timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                                timerProgressBar: true, // Affiche une barre de progression
                                showConfirmButton: false // Cache le bouton "OK"
                            });

                            // Réinitialisation des champs après l'ajout
                            this.titre = "";
                            this.categorie = "";
                            this.date = "";
                            this.organisation = "";
                            this.certificat = "";
                            this.description = "";

                            // Actualisation de l'affichage des certificats
                            this.afficherCertificatsExternes(this.cv.id);
                        }).catch((error) => {
                            console.error(error);
                        });
                    };
                }
            }
        },
        UpdateExperience() {
            if (!this.Poste || !this.nomEntreprise || !this.lieu || !this.datedebut || !this.dateFin || !this.description) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs avant de continuer.'
                });
                return;
            }

            this.experienceAajouter.poste = this.Poste;
            this.experienceAajouter.entreprise = this.nomEntreprise;
            this.experienceAajouter.lieu = this.lieu;
            this.experienceAajouter.dateDebut = this.datedebut;
            this.experienceAajouter.dateFin = this.dateFin;
            this.experienceAajouter.description = this.description;
            this.experienceAajouter.cv_id = this.cv.id;


            ExperienceService.updateExperience(this.id, this.experienceAajouter)
                .then(() => {
                    this.afficherExperiences(this.cv.id); // Rafraîchir les expériences affichées
                    this.Poste = "";
                    this.nomEntreprise = "";
                    this.lieu = "";
                    this.datedebut = "";
                    this.dateFin = "";
                    this.description = "";

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'L\'expérience a été mise à jour avec succès!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });
                })
                .catch(error => {
                    console.error("Erreur lors de la mise à jour de l'expérience :", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur s\'est produite lors de la mise à jour de l\'expérience.'
                    });
                });
        },


        afficherdetails(index, type) {
            if (type == 'expérience') {
                this.experienceDetaills = this.Expériences[index];

            }
            else if (type == 'FormationAcadémique') {
                this.formationAcdDetaills = this.FormationAcadémique[index];

            }
            else if (type == 'Formation') {
                this.formationDetaills = this.Formations[index];
            }
            else if (type == "Certification") {
                this.certificatDetaills = this.Certifications[index];
            }
            else if (type == "Langues") {
                this.langueDetaills = this.Langues[index];
            }
            else if (type == "Compétence") {
                this.competenceDetaills = this.Compétences[index];
            }


        },
        afficherExperiences(id) {
            ExperienceService.getAllExperiences(id).then((res) => {
                this.Expériences = res.data.data;
            })

        },
        readUserFromLocalStorage() {
            const userJson = localStorage.getItem('user');
            if (userJson) {
                this.user = JSON.parse(userJson);
                this.codeQr();
            }
        },
        codeQr() {
            const svgString = this.user.code_qr;
            this.$nextTick(() => {
                const qrElement = this.$refs.qrCode;
                if (qrElement) {
                    qrElement.innerHTML = svgString;
                } else {
                    console.error('QR code element not found');
                }
            });
        },
        getUsers() {
            UserService.getAll().then(response => {
                this.users = response.data.data;
                this.codeQr();
            })
        },
        getUser(id) {
            //console.log("user_id");
            //console.log(this.user.id);
            UserService.getUser(id).then(response => {
                //console.log("response");
               // console.log(response);
                this.user = response.data.data;
            
            })
        },

        confirmDelete(index, type) {
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
                    if (type == "expérience") {
                        ExperienceService.deleteExperience(this.Expériences[index].id).then(() => {
                            this.afficherExperiences(this.cv.id);

                        })
                    }
                    if (type == "FormationAcadémique") {
                        FormationAcdService.deleteFormationAcd(this.FormationAcadémique[index].id).then(() => {
                            this.afficherFormationsAcd(this.cv.id)


                        })
                    }
                    if (type == "Formation") {
                        FormationService.deleteFormation(this.Formations[index].id).then(() => {
                            this.afficherFormationsExternes(this.cv.id)
                        })
                    }
                    if (type == "Certification") {
                        CertificatService.deleteCertificat(this.Certifications[index].id).then(() => {
                            this.afficherCertificatsExternes(this.cv.id)
                        })

                    }
                    if (type == "Langues") {
                        LangueService.deleteLangue(this.Langues[index].id).then(() => {
                            this.afficherLangues(this.cv.id)
                        })

                    }
                    if (type == "Compétence") {
                        CompetenceService.deleteCompetence(this.Compétences[index].id).then(() => {
                            this.afficherCompetences(this.cv.id)
                        })

                    }

                }
            })
        },
        changerView(data) {
            console.log(this.personnel.fonctionnalite)
            this.view = data;
        },

        openModalForEdit() {
            // Modifier le modal pour l'édition
            this.actionButtonLabel = 'Modifier';
        },
        openModalForAdd() {
            // Modifier le modal pour l'ajout
            this.actionButtonLabel = 'Ajouter';
        },
        openModal(isEditing, modal, title) {
            this.isEditing = isEditing;
            this.modalTarget = modal;
            this.modalTitle = title;



            if (this.isEditing) {
                this.openModalForEdit();
            }
            else {
                this.openModalForAdd();
            }
        },
        openFullScreenImage(imagePath) {
            window.open(imagePath, '_blank');
        },
        getImageSource() {
            if (this.user.photoProfile) {

                if (this.user.photoProfile.startsWith('http')) {

                    return this.user.photoProfile;
                } else {
                    return require(`@/assets/PhotosProfils/${this.user.photoProfile}`);
                }
            } else {
                return require(`@/assets/noimage.png`);
            }
        },
        getPhotoCouverture() {
            if (this.user.photoCouverture) {

                if (this.user.photoCouverture.startsWith('http')) {

                    return this.user.photoCouverture;
                } else {
                    return require(`@/assets/PhotosCouvertures/${this.user.photoCouverture}`);
                }
            } else {
                return require(`@/assets/no_photoCouverture.webp`);
            }
        },
        downloadQRCode() {
            const svgString = this.user.code_qr;
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
        handleFileUpload(event) {
            const file = event.target.files[0];
            //this.user.photoProfile=URL.createObjectURL(file);
            const formData = new FormData();
            formData.append('photo_profile', file);
            Axios.post(`users/upload-profil-image/${this.user.id}`, formData).then(() => {
            //console.log("PhotoProfileUpdated")
            });
           // this.getUser(this.user.id) ;
        },
      
        changerPhotoCouverture(event) {
      const file = event.target.files[0];
      const formData = new FormData();
      formData.append('photo_couverture', file);

      Axios.post(`users/upload-couverture-image/${this.user.id}`, formData).then((response) => {

        // Supposez que le serveur renvoie l'URL de la nouvelle photo de couverture
        console.log("photoCouverture")
        console.log(response.data.photoCouverture)
        //this.user.photoCouverture = response.data.photoCouverture;
        //this.photoCouverture = this.getPhotoCouverture();
        this.photoCouverture=require(`@/assets/PhotosCouvertures/${response.data.photoCouverture}`)

      }).catch((error) => {
        console.error("Erreur lors du téléchargement de la photo de couverture :", error);
      });
    },
        generateCV() {
            const personalInfo = {
                firstName: "Bouthaina",
                lastName: "Belghith",
                city: "Bizerte",
            };
            const cvContent = `
                <h6>Curriculum Vitae</h6>
                <p>Informations personnelles</p>
                <p>Prénom: ${personalInfo.firstName}</p>
                <p>Nom: ${personalInfo.lastName}</p>
                <p>Ville: ${personalInfo.city}</p>
                <!-- Ajoutez d'autres sections du CV ici -->

                <!-- Exemple: -->
                <p>Expérience professionnelle</p>
                <p>Expérience professionnelle à remplir ici...</p>
            `;
            this.convertToPDF(cvContent);
        },
        convertToPDF(htmlContent) {
            const pdf = new jsPDF();
            pdf.html(htmlContent, {
                callback: () => {
                    pdf.save("mon_cv.pdf");
                },
            });
        },
    }
}
</script>


<style scoped>
.bi-exclamation-circle {
    color: red;
}

.is-invalid {
    border: 1px solid rgba(255, 0, 0, 0.99);
    background-color: #fae8ea;
    color: rgb(125, 124, 124);
}

.error-message {
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #ff0000;
}

/*css etoiles*/

.rating {
    display: flex;
    margin-top: -35px;
    flex-direction: row-reverse;
    justify-content: center;
}

.rating input {
    display: none;
}

.rating label {
    position: relative;
    width: 1em;
    font-size: 30px;
    font-weight: 300;
    top: 12px;
    cursor: pointer;
}

.rating label:after {
    content: '☆';
    color: #8e8d8d;
    transition: all 0.4s ease-out;
    -webkit-font-smoothing: antialiased;
}

.rating label:hover:after {
    color: #989797;
    text-shadow: 0 0 15px #666;
}

.rating label.filled:after {
    content: '★';
    color: #F9BF3B;
    text-shadow: 0 0 20px #F9BF3B;
}


/*end style etoiles*/
.icon {
    margin-right: 20px;
}

.imgCertif {
    width: 400px;
    height: 300px;
    margin-left: 100px;
}

/*  Start Style Modal */
.modal-body label {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

#description {
    height: 150px;
}

.modal-body input[type="text"],
.modal-body select,
.modal-body input[type="date"],
.modal-body input[type="tel"],
.modal-body input[type="password"],
.modal-body input[type="number"],
.modal-body input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.modal-body {
    padding: 20px 100px;
}

.form-column1 {
    float: left;
    width: 50%;
    margin-left: -70px;
}

.form-column2 {
    float: left;
    width: 50%;
    margin-left: 70px;
}

/* End  Style Modal */




.container-fluid {
    position: relative;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    background-color: var(--section-color);
}

.cover-container {
    position: relative;
    height: 100%;

}

.cover-image {
    width: 100%;
    height: 300px;
    border-radius: 10px;
}

.profile-image {
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    width: 13%;
    height: 67%;
    border: #ffffff solid 3px;
    padding-bottom: 0;
    margin-bottom: 0;
}

#cam {
    position: absolute;
    color: white;
    width: 2%;
    left: 49%;
    top: 108%;
    cursor: pointer;
    background-color: #ffffff;
    border-radius: 50%;
    padding: 2px;
}

#camImage {
    position: absolute;
    color: white;
    width: 2%;
    left: 97%;
    top: 80%;
    cursor: pointer;
    background-color: #dedddd;
    border-radius: 50%;
    padding: 2px;
}

.nom {
    margin-top: 4%;
    text-align: center;
}

.nom h5 {
    font-size: 140%;
    font-weight: bold;
    font-family: Calibri;
}

.nom a {
    color: #178FEB;
    text-decoration: none;
    font-family: Calibri;
    font-weight: bold;
    font-size: 110%;
}

.nom p {
    font-size: 90%;
    font-family: Calibri;
}

.pro section {
    background-color: #ffffff;
    border-radius: 10px;
    flex: 1;
}

.pro {
    margin-top: 1%;
    display: flex;
    justify-content: space-around;
    flex-direction: row-reverse;
    gap: 1%;
    width: 100%;
    text-align: center;
    background-color: transparent;
    margin-bottom: 1%;
}

#cv {
    max-width: 60% !important;
    display: flex;
    flex-direction: column;
    background-color: var(--section-color);
}

#information {
    padding: 1%;
    max-width: 40% !important;
    height: auto !important;
    padding-top: 2% !important;
    background-color: var(--section-color);
}

.pdf {
    border: none;
    cursor: pointer;
}

.pdf button {
    border: none;
    outline: none;
    color: black;
    transition: all .3s ease-in-out;
    background-color: transparent;
    float: inline-end;
    margin-right: 3%;
    margin-top: 2%;
}

.pdf button img {
    width: 45% !important;
    padding-top: 30%;
    padding-bottom: 30%;
}

#upload {
    background-image: url("@/assets/orange.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

#load {
    background-image: url("@/assets/bleu.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.card {
    padding: 20px;
    width: auto;
    border: none;
    background-color: var(--section-color);
}

.card li {
    list-style: none;
    text-align: left;
    cursor: pointer;
    color: var(--text-section);
}

.champ {
    font-weight: bold;
    position: relative;
    text-align: left;
    font-size: 120%;
    padding-left: 4%;
}

.champ::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 30%;
    transform: translateX(-29%);
    width: 90%;
    border-bottom: #111111 solid 3px;
    border-color: var(--text-section);
}

.add {
    width: 4% !important;
    float: right;
    margin-right: 10px;
    padding-bottom: 10px;
}

.content {
    margin-top: 2% !important;
}

.content img {
    width: 25% !important;
    height: auto !important;
}

.content button {
    background-color: transparent;
    border: none;
}

.content div {
    width: 20%;
    display: inline-block;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.content li {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-bottom: #dfdfdf solid 1px;
}

.personnel {
    display: flex;
    flex-direction: row;
    width: 98% !important;
}

.personnel h6 {
    color: #178FEB;
    font-weight: bold;
    font-size: 100%;
}

.personnel img {
    width: 60% !important;
    height: auto !important;
    margin-left: 3%;
    background-color: #dfdfdf;
    border-radius: 50%;
    padding: 5px;
    margin-top: -10px;
}

.personnel button {
    background-color: transparent;
    border: none;
    widows: 100% !important;
}

.info li {
    list-style: none;
    float: left;
    text-align: left;
    padding-right: 4%;
    font-size: .9em;
    margin-bottom: 30px;
    white-space: pre-wrap;

}

.info li strong {
    font-weight: bold;
    margin-right: 5px;
}

.info {
    display: flex;
    flex-direction: row;
    margin-top: 4%;
    gap: 1%;
    background-color: var(--section-color);
}

.compte {
    display: flex;
    flex-direction: column;
}

.mail {
    display: flex;
    flex-direction: column;
    white-space: normal;
}

.qr {
    display: flex;
    flex-direction: column;
    width: 40%;
    margin-top: 2%;
    align-items: center;
    margin-left: 30%;
}

.qr svg {
    margin-left: 90%;
}

.qr button {
    text-decoration: none;
    background-color: transparent;
    border: none;
    margin-top: 5%;
    color: #178FEB;
    font-weight: bold;
}

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
    color: #178FEB;
    padding-top: 2%;
    padding-right: 1%;
    font-family: Impact;
}

.cadres {
    display: flex;
    flex-direction: row;
    gap: 1%;
    justify-content: center;
}

.cadres h2 {
    font-size: 150%;
    color: #178FEB;
    font-family: Impact;
    text-align: center;
    padding: 5%;
}

.cadres div {
    background-color: #E2F1F8;
    height: 400px !important;
    width: 23% !important;
    margin-bottom: 5% !important;
    border-radius: 10%;
}

.pass {
    border-radius: 2%;
    margin-right: 1%;
    margin-left: 1%;
    width: auto;
    background-color: var(--section-color);
}

.cover-container button {
    border: none;
}

#form div {
    display: flex;
    flex-direction: row;
}

@media screen and (max-width: 1100px) {
    .add {
        width: 5% !important;
        margin-right: 0px;
    }

    #camImage {

        left: 97%;
        top: 85%;
    }

    #cam {

        width: 3%;
        left: 49%;
        top: 104%;

    }

    .profile-image {
        top: 80%;
        left: 50%;
        width: 17%;
        height: 60%;

    }

    .content img {
        width: 30% !important;
        height: auto !important;
        margin-right: -5px;
        float: right;
    }

    .champ {
        font-size: 100% !important;
    }

    .content {
        font-size: 80%;
    }

    .personnel img {
        width: 60% !important;
    }

    .personnel h6 {
        font-size: 85% !important;
    }

    .cadres {
        gap: 2%;
    }
}

@media screen and (max-width: 800px) {
    .profile-image {
        top: 80% !important;
        width: 23% !important;
        height: 55% !important;
    }

    #camImage {
        width: 2%;
        left: 97%;
        top: 85%;
    }

    .personnel img {
        width: 47% !important;
    }

    .personnel h6 {
        font-size: 72% !important;
    }

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

@media screen and (max-width: 700px) {
    .pro {
        flex-direction: column;
    }

    .pro section {
        flex: none;
    }

    #cv {
        min-width: 100% !important;
        margin: 0;
    }

    #information {
        min-width: 100% !important;
        margin-bottom: 1%;
    }

    .add {
        width: 4% !important;
        margin-right: 0px;
    }

    .content img {
        width: 30% !important;
        height: auto !important;
        margin-right: -5px;
        float: right;
    }

    .champ {
        font-size: 90% !important;
    }

    .content {
        font-size: 80%;
    }

    .personnel img {
        width: 50% !important;
    }

    .personnel {
        margin-left: 3% !important;
    }

}

@media screen and (max-width: 480px) {
    .cover-container {
        padding-top: 60px;
    }

    .profile-image {
        left: 17% !important;
        top: 90% !important;
        width: 30% !important;
        height: 35% !important;
    }

    #camImage {
        width: 5%;
        left: 96%;
        top: 81%;
    }

    .cover-image {
        height: 276px;
        width: 1920px;
    }

    .nom {
        margin-top: -10%;
        text-align: left;
        padding-left: 35% !important;
    }

    .nom h5 {
        font-size: 110%;
    }

    .nom p {
        font-size: 75%;
    }

    .rating {
        margin-top: -20px;
        margin-bottom: 5px;
        justify-content: left;
    }

    .rating label {
        width: 1em;
        font-size: 20px;
        font-weight: 100;
        top: 10px;
    }

    #cam {
        width: 5%;
        left: 5%;
        top: 101%;
        cursor: pointer;
        border-radius: 50%;
        padding: 2px;
    }



    .card {
        padding-left: 0;
    }

    .add {
        width: 6% !important;
        margin-right: 0px;
    }

    .content img {
        width: 50% !important;
        height: auto !important;
        margin-right: -5px;
        float: right;
    }

    .champ {
        font-size: 100% !important;
    }

    .content {
        font-size: 90%;
    }

    .personnel img {
        width: 50% !important;
        margin-top: 1px !important;
    }

    .personnel h6 {
        margin-top: 9px;
        font-size: 85% !important;
    }

    /*style modal consult langue*/
    .info2 {
        justify-content: center;
        /* Centrer le contenu horizontalement */
        list-style-type: none;
        /* Supprimer les puces de liste */
        padding: 0;
        /* Supprimer les marges internes */
        display: inline;
        /* Afficher les éléments <li> sur la même ligne */
        margin-right: 10px;
        list-style: none;

    }



    .info2 li {
        list-style: none;
        text-align: center;
        width: auto;
        /* Laisser la largeur s'adapter au contenu */
        /*white-space: nowrap;  Empêcher le saut de ligne dans les éléments li */
    }


}
</style>