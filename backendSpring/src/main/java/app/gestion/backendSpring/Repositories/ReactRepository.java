package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import app.gestion.backendSpring.Entities.React;

import java.util.Optional;

public interface ReactRepository extends JpaRepository<React, Long> {
    Optional<React> findByPublicationIdAndUserId(Long publicationId, Long userId);
}
