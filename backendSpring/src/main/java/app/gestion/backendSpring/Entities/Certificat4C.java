package app.gestion.backendSpring.Entities;

import javax.persistence.*;

import java.util.Collection;
import java.util.Date;

@Entity
@Table(name = "certificat4cs")
public class Certificat4C {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false)
    private String nom;

    @Column(nullable = false)
    private String lieu;

    @Column(nullable = true)
    private String affiche;

    @Column(nullable = false)
    private int capacite;

    @Column(nullable = false)
    private Date dateLimiteInscription;

    @Column(nullable = false)
    private Date date;

    @Column(nullable = true)
    private String certificat;

    @Lob
    @Column(nullable = false)
    private String codeQr;

    @Column(nullable = false)
    private double prix;

    @Column(nullable = false)
    private double offre;

    @Column(nullable = false)
    private String organisation;

    @Column(nullable = false)
    private String categorie;

    @Column(nullable = false)
    private boolean forManagers = false;

    @Column(nullable = true)
    private String description;

    @ManyToMany(mappedBy = "participantCertificat4Cs")
    private Collection<User> participants;

    @ManyToMany(mappedBy = "presenceCertificat4Cs")
    private Collection<User> presences;

    @Column(nullable = false)
    @Temporal(TemporalType.TIMESTAMP)
    private Date createdAt = new Date();

    @Column(nullable = false)
    @Temporal(TemporalType.TIMESTAMP)
    private Date updatedAt = new Date();


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

    public String getLieu() {
        return lieu;
    }

    public void setLieu(String lieu) {
        this.lieu = lieu;
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

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getCertificat() {
        return certificat;
    }

    public void setCertificat(String certificat) {
        this.certificat = certificat;
    }

    public String getCodeQr() {
        return codeQr;
    }

    public void setCodeQr(String codeQr) {
        this.codeQr = codeQr;
    }

    public double getPrix() {
        return prix;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }

    public double getOffre() {
        return offre;
    }

    public void setOffre(double offre) {
        this.offre = offre;
    }

    public String getOrganisation() {
        return organisation;
    }

    public void setOrganisation(String organisation) {
        this.organisation = organisation;
    }

    public String getCategorie() {
        return categorie;
    }

    public void setCategorie(String categorie) {
        this.categorie = categorie;
    }

    public boolean isForManagers() {
        return forManagers;
    }

    public void setForManagers(boolean forManagers) {
        this.forManagers = forManagers;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
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