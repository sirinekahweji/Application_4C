package app.gestion.backendSpring.Repositories;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import app.gestion.backendSpring.Entities.Departement;
import app.gestion.backendSpring.Entities.Enseignant;

public interface EnseignantRepository extends JpaRepository<Enseignant, Long>{
	List<Enseignant> findByDepartement(Departement departement);
}
