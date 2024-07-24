package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Commentaire;
import app.gestion.backendSpring.Repositories.CommentaireRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class CommentaireService {

    @Autowired
    private CommentaireRepository commentaireRepository;

    public List<Commentaire> getCommentairesByPublicationId(Long publicationId) {
        return commentaireRepository.findByPublicationId(publicationId);
    }

    public Commentaire createCommentaire(Commentaire commentaire) {
        return commentaireRepository.save(commentaire);
    }

    public Optional<Commentaire> updateCommentaire(Long id, String description) {
        return commentaireRepository.findById(id).map(commentaire -> {
            commentaire.setDescription(description);
            return commentaireRepository.save(commentaire);
        });
    }

    public void deleteCommentaire(Long id, Long publicationId) {
        commentaireRepository.findById(id)
            .ifPresent(commentaire -> {
                if (commentaire.getPublication().equals(publicationId)) {
                    commentaireRepository.delete(commentaire);
                }
            });
    }
}
