package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Evenement;
import app.gestion.backendSpring.Services.EvenementService;
import util.QRCodeUtil;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import com.google.zxing.WriterException;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.time.LocalDate;
import java.util.Base64;
import java.util.List;

@RestController
@CrossOrigin("http://localhost:8081/")
@RequestMapping("/api/evenements")
public class EvenementController {

    @Autowired
    private EvenementService evenementService;

    @PostMapping("/AddEvenement")
    public Evenement createEvenement(@RequestBody Evenement evenement, @RequestParam String afficheImage) throws IOException {
        /*byte[] imageBytes = Base64.getDecoder().decode(afficheImage.split(",")[1]);
        String imageName = "affiche_" + System.currentTimeMillis() + ".png";
        String path = "src/main/resources/static/Evenements/" + imageName;
        try (FileOutputStream fos = new FileOutputStream(new File(path))) {
            fos.write(imageBytes);
        }

        evenement.setAffiche(path);*/
        // Generate QR Code and set to evenement
        String url = "http://localhost:8080/DetailEvenementAdmin/" + evenement.getId();
        String qrCode = "Generated QR Code"; // Replace with actual QR code generation
        try {
        	qrCode = QRCodeUtil.generateQRCode(String.format(url));
		} catch (WriterException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
        
        evenement.setCodeQr(qrCode);

        return evenementService.createEvenement(evenement);
    }

    @GetMapping("/{id}")
    public Evenement getEvenementById(@PathVariable Long id) {
        return evenementService.getEvenementById(id);
    }

    @PutMapping("/update/{id}")
    public Evenement updateEvenement(@PathVariable Long id, @RequestBody Evenement evenementDetails) {
        return evenementService.updateEvenement(id, evenementDetails);
    }

    @DeleteMapping("/destroy/{id}")
    public void deleteEvenement(@PathVariable Long id) {
        evenementService.deleteEvenement(id);
    }

    @GetMapping("/count")
    public long countEvenements() {
        return evenementService.countEvenements();
    }

    @GetMapping("/GetEvenementDisponible")
    public List<Evenement> getEvenementDisponible() {
        return evenementService.getEvenementDisponible(LocalDate.now());
    }

    @GetMapping("/GetEvenementNonDisponible")
    public List<Evenement> getEvenementNonDisponible() {
        return evenementService.getEvenementNonDisponible(LocalDate.now());
    }
}
