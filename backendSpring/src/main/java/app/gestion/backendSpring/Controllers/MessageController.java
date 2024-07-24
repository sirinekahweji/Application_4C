package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Entities.Message;
import app.gestion.backendSpring.Services.MessageService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/discussion")
public class MessageController {

    @Autowired
    private MessageService messageService;

    @GetMapping("/GetChat/{emmetteurId}/{recepteurId}")
    public List<Message> getChat(@PathVariable Long emmetteurId, @PathVariable Long recepteurId) {
        return messageService.getChat(emmetteurId, recepteurId);
    }

    @PostMapping("/AddDiscussion")
    public Message addDiscussion(@RequestBody Message message) {
        return messageService.createMessage(message);
    }

    @DeleteMapping("/destroy/{id}")
    public void deleteMessage(@PathVariable Long id) {
        messageService.deleteMessage(id);
    }
}
