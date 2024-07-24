package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Formation4C;
import app.gestion.backendSpring.Repositories.Formation4cRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;

@Service
public class Formation4cService {

    @Autowired
    private Formation4cRepository formation4cRepository;

    public List<Formation4C> getAllFormations() {
        return formation4cRepository.findAll();
    }

    public Formation4C createFormation(Formation4C formation4C) {
        return formation4cRepository.save(formation4C);
    }

    public Formation4C getFormationById(Long id) {
        return formation4cRepository.findById(id).orElse(null);
    }

    public Formation4C updateFormation(Long id, Formation4C formationDetails) {
        Formation4C formation4C = formation4cRepository.findById(id).orElseThrow();
        // Update the fields
        formation4C.setNbSession(formationDetails.getNbSession());
        // Add all other fields
        return formation4cRepository.save(formation4C);
    }

    public void deleteFormation(Long id) {
        formation4cRepository.deleteById(id);
    }

    public long countFormations() {
        return formation4cRepository.count();
    }

    public List<Formation4C> getFormationDisponible(LocalDate date) {
        return formation4cRepository.findByDateLimiteInscriptionGreaterThanEqual(date);
    }

    public List<Formation4C> getFormationNonDisponible(LocalDate date) {
        return formation4cRepository.findByDateLimiteInscriptionLessThan(date);
    }
}
