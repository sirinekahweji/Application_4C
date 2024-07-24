package app.gestion.backendSpring.Controllers;

import org.springframework.security.core.Authentication;


import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.google.zxing.WriterException;

import app.gestion.backendSpring.Entities.Role;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Repositories.UserRepository;
import app.gestion.backendSpring.Services.UserService;
import app.gestion.backendSpring.SpringSecurity.SecurityConfig;
import app.gestion.backendSpring.SpringSecurity.UserDetailsServiceImpl;
import data.Credentials;
import io.jsonwebtoken.io.IOException;
import util.QRCodeUtil;
import jwt.jwtTokenUtil;
import net.minidev.json.JSONObject;

@RestController
@RequestMapping("/auth")
public class AuthController {
	
	@Autowired
	UserRepository userRepo;
	
	@Autowired
	SecurityConfig security;
	
	@Autowired
	UserDetailsServiceImpl userservice;
	
	@Autowired
	AuthenticationManager authenticationManager; 
	
	@Autowired
	UserService userServiceTest;
	
	@Autowired
    PasswordEncoder passwordEncoder;
	
	 @Autowired
	 private jwtTokenUtil jwtTokenUtil;
	
	@PostMapping("/signup")
	public ResponseEntity<?> signUp(@RequestBody User user){
		try {
            // Trouver le rôle participant
            //Role participantRole = RoleRepository.findByName("PARTICIPANT").orElseThrow(() -> new RuntimeException("Role not found"));

            // Générer le QR code
            String qrCodeData = QRCodeUtil.generateQRCode(String.format("{\"nom\": \"%s\", \"prenom\": \"%s\", \"genre\": \"%s\", \"user_type\": \"%s\"}",
                    user.getNom(), user.getPrenom(), user.getGenre(), user.getUserType()));
            
            Role participant = new Role();

            // Créer un nouvel utilisateur
            User newUser = new User();
            newUser.setNom(user.getNom());
            newUser.setPrenom(user.getPrenom());
            newUser.setPhoneNumber(user.getPhoneNumber());
            newUser.setCin(user.getCin());
            newUser.setCodeQr(qrCodeData);
            newUser.setPhotoProfile(null);
            newUser.setPhotoCouverture(null);
            newUser.setGenre(user.getGenre());
            newUser.setDateNaissance(user.getDateNaissance());
            newUser.setLienLinkdIn(null);
            newUser.setNbEtoiles(0);
            newUser.setAdresse(user.getAdresse());
            newUser.setGouvernorat(user.getGouvernorat());
            newUser.setUserType(user.getUserType());
            newUser.setCorbeille(false);
            newUser.setRole(null);
            newUser.setEmail(user.getEmail());
            newUser.setPassword(passwordEncoder.encode(user.getPassword()));

            userRepo.save(newUser);

            return new ResponseEntity<>(newUser, HttpStatus.CREATED);
        } catch (WriterException | IOException | java.io.IOException e) {
            return new ResponseEntity<>(e.getMessage(), HttpStatus.INTERNAL_SERVER_ERROR);
        }
	}
	
	@PostMapping("/login")
	public ResponseEntity<?> login(@RequestBody Credentials auth){
		try {
	        Optional<User> optionalUser = userRepo.findByEmail(auth.getEmail());
	        if (!optionalUser.isPresent()) {
	            return new ResponseEntity<>("USER_NOT_FOUND", HttpStatus.CONFLICT);
	        }

	        User user = optionalUser.get();
	        Authentication authsuser = authenticationManager.authenticate(
	            new UsernamePasswordAuthenticationToken(auth.getEmail(), auth.getPassword()));
	        
	        UserDetails user_det = userservice.loadUserByUsername(auth.getEmail());
	        
	        if (user == null) {
	            return new ResponseEntity<>("USER_DISABLED", HttpStatus.CONFLICT);
	        }

	        String token = jwtTokenUtil.generateToken(user_det);
	        JSONObject res = new JSONObject();
	        res.put("token", token);
	        res.put("user", user);
	        return ResponseEntity.ok().body(res);
	    } catch (Exception e) {
	        e.printStackTrace();
	        return new ResponseEntity<>("INVALID_CREDENTIALS", HttpStatus.CONFLICT);
	    }
	}
}
