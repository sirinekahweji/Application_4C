package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Image;
import app.gestion.backendSpring.Repositories.ImageRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ImageService {

    @Autowired
    private ImageRepository imageRepository;

    public List<Image> getImages(Long publicationId) {
        return imageRepository.findByPublicationId(publicationId);
    }

    public Image uploadImage(Image image) {
        return imageRepository.save(image);
    }
}
