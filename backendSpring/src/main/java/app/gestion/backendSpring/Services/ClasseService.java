package app.gestion.backendSpring.Services;

import java.util.Date;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Entities.Classe;
import app.gestion.backendSpring.Entities.Etudiant;
import app.gestion.backendSpring.Repositories.ClasseRepository;

@Service
public class ClasseService {

    @Autowired
    private ClasseRepository classeRepository;

    public List<Classe> getAllClasses() {
        return classeRepository.findAll();
    }

    public Classe getClasseById(Long id) {
        Optional<Classe> optionalClasse = classeRepository.findById(id);
        return optionalClasse.orElse(null);
    }

    public Classe createClasse(Classe classe) {
        return classeRepository.save(classe);
    }

    public Classe updateClasse(Long id, Classe classeDetails) {
        Optional<Classe> optionalClasse = classeRepository.findById(id);
        if (!optionalClasse.isPresent()) {
            return null;
        }

        Classe classe = optionalClasse.get();
        classe.setNom(classeDetails.getNom());
        classe.setAbreviation(classeDetails.getAbreviation());
        classe.setSpecialite(classeDetails.getSpecialite());
        classe.setUpdatedAt(new Date());

        return classeRepository.save(classe);
    }

    public boolean deleteClasse(Long id) {
        Optional<Classe> optionalClasse = classeRepository.findById(id);
        if (!optionalClasse.isPresent()) {
            return false;
        }
        classeRepository.deleteById(id);
        return true;
    }
    
    public List<Etudiant> getEtudiantsByClasse(Long classeId) {
        Optional<Classe> optionalClasse = classeRepository.findById(classeId);
        if (optionalClasse.isPresent()) {
            return optionalClasse.get().getEtudiants();
        }
        return null;
    }
    
    public List<Classe> getClassesBySpecialite(Long specialiteId) {
        return classeRepository.findBySpecialiteId(specialiteId);
    }
}
