package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Image;
import app.gestion.backendSpring.Services.ImageService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import javax.xml.bind.DatatypeConverter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.List;
import java.util.UUID;

@RestController
@RequestMapping("/image")
public class ImageController {

    @Autowired
    private ImageService imageService;

    @GetMapping("/GetImages/{publicationId}")
    public List<Image> getImages(@PathVariable Long publicationId) {
        return imageService.getImages(publicationId);
    }

    @PostMapping("/AddImages")
    public Image uploadImage(@RequestParam("image") String imageData, @RequestParam("publicationId") Long publicationId) throws IOException {
        // Extract and decode the base64 image data
        String[] parts = imageData.split(",");
        String base64Image = parts.length > 1 ? parts[1] : parts[0];
        byte[] imageBytes = DatatypeConverter.parseBase64Binary(base64Image);

        // Generate a unique image name
        String imageName = UUID.randomUUID().toString() + ".png";

        // Specify the path to the assets directory
        String path = "../frontlaravel/src/assets/ImagesPosts/" + imageName;

        // Save the image to the specified path
        try (FileOutputStream fos = new FileOutputStream(new File(path))) {
            fos.write(imageBytes);
        }

        // Create and save the Image entity
        Image image = new Image();
        //image.setPublication(publicationId);
        image.setImage("assets/ImagesPosts/" + imageName);

        return imageService.uploadImage(image);
    }
}
