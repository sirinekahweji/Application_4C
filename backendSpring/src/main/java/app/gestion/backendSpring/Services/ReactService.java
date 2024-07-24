package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.React;
import app.gestion.backendSpring.Repositories.ReactRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class ReactService {

    @Autowired
    private ReactRepository reactRepository;

    public React createReact(React react) {
        return reactRepository.save(react);
    }

    public void deleteReact(Long publicationId, Long userId) {
        reactRepository.findByPublicationIdAndUserId(publicationId, userId)
                .ifPresent(reactRepository::delete);
    }

	public Optional<React> getReact(Long publicationId, Long userId) {
		return reactRepository.findByPublicationIdAndUserId(publicationId, userId);
	}
}
