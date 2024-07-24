package app.gestion.backendSpring.Controllers;


import java.util.Collection;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import app.gestion.backendSpring.Entities.Badge;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Services.BadgeService;

@RestController
@RequestMapping("/badges")
public class BadgeController {

	@Autowired
    private BadgeService badgeService;

    @GetMapping("/count")
	public ResponseEntity<Long> countBadges() {
        long count = badgeService.countBadges();
        return ResponseEntity.ok(count);
    }
    
    @GetMapping
    public ResponseEntity<List<Badge>> getAllBadges() {
        List<Badge> badges = badgeService.getAllBadges();
        return ResponseEntity.ok(badges);
    }
    
    @GetMapping("/{id}")
    public ResponseEntity<Badge> getBadgeById(@PathVariable Long id) {
        Badge badge =  badgeService.getBadgeById(id);
        if(badge == null) {
        	return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(badge, HttpStatus.OK);
    }
    
    @GetMapping("/{id}/users")
    public ResponseEntity<Collection<User>> getUsersByBadgeId(@PathVariable Long id) {
        Collection<User> users = badgeService.getUsersByBadgeId(id);
        if (users == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(users, HttpStatus.OK);
    }
    
    @PostMapping
    public Badge createRole(@RequestBody Badge badge) {
        return badgeService.createBadge(badge);
    }
    
    @GetMapping("/type/{type}")
    public ResponseEntity<List<Badge>> getBadgesByType(@PathVariable String type) {
        List<Badge> badges = badgeService.getBadgesByType(type);
        return ResponseEntity.ok(badges);
    }
    
    @PutMapping("/{id}")
    public ResponseEntity<Badge> updateBadge(@PathVariable Long id, @RequestBody Badge badgeDetails) {
        Badge updatedBadge = badgeService.updateBadge(id, badgeDetails);
        if (updatedBadge == null) {
        	return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return ResponseEntity.ok(updatedBadge);
    }
    
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteBadge(@PathVariable Long id) {
        boolean isRemoved = badgeService.deleteBadge(id);
        if (!isRemoved) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }
}
