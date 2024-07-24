package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Certificat4C;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Services.Certificat4cService;
import util.QRCodeUtil;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
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
@RequestMapping("/api/certificat4cs")
public class Certificat4cController {

    @Autowired
    private Certificat4cService certificat4cService;

    @GetMapping("/index")
    public List<Certificat4C> getAllCertificats() {
        return certificat4cService.getAllCertificats();
    }

    @PostMapping("/AddCertif")
    public Certificat4C createCertificat(@RequestBody Certificat4C certificat) throws IOException {
        /*byte[] imageBytes = Base64.getDecoder().decode(certificatImage.split(",")[1]);
        String imageName = "certificat_" + System.currentTimeMillis() + ".png";
        String path = "src/main/resources/static/Certificat4c/" + imageName;
        try (FileOutputStream fos = new FileOutputStream(new File(path))) {
            fos.write(imageBytes);
        }

        certificat.setCertificat(path);*/
        // Generate QR Code and set to certificat
        String url = "http://localhost:8080/DetailCertificatAdmin/" + certificat.getId();
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
        
        
        certificat.setCodeQr(qrCode);

        return certificat4cService.createCertificat(certificat);
    }

    @GetMapping("/{id}")
    public Certificat4C getCertificatById(@PathVariable Long id) {
        return certificat4cService.getCertificatById(id);
    }

    @PutMapping("/{id}")
    public Certificat4C updateCertificat(@PathVariable Long id, @RequestBody Certificat4C certificatDetails) {
        return certificat4cService.updateCertificat(id, certificatDetails);
    }

    @DeleteMapping("/{id}")
    public void deleteCertificat(@PathVariable Long id) {
        certificat4cService.deleteCertificat(id);
    }

    @GetMapping("/count")
    public long countCertificats() {
        return certificat4cService.countCertificats();
    }

    @GetMapping("/disponible")
    public List<Certificat4C> getCertificat4cDisponible() {
        return certificat4cService.getCertificat4cDisponible(LocalDate.now());
    }

    @GetMapping("/nondisponible")
    public List<Certificat4C> getCertificat4cNonDisponible() {
        return certificat4cService.getCertificat4cNonDisponible(LocalDate.now());
    }
    
    @GetMapping("/categorie/{categorie}")
    public ResponseEntity<List<Certificat4C>> getCertificatsByCategorie(@PathVariable String categorie) {
        List<Certificat4C> certificats = certificat4cService.getCertificatsByCategorie(categorie);
        return ResponseEntity.ok(certificats);
    }
    
    @GetMapping("/{id}/participants")
    public ResponseEntity<List<User>> getParticipantsByCertificatId(@PathVariable Long id) {
        List<User> participants = certificat4cService.getParticipantsByCertificatId(id);
        if (participants == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(participants, HttpStatus.OK);
    }

    @GetMapping("/{id}/presences")
    public ResponseEntity<List<User>> getPresencesByCertificatId(@PathVariable Long id) {
        List<User> presences = certificat4cService.getPresencesByCertificatId(id);
        if (presences == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(presences, HttpStatus.OK);
    }
}
