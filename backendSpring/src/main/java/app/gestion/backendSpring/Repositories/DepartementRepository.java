package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import app.gestion.backendSpring.Entities.Departement;

public interface DepartementRepository extends JpaRepository<Departement, Long> {

}
