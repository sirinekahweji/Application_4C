package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import app.gestion.backendSpring.Entities.Certificat4C;
import java.time.LocalDate;
import java.util.List;

public interface Certificat4cRepository extends JpaRepository<Certificat4C, Long> {
    List<Certificat4C> findByDateGreaterThanEqual(LocalDate date);
    List<Certificat4C> findByDateLessThan(LocalDate date);
    List<Certificat4C> findByCategorie(String categorie);
}
