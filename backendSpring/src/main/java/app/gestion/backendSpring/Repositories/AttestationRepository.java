package app.gestion.backendSpring.Repositories;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import app.gestion.backendSpring.Entities.Attestation;

public interface AttestationRepository extends JpaRepository<Attestation, Long> {
	List<Attestation> findByType(String type);
}
