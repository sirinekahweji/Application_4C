package app.gestion.backendSpring.Repositories;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import app.gestion.backendSpring.Entities.Classe;

public interface ClasseRepository extends JpaRepository<Classe, Long> {
	List<Classe> findBySpecialiteId(Long specialiteId);
}
