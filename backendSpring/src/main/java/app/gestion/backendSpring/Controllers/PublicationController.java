package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Publication;
import app.gestion.backendSpring.Services.PublicationService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/publications")
public class PublicationController {

    @Autowired
    private PublicationService publicationService;

    @GetMapping("/posts")
    public List<Publication> getPublications() {
        return publicationService.getPublications();
    }

    @PostMapping("/AddPublication")
    public Publication addPublication(@RequestBody Publication publication) {
        return publicationService.createPublication(publication);
    }

    @PutMapping("/update/{id}")
    public Optional<Publication> updatePublication(@PathVariable Long id, @RequestBody Publication publication) {
        return publicationService.updatePublication(id, publication);
    }

    @DeleteMapping("/destroy/{id}")
    public void deletePublication(@PathVariable Long id) {
        publicationService.deletePublication(id);
    }
}
