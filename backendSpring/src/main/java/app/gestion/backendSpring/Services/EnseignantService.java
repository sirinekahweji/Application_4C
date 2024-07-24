package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Repositories.EnseignantRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class EnseignantService {
    @Autowired
    private EnseignantRepository  enseignantRepository;

    public long countEnseignants() {
        return enseignantRepository.count();
    }

}
