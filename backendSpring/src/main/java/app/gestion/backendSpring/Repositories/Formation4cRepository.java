package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import app.gestion.backendSpring.Entities.Formation4C;
import java.time.LocalDate;
import java.util.List;

public interface Formation4cRepository extends JpaRepository<Formation4C, Long> {
    List<Formation4C> findByDateLimiteInscriptionGreaterThanEqual(LocalDate date);
    List<Formation4C> findByDateLimiteInscriptionLessThan(LocalDate date);
}
