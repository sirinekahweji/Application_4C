import { createRouter, createWebHistory } from "vue-router";
import PageGarde from "../views/PageGarde.vue";
import Accueil from "../views/Accueil.vue";
import SignUp from "../views/SignUp.vue";
import Statistiques from "@/views/Dashboard/statistiques.vue";
import Profile from "../views/Profile.vue";
import SignIn from "../views/SignInMobile.vue";
import discussion1 from "../views/discussion1.vue";
import Formations from "@/views/participation/Formations.vue";
import Certificats from "@/views/participation/Certificats.vue";
import Evenements from "@/views/participation/Evenements.vue";
import DetailCertificat from "@/views/participation/details/DetailCertificat.vue";
import DetailCertificatAdmin from "@/views/participation/details/DetailCertificatAdmin.vue";
import DetailAttestationAdmin from "@/views/participation/details/DetailAttestationAdmin.vue";
import DetailBadgeAdmin from "@/views/participation/details/DetailBadgeAdmin.vue";
import DetailEvenement from "@/views/participation/details/DetailEvenement.vue";
import DetailEvenementAdmin from "@/views/participation/details/DetailEvenementAdmin.vue";
import DetailFormation from "@/views/participation/details/DetailFormation.vue";
import DetailFormationAdmin from "@/views/participation/details/DetailFormationAdmin.vue";
import ListeEtudiants from "@/views/entreprise/ListeEtudiant.vue";
import JardinBadges from "@/views/JardinBadges.vue";
import CheckAuth from '@/middleware/CheckAuth'
import acces from '@/views/Dashboard/acces.vue'
import profils from '@/views/Dashboard/profils.vue'
import roles from '@/views/Dashboard/roles.vue'
import attestations from '@/views/Dashboard/attestations'
import Detailsbadges from '@/views/participation/details/DetailBadgesAdmin.vue'
import badges from '@/views/Dashboard/badges'
import EvenementsAdmin from '@/views/Dashboard/evenements'
import CertificatsAdmin from '@/views/Dashboard/certificats'
import FormationsAdmin from '@/views/Dashboard/formations'
import departements from '@/views/Dashboard/departements'
import entreprises from '@/views/Dashboard/entreprises'
import historique from '@/views/Dashboard/historique'
import historiqueEntreprises from '@/views/Dashboard/historiqueEntreprises'
import profilExterne from '@/views/Dashboard/profilExterne'
import EmailInput from "@/views/EmailInput"
import resetPassword from "@/views/ResetPassword"


const routes = [
  {
    path: "/",
    name: "PageGarde",
    component: PageGarde,
  },
  {
    path: "/Accueil",
    name: "Accueil",
    component: Accueil,
    beforeEnter: CheckAuth,
  },
  {
    path: "/SignUp",
    name: "Sign_Up",
    component: SignUp,
  },
  {
    path: "/Dashboard",
    name: "Statistiques",
    component: Statistiques,
    beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/Acces",
    name: "acces",
    component: acces,
    beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/profiles",
    name: "profils",
    component: profils,
    beforeEnter: CheckAuth,
  },
  {
    path: "/profil/:id",
    name: "profilExterne",
    component: profilExterne,
    beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/roles",
    name: "roles",
    component: roles,
    beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/badges",
    name: "badges",
    component: badges,
    beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/badges/DetailsBadges",
    name: "Detailsbadges",
    component: Detailsbadges,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/attestations",
    name: "attestations",
    component: attestations,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/evenements",
    name: "EvenementsAdmin",
    component: EvenementsAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/certificats",
    name: "CertificatsAdmin",
    component: CertificatsAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/formations",
    name: "FormationsAdmin",
    component: FormationsAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/departements",
    name: "departements",
    component: departements,
   // beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/entreprises",
    name: "entreprises",
    component: entreprises,
   // beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/profils/historique",
    name: "historique",
    component: historique,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Dashboard/entreprises/historique",
    name: "historiqueEntreprises",
    component: historiqueEntreprises,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Profile",
    name: "Profile",
    component: Profile,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/SignIn",
    name: "SignIn",
    component: SignIn,
  },
  {
    path: "/MotDePasseOubliee",
    name: "EmailInput",
    component: EmailInput,
  },
  {
    path: "/resetPassword",
    name: "resetPassword",
    component: resetPassword,
  },
  {
    path: "/discussion",
    name: "discussion",
    component: discussion1,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/discussion1",
    name: "discussion1",
    component: discussion1,
    //beforeEnter: CheckAuth,//
  },
  {
    path: "/Formations",
    name: "Formations",
    component: Formations,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Certificats",
    name: "Certificats",
    component: Certificats,
    //beforeEnter: CheckAuth,
  },
  {
    path: "/Evenements",
    name: "Evenements",
    component: Evenements,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Formation/Detail/:id',
    name: "DetailFormation",
    component: DetailFormation,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Evenement/Detail/:id',
    name: "DetailEvenement",
    component: DetailEvenement,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Dashboard/Evenement/Detail/:id',
    name: "DetailEvenementAdmin",
    component: DetailEvenementAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Certificat/Detail/:id',
    name: "DetailCertificat",
    component: DetailCertificat,
    ///beforeEnter: CheckAuth,
  },
  {
    path: '/Dashboard/Certificat/Detail/:id',
    name: "DetailCertificatAdmin",
    component: DetailCertificatAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Dashboard/Attestation/Detail/:id',
    name: "DetailAttestationAdmin",
    component: DetailAttestationAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Dashboard/Badge/Detail/:id',
    name: "DetailBadgeAdmin",
    component: DetailBadgeAdmin,
    //beforeEnter: CheckAuth,
  },
  {
    path: '/Dashboard/Formation/Detail/:id',
    name: "DetailFormationAdmin",
    component: DetailFormationAdmin,
   // beforeEnter: CheckAuth,
  },
  {
    path: "/ListeEtudiants",
    name: "ListeEtudiants",
    component: ListeEtudiants,
   // beforeEnter: CheckAuth,
  },
  {
    path: "/jardinBadges",
    name: "jardinBadges",
    component: JardinBadges,
   /// beforeEnter: CheckAuth,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;