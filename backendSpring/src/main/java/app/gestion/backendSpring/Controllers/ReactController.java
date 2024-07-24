package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.React;
import app.gestion.backendSpring.Services.ReactService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/publications")
public class ReactController {

    @Autowired
    private ReactService reactService;

    @GetMapping("/GetReact/{PublicationId}/{UserId}")
    public Optional<React> getReact(@PathVariable Long PublicationId, @PathVariable Long UserId) {
        return reactService.getReact(PublicationId, UserId);
    }

    @PostMapping("/AddReact")
    public React addReact(@RequestBody React react) {
        return reactService.createReact(react);
    }

    @DeleteMapping("/deleteReact/{PublicationId}/{UserId}")
    public void deleteReact(@PathVariable Long PublicationId, @PathVariable Long UserId) {
        reactService.deleteReact(PublicationId, UserId);
    }
}
