package app.gestion.backendSpring.Repositories;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import app.gestion.backendSpring.Entities.Departement;
import app.gestion.backendSpring.Entities.Specialite;

public interface SpecialiteRepository extends JpaRepository<Specialite, Long>{
	List<Specialite> findByDepartement(Departement departement);
}
