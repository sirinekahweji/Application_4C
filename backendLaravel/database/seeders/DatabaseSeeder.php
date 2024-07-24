<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MessageSeeder::class,
            PublicationSeeder::class,
            ImageSeeder::class,
            VideoSeeder::class,
            ReactSeeder::class,
            CommentaireSeeder::class,
            EntrepriseSeeder::class,
            ContactSeeder::class,
            PersonnelEntrepriseSeeder::class,
            DepartementSeeder::class,
            SpecialiteSeeder::class,
            ClasseSeeder::class,
            EtudiantSeeder::class,
            EnseignantSeeder::class,
            CvSeeder::class,
            CompetenceSeeder::class,
            LanguesSeeder::class,
            FormationAcademiqueSeeder::class,
            ExperienceSeeder::class,
            BadgeSeeder::class,
            CertificatSeeder::class,
            FormationSeeder::class,
            Formation4CSeeder::class,
            GroupeManagerSeeder::class,
            DemandeAcceSeeder::class,
            InteretSeeder::class,
            Certificat4cSeeder::class,
            ParticipantCertificatSeeder::class,
            PresenceCertificatSeeder::class,
            SessionSeeder::class,
            FichierEvaluationSeeder::class,
            ParticipantFormationSeeder::class,
            PresenceFormationSeeder::class,
            NotificationSeeder::class,
            AttestationSeeder::class,
            EvenementSeeder::class,
            ParticipantEventSeeder::class,
            PresenceEventSeeder::class,
            UserAttestationSeeder::class,
            UserBadgeSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
