package app.gestion.backendSpring.Services;

import java.util.Collection;
import java.util.Date;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Entities.Attestation;
import app.gestion.backendSpring.Entities.Badge;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Repositories.BadgeRepository;

@Service
public class BadgeService {

	@Autowired
	private BadgeRepository badgeRepository;
	
	public long countBadges() {
        return badgeRepository.count();
    }
	
	public List<Badge> getAllBadges() {
        return badgeRepository.findAll();
    }
	
	public Badge getBadgeById(Long id) {
        return badgeRepository.findById(id).orElse(null);
    }
	
	public Badge createBadge(Badge badge) {
        return badgeRepository.save(badge);
    }
	
	public List<Badge> getBadgesByType(String type) {
        return badgeRepository.findByType(type);
    }
	
	public Collection<User> getUsersByBadgeId(Long id) {
        Optional<Badge> optionalAttestation = badgeRepository.findById(id);
        if (!optionalAttestation.isPresent()) {
            return null;
        }
        return optionalAttestation.get().getUsers();
    }
	
	public Badge updateBadge(Long id, Badge badgeDetails) {
        Optional<Badge> optionalBadge = badgeRepository.findById(id);
        if (!optionalBadge.isPresent()) {
            return null;
        }

        Badge badge = optionalBadge.get();
        badge.setNom(badgeDetails.getNom());
        badge.setImage(badgeDetails.getImage());
        badge.setType(badgeDetails.getType());
        badge.setUpdatedAt(new Date());

        return badgeRepository.save(badge);
    }
	
	public boolean deleteBadge(Long id) {
        Optional<Badge> optionalBadge = badgeRepository.findById(id);
        if (!optionalBadge.isPresent()) {
            return false;
        }
        badgeRepository.deleteById(id);
        return true;
    }
}
