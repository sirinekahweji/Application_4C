package app.gestion.backendSpring.Entities;

import javax.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.io.Serializable;
import java.util.Collection;
import java.util.Date;
import java.util.List;

@Data
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "users")
@Inheritance(strategy = InheritanceType.JOINED)
public class User implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false)
    private String nom;

    @Column(nullable = false)
    private String prenom;

    @Column(nullable = false)
    private Integer phoneNumber;

    @Column(nullable = false)
    private Integer cin;

    @Lob
    @Column(columnDefinition = "BLOB")
    private String codeQr;

    private String photoProfile;
    private String photoCouverture;

    @Column(nullable = false)
    private Boolean genre;

    @Column(nullable = false)
    @Temporal(TemporalType.DATE)
    private Date dateNaissance;

    private String lienLinkdIn;
    private String adresse;
    private String Gouvernorat;

    @Column(nullable = false)
    private String userType;

    @Column(nullable = false)
    private Integer nbEtoiles;

    @Column(nullable = false)
    private Boolean corbeille = false;

    @ManyToOne
    @JoinColumn(name = "role_id")
    private Role role;

    @Column(nullable = false, unique = true)
    private String email;

    @Column(nullable = false)
    private String password;

    @Column
    private String rememberToken;

    @Temporal(TemporalType.TIMESTAMP)
    @Column(name = "created_at", nullable = false, updatable = false)
    private Date createdAt;

	@OneToMany(mappedBy = "emmetteur", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	private List<Message> sendMessages;

	@OneToMany(mappedBy = "recepteur", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	private List<Message> receiveMessages;

	@OneToMany(mappedBy = "responsable", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	private List<Publication> publications;

	@OneToOne(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	private Cv cv;

	@ManyToMany
	@JoinTable(
			name = "user_badges",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "badge_id")
	)
	private Collection<Badge> badges;

	@ManyToMany
	@JoinTable(
			name = "participant_formations",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "formation_id")
	)
	private Collection<Formation4C> participantFormations;

	@ManyToMany
	@JoinTable(
			name = "presences_Session",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "session_id")
	)
	private Collection<Session> presencesSession;

	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, orphanRemoval = true)
	private List<GroupeManager> groupeManagers;

	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, orphanRemoval = true)
	private List<DemandeAcces> demandeAccesList;

	@ManyToMany
	@JoinTable(
			name = "participant_certificat4c",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "certificat4c_id")
	)
	private Collection<Certificat4C> participantCertificat4Cs;

	@ManyToMany
	@JoinTable(
			name = "presence_certificat4c",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "certificat4c_id")
	)
	private Collection<Certificat4C> presenceCertificat4Cs;

	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, orphanRemoval = true)
	private List<Notification> notifications;

	@ManyToMany
	@JoinTable(
			name = "user_attestations",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "attestation_id")
	)
	private Collection<Attestation> attestations;

	@ManyToMany
	@JoinTable(
			name = "participant_evenement",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "evenement_id")
	)
	private Collection<Evenement> participantEvenements;

	@ManyToMany
	@JoinTable(
			name = "presence_evenement",
			joinColumns = @JoinColumn(name = "user_id"),
			inverseJoinColumns = @JoinColumn(name = "evenement_id")
	)
	private Collection<Evenement> presenceEvenements;


    public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getPrenom() {
		return prenom;
	}

	public void setPrenom(String prenom) {
		this.prenom = prenom;
	}

	public Integer getPhoneNumber() {
		return phoneNumber;
	}

	public void setPhoneNumber(Integer phoneNumber) {
		this.phoneNumber = phoneNumber;
	}

	public Integer getCin() {
		return cin;
	}

	public void setCin(Integer cin) {
		this.cin = cin;
	}

	public String getCodeQr() {
		return codeQr;
	}

	public void setCodeQr(String codeQr) {
		this.codeQr = codeQr;
	}

	public String getPhotoProfile() {
		return photoProfile;
	}

	public void setPhotoProfile(String photoProfile) {
		this.photoProfile = photoProfile;
	}

	public String getPhotoCouverture() {
		return photoCouverture;
	}

	public void setPhotoCouverture(String photoCouverture) {
		this.photoCouverture = photoCouverture;
	}

	public Boolean getGenre() {
		return genre;
	}

	public void setGenre(Boolean genre) {
		this.genre = genre;
	}

	public Date getDateNaissance() {
		return dateNaissance;
	}

	public void setDateNaissance(Date dateNaissance) {
		this.dateNaissance = dateNaissance;
	}

	public String getLienLinkdIn() {
		return lienLinkdIn;
	}

	public void setLienLinkdIn(String lienLinkdIn) {
		this.lienLinkdIn = lienLinkdIn;
	}

	public String getAdresse() {
		return adresse;
	}

	public void setAdresse(String adresse) {
		this.adresse = adresse;
	}

	public String getGouvernorat() {
		return Gouvernorat;
	}

	public void setGouvernorat(String gouvernorat) {
		Gouvernorat = gouvernorat;
	}

	public String getUserType() {
		return userType;
	}

	public void setUserType(String userType) {
		this.userType = userType;
	}

	public Integer getNbEtoiles() {
		return nbEtoiles;
	}

	public void setNbEtoiles(Integer nbEtoiles) {
		this.nbEtoiles = nbEtoiles;
	}

	public Boolean getCorbeille() {
		return corbeille;
	}

	public void setCorbeille(Boolean corbeille) {
		this.corbeille = corbeille;
	}

	public Role getRole() {
		return role;
	}

	public void setRole(Role role) {
		this.role = role;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getRememberToken() {
		return rememberToken;
	}

	public void setRememberToken(String rememberToken) {
		this.rememberToken = rememberToken;
	}

	public Date getCreatedAt() {
		return createdAt;
	}

	public void setCreatedAt(Date createdAt) {
		this.createdAt = createdAt;
	}

	public Date getUpdatedAt() {
		return updatedAt;
	}

	public void setUpdatedAt(Date updatedAt) {
		this.updatedAt = updatedAt;
	}

	@Temporal(TemporalType.TIMESTAMP)
    @Column(name = "updated_at", nullable = false)
    private Date updatedAt;

    @PrePersist
    protected void onCreate() {
        createdAt = new Date();
        updatedAt = new Date();
    }

    @PreUpdate
    protected void onUpdate() {
        updatedAt = new Date();
    }

}
