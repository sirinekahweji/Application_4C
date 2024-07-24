package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Formation4C;
import app.gestion.backendSpring.Services.Formation4cService;
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

@RequestMapping("/api/Formation4c")

public class Formation4cController {

    @Autowired
    private Formation4cService formation4cService;

    @GetMapping("/index")
    public List<Formation4C> getAllFormations() {
        return formation4cService.getAllFormations();
    }

    @PostMapping("/AddFormation4c")
    public Formation4C createFormation(@RequestBody Formation4C formation) throws IOException {
        /*byte[] imageBytes = Base64.getDecoder().decode(formation.getAffiche().split(",")[1]);
        String imageName = "affiche_" + System.currentTimeMillis() + ".png";
        String path = "src/main/resources/static/Formation4c/" + imageName;
        try (FileOutputStream fos = new FileOutputStream(new File(path))) {
            fos.write(imageBytes);
        }

        formation.setAffiche(path);*/
        // Generate QR Code and set to formation
        String url = "http://localhost:8080/DetailFormationAdmin/" + formation.getId();
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
        
        
        
        formation.setCodeQr(qrCode);

        return formation4cService.createFormation(formation);
    }

    @GetMapping("/{id}")
    public Formation4C getFormationById(@PathVariable Long id) {
        return formation4cService.getFormationById(id);
    }

    @PutMapping("/update/{id}")
    public Formation4C updateFormation(@PathVariable Long id, @RequestBody Formation4C formationDetails) {
        return formation4cService.updateFormation(id, formationDetails);
    }

    @DeleteMapping("/destroy/{id}")
    public void deleteFormation(@PathVariable Long id) {
        formation4cService.deleteFormation(id);
    }

    @GetMapping("/count")
    public long countFormations() {
        return formation4cService.countFormations();
    }

    @GetMapping("/GetFormation4cDisponible")
    public List<Formation4C> getFormationDisponible() {
        return formation4cService.getFormationDisponible(LocalDate.now());
    }

    @GetMapping("/GetFormation4cNonDisponible")
    public List<Formation4C> getFormationNonDisponible() {
        return formation4cService.getFormationNonDisponible(LocalDate.now());
    }
}
