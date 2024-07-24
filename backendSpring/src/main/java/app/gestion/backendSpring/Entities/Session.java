package app.gestion.backendSpring.Entities;

import javax.persistence.*;

import java.util.Collection;
import java.util.Date;

@Entity
@Table(name = "sessions")
public class Session {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false)
    private Date date;

    @Column(nullable = false)
    private String lieu;

    @Column(nullable = false)
    private String heure;

    @Column(nullable = false)
    private int duree;

    @ManyToOne
    @JoinColumn(name = "formation4c_id", nullable = false)
    private Formation4C formation4C;

    @Column(nullable = false)
    @Temporal(TemporalType.TIMESTAMP)
    private Date createdAt = new Date();

    @Column(nullable = false)
    @Temporal(TemporalType.TIMESTAMP)
    private Date updatedAt = new Date();

    @ManyToMany(mappedBy = "presencesSession")
    private Collection<User> presencesSession;

    // Getters and setters


    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getLieu() {
        return lieu;
    }

    public void setLieu(String lieu) {
        this.lieu = lieu;
    }

    public String getHeure() {
        return heure;
    }

    public void setHeure(String heure) {
        this.heure = heure;
    }

    public int getDuree() {
        return duree;
    }

    public void setDuree(int duree) {
        this.duree = duree;
    }

    public Formation4C getFormation4C() {
        return formation4C;
    }

    public void setFormation4C(Formation4C formation4C) {
        this.formation4C = formation4C;
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

    public Collection<User> getPresencesSession() {
        return presencesSession;
    }

    public void setPresencesSession(Collection<User> presencesSession) {
        this.presencesSession = presencesSession;
    }
}