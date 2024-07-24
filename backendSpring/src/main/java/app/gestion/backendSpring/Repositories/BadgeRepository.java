package app.gestion.backendSpring.Repositories;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import app.gestion.backendSpring.Entities.Badge;

@Repository
public interface BadgeRepository extends JpaRepository<Badge, Long> {
	List<Badge> findByType(String type);
}
