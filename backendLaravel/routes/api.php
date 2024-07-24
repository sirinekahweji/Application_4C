<?php

use App\Http\Controllers\AttestationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormationExterneController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonnelEntrepriseController;
use App\Http\Controllers\PresenceCertificatController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\Certificat4cController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DemandeAcceController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\Formation4CController;
use App\Http\Controllers\ParticipantCertificatController;
use App\Http\Controllers\ParticipantFormationController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\FormationAcademiqueController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\GroupeManagerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ParticipantEventController;
use App\Http\Controllers\PresenceEventController;
use App\Http\Controllers\UserAttestationController;
use App\Http\Controllers\UserBadgeController;
use App\Http\Controllers\VideoController;
use App\Models\Badge;
use App\Models\FormationAcademique;
use App\Models\Certificat;
use App\Models\Enseignant;
use App\Models\Competence;
use App\Models\Langues;
use App\Models\Entreprise;
use App\Models\Etudiant;
use App\Models\Formation4C;
use App\Models\Experience;
use App\Models\participantFormation;
use App\Models\User;
use App\Models\cv;
use App\Models\GroupeManager;
use App\Models\participantCertificat;
use App\Models\UserBadge;
use App\Models\UserAttestation;
use App\Models\Video;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/auth'], function () {
    Route::post('/login', [AuthController::class, 'Login']);
});

Route::group(['prefix' => '/badges'], function () {
    Route::get('/count', [BadgeController::class, 'count']);
    Route::get('/index', [BadgeController::class, 'index']);
    Route::post('/store', [BadgeController::class, 'store']);
    Route::get('/badge/{id}', [BadgeController::class, 'edit']);
    Route::put("/update/{id}", [BadgeController::class, "update"]);
    Route::get('/getLastSixBadges', [UserBadgeController::class, 'getLastSixBadges']);
});



Route::group(['prefix' => '/formations4c'], function () {
    Route::get('/count', [Formation4CController::class, 'count']);
    Route::get('/index', [Formation4CController::class, 'index']);
});

Route::group(['prefix' => '/userbadges'], function () {
    Route::get('/getBadgeByUserId/{UserId}', [UserBadgeController::class, 'getBadgeByUserId']);
    Route::post('/store/{BadgeID}/{UserId}', [UserBadgeController::class, 'store']);
});
Route::group(['prefix' => '/userAttestations'], function () {
    Route::get('/getAttestationByUserId/{UserId}', [UserAttestationController::class, 'getAttestationByUserId']);
});

Route::group(['prefix' => '/certificats'], function () {
    Route::get('/count', [CertificatController::class, 'count']);
    Route::get('/getCertificatsByUserId/{id}', [CertificatController::class, 'getCertificatsByUserId']);
    Route::get('/CertificatsExternes/{id}', [CertificatController::class, 'getCertifsExternesByIdCV']);
    //Route::get('/getAll',[CertificatController::class,'index']);
    Route::get('/profil/{id}/certificats', [CertificatController::class, 'getCertificatsByProfileId']);
    //Route::get('/getAll',[CertificatController::class,'index']);
    Route::get('/getCertificatsExternes/{idcv}', [CertificatController::class, 'getCertifsExternesByIdCV']);
    //Route::get('/finById/{id}', [CertificatController::class, 'findById']);
    Route::post('/addcertificat', [CertificatController::class, 'store']);
    Route::delete('/deleteCertificat/{id}', [CertificatController::class, 'destroy']);
    Route::put('/updatecertificat/{id}', [CertificatController::class, 'update']);
});

Route::group(['prefix' => '/formations'], function () {
    Route::get('/count', [FormationController::class, 'count']);
    Route::get('/getAll', [FormationController::class, 'index']);
    Route::get('/getFormations4cByUserId/{UserId}', [FormationController::class, 'getFormations4cByUserId']);
    Route::get('/formationsExterne/{idCv}', [FormationController::class, 'getAllformationExterne']);
    Route::post('/addFormation', [FormationController::class, 'store']);
    Route::delete('/deleteFormation/{id}', [FormationController::class, 'destroy']);
    Route::put('/updateformation/{id}', [FormationController::class, 'update']);
    Route::get('/profil/{id}/formations', [FormationController::class, 'getFormationsByProfileId']);
});

Route::group(['prefix' => '/formations4c'], function () {
    Route::get('/count', [Formation4CController::class, 'count']);
    //Route::get('/getAll',[Formation4CController::class,'index']);
    //Route::get('/findformationById/{id}', [Formation4CController::class, 'findformationById']);
    //Route::post('/addformations', [Formation4CController::class,'store' ]);
    //Route::delete('/deleteformationById/{id}',[Formation4CController::class,'destroy']);
    //Route::put('/updateformation/{formation}',[Formation4CController::class,'update']);
    //Route::post('/formations/{formation}/participer', [Formation4CController::class, 'participer']);
});


Route::group(['prefix' => '/formationsAcademiques'], function () {
    Route::get('/getAll', [FormationAcademiqueController::class, 'index']);
    Route::get('/getAllFormationsAcd/{idCv}', [FormationAcademiqueController::class, 'getAllFormationsAcdByCVID']);
    Route::post('/AddFormationAcd', [FormationAcademiqueController::class, 'store']);
    Route::delete('/delete/{id}', [FormationAcademiqueController::class, 'destroy']);
    Route::get('/finById/{id}', [FormationAcademiqueController::class, 'finById']);
    Route::put('/update/{id}', [FormationAcademiqueController::class, 'update']);
});
Route::group(['prefix' => '/competences'], function () {
    Route::get('/getAll', [CompetenceController::class, 'index']);
    Route::post('/AddCompetence', [CompetenceController::class, 'store']);
    Route::delete('/delete/{id}', [CompetenceController::class, 'destroy']);
    Route::get('/finById/{id}', [CompetenceController::class, 'finById']);
    Route::get('/getAll/{id}', [CompetenceController::class, 'getCompetencesByIdCV']);
    Route::put('/update/{id}', [CompetenceController::class, 'update']);
});
Route::group(['prefix' => '/langues'], function () {
    Route::get('/getAll', [LanguesController::class, 'index']);
    Route::post('/AddLangue', [LanguesController::class, 'store']);
    Route::delete('/delete/{id}', [LanguesController::class, 'destroy']);
    Route::get('/findById/{id}', [LanguesController::class, 'findById']);
    Route::get('/getAll/{id}', [LanguesController::class, 'getAllLangues']);
    Route::put('/update/{id}', [LanguesController::class, 'update']);
});
Route::group(['prefix' => '/experiences'], function () {
    Route::get('/getAll', [ExperienceController::class, 'index']);
    Route::get('/getAllExperiences/{idCv}', [ExperienceController::class, 'getAllExperiencesByCVID']);
    Route::post('/AddExperience', [ExperienceController::class, 'store']);
    Route::delete('/delete/{id}', [ExperienceController::class, 'destroy']);
    Route::get('/finById/{id}', [ExperienceController::class, 'finById']);
    Route::put('/update/{id}', [ExperienceController::class, 'update']);
});

Route::group(['prefix' => '/certificats'], function () {
    Route::get('/count', [CertificatController::class, 'count']);
});

Route::group(['prefix' => '/formations4c'], function () {
    Route::get('/count', [Formation4CController::class, 'count']);
});

Route::group(['prefix' => '/enseignants'], function () {
    Route::get('/count', [EnseignantController::class, 'count']);
    Route::post('/AddEnseignant', [EnseignantController::class, 'store']);
    Route::get('/getEnseignant/{idUser}', [EnseignantController::class, 'findByUserId']);
    Route::put('/update/{id}', [EnseignantController::class, 'update']);
});
Route::group(['prefix' => '/personnels'], function () {
    Route::get('/getPersonnel/{idUser}', [PersonnelEntrepriseController::class, 'findByUserId']);
    Route::put('/update/{id}', [PersonnelEntrepriseController::class, 'update']);
});

Route::group(['prefix' => '/etudiants'], function () {
    Route::get('/count', [EtudiantController::class, 'count']);
    Route::post('/AddEtudiant', [EtudiantController::class, 'store']);
    Route::get('/getEtudiant/{idUser}', [EtudiantController::class, 'findByUserId']);
    Route::put('/update/{id}', [EtudiantController::class, 'update']);
});

Route::group(['prefix' => '/entreprises'], function () {
    Route::get('/count', [EntrepriseController::class, 'count']);
    Route::get('/getAll', [EntrepriseController::class, 'index']);
    Route::get('/getAllHisqtorique', [EntrepriseController::class, 'indexHistorique']);
    Route::get('/getById/{id}', [EntrepriseController::class, 'findById']);
    Route::post('/addCompany', [EntrepriseController::class, 'store']);
    Route::delete('/delete/{id}', [EntrepriseController::class, 'destroy']);
    Route::put('/update/{id}', [EntrepriseController::class, 'update']);
});

Route::group(['prefix' => '/contacts'], function () {
    Route::get('/getAll', [ContactController::class, 'index']);
    Route::post('/addContact', [ContactController::class, 'store']);
});

Route::group(['prefix' => '/users'], function () {
    Route::get('/countManagers', [UserController::class, 'countManagers']);
    Route::post('/addUser', [UserController::class, 'store']);
    Route::post('/checkPassword/{id}', [UserController::class, 'checkPassword']);
    Route::post('/upload-profil-image/{id}', [UserController::class, 'uploadPhotoProfil']);
    Route::post('/upload-couverture-image/{id}', [UserController::class, 'uploadPhotoCouverture']);
    Route::get('/getAll', [UserController::class, 'index']);
    Route::get('/getAllHisqtorique', [UserController::class, 'indexHistorique']);
    Route::get('/getAllEtudiant', [UserController::class, 'indexEtudiant']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    Route::get('/findById/{id}', [UserController::class, 'findById']);
    Route::get('/hasRole/{role}', [UserController::class, 'hasUsersWithRole']);
    Route::put('/updateCredentials/{idProfile}', [UserController::class, 'updateCredentials']);
    Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
    Route::put('/update/{idUser}', [UserController::class, 'update']);
    Route::post('/acceptAccess/{id}', [UserController::class, 'acceptAccess']);
    //Route::post('/check-password', 'UserController@checkPassword');
    Route::post('/evaluer/{id}', [UserController::class, 'evaluer']);
    Route::get('/getUserRole/{roleId}', [RoleController::class, 'getUserRole']);

    Route::get('/getUsersWithoutAttestation/{idAttestation}', [UserController::class, 'getUsersWithoutAttestation']);
    Route::get('/getUsersWithAttestation/{idAttestation}', [UserController::class, 'getUsersWithAttestation']);

    Route::get('/getUsersWithoutBadge/{idBadge}', [UserController::class, 'getUsersWithoutBadge']);
    Route::get('/getUsersWithBadge/{idBadge}', [UserController::class, 'getUsersWithBadge']);
});


Route::group(['prefix' => '/roles'], function () {
    Route::get('/finById/{id}', [RoleController::class, 'finById']);
    Route::get('/getAll', [RoleController::class, 'index']);
    Route::delete('/delete/{role}', [RoleController::class, 'destroy']);
    Route::post('/add', [RoleController::class, 'store']);
    Route::put('/update/{idRole}', [RoleController::class, 'update']);
    Route::get('/findIdManager', [RoleController::class, 'findIdManager']);
    Route::get('/findIdAdmin', [RoleController::class, 'findIdAdmin']);
    Route::get('/findIdResponsable', [RoleController::class, 'findIdResponsable']);
});

Route::group(['prefix' => '/publications'], function () {
    Route::get("/posts/{responsableID}", [PublicationController::class, "index"]);
    Route::post("/AddPublication", [PublicationController::class, "store"]);
    Route::put("/update/{id}", [PublicationController::class, "update"]);
    Route::delete("/destroy/{id}", [PublicationController::class, "destroy"]);
    Route::get("/GetReact/{PublicationId}/{UserId}", [ReactController::class, "index"]);
    Route::post("/AddReact", [ReactController::class, "store"]);
    Route::delete("/deleteReact/{PublicationId}/{UserId}", [ReactController::class, "destroy"]);
    Route::get("/NbReact/{PublicationId}", [ReactController::class, "nbReact"]);
});

Route::prefix('commentaires')->group(function () {
    Route::get('/{publication_id}', [CommentaireController::class, 'index']);
    Route::post('/AddCommentaire', [CommentaireController::class, 'store']);
    Route::put('/{id}', [CommentaireController::class, 'update']);
    Route::delete('/destroy/{id}/{publication_id}', [CommentaireController::class, 'destroy']);
});

Route::prefix('discussion')->group(function () {
    Route::get('/GetManagers/{id}', [UserController::class, 'managers']);
    Route::get('/GetChat/{emmetteur_id}/{recepteur_id}', [MessageController::class, 'index']);
    Route::post('/AddDiscussion', [MessageController::class, 'store']);
    Route::delete('/destroy/{id}', [MessageController::class, 'destroy']);
    Route::get('/GetMessagesGroup', [GroupeManagerController::class, 'index']);
    Route::post('/AddMessageGroup', [GroupeManagerController::class, 'store']);
});

Route::prefix('image')->group(function () {
    Route::get('/GetImages/{publication_id}', [ImageController::class, 'index']);
    Route::post('/AddImages', [ImageController::class, 'upload']);
});
Route::group(['prefix' => '/certificat4cs'], function () {
    Route::get('/count', [Certificat4cController::class, 'count']);
    Route::get('/index', [Certificat4cController::class, 'index']);
    Route::post('/AddCertif', [Certificat4cController::class, 'store']);
});

Route::group(['prefix' => '/participantsFormations'], function () {
    Route::get('/countParticipants', [ParticipantFormationController::class, 'countParticipants']);
    Route::get('/GetChat/{emmetteur_id}/{recepteur_id}', [MessageController::class, 'index']);

});

Route::group(['prefix' => '/participantsCertificats'], function () {
    Route::get('/countParticipants', [ParticipantCertificatController::class, 'countParticipants']);
});

Route::group(['prefix' => '/demandes'], function () {
    Route::get('/index', [DemandeAcceController::class, 'index']);
    Route::post('/store', [DemandeAcceController::class, 'store']);
    Route::delete('/delete/{demandeAcce}', [DemandeAcceController::class, 'destroy']);
    Route::get('/finByIdUser/{idUser}', [DemandeAcceController::class, 'finByIdUser']);
});

Route::group(['prefix' => '/evenements'], function () {
    Route::get('/index', [EvenementController::class, 'index']);
    Route::post('/store', [EvenementController::class, 'store']);
    Route::get('/count', [EvenementController::class, 'count']);
});

Route::group(['prefix' => '/attestations'], function () {
    Route::get('/index', [AttestationController::class, 'index']);
    Route::post('/store', [AttestationController::class, 'store']);
    Route::get('/attestation/{id}', [AttestationController::class, 'edit']);
    Route::put("/update/{id}", [AttestationController::class, "update"]);
});

Route::group(['prefix' => '/UserAttestation'], function () {
    Route::post('/store/{AttestationID}/{UserId}', [UserAttestationController::class, 'store']);
});

Route::group(['prefix' => '/departements'], function () {
    Route::get('/index', [DepartementController::class, 'index']);
    Route::post('/store', [DepartementController::class, 'store']);
    Route::delete('/delete/{departement}', [DepartementController::class, 'destroy']);
});

Route::group(['prefix' => '/specialites'], function () {
    Route::get('/index', [SpecialiteController::class, 'index']);
    Route::post('/store', [SpecialiteController::class, 'store']);
    Route::delete('/delete/{specialite}', [SpecialiteController::class, 'destroy']);
});

Route::group(['prefix' => '/classes'], function () {
    Route::get('/index', [ClasseController::class, 'index']);
    Route::post('/store', [ClasseController::class, 'store']);
});

Route::group(['prefix' => '/presenceEvents'], function () {
    Route::get('/getevenementByUserId/{userId}', [PresenceEventController::class, 'getevenementByUserId']);
});
Route::group(['prefix' => '/personnels'], function () {
    Route::get('/index', [PersonnelEntrepriseController::class, 'index']);
    Route::post('/store', [PersonnelEntrepriseController::class, 'store']);
    Route::delete('/delete/{personnel}', [PersonnelEntrepriseController::class, 'destroy']);
});

Route::group(['prefix' => '/Certificat4c'], function () {
    Route::get("/Certificat4c", [Certificat4cController::class, "index"]);
    Route::post("/AddCertificat4c", [Certificat4cController::class, "store"]);
    Route::get("/Certificat4c/{id}", [Certificat4cController::class, "edit"]);
    Route::put("/update/{id}", [Certificat4cController::class, "update"]);
    Route::delete("/destroy/{id}", [Certificat4cController::class, "destroy"]);
    Route::get("/GetParticipantsCertif/{id}", [ParticipantCertificatController::class, "getParticipantCertificat"]);
    Route::get("/GetPresenceCertif/{id}", [PresenceCertificatController::class, "getPresenceCertif"]);
    Route::get("/GetUser/{id}", [UserController::class, "finById"]);
    Route::get("/GetCertificat4cDisponible", [Certificat4cController::class, "getCertificat4cDisponible"]);
    Route::get("/GetCertificat4cNonDisponible", [Certificat4cController::class, "getCertificat4cNonDisponible"]);
    Route::post('/Participer/{UserId}/{CertifId}', [ParticipantCertificatController::class, 'Participer']);
    Route::delete('/AnnulerParticiper/{UserId}/{CertifId}', [ParticipantCertificatController::class, 'AnnulerParticiper']);
    Route::get('/GetParticipation/{UserId}/{CertifId}', [ParticipantCertificatController::class, 'GetParticipation']);


});

Route::group(['prefix' => '/Formation4c'], function () {
    Route::get("/Formation4c", [Formation4CController::class, "index"]);
    Route::post("/AddFormation4c", [Formation4CController::class, "store"]);
    Route::get("/Formation4c/{id}", [Formation4CController::class, "edit"]);
    Route::put("/update/{id}", [Formation4CController::class, "update"]);
    Route::delete("/destroy/{id}", [Formation4CController::class, "destroy"]);
    /*Route::get("/GetParticipantsCertif/{id}", [ParticipantCertificatController::class, "getParticipantCertificat"]);
    Route::get("/GetPresenceCertif/{id}", [PresenceCertificatController::class, "getPresenceCertif"]);*/
    Route::get("/GetUser/{id}", [UserController::class, "finById"]);
    Route::get("/GetFormation4cDisponible", [Formation4CController::class, "getFormationDisponible"]);
    Route::get("/GetFormation4cNonDisponible", [Formation4CController::class, "getFormationNonDisponible"]);
    Route::post('/Participer/{UserId}/{FormationId}', [ParticipantFormationController::class, 'Participer']);
    Route::get('/GetParticipation/{UserId}/{FormationId}', [ParticipantFormationController::class, 'GetParticipation']);
    Route::delete('/AnnulerParticiper/{UserId}/{FormationId}', [ParticipantFormationController::class, 'AnnulerParticiper']);

});


Route::group(['prefix' => '/Evenement'], function () {
    Route::post("/AddEvenement", [EvenementController::class, "store"]);
    Route::get("/Evenement/{id}", [EvenementController::class, "edit"]);
    Route::put("/update/{id}", [EvenementController::class, "update"]);
    Route::delete("/destroy/{id}", [EvenementController::class, "destroy"]);
    Route::get("/GetParticipantsEvent/{id}", [ParticipantEventController::class, "getParticipantEvent"]);
    Route::get("/GetPresenceEvent/{id}", [PresenceEventController::class, "getPresenceEvent"]);
    Route::get("/GetUser/{id}", [UserController::class, "finById"]);
    Route::get("/GetEvenementDisponible", [EvenementController::class, "getEvenementDisponible"]);
    Route::get("/GetEvenementNonDisponible", [EvenementController::class, "getEvenementNonDisponible"]);
    Route::get('/GetParticipation/{UserId}/{EventId}', [ParticipantEventController::class, 'GetParticipation']);
    Route::post('/Participer/{UserId}/{EventId}', [ParticipantEventController::class, 'Participer']);
    Route::delete('/AnnulerParticiper/{UserId}/{EventId}', [ParticipantEventController::class, 'AnnulerParticiper']);

});

Route::group(['prefix' => '/departements'], function () {
    Route::get('/index', [DepartementController::class, 'index']);
    Route::get('/getDepartement/{id}', [DepartementController::class, 'findById']);
    Route::post('/store', [DepartementController::class, 'store']);
    Route::delete('/delete/{departement}', [DepartementController::class, 'destroy']);
});

Route::group(['prefix' => '/specialites'], function () {
    Route::get('/index', [SpecialiteController::class, 'index']);
    Route::get('/getSpecialite/{id}', [SpecialiteController::class, 'findById']);
    Route::post('/store', [SpecialiteController::class, 'store']);
    Route::delete('/delete/{specialite}', [SpecialiteController::class, 'destroy']);
    Route::put("/update/{id}", [SpecialiteController::class, "update"]);
});


Route::group(['prefix' => '/classes'], function () {
   Route::get('/index',[ClasseController::class,'index']);
   Route::get('/getClasse/{id}',[ClasseController::class,'findById']);
   Route::post('/store',[ClasseController::class,'store']);
   Route::put("/update/{id}", [ClasseController::class, "update"]);
   Route::delete('/delete/{classe}',[ClasseController::class,'destroy']);
});
Route::group(['prefix' => '/departments'], function () {
    Route::get('/getDepartment', [ClasseController::class, 'index']);
});
Route::group(['prefix' => '/CVs'], function () {
    Route::get('/getcv/{iduser}', [CvController::class, 'findByUserId']);
    Route::post('/store', [CvController::class, 'store']);
});

Route::group(['prefix' => '/Notification'], function () {
    Route::get('/GetNotificationUser/{iduser}', [NotificationController::class, 'getNotificationUser']);
});

Route::prefix('Video')->group(function () {
    Route::get('/GetVideos/{publication_id}', [VideoController::class, 'index']);
    Route::post('/AddVideos', [VideoController::class, 'upload']);
});
