package app.gestion.backendSpring.Entities;

import javax.persistence.*;

import java.util.Collection;
import java.util.Date;

@Entity
@Table(name = "evenements")
public class Evenement {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Lob
    @Column(nullable = true)
    private String codeQr;

    @Column(nullable = true)
    private String affiche;

    @Column(nullable = false)
    private int capacite;

    @Column(nullable = false)
    private Date dateLimiteInscription;

    @Column(nullable = false)
    private boolean forManagers = false;

    @Column(nullable = false)
    private String categorie;

    @Column(nullable = false)
    private String lieu;

    @Column(nullable = false)
    private String description;

    @Column(nullable = false)
    private String titre;

    @Column(nullable = false)
    private Date date;

    @Column(nullable = false)
    private String organisateur;

    @ManyToMany(mappedBy = "participantEvenements")
    private Collection<User> participants;

    @ManyToMany(mappedBy = "presenceEvenements")
    private Collection<User> presences;

    @Column(nullable = false)
    @Temporal(TemporalType.TIMESTAMP)
    private Date createdAt = new Date();

    @Column(nullable = false)
    @Temporal(TemporalType.TIMESTAMP)
    private Date updatedAt = new Date();

    // Getters and setters


    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getCodeQr() {
        return codeQr;
    }

    public void setCodeQr(String codeQr) {
        this.codeQr = codeQr;
    }

    public String getAffiche() {
        return affiche;
    }

    public void setAffiche(String affiche) {
        this.affiche = affiche;
    }

    public int getCapacite() {
        return capacite;
    }

    public void setCapacite(int capacite) {
        this.capacite = capacite;
    }

    public Date getDateLimiteInscription() {
        return dateLimiteInscription;
    }

    public void setDateLimiteInscription(Date dateLimiteInscription) {
        this.dateLimiteInscription = dateLimiteInscription;
    }

    public boolean isForManagers() {
        return forManagers;
    }

    public void setForManagers(boolean forManagers) {
        this.forManagers = forManagers;
    }

    public String getCategorie() {
        return categorie;
    }

    public void setCategorie(String categorie) {
        this.categorie = categorie;
    }

    public String getLieu() {
        return lieu;
    }

    public void setLieu(String lieu) {
        this.lieu = lieu;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getOrganisateur() {
        return organisateur;
    }

    public void setOrganisateur(String organisateur) {
        this.organisateur = organisateur;
    }

    public Collection<User> getParticipants() {
        return participants;
    }

    public void setParticipants(Collection<User> participants) {
        this.participants = participants;
    }

    public Collection<User> getPresences() {
        return presences;
    }

    public void setPresences(Collection<User> presences) {
        this.presences = presences;
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
}