package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Publication;
import app.gestion.backendSpring.Repositories.PublicationRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class PublicationService {

    @Autowired
    private PublicationRepository publicationRepository;

    public List<Publication> getPublications() {
        return publicationRepository.findAll();
    }

    public Publication createPublication(Publication publication) {
        return publicationRepository.save(publication);
    }

    public void deletePublication(Long id) {
        publicationRepository.deleteById(id);
    }

	public Optional<Publication> updatePublication(Long id, Publication updatedPublication) {
		return publicationRepository.findById(id).map(publication -> {
            publication.setDescription(updatedPublication.getDescription());
            publication.setCible(updatedPublication.getCible());
            return publicationRepository.save(publication);
        });
	}
}
