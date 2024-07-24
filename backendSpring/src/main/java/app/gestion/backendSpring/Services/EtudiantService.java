package app.gestion.backendSpring.Services;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Repositories.EtudiantRepository;


@Service
public class EtudiantService {
	  @Autowired
	    private EtudiantRepository  etudiantRepository;

	    public long countEtudiants() {
	        return etudiantRepository.count();
	    }

}
