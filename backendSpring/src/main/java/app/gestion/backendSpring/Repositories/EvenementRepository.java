package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import app.gestion.backendSpring.Entities.Evenement;

import java.time.LocalDate;
import java.util.List;

public interface EvenementRepository extends JpaRepository<Evenement, Long> {
    List<Evenement> findByDateLimiteInscriptionGreaterThanEqual(LocalDate date);
    List<Evenement> findByDateLimiteInscriptionLessThan(LocalDate date);
}
