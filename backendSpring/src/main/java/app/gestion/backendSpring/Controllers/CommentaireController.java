package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Commentaire;
import app.gestion.backendSpring.Services.CommentaireService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/commentaires")
public class CommentaireController {

    @Autowired
    private CommentaireService commentaireService;

    @GetMapping("/{publicationId}")
    public List<Commentaire> getCommentaires(@PathVariable Long publicationId) {
        return commentaireService.getCommentairesByPublicationId(publicationId);
    }

    @PostMapping("/AddCommentaire")
    public Commentaire addCommentaire(@RequestBody Commentaire commentaire) {
        return commentaireService.createCommentaire(commentaire);
    }

    @PutMapping("/{id}")
    public Optional<Commentaire> updateCommentaire(@PathVariable Long id, @RequestBody String description) {
        return commentaireService.updateCommentaire(id, description);
    }

    @DeleteMapping("/destroy/{id}/{publicationId}")
    public void deleteCommentaire(@PathVariable Long id, @PathVariable Long publicationId) {
        commentaireService.deleteCommentaire(id, publicationId);
    }
}
